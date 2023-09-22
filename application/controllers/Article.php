<?php

class Article extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('frontendmodel', 'frontendModel');
		$this->load->model('admin_model', 'adminModel');
	}

	public function index($id)
	{

		$article = $this->frontendModel->fetch_article_by_id($id);

		$data['link'] = $this->adminModel->get_all_routes();

		$categories = $this->frontendModel->fetch_categories();

		
		$this->load->view('frontEnd/header2', ['categories'=>$categories]);
		$this->load->view('frontEnd/details', ['art' => $article]);
		$this->load->view('frontEnd/footer',  ['data'=>$data]);
	}
}
