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
            $res = $this->model1->fetch_user('*','users');

            foreach($res as $key => $value){
                
                if($value['email'] == $data['email']){
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
}
