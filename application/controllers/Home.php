<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller{

        public function __construct()
        {
            parent::__construct();

        }

        public function index(){
            $this->load->view('frontEnd/index');
        }

        public function business(){
            $this->load->view('frontEnd/business');
        }

        public function country(){
            $this->load->view('frontEnd/country');
        }

        public function education(){
            $this->load->view('frontEnd/education');
        }

        public function entertainment(){
            $this->load->view('frontEnd/entertainment');
        } 

        // public function politics(){
        //     $this->load->view('frontEnd/politics');
        // }

        public function sports(){
            $this->load->view('frontEnd/sports');
        }

        public function technology(){
            $this->load->view('frontEnd/technology');
        }

        public function world(){
            $this->load->view('frontEnd/world');
        }

		public function search(){
			$this->load->view('frontEnd/search');
		}
       
    }

?>
