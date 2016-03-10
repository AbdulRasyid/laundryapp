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
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/pembayaran/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function ubah($id){
 		$button = $this->input->post('ubahpembayaran');
 		if($button){
 			date_default_timezone_set('Asia/Jakarta');
 			$date = date('m/d/Y H:i:s',time());
 			$data = array(
 				'user_bayar' => $this->input->post('user_bayar'),
 				'uang_kembali' => $this->input->post('uang_kembali'),
 				'tanggal_bayar' => $date);

 			$updatepelanggan = array(
 				'tanggal_ambil' => $date);
 			
 			unset($button);

 			$this->global_model->update('pembayaran', $data, array('kode_resi' => $id));

 			$this->global_model->update('pelanggan', $updatepelanggan, array('kode_resi' => $id));


 			$this->message('success','Informasi !','Data berhasil di ubah','pembayaran');

 			redirect(site_url('pembayaran'));
 		}
 	}


 	function tampildata($id){
 		$sql = $this->global_model->find_by('pembayaran', array('kode_resi' => $id));

 		echo json_encode($sql);
 	}
 }