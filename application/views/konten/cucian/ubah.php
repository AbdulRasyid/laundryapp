<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Ubah Cucian
        <span class="mif-shopping-basket2 place-right">
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="<?php echo base_url();?>index.php/cucian">Cucian</a></li>
        <li><a href="#">Ubah cucian</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" action="">
    <div class="grid">
        <div class="row cells2">
            <div class="cell">
                <label>Nama Pelanggan</label>
                <div class="input-control text full-size">
                    <input type="text" name="nama_pelanggan" placeholder="Nama pelanggan" value="<?php echo $pelanggan['nama_pelanggan']; ?>">
                </div>
            </div>
            <div class="cell">
                <label>No telepon</label>
                <div class="input-control text full-size">
                    <input type="text" name="no_telepon" value="<?php echo $pelanggan['no_telepon']; ?>" placeholder="No Telepon" onkeypress="return isNumberKey(event)">
                </div>
            </div>
        </div>
        <div class="row cells2">
            <div class="cell">
                <label>Metode Pengiriman</label>
                <select id="select" name="kode_pengiriman" class="js-select full-size">
                    <?php
                    foreach ($kirim as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_pengiriman']?>" <?php if($pelanggan['kode_pengiriman'] == $data['kode_pengiriman']) { echo "selected"; } ?> ><?php echo $data['nama_pengiriman']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="cell">
                <label>Paket Kerja</label>
                <select id="select2" name="kode_paket" class="js-select full-size">
                    <?php
                    foreach ($paket as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_paket']?>" <?php if($pelanggan['kode_paket'] == $data['kode_paket']) { echo "selected"; } ?> ><?php echo $data['nama_paket']?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <label>Alamat</label>
                <div class="input-control text full-size">
                    <input type="text" name="alamat" value="<?php echo $pelanggan['alamat']; ?>" placeholder="Alamat Rumah">
                </div>
            </div>
        </div>
    </div><br>

    <label>Data Item cucian sebelumnya</label>
    <table class="table border bordered">
        <thead>
            <tr>
                <td>Nama Layanan</td>
                <td>Jenis Cucian</td>
                <td>Nama barang</td>
                <td>Ukuran Barang</td>
                <td>Qty</td>
                <td style="width: 20px;">Opsi</td>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($listitem as $datacucian) { 
        ?>
            <tr>
                <td>
                    <?php
                        $get = $datacucian['kode_layanan'];
                        $sql = $this->global_model->find_by('layanan', array('kode_layanan' => $get));
                        echo $sql['nama_layanan'];
                    ?>
                </td>
                <td>
                    <?php
                        $get = $datacucian['kode_jenis'];
                        $sql = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $get));
                        echo $sql['nama_jenis'];
                    ?>
                </td>
                <td>
                    <?php
                        $get = $datacucian['kode_barang'];
                        $sql = $this->global_model->find_by('barang', array('kode_barang' => $get));
                        echo $sql['nama_barang'];
                    ?>
                </td>
                <td>
                    <?php
                        $get = $datacucian['kode_ukuran'];
                        $sql = $this->global_model->find_by('ukuran_benda', array('kode_ukuran' => $get));
                        echo $sql['nama_ukuran'];
                    ?>
                </td>
                <td><?php echo $datacucian['qty']; ?>
                </td>
                <td><a href="<?php echo base_url(); ?>index.php/cucian/hapuslist/<?php echo $datacucian['kode_resi'];?>-<?php echo $datacucian['id'];?>" class="button small-button mif-bin"></a></td>
            </tr>
        <?php }?>
        </tbody>
    </table><br>

    <label>List Item</label><br><br>
    <button type="button" class="button primary small-button" onclick="addRow('tablelist');"><span class="mif-plus"></span> Tambah Item</button>
    <button type="button" class="button danger small-button" onclick="deleteRow('tablelist');"><span class="mif-bin"></span> Hapus Item</button>
    <table id="tablelist" class="table border bordered">
        <thead>
        <tr>
            <td>
                <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                </label>
            </td>
            <td>Nama Layanan</td>
            <td>Jenis Cucian</td>
            <td>Nama barang</td>
            <td>Ukuran Barang</td>
            <td>Qty</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="checkbox" name="check[]" value="1"></td>
            <td>
            <div class="input-control select full-size">
                <select name="kode_layanan[]">
                    <?php
                    foreach ($layanan as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_layanan']?>"><?php echo $data['nama_layanan']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control select full-size">
                <select name="kode_jenis[]">
                    <?php
                    foreach ($jeniscucian as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_jenis']?>"><?php echo $data['nama_jenis']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control select full-size">
                <select name="kode_barang[]">
                    <?php
                    foreach ($barang as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_barang']?>"><?php echo $data['nama_barang']?></option>
                    <?php } ?>
                </select>
            </div>
            </td>
            <td>
            <div class="input-control select full-size">
                <select name="kode_ukuran[]">
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
                    <input type="text" name="qty[]" placeholder="qty" style="width: 100px" onkeypress="return isNumberKey(event)">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <hr class="thin bg-grayLighter">
    <div class="form-actions place-right">
        <input type="reset" class="button" value="Batalkan" />
        <input type="submit" class="button primary" name="ubahcucian" value="Simpan" />
        <br><br>
    </div>
    </form>
</div>
<script language="javascript">
        function addRow(tableID) {
          var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[1].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            newcell.childNodes[0].value = rowCount;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }


        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=1; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                row.cells[0].childNodes[0].value = i;
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 2) {
                        alert("Tidak bisa menghapus semua baris.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
 
    </script>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "ubahcucian"){
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