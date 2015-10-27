<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/

class Ketetapan_Jam extends CI_Controller{

	public function __construct(){
	 parent::__construct();
	 $this->load->model('ketetapan_jam_m');

	}

	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			
			 $data['title'] = 'Data Ketetapan Jam Ajar - SISTEM INFORMASI ABSENSI';
			 $breadcrumb = array(
					"Ketetapan Jam" => base_url()."ketetapan_jam",			
					"Data Ketetapan Jam Ajar" => ""
				);
			 $data['breadcrumb'] = $breadcrumb;

			
			$data['query'] = $this->ketetapan_jam_m->getAllDataKetetapanJam();
			$this->load->view('ketetapan/ketetapan_jam',$data, array('error' => ' ' ));
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

	public function tambah(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			$breadcrumb = array(
					"Ketetapan Jam Ajar" => base_url()."ketetapan_jam",			
					"Tambah Ketetapan Jam" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Ketetapan Jam - SISTEM INFORMASI ABSENSI';
			$data['ketetapan_jam'] = $this->ketetapan_jam_m->getNama();
			$data['tahun_akademik'] = $this->ketetapan_jam_m->getTahunAkademik();
			$this->load->view('ketetapan/tambah_ketetapan', $data);
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

	public function save(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
			$this->form_validation->set_rules('jumlah_jam', 'Jumlah Jam', 'trim|required|integer|xss_clean');
			if ($this->form_validation->run()==TRUE) {
				if ($this->input->post('submit')) {
					$in['idketetapan_jam']			= $this->input->post('idketetapan_jam');
					$in['hari']						= $this->input->post('hari');
					$in['jumlah_jam']				= $this->input->post('jumlah_jam');
					$in['pegawai_nip']				= $this->input->post('pegawai_nip');
					$in['akademik_idakademik']		= $this->input->post('akademik_idakademik');
					$this->ketetapan_jam_m->insertData("ketetapan_jam",$in);
					redirect('ketetapan_jam');
				}else{
					$this->load->view('ketetapan/ketetapan_jam', $error);							
				}
			}else{
				$breadcrumb = array(
					"Ketetapan Jam Ajar" => base_url()."ketetapan_jam",			
					"Tambah Ketetapan Jam" => ""
				);

				$data['breadcrumb'] = $breadcrumb;
				$data['title'] = 'Tambah Ketetapan Jam - SISTEM INFORMASI ABSENSI';
				$data['ketetapan_jam'] = $this->ketetapan_jam_m->getNama();
				$data['tahun_akademik'] = $this->ketetapan_jam_m->getTahunAkademik();
				$this->load->view('ketetapan/tambah_ketetapan', $data);
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

	public function edit()
		{
			$cek = $this->session->userdata('logged_in');
			if(!empty($cek))
			{
				 $breadcrumb = array(
					"Ketetapan Jam Ajar" => base_url()."ketetapan_jam",			
					"Edit Ketetapan Jam Ajar" => ""
				);

				$bc['breadcrumb'] = $breadcrumb;
				$bc['title'] = 'Edit Jam Ajar - SISTEM INFORMASI ABSENSI';
				$bc['tahun_akademik'] = $this->ketetapan_jam_m->getTahunAkademik();
				$bc['ketetapan_jam']	= $this->ketetapan_jam_m->getNama();
				$pilih['idketetapan_jam'] = $this->uri->segment(3);
				$dt_ketetapan_jam = $this->ketetapan_jam_m->getSelectedData("ketetapan_jam",$pilih);
				foreach($dt_ketetapan_jam->result() as $db)
				{
					$bc['idketetapan_jam']			= $db->idketetapan_jam;
					$bc['hari']						= $db->hari;
					$bc['jumlah_jam']				= $db->jumlah_jam;
					$bc['akademik_idakademik']		= $db->akademik_idakademik;

				}
				
				$this->load->view('ketetapan/edit_ketetapan',$bc);
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

	public function update(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
				if ($this->input->post('update')) {
					$id	= $this->input->post('idketetapan_jam');
					$in['hari']						= $this->input->post('hari');
					$in['jumlah_jam']				= $this->input->post('jumlah_jam');
					$in['akademik_idakademik']		= $this->input->post('akademik_idakademik');
					$this->ketetapan_jam_m->updateData($id, $in);
					redirect('ketetapan_jam');
				}else{
					$this->load->view('ketetapan/edit_ketetapan', $error);							
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
			$hapus['idketetapan_jam'] = $this->uri->segment(3);
			$dt_ketetapan_jam = $this->ketetapan_jam_m->deleteData('ketetapan_jam',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>ketetapan_jam"; </script>
			<?php
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