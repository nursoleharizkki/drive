<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $setting[0]->setting_appname; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo base_url(); ?>assets/core-images/<?php echo $setting[0]->setting_logo; ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/core-admin/core-component/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/core-admin/core-component/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/core-admin/core-component/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/core-admin/core-dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css?family=Anton|Permanent+Marker|Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400&display=swap" rel="stylesheet">
    <style type="text/css">
        .form-control {
            height: 46px !important
        }

        .form-control-feedback {
            line-height: 46px !important
        }
    </style>
</head>

<body class="hold-transition login-page fontPoppins" style="background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url(<?php echo base_url(); ?>assets/core-images/<?php echo $setting[0]->setting_background; ?>)">
    <div class="login-box">
        <div class="login-logo">
            <a href="" style="color:#fff !important"><?php echo $setting[0]->setting_appname; ?></a>
        </div>

        <div class="login-box-body">

            <p class="login-box-msg"><?php echo $setting[0]->setting_short_appname; ?></p>
            <?php
            if ($this->session->flashdata('alert')) {
                echo $this->session->flashdata('alert');
                unset($_SESSION['alert']);
            }
            ?>
            <!-- Start Form Login -->
            <?php echo form_open("auth/validate", "class='login-form'"); ?>
            <div class="form-group has-feedback">
                <?php echo csrf(); ?>
                <input type="text" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-facebook btn-block">Log In</button>
                </div>
            </div>
            <?php echo form_close(); ?>
            <br>
            <!-- End Form Login -->

            <p class="text-center">
                <?php echo $setting[0]->setting_owner_name; ?>
                <b>Since @<?php echo date('Y'); ?></b>
            </p>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/core-admin/core-component/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/core-admin/core-component/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>