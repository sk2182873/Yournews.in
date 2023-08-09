<?php

class fetchDataModel extends CI_Model
{


    //checking existing email.
   
    public function fetch_article()
    {

        $sql = 'SELECT * from article as a LEFT JOIN category as c on a.categoryid = c.categoryid';

        $res = $this->db->query($sql);

        // echo "<pre>";
        // print_r($res->result());

        return $res->result_array();
    }

    public function fetch_blog()
    {

        $sql = 'SELECT * from blog as b LEFT JOIN category as c on b.categoryid = c.categoryid';

        $res = $this->db->query($sql);

        // echo "<pre>";
        // print_r($res->result());

        return $res->result_array();
    }
}
