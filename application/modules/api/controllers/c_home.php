 <?php if ( ! defined('BASEPATH'))exit('No direct script access allowed');
 

class C_home extends API_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->model("m_home");
    }

    public function index()
    {
    	die("died");
    }

    /*kesh*/
    public function listsuggest(){
        $data = $this->m_home->suggestLog($this->input->post("brgy_name"),$this->input->post("select"),$this->input->post("from"));
        if ($data){
            $this->responseData($data);
        } else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    /*end*/
    public function retrieveBarangayInfo() {
        $result = $this->m_home->retrieveBarangayInfo(
            $this->input->post("barangayName"));
        if ($result){
            $this->responseData($result);
        } else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    public function retrieveStationInfo() {
        $result = $this->m_home->retrieveStationInfo(
            $this->input->post("stationId"));
        if ($result){
            $this->responseData($result);
        } else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }

}
