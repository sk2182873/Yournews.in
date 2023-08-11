<?php 

    class Sports extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function fetch_articles_sports(){

            $sports_article = $this->frontendModel->fetch_sports_article();

            echo json_encode($sports_article);

        }

        public function fetch_recents_sports(){

            $sports_article = $this->frontendModel->fetch_recents_sports_article();

            echo json_encode($sports_article);

        }

    }

?>