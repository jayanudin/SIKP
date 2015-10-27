<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends CI_Controller{

	public function __construct(){
		 parent::__construct();
		 $this->load->model('jabatan_m');

	}


	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			
			 $data['title'] = 'Data Jabatan Pegawai - SISTEM INFORMASI ABSENSI';
			 $breadcrumb = array(
					"Jabatan" => base_url()."jabatan",			
					"Data Jabatan Pegawai" => ""
				);
			 $data['breadcrumb'] = $breadcrumb;

			
			$data['query'] = $this->jabatan_m->getAllDataJabatan();
			$this->load->view('jabatan/jabatan',$data, array('error' => ' ' ));
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
			$breadcrumb = array(
					"Jabatan" => base_url()."jabatan",			
					"Tambah Jabatan" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Jabatan - SISTEM INFORMASI ABSENSI';
			$this->load->view('jabatan/tambah_jabatan', $data);
		}
		else
		{
			$st = $this->session->userdata('stts');
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
			$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required|max_length[45]|xss_clean');
			if ($this->form_validation->run()==TRUE) {
				if ($this->input->post('submit')) {
					$in['id_jabatan']		= $this->input->post('id_jabatan');
					$in['jabatan']			= $this->input->post('jabatan');
					$this->jabatan_m->insertData("jabatan",$in);
					redirect('jabatan');
				}else{
					$this->load->view('jabatan/jabatan', $error);							
				}
			}else{
				$breadcrumb = array(
					"Jabatan" => base_url()."jabatan",			
					"Tambah Jabatan" => ""
				);

				$data['breadcrumb'] = $breadcrumb;
				$data['title'] = 'Tambah Jabatan - SISTEM INFORMASI ABSENSI';
				$this->load->view('jabatan/tambah_jabatan', $data);
			}
				
		}
		else
		{
			$st = $this->session->userdata('stts');
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
					"Jabatan" => base_url()."jabatan",			
					"Edit Jabatan" => ""
				);

				$bc['breadcrumb'] = $breadcrumb;
				$bc['title'] = 'Edit Jabatan - SISTEM INFORMASI ABSENSI';
				$pilih['id_jabatan'] = $this->uri->segment(3);
				$dt_jabatan = $this->jabatan_m->getSelectedData("jabatan",$pilih);
				foreach($dt_jabatan->result() as $db)
				{
					$bc['id_jabatan']		= $db->id_jabatan;
					$bc['jabatan'] 			= $db->jabatan;

				}
				
				$this->load->view('jabatan/edit_jabatan',$bc);
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

	public function update(){
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) 
		{
				if ($this->input->post('update')) {;
					$id = $this->input->post('id_jabatan');
					$in['jabatan']			= $this->input->post('jabatan');
					$in['keterangan']		= $this->input->post('keterangan');
					$this->jabatan_m->updateData($id, $in);
					redirect('jabatan');
				}else{
						

					$this->load->view('jabatan/edit_jabatan', $error);							
				}
		}
		else
		{
			$st = $this->session->userdata('stts');
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
			$hapus['id_jabatan'] = $this->uri->segment(3);
			$dt_jabatan = $this->jabatan_m->deleteData('jabatan',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>jabatan"; </script>
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