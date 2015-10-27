<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Operasional_M extends CI_Model{

	public function __construct(){
	 parent::__construct();

	}

	public function getAllDataOperasional(){
		$results = array();
	    $this->db->select('o.tanggal_operasional, o.hari, a.tahun_akademik, o.idoperasional');
	    $this->db->from('operasional o, akademik a');
	    $this->db->where('a.idakademik = o.akademik_idakademik');
	    $this->db->order_by('tanggal_operasional', 'ASC');

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
		$this->db->where('idoperasional', $id);
 		$this->db->update('operasional', $data);
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

	public function cek_tanggal_operasional($tanggal_operasional){
		$query = $this->db->get_where('operasional', array('tanggal_operasional' => $tanggal_operasional));
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}