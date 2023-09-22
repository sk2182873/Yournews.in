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

			$this->load->view('frontEnd/header2', ['categories'=>$categories]);
            $this->load->view('frontEnd/index', ['data'=>$data]);
        }

		public function loadPages($page){
			$data['link'] = $this->adminModel->get_all_routes();
			$categories = $this->frontendModel->fetch_categories();

			$data['page'] = $page;
		
			$this->load->view('frontEnd/header2', ['categories'=>$categories]);
            $this->load->view('frontEnd/common-page', ['data'=>$data]);
			$this->load->view('frontEnd/footer', ['data'=>$data]);

		}

		// public function load_search(){

		// 	$data['article'] = $this->input->post();

		// 	// var_dump($data['article']);die();

		// 	$data['link'] = $this->adminModel->get_all_routes();
		// 	$categories = $this->frontendModel->fetch_categories();

		// 	$this->load->view('frontEnd/header2', ['categories'=>$categories]);
        //     $this->load->view('frontEnd/search', ['data'=>$data]);
		// 	$this->load->view('frontEnd/footer', ['data'=>$data]);
		// }
        // public function business(){
        //     $this->load->view('frontEnd/business');
        // }

        // public function country(){
        //     $this->load->view('frontEnd/country');
        // }

        // public function education(){
        //     $this->load->view('frontEnd/education');
        // }

        // public function entertainment(){
        //     $this->load->view('frontEnd/entertainment');
        // } 

        // public function politics(){
        //     $this->load->view('frontEnd/politics');
        // }

        // public function sports(){
        //     $this->load->view('frontEnd/sports');
        // }

        // public function technology(){
        //     $this->load->view('frontEnd/technology');
        // }

        // public function world(){
        //     $this->load->view('frontEnd/world');
        // }

		// public function search(){
		// 	$this->load->view('frontEnd/search');
		// }
       
    }

?>
