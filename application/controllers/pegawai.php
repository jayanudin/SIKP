<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller{

	public function __construct(){
	 parent::__construct();

	 $this->load->model('pegawai_m');

	}

	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			 $data['title'] = 'Data Pegawai - SISTEM INFORMASI ABSENSI';
			 $breadcrumb = array(
					"Pegawai" => base_url()."pegawai",			
					"Data Pegawai" => ""
				);
			 $data['breadcrumb'] = $breadcrumb;

			
			$data['query'] = $this->pegawai_m->getAllDataPegawai();
			$this->load->view('pegawai/pegawai',$data);
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
					"Pegawai" => base_url()."pegawai",			
					"Tambah Pegawai" => ""
				);
			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Pegawai - SISTEM INFORMASI ABSENSI';
			$data['jabatan'] = $this->pegawai_m->getJabatan();
			$this->load->view('pegawai/tambah_pegawai', $data);
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
					"Pegawai" => base_url()."pegawai",			
					"Edit Pegawai" => ""
				);
			$bc['breadcrumb'] = $breadcrumb;
			$bc['title'] = 'Edit Pegawai - SISTEM INFORMASI ABSENSI';
			
			$pilih['nip'] = $this->uri->segment(3);
			$dt_pegawai = $this->pegawai_m->getSelectedData("pegawai",$pilih);
			foreach($dt_pegawai->result() as $db)
			{
				$bc['nip'] 				= $db->nip;
				$bc['nama_pegawai'] 	= $db->nama_pegawai;
				$bc['jenis_kelamin'] 	= $db->jenis_kelamin;
				$bc['photo'] 			= $db->photo;
				$bc['golongan'] 		= $db->golongan;
				$bc['jabatan_id_jabatan']		= $db->jabatan_id_jabatan;
				$bc['alamat_pegawai'] 	= $db->alamat_pegawai;
				$bc['no_telepon'] 		= $db->no_telepon;
				$bc['tempat_lahir'] 	= $db->tempat_lahir;
				$bc['tanggal_lahir'] 	= $db->tanggal_lahir;
				$bc['password'] 		= $db->password;
				$bc['status'] 			= $db->status;
				$bc['status_kerja'] 	= $db->status_kerja;

			}
			
			$bc['jabatan'] = $this->pegawai_m->getJabatan();
			$this->load->view('pegawai/edit_pegawai',$bc);
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

	public function cek_nip($nip){
		if ($this->pegawai_m->cek_nip($nip) == TRUE)
		{
			
			$this->form_validation->set_message('cek_nip', "<p>NIP dengan $nip Sudah Terdaftar</p>");
			return  FALSE;
		}
		else
		{		
				
			return TRUE;
		}
	}

	public function save(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
					$config['upload_path'] = './assets/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '9999999999';
					$config['max_width']  = '9999999999';
					$config['max_height']  = '9999999999';
					//$config['photo'] = $this->input->post('photo');

					$this->load->library('upload', $config);
					$breadcrumb = array(
										"Pegawai" => base_url()."pegawai",			
										"Edit Pegawai" => ""
									);
					$data['breadcrumb'] = $breadcrumb;
					$data['title'] = 'Tambah Pegawai - SISTEM INFORMASI ABSENSI';

					$this->form_validation->set_rules('nip', 'NIP', 'trim|required|xss_clean|callback_cek_nip');
					$this->form_validation->set_rules('nip', 'NIP', 'trim|required|max_length[25]|xss_clean');
					$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'trim|required|max_length[45]|xss_clean');
					$this->form_validation->set_rules('golongan', 'Golongan', 'trim|required|max_length[45]|xss_clean');
					$this->form_validation->set_rules('no_telepon', 'Nomor Telepon', 'trim|required|max_length[15]|xss_clean');
					$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required|max_length[25]|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[15]|xss_clean');
					if ($this->form_validation->run() == TRUE){
								if ($this->upload->do_upload('photo')){
									$data 					= $this->upload->data();
									$in['nip']				= $this->input->post('nip');
									$in['nama_pegawai']		= $this->input->post('nama_pegawai');
									$in['jenis_kelamin']	= $this->input->post('jenis_kelamin');
									$in['photo'] 			= $data['file_name'];
									$in['golongan']			= $this->input->post('golongan');
									$in['alamat_pegawai']	= $this->input->post('alamat_pegawai');
									$in['no_telepon']		= $this->input->post('no_telepon');
									$in['tempat_lahir']		= $this->input->post('tempat_lahir');
									$in['tanggal_lahir'] 	= $this->input->post('tanggal_lahir');
									$in['password']			= md5($this->input->post('password'));
									$in['status']			= $this->input->post('status');
									$in['status_kerja']		= $this->input->post('status_kerja');
									$in['jabatan_id_jabatan']		= $this->input->post('jabatan_id_jabatan');
									$this->pegawai_m->insertData("pegawai",$in);
									redirect('pegawai');

								}else{
									$breadcrumb = array(
											"Pegawai" => base_url()."pegawai",			
											"Tambah Pegawai" => ""
										);
									$data['breadcrumb'] = $breadcrumb;
									$data['title'] = 'Tambah Pegawai - SISTEM INFORMASI ABSENSI';
									$data['jabatan'] = $this->pegawai_m->getJabatan();
									$data = array('error' => $this->upload->display_errors());

									$this->load->view('pegawai/tambah_pegawai',$data);							
								}

						}else{
								$breadcrumb = array(
										"Pegawai" => base_url()."pegawai",			
										"Tambah Pegawai" => ""
									);
								$data['breadcrumb'] = $breadcrumb;
								$data['title'] = 'Tambah Pegawai - SISTEM INFORMASI ABSENSI';
								$data['jabatan'] = $this->pegawai_m->getJabatan();
								$this->load->view('pegawai/tambah_pegawai', $data);		

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
			$hapus['nip'] = $this->uri->segment(3);
			$dt_pegawai = $this->pegawai_m->deleteData('pegawai',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>pegawai"; </script>
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
	public function update()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
				if ($this->input->post('update')) {
					$config['upload_path'] = './assets/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '9999999999';
					$config['max_width']  = '9999999999';
					$config['max_height']  = '9999999999';
					//$config['photo'] = $this->input->post('photo');

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('photo'))
						{
							$data 					= $this->upload->data();
							$id['nip']				= $this->input->post('nip');
							$in['nama_pegawai']		= $this->input->post('nama_pegawai');
							$in['photo'] 			= $data['file_name'];
							$in['alamat_pegawai']	= $this->input->post('alamat_pegawai');
							$in['no_telepon']		= $this->input->post('no_telepon');
							$in['tempat_lahir']		= $this->input->post('tempat_lahir');
							$in['tanggal_lahir'] 	= $this->input->post('tanggal_lahir');
							$in['password']			= md5($this->input->post('password'));
							$in['status']			= $this->input->post('status');
							$in['jabatan_id_jabatan']		= $this->input->post('jabatan_id_jabatan');
							$this->pegawai_m->updateData("pegawai",$in, $id);
							redirect('pegawai');
						}
						
					else
						{
							$breadcrumb = array(
											"Pegawai" => base_url()."pegawai",			
											"Tambah Pegawai" => ""
										);
									$data['breadcrumb'] = $breadcrumb;
									$data['title'] = 'Tambah Pegawai - SISTEM INFORMASI ABSENSI';
									$data['jabatan'] = $this->pegawai_m->getJabatan();

							$data = array('error' => $this->upload->display_errors());
							$data = array('error' => $this->upload->display_errors());

							$this->load->view('pegawai/edit_pegawai', $data);
						}
							
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


/* End of file pegawai.php */
/* Location: ./application/controllers/pegawai.php */
