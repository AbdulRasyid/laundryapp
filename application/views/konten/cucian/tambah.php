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
    <form>
    <div class="grid">
        <div class="row cells2">
            <div class="cell">
                <h5>Nama Pengguna</h5>
                <div class="input-control text full-size">
                    <input type="text" name="namalengkap" placeholder="Nama lengkap">
                </div>
                <h5>No telepon</h5>
                <div class="input-control text full-size">
                    <input type="text" name="namalengkap" placeholder="Nama lengkap">
                </div>
                <h5>Alamat</h5>
                <div class="input-control text full-size">
                    <input type="text" name="namalengkap" placeholder="Nama lengkap">
                </div>
                <h5>Metode Pengiriman</h5>
                <div>
                <select id="select" name="kode_layanan" class="js-select full-size">
                    <?php
                    foreach ($kirim as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_pengiriman']?>"><?php echo $data['nama_pengiriman']?></option>
                    <?php } ?>
                </select>
                </div>
                <h5>Paket Kerja</h5>
                <div>
                <select id="select2" name="kode_layanan" class="js-select full-size">
                    <?php
                    foreach ($paket as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_paket']?>"><?php echo $data['nama_paket']?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>