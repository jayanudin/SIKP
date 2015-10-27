<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/
class Kehadiran extends CI_Controller{

	public function __construct(){
	 	parent::__construct();
	 	$this->load->model('kehadiran_m');

	}

	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
		
			 $data['title'] = 'Data Kehadiran - SISTEM INFORMASI ABSENSI';
			 $breadcrumb = array(
					"Kehadiran" => base_url()."kehadiran",			
					"Data Kehadiran" => ""
				);
			 $data['breadcrumb'] = $breadcrumb;

			
			$data['query'] = $this->kehadiran_m->getAllDataKehadiran();
			$this->load->view('kehadiran/kehadiran',$data);
		}
		else
		{
			$st = $this->session->userdata('stts');
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

	public function status_pegawai(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
		
			 $data['title'] = 'Data Kehadiran - SISTEM INFORMASI ABSENSI';
			 $breadcrumb = array(
					"Kehadiran" => base_url()."kehadiran",			
					"Data Kehadiran" => ""
				);
			 $data['breadcrumb'] = $breadcrumb;

			 if ($this->input->post('submit')) {
			 	$status['status']	= $this->input->post('status');
			 	$data['query'] = $this->kehadiran_m->getAllDataKehadiranStatusPengajar($status);
			 	$this->load->view('kehadiran/kehadiran2',$data);

			 }else{
			 	
			 	$data['query'] = $this->kehadiran_m->getAllDataKehadiran();
			 	$this->load->view('kehadiran/kehadiran2',$data);
			 }

			
			
		}
		else
		{
			$st = $this->session->userdata('stts');
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

	public function per_hari(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
		
			 $data['title'] = 'Data Kehadiran - SISTEM INFORMASI ABSENSI';
			 $breadcrumb = array(
					"Kehadiran" => base_url()."kehadiran",			
					"Data Kehadiran" => ""
				);
			 $data['breadcrumb'] = $breadcrumb;

			 if ($this->input->post('submit')) {
			 	$tanggal_masuk['tanggal_masuk']	= $this->input->post('tanggal_masuk');
			 	$data['query'] = $this->kehadiran_m->getAllDataKehadiranPerHari($tanggal_masuk);
			 	$this->load->view('kehadiran/kehadiran3',$data);

			 }else{
			 	
			 	$data['query'] = $this->kehadiran_m->getAllDataKehadiran();
			 	$this->load->view('kehadiran/kehadiran3',$data);
			 }

			
			
		}
		else
		{
			$st = $this->session->userdata('stts');
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


	public function tambah(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			date_default_timezone_set("Asia/Jakarta");
			$breadcrumb = array(
					"Kehadiran" => base_url()."kehadiran",			
					"Tambah Data Kehadiran" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Data Kehadiran - SISTEM INFORMASI ABSENSI';
			$data['nama_pegawai'] = $this->kehadiran_m->getNama();
			$data['tanggal']	= date('Y-m-d');
			$data['hari'] = nama_hari(date('Y-m-d'));
			$data['akademik'] = $this->kehadiran_m->getTahunAkademik();
			$this->load->view('kehadiran/tambah_kehadiran', $data);

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

	public function edit()
		{
			$cek = $this->session->userdata('logged_in');
			if(!empty($cek))
			{
				 $breadcrumb = array(
					"Kehadiran" => base_url()."kehadiran",			
					"Edit Data kehadiran" => ""
				);

				$bc['breadcrumb'] = $breadcrumb;
				$bc['title'] = 'Edit User - SISTEM INFORMASI ABSENSI';
				$bc['nama_pegawai'] = $this->kehadiran_m->getNama();
				$bc['akademik'] = $this->kehadiran_m->getTahunAkademik();
				$pilih['idkehadiran'] = $this->uri->segment(3);
				$dt_kehadiran = $this->kehadiran_m->getSelectedData("kehadiran",$pilih);
				foreach($dt_kehadiran->result() as $db)
				{
					$bc['idkehadiran']						= $db->idkehadiran;
					$bc['pegawai_nip']		 				= $db->pegawai_nip;


				}
				
				$this->load->view('kehadiran/edit_kehadiran',$bc);
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

	public function save(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{		
				if ($this->input->post('submit')) {
					$hari['hari']								= $this->input->post('hari');
					$tanggal_masuk['tanggal_masuk']				= $this->input->post('tanggal_masuk');
					$keterangan['keterangan']					= $this->input->post('keterangan');
					$akademik_idakademik['akademik_idakademik']	= $this->input->post('akademik_idakademik');
					$this->kehadiran_m->insert_data_kehadiran_default($akademik_idakademik, $hari, $tanggal_masuk, $keterangan);
					redirect('kehadiran');
				}else{
					$this->load->view('kehadiran/tambah_kehadiran', $error);							
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

	public function update(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
				if ($this->input->post('update')) {
					$id 										= $this->input->post('idkehadiran');
					$in['keterangan']							= $this->input->post('keterangan');
					$this->kehadiran_m->updateData($id, $in);
					redirect('kehadiran');
				}else{
					$this->load->view('kehadiran/edit_kehadiran');							
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


	public function delete()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			$hapus['idkehadiran'] = $this->uri->segment(3);
			$dt_kehadiran = $this->kehadiran_m->deleteData('kehadiran',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>kehadiran"; </script>
			<?php
		}
		else
		{
			$st = $this->session->userdata('stts');
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


/* End of file kehadiran.php */
/* Location: ./application/controllers/kehadiran.php */