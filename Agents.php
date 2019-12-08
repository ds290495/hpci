<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->database();
        if ($this->session->userdata("iUserId") == "" && $this->session->userdata("userType") == "user") {
            $this->session->set_flashdata("flashError", '<div class="alert alert-danger alert-dismissable" id="msg" ><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>&nbsp; Error. Please Login First to Access Admin Panel!</div>');
            redirect("login");
        }
        $this->load->model('User_model');
        $this->load->model('Distributor_model');
        $this->load->model('Login_model');
        $this->load->model('Log_model');
		$this->load->model('Agent_model');
    }

    public function index() {
        if ($this->session->userdata("iUserId") == "") {
            redirect('login');
        } else {
            $data = array();
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('agents');
            $this->load->view('footer');
        }
    }

//get user list for user tab

    public function getAgents() {
        if ($this->session->userdata("iUserId") == "") {
            redirect('login');
        } else {
            $requestField = $_REQUEST;
            $start = $requestField['start'];
            $end = $requestField['length'];
            $searchValue = $requestField['search']['value'];
            $ordercolumn = isset($requestField['order']) ? $requestField['order'][0]['column'] : '';
            $orderdir = isset($requestField['order']) ? $requestField['order'][0]['dir'] : '';
            $searchQuery = '';
            $sqlRec = 'order by iAgentId desc';
            if ($searchValue != '') {
            $searchQuery = " and (vName like '%" . $searchValue . "%' or 
			vEmail like '%" . trim($searchValue) . "%'or 
			vMobile like '%" . trim($searchValue) . "%' or 
			city.city like '%" . trim($searchValue) . "%' or 
        	state.state like '%" . trim($searchValue) . "%' or  vMobile like '%" . trim($searchValue) . "%'  
         ) ";
            }

            $columns = array(
// datatable column index  => database column name
                0 => 'vName',
				1 => 'vEmail',
                2 => 'vMobile',
				3 => 'stateName',
                4 => 'cityName'
            );
            if (!empty($ordercolumn) || !empty($orderdir)) {
                $sqlRec = "ORDER BY " . $columns[$ordercolumn] . "   " . $orderdir . "";
            }
            $result = $this->Agent_model->agentList($start, $end, $searchQuery, $sqlRec);
            $count = $this->Agent_model->agentListCount($start, $end, $searchQuery, $sqlRec);
            $final = array();
            if (!empty($result)) {
                foreach ($result as $user) {
                    $row = array();
                    $row[] = $user->vName;
					$row[] = $user->vEmail;
                    $row[] = $user->vMobile;
					$row[] = $user->stateName;
                    $row[] = $user->cityName;
					$row[] = '<div><a  href="' . base_url() . 'Agents/editAgent/' . base64_encode($user->iAgentId) . '"><span class="fa fa-pencil-square-o"></span></a>&nbsp;&nbsp;&nbsp; <a  onclick="return deleteAgentModel(' . $user->iAgentId . ');"><span class="fa fa-trash"  onclick="return deleteAgentModel(' . $user->iAgentId . ');"></span></a></div>
					
								<div class="modal fade" id="basic_' . $user->iAgentId . '" tabindex="-1" role="basic" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Confirm?</h4>
                                                </div>
                                                <div class="modal-body"> Are you sure you want delete the agent?</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn green" onclick="return deleteAgent(' . $user->iAgentId . ');">OK</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>';
                    $final[] = $row;

                }
            }
            $results = array(
                "sEcho" => intval($_GET['draw']),
                "iTotalRecords" => $count,
                "iTotalDisplayRecords" => $count,
                "aaData" => $final
            );
            echo json_encode($results);
        }
    }

	public function addAgent() {
        if ($this->session->userdata("iUserId") == "") {
            redirect('login');
        } else {
            if (!empty($_POST)) {
				
                // $whereCondition = 'where vName="' . trim($this->input->post('vName')) . '"';
                // $result = $this->User_model->getRow('agents', $whereCondition);
                // if (!empty($result)) {
                    // $response = array('response' => 'fail', 'responseMsg' => 'Agent already exist.');
                    // echo json_encode($response);
                    // exit;
                // }
				
				$whereCondition = 'where vMobile="' . ltrim($this->input->post('vMobile'),'0') . '"';
                $result = $this->User_model->getRow('agents', $whereCondition);
                if (!empty($result)) {
                    $response = array('response' => 'fail', 'responseMsg' => 'Mobile no. already exist.');
                    echo json_encode($response);
                    exit;
                }
				$whereCondition = 'where vEmail="' . trim($this->input->post('vEmail')) . '"  and "' . !empty($this->input->post('vEmail')) .  '"';
                $result = $this->User_model->getRow('agents', $whereCondition);
                if (!empty($result)) {
                    $response = array('response' => 'fail', 'responseMsg' => 'Email already exist.');
                    echo json_encode($response);
                    exit;
                }else {

                    $insertData = array(
                        'vName' => trim($this->input->post('vName')),
						'vEmail' => trim($this->input->post('vEmail')),
                        'iStateId' => trim($this->input->post('iStateId')),
						'iCityId' => trim($this->input->post('iCityId')),
						'vMobile' => trim($this->input->post('vMobile')),
						'tAddress' => trim($this->input->post('tAddress')),
						'vLandline' => trim($this->input->post('vLandline')),
                        'vPincode' => trim($this->input->post('vPincode')),
						'eAgentType' => trim($this->input->post('eAgentType')),
						'iCommission' => trim($this->input->post('iCommission')),
						'lContactperson' => json_encode($_POST['lContactperson']),
                        'dtCreatedAt' => date("Y-m-d H:i:s"),
                        'dtUpdatedAt' => date("Y-m-d H:i:s")
                    );
                    $this->User_model->addData('agents', $insertData);
                    $this->session->set_flashdata("flashSuccess", '<div class="alert alert-success alert-dismissable" id="msg"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Agent added successfully.</div>');
                    $response = array('response' => 'success', 'responseMsg' => 'Agent added successfully.');
                    echo json_encode($response);
                    exit;
                }
                exit;
            } else {

                $user['loginUser'] = $this->Login_model->login('iUserId="' . $this->session->userdata("iUserId") . '"');
                $user['stateList'] = $this->Distributor_model->getState();
				$user['cityList'] = $this->Distributor_model->getCity();
                $this->load->view('header');
                $this->load->view('sidebar');
                $this->load->view('add_agent', $user);
                $this->load->view('footer');
            }
        }
    }

