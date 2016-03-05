<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Cucian
        <span class="place-right">
        <button class="tambahbutton button primary small-button" onclick="showDialog('dialogtambah')"><span class="mif-plus"></span></button>
        <button class="button danger small-button" onclick="showDialog('dialoghapus')"><span class="mif-bin"></span></button>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Cucian</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/cucian/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                    </label>
                </td>
                <td>Kode Resi</td>
                <td>Nama Pelanggan</td>
                <td>No Telepon</td>
                <td>Status</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($load as $cucian) { 
            ?>  
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $cucian['kode_resi'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td id="kode"><?php echo $cucian['kode_resi'];?></td>
                <td><?php echo $cucian['nama_pelanggan'];?></td>
                <td><?php echo $cucian['no_telepon'];?> Hari</td>
                <td><?php echo $cucian['status'];?></td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="<?php echo base_url();?>index.php/rakitharga/tambah">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <div class="grid">
                <div class="row cells2">
                    <div class="cell">
                        <div class="row cells2">
                            <div class="cell">
                                <h5>Nama pelanggan</h5>
                                <div class="input-control text full-size">
                                    <input type="text" name="kode_rakit" id="txtHint" readonly>
                                </div>
                                
                            </div>
                            <div class="cell">
                                <h5>Nomor Telepon</h5>
                                <div class="input-control text full-size">
                                    <input type="text" name="kode_rakit" id="txtHint" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <h5>Alamat Rumah</h5>
                                <div class="input-control text full-size">
                                    <input type="text" name="kode_rakit" id="txtHint" readonly>
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
                                <select id="select1" name="kode_layanan" class="js-select full-size">
                                        <?php
                                            foreach ($paket as $data) { 
                                        ?>
                                        <option value="<?php echo $data['kode_paket']?>"><?php echo $data['nama_paket']?></option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Paket Kerja</h5>
                                <select id="select1" name="kode_layanan" class="js-select full-size">
                                        <?php
                                            foreach ($paket as $data) { 
                                        ?>
                                        <option value="<?php echo $data['kode_paket']?>"><?php echo $data['nama_paket']?></option>
                                        <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr class="thin bg-grayLighter">
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanrakit" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialoghapus" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <h1>Hapus data</h1>
        <hr class="thin bg-grayLighter">
        <p>
            Apa anda yakin ingin menghapus data ?
        </p>
        <hr class="thin bg-grayLighter">
        <button type="submit" form="myform" class="button danger full-size" ><span class="icon mif-bin"></span> Lakukan</button>
    </div>
</div>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "cucian"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 500);";
        echo "});";
        echo "</script>";
    }
?>
<script>