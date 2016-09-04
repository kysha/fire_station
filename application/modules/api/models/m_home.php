<?php

class M_home extends CI_Model{
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
    public function retrieveBarangayInfo($barangayName = NULL){
        $this->db->start_cache();
        $this->db->flush_cache();

        $this->db->select("brgy.pk_brgy,contact.contact");
        $this->db->join("contact_brgy contact","contact.fk_brgy=brgy.pk_brgy");
        $condition = array();        
        ($barangayName != NULL) ? $condition["brgy.brgy_name"] = $barangayName : null;

        (count($condition) > 0 != NULL) ? $this->db->where($condition) : null;
        $result = $this->db->get("brgy_info brgy");
        if ($result->num_rows() > 0){
            return $result->result_array();               
        }
        else{
            return false;            
        }
    }
    public function retrieveStationInfo($station_id = NULL){
        $this->db->start_cache();
        $this->db->flush_cache();

        $this->db->select("substn.substn_name,contact.contact");
        $this->db->join("contact_substn contact","contact.fk_substn=substn.pk_substn");
        $condition = array();        
        ($station_id != NULL) ? $condition["substn.pk_substn"] = $station_id : null;

        (count($condition) > 0 != NULL) ? $this->db->where($condition) : null;
        $result = $this->db->get("substn_info substn");
        if ($result->num_rows() > 0){
            return $result->result_array();               
        }
        else{
            return false;            
        }
    }
}
