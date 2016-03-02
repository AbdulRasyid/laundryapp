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

 			$sqlkode = count($this->global_model->find_by('kategori_barang', array('kode_kategori' => $kode)));
 			$sqlnama = count($this->global_model->find_by('kategori_barang', array('nama_kategori' => $nama)));

 			if($kode == "" | $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','kategoribarang');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Nama kategori sudah ada','kategoribarang');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode kategori sudah ada','kategoribarang');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama kategori sudah ada','kategoribarang');
 				}else{
 					unset($data['simpankategori']);
 					$data['kode_kategori'] = strtoupper($kode);
 					$this->global_model->create('kategori_barang',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','kategoribarang');	
 				}
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

		  $this->message('success','Informasi !','Data berhasil dihapus','kategoribarang');
			
		}else if(empty($chkbox)){
			$this->message('info','Informasi !','Tidak ada data yang di hapus','kategoribarang');
		}
		redirect(site_url('kategoribarang'));
 
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

 			if($kode == "" || $nama == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','kategoribarang');
 			}else{
 				if($kode == $sql['kode_kategori'] && $nama == $sql['nama_kategori']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','kategoribarang');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_kategori'] && $sqlkode != Null && $kode != $sql['kode_kategori']){
	 					$this->message('alert','Informasi !','Kode dan Nama kategori sudah ada','kategoribarang');
	 				}else if($sqlkode != Null && $kode != $sql['kode_kategori']){
	 					$this->message('alert','Informasi !','Kode kategori sudah ada','kategoribarang');
		 			}else if($sqlnama != Null && $nama != $sql['nama_kategori']){
		 				$this->message('alert','Informasi !','Nama kategori sudah ada','kategoribarang');
		 			}else {
		 				unset($data['ubahkategori']);
		 				$data['kode_kategori'] = strtoupper($kode);
				 		$this->global_model->update('kategori_barang',$data, array('kode_kategori' => $id));
				 		//update ke table yang relasi
					 	$get = strtoupper($kode);
					 	$data2 = array('kode_kategori' => $get);
					 	$this->global_model->update('barang',$data2, array('kode_kategori' => $id));
					 	
				 		$this->message('success','Informasi !','Data berhasil di ubah','kategoribarang');
		 			}
	 			}

 			}

 			redirect(site_url('kategoribarang'));

 		}
 		
 	}
 }