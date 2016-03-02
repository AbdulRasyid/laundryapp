<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light"><span class="mif-user">
        </span> Profile 
    </h1>
    <hr class="thin bg-grayLighter">
    <form enctype="multipart/form-data" method="post" action="">
        <div class="grid">
            <div class="row cells2">
                <div class="cell">
                    <label>Nama lengkap</label>
                    <div class="input-control text full-size">
                        <input type="text" name="namalengkap" placeholder="Nama lengkap" value="<?php echo $profile['namalengkap']; ?>">
                    </div>
                    <label>Nama pengguna</label>
                    <div class="input-control text full-size">
                        <input type="text" name="username" placeholder="Nama pengguna" value="<?php echo $profile['username']; ?>">
                    </div>
                    <label>Kata sandi</label>
                    <div class="input-control text full-size">
                        <input type="text" name="password" placeholder="Isi jika ingin mengganti kata sandi">
                    </div>
                    <label>Email</label>
                    <div class="input-control text full-size">
                        <input type="text" name="email" placeholder="Email" value="<?php echo $profile['email']; ?>">
                    </div>
                    <label>Tentang saya</label>
                    <div class="input-control textarea full-size">
                        <textarea name="tentang" placeholder="Tentang saya"><?php echo $profile['tentang']; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <input type="submit" class="button primary" name="saveprofile" value="Ubah Profile" />
            <input type="reset" class="button" value="batalkan" />
        </div>
    </form>
</div>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "profile"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 500);";
        echo "});";
        echo "</script>";
    }
?>