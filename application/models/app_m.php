<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_M extends CI_Model{

	public function __construct(){
	 	parent::__construct();

	}

	public function total_pegawai(){
		$this->db->select('COUNT(*) nip');
		$this->db->from('pegawai');
		$query = $this->db->count_all_results();
	   	return $query;

	}

	public function total_kehadiran($tanggal_masuk){
		$this->db->select('COUNT(*) k.idkehadiran');
		$this->db->from('kehadiran k');
		$this->db->where('tanggal_masuk = "'.$tanggal_masuk.'" AND k.waktu_masuk IS NOT NULL');
		$query = $this->db->count_all_results();
	   	return $query;
	   

	}

	public function total_pengajar(){
		$this->db->select('COUNT(*) nip');
		$this->db->from('pegawai');
		$this->db->where('status = "Pengajar"');
		$query = $this->db->count_all_results();
	   	return $query;
	   

	}

	public function total_non_pengajar(){
		$this->db->select('COUNT(*) nip');
		$this->db->from('pegawai');
		$this->db->where('status = "Non Pengajar"');
		$query = $this->db->count_all_results();
	   	return $query;
	   

	}

	public function statistic_pengajar($tanggal_masuk){
		$this->db->select('COUNT(*) k.idkehadiran, p.status, kj.hari');
		$this->db->from('kehadiran k, pegawai p, ketetapan_jam kj');
		$this->db->where('k.tanggal_masuk ="'.$tanggal_masuk.'" AND p.status ="Pengajar" AND k.pegawai_nip = p.nip AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip');
		$query = $this->db->count_all_results();
	   	return $query;
	   
	}

	public function statistic_non_pengajar($tanggal_masuk){
		$this->db->select('COUNT(*) k.idkehadiran, p.status, kj.hari');
		$this->db->from('kehadiran k, pegawai p , ketetapan_jam kj');
		$this->db->where('k.tanggal_masuk ="'.$tanggal_masuk.'" AND status ="Non Pengajar" AND k.pegawai_nip = p.nip AND k.hari = kj.hari AND kj.pegawai_nip = k.pegawai_nip');
		$query = $this->db->count_all_results();
	   	return $query;
	}

	public function get_data_tahun(){
		$this->db->select("year(tanggal_masuk)");
		$this->db->from("kehadiran");
		$this->db->group_by("year(tanggal_masuk)");
		$query = $this->db->get();
		return $results = $query->result();

	}
}