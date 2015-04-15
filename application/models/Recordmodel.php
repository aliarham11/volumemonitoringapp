<?php
class Recordmodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function insertRecordData($data)
    {

    	$data['id'] = $this->autoIncrementId()->id + 1;
    	// echo $data['id'];
        // exit();
        // // $data['id'] = 99;
    	$this->db->insert('track_record',$data);
        $is_going = array('is_going' => 1);
        $this->db->where('vehicle_id',$data['vehicle_id']);
        $this->db->update('initial_data',$is_going);
    	return;
    }

    public function autoIncrementId()
    {
    	$this->db->select_max('id');
        $id = $this->db->get('track_record')->result()[0];
    	return $id;
    }

}