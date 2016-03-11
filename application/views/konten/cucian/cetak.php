<div class="cell auto-size padding20 bg-white">
	<label><label style="font-weight:bold;font-size:15pt;"><span class="mif-shopping-basket2"></span> <?php echo $perusahaan['namaperusahaan']; ?></label>
		<span class="place-right">
		<label style="font-size:11pt;color:gray;">Date : 
			<?php
				date_default_timezone_set('Asia/Jakarta');
 				$date = date('m/d/Y H:i:s',time());

 				echo $date;
			?>
		</label>
		</span>
	</label>
	<hr class="thin bg-grayLighter">
	<div class="grid">
		<div class="row cells3">
			<div class="cell	">
				<h6>Dari : </h5>
				<h6><b><?php echo $perusahaan['namaperusahaan']; ?></b></h6>
				<h6><?php echo $perusahaan['alamat']; ?></h6>
				<h6>No Telepon : <?php echo $perusahaan['notelepon']; ?></h6>
				<h6>Email : <?php echo $perusahaan['email']; ?></h6>
			</div>
			<div class="cell">
				<h6>Untuk : </h5>
				<h6><b><?php echo $pelanggan['nama_pelanggan']; ?></b></h6>
				<h6><?php echo $pelanggan['alamat']; ?></h6>
				<h6>No Telepon : <?php echo $pelanggan['no_telepon']; ?></h6>
			</div>
			<div class="cell">
				<h6><b>#Kode Resi : <?php echo $pelanggan['kode_resi']; ?></b></h6>
				<h6>Tanggal Daftar : <?php echo $pelanggan['tanggal_daftar']; ?></h6>
				<h6>Jenis Pengiriman : 
				<?php 
					$get = $pelanggan['kode_pengiriman'];
					$sql = $this->global_model->find_by('pengiriman', array('kode_pengiriman' => $get));
					echo $sql['nama_pengiriman']; ?>
				</h6>
				<h6>Paket Kerja : 
				<?php 
					$get = $pelanggan['kode_paket'];
					$sql = $this->global_model->find_by('paket_kerja', array('kode_paket' => $get));
					echo $sql['nama_paket']; ?>
				</h6>
				<h6>Status Bayar : 
				<?php if($pembayaran['tanggal_bayar']==""){echo "Belum bayar"; }else{ echo "Sudah dibayar";} ?>
				</h6>
			</div>
		</div>
	</div>
<table class="table bordered border striped">
    <thead>
        <tr>
            <td style="width:20px;">No</td>
            <td>Nama Layanan</td>
            <td>Jenis Cucian</td>
            <td>Nama Barang</td>
            <td>Ukuran Barang</td>
            <td>Qty</td>
            <td>Harga satuan</td>
            <td>Total harga</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 0;
            foreach ($listitem as $list) {
            $no++;
        ?>  
        <tr>
            <td><?php echo $no;?></td>
            <td>
                <?php 
                    $get = $list['kode_layanan'];
                    $sql = $this->global_model->find_by('layanan', array('kode_layanan' => $get));
                    echo $sql['nama_layanan'];
                ?>
            </td>
            <td>
                <?php 
                    $get = $list['kode_jenis'];
                    $sql = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $get));
                    echo $sql['nama_jenis'];
                ?>
            </td>
            <td>
                <?php
                    $get = $list['kode_barang'];
                    $sql = $this->global_model->find_by('barang', array('kode_barang' => $get));
                    echo $sql['nama_barang'];
                ?>
            </td>
            <td>
                <?php
                    $get = $list['kode_ukuran'];
                    $sql = $this->global_model->find_by('ukuran_benda', array('kode_ukuran' => $get));
                    echo $sql['nama_ukuran'];
                ?>
            </td>
            <td><?php echo $list['qty']; ?></td>
            <td>Rp. 
            	<?php
            		$get1 = $list['kode_barang'];
                    $get2 = $list['kode_layanan'];
                    $get3 = $list['kode_jenis'];
                    $get4 = $list['kode_ukuran'];

                    $check = array(
                    	'kode_barang' => $get1,
                    	'kode_layanan' => $get2,
                    	'kode_jenis' => $get3,
                    	'kode_ukuran' => $get4);

                    $sql = $this->global_model->find_by('rakit_harga', $check);
                    echo $sql['harga'];
                ?>
            </td>
            <td>Rp. <?php echo $list['harga']; ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
<div class="grid">
		<div class="row cells2">
			<div class="cell">
				<h5>Biaya Tambahan</h5>
				<table class="table striped">
				    <tbody>
				        <tr>
				        	<td>Biaya Kirim</td>
				            <td>Rp. 
				            <?php 
								$get = $pelanggan['kode_pengiriman'];
								$sql = $this->global_model->find_by('pengiriman', array('kode_pengiriman' => $get));
								echo $sql['harga_kirim']; 
							?>
				            </td>
				        </tr>
				        <tr>
				        	<td>Biaya Paket</td>
				            <td>Rp. 
				            <?php 
								$get = $pelanggan['kode_paket'];
								$sql = $this->global_model->find_by('paket_kerja', array('kode_paket' => $get));
								echo $sql['harga']; 
							?>
							</td>
				        </tr>
				    </tbody>
				</table>
			</div>
			<div class="cell">
				<h5>Total Biaya</h5>
				<table class="table striped">
				    <tbody>
				        <tr>
				        	<td>Sub total</td>
				            <td class="place-right">Rp. 
				            <?php echo $total['jumlah']; ?>
				            </td>
				        </tr>
				        <tr>
				        	<td>Total</td>
				            <td class="place-right">Rp. 
				            <?php echo $pembayaran['harga_total']; ?>
				            </td>
				        </tr>
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>