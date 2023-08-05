<?php

class pages extends CI_Controller
{

    public function is_session_admin()
    {
        if (!isset($this->session->userdata['id'])) {
            redirect('admin/');
        }
    }

    public function is_session_user(){
        if (!isset($this->session->userdata['userid'])) {
            redirect('user/');
        }
    }

    public function session_collison(){
        $roll = $this->session->userdata['roll'];
        // echo $roll;die();
        if($roll == 'user'){
           $this->is_session_user();
        }else{
            $this->is_session_admin();
        }
    }

    public function addusers()
    {
        $this->session_collison();
        $this->load->view('addUserForm');
    }

    public function users()
    {
        $this->session_collison();
        $this->load->view('addUser');
    }

    public function addarticle()
    {
        $this->session_collison();
        $this->load->view('addarticleForm');
    }

    public function addblogs()
    {
        $this->session_collison();
        $this->load->view('addBlogForm');
    }

    public function articles()
    {
        $this->session_collison();
        $this->load->view('addArticle');
    }

    public function blogs()
    {
        $this->session_collison();
        $this->load->view('addBlog');
    }

    public function account()
    {
        $this->session_collison();
        $this->load->view('account');
    }

    public function dashboard()
    {   
        $this->session_collison();
        $this->load->view('dashboard');
    }
}
