<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/

class Main extends CI_Controller{

	public function __construct(){
	 parent::__construct();
	 $this->load->model('main_m');

	}
	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{

			$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
			$this->load->view('main/global/bg_header', $data);
			$this->load->view('main/bg_pilihan', $data);
			$this->load->view('main/global/bg_footer', $data);
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

	public function masuk(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			date_default_timezone_set("Asia/Jakarta");
			$data['waktu_masuk'] = date('Y-m-d');
			$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
			$data['hari'] = nama_hari(date('Y-m-d'));
			$data['nip'] = $this->main_m->getNamaPengajar();
			$data['akademik'] = $this->main_m->getTahunAkademik();
			$data['ketetapan'] = $this->main_m->getKetetapanJam();
			$this->load->view('main/global/bg_header', $data);
			$this->load->view('main/bg_content_masuk', $data);
			$this->load->view('main/global/bg_footer', $data);
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

	public function keluar(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			date_default_timezone_set("Asia/Jakarta");
			$data['waktu_masuk'] = date('Y-m-d');
			$data['nip'] = $this->main_m->getNama();
			$data['akademik'] = $this->main_m->getTahunAkademik();
			$data['hari'] = nama_hari(date('Y-m-d'));
			$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
			$this->load->view('main/global/bg_header', $data);
			$this->load->view('main/bg_content_keluar', $data);
			$this->load->view('main/global/bg_footer', $data);
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

	public function filed_input(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			$data['waktu_masuk'] = date('Y-m-d');		
			$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
			$data['hari'] = nama_hari(date('Y-m-d'));
			$data['nip'] = $this->main_m->getNama();
			$data['akademik'] = $this->main_m->getTahunAkademik();
			$this->load->view('main/global/filed_kehadiran');
			$this->load->view('main/global/bg_header', $data);
			$this->load->view('main/bg_content_masuk', $data);
			$this->load->view('main/global/bg_footer', $data);
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


	public function filed_output(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			$data['waktu_masuk'] = date('Y-m-d');		
			$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
			$data['nip'] = $this->main_m->getNama();
			$data['hari'] = nama_hari(date('Y-m-d'));
			$data['akademik'] = $this->main_m->getTahunAkademik();
			$this->load->view('main/global/filed_keluar');
			$this->load->view('main/global/bg_header', $data);
			$this->load->view('main/bg_content_keluar', $data);
			$this->load->view('main/global/bg_footer', $data);
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



	public function valid_password($password){
		if ($this->main_m->valid_password($password) == TRUE)
		{
			$this->form_validation->set_message('valid_password', "<p>password salah</p>");
			return  FALSE;
		}
		else
		{		
				
			return TRUE;
		}
	}

	public function valid_tanggal_operasional($tanggal_operasional){
		if ($this->main_m->valid_tanggal_operasional($tanggal_operasional) == TRUE)
		{
			return  TRUE;
		}
		else
		{		
			$this->form_validation->set_message('valid_tanggal_operasional', "<p>Absensi Sedang Tidak Berjalan</p>");	
			return FALSE;
		}
	}



	public function save_masuk(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			date_default_timezone_set("Asia/Jakarta");
			$datetime = date('H:i:s');
			$date = date('Y-m-d');
			$jam_masuk = time('07:00:00');
			$waktu_masuk['waktu_masuk'] = $datetime;

			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_valid_password');
				if ($this->form_validation->run() == TRUE){ 							
					if ($waktu_masuk > $jam_masuk) {
						$waktu_masuk['waktu_masuk']					= $datetime;
						$pegawai_nip['pegawai_nip']					= $this->input->post('pegawai_nip');
						$tanggal_masuk['tanggal_masuk']				= $this->input->post('tanggal_masuk');
						$hari['hari']								= $this->input->post('hari');
						$akademik_idakademik['akademik_idakademik'] = $this->input->post('akademik_idakademik');
								

					     if($this->main_m->get_waktu_masuk($pegawai_nip['pegawai_nip'], $tanggal_masuk['tanggal_masuk'] )== TRUE){
					     	header('location:'.base_url().'main/filed_output');
					     	return  FALSE;
					     }else{
					     	$this->main_m->updateKehadiranMasukTelat($waktu_masuk, $pegawai_nip, $tanggal_masuk, $hari, $akademik_idakademik);
							$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
							$waktu_masuk['waktu_masuk'] = $datetime;
							$data['nip'] = $this->main_m->getNama();
							$this->load->view('main/global/success_masuk', $waktu_masuk);
							$this->load->view('main/global/bg_header', $data);	
							$this->load->view('main/bg_pilihan');							
							$this->load->view('main/global/bg_footer');
							return TRUE;
						}
					}else{
						$waktu_masuk['waktu_masuk']					= $datetime;
						$pegawai_nip['pegawai_nip']					= $this->input->post('pegawai_nip');
						$tanggal_masuk['tanggal_masuk']				= $this->input->post('tanggal_masuk');
						$hari['hari']								= $this->input->post('hari');
						$akademik_idakademik['akademik_idakademik'] = $this->input->post('akademik_idakademik');
								

					     if($this->main_m->get_waktu_masuk($pegawai_nip['pegawai_nip'], $tanggal_masuk['tanggal_masuk'] )== TRUE){
					     	header('location:'.base_url().'main/filed_output');
					     	return  FALSE;
					     }else{
					     	$this->main_m->updateKehadiranMasukTepat($waktu_masuk, $pegawai_nip, $tanggal_masuk, $hari, $akademik_idakademik);
							$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
							$waktu_masuk['waktu_masuk'] = $datetime;
							$data['nip'] = $this->main_m->getNama();
							$this->load->view('main/global/success_masuk', $waktu_masuk);
							$this->load->view('main/global/bg_header', $data);	
							$this->load->view('main/bg_pilihan');							
							$this->load->view('main/global/bg_footer');
							return TRUE;
						}
					}
					
				}else{

							$data['waktu_masuk'] = date('Y-m-d');		
							$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
							$data['hari'] = nama_hari(date('Y-m-d'));
							$data['nip'] = $this->main_m->getNama();
							$data['akademik'] = $this->main_m->getTahunAkademik();
							$this->load->view('main/global/filed');
							$this->load->view('main/global/bg_header', $data);	
							$this->load->view('main/bg_content_masuk', $data);							
							$this->load->view('main/global/bg_footer');	

				}
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

	public function save_keluar(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			date_default_timezone_set("Asia/Jakarta");
			$datetime = date('H:i:s');
			$date = date('Y-m-d');
			$keterangan = 'Hadir';

			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_valid_password');
				if ($this->form_validation->run() == TRUE){							
									 $waktu_keluar['waktu_keluar']					= $datetime;
									 $pegawai_nip['pegawai_nip']					= $this->input->post('pegawai_nip');
									 $tanggal_masuk['tanggal_masuk']				= $this->input->post('tanggal_masuk');
									 $hari['hari']									= $this->input->post('hari');
									 $akademik_idakademik['akademik_idakademik'] 	= $this->input->post('akademik_idakademik');

								     if($this->main_m->get_waktu_keluar($pegawai_nip['pegawai_nip'], $tanggal_masuk['tanggal_masuk'] )== TRUE){
								     	header('location:'.base_url().'main/filed_output');
								     	return  FALSE;
								     }else{

								     	$this->main_m->updateKehadiranKeluar($waktu_keluar, $pegawai_nip, $tanggal_masuk, $hari, $akademik_idakademik);
										$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
										$waktu_keluar['waktu_keluar'] = $datetime;
										$data['nip'] = $this->main_m->getNama();

										$this->load->view('main/global/success_keluar', $waktu_keluar);
										$this->load->view('main/global/bg_header', $data);	
										$this->load->view('main/bg_pilihan');							
										$this->load->view('main/global/bg_footer');

										return TRUE;


								     }

					
				}else{
		
							$data['waktu_masuk'] = date('Y-m-d');		
							$data['title'] = 'Dashboard - SISTEM INFORMASI ABSENSI';
							$data['hari'] = nama_hari(date('Y-m-d'));
							$data['nip'] = $this->main_m->getNama();
							$data['akademik'] = $this->main_m->getTahunAkademik();
							$this->load->view('main/global/filed');
							$this->load->view('main/global/bg_header', $data);	
							$this->load->view('main/bg_content_keluar');							
							$this->load->view('main/global/bg_footer');	

				}
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

/* End of file main.php */
/* Location: ./application/controllers/main.php */