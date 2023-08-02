<?php

class authenticate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authentication()
    {

        $username = $this->input->post('email-username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember-me');

        $messages = array();
        $errors = array();
        $userdata = array();


        $this->form_validation->set_rules('email-username', 'Username or Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[8]');

        if ($this->form_validation->run() == FALSE) {
            $errors['email-username'] = form_error('email-username');
            $errors['password'] = form_error('password');

            echo json_encode($errors);
        } else {
            $data = array($username, $password);
            $this->load->model('authenticate_model', 'login');
            $users = $this->login->fetch_user($data);


            if ($users != 0) {
                if (($users['username'] == $username && password_verify($password, $users['pass'])) || ($users['mail'] == $username && password_verify($password, $users['pass']))) {

                    // set login cookie
                    if ($remember == "on") {
                        $this->input->set_cookie('username', $users['mail'],300);
                        $this->input->set_cookie('password', $password,300);
                    }


                    $userdata['name'] = $users['username'];
                    $userdata['email'] = $users['mail'];
                    $userdata['id'] = $users['id'];
                    $userdata['position'] = $users['position'];
                    $userdata['last_login_time'] = time();

                    $this->session->set_userdata($userdata);

                    $messages['matched'] = 1;
                } else {
                    $messages['incorrect'] = "Email or Password is incorrect.";
                }
            } else {
                $messages['usernot'] = "User does not exist. Please! create account first from below link.";
            }

            echo json_encode($messages);
        }
    }


    //Register User.
    public function register()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);


        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[12]');

        if ($this->form_validation->run() == FALSE) {

            $errors = array(
                'username' => form_error('username'),
                'email' => form_error('email'),
                'password' => form_error('password')
            );
            echo json_encode($errors);
        } else {
            $data = array($username, $email, $password);

            $this->load->model('authenticate_model', 'rM');
            if ($this->rM->fetch_mail($email) == 0) {
                $res = $this->rM->register_admin($data);
                if ($res) {
                    $errors['sussmsg'] = "Successfully Registered.";
                    echo json_encode($errors);
                    return;
                }
            } else {
                $errors['msg'] = "This email already exist. Please Signin below link.";
                echo json_encode($errors);
                return;
            }
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

            $this->load->model('authenticate_model', 'model');
            $userdata = $this->model->fetch_mail($data);

            if ($userdata == 1) {

                $this->load->library('email');

                //configure email preferences.
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;

                $this->email->initialize($config);

                $path = base_url().'admin/reset_pass';

                //send email.
                $this->email->from('sk2182873@gmail.com', 'aznews');
                $this->email->to($data);
                $this->email->subject("Password reset link.");
                $this->email->message("Please click below link to reset password.<br>"."<a>$path</a>?id=$data");

                if($this->email->send()){
                    $messages['sent'] = "Reset link sent you successfully to your gmail.";
                    echo json_encode($messages);
                }else{
                    $messages['mailErr'] = "Mail could not be sent due to some technical issue. Please try after some time.";
                    echo json_encode($messages);
                }
               
            } else {

                $messages['notExist'] = "User do not exist. Please create account first.";
                echo json_encode($messages);
            }
        }
    }
}
