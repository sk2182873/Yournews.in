<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function is_session()
    {

        if (!isset($this->session->userdata['id'])) {
            redirect('admin/');
        }
    }

    public function login()
    {
        $this->load->view('adminlogin_panel');
    }



    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('admin/');
    }

    public function register()
    {
        $this->load->view('adminRegister');
    }

    public function forgot_pass()
    {
        $this->load->view('admin_forgot_password');
    }

    public function reset_pass()
    {
        $this->load->view('genPassword');
    }

    public function dashboard()
    {
        $this->is_session();
        $this->load->view('dashboard');
    }

    public function addarticle()
    {
        $this->is_session();
        $this->load->view('addarticleForm');
    }

    public function addusers()
    {
        $this->is_session();
        $this->load->view('addUserForm');
    }

    public function addblogs()
    {
        $this->is_session();
        $this->load->view('addBlogForm');
    }

    public function users()
    {
        $this->is_session();
        $this->load->view('addUser');
    }

    public function articles()
    {
        $this->is_session();
        $this->load->view('addArticle');
    }

    public function blogs()
    {
        $this->is_session();
        $this->load->view('addBlog');
    }

    public function account()
    {
        $this->is_session();
        $this->load->view('account');
    }

    // admin functions

    public function update_pass()
    {

        $messages = array();
        $email = $this->input->get('id');
        $pass = $this->input->post('password');
        $cnfPass = $this->input->post('cnf-password');

        if ($pass == $cnfPass) {
            $this->load->model('insertDataModel', 'model');
            $res = $this->model->update_password($email, $cnfPass);
        } else {
            $messages['notMatched'] = "Password not matched.";
            echo json_encode($messages);
        }
    }

    public function add_user()
    {

        $messages = array();

        $data = $this->input->post();



        // set validations
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('position', 'Position', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $messages['name'] = form_error('fullname');
            $messages['email'] = form_error('email');
            $messages['pos'] = form_error('position');
            $messages['pass'] = form_error('password');
            $messages['phone'] = form_error('phone');
            $messages['address'] = form_error('address');
        } else {
            $this->load->model('fetchDataModel', 'model1');
            $res = $this->model1->fetch_data('*', 'users');

            foreach ($res as $key => $value) {

                if ($value['email'] == $data['email']) {
                    $messages['exist'] = "User Exist.";
                    echo json_encode($messages);
                    return;
                }
            }

            $this->load->model('insertDataModel', 'model2');

            $response = $this->model2->insert_user_profile_data($data);

            if ($response) {
                $messages['success'] = 'Successfully Added.';
            } else {
                $messages['Derror'] = "Database Error.";
            }
        }

        echo json_encode($messages);
    }

    public function add_article()
    {
        $messages = array();

        $data = $this->input->post();

        $this->form_validation->set_rules('Atitle', 'Article Title', 'required');
        $this->form_validation->set_rules('Sdescp', 'Short Description', 'required');
        $this->form_validation->set_rules('Category', 'Category', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');



        if ($this->form_validation->run() == FALSE) {
            $messages['atitle'] = form_error('Atitle');
            $messages['sdecp'] = form_error('Sdescp');
            $messages['categ'] = form_error('Category');
            $messages['cont'] = form_error('content');
        } else {
            $config['filename'] = time();
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG|GIF';
            $config['max_size']     = '24000000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';

            $cate_title = strtolower($this->input->post('Category'));

            $this->load->model('fetchDataModel', 'model1');
            $category_id = $this->model1->fetch_category_id($cate_title);

            if ($category_id) {
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $messages['imageErr']  = $this->upload->display_errors();
                }

                $full_path = $this->upload->data('full_path');
                $this->load->model('insertDataModel', 'model');
                $res = $this->model->insert_article($data, $full_path, $category_id);

                if ($res) {
                    $messages['success'] = "Successfully Added";
                } else {
                    $messages['dbErr'] = "Database Error";
                }
            }
        }

        echo json_encode($messages);
    }

    public function insert_category()
    {

        $messages = array();
        $flag = 0;
        $data = $this->input->post();

        $this->form_validation->set_rules('CatTitle', 'Category Title', 'required');
        $this->form_validation->set_rules('Sdecp', 'Short Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $messages['cate'] = form_error('CatTitle');
            $messages['Sdecp'] = form_error('Sdecp');

            echo json_encode($messages);
        } else {
            $this->load->model('fetchDataModel', 'model1');
            $res = $this->model1->fetch_category();

            foreach ($res as $row) {
                if (strtolower($row['categorytitle']) == strtolower($data['CatTitle'])) {
                    $flag = 1;
                }
            }


            if ($flag) {
                $messages['exist'] = "already exist.";
                echo json_encode(array("messages" => $messages));
            } else {

                $this->load->model('insertDataModel', 'model2');
                $res = $this->model2->insert_category_model($data);

                if ($res) {
                    $messages['success'] = "successfully created.";
                } else {
                    $messages['dbErr'] = "Database Error.";
                }

                echo json_encode(array("messages" => $messages));
            }
        }
    }

    public function add_blog()
    {
        $messages = array();

        $data = $this->input->post();

        $this->form_validation->set_rules('Btitle', 'Blog Title', 'required');
        $this->form_validation->set_rules('Sdescp', 'Short Description', 'required');
        $this->form_validation->set_rules('Category', 'Category', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');



        if ($this->form_validation->run() == FALSE) {
            $messages['atitle'] = form_error('Btitle');
            $messages['sdecp'] = form_error('Sdescp');
            $messages['categ'] = form_error('Category');
            $messages['cont'] = form_error('content');
        } else {
            $config['filename'] = time();
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG|GIF';
            $config['max_size']     = '24000000';
            $config['max_width'] = '5000';
            $config['max_height'] = '5000';

            $cate_title = strtolower($this->input->post('Category'));

            $this->load->model('fetchDataModel', 'model1');
            $category_id = $this->model1->fetch_category_id($cate_title);

            if ($category_id) {
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('pictures')) {
                    $messages['imageErr']  = $this->upload->display_errors();
                }

                $full_path = $this->upload->data('full_path');
                $this->load->model('insertDataModel', 'model');
                $res = $this->model->insert_blog($data, $full_path, $category_id);

                if ($res) {
                    $messages['success'] = "Successfully Added";
                } else {
                    $messages['dbErr'] = "Database Error";
                }
            }
        }

        echo json_encode($messages);
        // echo json_encode($data);
        // echo json_encode($_FILES['pictures']['name']);
    }

    public function update_profile()
    {

        $data = $this->input->post();

        echo "<pre>";
        print_r($data);
        echo $_FILES['profile']['name'];

        $this->form_validation->set_rules('firstName', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($_FILES['profile']['name']) {

                $config['filename'] = time();
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG|GIF';
                $config['max_size']     = '24000000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile')) {
                    $messages['imageErr']  = $this->upload->display_errors();
                }

                // $full_path = $this->upload->data('full_path');
                // $this->load->model('insertDataModel', 'model');
                // $res = $this->model->insert_article($data, $full_path, $category_id);

                // if ($res) {
                //     $messages['success'] = "Successfully Added";
                // } else {
                //     $messages['dbErr'] = "Database Error";
                // }

            }
        }
    }

    public function fetch_user_data()
    {

        $this->load->model('fetchDataModel', 'model');
        $userdata = $this->model->fetch_data("*", 'users');

        $data = array();
        foreach ($userdata as $key => $value) {
            $data['data'][] = array(
                $value['username'],
                $value['email'],
                $value['address'],
                $value['phone'],
                $value['position'],
                $value['user_status'],
                "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
            );
        }

        echo json_encode($data);
    }

    //fetch article from database
    public function fetch_article_data()
    {

        $this->load->model('fetchDataModel', 'model');
        $userdata = $this->model->fetch_article();

        $data = array();
        foreach ($userdata as $key => $value) {
            $data['data'][] = array(
                $value['title'],
                $value['date'],
                $value['shortdescription'],
                strip_tags(substr($value['content'], 0, 100)) . " .......",
                $value['categorytitle'],
                $value['status'],
                "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
            );
        }

        echo json_encode($data);
    }

    public function fetch_category_data()
    {

        $this->load->model('fetchDataModel', 'model');
        $res = $this->model->fetch_category();

        foreach ($res as $row) {
            $category[] = $row['categorytitle'];
            $categoryid[] = $row['categoryid'];
        }


        echo json_encode(array("category" => $category, "categoryid" => $categoryid));
    }


    public function fetch_blog_data()
    {

        $this->load->model('fetchDataModel', 'model');
        $userdata = $this->model->fetch_blog();

        $data = array();
        foreach ($userdata as $key => $value) {
            $data['data'][] = array(
                $value['title'],
                $value['date'],
                $value['shortdescp'],
                strip_tags(substr($value['content'], 0, 100)) . " ......",
                $value['categorytitle'],
                $value['status'],
                "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
            );
        }

        echo json_encode($data);
    }
}
