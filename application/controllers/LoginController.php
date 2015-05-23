<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logincontroller extends CI_Controller {

	public function index()
	{
		
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->load->library('session');

		$this->form_validation->set_rules('uid', 'User ID', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = true;
			$this->load->view('login_page', $data);
		}
		else
		{
			$this->login();
		}
	}

	public function login()
	{
		$this->load->model('Loginmodel');
		$uid = $this->input->post('uid');
		$pwd = hash('md5',$this->input->post('pwd'));
		// echo $uid.' '.$pwd;
		$data = array(
			'username' => $uid,
			'password' => $pwd,

		);
		// var_dump($data);
		// exit();

		$status = $this->Loginmodel->checkLogin($data);
		if($status)
		{
			$this->session->set_userdata($data);
			redirect('monitoringcontroller','refresh');
			// var_dump($this->session->userdata('username'))
			
		}
		else
		{
			$data['status']= false;
			$this->load->view('login_page', $data);
		}
	}

	public function logout()
	{
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('logincontroller','refresh');
		# code...
	}


	


}
