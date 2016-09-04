 <?php if ( ! defined('BASEPATH'))exit('No direct script access allowed');
 

class C_substation extends API_Controller {
    public $perpage = 10;
    public function __construct() {
        parent::__construct();
        $this->load->model("m_substation");
    }

    public function index()
    {
        die("died");
    }
    public function count_cn(){
        $count = $this->m_substation->count($this->input->post("sub_name"));
        if(!empty($count)) 
        {
            $count = count($count);
        }
        $result['total_row'] = $count;
        $result['row_perpage'] =$this->perpage;
        
        if ($result){
            $this->responseData($result);
        } else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }

    public function retrieveContacts() {
        $ppage=$this->input->post('ppage');
        $current_page = $ppage;
        if($this->input->post("sub")==0){
            $sub = 0;
        }else{
            $sub = 1;
        }
        $result = $this->m_substation->retrieveContacts($this->input->post("sub_name"),$this->perpage,$current_page,$sub);
        if ($result){
            $this->responseData($result);
        } else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    public function deleteContact() {

        $result = $this->m_substation->deleteContact(
            $this->input->post("delId"));
        if($result){
            $this->responseData($result);
        }else{
            $this->responseError(3, "Failed to delete");
        }
        $this->outputResponse();
    }

    public function countError($error) {
    $num_error = "0";
    for($x=0;$x<count($error);$x++){
        foreach ($error[$x] as $key => $value){
            if ($value!= "") {
                $num_error = "1";
            }
        }
    }
    return $num_error;
    }

    public function validate($contacts){
        $error;
        $msg = "The Contact field is required.";
        $msg1 = "The Contact field must contain only numbers.";
        $msg2 = "The Contact field has invalid length.";
        $len = strlen($contacts["value"]);

        if((($contacts["value"]) == "") || (($contacts["value"]) == "0")){
            $error = array(
                $contacts["id"] => $msg
            );
        }else if(!(ctype_digit($contacts["value"]))){
            $error = array(
                $contacts["id"] => $msg1
            );
        }
        else if(!($len== "11" || $len == "7")){
            $error = array(
                $contacts["id"] => $msg2
            );
        }
        else{
            $error = array(
                $contacts["id"] => ""
            );
        }
        return $error;
    }

    public function editContact() {
        $error = [];
        $contacts = [];
        $addcn = [];
        $editcn = [];
        $id = [];
        $num_error = "0";
        $addBrgyId=$this->input->post("addBrgyId");
        $temp=$this->input->post("contacts");
        for($x=0;$x<count($temp);$x++){
            $error[$x] = $this->validate($temp[$x]);
        }

        $num_error = $this->countError($error);

        if($num_error == "1") {
            $result["errors"] = array(
                "contacts" => $error
            );
            $this->responseData($result);
        }
        else{
            $y = 0; $z=0;
            $temp=$this->input->post("contacts");
            for($x=0;$x<count($temp);$x++){  
                $array = explode("_", $temp[$x]["id"]);
                if (in_array('tmp', $array) ) {
                    $result1 = $this->m_substation->addContact($temp[$x]["value"], $addBrgyId);
                    $addcn[$z] = array($result1 => $temp[$x]["value"]); 
                    $z++;
                }
                else{
                    $result1 = $this->m_substation->editContact($temp[$x]["value"], $temp[$x]["id"]);
                    $editcn[$y] = array($temp[$x]["id"] => $temp[$x]["value"]); 
                    $y++;
                }
            }
        $contacts = array(
            "addcn" => $addcn,
            "editcn" => $editcn
        );
        $this->responseData($contacts);
        }
        $this->outputResponse();
    }
}
