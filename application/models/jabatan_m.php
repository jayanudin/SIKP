<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_M extends CI_Model{
	public function __construct(){
	 parent::__construct();

	}

	public function getAllDataJabatan(){
		$this->db->order_by('jabatan', 'ASC');

		$data = $this->db->get('jabatan');

		return $data->result();
	}

	public function updateData($id, $data){
		$this->db->where('id_jabatan', $id);
 		$this->db->update('jabatan', $data);
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
}