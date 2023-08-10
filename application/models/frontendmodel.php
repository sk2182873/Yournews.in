<?php

class frontendmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fetch_articles()
    {

        $sql = "SELECT * FROM article as a
            LEFT JOIN category as c
            on a.categoryid = c.categoryid";

        $res = $this->db->query($sql);

        return $res->result_array();
    }

    public function fetch_recents()
    {

        $sql = "SELECT * FROM article as a
            LEFT JOIN category as c
            on a.categoryid = c.categoryid
            ORDER BY id DESC LIMIT 4";

        $res = $this->db->query($sql);

        return $res->result_array();
    }

    public function fetch_categories()
    {

        $sql = "SELECT * FROM category ORDER BY categorytitle";

        $res = $this->db->query($sql);

        // echo "pre>";
        // print_r($res);

        return $res->result_array();
    }

    public function fetch_article_by_id($id)
    {

        $sql = "SELECT * FROM article as a
            LEFT JOIN category as c
            ON a.categoryid = c.categoryid
            WHERE id = $id";

        $res = $this->db->query($sql);

        return $res->result_array();
    }

    //--------------------------------Business Page Functions----------------------------------------------------------

    public function fetch_articles_business()
    {

        $sql = "SELECT * FROM article as a
            LEFT JOIN category as c
            ON a.categoryid = c.categoryid
            WHERE a.categoryid='93'";

        $res = $this->db->query($sql);

        return $res->result_array();
    }

    public function fetch_recent_articles_business()
    {

        $sql = "SELECT * FROM article as a
            LEFT JOIN category as c
            ON a.categoryid = c.categoryid
            WHERE a.categoryid='93'
            ORDER BY id DESC LIMIT 4";

        $res = $this->db->query($sql);

        return $res->result_array();
    }
}
