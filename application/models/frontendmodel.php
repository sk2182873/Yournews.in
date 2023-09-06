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
            ORDER BY id DESC LIMIT 5";

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

	public function fetchArticlesByCategory($category){

		$sql = "SELECT * FROM article as a
				LEFT JOIN category as c
				ON a.categoryid = c.categoryid
				WHERE c.categorytitle = '$category'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetchRecentArticlesById($category){

		$sql = "SELECT * FROM article as a
				LEFT JOIN category as c
				ON a.categoryid = c.categoryid
				WHERE c.categorytitle = '$category'
				ORDER BY a.id DESC LIMIT 5";

		$result = $this->db->query($sql);

		return $result->result_array();

	}
}
