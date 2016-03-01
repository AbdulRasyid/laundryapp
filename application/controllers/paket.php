<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Paket extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('paket_kerja');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/paket/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanpaket')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_paket');
 			$kode = $this->input->post('kode_paket');
 			$waktu = $this->input->post('waktu');
 			$harga = $this->input->post('harga');

 			$sqlnama = count($this->global_model->find_by('paket_kerja', array('nama_paket' => $nama)));
 			$sqlkode = count($this->global_model->find_by('paket_kerja', array('kode_paket' => $kode)));

 			if($kode == "" || $nama == "" || $waktu == "" || $harga == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','paket');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Nama paket sudah ada','paket');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode paket sudah ada');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama paket sudah ada','paket');
 				}else{
 					unset($data['simpanpaket']);
 					$data['kode_paket'] = strtoupper($kode);
 					$this->global_model->create('paket_kerja',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','paket');	
 				}
 			}

 			redirect(site_url('paket'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('paket_kerja', array('kode_paket' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','paket');
			
		}else if(empty($chkbox)){
		   $this->message('info','Informasi !','Tidak ada data yang di hapus','paket');
		}

		redirect(site_url('paket'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahpaket')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_paket');
 			$kode = $this->input->post('kode_paket');
 			$waktu = $this->input->post('waktu');
 			$harga = $this->input->post('harga');

 			$sqlnama = $this->global_model->find_by('paket_kerja', array('nama_paket' => $nama));
 			$sqlkode = $this->global_model->find_by('paket_kerja', array('kode_paket' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('paket_kerja', array('kode_paket' => $id));

 			if($kode == "" || $nama == "" || $waktu == "" || $harga == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','paket');
 			}else{
 				if($nama == $sql['nama_paket'] && $kode == $sql['kode_paket'] && $waktu == $sql['waktu'] && $harga == $sql['harga']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','paket');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_paket'] && $sqlkode != Null && $kode != $sql['kode_paket']){
	 					$this->message('alert','Informasi !','Kode dan Nama paket sudah ada','paket');
	 				}else if($sqlnama != Null && $nama != $sql['nama_paket']){
	 					$this->message('alert','Informasi !','Nama paket sudah ada','paket');
		 			}else if($sqlkode != Null && $kode != $sql['kode_paket']){
		 				$this->message('alert','Informasi !','Kode paket sudah ada','paket');
		 			}else {
		 				unset($data['ubahpaket']);
		 				$data['kode_paket'] = strtoupper($kode);
				 		$this->global_model->update('paket_kerja',$data, array('kode_paket' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','paket');
		 			}
	 			}
 			}

 			redirect(site_url('paket'));
 		}
 		
 	}

 }