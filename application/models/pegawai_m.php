<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_M extends CI_Model{
	public function __construct(){
	 parent::__construct();

	}

	public function getAllDataPegawai(){
		$results = array();
	    $this->db->select('p.nip, p.nama_pegawai, p.jenis_kelamin, p.photo, p.golongan, j.jabatan, p.no_telepon, p.tempat_lahir, p.tanggal_lahir, p.status, p.status_kerja');
	    $this->db->from('pegawai p, jabatan j');
	    $this->db->where('j.id_jabatan = p.jabatan_id_jabatan');
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

	public function updateData($table,$data,$field_key){
		$this->db->update($table,$data,$field_key);
	}

	public function getJabatan() {
		$data = array();
		$query = $this->db->get('jabatan');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$query->free_result();
		return $data;	
	}

	public function cek_nip($nip){
		$query = $this->db->get_where('pegawai', array('nip' => $nip));
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