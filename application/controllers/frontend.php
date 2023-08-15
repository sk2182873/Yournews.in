<?php 

    class frontend extends CI_Controller{


        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        

        public function fetch_articles(){

            $articles = $this->frontendModel->fetch_articles();

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

    }

?>