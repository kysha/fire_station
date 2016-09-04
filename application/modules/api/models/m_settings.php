<?php

class M_settings extends CI_Model{
    /*
    *DISPLAY
    */
    public function retrieveField($where){
        $query = $this->db->select("*");
        $query = $this->db->from("account");
        $query = $this->db->where($where);
        $query =$this->db->get();
        if ($query->num_rows()>0) {
            $result = $query->result_array();
            return $result;
        } 
        return false;
    }
    public function editField($set,$where){
        $query = $this->db->set($set);
        $query = $this->db->where($where);
        $query = $this->db->update("account");
        
        if($this->db->affected_rows() > 0){  
            return $query;
        }
        return false;
    }
}
?>