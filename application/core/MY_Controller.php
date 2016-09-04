<?php

class MY_Controller extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    public function loadPage($bodyLink, $bodyScriptLink = false, $data = array()){
       $this->load->view("home/header", $data);
       $this->load->view($bodyLink);
       $this->load->view("home/footer");
       if($bodyScriptLink){
        $this->load->view($bodyScriptLink);
       }
    }
}