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

        public function fetch_category_data(){

            $category = array();

           $this->load->model('fetchDataModel','model');
           $res = $this->model->fetch_category();
            $i = 1;
            foreach($res as $row){
                $category[$i] = $row['categorytitle'];
                $i++;
            }

           echo json_encode($category);

        }


        public function fetch_blog_data(){

            $this->load->model('fetchDataModel','model');
            $userdata = $this->model->fetch_blog();

            $data = array();
            foreach($userdata as $key => $value){
                $data['data'][] = array(
                    $value['title'],
                    $value['date'],
                    $value['shortDecp'],
                    $value['content'],
                    $value['categorytitle'],
                    "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
                );
            }

            echo json_encode($data);
        }

    }
