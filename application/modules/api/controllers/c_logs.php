<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class C_logs extends API_Controller {
   public $perpage = 10;
   
    public function __construct() {
        parent::__construct();
        
        $this->load->model("m_logs");
        $this->load->model("m_contacts");
    }
    public function validate($respondents){
        $error;
        $msg = "The Arrival field is required.";

        if($respondents["arrival"] == ""){
            $error = array(
                $respondents["id"] => $msg
            );
        }
        else{
            $error = array(
                $respondents["id"] => ""
            );
        }
        return $error;
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

    public function createLog() {
        $arrivalEmpty="";
        $error = [];
        $addcn =[];
        $r_error = $this->input->post("resp_error");
        $type = $this->input->post("notifType");
        if ($this->input->post("notifType")==0) {
            $this->form_validation->set_rules('Latitude', 'Latitude', 'required|numeric|trim');
            $this->form_validation->set_rules('Longitude', 'Longitude', 'required|numeric|trim');
        }
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('barangay', 'Barangay', 'required|trim');
        $this->form_validation->set_rules('notification', 'Notification', 'required|trim');
        $this->form_validation->set_rules('fireOut', 'Fire Out', 'required|trim');
        $this->form_validation->set_rules('response', 'Response', 'required|trim');
        $this->form_validation->set_error_delimiters('', '');
        $brgyId = $this->m_contacts->getContactID($this->input->post("barangay"));
        if($brgyId==false){
            $brgyId = "0";
        }
        if($brgyId=="0"){
            $brgyError = "Invalid Barangay.";
        }else{
            $brgyError = "";
        }
        $temp=$this->input->post("respondents");
        if (!sizeof($temp)) {
            $arrivalEmpty="There should be atleast 1 Arrival Time";   
        }
        if($r_error=="error"){
            $r_error = "Check Notification and Arrival.";
        }else if($r_error>0){
            $r_error = "Response Time reached ".$r_error." day/s.";
        }else if($r_error=="yearmonth"){
            $r_error = "Response Time reached more than a month/year.";
        }
        for($x=0;$x<count($temp);$x++){
            $error[$x] = $this->validate($temp[$x]);
        }
        $num_error = $this->countError($error);

        if($this->form_validation->run() && $num_error == "0" && $brgyId!="0" && $arrivalEmpty=="" && $r_error==""){
                $time_info_id = $this->m_logs->createTimeInfo(
                    $this->input->post("notification"),
                    $this->input->post("fireOut"),
                    $this->input->post("response")
                );
                $location_info_id = $this->m_logs->createLocationInfo(
                    $this->input->post("Latitude"),
                    $this->input->post("Longitude"),
                    $this->input->post("address"),
                    $brgyId[0]["pk_brgy"]
                );
                if ($location_info_id) {
                    $fire_info_id = $this->m_logs->createFireInfo(
                        $location_info_id,
                        $time_info_id,
                        $this->input->post("category"),
                        $this->input->post("notifType")
                    );
                    if($fire_info_id){
                        $temp=$this->input->post("respondents");
                        for($x=0;$x<count($temp);$x++){ 
                            $res_info_id = $this->m_logs->createResponseInfo(
                                $fire_info_id,
                                $temp[$x]["substation"],
                                $temp[$x]["arrival"]
                            );                               
                         }
                         $this->responseData($fire_info_id);
                    }else{
                        $this->responseError(3, "Failed to create Log");
                    }
                }
                else{
                    $this->responseError(11, "Failed to create Location Information");
                }
        }else{
            $result = array(
                "deviceId" => form_error('deviceId'),
                "Latitude" => form_error('Latitude'),
                "Longitude" => form_error('Longitude'),
                "address" => form_error('address'),
                "barangay" => (form_error('barangay')!="")?form_error('barangay'):$brgyError,
                "notification" => form_error('notification'),
                "fireOut" => form_error('fireOut'),
                "response" => (form_error('response')?form_error('response'):$r_error),
                "arrivalEmpty" => $arrivalEmpty,
                "substation" => $error
            );
            $this->responseError(4, $result);
        }
        $this->outputResponse();
    }
    /*
    ** LOGS START
    */
    public function deleteLogs(){
        $id=$this->input->post("deleteLogsID");
        $data = $this->m_logs->deleteLog(array('pk_fire'=>$id),'fire_info');
        $data = $this->m_logs->deleteLog(array('pk_time'=>$id),'time_info');
        $data = $this->m_logs->deleteLog(array('pk_loc'=>$id),'location_info');
        $data = $this->m_logs->deleteLog(array('fk_fire'=>$id),'responsesubstn_info');
        if($data){
            $this->responseData($data);
        }else{
            $this->responseError(2, "Failed to Delete");
        }
        $this->outputResponse();
    }
    public function listsuggest(){
        $data = $this->m_logs->suggestLog($this->input->post("brgy_name"),
            $this->input->post("select"),$this->input->post("from"));
        if ($data){
            $this->responseData($data);
        }else{
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    public function editfields($new_pk,$where_edit,$value,$value_row,$idtocheck,$tabletocheck,$rowtoset,$tabletoedit){
        $where = array($value_row => $value);
        $newcateg_id=$new_pk;
        $set = array($rowtoset=>$newcateg_id);
        $table = $tabletoedit;
        $data = $this->m_logs->editLog($where_edit,$set,$table);
        return $data;
    }
    public function edit_datetimeaddress($value,$timerow,$where,$table){
        $set = array($timerow=>$value);
        $data = $this->m_logs->editLog($where,$set,$table);
        return $data;
    }
    public function checker($table_pk,$table,$where,$fieldname,$value){
        $data = $this->m_logs->checker($table_pk, $table, $where);
        if(empty($data)){
            if(is_numeric($value)){
                return $data = $fieldname." contains Numbers!";
            }else{
                return $data = "Invalid ".$fieldname."!";
            }
        }else{
            return $data=$data[0][$table_pk];
        }
    }
    public function editLogs(){
        $tb_id = $this->input->post("editLogsId");
        $loc_val = $this->input->post("editValLocation");
        $resp_error = $this->input->post("error_response");
        $arvl_check = $this->input->post("editValArival_check");
        /*Arrival*/
        $arvl_error="";
        $arvl_counter=[];
        for($x1=0;$x1<count($arvl_check);$x1++){
            $y1 = explode("+",$arvl_check[$x1]);
            if($y1[1]==""){
                $arvl_error= array(
                    "id"=>$y1[0],
                    "error"=>"Arrival field is required."
                );
                $arvl_counter[$x1] = $arvl_error;  
            }else{
                $arvl_counter[$x1] = "";
            }
        }
        $arvl_error_indicator="";
        for($y1=0;$y1<count($arvl_counter);$y1++){
            if($arvl_counter[$y1]!=""){
                $arvl_error_indicator="error";
            }
        }
        $this->form_validation->set_error_delimiters("","");
        $this->form_validation->set_rules("editValCategory", 'Category', 'trim|required');
        $this->form_validation->set_rules("editValLocation", 'Barangay', 'trim|required');
        $this->form_validation->set_rules("editValAddress", 'Address', 'trim|required');
        $this->form_validation->set_rules("editValNotification", 'Notification', 'trim|required');
        $this->form_validation->set_rules("editValFireout", 'Fire Out', 'trim|required');
        /*Check if input exists in the Database*/
        /*Location*/
        $where_loc = array("brgy_name" =>$loc_val);
        $loc = $this->checker("pk_brgy","brgy_info",$where_loc,"Barangay",$loc_val);
        if(is_numeric($loc)){
            $loc_error = "";
        }else{
            $loc_error = $loc;
        }
        /*response time*/
        if($resp_error=="error"){
            $resp_error = "Check Notification and Arrival.";
        }else if($resp_error>0){
            $resp_error = "Response Time reached ".$resp_error." day/s.";
        }else if($resp_error=="yearmonth"){
            $resp_error = "Response Time reached more than a month/year.";
        }
        if ($this->form_validation->run() == FALSE || $arvl_error_indicator!="" || $loc_error!="" || $resp_error!=""){
            $data["errors"] = array(
                "arv"=>$arvl_counter,
                "address"=>form_error('editValAddress'),
                "loc"=>((form_error('editValLocation')!="")?form_error('editValLocation'):$loc_error),
                "notif"=>form_error('editValNotification'),
                "fire"=>form_error('editValFireout'),
                "response"=>(form_error('editValResponse')?form_error('editValResponse'):$resp_error)
            );
		}else{
            /*Substation*/ 
            for($x=0;$x<count($this->input->post("editValSubstation_check"));$x++){
                $y = explode("+",$this->input->post("editValSubstation_check")[$x]);
                $where_sub = array(
                    'fk_fire'=>$tb_id,
                    'pk_respondsubstn'=>$y[0]
                    );
                $sub_check = array("substn_name" => $y[1]);
                $sub = $this->checker("pk_substn","substn_info",$sub_check,"Substation",$y[1]);
                $data = $this->editfields($sub,$where_sub,$y[1],"substn_name",
                    "pk_substn","substn_info",
                    "fk_substn","responsesubstn_info");
            }
            /*Arrival*/
            for($x=0;$x<count($arvl_check);$x++){
                $y = explode("+",$arvl_check[$x]);
                $where_arvl = array(
                    'fk_fire'=>$tb_id,
                    'pk_respondsubstn'=>$y[0]
                    );
                $data = $this->edit_datetimeaddress($y[1],"arvl_time",
                    $where_arvl,"responsesubstn_info");
            }
            /*Category*/
            $categ_check = array("category_type" => $this->input->post("editValCategory"));
            $categ = $this->checker("pk_categ","categ_info",$categ_check,"Category",
                    $this->input->post("editValCategory"));
            $where_categ = array("pk_fire"=>$tb_id);
            $data= $this->editfields($categ,$where_categ,$this->input->post("editValCategory"),
                    "category_type","pk_categ","categ_info","fk_categ","fire_info");
            /*Location*/
            $where_loc = array("pk_loc"=>$tb_id);
            $data= $this->editfields($loc,$where_loc,$loc_val,"brgy_name",
                    "pk_brgy","brgy_info",
                    "fk_brgy","location_info");
            /*Notification*/
            $where_notif = array("pk_time"=>$tb_id);
            $data = $this->edit_datetimeaddress($this->input->post("editValNotification"),
                    "notif_time",$where_notif,"time_info");
            /*Fire Out*/
            $where_fout = array("pk_time"=>$tb_id);
            $data = $this->edit_datetimeaddress($this->input->post("editValFireout"),
                    "fout_time",$where_fout,"time_info");
            /*Response*/
            $where_resp = array('pk_time'=>$tb_id);
            $data = $this->edit_datetimeaddress($this->input->post("editValResponse"),
                    "resp_time",$where_resp,"time_info");
            /*Address*/
            $where_addrs = array('pk_loc'=>$tb_id);
            $data = $this->edit_datetimeaddress($this->input->post("editValAddress"),
                    "address",$where_addrs,"location_info");
        }
        if($data){
            $this->responseData($data);
        }else{
            $this->responseError(2, "Failed to Edit");
        }
        $this->outputResponse(); 
    }
    public function generate_pdf(){
        $data=  array('values' => $this->m_logs->select_logs('0','0',
            $this->input->post('notiftype'),$this->input->post('yearchoice'),
            $this->input->post('monthchoice'),$this->input->post('daychoice'),
            $this->input->post('categchoice'),$this->input->post('subchoice'),
            $this->input->post('locchoice')));
        if($data){
            $this->responseData($data);
        }else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
    public function logs(){
        /*COUNT TOTAL NUMBER OF ROWS*/
        $count = $this->m_logs->select_logs('0','0',$this->input->post('notiftype'),
            $this->input->post('yearchoice'),$this->input->post('monthchoice'),
            $this->input->post('daychoice'),$this->input->post('categchoice'),
            $this->input->post('subchoice'),$this->input->post('locchoice'));
        if(!empty($count)) 
        {
            $count = count($count);
        }
        $current_page=$this->input->post('ppage');
        $data = array(
            'values' => $this->m_logs->retrieveChoices($this->input->post('notiftype'),
                $this->input->post('yearchoice'),$this->input->post('monthchoice'),
                $this->input->post('daychoice'),$this->input->post('locchoice'),
                $this->input->post('subchoice'),$this->input->post('categchoice'),
                $this->perpage,$current_page),
            'total_row' =>$count,
            'row_perpage' =>$this->perpage
        );
        if($data){
            $this->responseData($data);
        }else {
            $this->responseError(2, "No Result");
        }
        $this->outputResponse();
    }
 }