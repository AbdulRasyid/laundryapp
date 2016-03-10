<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Kelola pengguna
        <span class="place-right">
        <button class="tambahbutton button primary small-button" onclick="showDialog('dialogtambah')"><span class="mif-plus"></span></button>
        <button class="button danger small-button" onclick="showDialog('dialoghapus')"><span class="mif-bin"></span></button>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">kelola pengguna</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/user/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                    </label>
                </td>
                <td>Nama lengkap</td>
                <td>Nama pengguna</td>
                <td>Email</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($load as $user) { 
            ?>  
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $user['username'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td><?php echo $user['namalengkap'];?></td>
                <td id="pengguna"><?php echo $user['username'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><button type="button" class="editbutton button small-button"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="<?php echo base_url();?>index.php/user/tambah">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <div class="grid">
                <div class="row cells2">
                    <div class="cell">
                        <h5>Nama lengkap</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="namalengkap" id="namatambah">
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Nama pengguna</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="username" id="usertambah">
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Kata sandi</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="password" id="sanditambah">
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Email</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="email" id="emailtambah">
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Tentang</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="tentang" id="tentangtambah">
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Status</h5>
                        <select id="select3" name="status" class="js-select full-size">
                            <option value="OP">Operator</option>
                            <option value="KS">Kasir</option>
                            <option value="PC">Pencuci</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanuser" value="Simpan" />
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
                        <h5>Nama lengkap</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="namalengkap" id="namalengkap">
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Nama pengguna</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="username" id="username">
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Kata sandi</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="password" id="password">
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Email</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="email" id="email">
                        </div>
                    </div>
                </div>
                <div class="row cells2">
                    <div class="cell">
                        <h5>Tentang</h5>
                        <div class="input-control text full-size">
                            <input type="text" name="tentang" id="tentang">
                        </div>
                    </div>
                    <div class="cell">
                        <h5>Status</h5>
                        <select id="select4" name="status" class="js-select full-size">
                            <option value="OP">Operator</option>
                            <option value="KS">Kasir</option>
                            <option value="PC">Pencuci</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahuser" value="Simpan" />
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
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "user"){
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
                
                $.getJSON('http://localhost/laundryapp/index.php/user/tampildata/'+record.find('#pengguna').html(), function(data) {

                $('#namalengkap').val(data.namalengkap);
                $('#username').val(data.username);
                $('#password').val(data.password_word);
                $('#email').val(data.email);
                $('#tentang').val(data.tentang);
                $("#select4").select2("val", data.status);
                $("#ubahform").attr("action", "<?php echo base_url(); ?>index.php/user/ubah/" + record.find('#pengguna').html());

            });
                var dialog = $("#dialogubah").data('dialog');
                if (!dialog.element.data('opened')) {
                    dialog.open();
                } else {
                    dialog.close();
                }
            });
            $(".tambahbutton").click(function(event){
                $("#namatambah").val('');
                $("#usertambah").val('');
                $("#sanditambah").val('');
                $("#emailtambah").val('');
                $("#tentangtambah").val('');
            });

    });
</script>