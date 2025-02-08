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

    <div class="flex min-h-screen "> <!-- pt-16 accounts for fixed header height -->
        <!-- Main Container -->
        <main class="flex-1 transition-all duration-300" id="mainContent">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="">
                    <!-- Dynamic Content -->
                    <?php echo $contents ?>
                </div>
            </div>
        </main>
    </div>

    <?php $this->load->view('template/js'); ?>
</body>

</html>
