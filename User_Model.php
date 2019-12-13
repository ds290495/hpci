<?php
Class User_Model extends CI_Model {
	public function login($data)
	{	$query = $this->db->query('SELECT * FROM users WHERE email ="'.$data['email'].'" and password = "'.$data['password'].'" ');
        
	 return $query->result_array();
	}
	function emailvalidate($email)
	{
		  $this->db->where('email',$email);
		  $sql = $this->db->get('users');
		  return $sql->num_rows();
	}
	function ResetPassword($password,$email)
	{
		$data['password'] = md5($password);
		$query = $this->db->query("UPDATE users SET password='".$data['password']."' WHERE email = '".$email."'");
	}
	public function viewprofile($id)
	{
		$query= $this->db->query('SELECT * FROM users WHERE userId ="'.$id.'"');
		return $query->result_array();
	}
	public function editprofile($data =  array(),$u_id)
	{
		$this->db->where('userId', $u_id);
        $this->db->update('users', $data);
					
	}
	public function checkPassword($oldpassword,$cp_id)
	{
		$query= $this->db->query('SELECT * FROM users WHERE userId ="'.$cp_id.'" and password ="'.$oldpassword.'"');
		return $query->result_array();
					
	}
	public function newPassword($data =  array(),$np_id)
	{
		$this->db->where('userId', $np_id);
        $this->db->update('users', $data);
					
	}
	public function checkEmail($email,$ce_id)
	{
		$query = $this->db->query('SELECT * FROM users WHERE email ="'.$email.'" and userId != "'.$ce_id.'" ');
		return $query->num_rows();
	}
	public function emailaval($email)
	{
		$query = $this->db->query('SELECT * FROM users WHERE email ="'.$email.'"');
		return $query->num_rows();
	}
	public function userCount()
	{
		$result = $this->db->query("SELECT * FROM `users` WHERE type !='admin' ");
		return $result->num_rows();
	}
	public function productCount()
	{
		$result = $this->db->query("SELECT * FROM `products`");
		return $result->num_rows();
	}
	public function cbmCount()
	{
		$result = $this->db->query('select SUM(B.purchasePrice)as totalPrice,p.productGroupName as productGroupName, SUM(B.cbm) as finalcbm from productDetails B inner join productGroup p on B.productGroupId=p.productGroupId WHERE B.pStatus NOT IN ("Sold", "transferin", "transferout","transferoutold")');
		return $result->result_array();
	}
	public function transferoutCount(){
		$result = $this->db->query("select sum(cbm) as transferOut from productDetails where pStatus='transferout'");
		$ret = $result->row();
		return $ret->transferOut;
	}
	public function userlist()
	{
		$result = $this->db->query("SELECT * FROM `users` where type!='admin' ORDER BY `userId` DESC");
		return $result->result_array();
	}
	public function adduser($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	public function deleteuser($user_id)
	{
		$this->db->where('userId', $user_id);
        $this->db->delete('users');
	}
	public function updateuser($data =  array(),$userId)
	{
		$this->db->where('userId', $userId);
        $this->db->update('users', $data);
	}
	public function getUserbyId($user_id)
	{
		$result = $this->db->query("SELECT * FROM `users` where userId='".$user_id."'");
		return $result->result_array();
	}
	
	
	//new
	public function getCartOrders()
	{
		$query= $this->db->query('SELECT * FROM `cartDetails` WHERE `status`="Allocated" GROUP BY cartId DESC LIMIT 5');
		return $query->result_array();
	}
	
	public function rowcountfinal($productGroupId)
	{
		$month = date('m');
		if($month == 01 || $month == 02 || $month == 03)
		{
			$nndate = date('Y-04-01 00:00:00', strtotime('-1 year'));
			$nwdate  = date("Y-04-01 00:00:00");
			$query= $this->db->query('select C.cartDetailId,C.productGroupId, p.productGroupName as productGroupName,SUM(B.cbm) as finalcbm,DATE_FORMAT(C.shippedDate, "%b-%Y") as monthDate from cartDetails C inner join productGroup p on C.productGroupId=p.productGroupId inner join productDetails B on B.bundleId=C.bundleId WHERE C.status = "Sold" AND YEAR(C.shippedDate) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) and C.productGroupId="'.$productGroupId.'" and C.dateModified BETWEEN "'.$nndate.'" AND "'.$nwdate.'" GROUP BY DATE_FORMAT(C.shippedDate, "%m-%Y")');
		}
		else
		{
			$nndate = date("Y-04-01 00:00:00");
			$nwdate = date('Y-04-01 00:00:00', strtotime('+1 year'));
			$query= $this->db->query('select C.cartDetailId,C.productGroupId, p.productGroupName as productGroupName,SUM(B.cbm) as finalcbm,DATE_FORMAT(C.shippedDate, "%b-%Y") as monthDate from cartDetails C inner join productGroup p on C.productGroupId=p.productGroupId inner join productDetails B on B.bundleId=C.bundleId WHERE C.status = "Sold" AND YEAR(C.shippedDate) = YEAR(CURDATE()) and C.productGroupId="'.$productGroupId.'" and C.dateModified BETWEEN "'.$nndate.'" AND "'.$nwdate.'" GROUP BY DATE_FORMAT(C.shippedDate, "%m-%Y")');
		}
		
		//$query= $this->db->query('select C.cartDetailId,C.productGroupId, p.productGroupName as productGroupName,SUM(B.cbm) as finalcbm,DATE_FORMAT(C.invoiceDate, "%b-%Y") as monthDate from cartDetails C inner join productGroup p on C.productGroupId=p.productGroupId inner join productDetails B on B.bundleId=C.bundleId WHERE C.status = "Sold" AND YEAR(C.invoiceDate) = YEAR(CURDATE()) and C.productGroupId="'.$productGroupId.'" GROUP BY DATE_FORMAT(C.invoiceDate, "%m-%Y")');
		
		
		
		return $query->result_array();
	}
	function globalMode()
	{
		$query = $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
	}
}



?>