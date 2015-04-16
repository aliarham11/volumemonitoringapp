<?php
class Registermodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function insertVehicleData($data)
    {
    	$this->db->insert('vehicle_master',$data);
        return;
    }

    public function insertInitialData($data)
    {
        $data['id'] = $this->autoIncrementId() + 1;
    	$this->db->insert('initial_data',$data);
        return;
    }

    public function checkVid($vid)
    {
        $this->db->select();
        $this->db->where('vehicle_id',$vid);
        $result = $this->db->get('vehicle_master')->result_array();
        if($result)
            return true;
        else 
            return false;
    }

    public function getVid($is_history=null)
    {
        $this->db->select('vehicle_id');
        if(!$is_history)
            $this->db->where('is_arrive', 0);
        
        $this->db->where('is_going', 1);
        $this->db->from('initial_data');
        // $this->db->join('vehicle_master','initial_data.vehicle_id = vehicle_master.vehicle_id');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function updateArrivalData($vid)
    {
        $is_arrive = array(
            'is_arrive' => 1,
        );

        $this->db->update('initial_data', $is_arrive, array('vehicle_id' => $vid));
        return;
    }

    public function autoIncrementId()
    {
        $this->db->select_max('id');
        $id = $this->db->get('initial_data')->result_array();
        return $id['0']['id'];
    }



}