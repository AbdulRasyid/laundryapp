<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Status extends CI_Controller {

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
 		$data['load'] = $this->global_model->query("select pelanggan.kode_resi,pelanggan.nama_pelanggan,pelanggan.status, count(list_cucian.kode_resi) as banyak_item, pelanggan.status from pelanggan inner join list_cucian on pelanggan.kode_resi = list_cucian.kode_resi");
 		$data['statusdata'] = $this->global_model->find_all('status_data');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/status/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	public function ubah($id){
 		$status = array('status' => $this->input->post('status'));

 		$this->global_model->update('pelanggan', $status, array('kode_resi' => $id));

 		$this->message('success','Informasi !','Data berhasil di ubah','status');

 		redirect(site_url('status'));

 	}

 	public function tampildata($id){

 		$data['load'] = $this->global_model->find_all_by('list_cucian', array('kode_resi' => $id));
 		$this->load->view('konten/status/listcucian', $data); //konten web
 	}

 	function tampiluserdata($id){
 		$sql = $this->global_model->find_by('pelanggan', array('kode_resi' => $id));

 		echo json_encode($sql);
 	}

 }