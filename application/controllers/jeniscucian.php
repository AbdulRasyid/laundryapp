<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Jeniscucian extends CI_Controller {

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
 		$data['ukuran'] = $this->global_model->find_all('ukuran');
 		$data['load'] = $this->global_model->find_all('jenis_cucian');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/jeniscucian/index',$data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanjeniscucian')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_jenis');
 			$ukuran = $this->input->post('kode_ukuran');
 			$kode = $this->input->post('kode_jenis');

 			$sqlnama = count($this->global_model->find_by('jenis_cucian', array('nama_jenis' => $nama)));
 			$sqlkode = count($this->global_model->find_by('jenis_cucian', array('kode_jenis' => $kode)));

 			if($kode == "" || $nama == "" || $ukuran == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','jeniscucian');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Nama dan Kode jenis sudah ada','jeniscucian');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','kode jenis sudah ada','jeniscucian');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama jenis sudah ada','jeniscucian');
 				}else{
 					unset($data['simpanjeniscucian']);
 					$data['kode_jenis'] = strtoupper($kode);
 					$this->global_model->create('jenis_cucian',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','jeniscucian');	
 				}
 			}

 			redirect(site_url('jeniscucian'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('jenis_cucian', array('kode_jenis' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil di hapus','jeniscucian');
			
		}else if(empty($chkbox)){
		   $this->message('info','Informasi !','Tidak ada data yang di hapus','jeniscucian');
		}

		redirect(site_url('jeniscucian'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahjeniscucian')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_jenis');
 			$kode = $this->input->post('kode_jenis');
 			$kodeukuran = $this->input->post('kode_ukuran');

 			$sqlnama = $this->global_model->find_by('jenis_cucian', array('nama_jenis' => $nama));
 			$sqlkode = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $id));

 			if($nama =="" || $kode == "" || $kodeukuran == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','jeniscucian');
 			}else {
 				if($nama == $sql['nama_jenis'] && $kode == $sql['kode_jenis'] && $kodeukuran == $sql['kode_ukuran']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','jeniscucian');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_jenis'] && $sqlkode != Null && $kode != $sql['kode_jenis']){
	 					$this->message('alert','Informasi !','Nama dan Kode jenis sudah ada','jeniscucian');

	 				}else if($sqlnama != Null && $nama != $sql['nama_jenis']){
	 					$this->message('alert','Informasi !','Nama jenis sudah ada','jeniscucian');

		 			}else if($sqlkode != Null && $kode != $sql['kode_jenis']){
		 				$this->message('alert','Informasi !','Kode jenis sudah ada','jeniscucian');

		 			}else {
		 				unset($data['ubahjeniscucian']);
		 				$data['kode_jenis'] = strtoupper($kode);
				 		$this->global_model->update('jenis_cucian',$data, array('kode_jenis' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','jeniscucian');
		 			}
	 			}
 			}

 			redirect(site_url('jeniscucian'));

 		}
 		
 	}

 	function tampildata($id){
 		$sql = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $id));

 		echo json_encode($sql);
 	}


 }