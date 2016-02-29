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

 			$check = count($this->global_model->find_by('paket_kerja', array('nama_paket' => $nama, 'kode_paket' => $kode)));

 			if($check<1){
 				unset($data['simpanpaket']);
 				$this->global_model->create('paket_kerja',$data);
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

		  redirect(site_url('paket'));
			
		}else if(empty($chkbox)){
		   redirect(site_url('paket'));
		}
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahpaket')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_paket');
 			$kode = $this->input->post('kode_paket');

 			$sqlnama = $this->global_model->find_by('paket_kerja', array('nama_paket' => $nama));
 			$sqlkode = $this->global_model->find_by('paket_kerja', array('kode_paket' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('paket_kerja', array('kode_paket' => $id));

 			if($nama == $sql['nama_paket'] && $kode == $sql['kode_paket']){
 				redirect(site_url('paket'));
 			}else{
 				if($sqlnama != Null && $nama != $sql['nama_paket'] && $sqlkode != Null && $kode != $sql['kode_paket']){
 					redirect(site_url('paket'));
 				}else if($sqlnama != Null && $nama != $sql['nama_paket']){
 					redirect(site_url('paket'));
	 			}else if($sqlkode != Null && $kode != $sql['kode_paket']){
	 				redirect(site_url('paket'));
	 			}else {
	 				unset($data['ubahpaket']);
			 		$this->global_model->update('paket_kerja',$data, array('kode_paket' => $id));
			 		redirect(site_url('paket'));
	 			}
 			}

 		}
 		
 	}

 }