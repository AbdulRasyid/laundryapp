<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <title>Laundry App | <?php echo ucfirst($this->uri->segment(1)); ?></title>

    <link href="<?php echo base_url();?>assets/css/metro.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/metro-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/metro-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/metro-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/metro-schemes.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url();?>assets/js/metro.js"></script>
    <script src="<?php echo base_url();?>assets/js/prettify/run_prettify.js"></script>
    <script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
        }
        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }
    </style>
    <script>

        function showDialog(id){
            var dialog = $("#"+id).data('dialog');
            if (!dialog.element.data('opened')) {
                dialog.open();
            } else {
                dialog.close();
            }
        }

    </script>

    <script>
    $(function(){
        $("#select").select2();
        $("#select1").select2();
        $("#select2").select2();
        $("#select3").select2();
        $("#select4").select2();
        $("#select5").select2();
        $("#select6").select2();
        $("#select7").select2();
    });
    </script>
</head>
<body>
<header class="app-bar fixed-top" data-role="appbar">
        <a class="app-bar-element branding"><span class="mif-shopping-basket2"></span> LaundryApps</a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu small-dropdown">
            <li><a href="<?php echo base_url();?>index.php/dashboard"> Dashboard</a></li>
            <li>
                <a href="" class="dropdown-toggle">Master</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="<?php echo base_url();?>index.php/layanan">Daftar Layanan</a></li>
                    <li><a href="<?php echo base_url();?>index.php/metodekirim">Daftar Metode pengiriman</a></li>
                    <li><a href="<?php echo base_url();?>index.php/statusdata">Daftar Status</a></li>
                    <li><a href="<?php echo base_url();?>index.php/jeniscucian">Daftar Jenis cucian</a></li>
                    <li><a href="<?php echo base_url();?>index.php/ukuran">Daftar Ukuran</a></li>
                    <li><a href="<?php echo base_url();?>index.php/ukuranbenda">Daftar Ukuran benda</a></li>
                    <li><a href="<?php echo base_url();?>index.php/paket">Daftar Paket kerja</a></li>
                    <li><a href="<?php echo base_url();?>index.php/kategoribarang">Daftar Kategori barang</a></li>
                    <li><a href="<?php echo base_url();?>index.php/barang">Daftar Barang</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>index.php/rakitharga">Rakit Harga cucian</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url();?>index.php/cucian">Cucian</a></li>
            <li><a href="<?php echo base_url();?>index.php/pembayaran">Pembayaran</a></li>
            <li><a href="<?php echo base_url();?>index.php/status">Status</a></li>
            <li><a href="<?php echo base_url();?>index.php/user">Kelola Pengguna</a></li>
        </ul>

        <div class="app-bar-element place-right">
            <span class="dropdown-toggle"><span class="mif-user"></span> <?php echo $this->session->userdata('namalengkap');?></span>
            <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark" data-role="dropdown" data-no-close="true" style="width: 220px">
                <ul class="unstyled-list fg-dark">
                    <li><a href="<?php echo base_url();?>index.php/profile" class="fg-white1 fg-hover-yellow">Profile</a></li>
                    <li><a href="<?php echo base_url();?>index.php/login/logout" class="fg-white3 fg-hover-yellow">Logout</a></li>
                </ul>
            </div>
        </div>
</header>
<div class="page-content">
