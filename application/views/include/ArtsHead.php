<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ARTS</title>
    <link href="<?php echo base_url("/vendor/bootstrap/css/bootstrap.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("vendor/metisMenu/metisMenu.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("/dist/css/sb-admin-2.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("/vendor/font-awesome/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url("/dist/css/bootstrap-datepicker3.min.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("/vendor/bootstrap/css/custom.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("/dist/css/validation.css");?>" rel="stylesheet">
    <link href="<?php echo base_url("/dist/css/customNav.css");?>" rel="stylesheet">
    <script src="<?php echo base_url("/vendor/jquery/jquery-3.1.1.min.js");?>"></script>
    <script src="<?php echo base_url("/vendor/bootstrap/js/bootstrap.min.js");?>"></script>
    <script src="<?php echo base_url("/vendor/metisMenu/metisMenu.min.js");?>"></script>
    <script src="<?php echo base_url("/dist/js/sb-admin-2.js");?>"></script>
    <script src="<?php echo base_url("/vendor/jquery/jquery.bootstrap.wizard.min.js");?>"></script>
    <script src="<?php echo base_url("/vendor/bootstrap-datepicker.min.js");?>"></script>
    <script src="<?php echo base_url("/vendor/jquery.validate.min.js");?>"></script>
    <script src="<?php echo base_url("/vendor/jqBootstrapValidation.js");?>"></script>
    <style>
        .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
            color: #333 !important;
            background-color: rgba(179, 230, 106, 0.8) !important;
            border-color: #ddd !important;
        }
        .nav-pills>li.inactive>a:hover {
            background-color: inherit;
            color: #333;
            cursor: default;
            border: none;
        }
        .nav-pills>li.inactive>a:focus {
            background-color: inherit;
            color: #333;
            cursor: default;
            border: none;
        }
        a {
            color: inherit;
        }
        .fc-scroller {
            overflow-y: hidden !important;
        }
        label {
            margin-bottom: 10px;
        }
        .errorTxt{
            border: 1px solid red;
            min-height: 20px;
        }
    </style>
    <script>
        jQuery.extend(jQuery.validator.messages, {
            required: "*",
        });
    </script>
</head>