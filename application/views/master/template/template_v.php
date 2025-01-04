<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <?php $this->load->view('template/css') ?>
</head>

<style>
    .bg {
        background-color: #fffff;
    }
</style>

<body class="bg">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php $this->load->view('master/template/navbar'); ?>
    <?php $this->load->view('master/template/header'); ?> <!-- Mengirimkan admin_email ke header -->

    <div class="pcoded-main-container" id="padding">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- start content here -->
                            <?php echo $contents; ?>
                            <!-- end content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('template/js'); ?>
</body>

</html>
