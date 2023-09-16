<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('common_model', 'commonModel');
        $this->load->model('admin_model', 'adminModel');
        $this->load->model('authenticate_model','authenticateModel');
    }



    public function login(){
        $user = array();
        $user['roll'] = 'admin';
        $this->session->set_userdata($user);
        $this->load->view('adminlogin_panel');
    }

    public function logout(){
        session_unset();
        session_destroy();
        redirect('admin/');
    }



    public function forgot_pass(){
        $this->load->view('admin_forgot_password');
    }

    public function reset_pass(){
        $this->load->view('admin_gen_password');
    }


    // <---------------------------------------------------------------------- admin functions ------------------------------------------------------------------------------>

    public function add_user(){

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

            $res = $this->commonModel->fetch_data('*', 'users');

            foreach ($res as $key => $value) {

                if ($value['email'] == $data['email']) {
                    $messages['exist'] = "User Exist.";
                    echo json_encode($messages);
                    return;
                }
            }

            $response = $this->adminModel->insert_user_profile_data($data);

            if ($response) {
                $messages['success'] = 'Successfully Added.';
            } else {
                $messages['Derror'] = "Database Error.";
            }
        }

        echo json_encode($messages);
    }

	public function fetch_pages(){

		$statusBtn = '';

		$userdata = $this->adminModel->fetchPages();
		$noOfRows = $this->commonModel->get_filteredData('pages');

		$data = array();

		foreach ($userdata as $row) {

			if ($row['p_status'] == 1) {
				$statusBtn = '<button type="button" class="text-success status" value="show" data-id="'.$row['p_id'].'">show</button>';
			} else {
				$statusBtn = '<button type="button" class="text-danger status" value="hide" data-id="'.$row['p_id'].'">hide</button>';
			}

			$sub_array = array();

			$sub_array[] = $row['page_name'];
			$sub_array[] = $row['created_at'];
			$sub_array[] = $row['description'];
			$sub_array[] = substr(strip_tags($row['content']),0,100);
			$sub_array[] = $statusBtn;
			$sub_array[] = '<button type="button" class="text-primary actionBtn" id="edt" value="'.$row['p_id'].'">Edit</button>
							<button type="button" class="text-danger actionBtn" id="del" value="'.$row['p_id'].'">Delete</button>';

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

	public function update_page_status(){
		$current_status = "";

		$id = $this->input->post('data');

		// echo $id;
		// die();
		
		$pagedata = $this->commonModel->fetch_table('pages', 'p_id', $id);

		// echo "<pre>";
		// print_r($userdata);
		// die();

		foreach($pagedata  as $row){
			$current_status = $row['p_status'];
		}

		if($current_status == 1){
			/* change_status(): function take 5 arguments.
				$table = table to be update,
				$column = column to be update,
				$value = value to be update,
				$where_col = condition table,
				$id = condition value	
			*/

			$result = $this->commonModel->change_status('pages', 'p_status', 0, 'p_id', $id);

		}else{
			$result = $this->commonModel->change_status('pages', 'p_status', 1, 'p_id', $id);
		}
		
		echo json_encode($result);
	}

	public function delete_page(){
		$delid = $this->input->post('delId');

		$res = $this->commonModel->delete_row_by_id('pages', 'p_id', $delid);

		if($res){
			$messages['success'] = "success";
		}else{
			$messages['error'] = "error";
		}

		echo json_encode($messages);
	}

	public function fetch_user_data(){
		$statusBtn = '';

		$userdata = $this->adminModel->fetch_users_datatable();

		$noOfRows = $this->commonModel->get_filteredData('users');

        $data = array();
		foreach ($userdata as $row) {

			if ($row['user_status'] == 1) {
				$statusBtn = '<button type="button" class="text-success status" value="Active" data-id="' . $row['userid'] . '" title="click to change status">Active</button>';
			} else {
				$statusBtn = '<button type="button" class="text-danger status" value="Not Active" data-id="' . $row['userid'] . '" title="click to change status">Not Active</button>';
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

    //fetch article from database
    public function fetch_article_data(){

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

    public function fetch_category_data(){
        $res = $this->commonModel->fetch_category();

        foreach ($res as $row) {
            $category[] = $row['categorytitle'];
            $categoryid[] = $row['categoryid'];
        }


        echo json_encode(array("category" => $category, "categoryid" => $categoryid));
    }


    public function fetch_blog_data(){

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

	public function addPage(){

		$messages = array();
		$data = $this->input->post();


		$this->form_validation->set_rules('pagename','Page Name','required');
		$this->form_validation->set_rules('descp','Description','required');
		$this->form_validation->set_rules('content','Content','required');

		if($this->form_validation->run() == FALSE){
			$messages['pagename'] = form_error('pagename');
			$messages['descp'] = form_error('descp');
			$messages['content'] = form_error('content');
		}else{
			$data['p_slug'] = url_title($this->input->post('pagename'), '-', TRUE);

			$result = $this->adminModel->insert_page($data);
			if($result){
				$messages['success'] = "Successfully Page Created.";
				$this->save_routes();
			}else{
				$messages['error'] = "Page is not created due to technical error";
			}

		}

		echo json_encode($messages);
	}

	private function save_routes(){

		$routes = $this->adminModel->get_all_routes();
		$data = array();
		if(!empty($routes)){
			$data[] = '<?php ';
			foreach($routes as $route ){
				$data[] = '$route[\''.$route['p_slug'].'\'] = \''.'Pages'.'/'.'index/'.$route['p_id'].'\';';
			}
			
			$output = implode("\n ", $data);
			write_file(APPPATH.'cache/routes.php', $output);
		}

	}

	public function update_user(){


		$userdata = $this->input->post();

		$result = $this->commonModel->update_table_by_id('users', $userdata);

		if($result){
			$messages['success'] = "Successfully Updated.";
		}else{
			$messages['Err'] = "Sorry! Please Try Again.";
		}

		echo json_encode($messages);
	}

	public function delete_user(){
		$delid = $this->input->post('delId');

		$res = $this->commonModel->delete_row_by_id('users', 'userid', $delid);

		if($res){
			$messages['success'] = "success";
		}else{
			$messages['error'] = "error";
		}

		echo json_encode($messages);
	}

	public function update_page(){

		$pageData = $this->input->post();

		$result = $this->commonModel->update_table_by_id('pages', $pageData);

		if($result){
			$messages['success'] = "Successfully Updated.";
		}else{
			$messages['Err'] = "Sorry! Please Try Again.";
		}

		echo json_encode($messages);

	}
}
