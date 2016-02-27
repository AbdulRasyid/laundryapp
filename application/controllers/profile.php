<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Profile extends CI_Controller {

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
 		if($this->input->post('saveprofile')){

 			$dataprofile = $this->input->post();
 			unset($dataprofile['saveprofile']);

 			if($this->input->post('password')==""){
 				unset($dataprofile['password']);

 			}else{
 				$dataprofile['password'] = md5($this->input->post('password'));
 			}

 			$check = $this->global_model->find_by('user', array('username' => $this->session->userdata('username')));
 			$getid = $check['id'];

 			$this->global_model->update('user',$dataprofile,array('id' => $getid));

 			//refresh
 			$sql = $this->global_model->find_by('user', array('id' => $getid));

 			$sessiondata = array(
 					'namalengkap' => $sql['namalengkap'],
 					'namauser' => $sql['username'],
 					'emailuser' => $sql['email']);

 			$this->session->set_userdata($sessiondata);

 			redirect(site_url('profile'));

 		}

 		$data['profile'] = $this->global_model->find_by('user',array('username' => $this->session->userdata('username')));
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/profile/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}
 }