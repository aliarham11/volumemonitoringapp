<?php
class Registermodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function insertVehicleData($data_master, $data_tran)
    {
        $data_tran['id'] = $this->autoIncrementId() + 1;
    	$this->db->insert('vehicle_master',$data_master);
        $this->db->insert('initial_data',$data_tran);
        return;
    }

    // public function insertInitialData($data)
    // {
    //     $data_tran['id'] = $this->autoIncrementId() + 1;
    // 	$this->db->insert('initial_data',$data_tran);
    //     return;
    // }

    public function updateVehicleData($data_master, $data_tran)
    {
        $this->db->where('vehicle_id', $data_master['vehicle_id']);
        $this->db->update('vehicle_master', $data_master);
        $this->db->where('vehicle_id', $data_master['vehicle_id']);
        $this->db->update('initial_data', $data_tran);
        return;
        # code...
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

    public function getVid($is_history=null,$is_update=false,$is_arrive=false)
    {
        $this->db->select('vehicle_id');

        // if(!$is_history)
        //     $this->db->where('is_arrive', 0);
        if($is_history)
            $this->db->where('is_arrive', 1);

        if($is_update)
            $this->db->where('is_going', 0);

        if($is_arrive)
            $this->db->where('is_going', 1);
        
        $this->db->from('initial_data');
        // $this->db->join('vehicle_master','initial_data.vehicle_id = vehicle_master.vehicle_id');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function getVname()
    {
        $this->db->select('vehicle_name');
        $this->db->where('is_going', 1);
        $this->db->where('is_arrive', 0);
        $this->db->from('initial_data');
        $this->db->join('vehicle_master','vehicle_master.vehicle_id = initial_data.vehicle_id');
        $result = $this->db->get()->result_array();
        return $result;
        # code...
    }

    public function updateArrivalData($vid)
    {
        $is_arrive = array(
            'is_arrive' => 1,
            'is_going' => 0,
        );

        $this->db->update('initial_data', $is_arrive, array('vehicle_id' => $vid));
        return;
    }

    public function getVehicleData($vid)
    {
        $this->db->select('*');
        $this->db->where('vehicle_master.vehicle_id',$vid);
        $this->db->from('vehicle_master');
        $this->db->join('initial_data','vehicle_master.vehicle_id = initial_data.vehicle_id');
        $result = $this->db->get()->result();
        return $result;
    }

    public function autoIncrementId()
    {
        $this->db->select_max('id');
        $id = $this->db->get('initial_data')->result_array();
        return $id['0']['id'];
    }



}