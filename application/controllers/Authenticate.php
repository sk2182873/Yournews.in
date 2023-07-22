<?php

class authenticate extends CI_Controller
{

    public function authentication()
    {
        $username = $this->input->post('email-username');
        $password = $this->input->post('password');
        $messages = array();
        $errors = array();

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
}
