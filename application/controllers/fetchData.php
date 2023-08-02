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
        public function fetch_article_data(){

            $this->load->model('fetchDataModel','model');
            $userdata = $this->model->fetch_article();

            $data = array();
            foreach($userdata as $key => $value){
                $data['data'][] = array(
                    $value['title'],
                    $value['date'],
                    $value['shortdescription'],
                    strip_tags(substr($value['content'],0,100))." .......",
                    $value['categorytitle'],
                    $value['status'],
                    "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
                );
            }

            echo json_encode($data);
        }

        public function fetch_category_data(){

           $this->load->model('fetchDataModel','model');
           $res = $this->model->fetch_category();

            foreach($res as $row){
                $category[] = $row['categorytitle'];
                $categoryid[] = $row['categoryid'];
            }
            

           echo json_encode(array("category"=>$category,"categoryid"=>$categoryid));
        }


        public function fetch_blog_data(){

            $this->load->model('fetchDataModel','model');
            $userdata = $this->model->fetch_blog();

            $data = array();
            foreach($userdata as $key => $value){
                $data['data'][] = array(
                    $value['title'],
                    $value['date'],
                    $value['shortdescp'],
                    strip_tags(substr($value['content'],0,100))." ......",
                    $value['categorytitle'],
                    $value['status'],
                    "<div><a href='#' class='badge text-primary'>edit</a> <a href='#' class='badge text-danger'>delete</a> </div>"
                );
            }

            echo json_encode($data);
        }

    }
