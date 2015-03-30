<?php
class Monitoringmodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function getVehicleData()
    {
    	$sql = "select * from
				(
				SELECT `track_record`.`vehicle_id`, `vehicle_name`, `tank_type`, `diameter`, `longsize`, `latitude`, `longitude`, `liquid_level`, `timestamp` FROM `track_record` JOIN `vehicle_master` ON `vehicle_master`.`vehicle_id`=`track_record`.`vehicle_id` ORDER BY `timestamp` DESC
				) temp
				group by `vehicle_id`";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function getInitialData($id)
    {
    	$this->db->select('initial_volume');
    	$query = $this->db->get_where('initial_data',$id,1);
    	return $query->result_array();
    }

}