<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    public function index()
	{
		$this->load->view('login/login');
		$this->load->view('login/login_script');
	}
    public function logout(){
        $session_stat["is_loggedin"] = false;
        $this->session->set_userdata('log_stat', $session_stat);
        header("location:".base_url());
    }
}
