<?php

    class fetchDataModel extends CI_Model{


        //checking existing email.
        public function fetch_user($data,$table){

            $res = $this->db->select($data)
                            ->from($table)
                            ->get();
                
            return $res->result_array();
        }

    }


?>