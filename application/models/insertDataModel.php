<?php 

    class insertDataModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
        }

        //update user password.
        public function update_password($email,$cnfPass){

           $encpt_pass = password_hash($cnfPass, PASSWORD_DEFAULT);

            $sql = "UPDATE admin SET password = '$encpt_pass' WHERE email = '$email'";

            $str = $this->db->query($sql);

            return $str;
        }

        public function update_user_password($email,$cnfPass){

            $encpt_pass = password_hash($cnfPass, PASSWORD_DEFAULT);
 
             $sql = "UPDATE users SET password = '$encpt_pass' WHERE email = 'ravi@gmail.com'";
 
             $str = $this->db->query($sql);
 
             return $str;
         }

        // add user data in database.
       

        

       

       

    }

?>
