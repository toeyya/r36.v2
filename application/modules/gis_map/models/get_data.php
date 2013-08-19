<?php

class Get_data extends CI_Model{
    function getAppertisers(){
        $query = $this->db->query("SELECT * FROM n_province");
        return $query->result();
    }
}

?>