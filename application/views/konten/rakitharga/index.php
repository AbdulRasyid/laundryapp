<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Rakit Harga
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
        <li><a href="#">Rakit Harga</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/rakitharga/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                    </label>
                </td>
                <td>Kode Rakit</td>
                <td>Nama Layanan</td>
                <td>Jenis Cucian</td>
                <td>Nama Barang</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($load as $data) { ?>
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $data['kode_rakit'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td id="kode"><?php echo $data['kode_rakit'];?></td>
                <td id="nama">
                <?php 
                    $kode = $data['nama_layanan'];
                    $sql = $this->global_model->find_by('layanan',array('kode_layanan' => $kode));
                    echo $sql['nama_layanan'];
                ?>
                </td>
                <td>
                <?php 
                    $kode = $data['jenis_cucian'];
                    $sql = $this->global_model->find_by('jenis_cucian',array('kode_jenis' => $kode));
                    echo $sql['nama_jenis'];
                ?>
                </td>
                <td>
                <?php 
                    $kode = $data['nama_barang'];
                    $sql = $this->global_model->find_by('barang',array('kode_barang' => $kode));
                    echo $sql['nama_barang'];
                ?>
                </td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php }?>
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
                        <h5>Nama layanan</h5>
                        <select id="select" name="nama_layanan" class="js-select full-size" onChange="showKodeRakit(this.value)">
                                <?php
                                    foreach ($layanan as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_layanan']?>"><?php echo $data['nama_layanan']?></option>
                                <?php } ?>
                        </select>
                        
                    </div>
                    <div class="cell">
                        <h5>Nama barang</h5>
                        <select id="select1" name="nama_barang" class="js-select full-size">
                                <?php
                                    foreach ($barang as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_barang']?>"><?php echo $data['nama_barang']?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Jenis cucian</h5>
                        <select id="select2" name="jenis_cucian" class="js-select full-size">
                                <?php
                                    foreach ($jeniscucian as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_jenis']?>"><?php echo $data['nama_jenis']?></option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="cell">
                        <h5>Ukuran barang</h5>
                        <select id="select3" name="ukuran_barang" class="js-select full-size">
                                <?php
                                    foreach ($ukuran as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_ukuran']?>"><?php echo $data['nama_ukuran']?></option>
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Kode Rakit</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="kode_rakit" id="txtHint" readonly>
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Harga</h5>
                        <div class="input-control text full-size" data-role="input">
                            <input type="text" name="harga" id="kodepaket" onkeypress="return isNumberKey(event)">
                            <button class="button helper-button clear"><span class="mif-cross"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanrakit" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" id="ubahform">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <div class="grid">
                <div class="row cells2">
                    <div class="cell">
                        <label>Nama Layanan</label>
                        <div>
                            <select id="select" name="nama_layanan" class="js-select full-size">
                                <?php
                                    foreach ($layanan as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_layanan']?>"><?php echo $data['nama_layanan']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="cell">
                        <label>Nama barang</label>
                        <div class="input-control text full-size" data-role="input">
                            <input type="text" name="nama_barang" id="kodepaket">
                            <button class="button helper-button clear"><span class="mif-cross"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <label>Kode rakit</label>
                        <div class="input-control text full-size">
                            <input type="text" name="kode_rakit" id="kodepaket" readonly>
                        </div>
                    </div>
                    <div class="cell">
                        <label>Ukuran barang</label>
                        <div>
                            <select id="select1" name="ukuran_barang" class="js-select full-size">
                                <?php
                                    foreach ($ukuran as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_ukuran']?>"><?php echo $data['nama_ukuran']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <label>Jenis Cucian</label>
                        <div>
                            <select id="select2" name="jenis_cucian" class="js-select full-size">
                                <?php
                                    foreach ($jeniscucian as $data) { 
                                ?>
                                <option value="<?php echo $data['kode_jenis']?>"><?php echo $data['nama_jenis']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="cell">
                        <label>Harga</label>
                        <div class="input-control text full-size" data-role="input">
                            <input type="text" name="harga" id="kodepaket" onkeypress="return isNumberKey(event)">
                            <button class="button helper-button clear"><span class="mif-cross"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahrakit" value="Simpan" />
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
                $('#namapaket').val(record.find('#nama').html());
                $('#kodepaket').val(record.find('#kode').html());
                $('#waktupaket').val(record.find('#waktu').html());
                $('#hargapaket').val(record.find('#harga').html());
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/rakitharga/ubah/" + record.find('#kode').html());
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
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "rakitharga"){
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
<script type="text/javascript">
      function showKodeRakit(str) {
        var xhttp;    
        if (str == "") {
          document.getElementById("txtHint").innerHTML = "";
          return;
        }
        var url="http://localhost/laundryapp/index.php/rakitharga/ajaxgenerate/"
        url=url+str
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("txtHint").innerHTML = xhttp.responseText
            document.getElementById("txtHint").value = xhttp.responseText
          }
        };
        xhttp.open("GET",url, true);
        xhttp.send(null);
      }

</script>