<?php

    class Education extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function fetch_articles_education(){

            $education_article = $this->frontendModel->fetch_education_article();

            echo json_encode($education_article);

        }

        public function fetch_recents_education(){

            $education_article = $this->frontendModel->fetch_recents_education();

            echo json_encode($education_article);

        }

    }

?>