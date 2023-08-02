<?php

class fetchDataModel extends CI_Model
{


    //checking existing email.
    public function fetch_data($data, $table)
    {

        $res = $this->db->select($data)
            ->from($table)
            ->get();

        return $res->result_array();
    }

    public function fetch_category()
    {

        $sql = "SELECT * FROM category ORDER BY categorytitle";

        $res = $this->db->query($sql);


        return $res->result_array();
    }

    public function fetch_category_id($cate_title)
    {
        $categoryid = 0;

        $sql = "SELECT categoryid FROM category Where categorytitle = '$cate_title'";

        $res = $this->db->query($sql);

        foreach ($res->result() as $row) {
            $categoryid = $row->categoryid;
        }

        return $categoryid;
    }

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
