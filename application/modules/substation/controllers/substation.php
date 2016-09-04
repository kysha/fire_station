<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Substation extends MY_Controller {

 	public function index()
	{
        $this->loadPage("substation/substation", "substation/substation_script", array("activeHeaders"=>"Contacts"));
	}
}