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

 	public function message($mode,$text,$active)
 	{
 		//generate message
 		$messagesession = array(
 			'messagemode' => $mode,
 			'messagetext' => $text,
 			'messageactive' => $active);
 		$this->session->set_flashdata($messagesession);
 	}

 	public function index()
 	{
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

 			$check = count($this->global_model->find_by('jenis_cucian', array('kode_jenis' => $kode,'nama_jenis' => $nama)));

 			if($check<1){
 				unset($data['simpanjeniscucian']);
 				$this->global_model->create('jenis_cucian',$data);
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

		  redirect(site_url('jeniscucian'));
			
		}else if(empty($chkbox)){
		   redirect(site_url('jeniscucian'));
		}
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahjeniscucian')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_jenis');
 			$kode = $this->input->post('kode_jenis');

 			$sqlnama = $this->global_model->find_by('jenis_cucian', array('nama_jenis' => $nama));
 			$sqlkode = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $id));

 			if($nama == $sql['nama_jenis'] && $kode == $sql['kode_jenis']){
 				redirect(site_url('jeniscucian'));
 			}else{
 				if($sqlnama != Null && $nama != $sql['nama_jenis'] && $sqlkode != Null && $kode != $sql['kode_jenis']){
 					redirect(site_url('jeniscucian'));
 				}else if($sqlnama != Null && $nama != $sql['nama_jenis']){
 					redirect(site_url('jeniscucian'));
	 			}else if($sqlkode != Null && $kode != $sql['kode_jenis']){
	 				redirect(site_url('jeniscucian'));
	 			}else {
	 				unset($data['ubahjeniscucian']);
			 		$this->global_model->update('jenis_cucian',$data, array('kode_jenis' => $id));
			 		redirect(site_url('jeniscucian'));
	 			}
 			}

 		}
 		
 	}


 }