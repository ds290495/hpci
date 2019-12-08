<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function getData($iUserId, $levels) {
        return $this->db->query('SELECT ol.* FROM orders o join orderlevel ol on o.iOrderId=ol.iOrderId where o.iUserId="' . $iUserId . '"  and eAddedBy="admin" limit 1')->row();
    }

    public function getRow($table, $where) {
        return $this->db->query('SELECT * from ' . $table . ' ' . $where . ' ')->row();
    }
	public function getRows($table, $where) {
        return $this->db->query('SELECT * from ' . $table . ' ' . $where . ' ')->result();
    }
	
	public function getnum($table, $where) {
        return $this->db->query('SELECT * from ' . $table . ' ' . $where . ' ')->num_rows();
    }

    public function editData($data = array(), $param, $id, $table) {
        $this->db->where($param, $id);
        $this->db->update($table, $data);
    }

    public function deleteOrderLevel($id) {
        $this->db->where('iOrderId', $id);
        $this->db->where('eAddedBy', 'admin');
        $del = $this->db->delete('orderlevel');
        return $del;
    }

    public function userList($start, $end, $searchQuery, $sqlRec) {
        return $this->db->query('SELECT * from users  where eUserType="user" ' . $searchQuery . '
                ' . $sqlRec . '  limit ' . $start . ' , ' . $end . '')->result();
    }

    public function userListCount($start, $end, $searchQuery, $sqlRec) {
        return $this->db->query('SELECT * from users  where eUserType="user" ' . $searchQuery . '')->num_rows();
    }

    public function random_string($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $name = substr(str_shuffle($chars), 0, $length);
        return $name;
    }

    public function addData($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function deleteData($table, $param, $id) {
        $this->db->where($param, $id);
        $del = $this->db->delete($table);
        return $del;
    }

    public function backgroundPost($url) {
//  $json = json_decode($_REQUEST['jsonData']);
        $parts = parse_url($url);
        $fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port'] : 80, $errno, $errstr, 30);
//         $fp = fsockopen('ssl://' . $parts['host'], isset($parts['port']) ? $parts['port'] : 443, $errno, $errstr, 30);
        if (!$fp) {
            return false;
        } else {
            $out = "POST " . $parts['path'] . " HTTP/1.1\r\n";
            $out .= "Host: " . $parts['host'] . "\r\n";
            $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $out .= "Content-Length: " . strlen($parts['query']) . "\r\n";
            $out .= "Connection: Close\r\n\r\n";
            if (isset($parts['query']))
                $out .= $parts['query'];

            fwrite($fp, $out);
            fclose($fp);
            return true;
        }
    }

}
