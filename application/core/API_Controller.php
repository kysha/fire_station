<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH.'/libraries/REST_Controller.php';

class API_Controller extends MX_Controller {

    public $response = array(
        "data" => false,
        "error" => array()
    );

	function __construct() {
		parent::__construct();
	}

    public function responseError($status, $message){
        $this->response["error"][] = array("status" => $status, "message" => $message);
    }
    /**
     * Add a data to response of the API request
     * @param object $data The data to be added to the response
     */
    public function responseData($data){
        $this->response["data"] = $data;
        // var_dump($this->response["data"]);
        // die();
    }
    /**
     * Add the total result count when there is no limit in the query
     * @param type $count
     */
    /**
     * Echo the response of an API request and end the process
     */
    public function outputResponse(){
        echo json_encode($this->response);
        //exit();
    }

}