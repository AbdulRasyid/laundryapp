<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Login extends CI_Controller {

 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
 		$this->load->helper('url');
 		$this->load->library('session');
 	}

 	public function index()
 	{
 		if($this->input->post('login')){

 			$username = $this->input->post('username');
 			$password = $this->input->post('password');

 			$md5pass = md5($password);

 			$sql = $this->global_model->find_by('user', array('username' => $username, 'password' => $md5pass));

 			if($sql!=Null){
 				$sessiondata = array(
 					'namalengkap' => $sql['namalengkap'],
 					'namauser' => $sql['username'],
 					'emailuser' => $sql['email']);

 				$this->session->set_userdata($sessiondata);

 				redirect(site_url('dashboard'));
 			}else{
 				redirect(site_url('/'));
 			}

 		}
 		$this->load->view('head/login');
 		$this->load->view('konten/login/index'); //konten web
 		$this->load->view('footer/login');
 	}

 	public function logout(){
 		$this->session->sess_destroy();
 		redirect(site_url('/'));
 	}
 }