<?php

class admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_user_profile_data($data)
    {

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $address = $data['address'];

        $sql = array('username' => $data['fullname'], 'email' => $data['email'], 'password' => $password, 'user_status' => 'active', 'position' => $data['position'], 'address' => "$address", 'phone' => $data['phone']);

        $str = $this->db->insert_string('users', $sql);

        $result  = $this->db->query($str);

        return $result;
    }

    public function update_admin_profile($alteremail, $path)
    {


        $session_id = $_SESSION['id'];

        $sql = array('alternative_email' => "$alteremail", 'profile_img' => "$path");

        $where = "adminid = $session_id";

        $str = $this->db->update_string('admin', $sql, $where);

        $res = $this->db->query($str);

        if ($res) {
            $userdata['alteremail'] = $alteremail;
            $userdata['profilepic'] = $path;
            $this->session->set_userdata($userdata);
            return $res;
        }

        return 0;
    }
}
