<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/

class Akademik extends CI_Controller{

	public function __construct(){
	 parent::__construct();
	 $this->load->model('akademik_m');

	}

	public function index($id = NULL){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			 
			 $breadcrumb = array(
					"Tahun Akademik" => base_url()."akademik",			
					"Data Tahun Akademik" => ""
				);
			 
			 $data['breadcrumb'] = $breadcrumb;
			 $data['title'] = 'Data Tahun Akademik - SISTEM INFORMASI ABSENSI';

			
			$data['query'] = $this->akademik_m->getAllDataTahunAkademik();
			$this->load->view('akademik/akademik',$data, array('error' => ' ' ));
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
					"Tahun Akademik" => base_url()."akademik",			
					"Tambah Tahun Akademik" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Tahun Akademik - SISTEM INFORMASI ABSENSI';
			$this->load->view('akademik/tambah_akademik', $data);
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
					"Tahun Akademik" => base_url()."akademik",			
					"Edit Tahun Akademik" => ""
				);

				$bc['breadcrumb'] = $breadcrumb;
				$bc['title'] = 'Edit Tahun Akademik - SISTEM INFORMASI ABSENSI';
				$pilih['idakademik'] = $this->uri->segment(3);
				$dt_akademik = $this->akademik_m->getSelectedData("akademik",$pilih);
				foreach($dt_akademik->result() as $db)
				{
					$bc['idakademik']		= $db->idakademik;
					$bc['tahun_akademik'] 	= $db->tahun_akademik;


				}
				
				$this->load->view('akademik/edit_akademik',$bc);
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
			$this->form_validation->set_rules('tahun_akademik', 'Tahun Akademik', 'trim|required|max_length[25]|xss_clean');
			if ($this->form_validation->run()==TRUE) {
				if ($this->input->post('submit')) {
					$in['idakademik']		= $this->input->post('idakademik');
					$in['tahun_akademik']	= $this->input->post('tahun_akademik');
					$this->akademik_m->insertData("akademik",$in);
					redirect('akademik');
				}else{
					$this->load->view('akademik/tambah_akademik', $error);							
				}
			}else{
				$breadcrumb = array(
					"Tahun Akademik" => base_url()."akademik",			
					"Tambah Tahun Akademik" => ""
				);

				$data['breadcrumb'] = $breadcrumb;
				$data['title'] = 'Tambah Tahun Akademik - SISTEM INFORMASI ABSENSI';
				$this->load->view('akademik/tambah_akademik', $data);
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
					$id						= $this->input->post('idakademik');
					$in['tahun_akademik']	= $this->input->post('tahun_akademik');
					$this->akademik_m->updateData($id, $in);
					redirect('akademik');
				}else{
						

					$this->load->view('akademik/edit_akademik', $error);							
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
			$hapus['idakademik'] = $this->uri->segment(3);
			$dt_akademik = $this->akademik_m->deleteData('akademik',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>akademik"; </script>
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


/* End of file user.php */
/* Location: ./application/controllers/user.php */
