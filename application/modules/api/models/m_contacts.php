<?php

class M_contacts extends CI_Model{

    public function getContactID($name){
        $this->db->select("brgy_info.pk_brgy");
        $this->db->where('brgy_info.brgy_name', $name); 
        $result = $this->db->get("brgy_info");
        if ($result->num_rows() > 0){
            return $result->result_array();               
        }
        else{
            return false;            
        }
    }
    public function count($brgy_name){
        $this->db->start_cache();
        $this->db->flush_cache();
        $this->db->select("brgy_info.*,contact_brgy.*");
        $this->db->join("contact_brgy","contact_brgy.fk_brgy=brgy_info.pk_brgy", "left");
        $this->db->order_by("brgy_info.brgy_name","asc");
        ($brgy_name !=NULL)? $this->db->like("brgy_info.brgy_name",$brgy_name,"after"):NULL;
        $result = $this->db->get("brgy_info");
        if ($result->num_rows() > 0){
            return $result->result_array();
        }
        else{
            return false;            
        }
    }
    
    public function retrieveContacts($brgy_name = NULL,$limit,$offset){
        $this->db->start_cache();
        $this->db->flush_cache();
        $this->db->select("brgy_info.brgy_name,brgy_info.pk_brgy, contact_brgy.contact,contact_brgy.pk_contact");
        $this->db->join("contact_brgy","contact_brgy.fk_brgy=brgy_info.pk_brgy", "left");
        $this->db->order_by("brgy_info.brgy_name","asc");
        ($brgy_name !=NULL)? $this->db->like("brgy_info.brgy_name",$brgy_name,"after"):NULL;
        $this->db->limit($limit,$offset);
        $result = $this->db->get("brgy_info");
        if ($result->num_rows() > 0){
            return $result->result_array();               
        }
        else{
            return false;            
        }
    }


    public function deleteContact($delId = NULL){
        $this->db->start_cache();
        $this->db->flush_cache();        
        $condition = array();
        ($delId!= NULL) ? $condition["contact_brgy.pk_contact"] = $delId : null;
        $result = false;
        if(count($condition) > 0){
            $this->db->where($condition);
            $result = $this->db->delete("contact_brgy");
        }
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }

    public function addContact($newNum, $brgyID){
        $this->db->start_cache();
        $this->db->flush_cache();
        $newData = array();
        ($newNum != NULL) ? $newData["contact_brgy.contact"] = $newNum : null;
        ($brgyID != NULL) ? $newData["contact_brgy.fk_brgy"] = $brgyID : null;
        $this->db->insert("contact_brgy", $newData);
        $result = $this->db->insert_id();
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }

    public function editContact($editValue, $editId){
        $this->db->start_cache();
        $this->db->flush_cache();
        $condition = array();
        ($editId != NULL) ? $condition["contact_brgy.pk_contact"] = $editId : null;
        $result = false;
        if(count($condition) > 0){
            $this->db->where($condition);
            $newData = array();

            ($editValue!= NULL) ? $newData["contact_brgy.contact"] = $editValue : null;
            if(count($newData) > 0){
                $result = $this->db->update("contact_brgy", $newData);
            }
        }
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;

    }
}
