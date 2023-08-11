<?php 


    class Entertainment extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }


        public function fetch_articles_entertainment(){

            $enter_article = $this->frontendModel->fetch_enter_articles();

            echo json_encode($enter_article);

        }

        public function fetch_recents_entertainment(){
            
            $enter_article = $this->frontendModel->fetch_recents_enter_articles();

            echo json_encode($enter_article);
        }
    }

?>