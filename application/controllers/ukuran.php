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
 		$data['load'] = $this->global_model->find_all('ukuran');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/ukuran/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanukuran')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_ukuran');
 			$kode = $this->input->post('kode_ukuran');

 			$check = count($this->global_model->find_by('ukuran', array('nama_ukuran' => $nama, 'kode_ukuran' => $kode)));

 			if($check<1){
 				unset($data['simpanukuran']);
 				$this->global_model->create('ukuran',$data);
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

		  redirect(site_url('ukuran'));
			
		}else if(empty($chkbox)){
		   redirect(site_url('ukuran'));
		}
 
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

 			if($nama == $sql['nama_ukuran'] && $kode == $sql['kode_ukuran']){
 				redirect(site_url('ukuran'));
 			}else{
 				if($sqlnama != Null && $nama != $sql['nama_ukuran'] && $sqlkode != Null && $kode != $sql['kode_ukuran']){
 					redirect(site_url('ukuran'));
 				}else if($sqlnama != Null && $nama != $sql['nama_ukuran']){
 					redirect(site_url('ukuran'));
	 			}else if($sqlkode != Null && $kode != $sql['kode_ukuran']){
	 				redirect(site_url('ukuran'));
	 			}else {
	 				unset($data['ubahukuran']);
			 		$this->global_model->update('ukuran',$data, array('kode_ukuran' => $id));
			 		redirect(site_url('ukuran'));
	 			}
 			}

 		}
 		
 	}
 }