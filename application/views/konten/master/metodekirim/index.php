<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Daftar Metode pengiriman 
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
        <li><a href="#">Daftar Metode pengiriman</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/metodekirim/hapus">
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
                <td>Jenis Pengiriman</td>
                <td>Harga Kirim</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($load as $pengiriman) { 
            ?>  
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $pengiriman['kode_pengiriman'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td id="kode"><?php echo $pengiriman['kode_pengiriman'];?></td>
                <td><?php echo $pengiriman['nama_pengiriman'];?></td>
                <td>Rp. <?php echo $pengiriman['harga_kirim'];?></td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="<?php echo base_url();?>index.php/metodekirim/tambah">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Pengiriman</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_pengiriman" id="kodetambah" maxlength="3" style="text-transform:uppercase;">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Jenis Pengiriman</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_pengiriman" id="jenistambah">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Harga Kirim</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="harga_kirim" id="hargatambah" onkeypress="return isNumberKey(event)">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanmetode" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" id="ubahform">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Pengiriman</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_pengiriman" id="kodepengiriman" maxlength="3" style="text-transform:uppercase;">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Jenis Pengiriman</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_pengiriman" id="namapengiriman">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Harga Kirim</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="harga_kirim" id="hargakirim" onkeypress="return isNumberKey(event)">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahmetode" value="Simpan" />
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
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "metodekirim"){
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
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}    
</script>
<script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
            $(".editbutton").click(function(event){
                var record = $(this).parents('.record');
                
                $.getJSON('http://localhost/laundryapp/index.php/metodekirim/tampildata/'+record.find('#kode').html(), function(data) {

                $('#namapengiriman').val(data.nama_pengiriman);
                $('#hargakirim').val(data.harga_kirim);
                $('#kodepengiriman').val(data.kode_pengiriman);
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/metodekirim/ubah/" + record.find('#kode').html());

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
                $("#hargatambah").val('');
                $("#namatambah").val('');
            });

    });
</script>