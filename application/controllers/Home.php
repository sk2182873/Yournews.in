<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller{

		public $data = array();		

        public function __construct()
        {
            parent::__construct();
			$this->load->model('admin_model', 'adminModel');
			$this->load->model('frontendmodel','frontendModel');
        }

        public function index(){


			$data['link'] = $this->adminModel->get_all_routes();
			$categories = $this->frontendModel->fetch_categories();

			$articles = $this->frontendModel->fetch_recents();

			$data['page'] = '';
			$data['articles'] = $articles;
			$data['categories'] = $categories;

			$this->load->view('frontEnd/header2', ['data'=>$data]);
            $this->load->view('frontEnd/index', ['data'=>$data]);
			$this->load->view('frontEnd/footer', ['data'=>$data]);
        }

		public function loadPages($page){
			$data['link'] = $this->adminModel->get_all_routes();
			$categories = $this->frontendModel->fetch_categories();

			$result = $this->frontendModel->fetchRecentArticlesById($page);

			$data['page'] = $page;
			$data['articles'] = $result;
			$data['categories'] = $categories;


			$this->load->view('frontEnd/header2', ['data'=>$data]);
            $this->load->view('frontEnd/common-page', ['data'=>$data]);
			$this->load->view('frontEnd/footer', ['data'=>$data]);

		}

		
       
    }

?>
