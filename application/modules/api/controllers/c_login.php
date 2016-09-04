<?php if ( ! defined('BASEPATH'))exit('No direct script access allowed');


class C_login extends API_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("m_login");
    }
    public function index()
    {
    	die("died");
    }
    public function authenticate(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('','');
		if ($this->form_validation->run() == FALSE) {
			$error = array(
            "username" => form_error('username'),
            "password" => form_error('password')
        	);
			$this->responseError(2, $error);
		}
		else{
			$result = $this->m_login->authenticate($this->input->post("username"),$this->input->post("password"));
			if ($result){
				$session_data = array(
				    'username' => $this->input->post('username'),
				    'id' => $result['id']
				);
                $session_stat["is_loggedin"] = true;
                $this->session->set_userdata('log_stat',$session_stat);
				$this->session->set_userdata('logged_in', $session_data);
				$this->responseData($result);
			}
			else{
				$error = array(
	            	"incorrect" => "The username and password combination is incorrect."
	        	);
				$this->responseError(2, $error);
			}
		}
	    $this->outputResponse();
	}
	public function logout(){
        $session_stat["is_loggedin"] = false;
        $this->session->set_userdata('log_stat', $session_stat);
		$this->session->unset_userdata('logged_in', $session_data);
	}
}