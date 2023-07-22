<?php

    class sessions extends CI_Controller{

        public function timeout_session(){
            if(isset($_SESSION['id'])){

                if(time() - $_SESSION['last_login_time'] > 60){
                    redirect(base_url().'admin/logout');
                    // $message['timeout'] = "Your session timeout. Please login again.";
                    // echo json_encode($message);
                }else{
                    $_SESSION['last_login_time'] = time();
                }
            }
        }

    }
