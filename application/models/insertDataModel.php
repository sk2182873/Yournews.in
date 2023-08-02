<?php 

    class insertDataModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
        }

        //update user password.
        public function update_password($email,$cnfPass){

           $encpt_pass = password_hash($cnfPass, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password = '$encpt_pass' WHERE email = $email";

            $str = $this->db->query($sql);

            echo "<pre>";
            print_r($str);
        }

        // add user data in database.
        public function insert_user_profile_data($data){

            $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $address = $data['address'];

            $sql = array('username'=>$data['fullname'],'email'=>$data['email'],'password'=>$password,'user_status'=>'active','position'=>$data['position'],'address'=>"$address",'phone'=>$data['phone']);

            $str = $this->db->insert_string('users', $sql);

           $result  = $this->db->query($str);

          return $result;

        }

        public function insert_article($data,$path,$category_id){

            $sql = array('title'=>$data['Atitle'],'shortdescription'=>$data['Sdescp'],'content'=>$data['content'],'imagesurl'=>$path,'adminid'=>$_SESSION['id'],'categoryid'=>$category_id,'status'=>1);

            $str = $this->db->insert_string('article', $sql);

            $res = $this->db->query($str);

            if(!$res){
                return 0; 
            }else{
                return 1;
            }

        }

        public function insert_blog($data,$path,$category_id){

            $sql = array('title'=>$data['Btitle'],'shortdescp'=>$data['Sdescp'],'content'=>$data['content'],'imageurl'=>$path,'adminid'=>$_SESSION['id'],'categoryid'=>$category_id,'status'=>1);

            $str = $this->db->insert_string('blog', $sql);

            $res = $this->db->query($str);

            if(!$res){
                return 0; 
            }else{
                return 1;
            }

        }

        public function insert_category_model($data){

            $category_title = strtolower($data['CatTitle']);

            $sql = array('categorytitle'=>$category_title,'Shortdescp'=>$data['Sdecp'],'adminid'=>$_SESSION['id']);

            $str = $this->db->insert_string('category', $sql);

            return $this->db->query($str);

        }

    }

?>
