<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class User extends CI_Controller {

 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
 		$this->load->helper('url');
 		$this->load->library('session');
 		
 		if(!$this->session->userdata(
 			'namalengkap','namauser','emailuser'))
        {
            redirect(site_url('/'));
        }

 	}

 	public function message($mode,$caption,$text,$active)
 	{
 		//generate message
 		$messagesession = array(
 			'messagemode' => $mode,
 			'messagecaption' => $caption,
 			'messagetext' => $text,
 			'messageactive' => $active);
 		$this->session->set_flashdata($messagesession);
 	}


 	public function index()
 	{
 		$data['load'] = $this->global_model->query("select *from user where status !='admin'");
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/user/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		$button = $this->input->post('simpanuser');

 		if($button){

 			$namalengkap = $this->input->post('namalengkap');
 			$username = $this->input->post('username');
 			$password = md5($this->input->post('password'));
 			$password_word = $this->input->post('password');
 			$email = $this->input->post('email');
 			$tentang = $this->input->post('tentang');
 			$status = $this->input->post('status');

 			$data = array(
 				'namalengkap' => $namalengkap,
 				'username' => $username,
 				'password' => $password,
 				'password_word' => $password_word,
 				'email' => $email,
 				'tentang' => $tentang,
 				'status' => $status);

 			$sqluser = count($this->global_model->find_by('user', array('username' => $username)));

 			if($namalengkap == "" || $username == "" || $password_word == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','user');
 			}else{
 				if($sqluser > 0) {
 					$this->message('alert','Informasi !','Nama pengguna sudah ada','user');
 				}else{
 					unset($button);
 					$this->global_model->create('user',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','user');	
 				}
 			}

 			redirect(site_url('user'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('user', array('username' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','user');
			
		}else if(empty($chkbox)){
			$this->message('info','Informasi !','Tidak ada data yang di hapus','user');
		}

		redirect(site_url('user'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahbarang')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_barang');
 			$kode = $this->input->post('kode_barang');
 			$kategori = $this->input->post('kode_kategori');

 			$sqlnama = $this->global_model->find_by('barang', array('nama_barang' => $nama));
 			$sqlkode = $this->global_model->find_by('barang', array('kode_barang' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('barang', array('kode_barang' => $id));

 			if($nama == "" || $kode == "" || $kategori == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','barang');
 			}else{
 				if($nama == $sql['nama_barang'] && $kode == $sql['kode_barang'] && $kategori == $sql['kode_kategori']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','barang');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_barang'] && $sqlkode != Null && $kode != $sql['kode_barang']){
	 					$this->message('alert','Informasi !','Kode dan Nama barang sudah ada','barang');
	 				}else if($sqlnama != Null && $nama != $sql['nama_barang']){
	 					$this->message('alert','Informasi !','Nama barang sudah ada','barang');
		 			}else if($sqlkode != Null && $kode != $sql['kode_barang']){
		 				$this->message('alert','Informasi !','Kode barang sudah ada','barang');
		 			}else {
		 				unset($data['ubahbarang']);
		 				$data['kode_barang'] = strtoupper($kode);
				 		$this->global_model->update('barang',$data, array('kode_barang' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','barang');
		 			}
	 			}
 			}

 			redirect(site_url('barang'));

 		}
 		
 	}

 	function tampildata($id){
 		$sql = $this->global_model->find_by('user', array('username' => $id));

 		echo json_encode($sql);
 	}

 }