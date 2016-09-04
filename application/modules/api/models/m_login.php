<?php

class M_login extends CI_Model{
    public function authenticate($username, $password){
        $this->db->start_cache();
        $this->db->flush_cache();
        $result = false;
        
        $condition = "username =" . "'" .$username. "' AND " . "password =" . "'" . md5($password) . "'";
      
        $query = $this->db->select("*")
            ->from("account")
            ->where($condition)
            ->limit(1)
            ->get();

        if ($query->num_rows() == 1){
            $result =  $query->row_array(); 
        }
        return $result;   
    }
}
?>