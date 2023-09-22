<?php

class fetchDataModel extends CI_Model
{
	
	public function fetch_category(){

		

		$this->db->select('*');
		$this->db->from('category');

		if(isset($_POST['search']['value'])){
			$this->db->like('categorytitle',$_POST['search']['value']);
			$this->db->or_like('categorydate',$_POST['search']['value']);
			$this->db->or_like('Shortdescp',$_POST['search']['value']);
			$this->db->or_like('status',$_POST['search']['value']);
		}

		if(isset($_POST['order'])){
			$this->db->order_by($_POST['order'][0]['column'], $_POST['order'][0]['dir']);
		}else{
			$this->db->order_by('categoryid', 'ASC');
		}

		if($_POST['length'] != 1){
			$this->db->limit($_POST['length'], $_POST['start']);
		}

		$result = $this->db->get();

		return $result->result_array();

	}

    public function fetch_blog()
    {

        $sql = 'SELECT * from blog as b LEFT JOIN category as c on b.categoryid = c.categoryid';

        $res = $this->db->query($sql);

        // echo "<pre>";
        // print_r($res->result());

        return $res->result_array();
    }
}
