<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function login($data) {
		
        return $this->db->query('SELECT * FROM users where  ' . $data . ' limit 1')->row();
    }

    public function editUserData($data = array(), $iUserId) {
        $this->db->where('iUserId', $iUserId);
        $this->db->update('users', $data);
        return $iUserId;
    }
 public function getCountry($data) {
        return $this->db->query('SELECT * FROM countries where  ' . $data . ' limit 1')->row();
    }
    public function userCount() {
        return $this->db->query('SELECT iUserId FROM users where eUserType !="admin"')->num_rows();
    }
	public function dealerCount() {
        return $this->db->query('SELECT * FROM dealers ')->num_rows();
    }
	public function distributorsCount() {
        return $this->db->query('SELECT * FROM distributor ')->num_rows();
    }
	public function purchaseOrderCount() {
        return $this->db->query('SELECT * FROM purchaseorder ')->num_rows();
    }

    public function getData($table,$where) {
	return $this->db->query('SELECT * FROM '.$table.' '.$where.'')->result();
    }
	public function passwordFlagUpdateDetails($userId,$data = array()){
		$this->db->where('iUserId',$userId);
		$this->db->update('users',$data['updateDetails']);
		return $this->db->affected_rows();
	}

}
