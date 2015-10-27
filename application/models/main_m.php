<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_M extends CI_Model{

	public function __construct(){
	 parent::__construct();

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


	public function getNamaPengajar(){
		$data = array();
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->order_by('nama_pegawai DESC');
		$query = $this->db->get();
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

	public function getKetetapanJam() {
		$data = array();
		$this->db->select('*');
		$this->db->from('ketetapan_jam');
		$this->db->order_by('jumlah_jam ASC');
		$this->db->group_by('jumlah_jam');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$query->result();
		return $data;	
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

	public function valid_password($password){
		$query = $this->db->get_where('pegawai', array('password' => md5($password)));
		if ($query->num_rows() == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function valid_tanggal_operasional($tanggal_operasional){
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

	public function updateKehadiranMasukTepat($waktu_masuk, $pegawai_nip, $tanggal_masuk, $hari, $akademik_idakademik){
        $this->db->set('keterangan', 'Hadir');
        $this->db->set('waktu_masuk', $waktu_masuk['waktu_masuk']);
        $this->db->where('pegawai_nip = "'.$pegawai_nip['pegawai_nip'].'" AND tanggal_masuk = "'.$tanggal_masuk['tanggal_masuk'].'" AND hari = "'.$hari['hari'].'" AND akademik_idakademik = "'.$akademik_idakademik['akademik_idakademik'].'"');
        $this->db->update('kehadiran');
	}

	public function updateKehadiranMasukTelat($waktu_masuk, $pegawai_nip, $tanggal_masuk, $hari, $akademik_idakademik){
        $this->db->set('keterangan', 'Telat');
        $this->db->set('waktu_masuk', $waktu_masuk['waktu_masuk']);
        $this->db->where('pegawai_nip = "'.$pegawai_nip['pegawai_nip'].'" AND tanggal_masuk = "'.$tanggal_masuk['tanggal_masuk'].'" AND hari = "'.$hari['hari'].'" AND akademik_idakademik = "'.$akademik_idakademik['akademik_idakademik'].'"');
        $this->db->update('kehadiran');
	}

	public function updateKehadiranKeluar($waktu_keluar, $pegawai_nip, $tanggal_masuk, $hari, $akademik_idakademik){
        $this->db->set('waktu_keluar', $waktu_keluar['waktu_keluar']);
        $this->db->where('pegawai_nip = "'.$pegawai_nip['pegawai_nip'].'" AND tanggal_masuk = "'.$tanggal_masuk['tanggal_masuk'].'" AND hari = "'.$hari['hari'].'" AND akademik_idakademik = "'.$akademik_idakademik['akademik_idakademik'].'"');
        $this->db->update('kehadiran');
	}

	public function get_waktu_keluar($pegawai_nip, $tanggal_masuk){
		$this->db->select('*');
		$this->db->from('kehadiran');
		$this->db->where('pegawai_nip = "'.$pegawai_nip.'" AND tanggal_masuk = "'.$tanggal_masuk.'" AND waktu_keluar IS NOT NULL');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_waktu_masuk($pegawai_nip, $tanggal_masuk){
		$this->db->select('*');
		$this->db->from('kehadiran');
		$this->db->where('pegawai_nip = "'.$pegawai_nip.'" AND tanggal_masuk = "'.$tanggal_masuk.'" AND waktu_masuk IS NOT NULL');
		$query = $this->db->get();
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