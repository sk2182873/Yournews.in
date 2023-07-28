<?php

    class fetchData extends CI_Controller{

        public function fetch_user_data(){

            $this->load->model('fetchDataModel','model');
            $userdata = $this->model->fetch_data("*",'users');

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

        //fetch article from database
        public function fetch_article_data(){

            $this->load->model('fetchDataModel','model');
            $userdata = $this->model->fetch_article();

            // foreach($userdata as $key => $value){
            //     echo $value['tagname']."<br>";
            // }

            $data = array();
            foreach($userdata as $key => $value){
                $data['data'][] = array(
                    $value['articletitle'],
                    $value['articledate'],
                    $value['shortDescription'],
                    $value['Content'],
                    $value['categorytitle'],
                    "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
                );
            }

            echo json_encode($data);
        }


    }
