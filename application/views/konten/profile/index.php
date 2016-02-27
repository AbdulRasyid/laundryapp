<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Profile 
        <span class="mif-user place-right">
        </span>
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
                <div class="cell bg-grayLighter padding10">
                    <div class="row cells4">
                        <div class="cell colspan">
                            <div style="width: 100%;" class="image-container bordered image-format-square">
                                <div class="frame">
                                    <div style="width: 100%; height: 103px; background-image: url('<?php echo base_url();?>assets/images/user.png'); background-size: cover; background-repeat: no-repeat; border-radius: 0px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="cell colspan3 no-padding-top no-padding-bottom">
                           <p class="text-secondary">
                            Anda bisa mengganti foto profile user dengan format gambar seperti .jpg dan .png
                            </p>
                            <div class="input-control file full-size" data-role="input">
                                <input type="file" name="foto">
                                <button class="button"><span class="mif-folder"></span></button>
                            </div>
                            <p class="text-secondary">
                            maksimum ukuran file adalah 100 kb
                            </p>
                        </div>
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