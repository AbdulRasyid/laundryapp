<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Daftar Barang
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
        <li><a href="#">Daftar Barang</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                </td>
                <td class="sortable-column sort-asc">Kode barang</td>
                <td class="sortable-column">Nama barang</td>
                <td class="sortable-column">Kategori</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                </td>
                <td>JS</td>
                <td>Jas</td>
                <td>Jas</td>
                <td><button class="button small-button" onclick="showDialog('dialogubah')"><span class="mif-pencil"></span></button></td>
            </tr>
        </tbody>
    </table>
    <div data-role="dialog" id="dialogtambah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="">
            <h1 class="text-light">Tambah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_metodekirim">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_metodekirim">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Kategori Barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_metodekirim">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="simpanmetodekirim" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialogubah" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <form method="post" action="">
            <h1 class="text-light">Ubah data</h1>
            <hr class="thin bg-grayLighter">
            <br />
            <label>Kode barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="kode_metodekirim">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Nama barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_metodekirim">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <label>Kategori barang</label>
            <div class="input-control text full-size" data-role="input">
                <input type="text" name="nama_metodekirim">
                <button class="button helper-button reveal"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions place-right">
                <input type="reset" class="button" value="Batalkan" />
                <input type="submit" class="button primary" name="ubahmetodekirim" value="Simpan" />
            </div>
        </form>
    </div>
    <div data-role="dialog" id="dialoghapus" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" data-width="auto" data-height="auto">
        <h1>Hapus data</h1>
        <hr class="thin bg-grayLighter">
        <p>
            Apa anda yakin ingin menghapus data ?
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>JS</td>
                    <td>Jas</td>
                    <td>Jas</td>
                </tr>
            </tbody>
        </table>
        <hr class="thin bg-grayLighter">
        <button class="button primary full-size"><span class="icon mif-bin"></span> Lakukan</button>
    </div>
</div>
