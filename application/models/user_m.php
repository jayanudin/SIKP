<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_M extends CI_Model{
	
	public function __construct(){
	 parent::__construct();

	}

	public function getAllDataUser(){
		$this->db->order_by('nama_pengguna', 'ASC');

		$data = $this->db->get('user');

		return $data->result();
	}

	public function getSelectedData($table,$data){
		return $this->db->get_where($table, $data);
	}

	public function deleteData($table,$data){
		$this->db->delete($table,$data);
	}
	
	public function insertData($table,$data){
		$this->db->insert($table,$data);
	}

	public function updateData($id, $data){
		$this->db->update('user', $data);
		$this->db->where('id_user', $id);
 	}

}