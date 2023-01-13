<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login()
	{

		$username = $this->input->post('admin_username');
		$password = $this->input->post('admin_password');
		$this->form_validation->set_rules('admin_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('admin_password', 'Password', 'trim|required');

		if ($this->form_validation->run() != false) {
			$where = array('username' => $username, 'password' => md5($password));

			$data = $this->m_hotel->edit_data($where, 'admin');
			$d = $this->m_hotel->edit_data($where, 'admin')->row();
			$cek = $data->num_rows();

			if ($cek > 0) {
				$session = array('id' => $d->id_admin, 'nama' => $d->nama_admin, 'status' => 'login');
				$this->session->set_userdata($session);
				redirect(base_url() . 'admin');
			} else {
				$this->session->set_flashdata('alert', 'Login gagal! Username atau password salah.');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('alert', 'Anda Belum mengisi Username atau Password');
			$this->load->view('login');
		}
	}
}
