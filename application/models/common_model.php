<?php

class common_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function fetch_category_id($cate_title)
    {
        $categoryid = 0;

        $sql = "SELECT categoryid FROM category Where categorytitle = '$cate_title'";

        $res = $this->db->query($sql);

        foreach ($res->result() as $row) {
            $categoryid = $row->categoryid;
        }

        return $categoryid;
    }

    public function fetch_category()
    {

        $sql = "SELECT * FROM category ORDER BY categorytitle";

        $res = $this->db->query($sql);


        return $res->result_array();
    }

    public function fetch_data($data, $table)
    {

        $res = $this->db->select($data)
            ->from($table)
            ->get();

        return $res->result_array();
    }

    public function insert_article($data, $category_id, $path, $url_slug)
    {
        $user = $this->session->userdata('roll');

        if ($user == 'admin') {
            $sql = array('title' => $data['title'], 'url_slug' => $url_slug, 'shortdescription' => $data['Sdescp'], 'content' => $data['content'], 'imagesurl' => $path, 'adminid' => $_SESSION['id'], 'categoryid' => $category_id, 'status' => 1);
        } else {
            $sql = array('title' => $data['title'], 'url_slug' => $url_slug, 'shortdescription' => $data['Sdescp'], 'content' => $data['content'], 'imagesurl' => $path, 'userid' => $_SESSION['userid'], 'categoryid' => $category_id, 'status' => 1);
        }



        $str = $this->db->insert_string('article', $sql);

        $res = $this->db->query($str);

        if (!$res) {
            return 0;
        } else {
            return 1;
        }
    }

    public function insert_blog($data, $category_id, $path)
    {

        $user = $this->session->userdata('roll');

        if ($user == 'admin') {
            $sql = array('title' => $data['Btitle'], 'shortdescp' => $data['Sdescp'], 'content' => $data['content'], 'imageurl' => $path, 'adminid' => $_SESSION['id'], 'categoryid' => $category_id, 'status' => 1);
        } else {
            $sql = array('title' => $data['Btitle'], 'shortdescp' => $data['Sdescp'], 'content' => $data['content'], 'imageurl' => $path, 'userid' => $_SESSION['userid'], 'categoryid' => $category_id, 'status' => 1);
        }

        $str = $this->db->insert_string('blog', $sql);

        $res = $this->db->query($str);

        if (!$res) {
            return 0;
        } else {
            return 1;
        }
    }

    public function insert_category_model($data)
    {

        $user = $this->session->userdata('roll');

        $category_title = strtolower($data['CatTitle']);

        if ($user == 'admin') {
            $sql = array('categorytitle' => $category_title, 'Shortdescp' => $data['Sdecp'], 'adminid' => $_SESSION['id']);
        } else {
            $sql = array('categorytitle' => $category_title, 'Shortdescp' => $data['Sdecp'], 'userid' => $_SESSION['userid']);
        }

        $str = $this->db->insert_string('category', $sql);

        return $this->db->query($str);
    }

    public function update_profile($alteremail, $filename)
    {
        $user = $this->session->userdata('roll');
        $res = "";
    
        $path = "";
       if(!empty($filename)){
        $path = './uploads/admin/'.$filename;
       }
       
       //echo $path;die();

        if (($user == "admin") && (!empty($path))) {
            $sql = array('alternative_email' => "$alteremail", 'profile_img' => "$path");

            $where = "adminid =" . $_SESSION['id'];

            $str = $this->db->update_string('admin', $sql, $where);

            $res = $this->db->query($str);
        }

        if(($user == "admin") && (!empty($path) == 0)){
            $sql = array('alternative_email' => "$alteremail");

            $where = "adminid =" . $_SESSION['id'];

            $str = $this->db->update_string('admin', $sql, $where);

            $res = $this->db->query($str);
        }
        
        if(($user == "user") && (!empty($path))){
            $sql = array('alternative_email' => "$alteremail", 'profile_img' => "$path");

            $where = "userid =" . $_SESSION['userid'];

            $str = $this->db->update_string('users', $sql, $where);

            $res = $this->db->query($str);
        }

        if(($user == "user") && (!empty($path) == 0)){
            $sql = array('alternative_email' => "$alteremail");

            $where = "userid =" . $_SESSION['userid'];

            $str = $this->db->update_string('users', $sql, $where);

            $res = $this->db->query($str);
        }



        

        if ($res) {
            $userdata['alteremail'] = $alteremail;
            if(!empty($path)){
                $userdata['profilepic'] = $path;
            }
           
            $this->session->set_userdata($userdata);
            return $res;
        }

        return 0;
    }

	public function delete_article_by_id($id){

		return $this->db->delete('article', array('id' => $id));



	}
}
