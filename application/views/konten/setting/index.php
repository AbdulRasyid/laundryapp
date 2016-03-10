<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light"><span class="mif-user">
        </span> Setting Perusahaan 
    </h1>
    <hr class="thin bg-grayLighter">
    <form enctype="multipart/form-data" method="post" action="">
        <div class="grid">
            <div class="row cells2">
                <div class="cell">
                    <label>Nama perusahaan</label>
                    <div class="input-control text full-size">
                        <input type="text" name="namaperusahaan" placeholder="Nama perusahaan" value="<?php echo $data['namaperusahaan'];?>">
                    </div>
                    <label>No Telepon</label>
                    <div class="input-control text full-size">
                        <input type="text" name="notelepon" placeholder="No Telepon" value="<?php echo $data['notelepon'];?>">
                    </div>
                    <label>Email</label>
                    <div class="input-control text full-size">
                        <input type="text" name="email" placeholder="Email" value="<?php echo $data['email'];?>">
                    </div>
                    <label>Alamat</label>
                    <div class="input-control text full-size">
                        <input type="text" name="alamat" placeholder="Alamat" value="<?php echo $data['alamat'];?>">
                    </div>
                    <label>Deskripsi</label>
                    <div class="input-control textarea full-size">
                        <textarea name="deskripsi" placeholder="Tentang perusahaan"><?php echo $data['deskripsi'];?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" class="button primary" name="savesetting" value="Ubah profile perusahaan" />
            <input type="reset" class="button" value="batalkan" />
        </div>
    </form>
</div>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "setting"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 500);";
        echo "});";
        echo "</script>";
    }
?>