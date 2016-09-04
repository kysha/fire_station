<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Contacts extends MY_Controller {

 	public function index()
	{
        $this->loadPage("contacts/contacts", "contacts/contacts_script", array("activeHeaders"=>"Contacts"));
	}
}