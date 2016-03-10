<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Dashboard extends CI_Controller {

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

 	public function index()
 	{
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/dashboard/index'); //konten web
 		$this->load->view('footer/dashboard');
 	}
 }