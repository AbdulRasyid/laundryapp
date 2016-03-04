<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Daftar Barang
        <span class="place-right">
        <button class="tambahbutton button primary small-button" onclick="showDialog('dialogtambah')"><span class="mif-plus"></span></button>
        <button class="button danger small-button" onclick="showDialog('dialoghapus')"><span class="mif-bin"></span></button>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li><a href="#">Daftar Barang</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/barang/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                    </label>
                </td>
                <td>Kode Barang</td>
                <td>Nama Barang</td>
                <td>Kategori Barang</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($load as $barang) { 
            ?>  
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $barang['kode_barang'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td id="kode"><?php echo $barang['kode_barang'];?></td>
                <td><?php echo $barang['nama_barang'];?></td>
                <td>
                    <?php 
                        $kode = $barang['kode_kategori'];
                        $sql = $this->global_model->find_by('kategori_barang', array('kode_kategori' =>$kode));
                        echo $sql['nama_kategori'];
                    ?>
                </td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="<?php echo base_url();?>index.php/barang/tambah">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_barang" maxlength="3" id="kodetambah" style="text-transform:uppercase;">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama Barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_barang" id="namatambah">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Kategori Barang</label>
            <div>
                <select id="select" name="kode_kategori" class="js-select full-size">
                    <?php
                        foreach ($kategori as $kategoridata) { 
                    ?>
                    <option value="<?php echo $kategoridata['kode_kategori']?>"><?php echo $kategoridata['nama_kategori']?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanbarang" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" id="ubahform">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_barang" id="kodebarang" maxlength="3" style="text-transform:uppercase;">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama Barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_barang" id="namabarang">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Kategori Barang</label>
            <div>
                <select id="select5" name="kode_kategori" class="js-select full-size">
                    <?php
                        foreach ($kategori as $kategoridata) {
                    ?>
                    <option value="<?php echo $kategoridata['kode_kategori']?>"><?php echo $kategoridata['nama_kategori']?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahbarang" value="Simpan" />
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
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "barang"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 500);";
        echo "});";
        echo "</script>";
    }
?>
<script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
            $(".editbutton").click(function(event){
                var record = $(this).parents('.record');
                
                $.getJSON('http://localhost/laundryapp/index.php/barang/tampildata/'+record.find('#kode').html(), function(data) {

                $('#kodebarang').val(data.kode_barang);
                $('#namabarang').val(data.nama_barang);
                $("#select5").select2("val", data.kode_kategori);
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/barang/ubah/" + record.find('#kode').html());

            });
                var dialog = $("#dialogubah").data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
            });
            $(".tambahbutton").click(function(event){
                $("#kodetambah").val('');
                $("#namatambah").val('');
            });

    });
</script>