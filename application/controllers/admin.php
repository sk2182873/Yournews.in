<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class admin extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
        }

        public function dashboard(){
            $this->load->view('dashboard');
        }

        public function articleForm(){
            $this->load->view('addarticleForm');
        }

        public function addUserForm(){
            $this->load->view('addUserForm');
        }

        public function addBlogForm(){
            $this->load->view('addBlogForm');
        }

        public function addUser(){
            $this->load->view('addUser');
        }

        public function addArticle(){
            $this->load->view('addArticle');
        }

        public function addBlog(){
            $this->load->view('addBlog');
        }

        public function login(){
            $this->load->view('adminLogin');
        }

        public function register(){
            $this->load->view('adminRegister');
        }
    } 

?>