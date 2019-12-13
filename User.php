<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('User_Model');
		$this->load->model('Product_Model');
		//$this->load->library('email'); 
	}
	public function index()
	{
		$result = $this->User_Model->globalMode();
		$this->load->helper('form');
		$this->load->view('login_form');	
	}
	public function dashboard()
	{
		$data = array('email' => $this->input->post('email'),
		'password' => md5($this->input->post('password'))
		);
		$result = $this->User_Model->login($data);
		if($this->session->userdata('admin_id')!= ""){
			$this->session->unset_userdata('admin_id');
		}
		if($this->session->userdata('warehouse_id')!= ""){
			$this->session->unset_userdata('warehouse_id');
		}
		if($this->session->userdata('sales_id')!= ""){
			$this->session->unset_userdata('sales_id');
		}
		if ($result == TRUE) {
			if($result[0]['type']=='admin')
			{
				$this->session->set_userdata('admin_id',$result[0]['userId']);
				$this->session->set_userdata('admin',$result[0]['type']);
				$this->session->set_userdata('firstName',$result[0]['firstName']);
				$this->session->set_userdata('lastName',$result[0]['lastName']);
				$this->session->set_userdata('email',$result[0]['email']);
				redirect('user/home');
			}
			else if($result[0]['type']=='sales')
			{
				$this->session->set_userdata('sales_id',$result[0]['userId']);
				$this->session->set_userdata('sales',$result[0]['type']);
				$this->session->set_userdata('firstName',$result[0]['firstName']);
				$this->session->set_userdata('lastName',$result[0]['lastName']);
				$this->session->set_userdata('email',$result[0]['email']);
				redirect('user/home');
			}
			else if($result[0]['type']=='warehouse')
			{
				$this->session->set_userdata('warehouse_id',$result[0]['userId']);
				$this->session->set_userdata('warehouse',$result[0]['type']);
				$this->session->set_userdata('firstName',$result[0]['firstName']);
				$this->session->set_userdata('lastName',$result[0]['lastName']);
				$this->session->set_userdata('email',$result[0]['email']);
				redirect('user/home');
			}
		}
		
		else
		{
			$data = array('error_message' => 'Invalid email or password');
			$this->load->view('login_form', $data);
		}
	}
	public function home()
	{
		if(($this->session->userdata('admin_id')!= "") || ($this->session->userdata('warehouse_id')!= "") || ($this->session->userdata('sales_id')!= "")){
			$data['cart_orders'] = $this->User_Model->getCartOrders();
			
			if(isset($_GET['ship_start']) && isset($_GET['ship_end']))
			{
				$data['totalturnover'] = $this->Product_Model->totalturnoverrange($_GET['ship_start'],$_GET['ship_end']);
				$data['turnovers'] = $this->Product_Model->turnoversrange($_GET['ship_start'],$_GET['ship_end']);
			}
			
			else
			{
				$data['totalturnover'] = $this->Product_Model->totalturnover();
				$data['turnovers'] = $this->Product_Model->turnovers();
			}
			
			if(isset($_GET['closing_start']) && isset($_GET['closing_end']))
			{
				
				$data['totalClosingStocks'] = $this->Product_Model->totalClosingStocksrange($_GET['closing_start'],$_GET['closing_end']);
				$data['closingStocks'] = $this->Product_Model->closingStocksrange($_GET['closing_start'],$_GET['closing_end']);
			}
			else
			{
				
				$data['totalClosingStocks'] = $this->Product_Model->totalClosingStocks();
				$data['closingStocks'] = $this->Product_Model->closingStocks();
			}
			
			
			$salesTrendsGroups = $this->Product_Model->salesTrendsGroups();
			
			 
			$salesTrendsArray = array();
			
			$i=0;
			foreach($salesTrendsGroups as $salesTrendsGroup)
			{
				$salesTrends = $this->Product_Model->salesTrends($salesTrendsGroup['productGroupId']);
				
				
				if(count($salesTrends) == 1)
				{
					$salesTrendsArray[] = $salesTrends[0];
					
				}

				if(count($salesTrends) > 1)
				{
					$salesTrendArray = array();
					
					$salesTrendArray['productGroupName'] = $salesTrends[0]['productGroupName'];
					
						
				 
					/*foreach($salesTrends as $salesTrend)
					{ 
						print_r($salesTrend);
					
					}*/
					
					$finalcbmArray = array();
					$monthDateArray = array();
					
					foreach ($salesTrends as  $key => $val) {
						 
						$finalcbmArray[] = $val['finalcbm'];
						$monthDateArray[] = $val['monthDate'];
						 
					}	
					$finalcbmArray = implode(',', $finalcbmArray);
					$monthDateArray = implode(',', $monthDateArray);
					
					$salesTrendArray['finalcbm'] = $finalcbmArray; 
					$salesTrendArray['monthDate'] = $monthDateArray;

					
					$salesTrendsArray[] = $salesTrendArray;
						
					
					
					 
				}
				
				 
			}
			
			//print_r($salesTrendsArray);
			 
			$data['salesTrends'] = $salesTrendsArray;
			
			$data['salesTrendsNew'] = $this->Product_Model->salesTrendsNew();
			 
			
			
			
			if(isset($_GET['warehouse_start']) && isset($_GET['warehouse_end']))
			{
				$data['totalWarehouseInventory'] = $this->Product_Model->totalWarehouseInventoryrange($_GET['warehouse_start'],$_GET['warehouse_end']);
				$warehouseInventoryTotal = $this->Product_Model->warehouseInventoryTotalrange($_GET['warehouse_start'],$_GET['warehouse_end']);
				
				$data['warehouseInventorys'] = $this->Product_Model->warehouseInventoryrange($_GET['warehouse_start'],$_GET['warehouse_end']);
			}
			else
			{
				$data['totalWarehouseInventory'] = $this->Product_Model->totalWarehouseInventory();
				$warehouseInventoryTotal = $this->Product_Model->warehouseInventoryTotal();
				
				$data['warehouseInventorys'] = $this->Product_Model->warehouseInventory();
			}
			
			if(isset($_GET['movement_start']) && isset($_GET['movement_end']))
			{
				// $data['totalStockMovement'] = $this->Product_Model->totalStockMovementrange($_GET['movement_start'],$_GET['movement_end']);
				// $stockMovementTotal = $this->Product_Model->stockMovementTotalrange($_GET['movement_start'],$_GET['movement_end']);
				
				// $data['stockmovements'] = $this->Product_Model->stockMovementrange($_GET['movement_start'],$_GET['movement_end']);
				
				$data['stockmovements'] = $this->Product_Model->stockmovementsRange($_GET['movement_start'],$_GET['movement_end']);
				$data['stockmovementsTotal'] = $this->Product_Model->stockmovementsTotalRange($_GET['movement_start'],$_GET['movement_end']);
			}
			else
			{
				//$data['totalStockMovement'] = $this->Product_Model->totalStockMovement();
				$data['stockmovements'] = $this->Product_Model->stockmovements();
				$data['stockmovementsTotal'] = $this->Product_Model->stockmovementsTotal();
			}
			
			
			
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('home',$data);
			$this->load->view('footer');
			
		}
		else
		{
			$this->load->view('login_form');
		}
		//$data['cart_orders'] = $this->User_Model->getCartOrders();
		//$this->load->view('home',$data);
		
	}
	public function logout()
	{
		if($this->session->userdata('admin_id')!= "")
		{
			$this->session->unset_userdata('admin_id');
			$this->load->view('login_form');
		}
		else if($this->session->userdata('warehouse_id')!= "")
		{
			$this->session->unset_userdata('warehouse_id');
			$this->load->view('login_form');
		}
		else if($this->session->userdata('sales_id')!= "")
		{
			$this->session->unset_userdata('sales_id');
			$this->load->view('login_form');
		}
	}
	public function forgot_password()
	{
		$this->load->view('forgotpassword');
	}
	public function forgotpassword()
	{
		$this->load->library('email');
		$rows = $this->User_Model->emailvalidate($this->input->post('email'));
		if($rows > 0)
		{
			
			 $from_email = "test@finitesting.com"; 
			 $to_email = $this->input->post('email'); 
			
			 //Load email library 
			 /*$this->load->library('email'); 
			$txt = "<br>";
			$txt.="<html>
				<head></head><body> We recently received a request to change your password for Euroleaf account.<br/> 
				To change your password, please click on the link below.<br/>
				<a href='".base_url()."user/reset_password/".$this->input->post('email')."' target='_blank'>Click here</a> .<br>
									<br>";
								
			$txt.="Thank You,<br>
						</body></html>";
			 $this->email->from($from_email, 'Your Name', $from_email); 
			 $this->email->to($to_email);
			 $this->email->subject('Email Test'); 
			 $this->email->message($txt); 
			 $this->email->send();
			 //Send mail 
			 if($this->email->send()) 
				 echo 'Email sent successfully';
			 //$this->session->set_flashdata("flashSuccess","Email sent successfully."); 
			 else 
				 //echo $this->email->print_debugger(); 
				 echo 'Error in sending Email';
			 //$this->session->set_flashdata("flashError","Error in sending Email."); 
			 //$this->load->view('email_form'); 
			 exit;*/
			
			$txt = "<br>";
					$txt.="<html>
    <head></head><body> We recently received a request to change your password for euroleaf.<br/> 
	To change your password, please click on the link below.<br/>
	<a href='".base_url()."user/reset_password/".$this->input->post('email')."' target='_blank'>Click here</a> .<br>
						<br>";
					
			$txt.="Thank You,<br>
			</body></html>";
		
			$from_email         = 'test@finitesting.com'; //from mail, it is mandatory with some hosts
			$recipient_email    = $this->input->post('email'); //recipient email (most cases it is your personal email)
			$from_name='Euroleaf';
			//Capture POST data from HTML form and Sanitize them,
			$sender_name    = filter_var('Euroleaf', FILTER_SANITIZE_STRING); //sender name
			$reply_to_email = filter_var('test@finitesting.com', FILTER_SANITIZE_STRING); //sender email used in "reply-to" header
			$subject        = filter_var('Password Reset', FILTER_SANITIZE_STRING); //get subject from HTML form
			$message        = filter_var($txt, FILTER_SANITIZE_STRING); //message
	   
		
		
		

		
		

			$boundary = md5("sanwebe");
			//header
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From: ". $from_name . " <" . $from_email . ">\r\n";
			$headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
			$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
		   
			//plain text
			$body = "--$boundary\r\n";
			$body .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
			$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
			$body .= chunk_split(base64_encode($txt));
		   
			

			$sentMail = @mail($recipient_email, $subject, $body, $headers);
			$this->session->set_flashdata('flashSuccess', 'Please check your email to reset password!');
			redirect('user/forgot_password');
		}
		else{
			$this->session->set_flashdata('flashError', 'Entered mail does not exist!');
			redirect('user/forgot_password');
		}
	}
	public function reset_password($email)
	{
		$this->session->set_userdata('validateemail',$email);
		$data['validateemail'] = $this->session->userdata('validateemail');
		$this->load->view('reset_password',$data);
	}
	public function resetPassword()
	{
		$this->load->library('email'); 
		$data['result']=$this->User_Model->ResetPassword($this->input->post('newpassword'),$this->input->post('validateemail'));
		$this->session->unset_userdata('validateemail');
		$txt = "<br>";
	$txt.="<html>
<head></head><body>You have reset your password successfully at <a href='".base_url()."'>".base_url()."</a><br/>Your new password is : 
".$this->input->post('newpassword')."<br>
		<br>
		<br>";
	
		$txt.="Thank You,<br>
		</body></html>";
	
		$from_email         = 'test@finitesting.com'; //from mail, it is mandatory with some hosts
		$recipient_email    = $this->input->post('validateemail'); //recipient email (most cases it is your personal email)
   
		//Capture POST data from HTML form and Sanitize them,
		$sender_name    = filter_var('Euroleaf', FILTER_SANITIZE_STRING); //sender name
		$reply_to_email = filter_var('test@finitesting.com', FILTER_SANITIZE_STRING); //sender email used in "reply-to" header
		$subject        = filter_var('Updated Password', FILTER_SANITIZE_STRING); //get subject from HTML form
		$message        = filter_var($txt, FILTER_SANITIZE_STRING); //message
		$boundary = md5("sanwebe");
		//header
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From:".$from_email."\r\n";
		$headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
	   
		//plain text
		$body = "--$boundary\r\n";
		$body .= "Content-Type: text/html; charset=\"utf-8\"\r\n";
		$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
		$body .= chunk_split(base64_encode($txt));
	   
		

		$sentMail = @mail($recipient_email, $subject, $body, $headers);
		$this->session->set_flashdata('flashSuccess', 'You have changed password successfully! Please try to login now!');
		redirect('user');
	}
	public function viewprofile()
	{
		if($this->session->userdata('admin_id')!= ""){
			$data['profile']=$this->User_Model->viewprofile($this->session->userdata('admin_id'));
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('viewprofile',$data);
			$this->load->view('footer');
		}
		else if($this->session->userdata('warehouse_id')!= ""){
			$data['profile']=$this->User_Model->viewprofile($this->session->userdata('warehouse_id'));
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('viewprofile',$data);
			$this->load->view('footer');
		}
		else if($this->session->userdata('sales_id')!= ""){
			$data['profile']=$this->User_Model->viewprofile($this->session->userdata('sales_id'));
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('viewprofile',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect('login_form');	
		}
	}
	public function editprofile()
	{
		if($this->session->userdata('admin_id')!= ""){
			$data = array('firstName' => $this->input->post('firstname'),
						'lastName' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'dateModified' => date("Y-m-d H:i:s")
					);
			$this->User_Model->editprofile($data,$this->session->userdata('admin_id'));
			$this->session->set_flashdata('flashSuccess', 'Your profile is updated successfully!');
			redirect('user/viewprofile');
		}
		else if($this->session->userdata('warehouse_id')!= ""){
			$data = array('firstName' => $this->input->post('firstname'),
						'lastName' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'dateModified' => date("Y-m-d H:i:s")
					);
			$this->User_Model->editprofile($data,$this->session->userdata('warehouse_id'));
			$this->session->set_flashdata('flashSuccess', 'Your profile is updated successfully!');
			redirect('user/viewprofile');
		}
		else if($this->session->userdata('sales_id')!= ""){
			$data = array('firstName' => $this->input->post('firstname'),
						'lastName' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'dateModified' => date("Y-m-d H:i:s")
					);
			$this->User_Model->editprofile($data,$this->session->userdata('sales_id'));
			$this->session->set_flashdata('flashSuccess', 'Your profile is updated successfully!');
			redirect('user/viewprofile');
		}
		else
		{
			redirect('login_form');	
		}
	}
	public function editpassword()
	{
		
		 
		
		if($this->session->userdata('admin_id')!= ""){
			
			 
			$oldpassword = md5($this->input->post('oldpassword'));
			$checkPassword = $this->User_Model->checkPassword($oldpassword,$this->session->userdata('admin_id'));
			if($checkPassword == TRUE)
			{
				$data = array('password' => md5($this->input->post('newpassword')),
						'dateModified' => date("Y-m-d H:i:s")
					);
				$this->User_Model->newPassword($data,$this->session->userdata('admin_id'));
				$this->session->set_flashdata('flashSuccess', 'Your password is updated successfully!');
				redirect('user/viewprofile');	
			}
			else{
				$this->session->set_flashdata('flashError', 'Old password does not match!');
				redirect('user/viewprofile');
			}
		}
		else if($this->session->userdata('warehouse_id')!= ""){
			
			 
			$oldpassword = md5($this->input->post('oldpassword'));
			$checkPassword = $this->User_Model->checkPassword($oldpassword,$this->session->userdata('warehouse_id'));
			if($checkPassword == TRUE)
			{
				$data = array('password' => md5($this->input->post('newpassword')),
						'dateModified' => date("Y-m-d H:i:s")
					);
				$this->User_Model->newPassword($data,$this->session->userdata('warehouse_id'));
				$this->session->set_flashdata('flashSuccess', 'Your password is updated successfully!');
				redirect('user/viewprofile');	
			}
			else{
				$this->session->set_flashdata('flashError', 'Old password does not match!');
				redirect('user/viewprofile');
			}
		}
		else if($this->session->userdata('sales_id')!= ""){
			 
			$oldpassword = md5($this->input->post('oldpassword'));
			$checkPassword = $this->User_Model->checkPassword($oldpassword,$this->session->userdata('sales_id'));
			 
			if($checkPassword == TRUE)
			{
				$data = array('password' => md5($this->input->post('newpassword')),
						'dateModified' => date("Y-m-d H:i:s")
					);
				$this->User_Model->newPassword($data,$this->session->userdata('sales_id'));
				$this->session->set_flashdata('flashSuccess', 'Your password is updated successfully!');
				redirect('user/viewprofile');	
			}
			else{
				$this->session->set_flashdata('flashError', 'Old password does not match!');
				redirect('user/viewprofile');
			}
		}
		else
		{
			redirect('login_form');	
		}
	}
	public function checkEmail($ce_id)
	{
		$checkemail = $this->User_Model->checkEmail($this->input->post('email'),$ce_id);
		echo $checkemail;
	}
	public function emailaval()
	{
		$emailaval = $this->User_Model->emailaval($this->input->post('email'));
		echo $emailaval;
	}
	public function users()
	{
		if($this->session->userdata('admin_id')!= "")
		{
			$data['users'] = $this->User_Model->userlist();
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('users',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login_form');
		}
	}
	public function adduser()
	{
		if($this->session->userdata('admin_id')!= "")
		{
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('adduser');
			$this->load->view('footer');
		}
		else{
			$this->load->view('login_form');
		}
	}
	public function useradd()
	{
		if($this->session->userdata('admin_id')!= "")
		{
			$data=array('firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'status' => $this->input->post('status'),
				'type' => $this->input->post('type'),
				'dateAdded' => date('Y-m-d H:i:s'),
				'dateModified' => date('Y-m-d H:i:s'));
				$userdetails = $this->User_Model->adduser($data);
				$this->session->set_flashdata('flashSuccess', 'User is added successfully!');
				redirect('users');
		}
		else{
			$this->load->view('login_form');
		}
	}
	public function deleteuser($user_id)
	{
		if($this->session->userdata('admin_id')!= "")
		{
			$this->User_Model->deleteuser($user_id);
			$this->session->set_flashdata('flashSuccess', 'One user is deleted successfully!');
			redirect('users');
		}
		else{
			$this->load->view('login_form');
		}
	}
	public function edituser($user_id)
	{
		if($this->session->userdata('admin_id')!= "")
		{
			$data['profile']= $this->User_Model->getUserbyId($user_id);	
			$this->load->view('sidebar');
			$this->load->view('header');
			$this->load->view('edituser',$data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('login_form');
		}
	}
	public function updateuser()
	{
		if($this->session->userdata('admin_id')!= "")
		{
			if($this->input->post('password'))
			{
				$data=array('firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'status' => $this->input->post('status'),
				'type' => $this->input->post('type'),
				'dateModified' => date('Y-m-d H:i:s'));
				$userdetails = $this->User_Model->updateuser($data,$this->input->post('userId'));
				$this->session->set_flashdata('flashSuccess', 'User is updated successfully!');
				redirect('users');
			}
			else
			{
				$data=array('firstName' => $this->input->post('firstname'),
				'lastName' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'status' => $this->input->post('status'),
				'type' => $this->input->post('type'),
				'dateModified' => date('Y-m-d H:i:s'));
				$userdetails = $this->User_Model->updateuser($data,$this->input->post('userId'));
				$this->session->set_flashdata('flashSuccess', 'User is updated successfully!');
				redirect('users');
			}
		}
		else{
			$this->load->view('login_form');
		}
	}
}
?>