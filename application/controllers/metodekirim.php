<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Metodekirim extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('pengiriman');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/metodekirim/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanmetode')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_pengiriman');
 			$kode = $this->input->post('kode_pengiriman');
 			$harga = $this->input->post('harga_kirim');

 			$sqlnama = count($this->global_model->find_by('pengiriman', array('nama_pengiriman' => $nama)));
 			$sqlkode = count($this->global_model->find_by('pengiriman', array('kode_pengiriman' => $kode)));

 			if($kode == "" || $nama == "" || $harga == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','metodekirim');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Jenis pengiriman sudah ada','metodekirim');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode pengiriman sudah ada', 'metodekirim');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Jenis pengiriman sudah ada','metodekirim');
 				}else{
 					unset($data['simpanmetode']);
 					$data['kode_pengiriman'] = strtoupper($kode);
 					$this->global_model->create('pengiriman',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','metodekirim');	
 				}
 			}

 			redirect(site_url('metodekirim'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('pengiriman', array('kode_pengiriman' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','metodekirim');
			
		}else if(empty($chkbox)){
			$this->message('info','Informasi !','Tidak ada data yang di hapus','metodekirim');
		}

		redirect(site_url('metodekirim'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahmetode')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_pengiriman');
 			$kode = $this->input->post('kode_pengiriman');
 			$harga = $this->input->post('harga_kirim');

 			$sqlnama = $this->global_model->find_by('pengiriman', array('nama_pengiriman' => $nama));
 			$sqlkode = $this->global_model->find_by('pengiriman', array('kode_pengiriman' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('pengiriman', array('kode_pengiriman' => $id));

 			if($kode == "" || $nama =="" || $harga == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','metodekirim');
 			}else{
	 			if($nama == $sql['nama_pengiriman'] && $kode == $sql['kode_pengiriman'] && $harga == $sql['harga_kirim']){
	 				$this->message('info','Informasi !','Tidak ada perubahan','metodekirim');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_pengiriman'] && $sqlkode != Null && $kode != $sql['kode_pengiriman']){
	 					$this->message('alert','Informasi !','Kode dan Jenis pengiriman sudah ada','metodekirim');
	 				}else if($sqlnama != Null && $nama != $sql['nama_pengiriman']){
	 					$this->message('alert','Informasi !','Jenis Pengiriman sudah ada','metodekirim');
		 			}else if($sqlkode != Null && $kode != $sql['kode_pengiriman']){
		 				$this->message('alert','Informasi !','Kode pengiriman sudah ada','metodekirim');
		 			}else {
		 				unset($data['ubahmetode']);
		 				$data['kode_pengiriman'] = strtoupper($kode);
				 		$this->global_model->update('pengiriman',$data, array('kode_pengiriman' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','metodekirim');
		 			}
	 			}

 			}

 			redirect(site_url('metodekirim'));

 		}
 		
 	}
 }