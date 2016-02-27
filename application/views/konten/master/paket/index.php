<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Data Paket 
        <span class="place-right">
            <a href="<?php echo base_url();?>index.php/paket/tambah"><span class="mif-plus button primary small-button"></span></a>
            <a href="<?php echo base_url();?>index.php/paket"><span class="mif-loop2 button warning small-button"></span></a>
            <a href="<?php echo base_url();?>index.php/paket"><span class="mif-bin button danger small-button"></span></a>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small   ">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Master</a></li>
        <li><a href="#">Data Paket</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                </td>
                <td class="sortable-column sort-asc" style="width: 100px">Kode Paket</td>
                <td class="sortable-column">Nama Paket</td>
                <td class="sortable-column">Waktu Pengerjaan</td>
                <td class="sortable-column" style="width: 20px">Harga</td>
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
                <td>123890723212</td>
                <td>Machine number 1</td>
                <td><a href="http://virtuals.com/machines/123890723212">link</a></td>
                <td class="align-center"><span class="mif-checkmark fg-green"></span></td>
                <td>
                    <label class="switch-original">
                        <input type="checkbox" checked>
                        <span class="check"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                </td>
                <td>123890723212</td>
                <td>Machine number 2</td>
                <td><a href="http://virtuals.com/machines/123890723212">link</a></td>
                <td class="align-center"><span class="mif-stop fg-red"></span></td>
                <td>
                    <label class="switch-original">
                        <input type="checkbox">
                        <span class="check"></span>
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>