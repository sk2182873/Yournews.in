<?php

class fetchData extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('frontendmodel', 'frontModel');
		$this->load->model('fetchDataModel', 'fetchModel');
		$this->load->model('common_model', 'commonModel');
	}

	public function fetch_users(){

		$id = $this->input->post('id');

		$users = $this->commonModel->fetch_table('users', 'userid', $id);

		echo json_encode($users);
	}

	
	public function fetch_pages(){
		$pageid = $this->input->post('id');

		$pages = $this->commonModel->fetch_table('pages', 'p_id', $pageid);

		echo json_encode($pages);
	}

	public function fetch_article(){

		$categorytitle = '';
		$categoryid = '';

		$articleid = $this->input->post('artielid');

		$articles = $this->commonModel->fetch_table('article', 'id', $articleid);
		
		foreach($articles as $row){
			$categoryid = $row['categoryid'];
		}


		$categories = $this->commonModel->fetch_category();

		foreach($categories as $row){
			if($row['categoryid'] == $categoryid){
				$categorytitle = $row['categorytitle'];
			}
		}


		array_push($articles, $categorytitle);
		array_push($articles, $categories);

		// echo $categorytitle."<br>";
		// echo "<pre>";
		// print_r($articles);
		// die();

		echo json_encode($articles);

	}

	public function fetch_category_data()
	{
		

		$res = $this->fetchModel->fetch_category();

		foreach ($res as $row) {
			$category[] = $row['categorytitle'];
			$categoryid[] = $row['categoryid'];
			
		}
		echo json_encode(array("category" => $category, "categoryid" => $categoryid));
	}


	public function fetch_user_data()
	{


		$userdata = $this->fetchModel->fetch_data("*", 'users');

		$data = array();
		foreach ($userdata as $key => $value) {
			$data['data'][] = array(
				$value['username'],
				$value['email'],
				$value['address'],
				$value['phone'],
				$value['position'],
				$value['user_status'],
				"<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
			);
		}

		echo json_encode($data);
	}

	public function fetch_blog_data()
	{


		$userdata = $this->fetchModel->fetch_blog();

		$data = array();
		foreach ($userdata as $key => $value) {
			$data['data'][] = array(
				$value['title'],
				$value['date'],
				$value['shortdescp'],
				strip_tags(substr($value['content'], 0, 100)) . " ......",
				$value['categorytitle'],
				$value['status'],
				"<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
			);
		}

		echo json_encode($data);
	}

	public function fetch_articles_by_category($category)
	{

		$result = $this->frontModel->fetchArticlesByCategory($category);

		echo json_encode($result);
	}

	public function fetch_recent_articles_by_category($category)
	{

		$result = $this->frontModel->fetchRecentArticlesById($category);

		echo json_encode($result);
	}
}
