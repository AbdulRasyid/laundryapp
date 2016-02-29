<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Kategoribarang extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('kategori_barang');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/kategoribarang/index',$data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpankategori')){

 			$data = $this->input->post();

 			$kode = $this->input->post('kode_kategori');
 			$nama = $this->input->post('nama_kategori');

 			$check = count($this->global_model->find_by('kategori_barang', array('kode_kategori' => $kode, 'nama_kategori' => $nama)));

 			if($check<1){
 				unset($data['simpankategori']);
 				$this->global_model->create('kategori_barang',$data);
 			}

 			redirect(site_url('kategoribarang'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('kategori_barang', array('kode_kategori' => $chkbox[$i]));

		  }

		  redirect(site_url('kategoribarang'));
			
		}else if(empty($chkbox)){
		   redirect(site_url('kategoribarang'));
		}
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahkategori')){

 			$data = $this->input->post();

 			$kode = $this->input->post('kode_kategori');
 			$nama = $this->input->post('nama_kategori');

 			$sqlkode = $this->global_model->find_by('kategori_barang', array('kode_kategori' => $kode));
 			$sqlnama = $this->global_model->find_by('kategori_barang', array('nama_kategori' => $nama));

 			//validasi
 			$sql = $this->global_model->find_by('kategori_barang', array('kode_kategori' => $id));

 			if($kode == $sql['kode_kategori'] && $nama == $sql['nama_kategori']){
 				redirect(site_url('kategoribarang'));
 			}else{
 				if($sqlnama != Null && $nama != $sql['nama_kategori'] && $sqlkode != Null && $kode != $sql['kode_kategori']){
 					redirect(site_url('kategoribarang'));
 				}else if($sqlkode != Null && $kode != $sql['kode_kategori']){
 					redirect(site_url('kategoribarang'));
	 			}else if($sqlnama != Null && $nama != $sql['nama_kategori']){
	 				redirect(site_url('kategoribarang'));
	 			}else {
	 				unset($data['ubahkategori']);
			 		$this->global_model->update('kategori_barang',$data, array('kode_kategori' => $id));
			 		redirect(site_url('kategoribarang'));
	 			}
 			}

 		}
 		
 	}
 }