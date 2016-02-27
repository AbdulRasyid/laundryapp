<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <title>Laundry Apps | Login</title>

    <link href="<?php echo base_url();?>assets/css/metro.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/metro-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/metro-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/metro.js"></script>
 
    <style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>

    <script>
        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body class="bg-darkTeal">