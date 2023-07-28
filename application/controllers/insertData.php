<?php

class insertData extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

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

        if ($this->form_validation->run() == FALSE) {
            $messages['name'] = form_error('fullname');
            $messages['email'] = form_error('email');
            $messages['pos'] = form_error('position');
            $messages['pass'] = form_error('password');
        } else {
            $this->load->model('fetchDataModel', 'model1');
            $res = $this->model1->fetch_user('*', 'users');

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
                echo json_encode($messages);
            } else {

                $this->load->model('insertDataModel', 'model2');
                $res = $this->model2->insert_category_model($data);

                if ($res) {
                    $messages['success'] = "successfully created.";
                } else {
                    $messages['dbErr'] = "Database Error.";
                }

                echo json_encode($messages);
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
    }

    public function add_category()
    {
        $messages = array();
        $flag = 0;
        $data = $this->input->post();

        $this->form_validation->set_rules('CatTitle', 'Category Title', 'required');
        $this->form_validation->set_rules('Sdecp', 'Short Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $messages['cate'] = form_error('CatTitle');
            $messages['Sdecp'] = form_error('Sdecp');
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
            } else {

                $this->load->model('insertDataModel', 'model2');
                $res = $this->model2->insert_category_model($data);

                if ($res) {
                    $messages['success'] = "successfully created.";
                } else {
                    $messages['dbErr'] = "Database Error.";
                }
            }
        }
        echo json_encode($messages);
    }
}
