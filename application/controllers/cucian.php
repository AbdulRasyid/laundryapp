<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Cucian extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('pelanggan');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/cucian/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	public function tambah(){
 		$data['layanan'] = $this->global_model->find_all('layanan');
 		$data['barang'] = $this->global_model->find_all('barang');
 		$data['jeniscucian'] = $this->global_model->find_all('jenis_cucian');
 		$data['kategori'] = $this->global_model->find_all('kategori_barang');
 		$data['ukuran'] = $this->global_model->find_all('ukuran_benda');
 		$data['kirim'] = $this->global_model->find_all('pengiriman');
 		$data['paket'] = $this->global_model->find_all('paket_kerja');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/cucian/tambah', $data); //konten web
 		$this->load->view('footer/dashboard');	
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('pelanggan', array('kode_resi' => $chkbox[$i]));
		  	$this->global_model->delete('list_cucian', array('kode_resi' => $chkbox[$i]));
		  	$this->global_model->delete('pembayaran', array('kode_resi' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil di hapus','cucian');
			
		}else if(empty($chkbox)){
		   $this->message('info','Informasi !','Tidak ada data yang di hapus','cucian');
		}

		redirect(site_url('jeniscucian'));
 
 	}
 }