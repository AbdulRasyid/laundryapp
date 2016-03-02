<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Daftar Jenis Cucian
        <span class="place-right">
        <button class="button primary small-button" onclick="showDialog('dialogtambah')"><span class="mif-plus"></span></button>
        <button class="button danger small-button" onclick="showDialog('dialoghapus')"><span class="mif-bin"></span></button>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li><a href="#">Daftar Jenis Cucian</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/jeniscucian/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                    </label>
                </td>
                <td>Kode</td>
                <td>Nama Jenis</td>
                <td>Ukuran</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($load as $jeniscucian) { 
            ?>  
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $jeniscucian['kode_jenis'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td id="kode"><?php echo $jeniscucian['kode_jenis'];?></td>
                <td id="nama"><?php echo $jeniscucian['nama_jenis'];?></td>
                <td id="ukuran">
                <?php
                    $kode = $jeniscucian['kode_ukuran'];
                    $sql = $this->global_model->find_by('ukuran', array('kode_ukuran' =>$kode));
                    echo $sql['nama_ukuran'];
                ?>

                </td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="<?php echo base_url();?>index.php/jeniscucian/tambah">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Jenis</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_jenis" maxlength="3" style="text-transform:uppercase;">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama Jenis</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_jenis">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Ukuran</label>
            <div>
                <select id="select" name="kode_ukuran" class="js-select full-size">
                    <?php
                        foreach ($ukuran as $loadukuran) { 
                    ?>
                    <option value="<?php echo $loadukuran['kode_ukuran']?>"><?php echo $loadukuran['nama_ukuran']?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanjeniscucian" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" id="ubahform">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Jenis</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_jenis" id="kodejenis" maxlength="3" style="text-transform:uppercase;">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama Jenis</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_jenis" id="namajenis">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Ukuran</label>
            <div class="input-control select full-size">
                <select name="kode_ukuran" class="full-size">
                    <option id="ds"></option>
                    <?php
                        foreach ($ukuran as $loadukuran) {
                    ?>
                    <option value="<?php echo $loadukuran['kode_ukuran']?>"><?php echo $loadukuran['nama_ukuran']?></option>
                    <?php } ?>
                </select>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahjeniscucian" value="Simpan" />
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
<script type="text/javascript">
         $(document).ready(function() {
            var s = document.getElementById('editbutton');
             $(".editbutton").click(function() {
                //set which record we're editing so we can update it later
                var record = $(this).parents('.record');
                //populate the editing form within the dialog
                $('#namajenis').val(record.find('#nama').html());
                $("#ds").text(record.find('#ukuran').html() + " (default)");
                $('#ds').val('default');
                $('#kodejenis').val(record.find('#kode').html());
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/jeniscucian/ubah/" + record.find('#kode').html());
                //show dialog
                var dialog = $("#dialogubah").data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
             });


         });
</script>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "jeniscucian"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 500);";
        echo "});";
        echo "</script>";
    }
?>