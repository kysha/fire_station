<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Logs extends MY_Controller {
    
 	public function index()
	{
        $this->loadPage("logs/logs", "logs/logs_script", array("activeHeaders"=>"Logs"));
	}
    
}