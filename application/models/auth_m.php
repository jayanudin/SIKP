<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_M extends CI_Model{

	public function __construct(){
	 parent::__construct();

	}

	public function getLoginData($usr,$psw){
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw.''));
		$q_cek_login = $this->db->get_where('user', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
				if($qck->status=='admin')
				{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 1;
						$sess_data['username'] = $qad->username;
						$sess_data['nama_pengguna'] = $qad->nama_pengguna;
						$sess_data['photo'] = $qad->photo;
						$sess_data['status'] = $qad->status;
						$this->session->set_userdata($sess_data);
					}
					
				}
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'auth');
		}
	}
}