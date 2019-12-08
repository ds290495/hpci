<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {

    public function agentList($start, $end, $searchQuery, $sqlRec) {
				
		return $this->db->query('SELECT ag.*,city.city as cityName,state.state as stateName from agents ag join city on city.iCityId=ag.iCityId join state on state.id=ag.iStateId where 1 ' . $searchQuery . '
                ' . $sqlRec . '  limit ' . $start . ' , ' . $end . '')->result();		
				
				
    }
    public function getState() {
        return $this->db->query('SELECT * from state')->result();
    }
	

    public function agentListCount($start, $end, $searchQuery, $sqlRec) {
        return $this->db->query('SELECT ag.*,city.city as cityName,state.state as stateName from agents ag join city on city.iCityId=ag.iCityId join state on state.id=ag.iStateId where 1 ' . $searchQuery . '')->num_rows();
    }

    public function random_string($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $name = substr(str_shuffle($chars), 0, $length);
        return $name;
    }
	public function getCity() {
        return $this->db->query('SELECT * from city')->result();
    }

	public function getCityById($iStateId){
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where('iStateId',$iStateId);
		$query = $this->db->get()->result_array();
		return $query;
	}
	
	public function getHintPattern()
	{
		return $this->db->query('SELECT DISTINCT LEFT(vPatternNo , 2) AS patternhint FROM jobber')->result();
	}
	public function getpatterns($patternno)
	{
		return $this->db->query('SELECT * FROM `jobber` WHERE `vPatternNo` LIKE "'.$patternno.'%"')->result();
	}

}
