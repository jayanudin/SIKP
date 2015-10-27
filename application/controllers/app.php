<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/

class App extends CI_Controller{

	public function __construct(){

	 parent::__construct();
	 $this->load->model('app_m');

	}


	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			date_default_timezone_set("Asia/Jakarta");
			$tanggal_masuk = date('Y-m-d');
			$breadcrumb = array(
					"Dashboard" => base_url()."app",			
					"" => ""
				);
			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
			$data['jumlah_pegawai'] = $this->app_m->total_pegawai();
			$data['jumlah_kehadiran'] = $this->app_m->total_kehadiran($tanggal_masuk);
			$data['pengajar']	= $this->app_m->total_pengajar();
			$data['non_pengajar']	= $this->app_m->total_non_pengajar();
			$data['statistic_pengajar']		= $this->app_m->statistic_pengajar($tanggal_masuk);
			$data['statistic_non_pengajar']		= $this->app_m->statistic_non_pengajar($tanggal_masuk);
			$data['tanggal']			= $tanggal_masuk;
			$data['get_tahun']		= $this->app_m->get_data_tahun();
			$this->load->view('app/bg_home', $data);
		}
		else
		{
			$st = $this->session->userdata('status');
			if($st=='admin')
			{
				header('location:'.base_url().'app');
			}
			else
			{
				header('location:'.base_url().'auth');
			}
		}
	}
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */