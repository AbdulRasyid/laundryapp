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
                <label>Nama Pelanggan</label>
                <div class="input-control text full-size">
                    <input type="text" name="nama_pelanggan" placeholder="Nama lengkap">
                </div>
            </div>
            <div class="cell">
                <label>No telepon</label>
                <div class="input-control text full-size">
                    <input type="text" name="no_telepon" placeholder="Nama lengkap">
                </div>
            </div>
        </div>
        <div class="row cells2">
            <div class="cell">
                <label>Metode Pengiriman</label>
                <select id="select" name="kode_layanan" class="js-select full-size">
                    <?php
                    foreach ($kirim as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_pengiriman']?>"><?php echo $data['nama_pengiriman']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="cell">
                <label>Paket Kerja</label>
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
            <td>Kategori Barang</td>
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
                <select name="kode_kategori[]">
                    <?php
                    foreach ($kategori as $data) { 
                    ?>
                    <option value="<?php echo $data['kode_kategori']?>"><?php echo $data['nama_kategori']?></option>
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
                    <input type="text" name="qty[]" placeholder="qty">
                </div>
            </td>
        </tr>
        </tbody>
    </table>
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
                        alert("Cannot delete all the rows.");
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
