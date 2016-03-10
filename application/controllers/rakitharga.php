<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Rakitharga extends CI_Controller {

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
 		$data['layanan'] = $this->global_model->find_all('layanan');
 		$data['jeniscucian'] = $this->global_model->find_all('jenis_cucian');
 		$data['ukuran'] = $this->global_model->find_all('ukuran_benda');
 		$data['barang'] = $this->global_model->find_all('barang');
 		$data['load'] = $this->global_model->find_all('rakit_harga');
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/rakitharga/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function tambah(){

 		if($this->input->post('simpanrakit')){

 			$data = $this->input->post();

 			$kode = $this->input->post('kode_rakit');
 			$harga = $this->input->post('harga');

 			$sqlkode = count($this->global_model->find_by('rakit_harga', array('kode_rakit' => $kode)));

 			if($kode == "" || $harga == ""){
 				$this->message('alert','Informasi !','Data tidak boleh kosong','rakitharga');
 			}else{
 				if($sqlkode > 0){
 					$this->message('alert','Informasi !','Kode rakit sudah ada','rakitharga');
 				}else{
 					unset($data['simpanrakit']);
 					$this->global_model->create('rakit_harga',$data);
	 				$this->message('success','Informasi !','Data berhasil ditambahkan','rakitharga');	
 				}
 			}

 			redirect(site_url('rakitharga'));

 		}
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('rakit_harga', array('kode_rakit' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil di hapus','rakitharga');
			
		}else if(empty($chkbox)){
		   $this->message('info','Informasi !','Tidak ada data yang di hapus','rakitharga');
		}

		redirect(site_url('rakitharga'));
 
 	}

 	function ubah($id){

 		if($this->input->post('ubahrakit')){
 			$data = $this->input->post();

 			$namalayanan = $this->input->post('nama_layanan');
 			$namabarang = $this->input->post('nama_barang');
 			$jeniscucian = $this->input->post('jenis_cucian');
 			$ukuranbarang = $this->input->post('ukuran_barang');
 			$koderakit = $this->input->post('kode_rakit');
 			$hargarakit = $this->input->post('harga');

 			$sql = $this->global_model->find_by('rakit_harga', array('kode_rakit' => $koderakit));

 			if($namalayanan == "" || $namabarang == "" || $jeniscucian == "" || $ukuranbarang == ""
 				|| $koderakit == "" || $hargarakit == ""){

 				$this->message('alert','Informasi !','Data tidak boleh kosong','rakitharga');
 			}else{
 				if($sql != Null && $koderakit != $sql['kode_rakit']){
 					$this->message('alert','Informasi !','Kode Rakit sudah ada','rakitharga');
 				}else{
 					unset($data['ubahrakit']);
 					$this->global_model->update('rakit_harga',$data, array('kode_rakit' => $id));
				 	$this->message('success','Informasi !','Data berhasil di ubah','rakitharga');
 				}

 			}

 			redirect(site_url('rakitharga'));
 		}
 	}

 	function ajaxgenerate($id){

 		/*generate kode barang*/

 		//get kode layanan
 		$data = $this->global_model->find_by('layanan', array('kode_layanan' => $id));
 		$kodelayanan = $data['kode_layanan'];
 		//check kode layanan di table barang
 		$checklayanan = $this->global_model->query("select kode_rakit from rakit_harga where kode_rakit LIKE '$kodelayanan%' order by kode_rakit desc");
 		if ($checklayanan != null){
 			//jika kode layanan ada maka check kode barang terakhir
 			//ambil sample kode rakit terakhir
 			//pisahkan kodelayanan dan number 			
 			$pisah = explode('-', $checklayanan[0]['kode_rakit']);
 			
 			$number =  (int) $pisah[1];
 			$digit = intval($number) + 1;
 			if ($digit >= 1 and $digit <= 9){
				echo $kodelayanan."-00".$digit; 				
 			}else if($digit >= 10 and $digit <= 99){
 				echo $kodelayanan."-0".$digit;
 			}else{
 				echo $kodelayanan."-".$digit; 				
 			}
 		}else{
 			//jika kode unit tidak ada maka buat kode barang default
 			$kodedefault = "001";
 			echo $kodelayanan."-".$kodedefault;
 		}

 	}

 	function tampildata($id){
 		$sql = $this->global_model->find_by('rakit_harga', array('kode_rakit' => $id));

 		echo json_encode($sql);
 	}


 }