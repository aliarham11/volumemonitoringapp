<?php
class Loginmodel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }


    public function checkLogin($data)
    {
        $this->db->select('*');
        $this->db->where('username', $data['username']);
        $this->db->where('password', $data['password']);
        $status = $this->db->get('user')->result();
        if($status)
            return true;
        else
            return false;

    	
    }

    

}