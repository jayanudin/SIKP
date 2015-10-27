<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model{

	public function __construct(){
	 parent::__construct();

	}


	public function valid_ketetapan_jam($nip, $idketetapan_jam){
		$this->db->select('kt.pegawai_nip, kh.ketetapan_jam_idketetapan_jam');
		$this->db->from('ketetapan_jam kt, kehadiran kh');
		$this->db->where('nip = "'.$nip['pegawai_nip'].'"');
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

	

	public function cek_waktu_kerja($idketetapan_jam, $hari){
		$query = $this->db->get_where('ketetapan_jam', array('idketetapan_jam' => $idketetapan_jam), array('hari' => $hari));
		
		if ($query->num_rows() == 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}


	public function cetak_kehadiran($tanggal_awal, $tanggal_akhir){
		$results = array();
		$this->db->select('k.pegawai_nip, k.hari, k.tanggal_masuk, p.status, k.keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('k.pegawai_nip = p.nip AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'"');
		$this->db->order_by('k.pegawai_nip ASC');
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

	public function cetak_kehadiran_per_id($pegawai_nip, $tanggal_awal, $tanggal_akhir){
		$results = array();
		$this->db->select('k.pegawai_nip, k.hari, k.tanggal_masuk, p.status, k.keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('k.pegawai_nip = p.nip AND k.pegawai_nip = "'.$pegawai_nip['pegawai_nip'].'" AND k.tanggal_masuk BETWEEN "'.$tanggal_awal["tanggal_awal"].'" AND "'.$tanggal_akhir["tanggal_akhir"].'"');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}

	public function get_limit_per_id($pegawai_nip){
		$results = array();
		$this->db->select('k.pegawai_nip, p.status, p.nama_pegawai');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('k.pegawai_nip = p.nip AND pegawai_nip = "'.$pegawai_nip["pegawai_nip"].'"');
		$this->db->limit('1');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$results = $query->result();
		}
		return $results;
	}


	public function select_data_per_record($nip){
		$results = array();
		$this->db->select('k.nip, p.nama_pegawai, k.waktu_masuk, k.waktu_keluar, k.tanggal_masuk, k.keterangan');
		$this->db->from('kehadiran k, pegawai p');
		$this->db->where('k.nip = p.nip AND k.nip = "'.$nip["nip"].'"');
		$this->db->limit('1');
		$query = $this->db->get();

	    if($query->num_rows() > 0) {
	        $results = $query->result();
	    }
	    return $results;
	}

	public function count_jumlah_hadir($nip){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran');
		$this->db->where('keterangan ="Hadir" AND waktu_keluar IS NOT NULL AND nip = "'.$nip["nip"].'"');
		$query = $this->db->get();
	   	return $query->result();
	}

	public function count_jumlah_telat($nip){
		$this->db->select('COUNT(*) keterangan');
		$this->db->from('kehadiran');
		$this->db->where('keterangan ="Telat" AND nip = "'.$nip["nip"].'"');
		$query = $this->db->get();
	   	return $query->result();
	}

	
}

	

/* End of file app.php */
/* Location: ./application/model/model_app.php */