<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Settingperusahaan extends CI_Controller {

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
 		if($this->input->post('savesetting')){

 			$dataprofile = $this->input->post();

 			$namaperusahaan = $this->input->post('namaperusahaan');

 			if($namaperusahaan == ""){
 				$this->message('alert','Informasi !','Nama perusahaan tidak boleh kosong','setting');
 			}else{
 				unset($dataprofile['savesetting']);
	 			$this->global_model->update('perusahaan',$dataprofile,array('id' => 1));

	 			$this->message('success','Informasi !','Data berhasil di ubah','setting');
 			}

 			redirect(site_url('settingperusahaan'));

 		}
 		$data['data'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/setting/index',$data); //konten web
 		$this->load->view('footer/dashboard');
 	}
 }