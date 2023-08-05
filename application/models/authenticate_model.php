<?php
#[AllowDynamicProperties]
class authenticate_model extends CI_Model
{


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
    public function fetch_admin($data)
    {
        $users = array();
        $flag = 0;
        
        $sql = "SELECT * from admin";

        $str = $this->db->query($sql);


        if (!empty($str->result())) {
            foreach ($str->result() as $row) {

                if ($row->name == $data[0] || $row->email == $data[0]) {
                    $users['mail'] = $row->email;
                    $users['username'] = $row->name;
                    $users['pass'] = $row->password;
                    $users['id'] = $row->adminid;
                    $users['status'] = $row->status;
                    $users['position'] = $row->position;
                    $flag = 1;
                }
            }
           if($flag){
            return $users;
           }
        }
        return 0;
    }

    public function fetch_user($data)
    {   
        $users = array();
        $flag = 0;
        
        $sql = "SELECT * from users";

        $str = $this->db->query($sql);


        if (!empty($str->result())) {
             foreach ($str->result() as $row) {
            //     var_dump($row->username);
            //     echo "break";
            //     var_dump($data);
            //     die();
                if ($row->username == $data[0] || $row->email == $data[0]) {
                    $users['mail'] = $row->email;
                    $users['username'] = $row->username;
                    $users['pass'] = $row->password;
                    $users['id'] = $row->userid;
                    $users['status'] = $row->user_status;
                    $users['position'] = $row->position;
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
