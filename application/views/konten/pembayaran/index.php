<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Pembayaran
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Pembayaran</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td>No.</td>
                <td>Kode Resi</td>
                <td>Nama Pelanggan</td>
                <td>Total Harga</td>
                <td>Tanggal bayar</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 0; foreach ($load as $data) { $no++; ?>
            <tr class="record">
                <td><?php echo $no;?></td>
                <td id="kode"><?php echo $data['kode_resi'];?></td>
                <td><?php echo $data['nama_pelanggan'];?></td>
                <td>Rp. <?php echo $data['harga_total'];?></td>
                <td><?php if($data['tanggal_bayar'] == ""){ echo "Belum Bayar";}else{echo $data['tanggal_bayar'];}?></td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" id="ubahform">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <div class="grid">
                <div class="row cells2">
                    <div class="cell">
                        <h5>Kode Resi</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="kode_resi" id="koderesi" disabled>
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Nama Pelanggan</h5>
                        <div class="input-control text full-size" data-role="input">
                            <input type="text" name="nama_pelanggan" id="namapelanggan" disabled>
                            <button class="button helper-button clear"><span class="mif-cross"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Total Harga</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="harga_total" id="totalharga" disabled>
                        </div>
                    </div>
                    <div class="cell">
                        <h5>User Bayar</h5>
                        <div class="input-control text full-size" data-role="input">
                            <input type="text" name="user_bayar" id="userbayar" onkeyup="hasil()" onkeypress="return isNumberKey(event)">
                            <button class="button helper-button clear"><span class="mif-cross"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="cell">
                        <h5>Uang Kembali</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="uang_kembali" id="uangkembali" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahpembayaran" value="Simpan" />
            </div>
        </form>
    </div>
</div>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "pembayaran"){
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
function hasil(){
    var bayar = $("#userbayar").val();
    var total = $("#totalharga").val();

    var hasil = bayar - total;

    $("#uangkembali").val(hasil);
}
</script>
<script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
            $(".editbutton").click(function(event){
                $("#uangkembali").val('');
                var record = $(this).parents('.record');
                
                $.getJSON('http://localhost/laundryapp/index.php/pembayaran/tampildata/'+record.find('#kode').html(), function(data) {

                $("#koderesi").val(data.kode_resi);
                $("#namapelanggan").val(data.nama_pelanggan);
                $("#totalharga").val(data.harga_total);
                $("#userbayar").val(data.user_bayar);
                $("#uangkembali").val(data.uang_kembali);
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/pembayaran/ubah/" + record.find('#kode').html());

            });
                var dialog = $("#dialogubah").data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
            });

    });
</script>