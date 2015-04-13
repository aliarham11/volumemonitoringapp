<?php
class Recordmodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function insertRecordData($data)
    {

    	// $data['id'] = $this->autoIncrementId()[0]['id'] + 1;
    	$data['id'] = 99;
    	$this->db->insert('track_record',$data);
    	return;
    }

    public function autoIncrementId()
    {
    	$this->db->select_max('id');
    	return $this->db->get('track_record')->result_array();
    }

}