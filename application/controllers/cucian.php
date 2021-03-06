<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
 class Cucian extends CI_Controller {

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
 		$data['load'] = $this->global_model->find_all('pelanggan');
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/cucian/index', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	public function tambah(){
 		$savebutton = $this->input->post('simpancucian');

 		if($savebutton){

 			$namapelanggan = $this->input->post('nama_pelanggan');
 			$notelepon = $this->input->post('no_telepon');
 			$alamat = $this->input->post('alamat');

 			date_default_timezone_set('Asia/Jakarta');
 			$date = date('m/d/Y H:i:s',time());

 			$kode_resi = mt_rand(100000000,999999999);

 			$sqlstatus = $this->db->query("select *from status_data where default_input!='no'");

			$statusdata = $sqlstatus->row();

 			//data pelanggan
 			$inputpelanggan = array(
 				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
 				'no_telepon' => $this->input->post('no_telepon'),
 				'alamat' => $this->input->post('alamat'),
 				'status' => $statusdata->kode_status,
 				'tanggal_daftar' => $date,
 				'kode_pengiriman' => $this->input->post('kode_pengiriman'),
 				'kode_paket' => $this->input->post('kode_paket'),
 				'kode_resi' => $kode_resi);

 			//untuk list item
 			$check = $this->input->post('check');
 			$kodelayanan = $this->input->post('kode_layanan');
 			$kodejenis = $this->input->post('kode_jenis');
 			$kodebarang = $this->input->post('kode_barang');
 			$kodeukuran = $this->input->post('kode_ukuran');
 			$qty = $this->input->post('qty');


 			if($namapelanggan == "" || $notelepon == "" || $alamat == ""){
 				$this->message('alert','Informasi !','Nama, No telepon, dan Alamat pelanggan tidak boleh kosong','tambahcucian');
 			}else{
 				if(is_array($check)){

 					unset($savebutton);
	 				//simpan ke table pelanggan
	 				$this->global_model->create('pelanggan', $inputpelanggan);

	 				 //simpan ke table list item
					 for($i = 0; $i < count($check); $i++){
						$number[$i] = (int) $check[$i] - 1;
						
					 }
					 foreach($number as $nilai => $hasil){

					 	$cari = array(
					 		'kode_barang' => $kodebarang[$hasil],
	  						'kode_layanan' => $kodelayanan[$hasil],
	  						'kode_jenis' => $kodejenis[$hasil],
	  						'kode_ukuran' => $kodeukuran[$hasil]);

					 	$sql = $this->global_model->find_by('rakit_harga', $cari);

					 	$hargabiasa = (int) $sql['harga'];
					 	$totalharga = (int) $qty[$hasil] * $hargabiasa;

					 	$datadetail = array(
					 		'kode_resi' => $kode_resi,
	  						'kode_barang' => $kodebarang[$hasil],
	  						'kode_layanan' => $kodelayanan[$hasil],
	  						'kode_jenis' => $kodejenis[$hasil],
	  						'kode_ukuran' => $kodeukuran[$hasil],
	  						'qty' => $qty[$hasil],
	  						'harga' => $totalharga);
						
						$this->global_model->create('list_cucian',$datadetail);
					 }

					 //simpan ke pembayaran
					 $sqlquery = "select nama_pelanggan, sum(list_cucian.harga) as jumlah, paket_kerja.harga as ongkir_paket, 
				pengiriman.harga_kirim as ongkir_kirim from pelanggan inner join list_cucian on
				 pelanggan.kode_resi = list_cucian.kode_resi inner join paket_kerja on pelanggan.kode_paket = paket_kerja.kode_paket
				  inner join pengiriman on pelanggan.kode_pengiriman = pengiriman.kode_pengiriman where pelanggan.kode_resi ='$kode_resi' 
				  group by list_cucian.kode_resi";

					 $query = $this->db->query($sqlquery);

					$row = $query->row();

					$harganih = $row->jumlah;
					$ongkirpaket = $row->ongkir_paket;
					$ongkirkirim = $row->ongkir_kirim;
					$jadi = $harganih + $ongkirkirim + $ongkirpaket;

					 $pembayaran = array(
					 		'kode_resi' => $kode_resi,
	  						'harga_total' => (int) $jadi,
	  						'nama_pelanggan' => $namapelanggan);

					 $this->global_model->create('pembayaran',$pembayaran);

					 $this->message('success','Informasi !','Data berhasil di tambah','tambahcucian');
						
					}else if(empty($validasi)){
						$this->message('alert','Informasi !','List item tidak boleh kosong','tambahcucian');
					}



 			}

 			redirect(site_url('cucian/tambah'));

 		}

 		$data['layanan'] = $this->global_model->find_all('layanan');
 		$data['barang'] = $this->global_model->find_all('barang');
 		$data['jeniscucian'] = $this->global_model->find_all('jenis_cucian'); 		
 		$data['ukuran'] = $this->global_model->find_all('ukuran_benda');
 		$data['kirim'] = $this->global_model->find_all('pengiriman');
 		$data['paket'] = $this->global_model->find_all('paket_kerja');
 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/cucian/tambah', $data); //konten web
 		$this->load->view('footer/dashboard');	
 	}

 	public function ubah($id){
 		$savebutton = $this->input->post('ubahcucian');
 		if($savebutton){

 			$namapelanggan = $this->input->post('nama_pelanggan');
 			$notelepon = $this->input->post('no_telepon');
 			$alamat = $this->input->post('alamat');

 			date_default_timezone_set('Asia/Jakarta');
 			$date = date('m/d/Y H:i:s',time());

 			//data pelanggan
 			$inputpelanggan = array(
 				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
 				'no_telepon' => $this->input->post('no_telepon'),
 				'alamat' => $this->input->post('alamat'),
 				'tanggal_daftar' => $date,
 				'kode_pengiriman' => $this->input->post('kode_pengiriman'),
 				'kode_paket' => $this->input->post('kode_paket'));

 			//untuk list item
 			$check = $this->input->post('check');
 			$kodelayanan = $this->input->post('kode_layanan');
 			$kodejenis = $this->input->post('kode_jenis');
 			$kodebarang = $this->input->post('kode_barang');
 			$kodeukuran = $this->input->post('kode_ukuran');
 			$qty = $this->input->post('qty');

 			if($namapelanggan == "" || $notelepon == "" || $alamat == ""){
 				$this->message('alert','Informasi !','Nama, No telepon, dan Alamat pelanggan tidak boleh kosong','ubahcucian');
 			}else{

 				unset($savebutton);
	 				//simpan ke table pelanggan
	 				$this->global_model->update('pelanggan', $inputpelanggan, array('kode_resi' => $id));


 				if(is_array($check)){

	 				 //simpan data baru ke table list item
					 for($i = 0; $i < count($check); $i++){
						$number[$i] = (int) $check[$i] - 1;
						
					 }
					 foreach($number as $nilai => $hasil){

					 	$cari = array(
					 		'kode_barang' => $kodebarang[$hasil],
	  						'kode_layanan' => $kodelayanan[$hasil],
	  						'kode_jenis' => $kodejenis[$hasil],
	  						'kode_ukuran' => $kodeukuran[$hasil]);

					 	$sql = $this->global_model->find_by('rakit_harga', $cari);

					 	$hargabiasa = (int) $sql['harga'];
					 	$totalharga = (int) $qty[$hasil] * $hargabiasa;

					 	$datadetail = array(
					 		'kode_resi' => $id,
	  						'kode_barang' => $kodebarang[$hasil],
	  						'kode_layanan' => $kodelayanan[$hasil],
	  						'kode_jenis' => $kodejenis[$hasil],
	  						'kode_ukuran' => $kodeukuran[$hasil],
	  						'qty' => $qty[$hasil],
	  						'harga' => $totalharga);
						
						$this->global_model->create('list_cucian',$datadetail);
					 }
						
				}

				//simpan ke pembayaran
				$sqlquery = "select nama_pelanggan, sum(list_cucian.harga) as jumlah, paket_kerja.harga as ongkir_paket, 
				pengiriman.harga_kirim as ongkir_kirim from pelanggan inner join list_cucian on
				 pelanggan.kode_resi = list_cucian.kode_resi inner join paket_kerja on pelanggan.kode_paket = paket_kerja.kode_paket
				  inner join pengiriman on pelanggan.kode_pengiriman = pengiriman.kode_pengiriman where pelanggan.kode_resi ='$id' 
				  group by list_cucian.kode_resi";

				$query = $this->db->query($sqlquery);

				$row = $query->row();

				$harganih = $row->jumlah;
				$ongkirpaket = $row->ongkir_paket;
				$ongkirkirim = $row->ongkir_kirim;
				$jadi = $harganih + $ongkirkirim + $ongkirpaket;

				$pembayaran = array(
			  		'harga_total' => (int) $jadi);

				//update total harga di table pembayaran berdasarkan kode resi
				$this->global_model->update('pembayaran',$pembayaran, array('kode_resi' => $id));

				$this->message('success','Informasi !','Data berhasil di ubah','ubahcucian');

 			}

 			redirect(site_url('cucian/ubah/'.$id));


 		}
 		$data['layanan'] = $this->global_model->find_all('layanan');
 		$data['barang'] = $this->global_model->find_all('barang');
 		$data['jeniscucian'] = $this->global_model->find_all('jenis_cucian'); 		
 		$data['ukuran'] = $this->global_model->find_all('ukuran_benda');
 		$data['kirim'] = $this->global_model->find_all('pengiriman');
 		$data['paket'] = $this->global_model->find_all('paket_kerja');
 		//load data pelanggan
 		$data['pelanggan'] = $this->global_model->find_by('pelanggan', array('kode_resi' => $id));
 		//load data list
 		$data['listitem'] = $this->global_model->find_all_by('list_cucian', array('kode_resi' => $id));

 		$setting['dataperusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));
 		$this->load->view('head/dashboard', $setting);
 		$this->load->view('konten/cucian/ubah', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}

 	function hapus()
 	{
 		$chkbox = $this->input->post('check');

 		if(is_array($chkbox)){
		  for($i = 0; $i < count($chkbox); $i++){

		  	$this->global_model->delete('pelanggan', array('kode_resi' => $chkbox[$i]));
		  	$this->global_model->delete('list_cucian', array('kode_resi' => $chkbox[$i]));
		  	$this->global_model->delete('pembayaran', array('kode_resi' => $chkbox[$i]));

		  }

		  $this->message('success','Informasi !','Data berhasil di hapus','cucian');
			
		}else if(empty($chkbox)){
		   $this->message('info','Informasi !','Tidak ada data yang di hapus','cucian');
		}

		redirect(site_url('cucian'));
 
 	}

 	function hapuslist($id){
 		$pisah = explode('-', $id);
 		$idhapus = $pisah[1];
 		$kode_resi = $pisah[0];

 		$this->global_model->delete('list_cucian', array('id' => $idhapus));

 		redirect(site_url('cucian/ubah/'.$kode_resi));
 	}

 	public function cetak($id){

 		//simpan ke pembayaran
		$sqlquery = "select sum(harga) as jumlah from list_cucian where kode_resi='$id' group by kode_resi";

		$query = $this->db->query($sqlquery);

		$row = $query->row();

 		$data['pelanggan'] = $this->global_model->find_by('pelanggan', array('kode_resi' => $id));
 		$data['pembayaran'] = $this->global_model->find_by('pembayaran', array('kode_resi' => $id));
 		$data['listitem'] = $this->global_model->find_all_by('list_cucian', array('kode_resi' => $id));
 		$data['perusahaan'] = $this->global_model->find_by('perusahaan', array('id' => 1));

 		$data['total'] = array('jumlah' => $row->jumlah);
 		$this->load->view('head/cetak');
 		$this->load->view('konten/cucian/cetak', $data); //konten web
 		$this->load->view('footer/dashboard');
 	}
 }