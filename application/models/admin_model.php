<?php 

    class admin_model extends CI_Model{

        public function __construct()
        {
            parent::__construct();
        }

        public function insert_user_profile_data($data){

            $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $address = $data['address'];

            $sql = array('username'=>$data['fullname'],'email'=>$data['email'],'password'=>$password,'user_status'=>'active','position'=>$data['position'],'address'=>"$address",'phone'=>$data['phone']);

            $str = $this->db->insert_string('users', $sql);

           $result  = $this->db->query($str);

          return $result;

        }

    }

?>