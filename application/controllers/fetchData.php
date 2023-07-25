<?php

    class fetchData extends CI_Controller{

        public function fetch_user_data(){

            $this->load->model('fetchDataModel','model');
            $userdata = $this->model->fetch_user("*",'users');

            $data = array();
            foreach($userdata as $key => $value){
                $data['data'][] = array(
                    $value['username'],
                    $value['email'],
                    $value['position'],
                    $value['user_status'],
                    "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
                );
            }

            echo json_encode($data);
        }

    }

?>