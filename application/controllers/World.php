<?php 

    class World extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
            $this->load->model('frontendmodel','frontendModel');
        }

        public function fetch_articles_world(){

            $world_aticles = $this->frontendModel->fetch_world_articles();

            echo json_encode($world_aticles);

        }

        public function fetch_recents_world(){
            $world_aticles = $this->frontendModel->fetch_recents_world_articles();

            echo json_encode($world_aticles);
        }

    }

?>
