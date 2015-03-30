<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoringcontroller extends CI_Controller {

	public function index()
	{
		$this->load->view('head');
		$this->load->view('home_page');
	}


	public function getVehicleStatus($id=null)
	{
		$this->load->model('Monitoringmodel');

		$data = $this->calculateVolume();
		echo json_encode($data);

	}

	public function calculateVolume()
	{
		$this->load->model('Monitoringmodel');
		$query = $this->Monitoringmodel->getVehicleData();
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
