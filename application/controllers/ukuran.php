<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Ukuran extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('ukuran');
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/master/ukuran/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanukuran')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_ukuran');
 			$kode = $this->input->post('kode_ukuran');

 			$sqlnama = count($this->global_model->find_by('ukuran', array('nama_ukuran' => $nama)));
 			$sqlkode = count($this->global_model->find_by('ukuran', array('kode_ukuran' => $kode)));

 			if($kode == "" | $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','ukuran');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Nama ukuran sudah ada','ukuran');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode ukuran sudah ada','ukuran');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama ukuran sudah ada','ukuran');
 				}else{
 					unset($data['simpanukuran']);
 					$data['kode_ukuran'] = strtoupper($kode);
 					$this->global_model->create('ukuran',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','ukuran');	
 				}
 			}

 			redirect(site_url('ukuran'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('ukuran', array('kode_ukuran' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','ukuran');
			
		}else if(empty($chkbox)){
			$this->message('success','Informasi !','Data berhasil dihapus','ukuran');
		}

		redirect(site_url('ukuran'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahukuran')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_ukuran');
 			$kode = $this->input->post('kode_ukuran');

 			$sqlnama = $this->global_model->find_by('ukuran', array('nama_ukuran' => $nama));
 			$sqlkode = $this->global_model->find_by('ukuran', array('kode_ukuran' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('ukuran', array('kode_ukuran' => $id));

 			if($kode == "" || $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','ukuran');
 			}else{
 				if($nama == $sql['nama_ukuran'] && $kode == $sql['kode_ukuran']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','ukuran');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_ukuran'] && $sqlkode != Null && $kode != $sql['kode_ukuran']){
	 					$this->message('alert','Informasi !','Kode dan Nama ukuran sudah ada','ukuran');
	 				}else if($sqlnama != Null && $nama != $sql['nama_ukuran']){
	 					$this->message('alert','Informasi !','Nama ukuran sudah ada','ukuran');
		 			}else if($sqlkode != Null && $kode != $sql['kode_ukuran']){
		 				$this->message('alert','Informasi !','Kode ukuran sudah ada','ukuran');
		 			}else {
		 				unset($data['ubahukuran']);
		 				$data['kode_ukuran'] = strtoupper($kode);
				 		$this->global_model->update('ukuran',$data, array('kode_ukuran' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','ukuran');
		 			}
	 			}
 			}

 			redirect(site_url('ukuran'));
 		}
 		
 	}

 	function tampildata($id){
 		$sql = $this->global_model->find_by('ukuran', array('kode_ukuran' => $id));

 		echo json_encode($sql);
 	}


 }