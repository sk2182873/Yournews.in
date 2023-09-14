<?php

class common extends CI_Controller
{

	public $messages = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model', 'commonModel');
    }

	public function fetch_user_data()
    {
		$statusBtn = '';

		$userdata = $this->commonModel->fetch_users();

		$noOfRows = $this->commonModel->get_filteredData('users');

        $data = array();
		foreach ($userdata as $row) {

			if ($row['user_status'] == 1) {
				$statusBtn = '<button type="button" class="text-success status" value="' . $row['userid'] . '">show</button>';
			} else {
				$statusBtn = '<button type="button" class="text-danger status" value="' . $row['userid'] . '">hide</button>';
			}

			$sub_array = array();

			$sub_array[] = $row['username'];
			$sub_array[] = $row['email'];
			$sub_array[] = $row['address'];
			$sub_array[] = $row['phone'];
			$sub_array[] = $row['position'];
			$sub_array[] = $statusBtn;
			$sub_array[] = '<button type="button" class="text-primary actionBtn" id="edt" value="' . $row['userid'] . '">Edit</button>
							<button type="button" class="text-danger actionBtn" id="del" value="' . $row['userid'] . '">Delete</button>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->commonModel->get_all_data("users"),
			"recordsFiltered" => $noOfRows,
			"data" => $data
		);

        echo json_encode($output);
    }

    public function update_profile()
    {

        $messages = array();
        $filename = "";

        $alteremail = $this->input->post('alteremail');


        $this->form_validation->set_rules('alteremail', 'Alternate Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            $messages['alteremail'] = form_error('alteremail');
           
        } else {


                $config['filename'] = time();
                $config['upload_path'] = './uploads/admin/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG|GIF';
                $config['max_size']     = '24000000';
                $config['max_width'] = '5000';
                $config['max_height'] = '5000';

                $this->load->library('upload', $config);

                if($_FILES['profile']['name']){
                    $this->upload->do_upload('profile');

                    $full_path = $this->upload->data('full_path');

                    $exploded_url = explode('/',$full_path);

                    $filename = $_FILES['profile']['name'];

                }

                $res = $this->commonModel->update_profile($alteremail, $filename);


                if ($res) {
                    $messages['success'] = "Successfully Update";
                } else {
                    $messages['dbErr'] = "Database Error";
                }
        }

        echo json_encode($messages);
    }

    public function add_article()
    {
        $messages = array();

        $data = $this->input->post();

		$title = $this->input->post('title');

		$url_slug = url_title($title,'-',TRUE);


        $this->form_validation->set_rules('title', 'Article Title', 'required');
        $this->form_validation->set_rules('Sdescp', 'Short Description', 'required');
        $this->form_validation->set_rules('Category', 'Category', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('meta_keys', 'Meta Keywords', 'required');



        if ($this->form_validation->run() == FALSE) {
            $messages['atitle'] = form_error('title');
            $messages['sdecp'] = form_error('Sdescp');
            $messages['categ'] = form_error('Category');
            $messages['cont'] = form_error('content');
			$messages['meta'] = form_error('meta_keys');
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
                
               
                $res = $this->commonModel->insert_article($data, $category_id,$path,$url_slug);

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

                $explodepath = explode('/', $full_path);

                $path = $explodepath[4].'/'.$explodepath[5];
               
                $res = $this->commonModel->insert_blog($data, $category_id, $path);

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

	public function delete_article(){

	

		$id = $this->input->post('delId');

		$res = $this->commonModel->delete_article_by_id($id);

		if($res){
			$messages['success'] = "success";
		}else{
			$messages['error'] = "error";
		}

		echo json_encode($messages);
	}

	public function fetch_article_data()
	{

		$statusBtn = '';

		$userdata = $this->commonModel->fetch_article();
		
		$noOfRows = $this->commonModel->get_filteredData('article', 'category');

		$data = array();

		foreach ($userdata as $row) {

			if ($row['status'] == 1) {
				$statusBtn = '<button type="button" class="text-success status" value="' . $row['id'] . '">show</button>';
			} else {
				$statusBtn = '<button type="button" class="text-danger status" value="' . $row['id'] . '">hide</button>';
			}

			$sub_array = array();

			$sub_array[] = $row['title'];
			$sub_array[] = $row['date'];
			$sub_array[] = $row['shortdescription'];
			$sub_array[] = $row['categorytitle'];
			$sub_array[] = $statusBtn;
			$sub_array[] = '<button type="button" class="text-primary actionBtn" id="edt" value="' . $row['id'] . '">Edit</button>
							<button type="button" class="text-danger actionBtn" id="del" value="' . $row['id'] . '">Delete</button>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->commonModel->get_all_data("article"),
			"recordsFiltered" => $noOfRows,
			"data" => $data
		);


		echo json_encode($output);
	}

	public function fetch_pages(){

		$statusBtn = '';

		$userdata = $this->commonModel->fetchPages();
		$noOfRows = $this->commonModel->get_filteredData('pages');

		$data = array();

		foreach ($userdata as $row) {

			if ($row['p_status'] == 1) {
				$statusBtn = '<button type="button" class="text-success status" value="' . $row['p_id'] . '">show</button>';
			} else {
				$statusBtn = '<button type="button" class="text-danger status" value="' . $row['p_id'] . '">hide</button>';
			}

			$sub_array = array();

			$sub_array[] = $row['page_name'];
			$sub_array[] = $row['created_at'];
			$sub_array[] = $row['description'];
			$sub_array[] = $statusBtn;
			$sub_array[] = '<button type="button" class="text-primary actionBtn" id="edt" value="' . $row['p_id'] . '">Edit</button>
							<button type="button" class="text-danger actionBtn" id="del" value="' . $row['p_id'] . '">Delete</button>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->commonModel->get_all_data('pages'),
			"recordsFiltered" => $noOfRows,
			"data" => $data
		);


		echo json_encode($output);
	}

	public function delete_page(){

		

	}
}
