<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class admin extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
        }

        public function is_session(){
            if(!isset($this->session->userdata['id'])){
                redirect('admin/');
            }
        }

        public function login(){
            $this->load->view('adminLogin');
        }

        public function logout(){
            session_unset();
            session_destroy();
            redirect('admin/');
        }

        public function register(){
            $this->load->view('adminRegister');
        }

        public function forgot_pass(){
            $this->load->view('forgotPassword');
        }

        public function reset_pass(){
            $this->load->view('genPassword');
        }

        public function dashboard(){
            $this->is_session();
            $this->load->view('dashboard');
        }

        public function articleForm(){
            $this->is_session();
            $this->load->view('addarticleForm');
        }

        public function addUserForm(){
            $this->is_session();
            $this->load->view('addUserForm');
        }

        public function addBlogForm(){
            $this->is_session();
            $this->load->view('addBlogForm');
        }

        public function addUser(){
            $this->is_session();
            $this->load->view('addUser');
        }

        public function addArticle(){
            $this->is_session();
            $this->load->view('addArticle');
        }

        public function addBlog(){
            $this->is_session();
            $this->load->view('addBlog');
        }

        public function account(){
            $this->is_session();
            $this->load->view('account');
        }

        
    } 

?>