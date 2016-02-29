<div class="login-form padding20 block-shadow">
        <form method="post" action="">
            <h1 class="text-light">Please Login</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label for="user_login">Nama pengguna :</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="username">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label for="user_password">Kata sandi:</label>
            <div class="input-control password full-size" data-role="input">
                <input type="password" name="password">
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="login" value="Masuk" />
            </div>
        </form>
</div>
<?php 
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "login"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 1000);";
        echo "});";
        echo "</script>";
    }
?>