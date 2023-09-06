<?php

    class fetchData extends CI_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('frontendmodel', 'frontModel');
			$this->load->model('fetchDataModel','fetchModel');
		}

        public function fetch_user_data(){

            
            $userdata = $this->fetchModel->fetch_data("*",'users');

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

            
            $userdata = $this->fetchModel->fetch_article();

            $data = array();

            foreach($userdata as $key => $value){
                $data['data'][] = array(
                    "Title"=>$value['title'],
                    "Date"=>$value['date'],
                    "Sdescp"=>$value['shortdescription'],
                    "Content"=>strip_tags(substr($value['content'],0,100))." .......",
                    "CTitle"=>$value['categorytitle'],
					"id"=>$value['id']
                );
            }

            echo json_encode($data);
        }

        public function fetch_category_data(){

          
           $res = $this->fetchModel->fetch_category();

            foreach($res as $row){
                $category[] = $row['categorytitle'];
                $categoryid[] = $row['categoryid'];
            }
            

           echo json_encode(array("category"=>$category,"categoryid"=>$categoryid));
        }


        public function fetch_blog_data(){

          
            $userdata = $this->fetchModel->fetch_blog();

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

		public function fetch_articles_by_category($category){

			$result = $this->frontModel->fetchArticlesByCategory($category);

			echo json_encode($result);

		}

		public function fetch_recent_articles_by_category($category){
			
			$result = $this->frontModel->fetchRecentArticlesById($category);

			echo json_encode($result);
		}

    }
