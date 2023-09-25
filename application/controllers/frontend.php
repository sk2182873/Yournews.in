<?php 

    class frontend extends CI_Controller{


        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
			$this->load->model('admin_model', 'adminModel');
        }

        

        public function fetch_articles(){

            $articles = $this->frontendModel->fetch_articles();

			// echo count($articles);
			// die();
			// echo "<pre>";
			// print_r($articles);
			// die();

            echo json_encode($articles);
        }

        public function fetch_recents(){

            $articles = $this->frontendModel->fetch_recents();

            echo json_encode($articles);
        }

        public function fetch_category(){

            $categories = $this->frontendModel->fetch_categories();

            echo json_encode($categories);
        }

		public function search(){
			
			$searchTerm = $this->input->post('data');

			$result = $this->frontendModel->search_term($searchTerm);

			echo json_encode($result);			
		}

    }
