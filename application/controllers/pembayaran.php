<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Pembayaran extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('pembayaran');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/pembayaran/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function ubah($id){
 		$button = $this->input->post('ubahpembayaran');
 		if($button){
 			$date = date("Y-m-d H:i:s",strtotime($date));
 			$data = array(
 				'kode_resi' => $this->input->post('kode_resi'),
 				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
 				'harga_total' => $this->input->post('harga_total'),
 				'user_bayar' => $this->input->post('user_bayar'),
 				'uang_kembali' => $this->input->post('uang_kembali'),
 				'tanggal_bayar' => $date);
 			
 			unset($button);

 			$this->global_model->update('pembayaran', $data, array('kode_resi' => $id));

 			$this->message('success','Informasi !','Data berhasil di ubah','pembayaran');

 			redirect(site_url('pembayaran'));
 		}
 	}


 	function tampildata($id){
 		$sql = $this->global_model->find_by('pembayaran', array('kode_resi' => $id));

 		echo json_encode($sql);
 	}
 }