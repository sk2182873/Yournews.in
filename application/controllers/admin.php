<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model', 'commonModel');
        $this->load->model('admin_model', 'adminModel');
        $this->load->model('authenticate_model','authenticateModel');
    }



    public function login()
    {
        $user = array();
        $user['roll'] = 'admin';
        $this->session->set_userdata($user);
        $this->load->view('adminlogin_panel');
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('admin/');
    }



    public function forgot_pass()
    {
        $this->load->view('admin_forgot_password');
    }

    public function reset_pass()
    {
        $this->load->view('admin_gen_password');
    }


    // <---------------------------------------------------------------------- admin functions ------------------------------------------------------------------------------>

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
        $res = $this->commonModel->fetch_category();

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
}
