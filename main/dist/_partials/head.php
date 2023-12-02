<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="dist/img/web-icon.png" type="image/x-icon">
    <link rel="icon" href="dist/img/web-icon.png" sizes="32x32">
    <title>MMS - <?php echo $head; ?></title>
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- <link rel="stylesheet" href="plugins/bootstrap-5.0.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="plugins/bootstrap-select/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/datatable/custom_dt_html5.css">
    <link rel="stylesheet" href="plugins/bootstrap-show-password-toggle/css/show-password-toggle.min.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="dist/css/All.css">

    <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.css">

    <link rel="stylesheet" href="plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

    <script src="dist/js/swal.js" nonce=""></script>
    <script src="plugins/moment/moment.min.js" nonce=""></script>
    <script src="dist/js/get-time.js" defer nonce=""></script>
    <script defer type="text/javascript" src="dist/js/check-internet.js"></script>


    <?php if (isset($success)) { ?>
            <script type="text/javascript">
                setTimeout(function() {
                        swal("Success", "<?php echo $success; ?>", "success");
                },
                100);
        </script>

    <?php } ?>

    <?php if (isset($err)) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                    swal("Failed", "<?php echo $err; ?>", "error");
                },
                100);
        </script>

    <?php } ?>
    <?php if (isset($info)) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                    swal("Success", "<?php echo $info; ?>", "warning");
                },
                100);
        </script>

    <?php } ?>
    <?php if (isset($debt)) { ?>
        <script type="text/javascript">
            setTimeout(function() {
                swal("<?php echo $debt; ?>", "", "error");
            }, 100);
        </script>
    <?php } ?>
</head>