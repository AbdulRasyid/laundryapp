<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Jeniscucian extends CI_Controller {

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
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/master/jeniscucian/index'); //konten web
 		$this->load->view('footer/dashboard');
 	}
 }