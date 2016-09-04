<?php

class M_logs extends CI_Model{
     public function createResponseInfo($fire_id,$sub,$arr){
        $this->db->start_cache();
        $this->db->flush_cache();
        $newData = array();
        ($sub != NULL) ? $newData["responsesubstn_info.fk_substn"] = $sub : null;
        ($arr != NULL) ? $newData["responsesubstn_info.arvl_time"] = $arr : null;
        ($fire_id != NULL) ? $newData["responsesubstn_info.fk_fire"] = $fire_id : null;
        $this->db->insert("responsesubstn_info", $newData);
        $result = $this->db->insert_id();
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }
        public function createTimeInfo($notification,$fireOut,$response){
        $this->db->start_cache();
        $this->db->flush_cache();
        $newData = array();
        ($notification != NULL) ? $newData["time_info.notif_time"] = $notification : null;
        ($fireOut != NULL) ? $newData["time_info.fout_time"] = $fireOut : null;
        ($response != NULL) ? $newData["time_info.resp_time"] = $response : null;
        $this->db->insert("time_info", $newData);
        $result = $this->db->insert_id();
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }
    public function createLocationInfo($latitude,$longitude,$address,$barangay){
        $this->db->start_cache();
        $this->db->flush_cache();
        $newData = array();
        ($latitude != NULL) ? $newData["location_info.brgy_latitude"] = $latitude : null;
        ($longitude != NULL) ? $newData["location_info.brgy_longitude"] = $longitude : null;
        ($address != NULL) ? $newData["location_info.address"] = $address : null;
        ($barangay != NULL) ? $newData["location_info.fk_brgy"] = $barangay : null;
        $this->db->insert("location_info", $newData);
        $result = $this->db->insert_id();
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }
    public function createFireInfo($locationId, $timeId, $category, $notifType){
        $this->db->start_cache();
        $this->db->flush_cache();
        $newData = array();
        ($notifType != NULL) ? $newData["fire_info.fk_notif"] = $notifType : null;
        ($locationId != NULL) ? $newData["fire_info.fk_loc"] = $locationId : null;
        ($timeId != NULL) ? $newData["fire_info.fk_time"] = $timeId : null;
        ($category != NULL) ? $newData["fire_info.fk_categ"] = $category : null;
        $this->db->insert("fire_info", $newData);
        $result = $this->db->insert_id();
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }
    /*
    *DISPLAY
    */
    public function retrieveChoices($notiftype,$year,$month,$day,$location,$substation,$category,$limit,$offset){
        $query = $this->db->select("fire.*, time.*, substation.*,brgy.*,responsesubstn.*,categ.*,location.*,notif.*");
        $query = $this->db->from("fire_info fire");
        $query = $this->db->join("notif_info notif","fire.fk_notif = notif.pk_notif");
        $query = $this->db->join("time_info time","fire.fk_time = time.pk_time");
        $query = $this->db->join("location_info location","fire.fk_loc=location.pk_loc");
        $query = $this->db->join("categ_info categ","fire.fk_categ=categ.pk_categ");
        $query = $this->db->join("responsesubstn_info responsesubstn","fire.pk_fire=responsesubstn.fk_fire");
        $query = $this->db->join("substn_info substation","responsesubstn.fk_substn = substation.pk_substn");
        $query = $this->db->join("brgy_info brgy","location.fk_brgy=brgy.pk_brgy");
        ($notiftype!=NULL) ? $query =$this->db->where("notif.notification_type",$notiftype):null;
        ($year!=NULL) ? $query =$this->db->where("year(time.notif_time)",$year,"after"):null;
        ($month!=NULL) ? $query =$this->db->where("month(time.notif_time)",$month,"after"):null;
        ($day!=NULL) ? $query =$this->db->where("day(time.notif_time)",$day,"after"):null;
        ($location!=NULL) ? $query =$this->db->like("brgy.brgy_name",$location,"after") : null;
        ($substation!=NULL) ? $query =$this->db->like("substation.substn_name",$substation,"after"):null;
        ($category!=NULL) ? $query =$this->db->like("categ.category_type",$category,"after"):null;
        $query =$this->db->order_by("fire.pk_fire","DESC");
        $query =$this->db->limit($limit,$offset);
        $query =$this->db->get();
        if ($query->num_rows()>0) {
            $result = $query->result_array();
            return $result;
        } 
        return false;
    }
    /*
    *PDF AND ROW COUNT
    */
    public function select_logs($offset, $limit,$notiftype,$year,$month,$day,$category,$substation,$location){
            $query = $this->db->select("fire.*, time.*, substation.*,brgy.*,responsesubstn.*,categ.*,location.*,notif.*");
            $query = $this->db->from("fire_info fire");
            $query = $this->db->join("notif_info notif","fire.fk_notif = notif.pk_notif");
            $query = $this->db->join("time_info time","fire.fk_time = time.pk_time");
            $query = $this->db->join("location_info location","fire.fk_loc=location.pk_loc");
            $query = $this->db->join("categ_info categ","fire.fk_categ=categ.pk_categ");
            $query = $this->db->join("responsesubstn_info responsesubstn","fire.pk_fire=responsesubstn.fk_fire");
            $query = $this->db->join("substn_info substation","responsesubstn.fk_substn = substation.pk_substn");
            $query = $this->db->join("brgy_info brgy","location.fk_brgy=brgy.pk_brgy");
            ($notiftype!=NULL) ? $query =$this->db->where("notif.notification_type",$notiftype):null;
            ($year!=NULL) ? $query =$this->db->where("year(time.notif_time)",$year,"after"):null;
            ($month!=NULL) ? $query =$this->db->where("month(time.notif_time)",$month,"after"):null;
            ($day!=NULL) ? $query =$this->db->where("day(time.notif_time)",$day,"after"):null;
            ($location!=NULL) ? $query =$this->db->like("brgy.brgy_name",$location,"after") : null;
            ($substation!=NULL) ? $query =$this->db->like("substation.substn_name",$substation,"after"):null;
            ($category!=NULL) ? $query =$this->db->like("categ.category_type",$category,"after"):null;
            $query =$this->db->order_by("fire.pk_fire","DESC");
            $query =$this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = $query->result_array();   
            return $result;
        }  
        return false;
    }
    /*
    *EDIT
    */
    public function checker($select, $from, $where){
        $query = $this->db->select($select)
            ->from($from)
            ->where($where)
            ->get();
         if ($query->num_rows() > 0){
            $result = $query->result_array();   
            return $result;
        }  
        return false;
    }
 
    public function editLog($where,$set,$table){
        $query = $this->db->set($set);
        $query = $this->db->where($where);
        $query = $this->db->update($table);
        
        if($this->db->affected_rows() > 0){  
            return $query;
        }
        return false;
    }
    /*
    *DELETE
    */
    public function deleteLog($id,$table){
        $query = $this->db->where($id);
        $query = $this->db->delete($table);
        
        if($this->db->affected_rows() > 0)
        {  
            return $query;
        }
        return false;
    }
    /*
    *LIST ON KEYUP
    */
    public function suggestLog($name = NULL,$select,$from){
        $query = $this->db->select($select);
        $query = $this->db->from($from);
        $query = $this->db->order_by($select,"ASC");
        ($name !=NULL)? $this->db->like($select,$name,"after"):NULL;
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->result_array();               
        }
        else{
            return false;            
        }
    }
}

?>