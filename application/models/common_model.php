<?php

class common_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_users(){

		$this->db->select('*');
		$this->db->from('users');

		if(isset($_POST['search']['value'])){
			$this->db->like('username', $_POST['search']['value']);
			$this->db->or_like('email', $_POST['search']['value']);
			$this->db->or_like('address', $_POST['search']['value']);
			$this->db->or_like('phone', $_POST['search']['value']);
			$this->db->or_like('position', $_POST['search']['value']);
			$this->db->or_like('user_status', $_POST['search']['value']);
		}

		if($_POST['order']){
			$this->db->order_by($_POST['order'][0]['column'], $_POST['order'][0]['dir']);
		}else{
			$this->db->order_by('userid' , 'ASC');
		}

		if($_POST['length'] != -1){
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result_array();
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

	public function fetch_category()
	{

		$sql = "SELECT * FROM category ORDER BY categorytitle";

		$res = $this->db->query($sql);


		return $res->result_array();
	}

	public function fetch_data($data, $table)
	{

		$res = $this->db->select($data)
			->from($table)
			->get();

		return $res->result_array();
	}

	public function insert_article($data, $category_id, $path, $url_slug)
	{
		$user = $this->session->userdata('roll');

		if ($user == 'admin') {
			$sql = array('title' => $data['title'], 'url_slug' => $url_slug, 'shortdescription' => $data['Sdescp'], 'content' => $data['content'], 'imagesurl' => $path, 'meta_keywords' => $data['meta_keys'], 'adminid' => $_SESSION['id'], 'categoryid' => $category_id, 'status' => 1);
		} else {
			$sql = array('title' => $data['title'], 'url_slug' => $url_slug, 'shortdescription' => $data['Sdescp'], 'content' => $data['content'], 'imagesurl' => $path, 'meta_keywords' => $data['meta_keys'], 'userid' => $_SESSION['userid'], 'categoryid' => $category_id, 'status' => 1);
		}



		$str = $this->db->insert_string('article', $sql);

		$res = $this->db->query($str);

		if (!$res) {
			return 0;
		} else {
			return 1;
		}
	}

	public function insert_blog($data, $category_id, $path)
	{

		$user = $this->session->userdata('roll');

		if ($user == 'admin') {
			$sql = array('title' => $data['Btitle'], 'shortdescp' => $data['Sdescp'], 'content' => $data['content'], 'imageurl' => $path, 'adminid' => $_SESSION['id'], 'categoryid' => $category_id, 'status' => 1);
		} else {
			$sql = array('title' => $data['Btitle'], 'shortdescp' => $data['Sdescp'], 'content' => $data['content'], 'imageurl' => $path, 'userid' => $_SESSION['userid'], 'categoryid' => $category_id, 'status' => 1);
		}

		$str = $this->db->insert_string('blog', $sql);

		$res = $this->db->query($str);

		if (!$res) {
			return 0;
		} else {
			return 1;
		}
	}

	public function insert_category_model($data)
	{

		$user = $this->session->userdata('roll');

		$category_title = strtolower($data['CatTitle']);

		if ($user == 'admin') {
			$sql = array('categorytitle' => $category_title, 'Shortdescp' => $data['Sdecp'], 'adminid' => $_SESSION['id']);
		} else {
			$sql = array('categorytitle' => $category_title, 'Shortdescp' => $data['Sdecp'], 'userid' => $_SESSION['userid']);
		}

		$str = $this->db->insert_string('category', $sql);

		return $this->db->query($str);
	}

	public function update_profile($alteremail, $filename)
	{
		$user = $this->session->userdata('roll');
		$res = "";

		$path = "";
		if (!empty($filename)) {
			$path = './uploads/admin/' . $filename;
		}

		//echo $path;die();

		if (($user == "admin") && (!empty($path))) {
			$sql = array('alternative_email' => "$alteremail", 'profile_img' => "$path");

			$where = "adminid =" . $_SESSION['id'];

			$str = $this->db->update_string('admin', $sql, $where);

			$res = $this->db->query($str);
		}

		if (($user == "admin") && (!empty($path) == 0)) {
			$sql = array('alternative_email' => "$alteremail");

			$where = "adminid =" . $_SESSION['id'];

			$str = $this->db->update_string('admin', $sql, $where);

			$res = $this->db->query($str);
		}

		if (($user == "user") && (!empty($path))) {
			$sql = array('alternative_email' => "$alteremail", 'profile_img' => "$path");

			$where = "userid =" . $_SESSION['userid'];

			$str = $this->db->update_string('users', $sql, $where);

			$res = $this->db->query($str);
		}

		if (($user == "user") && (!empty($path) == 0)) {
			$sql = array('alternative_email' => "$alteremail");

			$where = "userid =" . $_SESSION['userid'];

			$str = $this->db->update_string('users', $sql, $where);

			$res = $this->db->query($str);
		}





		if ($res) {
			$userdata['alteremail'] = $alteremail;
			if (!empty($path)) {
				$userdata['profilepic'] = $path;
			}

			$this->session->set_userdata($userdata);
			return $res;
		}

		return 0;
	}

	public function delete_article_by_id($id)
	{

		return $this->db->delete('article', array('id' => $id));
	}

	public function fetch_article()
	{

		$this->db->select('*');
		$this->db->from('article');
		$this->db->join("category", "article.categoryid = category.categoryid", "left");

		if (isset($_POST['search']['value'])) {

			$this->db->like("title", $_POST['search']['value']);
			$this->db->or_like('date', $_POST['search']['value']);
			$this->db->or_like("shortdescription", $_POST['search']['value']);
			$this->db->or_like('categorytitle', $_POST['search']['value']);
			$this->db->or_like("status", $_POST['search']['value']);
		}

		if (isset($_POST["order"])) {
			$order = $_POST['order']['0']['dir'];
			$column = $_POST['order']['0']['column'];

			$this->db->order_by($column, $order);
		} else {
			$this->db->order_by('id', 'DESC');
		}

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_filteredData($table1, $table2 = '')
	{

		$this->db->select("*");
		$this->db->from($table1);

		if (($table1 != 'pages') && ($table1 != 'users') ) {

			$this->db->join($table2, ".$table1.categoryid = $table2.categoryid", "left");
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all_data($table1)
	{

		$this->db->select("*");
		$this->db->from($table1);
		return $this->db->count_all_results();
	}

	public function fetchPages()
	{
		$this->db->select("*");
		$this->db->from("pages");

		if (isset($_POST["search"]["value"])) {
			$this->db->like('page_name', $_POST["search"]["value"]);
			$this->db->or_like('created_at', $_POST["search"]["value"]);
			$this->db->or_like('description', $_POST["search"]["value"]);
			$this->db->or_like('p_status', $_POST["search"]["value"]);
		}


		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by("id", "DESC");
		}

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST["length"], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}
}
