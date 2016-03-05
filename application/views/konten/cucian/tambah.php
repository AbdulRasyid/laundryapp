<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Tambah Cucian
        <span class="mif-shopping-basket2 place-right">
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="<?php echo base_url();?>index.php/cucian">Cucian</a></li>
        <li><a href="#">Tambah data</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post">
    <div class="grid">
        <div class="row cells2">
            <div class="cell">
                <h5>Nama Pelanggan</h5>
                <div class="input-control text full-size">
                    <input type="text" name="nama_pelanggan" placeholder="Nama lengkap">
                </div>
            </div>
            <div class="cell">
                <h5>No telepon</h5>
                <div class="input-control text full-size">
                    <input type="text" name="no_telepon" placeholder="Nama lengkap">
                </div>
            </div>
        </div>
        <div class="row cells2">
            <div class="cell">
                <h5>Metode Pengiriman</h5>
                <select id="select" name="kode_layanan" class="js-select full-size">
                    <?php
                    foreach ($kirim as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_pengiriman']?>"><?php echo $data['nama_pengiriman']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="cell">
                <h5>Paket Kerja</h5>
                <select id="select2" name="kode_layanan" class="js-select full-size">
                    <?php
                    foreach ($paket as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_paket']?>"><?php echo $data['nama_paket']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <label>Alamat</label>
                <div class="input-control text full-size">
                    <input type="text" name="namalengkap" placeholder="Nama lengkap">
                </div>
            </div>
        </div>
    </div>
    <table class="table striped border bordered">
    <thead>
        <tr>
            <td>
                <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="0">
                        <span class="check"></span>
                </label>
            </td>
            <td>Nama Layanan</td>
            <td>Jenis Cucian</td>
            <td>Kategori Barang</td>
            <td>Nama barang</td>
            <td>Ukuran Barang</td>
            <td>Qty</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="0">
                        <span class="check"></span>
                </label>
            </td>
            <td>
            <div class="input-control full-size" data-role="select">
                <select name="kode_layanan">
                    <?php
                    foreach ($layanan as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_layanan']?>"><?php echo $data['nama_layanan']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control full-size" data-role="select">
                <select name="kode_jenis">
                    <?php
                    foreach ($jeniscucian as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_jenis']?>"><?php echo $data['nama_jenis']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control full-size" data-role="select">
                <select name="kode_kategori">
                    <?php
                    foreach ($kategori as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_kategori']?>"><?php echo $data['nama_kategori']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control full-size" data-role="select">
                <select name="kode_barang">
                    <?php
                    foreach ($barang as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_barang']?>"><?php echo $data['nama_barang']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control full-size" data-role="select">
                <select name="kode_ukuran">
                    <?php
                    foreach ($ukuran as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_ukuran']?>"><?php echo $data['nama_ukuran']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td style="width: 100px">
                <div class="input-control text full-size">
                    <input type="text" name="qty" placeholder="qty">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    </form>
</div>