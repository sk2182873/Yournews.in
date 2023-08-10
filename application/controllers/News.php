<?php

    class News extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function education($id){
            
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/education_news/'.$id.'/'.$url_slug));
        }

        public function education_news($id){

            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function sports($id){

            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/sports_news/'.$id.'/'.$url_slug));
        }

        public function sports_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function technology($id){
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/technology_news/'.$id.'/'.$url_slug));
        }

        public function technology_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function politics($id){
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/politics_news/'.$id.'/'.$url_slug));
        }

        public function politics_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function entertainment($id){
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/entertainment_news/'.$id.'/'.$url_slug));
        }

        public function entertainment_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function business($id){
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/business_news/'.$id.'/'.$url_slug));
        }

        public function business_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function world($id){
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/world_news/'.$id.'/'.$url_slug));
        }

        public function world_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        public function country($id){
            $article = $this->frontendModel->fetch_article_by_id($id);
            $title = $article[0]['title'];
            $url_slug = url_title($title,'-',TRUE);

            redirect(base_url('News/country_news/'.$id.'/'.$url_slug));
        }

        public function country_news($id){
            $article = $this->frontendModel->fetch_article_by_id($id);

            $this->load->view('frontEnd/details', ['art'=>$article]);
        }

        
    }

?>