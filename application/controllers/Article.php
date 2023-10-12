<?php

class Article extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('frontendmodel', 'frontendModel');
		$this->load->model('admin_model', 'adminModel');
	}

	public function index($category,$slug)
	{
		

		$article = $this->frontendModel->fetch_article_by_slug($slug);


		$data['link'] = $this->adminModel->get_all_routes();

		$categories = $this->frontendModel->fetch_categories();

		$data['page'] = '';
		$data['categories'] = $categories;
		$data['articles'] = $article;

		
		$this->load->view('frontEnd/header2', ['data'=>$data]);
		$this->load->view('frontEnd/details', ['data'=>$data]);
		$this->load->view('frontEnd/footer',  ['data'=>$data]);
	 }
}
