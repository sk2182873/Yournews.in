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


            $sql = array('username'=>$data['fullname'],'email'=>$data['email'],'password'=>$password,'user_status'=>'active','position'=>$data['position']);

            $str = $this->db->insert_string('users', $sql);

           $result  = $this->db->query($str);

          return $result;

        }

    }

?>
