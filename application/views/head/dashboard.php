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
</head>
<body>
<header class="app-bar fixed-top" data-role="appbar">
    <div class="container">
        <a class="app-bar-element branding"><span class="mif-shopping-basket2"></span> LaundryApps</a>
        <span class="app-bar-divider"></span>
        <ul class="app-bar-menu">
            <li><a href="<?php echo base_url();?>index.php/dashboard"> Dashboard</a></li>
            <li>
                <a href="" class="dropdown-toggle">Master</a>
                <ul class="d-menu" data-role="dropdown">
                    <li><a href="<?php echo base_url();?>index.php/paket">Data Paket</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url();?>index.php/pelanggan">Pelanggan</a></li>
            <li><a href="<?php echo base_url();?>index.php/status">Status</a></li>
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
    </div>
</header>
<div class="container page-content">