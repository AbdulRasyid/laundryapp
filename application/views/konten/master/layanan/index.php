<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Daftar Layanan 
        <span class="place-right">
	    <button class="button primary small-button" onclick="showDialog('dialogtambah')"><span class="mif-plus"></span></button>
	    <button class="button warning small-button" ><span class="mif-loop2"></span></button>
	    <button class="button danger small-button" onclick="showDialog('dialoghapus')"><span class="mif-bin"></span></button>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li><a href="#">Daftar Layanan</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                </td>
                <td class="sortable-column sort-asc" style="width: 200px;">Kode Layanan</td>
                <td class="sortable-column">Nama Layanan</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 0;
            foreach ($load as $layanan) { 
                $no++;
            ?>
            <tr class="btnDelete" data-id="<?php echo $layanan['kode_layanan'];?>">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $no;?>" >
                        <span class="check"></span>
                    </label>
                </td>
                <td><?php echo $layanan['kode_layanan'];?></td>
                <td><?php echo $layanan['nama_layanan'];?></td>
                <td><button class="btnDelete button small-button" href="" onclick="showDialog('dialogubah')"><span class="mif-pencil"></span></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="<?php echo base_url();?>index.php/layanan/tambah">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode layanan</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_layanan">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama layanan</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_layanan">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanlayanan" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode layanan</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_layanan">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama layanan</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_layanan">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahlayanan" value="Simpan" />
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
        <div class="grid">
            <div class="row cells2">
                <div class="cell">
                    <button class="button full-size"><span class="icon mif-not"></span> Tidak</button>
                </div>
                <div class="cell">
                    <button class="button primary full-size"><span class="icon mif-bin"></span> Lakukan</button>
                </div>
            </div>
        </div>
    </div>
</div>
