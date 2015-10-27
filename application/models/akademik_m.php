<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akademik_M extends CI_Model{

	public function __construct(){
	 	parent::__construct();

	}

	public function getAllDataTahunAkademik(){
		$results = array();
	    $this->db->select('*');
	    $this->db->from('akademik');
	    $this->db->order_by('tahun_akademik', 'ASC');

	    $query = $this->db->get();

	    if($query->num_rows() > 0) {
	        $results = $query->result();
	    }
	    return $results;
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
		$this->db->update('akademik', $data);
		$this->db->where('idakademik', $id);
 	}

	public function getTahunAkademik() {
		$data = array();
		$this->db->select('*');
		$this->db->from('akademik');
		$this->db->order_by('tahun_akademik DESC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$query->free_result();
		return $data;	
	}
	
}