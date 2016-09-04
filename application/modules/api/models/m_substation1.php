<?php

class M_substation extends CI_Model{

    public function retrieveContacts($sub_name = NULL){//$retrieveType: 1 - like, 0 - match, 3 count

        $this->db->start_cache();
        $this->db->flush_cache();
        
        $this->db->select("substn_info.substn_name,substn_info.pk_substn, contact_substn.contact,contact_substn.pk_scontact");
        $this->db->join("contact_substn","contact_substn.fk_substn=substn_info.pk_substn", "left");
        $this->db->order_by("substn_info.substn_name","desc");
        ($sub_name !=NULL)? $this->db->like("substn_info.substn_name",$sub_name,"after"):NULL;
        $result = $this->db->get("substn_info");
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
        ($delId!= NULL) ? $condition["contact_substn.pk_scontact"] = $delId : null;
        $result = false;
        if(count($condition) > 0){
            $this->db->where($condition);
            $result = $this->db->delete("contact_substn");
        }
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }

    public function addContact($newNum, $brgyID){
        $this->db->start_cache();
        $this->db->flush_cache();
        $newData = array();
        ($newNum != NULL) ? $newData["contact_substn.contact"] = $newNum : null;
        ($brgyID != NULL) ? $newData["contact_substn.fk_substn"] = $brgyID : null;
        $this->db->insert("contact_substn", $newData);
        $result = $this->db->insert_id();
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;
    }

    public function editContact($editValue, $editId){
        $this->db->start_cache();
        $this->db->flush_cache();
        $condition = array();

        // ($editValue!= NULL) ? $condition["contact_brgy.contact"] = $editValue : null;
        ($editId != NULL) ? $condition["contact_substn.pk_scontact"] = $editId : null;
        // ($editBrgyId!= NULL) ? $condition["contact_brgy.contact"] = $editValue : null;

        $result = false;
        if(count($condition) > 0){
            $this->db->where($condition);
            $newData = array();
            // ($editId != NULL) ? $newData["contact_brgy.pk_brgy"] = $editId : null;
            ($editValue!= NULL) ? $newData["contact_substn.contact"] = $editValue : null;
            if(count($newData) > 0){
                $result = $this->db->update("contact_substn", $newData);
            }
        }
        $this->db->flush_cache();
        $this->db->stop_cache();
        return $result;

    }
}
