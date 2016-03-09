<table class="table bordered border">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Layanan</td>
            <td>Jenis Cucian</td>
            <td>Nama Barang</td>
            <td>Ukuran Barang</td>
            <td>Qty</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 0;
            foreach ($load as $list) {
            $no++;
        ?>  
        <tr>
            <td><?php echo $no;?></td>
            <td>
                <?php 
                    $get = $list['kode_layanan'];
                    $sql = $this->global_model->find_by('layanan', array('kode_layanan' => $get));
                    echo $sql['nama_layanan'];
                ?>
            </td>
            <td>
                <?php 
                    $get = $list['kode_jenis'];
                    $sql = $this->global_model->find_by('jenis_cucian', array('kode_jenis' => $get));
                    echo $sql['nama_jenis'];
                ?>
            </td>
            <td>
                <?php
                    $get = $list['kode_barang'];
                    $sql = $this->global_model->find_by('barang', array('kode_barang' => $get));
                    echo $sql['nama_barang'];
                ?>
            </td>
            <td>
                <?php
                    $get = $list['kode_ukuran'];
                    $sql = $this->global_model->find_by('ukuran_benda', array('kode_ukuran' => $get));
                    echo $sql['nama_ukuran'];
                ?>
            </td>
            <td><?php echo $list['qty']; ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>