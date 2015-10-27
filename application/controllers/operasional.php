<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/
class Operasional extends CI_Controller{
	public function __construct(){
	 parent::__construct();

	 $this->load->model('operasional_m');

	}

	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			
			 $breadcrumb = array(
					"Operasional" => base_url()."operasional",			
					"Data Waktu Operasional" => ""
				);
			 
			 $data['breadcrumb'] = $breadcrumb;
			 $data['title'] = 'Data Waktu Operasional - SISTEM INFORMASI ABSENSI';

			
			$data['query'] = $this->operasional_m->getAllDataOperasional();
			$this->load->view('operasional/operasional',$data, array('error' => ' ' ));
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
					"Waktu Operasional" => base_url()."operasional",			
					"Tambah Waktu Operasional" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Waktu Operasional - SISTEM INFORMASI ABSENSI';
			$data['tahun_akademik'] = $this->operasional_m->getTahunAkademik();
			$this->load->view('operasional/tambah_operasional', $data);
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

	public function cek_tanggal_operasional($tanggal_operasional){
		if ($this->operasional_m->cek_tanggal_operasional($tanggal_operasional) == TRUE)
		{
			
			$this->form_validation->set_message('cek_tanggal_operasional', "<p>Tanggal Absensi dengan $tanggal_operasional Sudah Terdaftar</p>");
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
			$breadcrumb = array(
					"Operasional" => base_url()."operasional",			
					"Tambah Waktu Operasional" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah Absensi - SISTEM INFORMASI ABSENSI';
			$this->form_validation->set_rules('tanggal_operasional', 'tanggal_operasional', 'trim|required|xss_clean|callback_cek_tanggal_operasional');

				if ($this->form_validation->run() == TRUE){
						$in['idoperasional']		= $this->input->post('idoperasional');
						$in['hari']					= $this->input->post('hari');
						$in['tanggal_operasional']	= $this->input->post('tanggal_operasional');
						$in['akademik_idakademik']	= $this->input->post('akademik_idakademik');
						$this->operasional_m->insertData("operasional",$in);
						redirect('operasional');
				}else{
					$this->load->view('operasional/tambah_operasional', $data);

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
					$id = $this->input->post('idoperasional');
					$in['tanggal_operasional']		= $this->input->post('tanggal_operasional');
					$in['hari']						= $this->input->post('hari');
					$in['akademik_idakademik']		= $this->input->post('akademik_idakademik');
					$this->operasional_m->updateData($id, $in);
					redirect('operasional');
				}else{
						

					redirect(base_url().'operasional/tambah');							
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
					"Operasional" => base_url()."operasional",			
					"Edit Waktu Operasional" => ""
				);

				$bc['breadcrumb'] = $breadcrumb;
				$bc['title'] = 'Edit Waktu Operasional - SISTEM INFORMASI ABSENSI';
				$bc['tahun_akademik'] = $this->operasional_m->getTahunAkademik();
				$pilih['idoperasional'] = $this->uri->segment(3);
				$dt_operasional = $this->operasional_m->getSelectedData("operasional",$pilih);
				foreach($dt_operasional->result() as $db)
				{
					$bc['idoperasional']		= $db->idoperasional;
					$bc['tanggal_operasional']	= $db->tanggal_operasional;
					$bc['hari']					= $db->hari;
					$bc['akademik_idakademik']	= $db->akademik_idakademik;

				}
				
				$this->load->view('operasional/edit_operasional',$bc);
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

	public function delete()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			$hapus['idoperasional'] = $this->uri->segment(3);
			$dt_operasional = $this->operasional_m->deleteData('operasional',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>operasional"; </script>
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


/* End of file absensi.php */
/* Location: ./application/controllers/absensi.php */