//edit user by admin
    public function editAgent($id) {
        $iAgentId = base64_decode($id);
        if ($this->session->userdata("iUserId") == "") {
            redirect('login');
        } else {
            if (!empty($_POST)) {
                $whereCondition = 'where iAgentId ="' . $iAgentId . '"';
                $result = $this->User_model->getRow('agents', $whereCondition);
                if (empty($result)) {
                    $response = array('response' => 'fail', 'responseMsg' => 'Invalid URL');
                    echo json_encode($response);
                    exit;
                }
				
				
				$whereCondition = 'where vMobile="' . ltrim($this->input->post('vMobile'),'0') . '" and  iAgentId !="' . $iAgentId . '"';
                $result = $this->User_model->getRow('agents', $whereCondition);
                if (!empty($result)) {
                    $response = array('response' => 'fail', 'responseMsg' => 'Mobile no. already exist.');
                    echo json_encode($response);
                    exit;
                }
				
				// $whereCondition = 'where vName="' . trim($this->input->post('vName')) . '" and  iAgentId !="' . $iAgentId . '"';
                // $result = $this->User_model->getRow('agents', $whereCondition);
                // if (!empty($result)) {
                    // $response = array('response' => 'fail', 'responseMsg' => 'Agent already exist.');
                    // echo json_encode($response);
                    // exit;
                // }
				$whereCondition = 'where vEmail="' . trim($this->input->post('vEmail')) . '" and  iAgentId !="' . $iAgentId .  '" and "' . !empty($this->input->post('vEmail')) .  '"';
                $result = $this->User_model->getRow('agents', $whereCondition);
                if (!empty($result)) {
                    $response = array('response' => 'fail', 'responseMsg' => 'Email already exist.');
                    echo json_encode($response);
                    exit;
                } 
				else {
					$contactdata ="";
					if(isset($_POST['lContactperson'])){
					$_POST['lContactpersonData']=array();
					foreach($_POST['lContactperson'] as $key => $contactdata)
					{
						if((!empty($contactdata['name'])) && ($contactdata['email']!='') && ($contactdata['mobile']!=''))
						{
							$_POST['lContactpersonData'][$key]=$contactdata;
						}
						
					}
					$contactdata = (!empty($_POST['lContactpersonData']))?json_encode($_POST['lContactpersonData']):'';
					}
					
                    $postData = array(
                        'vName' => trim($this->input->post('vName')),
						'vEmail' => trim($this->input->post('vEmail')),
                        'iStateId' => trim($this->input->post('iStateId')),
						'iCityId' => trim($this->input->post('iCityId')),
						'vMobile' => trim($this->input->post('vMobile')),
						'vLandline' => trim($this->input->post('vLandline')),
                        'vPincode' => trim($this->input->post('vPincode')),
						'eAgentType' => trim($this->input->post('eAgentType')),
						'iCommission' => trim($this->input->post('iCommission')),
						'tAddress' => trim($this->input->post('tAddress')),
						'lContactperson' => $contactdata,
                        'dtUpdatedAt' => date("Y-m-d H:i:s"));
                    $this->User_model->editData($postData, 'iAgentId', $iAgentId, 'agents');
                    $this->session->set_flashdata("flashSuccess", '<div class="alert alert-success alert-dismissable" id="msg"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Agent updated successfully.</div>');
                    $response = array('response' => 'success', 'responseMsg' => 'Agent updated successfully.');
                    echo json_encode($response);
                    exit;
                }
            } else {
                $whereCondition = 'where iAgentId="' . $iAgentId . '"';
                $result = $this->User_model->getRow('agents', $whereCondition);
                if (empty($result)) {
                    redirect('login');
                } else {
                    $data['stateList'] = $this->Distributor_model->getState();
					$data['cityList'] = $this->Distributor_model->getCity();
                    $data['result'] = $result;
                    $this->load->view('header');
                    $this->load->view('sidebar');
                    $this->load->view('edit_agent', $data);
                    $this->load->view('footer');
                }
            }
        }
    }

//deleteAgent
    public function deleteAgent($id) {
        $result = $this->User_model->deleteData('agents', 'iAgentId', $id);
        echo $result;
    }
	public function getCities(){
		$iStateId = $_POST['iStateId'];
		$cityName =(empty($_POST['iCityId']))?'':$_POST['iCityId'];
		$results = $this->Distributor_model->getCityById($iStateId);
		foreach ($results as $city) {
        ?>
		<option <?php echo($cityName == $city["iCityId"])?'selected':''; ?> value="<?php echo $city["iCityId"]; ?>"><?php echo $city["city"]; ?></option>
		<?php
		}
	}

}
