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
                SELECT `track_record`.`vehicle_id`, `vehicle_name`, `tank_type`, `diameter`, `longsize`, `latitude`, `longitude`, `liquid_level`, `timestamp` 
                FROM `track_record` 
                JOIN `vehicle_master` ON `vehicle_master`.`vehicle_id`=`track_record`.`vehicle_id`
                JOIn `initial_data` ON `initial_data`.`vehicle_id`=`track_record`.`vehicle_id`
                Where `is_arrive` = 0 AND `is_going` = 1
                ORDER BY `track_record`.`id` DESC
                ) temp, `initial_data`
                group by temp.`vehicle_id`";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }

    public function getInitialData($id)
    {
    	$this->db->select('initial_volume');
    	$query = $this->db->get_where('initial_data',$id,1);
    	return $query->result_array();
    }

    public function getHistory($vid)
    {
        $this->db->select('vehicle_name, latitude,longitude,liquid_level,timestamp,diameter,longsize,tank_type,vehicle_master.vehicle_id');
        $this->db->from('track_record');
        $this->db->join('vehicle_master','track_record.vehicle_id = vehicle_master.vehicle_id');
        $this->db->where($vid);
        $query = $this->db->get();
        return $query->result_array();
        # code...
    }

}