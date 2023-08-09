<?php

class common extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model', 'commonModel');
    }

    public function add_article()
    {
        $messages = array();

        $data = $this->input->post();

        $this->form_validation->set_rules('title', 'Article Title', 'required');
        $this->form_validation->set_rules('Sdescp', 'Short Description', 'required');
        $this->form_validation->set_rules('Category', 'Category', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');



        if ($this->form_validation->run() == FALSE) {
            $messages['atitle'] = form_error('title');
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

           
            $category_id = $this->commonModel->fetch_category_id($cate_title);

            if ($category_id) {
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $messages['imageErr']  = $this->upload->display_errors();
                }

                $full_path = $this->upload->data('full_path');

                $explodepath = explode('/', $full_path);

                $path = $explodepath[4].'/'.$explodepath[5];
                
               
                $res = $this->commonModel->insert_article($data, $category_id,$path);

                if ($res) {
                    $messages['success'] = "Successfully Added";
                } else {
                    $messages['dbErr'] = "Database Error";
                }
            }
        }

        echo json_encode($messages);
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

            $category_id = $this->commonModel->fetch_category_id($cate_title);

            if ($category_id) {
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('pictures')) {
                    $messages['imageErr']  = $this->upload->display_errors();
                }

                $full_path = $this->upload->data('full_path');
               
                $res = $this->commonModel->insert_blog($data, $category_id);

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
        
            $res = $this->commonModel->fetch_category();

            foreach ($res as $row) {
                if (strtolower($row['categorytitle']) == strtolower($data['CatTitle'])) {
                    $flag = 1;
                }
            }


            if ($flag) {
                $messages['exist'] = "already exist.";
              
            } else {

                $res = $this->commonModel->insert_category_model($data);

                if ($res) {
                    $messages['success'] = "successfully created.";
                } else {
                    $messages['dbErr'] = "Database Error.";
                }

            }
        }

        echo json_encode(array("messages" => $messages));
    }
}
?>