<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoringcontroller extends CI_Controller {

	public function index()
	{
		$this->load->model('Registermodel');
		$data['list_vid'] = $this->Registermodel->getVid(null,false,true);
		$this->load->view('head',$data);
		$this->load->view('home_page');
	}


	public function historyPage()
	{
		$this->load->model('Registermodel');
		$data['list_vid'] = $this->Registermodel->getVid(null,false,true);
		$data['list_tracked_vid'] = $this->Registermodel->getVid(1,null);
		$this->load->view('head',$data);
		$this->load->view('history_page', $data);
		# code...
	}

	public function getVehicleStatus($id=null)
	{
		$this->load->model('Monitoringmodel');
		$query = $this->Monitoringmodel->getVehicleData();
		$data = $this->calculateVolume($query);
		echo json_encode($data);

	}

	public function getListVehicle()
	{
		$this->load->model('Registermodel');
		$data = $this->Registermodel->getVname();
		echo json_encode($data);
		# code...
	}

	public function showHistory()
	{
		$this->load->model('Monitoringmodel');
		$vid = $this->input->get('vid');
		$data = array(
			'vehicle_master.vehicle_id' => $vid,
		);
		$query = $this->Monitoringmodel->getHistory($data);
		$data = $this->calculateVolume($query);
		echo json_encode($data);

		# code...
	}

	public function calculateVolume($query)
	{
		$this->load->model('Monitoringmodel');
		
		$i=0;
		foreach ($query as $row) 
		{
			$currentVolume = null;
			if($row['tank_type'] == 'Tube')
			{
				$currentVolume = 3.14 * ($row['diameter'] / 2) * ($row['liquid_level'] / 2) * $row['longsize'];
			}
			else if($row['tank_type'] == 'Rectangular')
			{
				$currentVolume = $row['liquid_level'] * $row['longsize'] * $row['diameter'];
			}

			$id = array('vehicle_id' => $row['vehicle_id']);
			$initialVolume = $this->Monitoringmodel->getInitialData($id);
			$precentage = $currentVolume / $initialVolume[0]['initial_volume'] * 100;
			$precentage = round($precentage, 2);
			array_push($query[$i++], $currentVolume, $initialVolume[0]['initial_volume'],$precentage);
		}

		return $query;
	}


}
