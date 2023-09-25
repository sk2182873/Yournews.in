<?php

class common extends CI_Controller
{

	public $messages = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common_model', 'commonModel');
		$this->load->model('fetchDataModel', 'fetchModel');
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
			$config['upload_path'] = 'uploads/admin/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG|GIF';
			$config['max_size']     = '24000000';
			$config['max_width'] = '5000';
			$config['max_height'] = '5000';

			$this->load->library('upload', $config);

			if ($_FILES['profile']['name']) {
				$this->upload->do_upload('profile');

				$full_path = $this->upload->data('full_path');

				$exploded_url = explode('/', $full_path);

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

		$url_slug = url_title($title, '-', TRUE);


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

				$path = $explodepath[4] . '/' . $explodepath[5];


				$res = $this->commonModel->insert_article($data, $category_id, $path, $url_slug);

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

				$path = $explodepath[4] . '/' . $explodepath[5];

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
		// print_r($data);
		// die();

		$this->form_validation->set_rules('CatTitle', 'Category Title', 'required|alpha');
		$this->form_validation->set_rules('Sdescp', 'Short Description', 'required');

		if ($this->form_validation->run() == FALSE) {
		
			$messages['cate'] = form_error('CatTitle');
			$messages['Sdecp'] = form_error('Sdescp');

		} else {

			$res = $this->commonModel->fetch_category();

			// echo "<pre>";
			// print_r($res);
			// die();

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

		echo json_encode($messages);
	}

	public function delete_article()
	{



		$id = $this->input->post('delId');

		$res = $this->commonModel->delete_row_by_id('article', 'id', $id);

		if ($res) {
			$messages['success'] = "success";
		} else {
			$messages['error'] = "error";
		}

		echo json_encode($messages);
	}

	public function fetch_article_data()
	{

		$statusBtn = '';

		$articledata = $this->commonModel->fetch_article();

		$noOfRows = $this->commonModel->get_filteredData('article', 'category');

		$data = array();

		// echo "<pre>";
		// print_r($userdata);
		// die();

		foreach ($articledata as $row) {

			if ($row['article_status'] == 1) {
				$statusBtn = '<button type="button" class="btn bg-success btn-success p-1 status" style="font-size: 10px" data-id="'. $row['id'] . '">show</button>';
			} else {
				$statusBtn = '<button type="button" class="btn bg-danger btn-danger p-1 status" style="font-size: 10px" data-id="'. $row['id'] . '">hide</button>';
			}

			$sub_array = array();

			$sub_array[] = $row['title'];
			$sub_array[] = $row['date'];
			$sub_array[] = $row['shortdescription'];
			$sub_array[] = ucfirst($row['categorytitle']);
			$sub_array[] = $statusBtn;
			$sub_array[] = '<button type="button" class="btn btn-primary text-white  bg-primary px-2 actionBtn" style="font-size: 10px"  id="edt" value="' . $row['id'] . '"><i class="fas fa-pen border-0"></i></button>
							<button type="button" class="btn btn-danger text-white bg-danger px-2 actionBtn" style="font-size: 10px"  id="del" value="' . $row['id'] . '"><i class="fas fa-trash"></i></button>';

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

	public function update_user_status()
	{

		$current_status = "";

		$id = $this->input->post('data');

		$userdata = $this->commonModel->fetch_table('users', 'userid', $id);

		foreach ($userdata  as $row) {
			$current_status = $row['user_status'];
		}


		if ($current_status == 1) {
			/* change_status(): function take 5 arguments.
				$table = table to be update,
				$column = column to be update,
				$value = value to be update,
				$where_col = condition table,
				$id = condition value	
			*/

			$result = $this->commonModel->change_status('users', 'user_status', 0, 'userid', $id);
		} else {
			$result = $this->commonModel->change_status('users', 'user_status', 1, 'userid', $id);
		}

		echo json_encode($result);
	}

	public function update_article_status()
	{

		$current_status = "";

		$id = $this->input->post('data');

		$userdata = $this->commonModel->fetch_table('article', 'id', $id);

		foreach ($userdata  as $row) {
			$current_status = $row['article_status'];
		}


		if ($current_status == 1) {
			/* change_status(): function take 5 arguments.
				$table = table to be update,
				$column = column to be update,
				$value = value to be update,
				$where_col = condition table,
				$id = condition value	
			*/

			$result = $this->commonModel->change_status('article', 'article_status', 0, 'id', $id);
		} else {
			$result = $this->commonModel->change_status('article', 'article_status', 1, 'id', $id);
		}

		echo json_encode($result);
	}

	public function update_article()
	{

		$articledata = $this->input->post();

		$category = $articledata['category'];

		$categoryid = $this->commonModel->fetch_category_id($category);

		array_push($articledata, $categoryid);

		$result = $this->commonModel->update_table_by_id('article', $articledata);

		if ($result) {
			$messages['success'] = "Successfully Updated.";
		} else {
			$messages['Err'] = "Sorry! Please Try Again.";
		}

		echo json_encode($messages);
	}

	public function fetch_category_data()
	{

		$statusBtn = '';


		$categorydata = $this->fetchModel->fetch_category();
		$noOfRows = $this->commonModel->get_filteredData('category');

		// echo $noOfRows;
		// die();

		foreach ($categorydata as $row) {


			if ($row['status'] == 1) {
				$statusBtn = '<button type="button" class="text-success status" value="show" data-id="' . $row['categoryid'] . '">show</button>';
			} else {
				$statusBtn = '<button type="button" class="text-danger status" value="hide" data-id="' . $row['categoryid'] . '">hide</button>';
			}

			$sub_array = array();

			$sub_array[] = ucfirst($row['categorytitle']);
			$sub_array[] = $row['categorydate'];
			$sub_array[] = $row['Shortdescp'];
			$sub_array[] = $statusBtn;
			$sub_array[] = '<button type="button" class="text-primary actionBtn" id="edt" value="' . $row['categoryid'] . '">Edit</button>';

			$data[] = $sub_array;
		}

		$output = array(
			"draw" => intval($_POST["draw"]),
			"recordsTotal" => $this->commonModel->get_all_data("category"),
			"recordsFiltered" => $noOfRows,
			"data" => $data
		);

		echo json_encode($output);
	}

	public function update_category_status(){
		$current_status = "";

		$id = $this->input->post('data');

		$categorydata = $this->commonModel->fetch_table('category', 'categoryid', $id);

		foreach ($categorydata as $row) {
			$current_status = $row['status'];
		}


		if ($current_status == 1) {
			/* change_status(): function take 5 arguments.
				$table = table to be update,
				$column = column to be update,
				$value = value to be update,
				$where_col = condition table,
				$id = condition value	
			*/

			$result = $this->commonModel->change_status('category', 'status', 0, 'categoryid', $id);
		} else {
			$result = $this->commonModel->change_status('category', 'status', 1, 'categoryid', $id);
		}

		echo json_encode($result);
	}

	public function fetch_category_by_id(){

		$categoryid = $this->input->post('categoryid');

		$res = $this->commonModel->fetchCategoryBYid($categoryid);

		echo json_encode($res);

	}

	public function update_category(){

		$data =  $this->input->post();

		$res = $this->commonModel->update_table_by_id('category', $data);	

		if($res){
			$messages['success'] = "Successfully Update.";
		}else{
			$messages['Err'] = "Sorry! couldn't update please try again.";
		}

		echo json_encode($messages);
	}

	// public function delete_category(){
	// 	$categoryid = $this->input->post('delId');

	// 	$this->commonModel->delete_row_by_id('category', 'categoryid', $categoryid);
	// } 
}
