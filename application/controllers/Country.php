<?php 

    class Country extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function fetch_articles_country(){

            $country_article = $this->frontendModel->fetch_country_article();


            echo json_encode($country_article);

        }

        public function fetch_recents_country(){
            $country_article = $this->frontendModel->fetch_recents_country_article();


            echo json_encode($country_article);
        }
    }

?>