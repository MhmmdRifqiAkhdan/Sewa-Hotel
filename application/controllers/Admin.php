<?php
defined('BASEPATH') or exit ('NO Direct Script Access Allowed');

class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		// cek login
		if($this->session->userdata('status') != "login"){
			$alert=$this->session->set_flashdata('alert', 'Silahkan Login Dahulu');
			redirect(base_url());
		}
	}

	function index(){
		$data['penyewaan'] = $this->db->query("select * from transaksi order by id_sewa desc limit 10")->result();
		$data['pelanggan'] = $this->db->query("select * from pelanggan order by id_pelanggan desc limit 10")->result();
		$data['kamar'] = $this->db->query("select * from kamar order by id_kamar desc limit 10")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'welcome?pesan=logout');
	}
	
	function ganti_password(){
		$this->load->view('admin/header');
		$this->load->view('admin/ganti_password');
		$this->load->view('admin/footer');
	}

	function ganti_password_act(){
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');

		$this->form_validation->set_rules('pass_baru','Password Baru','required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass','Ulangi Password Baru','required');
		if($this->form_validation->run() != false){
			$data = array('password' => md5($pass_baru));
			$w = array('id_admin' => $this->session->userdata('id'));
			$this->m_hotel->update_data($w,$data,'admin');
			redirect(base_url().'admin/ganti_password?pesan=berhasil');
		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/ganti_password');
			$this->load->view('admin/footer');
		}
	}

	function kamar(){
		$data['kamar'] = $this->m_hotel->get_data('kamar')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/datakamar',$data);
		$this->load->view('admin/footer');
	}
	
	function tambah_kamar(){
		//memuat data tipekamar untuk ditampilkan di select form
		$data['tipekamar'] =$this->m_hotel->get_data('tipekamar')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/tambahkamar',$data);
		$this->load->view('admin/footer');
	}

	function tambah_kamar_act(){
		$tgl_input = date('dd-mm-Y');
		$id_tipekamar = $this->input->post('id_tipe');
		$kamar = $this->input->post('nama_kamar');
		$nokamar = $this->input->post('no_kamar');
		$kasur = $this->input->post('tipe_kasur');
		$harga_kamar = $this->input->post('harga_kamar');
		$lokasi = $this->input->post('lokasi');
		$status = $this->input->post('status_kamar');
		$this->form_validation->set_rules('id_tipe','Tipe Kamar','required');
		$this->form_validation->set_rules('nama_kamar','Nama Kamar','required');
		$this->form_validation->set_rules('status_kamar','Status Kamar','required');
		if($this->form_validation->run() != false){
			//configurasi upload gambar
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'gambar'.time();

			$this->load->library('upload', $config);

			if($this->upload->do_upload('fotokamar')){
				$image=$this->upload->data();

				$data = array(
					'id_tipe' =>$id_tipekamar,
					'nama_kamar' => $kamar,
					'no_kamar' => $nokamar,
					'tipe_kasur' => $kasur,
					'harga_kamar' => $harga_kamar,
					'lokasi' => $lokasi,
					'gambar' => $image['file_name'],
					'status_kamar' => $status
				);
		
				$this->m_hotel->insert_data($data,'kamar');
				redirect(base_url().'admin/kamar');
			}else{
				$this->session->set_flashdata('alert', 'Anda Belum Memilih Foto Kamar');
			}
		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/tambahkamar');
			$this->load->view('admin/footer');
		}
	}

	function edit_kamar($id){
		$where = array('id_kamar' => $id);
		$data['kamar'] = $this->db->query("select * from kamar K, tipekamar T where K.id_tipe=T.id_tipe and K.id_kamar='$id'")->result();
		$data['tipekamar'] =$this->m_hotel->get_data('tipekamar')->result();
		//$data['kamar'] = $this->m_hotel->edit_data($where,'kamar')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/editkamar',$data);
		$this->load->view('admin/footer');
	}

	function update_kamar(){
		$id = $this->input->post('id');
		$id_tipe = $this->input->post('id_tipe');
		$kamar = $this->input->post('nama_kamar');
		$nokamar = $this->input->post('no_kamar');
		$kasur = $this->input->post('tipe_kasur');
		$harga_kamar = $this->input->post('harga_kamar');
		$lokasi = $this->input->post('lokasi');
		$status = $this->input->post('status_kamar');
		$this->form_validation->set_rules('id_tipe', 'Tipe Kamar', 'required');
		$this->form_validation->set_rules('nama_kamar', 'Nama Kamar', 'required|min_length[4]');
		$this->form_validation->set_rules('no_kamar', 'Nomor Kamar', 'required|min_length[3]');
		$this->form_validation->set_rules('tipe_kasur', 'Tipe Kasur', 'required|min_length[5]');
		$this->form_validation->set_rules('harga_kamar', 'Harga Kamar', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi kamar', 'required');
		$this->form_validation->set_rules('status_kamar', 'Status Kamar', 'required');

		if($this->form_validation->run() != false){
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'gambar'.time();

			$this->load->library('upload', $config);

			$where = array('id_kamar' => $id);
			$data = array(
				'id_tipe' =>$id_tipe,
				'nama_kamar' => $kamar,
				'no_kamar' => $nokamar,
				'tipe_kasur' => $kasur,
				'harga_kamar' => $harga_kamar,
				'lokasi' => $lokasi,
				'gambar' => $image['file_name'],
				'status_kamar' => $status,
			);

			if($this->upload->do_upload('fotokamar')){
			    //proses upload gambar
			  $image = $this->upload->data();
			  unlink('assets/upload/'.$this->input->post('old_pict', TRUE));
		      $data['gambar'] = $image['file_name'];

			  $this->m_hotel->update_data($where, $data,'kamar');
			}else {
			  $this->m_hotel->update_data($where, $data,'kamar');
			}

			$this->m_hotel->update_data($where,$data,'kamar');
			redirect(base_url().'admin/kamar');
		}else{
			$where = array('id_kamar' => $id);
			$data['kamar'] = $this->db->query("select * from kamar K , tipekamar T where K.id_tipe=T.id_tipe and K.id_kamar='$id'")->result();
			$data['tipekamar'] =$this->m_hotel->get_data('tipekamar')->result();
			//$data['kamar'] = $this->m_hotel->edit_data($where,'kamar')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/editkamar',$data);
			$this->load->view('admin/footer');
		}
	}

	function hapus_kamar($id){
		$where = array('id_kamar' => $id);
		$this->m_hotel->delete_data($where,'kamar');
		redirect(base_url().'admin/kamar');
	}

	function pelanggan(){
		$data['pelanggan'] = $this->m_hotel->get_data('pelanggan')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/datapelanggan',$data);
		$this->load->view('admin/footer');
	}

	function tambah_pelanggan(){
		$this->load->view('admin/header');
		$this->load->view('admin/tambahpelanggan');
		$this->load->view('admin/footer');
	}

	function tambah_pelanggan_act(){
		$nama = $this->input->post('nama_pelanggan');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$gender = $this->input->post('gender');
		$notelp = $this->input->post('notelp');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		
		$this->form_validation->set_rules('nama_pelanggan','Nama Pelanggan','required');
		$this->form_validation->set_rules('notelp','No Telepon','required');
		$this->form_validation->set_rules('email','Email','required');
		if($this->form_validation->run() != false){
			$data = array(
				'nama_pelanggan' => $nama,
				'password' => md5 ($password),
				'gender' => $gender,
				'no_telp' => $notelp,
				'alamat' => $alamat,
				'email' => $email
			);
		
			$this->m_hotel->insert_data($data,'pelanggan');
			redirect(base_url().'admin/pelanggan');
		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/tambahpelanggan');
			$this->load->view('admin/footer');
		}
	}

	function edit_pelanggan($id){
		$where = array('id_pelanggan' => $id);
		$data['pelanggan'] = $this->m_hotel->edit_data($where,'pelanggan')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/editpelanggan',$data);
		$this->load->view('admin/footer');
	}

	function update_pelanggan(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_pelanggan');
		$gender = $this->input->post('gender');
		$notelp = $this->input->post('notelp');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$this->form_validation->set_rules('nama_pelanggan','Nama Pelanggan','required');
		$this->form_validation->set_rules('gender','Jenis Kelamin','required');
		$this->form_validation->set_rules('notelp','No Telepon','numeric|required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('email','Email','required');
		if($this->form_validation->run() != false){
			$where = array('id_pelanggan' => $id);
			$data = array(
				'nama_pelanggan' => $nama,
				'gender' => $gender,
				'no_telp' => $notelp,
				'alamat' => $alamat,
				'email' => $email
			);
			$this->m_hotel->update_data($where,$data,'pelanggan');
			redirect(base_url().'admin/pelanggan');
		}else{
			$where = array('id_pelanggan' => $id);
			$data['kamar'] = $this->m_hotel->edit_data($where,'pelanggan')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/editpelanggan',$data);
			$this->load->view('admin/footer');
		}
	}

	function hapus_pelanggan($id){
		$where = array('id_pelanggan' => $id);
		$this->m_hotel->delete_data($where,'pelanggan');
		redirect(base_url().'admin/pelanggan');
	}

	function penyewaan(){

		$data['penyewaan'] = $this->db->query("SELECT * FROM transaksi T, kamar K, pelanggan P WHERE T.id_kamar=K.id_kamar and T.id_pelanggan=P.id_pelanggan")->result();
		
		$this->load->view('admin/header');
		$this->load->view('admin/penyewaan',$data);
		$this->load->view('admin/footer');
	}

	function tambah_penyewaan(){
		$w = array('status_kamar'=>'1');
		$data['kamar'] = $this->m_hotel->edit_data($w,'kamar')->result();
		$data['pelanggan'] = $this->m_hotel->get_data('pelanggan')->result();
		$data['penyewaan'] = $this->m_hotel->get_data('transaksi')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/tambahpenyewaan',$data);
		$this->load->view('admin/footer');
	}

	function tambah_penyewaan_act(){
		
		$tgl_bayar = date('Y-m-d H:i:s');
		$pelanggan = $this->input->post('pelanggan');
		$kamar = $this->input->post('kamar');
		$tgl_cekin = $this->input->post('tgl_cekin');
		$tgl_cekout = $this->input->post('tgl_cekout');
		$extend = $this->input->post('extend');
		
		$this->form_validation->set_rules('pelanggan','Nama Pelanggan','required');
		$this->form_validation->set_rules('kamar','Nama Kamar','required');
		$this->form_validation->set_rules('tgl_cekin','Tanggal Check-in','required');
		$this->form_validation->set_rules('tgl_cekout','Tanggal Check-out','required');
		$this->form_validation->set_rules('extend','Harga Extend','required');

		if($this->form_validation->run() != false){
			$data = array(
			'tgl_bayar' => $tgl_bayar,
			'id_pelanggan' => $pelanggan,
			'id_kamar' => $kamar,
			'tgl_cekin' => $tgl_cekin,
			'tgl_cekout' => $tgl_cekout,
			'extend' => $extend,
			'tgl_extend' => '0000-00-00',
			'total_extend' => '0',
			'status_penyewaan' => '0',
			'status_pembayaran' => '0'
			);

			$this->m_hotel->insert_data($data,'transaksi');
			
			// update status kamar yg di sewa
			$d = array('status_kamar' => '0', 'tgl_input' => substr($tgl_bayar, 0, 10));
			$w = array('id_kamar' => $kamar);
			$this->m_hotel->update_data($w,$d,'kamar');
			
			redirect(base_url().'admin/penyewaan');
		}else{
			$w = array('status_kamar'=>'1');
			$data['kamar'] = $this->m_hotel->edit_data($w,'kamar')->result();
			$data['pelanggan'] = $this->m_hotel->get_data('pelanggan')->result();

			$this->load->view('admin/header');
			$this->load->view('admin/tambahpenyewaan',$data);
			$this->load->view('admin/footer');
		}
	}

	function hapus_penyewaan($id){
		$w = array('id_sewa' => $id);
		$data = $this->m_hotel->edit_data($w,'transaksi')->row();
		//$data = $this->m_hotel->edit_data($w,'penyewaan')->row();
		$ww = array('id_kamar' => $data->id_kamar);
		$data2 = array('status_kamar' => '1');
		$this->m_hotel->update_data($ww,$data2,'kamar');
		$this->m_hotel->delete_data($w,'transaksi');
		redirect(base_url().'admin/penyewaan');
	}

	function transaksi_selesai($id){
		$data['kamar'] = $this->m_hotel->get_data('kamar')->result();
		$data['pelanggan'] = $this->m_hotel->get_data('pelanggan')->result();
		$data['penyewaan'] = $this->db->query("select * from transaksi t, pelanggan p, kamar k  where t.id_kamar = k.id_kamar and t.id_pelanggan=p.id_pelanggan and t.id_sewa='$id'")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/transaksi_selesai',$data);
		$this->load->view('admin/footer');
	}

	function transaksi_selesai_act(){
		$id = $this->input->post('id');
		$tgl_akhir = $this->input->post('tgl_akhir');
		$tgl_cekout = $this->input->post('tgl_cekout');
		$tgl_cekin = $this->input->post('tgl_cekin');
		$kamar = $this->input->post('kamar');
		$hkamar = $this->input->post('extend');
		$this->form_validation->set_rules('tgl_akhir','Tanggal Akhir Check-out','required');
		if($this->form_validation->run() != false){
		// menghitung selisih hari 
			$awal_cekin = strtotime($tgl_cekin);
			$akhir_cekout = strtotime($tgl_akhir);
			$selisih = abs(($awal_cekin - $akhir_cekout)/(60*60*24));
			$total_bayar = $hkamar*$selisih;
			// update status penyewaan
			$data = array('status_pembayaran' => '1', 'total_extend' => $total_bayar,'tgl_extend' => $tgl_akhir,'status_penyewaan' => '1');
			//$data3 = array();
			$w = array('id_sewa' => $id);
			$this->m_hotel->update_data($w,$data,'transaksi');
			//$this->m_hotel->update_data($w,$data3,'detail_sewa');
			// update status kamar
			$data2 = array('status_kamar' => '1');
			$w2 = array('id_kamar' => $kamar);
			$this->m_hotel->update_data($w2,$data2,'kamar');
			redirect(base_url().'admin/penyewaan');
		}else{
			$data['kamar'] = $this->m_hotel->get_data('kamar')->result();
			$data['pelanggan'] = $this->m_hotel->get_data('pelanggan')->result();
			$data['penyewaan'] = $this->db->query("select * from penyewaan p, pelanggan a, detail_sewa d, kamar k  where p.id_pelanggan = a.id_pelanggan and p.id_sewa = d.id_sewa and d.id_kamar = k.id_kamar and p.id_sewa='$id'")->result();
			
			$this->load->view('admin/header');
			$this->load->view('admin/transaksi_selesai',$data);
			$this->load->view('admin/footer');
		}
	}
}