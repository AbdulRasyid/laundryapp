<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Status Cucian 
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Status Cucian</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/layanan/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td>Kode Resi</td>
                <td>Nama Pelanggan</td>
                <td>Banyak Item</td>
                <td>Status</td>
                <td style="width:110px;">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($load as $status) { 
            ?>  
            <tr class="record">
                <td id="kode"><?php echo $status['kode_resi'];?></td>
                <td><?php echo $status['nama_pelanggan'];?></td>
                <td><?php echo $status['banyak_item'];?> item</td>
                <td>
                    <?php
                     $get = $status['status'];
                     $sql = $this->global_model->find_by('status_data', array('kode_status' => $get));
                     echo $sql['nama_status'];
                    ?>
                </td>
                <td class="text-center">
                <button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button>
                <button type="button" class="viewbutton  button small-button"><span class="mif-eye"></span></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" id="ubahform">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode Resi</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_resi" id="koderesi" disabled>
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama pelanggan</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_pelanggan" id="namapelanggan" disabled>
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Status</label>
            <div>
            <select id="select" name="status" class="js-select full-size">
                <?php
                foreach ($statusdata as $data) { 
                ?>
                <option value="<?php echo $data['kode_status'];?>"><?php echo $data['nama_status'];?></option>
                <?php } ?>
            </select>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahlayanan" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogview" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">        
            <h1 class="text-light">View Item</h1>
            <hr class="thin bg-grayLighter">
            <div id="tampildata">
            </div>
    </div>
</div>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "status"){
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
                
                $.getJSON('http://localhost/laundryapp/index.php/status/tampiluserdata/'+record.find('#kode').html(), function(data) {

                $("#koderesi").val(data.kode_resi);
                $("#namapelanggan").val(data.nama_pelanggan);
                $("#select").select2("val", data.status);
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/status/ubah/" + record.find('#kode').html());

                });
                var dialog = $("#dialogubah").data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
            });

            $(".viewbutton").click(function(event){
                var record = $(this).parents('.record');
                 $('#tampildata').load('http://localhost/laundryapp/index.php/status/tampildata/'+record.find('#kode').html());
               var dialog = $("#dialogview").data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                } 
            });

    });
</script>