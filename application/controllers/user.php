<?php

class user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login(){
        $user = array();
        $user['roll'] = 'user';
        $this->session->set_userdata($user);
        $this->load->view('userlogin');
    }

    public function reset_pass(){
        $this->load->view('genPassword');
    }

    public function forgot_password(){
        $this->load->view('forgotPassword');
    }

    public function logout(){
        session_unset();
        session_destroy();
        redirect('user/');
    }
}
