<?php

class admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	public function fetchPages(){
		$this->db->select("*");
		$this->db->from("pages");

		if (isset($_POST["search"]["value"])) {
			$this->db->like('page_name', $_POST["search"]["value"]);
			$this->db->or_like('created_at', $_POST["search"]["value"]);
			$this->db->or_like('description', $_POST["search"]["value"]);
			$this->db->or_like('p_status', $_POST["search"]["value"]);
		}


		if (isset($_POST["order"])) {
			$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by("id", "DESC");
		}

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST["length"], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function fetch_users_datatable(){

		$this->db->select('*');
		$this->db->from('users');

		if(isset($_POST['search']['value'])){
			$this->db->like('username', $_POST['search']['value']);
			$this->db->or_like('email', $_POST['search']['value']);
			$this->db->or_like('address', $_POST['search']['value']);
			$this->db->or_like('phone', $_POST['search']['value']);
			$this->db->or_like('position', $_POST['search']['value']);
			$this->db->or_like('user_status', $_POST['search']['value']);
		}

		if($_POST['order']){
			$this->db->order_by($_POST['order'][0]['column'], $_POST['order'][0]['dir']);
		}else{
			$this->db->order_by('userid' , 'ASC');
		}

		if($_POST['length'] != -1){
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result_array();
	}
	
    public function insert_user_profile_data($data){

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

	public function fetchMessages(){
		
		$this->db->select('*');
		$this->db->from('contact');

		if(isset($_POST['search']['value'])){
			$this->db->like('username', $_POST['search']['value'] );
			$this->db->or_like('email', $_POST['search']['value'] );
			$this->db->or_like('subject', $_POST['search']['value'] );
			$this->db->or_like('message', $_POST['search']['value'] );
		}

		if ($_POST["order"]) {

			$this->db->order_by($_POST['order'][0]['column'], $_POST['order'][0]['dir']);
		} else {
			$this->db->order_by('id', 'DESC');
		}

		if ($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$query = $this->db->get();
		return $query->result_array();
		
	}
	
}
