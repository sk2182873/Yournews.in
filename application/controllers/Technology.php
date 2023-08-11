<?php 

    class Technology extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function fetch_articles_technology(){

            $tech_article = $this->frontendModel->fetch_tech_articles();

            echo json_encode($tech_article);
        }

        public function fetch_recents_technology(){

            $tech_article = $this->frontendModel->fetch_recents_tech_articles();

            echo json_encode($tech_article);
        }

    }

?>