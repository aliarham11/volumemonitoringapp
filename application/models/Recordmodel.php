<?php
class Recordmodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function insertRecordData($data)
    {
    	$this->db->insert('track_record',$data);
    	return;
    }

}