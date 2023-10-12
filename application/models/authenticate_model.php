<?php
// #[AllowDynamicProperties]
class authenticate_model extends CI_Model
{


    //fetch User emails
    public function fetch_mail($mail, $table)
    {

        $sql = "SELECT email from $table";

        $res = $this->db->query($sql);

		return $res->result_array();
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
                    $users['alternative_email'] = $row->alternative_email;
                    $users['phone'] = $row->phone;
                    $users['profilepic'] = $row->profile_img;
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
            
                if ($row->username == $data[0] || $row->email == $data[0]) {
                    $users['mail'] = $row->email;
                    $users['username'] = $row->username;
                    $users['pass'] = $row->password;
                    $users['id'] = $row->userid;
                    $users['status'] = $row->user_status;
                    $users['position'] = $row->position;
                    $users['phone'] = $row->phone;
                    $users['alternative_email'] = $row->alternative_email;
                    $users['profilepic'] = $row->profile_img;
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
