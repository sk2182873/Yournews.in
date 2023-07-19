<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class Views extends CI_Controller{


        public function index(){
            $this->load->view('frontEnd/index');
        }

       

    }

?>