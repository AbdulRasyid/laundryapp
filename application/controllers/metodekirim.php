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

 			$check = count($this->global_model->find_by('pengiriman', array('nama_pengiriman' => $nama, 'kode_pengiriman' => $kode)));

 			if($check<1){
 				unset($data['simpanmetode']);
 				$this->global_model->create('pengiriman',$data);
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

		  redirect(site_url('metodekirim'));
			
		}else if(empty($chkbox)){
		   redirect(site_url('metodekirim'));
		}
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahmetode')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_pengiriman');
 			$kode = $this->input->post('kode_pengiriman');

 			$sqlnama = $this->global_model->find_by('pengiriman', array('nama_pengiriman' => $nama));
 			$sqlkode = $this->global_model->find_by('pengiriman', array('kode_pengiriman' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('pengiriman', array('kode_pengiriman' => $id));

 			if($nama == $sql['nama_pengiriman'] && $kode == $sql['kode_pengiriman']){
 				redirect(site_url('metodekirim'));
 			}else{
 				if($sqlnama != Null && $nama != $sql['nama_pengiriman'] && $sqlkode != Null && $kode != $sql['kode_pengiriman']){
 					redirect(site_url('metodekirim'));
 				}else if($sqlnama != Null && $nama != $sql['nama_pengiriman']){
 					redirect(site_url('metodekirim'));
	 			}else if($sqlkode != Null && $kode != $sql['kode_pengiriman']){
	 				redirect(site_url('metodekirim'));
	 			}else {
	 				unset($data['ubahmetode']);
			 		$this->global_model->update('pengiriman',$data, array('kode_pengiriman' => $id));
			 		redirect(site_url('metodekirim'));
	 			}
 			}

 		}
 		
 	}
 }