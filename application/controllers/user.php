<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * @author : Jayanudin
	 **/

class User extends CI_Controller{

	public function __construct(){
	 parent::__construct();

	 $this->load->model('user_m');

	}

	public function index(){
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek))
		{
			
			 $breadcrumb = array(
					"User" => base_url()."user",			
					"Data User" => ""
				);
			 
			 $data['breadcrumb'] = $breadcrumb;
			 $data['page'] = $this->pagination->create_links();
			 $data['title'] = 'Data User - SISTEM INFORMASI ABSENSI';

			
			$data['query'] = $this->user_m->getAllDataUser();
			$this->load->view('user/user',$data, array('error' => ' ' ));
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
					"User" => base_url()."user",			
					"Tambah User" => ""
				);

			$data['breadcrumb'] = $breadcrumb;
			$data['title'] = 'Tambah User - SISTEM INFORMASI ABSENSI';
			$this->load->view('user/tambah_user', $data);
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
					"User" => base_url()."user",			
					"Edit User" => ""
				);

				$bc['breadcrumb'] = $breadcrumb;
				$bc['title'] = 'Edit User - SISTEM INFORMASI ABSENSI';
				$pilih['id_user'] = $this->uri->segment(3);
				$dt_user = $this->user_m->getSelectedData("user",$pilih);
				foreach($dt_user->result() as $db)
				{
					$bc['id_user']			= $db->id_user;
					$bc['nama_pengguna'] 	= $db->nama_pengguna;
					$bc['photo'] 			= $db->photo;
					$bc['username']		 	= $db->username;
					$bc['password'] 		= $db->password;
					$bc['status'] 			= $db->status;

				}
				
				$this->load->view('user/edit_user',$bc);
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
					$config['upload_path'] = './assets/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '9999999999';
					$config['max_width']  = '9999999999';
					$config['max_height']  = '9999999999';

					$this->load->library('upload', $config);
					$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim|required|max_length[45]|xss_clean');
					$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[45]|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[45]|xss_clean');
					if ($this->form_validation->run()==TRUE) {
						if ($this->input->post('submit')) {
								if ($this->upload->do_upload('photo')){
									$data 					= $this->upload->data();
									$in['id_user']			= $this->input->post('id_user');
									$in['nama_pengguna']	= $this->input->post('nama_pengguna');
									$in['photo'] 			= $data['file_name'];
									$in['username']			= $this->input->post('username');
									$in['password']			= md5($this->input->post('password'));
									$in['status']			= $this->input->post('status');
									$this->user_m->insertData("user",$in);
									redirect('user');
								}else{

									$data = array('error' => $this->upload->display_errors());

									$this->load->view('user/tambah_user',$data);							
								}
							}else{
								$this->load->view('user/tambah_user', $error);							
							}
					}else{
						$breadcrumb = array(
								"User" => base_url()."user",			
								"Tambah User" => ""
							);

						$data['breadcrumb'] = $breadcrumb;
						$data['title'] = 'Tambah User - SISTEM INFORMASI ABSENSI';
						$this->load->view('user/tambah_user', $data);
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
					$config['upload_path'] = './assets/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '9999999999';
					$config['max_width']  = '9999999999';
					$config['max_height']  = '9999999999';

					$this->load->library('upload', $config);
							if ($this->input->post('update')) {
								if ($this->upload->do_upload('photo')){
									$data 					= $this->upload->data();
									$id 					= $this->input->post('id_user');
									$in['nama_pengguna']	= $this->input->post('nama_pengguna');
									$in['photo'] 			= $data['file_name'];
									$in['username']			= $this->input->post('username');
									$in['password']			= md5($this->input->post('password'));
									$in['status']			= $this->input->post('status');
									$this->user_m->updateData($id, $in);
									redirect('user');
								}else{
									$data = array('error' => $this->upload->display_errors());

									$this->load->view('user/edit_user',$data);	
								}
							}else{
									

								$this->load->view('user/edit_user', $error);							
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
			$hapus['id_user'] = $this->uri->segment(3);
			$dt_pegawai = $this->user_m->deleteData('user',$hapus);
			?>
				<script> window.location = "<?php echo base_url(); ?>user"; </script>
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
