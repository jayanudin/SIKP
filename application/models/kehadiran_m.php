<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kehadiran_M extends CI_Model{

	public function __construct(){
	 	parent::__construct();

	}

	public function insert_data_kehadiran_default($akademik_idakademik, $hari, $tanggal_masuk, $keterangan){
		return $this->db->query("INSERT INTO kehadiran(pegawai_nip, akademik_idakademik, tanggal_masuk, hari, keterangan) 
			SELECT kj.pegawai_nip, '".$akademik_idakademik["akademik_idakademik"]."', '".$tanggal_masuk["tanggal_masuk"]."', '".$hari["hari"]."', '".$keterangan["keterangan"]."' FROM pegawai p, ketetapan_jam kj
			WHERE kj.hari = '".$hari["hari"]."' AND kj.pegawai_nip = p.nip" );
	
	}

	public function getAllDataKehadiran(){
		$results = array();
	    $this->db->select('k.idkehadiran, k.hari, k.pegawai_nip, k.waktu_masuk, k.waktu_keluar, k.tanggal_masuk, k.keterangan, p.status, p.nama_pegawai, a.tahun_akademik');
	    $this->db->from('kehadiran k, pegawai p, akademik a, ketetapan_jam kj');
	    $this->db->where('p.nip = k.pegawai_nip AND a.idakademik = k.akademik_idakademik AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip AND kj.akademik_idakademik = k.akademik_idakademik');
	    $this->db->order_by('tanggal_masuk', 'ASC');

	    $query = $this->db->get();

	    if($query->num_rows() > 0) {
	        $results = $query->result();
	    }
	    return $results;
	}


	public function getAllDataKehadiranStatusPengajar($status){
		$results = array();
	    $this->db->select('k.idkehadiran, k.hari, k.pegawai_nip, k.waktu_masuk, k.waktu_keluar, k.tanggal_masuk, k.keterangan, p.status, p.nama_pegawai, a.tahun_akademik');
	    $this->db->from('kehadiran k, pegawai p, akademik a, ketetapan_jam kj');
	    $this->db->where('p.status = "'.$status["status"].'" AND p.nip = k.pegawai_nip AND a.idakademik = k.akademik_idakademik AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip AND kj.akademik_idakademik = k.akademik_idakademik' );
	    $this->db->order_by('tanggal_masuk', 'ASC');

	    $query = $this->db->get();

	    if($query->num_rows() > 0) {
	        $results = $query->result();
	    }
	    return $results;
	}

	public function getAllDataKehadiranPerHari($tanggal_masuk){
		$results = array();
	    $this->db->select('k.idkehadiran, k.hari, k.pegawai_nip, k.waktu_masuk, k.waktu_keluar, k.tanggal_masuk, k.keterangan, p.status, p.nama_pegawai, a.tahun_akademik');
	    $this->db->from('kehadiran k, pegawai p, akademik a, ketetapan_jam kj');
	    $this->db->where('k.tanggal_masuk = "'.$tanggal_masuk["tanggal_masuk"].'" AND p.nip = k.pegawai_nip AND a.idakademik = k.akademik_idakademik AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip AND kj.akademik_idakademik = k.akademik_idakademik' );
	    $this->db->order_by('tanggal_masuk', 'ASC');

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
		$this->db->where('idkehadiran', $id);
		$this->db->update('kehadiran', $data);
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