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
 		if($this->input->post('saveprofile')){

 			$dataprofile = $this->input->post();
 			unset($dataprofile['saveprofile']);

 			$namalengkap = $this->input->post('namalengkap');
 			$username = $this->input->post('username');
 			$password = $this->input->post('password');
 			$password_word = $this->input->post('password');
 			$email = $this->input->post('email');
 			$tentang = $this->input->post('tentang');

 			$dataprofile = array(
 				'namalengkap' => $namalengkap,
 				'username' => $username,
 				'password' => $password,
 				'password_word' => $password_word,
 				'email' => $email,
 				'tentang' => $tentang);



 			if($namalengkap == "" && $username == ""){
 				$this->message('alert','Informasi !','Nama dan username tidak boleh kosong','profile');
 			}else{
 				if($this->input->post('password')==""){
 					unset($dataprofile['password']);
 					unset($dataprofile['password_word']);
	 			}else{
	 				$dataprofile['password'] = md5($password);
	 			}

	 			$check = $this->global_model->find_by('user', array('username' => $this->session->userdata('username')));
	 			$getid = $check['id'];

	 			$this->global_model->update('user',$dataprofile,array('id' => $getid));

	 			//refresh
	 			$sql = $this->global_model->find_by('user', array('id' => $getid));

	 			$sessiondata = array(
	 					'namalengkap' => $sql['namalengkap'],
	 					'namauser' => $sql['username'],
	 					'emailuser' => $sql['email'],
	 					'status' => $sql['status']);

	 			$this->session->set_userdata($sessiondata);

	 			$this->message('success','Informasi !','Data berhasil di ubah','profile');
 			}

 			redirect(site_url('profile'));

 		}

 		$data['profile'] = $this->global_model->find_by('user',array('username' => $this->session->userdata('username')));
 		$this->load->view('head/dashboard');
 		$this->load->view('konten/profile/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}
 }