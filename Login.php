<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');

        $this->load->model('Login_model');
        $this->load->model('Log_model');
    }

    public function index() {

        $this->load->view('login');
    }

    public function doLogin() {
        if (!empty($_POST)) {
            $whereCondition = 'vEmail="' . $_POST['vEmail'] . '" and vPassword="' . md5($_POST['vPassword']) . '"';
            $result = $this->Login_model->login($whereCondition);
            if (empty($result)) {
               
				$response = array('response' => 'flashError1', 'responseMsg' => 'Incorrect Email or Password.');
                echo json_encode($response);
                exit;
            } else {
                $this->session->set_userdata("iUserId", $result->iUserId);
                $this->session->set_userdata("vEmail", $result->vEmail);
                $this->session->set_userdata("vUserName", $result->vUserName);
                $this->session->set_userdata("eUserType", $result->eUserType);
               // $this->session->set_flashdata("flashSuccess", '<div class="alert alert-success alert-dismissable" id="msg"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>&nbsp;Login Success. Welcome to Mehta Garments Admin Panel!</div>');
                $response = array('response' => 'success', 'responseMsg' => 'Login Success. Welcome to Mehta garments Admin Panel!');
                echo json_encode($response);
                exit;
            }
        } else {
            redirect('login');
        }
        exit;
    }

    public function logout() {
        if ($this->session->userdata('iUserId') != "") {
            $this->session->unset_userdata("iUserId");
            $this->session->unset_userdata("vEmail");
            $this->session->unset_userdata("vUserName");
            $this->session->unset_userdata("eUserType");
        }
        $this->session->set_flashdata("flashSuccess", '<div class="alert alert-success alert-dismissable" id="msg" ><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> Logout Successfully!</div>');
        redirect("login");
    }

    public function random_string($length = 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $name = substr(str_shuffle($chars), 0, $length);
        return $name;
    }

    public function forgetPassword() {
        $this->load->view('forget_password');
    }

    public function sentResetLink() {
		
        $whereCondition = 'vEmail="' . $_POST['vEmail'] . '"';
        $result = $this->Login_model->login($whereCondition);
		
		
		
        if (empty($result)) {
            $response = array('response' => 'flashError', 'responseMsg' => 'Incorrect Email.');
			echo json_encode($response);
			exit;
        } else {
			
            $verificationLink = base_url() . "reset-password/" . base64_encode($result->iUserId);
            $data['name'] = $result->vUserName;
            $data['link'] = $verificationLink;
            $body = $this->load->view('reset_email', $data, true);
            $this->Log_model->sendMail(trim($result->vEmail), 'Reset Password Link', $body);
			$userId = $result->iUserId;
				$data['updateDetails'] = array(
					'pFlag' => 0,
					'pTimestamp' => date("Y-m-d H:i:s")
				);
			$flagUpdate =  $this->Login_model->passwordFlagUpdateDetails($userId,$data);
            $response = array('response' => 'flashSuccess', 'responseMsg' => 'Email sent successfully.');
			echo json_encode($response);
			exit;
        }
        exit;
    }

    public function resetPassword($id) {
        $iUserId = base64_decode($id);

        $this->session->set_flashdata("flashSuccess", '');
        $this->session->set_flashdata("flashError", '');
        if (!empty($_POST)) {
			//print_r($this->input->post('vNewPwd'));exit;
            $whereCondition = 'iUserId ="' . $iUserId . '"';
            $result = $this->Login_model->login($whereCondition);
            if (empty($result)) {
                echo '0';
                exit;
            } else {
                $insertData = array(
                    'vPassword' => md5($this->input->post('vNewPwd')),
					'pFlag' => 1,
                    'dtUpdatedAt' => date("Y-m-d H:i:s")
                );
                $this->Login_model->editUserData($insertData, $iUserId);
				
                // $userId = $result->iUserId;
				// $data['updateDetails'] = array(
					// 'pFlag' => 1
				// );
				// $flagUpdate =  $this->Login_model->passwordFlagUpdateDetails($userId,$data);
                echo '1';
            }
            exit;
        } else {
			$whereCondition = 'iUserId ="' . $iUserId . '"';
            $result = $this->Login_model->login($whereCondition);
			$storeDateTime = $result->pTimestamp;	
			$t1 = strtotime(date('Y-m-d H:i:s'));
			$t2 = strtotime($storeDateTime);
			$diff = $t1 - $t2;
			$hours = $diff / ( 60 * 60 );
			//echo $hours ;
			if(($result->pFlag == 1) || ($hours > 0.50)){

				$this->load->view('blank_page');
			}else{
				$this->load->view('reset_password');
				
			}
        }
    }

    public function thankYou() {
        $this->session->set_flashdata("flashError", '');
        $this->session->set_flashdata("flashSuccess", '');
        $this->session->set_flashdata("flashSuccess", '<div id="msg" >Password change successfully!</div>');
        $this->load->view('thankyou');
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
