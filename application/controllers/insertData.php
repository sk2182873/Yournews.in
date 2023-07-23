<?php

    class insertData extends CI_Controller{

        public function __construct()
        {
            parent::__construct();
        }

        public function update_pass(){

            $messages = array();
            $email = $this->input->get('id');
            $pass = $this->input->post('password');
            $cnfPass = $this->input->post('cnf-password');

            if($pass == $cnfPass){
               $this->load->model('insertDataModel','model');
               $res = $this->model->update_password($email,$cnfPass);
            }else{
                $messages['notMatched'] = "Password not matched.";
                echo json_encode($messages);
            }


        }

    }


?>