<?php
class Recordmodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function insertRecordData($data)
    {

    	$data['id'] = $this->autoIncrementId() + 1;
    	// echo $data['id'];
        // exit();
        // // $data['id'] = 99;
    	$this->db->insert('track_record',$data);
        $is_going = array('is_going' => 1);
        $this->db->where('vehicle_id',$data['vehicle_id']);
        $this->db->update('initial_data',$is_going);
    	return;
    }

    public function getTankHeight($vid)
    {
        $query = $this->db->get_where('vehicle_master', array('vehicle_id' => $vid));
        return $query->result();
    }

    public function autoIncrementId()
    {
    	$this->db->select_max('id');
        $id = $this->db->get('track_record')->result_array();
    	return $id['0']['id'];
    }

}