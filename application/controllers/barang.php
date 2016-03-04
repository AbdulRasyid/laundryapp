<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Barang extends CI_Controller {

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
 		$data['kategori'] = $this->global_model->find_all('kategori_barang');
 		$data['load'] = $this->global_model->find_all('barang');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/barang/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanbarang')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_barang');
 			$kode = $this->input->post('kode_barang');
 			$kategori = $this->input->post('kode_kategori');

 			$sqlnama = count($this->global_model->find_by('barang', array('nama_barang' => $nama)));
 			$sqlkode = count($this->global_model->find_by('barang', array('kode_barang' => $kode)));

 			if($kode == "" || $nama == "" || $kategori == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','barang');
 			}else{
 				if($sqlnama > 0 && $sqlkode > 0){
 					$this->message('alert','Informasi !','Kode dan Nama barang sudah ada','barang');
 				}else if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode barang sudah ada','barang');
 				}else if($sqlnama > 0) {
 					$this->message('alert','Informasi !','Nama barang sudah ada','barang');
 				}else{
 					unset($data['simpanbarang']);
 					$data['kode_barang'] = strtoupper($kode);
 					$this->global_model->create('barang',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','barang');	
 				}
 			}

 			redirect(site_url('barang'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('barang', array('kode_barang' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil dihapus','barang');
			
		}else if(empty($chkbox)){
			$this->message('info','Informasi !','Tidak ada data yang di hapus','barang');
		}

		redirect(site_url('barang'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahbarang')){

 			$data = $this->input->post();

 			$nama = $this->input->post('nama_barang');
 			$kode = $this->input->post('kode_barang');
 			$kategori = $this->input->post('kode_kategori');

 			$sqlnama = $this->global_model->find_by('barang', array('nama_barang' => $nama));
 			$sqlkode = $this->global_model->find_by('barang', array('kode_barang' => $kode));

 			//validasi
 			$sql = $this->global_model->find_by('barang', array('kode_barang' => $id));

 			if($nama == "" || $kode == "" || $kategori == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','barang');
 			}else{
 				if($nama == $sql['nama_barang'] && $kode == $sql['kode_barang'] && $kategori == $sql['kode_kategori']){
 					$this->message('info','Informasi !','Tidak ada perubahan yang terjadi','barang');
	 			}else{
	 				if($sqlnama != Null && $nama != $sql['nama_barang'] && $sqlkode != Null && $kode != $sql['kode_barang']){
	 					$this->message('alert','Informasi !','Kode dan Nama barang sudah ada','barang');
	 				}else if($sqlnama != Null && $nama != $sql['nama_barang']){
	 					$this->message('alert','Informasi !','Nama barang sudah ada','barang');
		 			}else if($sqlkode != Null && $kode != $sql['kode_barang']){
		 				$this->message('alert','Informasi !','Kode barang sudah ada','barang');
		 			}else {
		 				unset($data['ubahbarang']);
		 				$data['kode_barang'] = strtoupper($kode);
				 		$this->global_model->update('barang',$data, array('kode_barang' => $id));
				 		$this->message('success','Informasi !','Data berhasil di ubah','barang');
		 			}
	 			}
 			}

 			redirect(site_url('barang'));

 		}
 		
 	}

 	function tampildata($id){
 		$sql = $this->global_model->find_by('barang', array('kode_barang' => $id));

 		echo json_encode($sql);
 	}

 }