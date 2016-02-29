<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Layanan extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('layanan');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/layanan/index',$data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanlayanan')){

 			$data = $this->input->post();

 			$kode = $this->input->post('kode_layanan');
 			$nama = $this->input->post('nama_layanan');

 			$sqlkode = count($this->global_model->find_by('layanan', array('kode_layanan' => $kode)));
 			$sqlnama = count($this->global_model->find_by('layanan', array('nama_layanan' => $nama)));

 			if($kode == "" | $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','layanan');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Nama layanan sudah ada','layanan');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode layanan sudah ada','layanan');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama layanan sudah ada','layanan');
 				}else{
 					unset($data['simpanlayanan']);
 					$data['kode_layanan'] = strtoupper($kode);
	 				$this->global_model->create('layanan',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','layanan');	
 				}
 			}

 			redirect(site_url('layanan'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('layanan', array('kode_layanan' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','layanan');
			
		}else if(empty($chkbox)){
			$this->message('info','Informasi !','Tidak ada data yang di hapus','layanan');
		}

		redirect(site_url('layanan'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahlayanan')){

 			$data = $this->input->post();

 			$kode = $this->input->post('kode_layanan');
 			$nama = $this->input->post('nama_layanan');

 			$sqlkode = $this->global_model->find_by('layanan', array('kode_layanan' => $kode));
 			$sqlnama = $this->global_model->find_by('layanan', array('nama_layanan' => $nama));

 			//validasi
 			$sql = $this->global_model->find_by('layanan', array('kode_layanan' => $id));

 			if($kode == "" || $nama ==""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','layanan');
 			}else{
 				if($kode == $sql['kode_layanan'] && $nama == $sql['nama_layanan']){
	 				$this->message('info','Informasi !','Tidak ada perubahan','layanan');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_layanan'] && $sqlkode != Null && $kode != $sql['kode_layanan']){
	 					$this->message('alert','Informasi !','Kode dan Nama layanan sudah ada','layanan');
	 				}else if($sqlkode != Null && $kode != $sql['kode_layanan']){
	 					$this->message('alert','Informasi !','Kode layanan sudah ada','layanan');
		 			}else if($sqlnama != Null && $nama != $sql['nama_layanan']){
		 				$this->message('alert','Informasi !','Nama layanan sudah ada','layanan');
		 			}else {
		 				unset($data['ubahlayanan']);
		 				$data['kode_layanan'] = strtoupper($kode);
				 		$this->global_model->update('layanan',$data, array('kode_layanan' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','layanan');
		 			}
	 			}
 			}

 			redirect(site_url('layanan'));

 		}
 		
 	}


 }