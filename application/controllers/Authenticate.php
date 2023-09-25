<?php

class authenticate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('authenticate_model', 'authenticate_model');
        $this->load->model('insertDataModel', 'insertData_model');
    }

    //admin login authentication
    public function authentication()
    {
	

        $username = $this->input->post('email-username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember-me');

        $messages = array();
        $errors = array();
        $userdata = array();


        $this->form_validation->set_rules('email-username', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
            $errors['email-username'] = form_error('email-username');
            $errors['password'] = form_error('password');

            echo json_encode($errors);
        } else {
            $data = array($username, $password);
            $users = $this->authenticate_model->fetch_admin($data);

            // var_dump($users);die();

            if ($users != 0) {
                if (($users['username'] == $username && password_verify($password, $users['pass'])) || ($users['mail'] == $username && password_verify($password, $users['pass']))) {

                    

                    // set login cookie
                    if ($remember == "on") {
                        $this->input->set_cookie('username', $users['mail'], 300);
                        $this->input->set_cookie('password', $password, 300);
                    }


                    $userdata['name'] = $users['username'];
                    $userdata['email'] = $users['mail'];
                    $userdata['id'] = $users['id'];
                    $userdata['position'] = $users['position'];
                    $userdata['alteremail'] = $users['alternative_email'];
                    $userdata['phone'] = $users['phone'];
                    $userdata['profilepic'] = $users['profilepic'];
                    $userdata['last_login_time'] = time();

                    $this->session->set_userdata($userdata);


                    $messages['matched'] = 1;
                } else {
                    $messages['incorrect'] = "Email or Password is incorrect.";
                }
            } else {
                $messages['usernot'] = "User does not exist.";
            }

            echo json_encode($messages);
        }
    }

    //password geneate link email.
    public function password_reset_link_gen()
    {

        $messages = array();
        $data = $this->input->post('email');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $messages['email'] = form_error('email');
            echo json_encode($messages);
        } else {

            $userdata = $this->authenticate_model->fetch_mail($data);

            if ($userdata == 1) {

                $this->load->library('email');

                //configure email preferences.
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;

                $this->email->initialize($config);

                $path = base_url() . 'admin/reset_pass';

                //send email.
                $this->email->from('sk2182873@gmail.com', 'aznews');
                $this->email->to($data);
                $this->email->subject("Password reset link.");
                $this->email->message("Please click below link to reset password.<br>" . "<a>$path</a>?id=$data");

                if ($this->email->send()) {
                    $messages['sent'] = "Reset link sent you successfully to your gmail.";
                    echo json_encode($messages);
                } else {
                    $messages['mailErr'] = "Mail could not be sent due to some technical issue. Please try after some time.";
                    echo json_encode($messages);
                }
            } else {

                $messages['notExist'] = "User do not exist. Please create account first.";
                echo json_encode($messages);
            }
        }
    }

    public function update_pass()
    {

        $messages = array();
        $email = $this->input->get('id');
        $pass = $this->input->post('password');
        $cnfPass = $this->input->post('cnf-password');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('cnf-password', 'Confirm Password', 'required|min_length[3]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {
            $messages['pass'] = form_error('password');
            $messages['cnfpass'] = form_error('cnf-password');
        } else {
            if ($pass == $cnfPass) {

                $res = $this->insertData_model->update_password($email, $cnfPass);
                if ($res == 1) {
                    $messages['success'] = "Password Successfully changed.";
                } else {
                    $messages['dbErr'] = "Password could not update due to some technical problem.";
                }
            } else {
                $messages['notMatched'] = "Password not matched.";
            }
        }

        echo json_encode($messages);
    }

	public function fetchAdmin(){

		$mail = $this->input->post('mail');

		$data = array();

		$data[0] = $mail;

		$adminData = $this->authenticate_model->fetch_admin($data);

		echo json_encode($adminData);
	}

}
