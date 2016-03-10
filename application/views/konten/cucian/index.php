<div class="cell auto-size padding20 bg-white">
    <h1 class="text-light">Cucian
        <span class="place-right">
        <a class="mif-plus button primary small-button" href="<?php echo base_url();?>index.php/cucian/tambah"></a>
        <button class="button danger small-button" onclick="showDialog('dialoghapus')"><span class="mif-bin"></span></button>
        </span>
    </h1>
    <hr class="thin bg-grayLighter">
    <ul class="breadcrumbs2 small">
        <li><a href="<?php echo base_url();?>index.php/dashboard"><span class="icon mif-home"></span></a></li>
        <li><a href="<?php echo base_url();?>index.php/dashboard">Dashboard</a></li>
        <li><a href="#">Cucian</a></li>
    </ul>
    <hr class="thin bg-grayLighter">
    <form method="post" id="myform" action="<?php echo base_url(); ?>index.php/cucian/hapus">
    <table class="dataTable border bordered" data-role="datatable" data-auto-width="false">
        <thead>
            <tr>
                <td style="width: 20px">
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked = this.checked">
                        <span class="check"></span>
                    </label>
                </td>
                <td>Kode Resi</td>
                <td>Nama Pelanggan</td>
                <td>No Telepon</td>
                <td>Status</td>
                <td style="width: 20px">Opsi</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($load as $cucian) { 
            ?>
            <tr class="record">
                <td>
                    <label class="input-control checkbox small-check no-margin">
                        <input type="checkbox" name="check[]" value="<?php echo $cucian['kode_resi'];?>">
                        <span class="check"></span>
                    </label>
                </td>
                <td id="kode"><?php echo $cucian['kode_resi'];?></td>
                <td><?php echo $cucian['nama_pelanggan'];?></td>
                <td><?php echo $cucian['no_telepon'];?></td>
                <td>
                    <?php
                     $get = $cucian['status'];
                     $sql = $this->global_model->find_by('status_data', array('kode_status' => $get));
                     echo $sql['nama_status'];
                    ?>
                </td>
                <td><a href="<?php echo base_url(); ?>index.php/cucian/ubah/<?php echo $cucian['kode_resi'];?>" class="button small-button mif-pencil"></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
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
    if($this->session->flashdata('messagemode','messagecaption','messagetext','messageactive') && $this->session->flashdata('messageactive') == "cucian"){
        echo "<script>";
        echo "$(document).ready(function() {";
            echo "setTimeout(function(){";
                echo "$.Notify({type: '".$this->session->flashdata('messagemode')."', caption: '".$this->session->flashdata('messagecaption')."', content: '".$this->session->flashdata('messagetext')."'});";
            echo "}, 500);";
        echo "});";
        echo "</script>";
    }
?>