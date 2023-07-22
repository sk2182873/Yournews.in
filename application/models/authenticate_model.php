<?php
#[AllowDynamicProperties]
class authenticate_model extends CI_Model
{

    //Register User.
    public function register_admin($data)
    {

        $sql = array('username' => $data[0], 'email' => $data[1], 'password' => $data[2], 'user_status' => 1);

        $str = $this->db->insert_string('users', $sql);

        $res = $this->db->query($str);

        if ($res) {
            return 1;
        }
        return 0;
    }

    //fetch User emails
    public function fetch_mail($mail)
    {

        $sql = "SELECT email from users";

        $res = $this->db->query($sql);

        foreach ($res->result() as $row) {

            if ($row->email === $mail) {
                return 1;
            }
        }
        return 0;
    }

    //fetch users name, mail and password.
    public function fetch_user($data)
    {
        $users = array();
        $flag = 0;
        $sql = "SELECT * from users";

        $str = $this->db->query($sql);

        if (!empty($str->result())) {
            foreach ($str->result() as $row) {

                if ($row->username == $data[0] || $row->email == $data[0]) {
                    $users['mail'] = $row->email;
                    $users['username'] = $row->username;
                    $users['pass'] = $row->password;
                    $flag = 1;
                }
            }
           if($flag){
            return $users;
           }
        }
        return 0;
    }

}
