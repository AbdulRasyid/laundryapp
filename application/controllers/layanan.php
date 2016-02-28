<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Layanan extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('layanan');
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/layanan/index',$data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanlayanan')){

 			$data = $this->input->post();

 			$kode = $this->input->post('kode_layanan');
 			$nama = $this->input->post('nama_layanan');

 			$check = count($this->global_model->find_by('layanan', array('kode_layanan' => $kode, 'nama_layanan' => $nama)));

 			if($check<1){
 				unset($data['simpanlayanan']);
 				$this->global_model->create('layanan',$data);
 			}

 			redirect(site_url('layanan'));

 		}
 	}
 }