<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Statusdata extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('status_data');
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/master/status/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanstatus')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_status');
 			$kode = $this->input->post('kode_status');

 			$sqlnama = count($this->global_model->find_by('status_data', array('nama_status' => $nama)));
 			$sqlkode = count($this->global_model->find_by('status_data', array('kode_status' => $kode)));

 			if($kode == "" | $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','statusdata');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Nama status sudah ada','statusdata');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode status sudah ada','statusdata');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama status sudah ada','statusdata');
 				}else{
 					unset($data['simpanstatus']);
 					$data['kode_status'] = strtoupper($kode);
 					$this->global_model->create('status_data',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','statusdata');	
 				}
 			}

 			redirect(site_url('statusdata'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('status_data', array('kode_status' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','statusdata');
			
		}else if(empty($chkbox)){
			$this->message('success','Informasi !','Data berhasil dihapus','statusdata');
		}

		redirect(site_url('statusdata'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahstatus')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_status');
 			$kode = $this->input->post('kode_status');
 			$setting = $this->input->post('default_input');

 			$semula = array('default_input' => 'no');

 			$sqlnama = $this->global_model->find_by('status_data', array('nama_status' => $nama));
 			$sqlkode = $this->global_model->find_by('status_data', array('kode_status' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('status_data', array('kode_status' => $id));

 			if($kode == "" || $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','statusdata');
 			}else{
 				if($nama == $sql['nama_status'] && $kode == $sql['kode_status'] && $setting == $sql['default_input']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','statusdata');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_status'] && $sqlkode != Null && $kode != $sql['kode_status']){
	 					$this->message('alert','Informasi !','Kode dan Nama status sudah ada','statusdata');
	 				}else if($sqlnama != Null && $nama != $sql['nama_status']){
	 					$this->message('alert','Informasi !','Nama status sudah ada','statusdata');
		 			}else if($sqlkode != Null && $kode != $sql['kode_status']){
		 				$this->message('alert','Informasi !','Kode status sudah ada','statusdata');
		 			}else {
		 				unset($data['ubahstatus']);
		 				$data['kode_status'] = strtoupper($kode);
		 				//ubah record di field default_input menjadi "no"
		 				$this->global_model->update('status_data',$semula);
		 				//baru di update berdasarkan id yang dipilih
				 		$this->global_model->update('status_data',$data, array('kode_status' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','statusdata');
		 			}
	 			}
 			}

 			redirect(site_url('statusdata'));
 		}
 		
 	}

 	function tampildata($id){
 		$sql = $this->global_model->find_by('status_data', array('kode_status' => $id));

 		echo json_encode($sql);
 	}


 }