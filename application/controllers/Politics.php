<?php 

 class Politics extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontendmodel','frontendModel');
    }

    public function fetch_articles_politics(){

        $politics_article = $this->frontendModel->fetch_politics_article();

        echo json_encode($politics_article);

    }

    public function fetch_recents_politics(){
        
        $politics_article = $this->frontendModel->fetch_recents_politics_article();

        echo json_encode($politics_article);
    }

 }

?>