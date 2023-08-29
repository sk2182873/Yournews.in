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
            ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	//---------------------------------Country Page Functions-----------------------------------------------------------------

	public function fetch_country_article()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='46'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_country_article()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='46'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	//------------------------------Education Page Functions------------------------------------------------------

	public function fetch_education_article()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='56'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_education()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='56'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	//----------------------------Entertainment Page Function----------------------------------------------------------------------

	public function fetch_enter_articles()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='52'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_enter_articles()
	{
		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='52'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	//--------------------------------Politics Page Functions------------------------------------------------------------

	public function fetch_politics_article()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='50'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_politics_article()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='50'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	//----------------------------------Sports Page Function----------------------------------------------------------

	public function fetch_sports_article()
	{
		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='110'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_sports_article()
	{
		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='110'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}
	//--------------------------------------Technology Page Functions--------------------------------------------------

	public function fetch_tech_articles()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='53'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_tech_articles()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='53'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}
	//--------------------------------------World Page Functions-------------------------------------------------------

	public function fetch_world_articles()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='47'";

		$res = $this->db->query($sql);

		return $res->result_array();
	}

	public function fetch_recents_world_articles()
	{

		$sql = "SELECT * FROM article as a
        LEFT JOIN category as c
        ON a.categoryid = c.categoryid
        WHERE a.categoryid='47'
        ORDER BY id DESC LIMIT 5";

		$res = $this->db->query($sql);

		return $res->result_array();
	}
}
