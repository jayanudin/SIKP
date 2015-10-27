<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ketetapan_Jam_M extends CI_Model{

	public function __construct(){
	 parent::__construct();

	}

	public function getAllDataKetetapanJam(){
		$results = array();
	    $this->db->select('p.nip, k.pegawai_nip, k.idketetapan_jam, k.hari, p.nama_pegawai, k.jumlah_jam, a.tahun_akademik');
	    $this->db->from('pegawai p, ketetapan_jam k, akademik a');
	    $this->db->where('p.nip = k.pegawai_nip AND a.idakademik = k.akademik_idakademik');
	    $this->db->order_by('nip', 'ASC');

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
		$this->db->where('idketetapan_jam', $id);
 		$this->db->update('ketetapan_jam', $data);
	}
	
	public function getNama() {
		$data = array();
		$query = $this->db->get('pegawai');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$query->free_result();
		return $data;	
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