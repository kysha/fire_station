<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class C_settings extends API_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("m_settings");
    }
    public function show_admin(){
        $data = array(
            "username" => $this->session->userdata["logged_in"]["username"],
            "id" => $this->session->userdata["logged_in"]["id"]
        );
        if($data){
            $this->responseData($data);
        }else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    public function check_oldpass($old_pass){
        $where = array("password"=>md5($old_pass));
        $data = $this->m_settings->retrieveField($where);
        if(empty($data)){
            $data = "Wrong Password!";
        }else{
            $data = "";
        }
        return $data;
    }
    public function check_uname($username){
        if($username != $this->session->userdata["logged_in"]["username"]) {
           $is_unique =  '|is_unique[account.username]';
        }else{
           $is_unique =  "";
        }
        return $is_unique;
    }
    public function check_pass($new_pass){
        if(!preg_match('#[0-9]#', $new_pass) && !preg_match('/[[:punct:]]/',$new_pass)){
            $is_valid = "Password must contain atleast 1 number and 1 special character.";
        }else if(!preg_match('/[[:punct:]]/',$new_pass)){
            $is_valid = "Password must contain atleast 1 special character.";
        }else if(!preg_match('#[0-9]#', $new_pass)){
            $is_valid = "Password must contain atleast 1 number.";
        }else{
            $is_valid = "";
        }
        return $is_valid;
    }
    public function edit_admin(){
        $id = $this->input->post("id");
        $username = $this->input->post("username");
        $old_pass = $this->input->post("old_pass");
        $new_pass = $this->input->post("new_pass");
        $confirm_pass = $this->input->post("confirm_pass");
        
        $is_unique = $this->check_uname($username);
        $old_pass_check = $this->check_oldpass($old_pass);
        $is_valid = $this->check_pass($new_pass);
        
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("username", 'Username', 'required'.$is_unique);
        $this->form_validation->set_rules("old_pass", 'Old Password', 'required');
        $this->form_validation->set_rules("new_pass", 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules("confirm_pass", 'Confirm Password', 'required|matches[new_pass]');
        
        if($this->form_validation->run() == FALSE || $old_pass_check!="" || $is_valid!=""){
            $data["errors"] = array(
                "username" =>form_error("username"),
                "old_pass" =>(form_error("old_pass")!="")?form_error("old_pass"):$old_pass_check,
                "new_pass" =>(form_error("new_pass")!="")?form_error("new_pass"):$is_valid,
                "confirm_pass" =>form_error("confirm_pass")
            );
        }else{
            $set = array(
                "username"=>$username,
                "password"=>md5($new_pass)
            );
            $where = array(
                "id"=>$this->session->userdata["logged_in"]["id"]
            );
            $data = $this->m_settings->editField($set,$where);
            if(!empty($data)){
                $session_data = array(
				    'username' => $username,
				    'id' => $id
				);
				$this->session->set_userdata('logged_in', $session_data);
            }
        }
        if($data){
            $this->responseData($data);
        }else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    
 }