<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Settings extends MY_Controller{
 
    public function index()
	{
        $this->loadPage("settings/settings", "settings/settings_script", array("activeHeaders"=>"Settings"));
	}
}
