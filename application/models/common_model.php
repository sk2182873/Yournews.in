<?php

class common_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_table($table, $column, $id){

		// echo $table."<br>".$column."<br>".$id;
		// die();

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("$column = $id");

		$query = $this->db->get();

		return $query->result_array();

	}

	public function change_status($table, $column, $value, $where_col, $id){

		$where = "$where_col = $id";

		$str = $this->db->update_string($table, array("$column"=>"$value"), $where);

		$query = $this->db->query($str);

		return $query;

	}

	
	public function fetch_category_id($cate_title){
		$categoryid = 0;

		$sql = "SELECT categoryid FROM category Where categorytitle = '$cate_title'";

		$res = $this->db->query($sql);

		foreach ($res->result() as $row) {
			$categoryid = $row->categoryid;
		}

		return $categoryid;
	}

	public function fetch_category(){

		$sql = "SELECT * FROM category ORDER BY categorytitle";

		$res = $this->db->query($sql);


		return $res->result_array();
	}

	public function fetch_total($column, $table){

		$res = $this->db->select($column)
			->from($table)
			->get();

		return $res->result_array();
	}

	public function insert_article($data, $category_id, $path, $url_slug){
		$user = $this->session->userdata('roll');

		if ($user == 'admin') {
			$sql = array('title' => $data['title'], 'url_slug' => $url_slug, 'shortdescription' => $data['Sdescp'], 'content' => $data['content'], 'imagesurl' => $path, 'meta_keywords' => $data['meta_keys'], 'adminid' => $_SESSION['id'], 'categoryid' => $category_id, 'article_status' => 1);
		} else {
			$sql = array('title' => $data['title'], 'url_slug' => $url_slug, 'shortdescription' => $data['Sdescp'], 'content' => $data['content'], 'imagesurl' => $path, 'meta_keywords' => $data['meta_keys'], 'userid' => $_SESSION['userid'], 'categoryid' => $category_id, 'article_status' => 1);
		}



		$str = $this->db->insert_string('article', $sql);

		$res = $this->db->query($str);

		if (!$res) {
			return 0;
		} else {
			return 1;
		}
	}

	public function insert_blog($data, $category_id, $path){

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

	public function insert_category_model($data){

		// echo "<pre>";
		// print_r($data);
		// die();

		$user = $this->session->userdata('roll');

		$category_title = strtolower($data['categorytitle']);

		if ($user == 'admin') {
			$sql = array('categorytitle' => $category_title, 'Shortdescp' => $data['Shortdescp'], 'adminid' => $_SESSION['id']);
		} else {
			$sql = array('categorytitle' => $category_title, 'Shortdescp' => $data['Shortdescp'], 'userid' => $_SESSION['userid']);
		}

		$str = $this->db->insert_string('category', $sql);

		return $this->db->query($str);
	}

	public function update_profile($alteremail, $filename){
		$user = $this->session->userdata('roll');
		$res = "";

		// echo $user;
		// die();

		$path = "";
		if (!empty($filename)) {
			$path = 'uploads/admin/' . $filename;
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

	public function delete_row_by_id($table, $column, $id){


		if($table == 'category'){
			$sql = "SET FOREIGN_KEY_CHECKS=OFF";
			$this->db->query($sql);
			$sql = " DELETE from article WHERE categoryid = $id";
			$this->db->query($sql);
			$sql = " DELETE from category WHERE categoryid = $id";
			$this->db->query($sql);
			$sql = " SET FOREIGN_KEY_CHECKS=ON";
			$this->db->query($sql);
			
		}else{
			$result = $this->db->delete($table, array($column => $id));
		}

		return 1;
	}

	public function update_table_by_id($table, $data){

		// echo "<pre>";
		// echo $table;
		// print_r($data);die();


		if($table == 'article'){
			$col = array('title'=>$data['aTitle'],'shortdescription'=>$data['description'],'categoryid'=>$data[0],'content'=>$data['content']);
			$where_str = "id =".$data['articleid'];
		}else if($table == 'users'){
			$col = array('username'=>$data['username'],'email'=>$data['email'],'address'=>$data['address'],'phone'=>$data['phone'],'position'=>$data['position']);
			$where_str = "userid = ".$data['userid'];
		}else if($table == 'category'){
			$col = array('categorytitle'=>$data['Ctitle'],'Shortdescp'=>$data['description']);
			$where_str = "categoryid = ".$data['categoryid'];
		}else{
			$col = array('page_name'=>$data['pTitle'],'content'=>$data['content'],'description'=>$data['Descp'],'p_slug'=>url_title($data['pTitle'],'-',TRUE));
			$where_str = "p_id = ".$data['pageid'];
		}

		$str =	$this->db->update_string($table, $col, $where_str);

		$query = $this->db->query($str);

		return $query;

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
			$this->db->or_like('article_status', $_POST['search']['value']);
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

		if (($table1 != 'pages') && ($table1 != 'users') && ($table1 != 'category') && ($table1 != 'contact')) {

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

	public function fetchCategoryBYid($id){

		$where_str = "categoryid = ".$id;

		// echo $where_str;die();

		$this->db->select('*');
		$this->db->from('category');
		$this->db->where($where_str);

		$result = $this->db->get();

		return $result->result_array();
		

	}
	
}
