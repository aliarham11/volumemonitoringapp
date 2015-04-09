<?php
class Recordcontroller extends CI_Controller {
     
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function getRecordData()
	{
		$this->load->model('Recordmodel');
		$vehicle_id = $this->input->get('vehicle_id');
		$height = $this->input->get('height');
		$latitude = $this->input->get('latitude');
		$longitude = $this->input->get('longitude');
		$altitude = 0;
		$timestamp = date("Y-m-d h:i:s");

		$data = array(
			'id' => 0,
			'vehicle_id' => $vehicle_id,
			'liquid_level' => $height,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'altitude' => $altitude,
			'timestamp' => $timestamp,
		 );

		$this->Recordmodel->insertRecordData($data);
	}

	public function postRecordData()
	{
		$this->load->model('Recordmodel');
		$vehicle_id = 'SPBU1002';
		$height = $this->input->post('height');
		$latitude = $this->input->post('latitude');
		$longitude = $this->input->post('longitude');
		$altitude = "0.000";
		$timestamp = date("Y-m-d h:i:s");

		$data = array(
			'vehicle_id' => $vehicle_id,
			'liquid_level' => $height,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'altitude' => $altitude,
			'timestamp' => $timestamp,
		 );

		$this->Recordmodel->insertRecordData($data);
	}
}
