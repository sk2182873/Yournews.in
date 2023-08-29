<?php

    class Article extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function index($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);

        }
        
    }

?>
