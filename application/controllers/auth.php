<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
	 parent::__construct();
	 $this->load->model('auth_m');

	}

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('tipe_login', 'Menu', 'required');
	
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('auth/bg_login');
			}
			else
			{
				$tipe_login = $this->input->post('tipe_login');
				if ($tipe_login == 'administrator') {
					$u = $this->input->post('username');
					$p = $this->input->post('password');
					$this->auth_m->getLoginData($u,$p);
					header('location:'.base_url().'app');
				}elseif ($tipe_login == 'user') {
					$u = $this->input->post('username');
					$p = $this->input->post('password');
					$this->auth_m->getLoginData($u,$p);
					header('location:'.base_url().'main');
				}else{
					$this->load->view('auth/bg_login');
				}
			}
		}
		else
		{
			$st = $this->session->userdata('status');
			$tipe = $this->input->post('tipe_login');
			if($st=='admin' && $tipe == 'administrator')
			{
				header('location:'.base_url().'app');
			}elseif($st=='admin' && $tipe == 'user'){
				header('location:'.base_url().'main');
			}
			else
			{
				header('location:'.base_url().'auth');
			}
		
		}
	}
	
	public function login()
	{
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->auth_m->getLoginData($u,$p);
	}
	
	public function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'auth');
		}
		else
		{
			$this->session->sess_destroy();
			header('location:'.base_url().'auth');
		}
	}
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */