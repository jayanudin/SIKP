<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/

class Report extends CI_Controller{

	public function __construct(){
	 parent::__construct();
	 $this->load->model('report_m');

	}


	  public function index(){
	  	$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			$breadcrumb = array(
					"Cetak Laporan" => base_url()."report",			
					"Input Laporan" => ""
				);
			 
			$data['breadcrumb'] = $breadcrumb;
	  		$data['title'] = 'Cetak Laporan - SISTEM INFORMASI ABSENSI';
	  		$data['nama'] = $this->report_m->getNama();
	  		$data['tahun_akademik'] = $this->report_m->getTahunAkademik();
			$this->load->view('report/print_all_report', $data);
	  	}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
 
    	 
	  }

	  public function per_day(){
	  	$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			$breadcrumb = array(
					"Cetak Laporan" => base_url()."report",			
					"Input Laporan" => ""
				);
			 
			$data['breadcrumb'] = $breadcrumb;
	  		$data['title'] = 'Cetak Laporan - SISTEM INFORMASI ABSENSI';
	  		$data['nama'] = $this->report_m->getNama();
	  		$data['tahun_akademik'] = $this->report_m->getTahunAkademik();
			$this->load->view('report/print_per_day', $data);
	  	}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
 
	  }

	  public function per_pegawai(){
	  	$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			$breadcrumb = array(
					"Cetak Laporan" => base_url()."report",			
					"Input Laporan" => ""
				);
			 
			$data['breadcrumb'] = $breadcrumb;
	  		$data['title'] = 'Cetak Laporan - SISTEM INFORMASI ABSENSI';
	  		$data['nama'] = $this->report_m->getNama();
	  		$data['tahun_akademik'] = $this->report_m->getTahunAkademik();
			$this->load->view('report/print_per_pegawai', $data);
	  	}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
	  }

	  public function dinas_per_periode(){
	  	$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			$breadcrumb = array(
					"Cetak Laporan" => base_url()."report",			
					"Input Laporan" => ""
				);
			 
			$data['breadcrumb'] = $breadcrumb;
	  		$data['title'] = 'Cetak Laporan - SISTEM INFORMASI ABSENSI';
	  		$data['nama'] = $this->report_m->getNama();
	  		$data['tahun_akademik'] = $this->report_m->getTahunAkademik();
			$this->load->view('report/print_dinas_per_periode', $data);
	  	}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}

	  }

	  public function print_all_data(){
	  	$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			if ($this->input->post('submit')) {
				$tanggal_awal['tanggal_awal']				= $this->input->post('tanggal_awal');
				$tanggal_akhir['tanggal_akhir']				= $this->input->post('tanggal_akhir');
				$status['status'] 							= $this->input->post('status');
				$akademik_idakademik['akademik_idakademik'] = $this->input->post('akademik_idakademik');

				$data['query']			= $this->report_m->print_allKehadiran($tanggal_awal, $tanggal_akhir, $status, $akademik_idakademik);
				$data['tahun_akademik'] = $this->report_m->get_record_akademik();
				$data['jumlah_hadir_all']	= $this->report_m->jumlah_hadir_all($tanggal_awal, $tanggal_akhir, $status, $akademik_idakademik);
				$data['jumlah_telat_all']	= $this->report_m->jumlah_telat_all($tanggal_awal, $tanggal_akhir, $status, $akademik_idakademik);
				$html = $this->load->view('report/report_all_data', $data, true);

				$this->pdf->pdf_create($html, $tanggal_awal['tanggal_awal'], $tanggal_akhir['tanggal_akhir'], $status['status'], $akademik_idakademik['akademik_idakademik']);
				redirect(base_url().'report');

			}else{
						

				$html = $this->load->view('report/report', $data, false);							
			}

			
		}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
 
   	}


	  public function print_per_day(){
	  	$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			if ($this->input->post('submit')) {
				$tanggal['tanggal']							= $this->input->post('tanggal');
				$status['status'] 							= $this->input->post('status');
				$akademik_idakademik['akademik_idakademik'] = $this->input->post('akademik_idakademik');

				$data['query']								= $this->report_m->print_perDay($tanggal, $status, $akademik_idakademik);
				$data['tahun_akademik'] 					= $this->report_m->get_record_akademik();
				$data['jumlah_hadir_day']		= $this->report_m->jumlah_hadir_day($tanggal, $status, $akademik_idakademik);
				$data['jumlah_telat_day']		= $this->report_m->jumlah_telat_day($tanggal, $status, $akademik_idakademik);
				$html = $this->load->view('report/report_per_day', $data, true);

				$this->pdf->pdf_create($html, $tanggal['tanggal'], $status['status'], $akademik_idakademik['akademik_idakademik']);
				redirect(base_url().'report/per_day');

			}else{
						

				$html = $this->load->view('report/per_day', $data, false);							
			}

			
		}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
 
   	}

   	public function print_per_pegawai(){
   		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			if ($this->input->post('submit')) {

				$pegawai_nip['pegawai_nip'] 				= $this->input->post('pegawai_nip');
				$tanggal_awal['tanggal_awal']				= $this->input->post('tanggal_awal');
				$tanggal_akhir['tanggal_akhir']				= $this->input->post('tanggal_akhir');
				$akademik_idakademik['akademik_idakademik'] = $this->input->post('akademik_idakademik');
				
				$data['query']				= $this->report_m->print_per_pegawai($tanggal_awal, $tanggal_akhir, $pegawai_nip, $akademik_idakademik);
				$data['limit'] 				= $this->report_m->limit_record($pegawai_nip);
				$data['jumlah_hadir']		= $this->report_m->jumlah_hadir($tanggal_awal, $tanggal_akhir, $pegawai_nip, $akademik_idakademik);
				$data['jumlah_telat']		= $this->report_m->jumlah_telat($tanggal_awal, $tanggal_akhir, $pegawai_nip, $akademik_idakademik);
				$html = $this->load->view('report/report_per_pegawai', $data, true);


				$this->pdf->pdf_create($html, $tanggal_awal['tanggal_awal'], $tanggal_akhir['tanggal_akhir'], $pegawai_nip['pegawai_nip'], $akademik_idakademik['akademik_idakademik']);
				redirect(base_url().'report/per_pegawai');

			}else{
						

				$html = $this->load->view('report/per_pegawai', $data, false);							
			}	
		}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
 
   	}

   	public function print_dinas_per_periode(){
   		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			if ($this->input->post('submit')) {
				$tanggal_awal['tanggal_awal']				= $this->input->post('tanggal_awal');
				$tanggal_akhir['tanggal_akhir']				= $this->input->post('tanggal_akhir');
				$akademik_idakademik['akademik_idakademik'] = $this->input->post('akademik_idakademik');

				$data['query']			= $this->report_m->print_dinas_per_periode($tanggal_awal, $tanggal_akhir, $akademik_idakademik);
				$data['tahun_akademik'] = $this->report_m->get_record_akademik();
				$html = $this->load->view('report/report_dinas_per_periode', $data, true);

				$this->pdf->pdf_create($html, $tanggal_awal['tanggal_awal'], $tanggal_akhir['tanggal_akhir'], $akademik_idakademik['akademik_idakademik']);
				redirect(base_url().'report');

			}else{
						

				$html = $this->load->view('report/report', $data, false);							
			}

			
		}
		else
		{
			$st = $this->session->userdata('status');
			if ($st=='admin') 
			{
				header('location:'.base_url().'app');
			}
			else{
				header('location:'.base_url().'auth');
			}
		}
 
   	}  
}
