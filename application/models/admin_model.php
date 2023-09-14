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

        $sql = array('username' => $data['fullname'], 'email' => $data['email'], 'password' => $password, 'position' => $data['position'], 'address' => "$address", 'phone' => $data['phone']);

        $str = $this->db->insert_string('users', $sql);

        $result  = $this->db->query($str);

        return $result;
    }

	public function insert_page($data){



		$str =$this->db->insert_string('pages', array('page_name'=>$data['pagename'],'description'=>$data['descp'],'content'=>$data['content'],'p_slug'=>$data['p_slug']));

		$res = $this->db->query($str);

		return $res;

	}

	public function get_all_routes(){

		$query = $this->db->get_where('pages', array('p_status'=>1));

		return $query->result_array();
		// echo "<pre>";
		// print_r($query->result_array());
		// die();
	}

	public function getPageById($id){

		$query = $this->db->get_where('pages', array('p_id'=>$id));

		return $query->result_array();

	}
	
    
}
