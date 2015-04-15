<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registercontroller extends CI_Controller {
     
	public function index()
	{
		$this->load->model('Registermodel');
		$data['list_vid'] = $this->Registermodel->getVid();

		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('vehicle_id', 'Vehicle Id', 'callback_checkExist');
		$this->form_validation->set_rules('vehicle_name', 'Vehicle Name', 'required');
		$this->form_validation->set_rules('diameter', 'Diameter', 'required');
		$this->form_validation->set_rules('longsize', 'Longsize', 'required');
		$this->form_validation->set_rules('initial_volume', 'Initial Volume', 'required');


		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('head',$data);
			$this->load->view('register_page');
		}
		else
		{
			$this->postVehicleData();
		}
		
	}

	public function postVehicleData()
	{
		$this->load->model('Registermodel');

		$vehicle_id = $this->input->post('vehicle_id');
		$vehicle_name = $this->input->post('vehicle_name');
		$tank_type = $this->input->post('tank_type');
		$diameter = $this->input->post('diameter');
		$longsize = $this->input->post('longsize');
		$initial_volume = $this->input->post('initial_volume');
		
		$data_master = array(
			'vehicle_id' => $vehicle_id,
			'vehicle_name' => $vehicle_name,
			'tank_type' => $tank_type,
			'diameter' => $diameter,
			'longsize' => $longsize,
 		);

 		$data_tran = array(
 			'id' => 0,
 			'vehicle_id' => $vehicle_id,
 			'initial_volume' => $initial_volume,
 			'is_going' => 0,
 			'is_arrive' => 0,
 			);
		
		$this->Registermodel->insertVehicleData($data_master);
		$this->Registermodel->insertInitialData($data_tran);

		redirect('monitoringcontroller','refresh');
	}

	public function checkExist($vid)
	{
		$this->load->model('Registermodel');
		$result = $this->Registermodel->checkVid($vid);
		if($result)
		{
			$this->form_validation->set_message('checkExist','Vehicle id exist, insert another vehicle id');
			return false;
		}
		else
		{
			return true;
		}
		# code...
	}

	public function arrival()
	{
		$this->load->model('Registermodel');
		$vid = $this->input->post('vid');
		// $data = array(
		// 	'vehicle_name' => $vname,
		// );
		$this->Registermodel->updateArrivalData($vid);

		redirect('monitoringcontroller','refresh');
	}

}
