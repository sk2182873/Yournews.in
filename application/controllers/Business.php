<?php 

    class Business extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function fetch_recents_business(){
            
            $business_article = $this->frontendModel->fetch_recent_articles_business();

            echo json_encode($business_article);
        }

        public function fetch_articles_business(){

           $business_article = $this->frontendModel->fetch_articles_business();

           echo json_encode($business_article);

        }

       

    }


?>