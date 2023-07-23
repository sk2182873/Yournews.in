<?php 

    class insertDataModel extends CI_Model{

        public function __construct()
        {
            parent::__construct();
        }

        public function update_password($email,$cnfPass){

           $encpt_pass = password_hash($cnfPass, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET password = '$encpt_pass' WHERE email = 'sk2182873@gmail.com'";

            $str = $this->db->query($sql);

            echo "<pre>";
            print_r($str);
        }

    }

?>
