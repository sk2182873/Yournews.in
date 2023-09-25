<?php

class Pages extends CI_Controller
{


	public function __construct()
	{
		
		parent::__construct();
		$this->load->model('admin_model', 'adminModel');
		$this->load->model('frontendmodel','frontendModel');
		
	}

	public function index($id){

		$data = array();
		$data['page'] = $this->adminModel->getPageById($id);
		$data['link'] = $this->adminModel->get_all_routes();
		$categories = $this->frontendModel->fetch_categories();
		$data['categories'] = $categories;


		// echo "<pre>";
		// print_r($page);
		// die();

		$this->load->view('frontEnd/pages', ['data'=>$data]);
		$this->load->view('frontEnd/footer', ['data'=>$data]);
	}

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
        $this->load->view('userList');
    }

    public function addarticle()
    {
        $this->session_collison();
        $this->load->view('addarticle');
    }

    public function addblogs()
    {
        $this->session_collison();
        $this->load->view('addBlogForm');
    }

    public function articles()
    {
        $this->session_collison();
        $this->load->view('articleList');
    }

    public function blogs()
    {
        $this->session_collison();
        $this->load->view('addBlog');
    }

	public function category(){
		$this->session_collison();
        $this->load->view('category');
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

	public function addpage(){
		$this->session_collison();
		$this->load->view('addPage');
	}

	public function pagesList(){
		$this->session_collison();
		$this->load->view('pagesList');
	}
}
