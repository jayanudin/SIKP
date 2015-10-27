<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_M extends CI_Model{
	public function __construct(){
	 parent::__construct();

	}

	public function print_allKehadiran($tanggal_awal, $tanggal_akhir, $status){
		$results = array();
		$this->db->select('k.pegawai_nip, k.hari, k.tanggal_masuk, p.status, p.nama_pegawai, p.golongan, k.keterangan');
		$this->db->from('kehadiran k, pegawai p, ketetapan_jam kj');
		$this->db->where('k.pegawai_nip = p.nip AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'" AND p.status="'.$status["status"].'" AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip AND kj.akademik_idakademik = k.akademik_idakademik AND (k.keterangan ="Hadir" OR k.keterangan ="Telat")');
		$this->db->order_by('k.pegawai_nip ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	public function print_PerDay($tanggal, $status, $akademik_idakademik){
		$results = array();
		$this->db->select('k.pegawai_nip, k.hari, k.tanggal_masuk, p.nama_pegawai, p.status, p.golongan, k.keterangan');
		$this->db->from('kehadiran k, pegawai p, ketetapan_jam kj');
		$this->db->where('k.tanggal_masuk = "'.$tanggal["tanggal"].'" AND p.status="'.$status["status"].'" AND k.akademik_idakademik="'.$akademik_idakademik["akademik_idakademik"].'" AND k.pegawai_nip = p.nip AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip AND kj.akademik_idakademik = k.akademik_idakademik AND (k.keterangan ="Hadir" OR k.keterangan ="Telat")');
		$this->db->order_by('k.pegawai_nip ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	public function print_per_pegawai($tanggal_awal, $tanggal_akhir, $pegawai_nip, $akademik_idakademik){
		$results = array();
		$this->db->select('k.hari, k.tanggal_masuk, k.waktu_masuk, k.waktu_keluar, k.keterangan, p.nama_pegawai');
		$this->db->from('kehadiran k, ketetapan_jam kj, pegawai p');
		$this->db->where('p.nip = k.pegawai_nip AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'" AND k.pegawai_nip="'.$pegawai_nip["pegawai_nip"].'" AND k.akademik_idakademik="'.$akademik_idakademik["akademik_idakademik"].'" AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip AND kj.akademik_idakademik = k.akademik_idakademik AND (k.keterangan ="Hadir" OR k.keterangan ="Telat")');
		$this->db->order_by('k.tanggal_masuk ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	public function print_dinas_per_periode($tanggal_awal, $tanggal_akhir){
		$results = array();
		$this->db->select('p.nip, o.hari, o.tanggal_operasional, p.nama_pegawai, p.golongan, o.idoperasional');
		$this->db->from('operasional o, pegawai p');
		$this->db->where('o.tanggal_operasional BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'" AND p.status_kerja ="PNS"');
		$this->db->order_by('p.nip ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	public function get_record_akademik(){
		$results = array();
		$this->db->select('k.pegawai_nip, k.hari, k.tanggal_masuk, k.keterangan, a.tahun_akademik');
		$this->db->from('kehadiran k, akademik a');
		$this->db->where('k.akademik_idakademik = a.idakademik');
		$this->db->limit('1');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
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

	public function limit_record($pegawai_nip){
		$results = array();
		$this->db->select('k.pegawai_nip, p.nama_pegawai, a.tahun_akademik');
		$this->db->from('kehadiran k, pegawai p, akademik a');
		$this->db->where('k.pegawai_nip ="'.$pegawai_nip["pegawai_nip"].'" AND p.nip = k.pegawai_nip');
		$this->db->limit('1');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	public function jumlah_hadir_all($tanggal_awal, $tanggal_akhir, $status, $akademik_idakademik){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('p.status ="'.$status["status"].'" AND p.nip = k.pegawai_nip AND k.akademik_idakademik ="'.$akademik_idakademik['akademik_idakademik'].'" AND k.keterangan ="Hadir" AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'"');
		$query = $this->db->get();
	   	return $query->result();
	}
	public function jumlah_telat_all($tanggal_awal, $tanggal_akhir, $status, $akademik_idakademik){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('p.status ="'.$status["status"].'" AND p.nip = k.pegawai_nip AND k.akademik_idakademik ="'.$akademik_idakademik['akademik_idakademik'].'" AND k.keterangan ="Telat" AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'"');
		$query = $this->db->get();
	   	return $query->result();
	}
	public function jumlah_hadir_day($tanggal, $status, $akademik_idakademik){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('p.status ="'.$status["status"].'" AND p.nip = k.pegawai_nip AND k.akademik_idakademik ="'.$akademik_idakademik['akademik_idakademik'].'" AND k.keterangan ="Hadir" AND k.tanggal_masuk =  "'.$tanggal["tanggal"].'"');
		$query = $this->db->get();
	   	return $query->result();
	}
	public function jumlah_telat_day($tanggal, $status, $akademik_idakademik){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('p.status ="'.$status["status"].'" AND p.nip = k.pegawai_nip AND k.akademik_idakademik ="'.$akademik_idakademik['akademik_idakademik'].'" AND k.keterangan ="Telat" AND k.tanggal_masuk =  "'.$tanggal["tanggal"].'"');
		$query = $this->db->get();
	   	return $query->result();
	}
	public function jumlah_hadir($tanggal_awal, $tanggal_akhir, $pegawai_nip, $akademik_idakademik){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran k, ketetapan_jam kj');
		$this->db->where('k.pegawai_nip ="'.$pegawai_nip["pegawai_nip"].'" AND k.akademik_idakademik ="'.$akademik_idakademik['akademik_idakademik'].'" AND k.keterangan ="Hadir" AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'" AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip');
		$query = $this->db->get();
	   	return $query->result();
	}
	public function jumlah_telat($tanggal_awal, $tanggal_akhir, $pegawai_nip, $akademik_idakademik){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran k, ketetapan_jam kj');
		$this->db->where('k.pegawai_nip ="'.$pegawai_nip["pegawai_nip"].'" AND k.akademik_idakademik ="'.$akademik_idakademik['akademik_idakademik'].'" AND k.keterangan ="Telat" AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'" AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip');
		$query = $this->db->get();
	   	return $query->result();
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