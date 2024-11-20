<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/animation/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/notification/css/notification.min.css">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />
    <script src='https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.all.min.js"></script>
 
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .auth-wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #252424dc;
        }

        .card {
            width: 100%;
            max-width: 400px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.85); /* Warna card dengan transparansi */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan */
            border-radius: 10px; /* Memberikan sedikit rounded corners */
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .btn-primary {
            display: block;
            width: 100%;
            margin: auto;
        }

        #particles-js {
            z-index: 1;
            display: flex;
            width: 100%;
            height: 100%;
            background: #252424dc;
        }

        .alert span {
            cursor: pointer;
            padding-right: 5px;
        }
    </style>
</head>

<body class="auth-prod-slider">

    <div class="auth-wrapper" id="particles-js">
        <div class="auth-content container">
            <div class="card">
                <div class="row align-items-center">
                    <div class="col-md-12 mb-5">
                        <div class="card-body">
                            <?php echo form_open("auth/login"); ?>
                            <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Masuk Kedalam Akun</h4>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                </div>
                                <?php echo form_input($identity); ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                </div>
                                <?php echo form_input($password); ?>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo site_url('auth/forgot_password'); ?>">Lupa Password?</a>
                            </div>
                            <?php echo form_submit('submit', lang('login_submit_btn'), ['class' => 'btn btn-primary mb-4']); ?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('message')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success',
                    html: "<?php echo $this->session->flashdata('message'); ?>",
                    icon: "<?php echo $this->session->flashdata('status'); ?>",
                    confirmButtonText: 'OK'
                });
            });
        </script>
    <?php endif; ?>

    <script src="<?php echo base_url() ?>assets/backend/template/assets/js/particle.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/template/assets/js/vendor-all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/notification/js/bootstrap-growl.min.js"></script>

    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) { ?>

                function notify(message, type) {
                    $.growl({
                        icon: 'feather icon-check',
                        title: 'Berhasil!',
                        message: message,
                    }, {
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 2500,
                        timer: 5000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" style="width:30%;height:80px;" class="alert" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"></span>' +
                            '<span data-growl="title"></span><br>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#!" data-growl="url"></a>' +
                            '</div>'
                    });
                };
                notify('<?php echo $this->session->flashdata('success'); ?>', 'success');
            <?php } else if ($this->session->flashdata('danger')) { ?>
                function notify(message, type) {
                    $.growl({
                        icon: 'feather icon-x-circle',
                        title: 'Error!',
                        message: message,
                    }, {
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        spacing: 10,
                        z_index: 999999,
                        delay: 2500,
                        timer: 5000,
                        url_target: '_blank',
                        mouse_over: false,
                        animate: {
                            enter: 'animated fadeInRight',
                            exit: 'animated fadeOutRight'
                        },
                        icon_type: 'class',
                        template: '<div data-growl="container" style="width:25%;height:70px;" class="alert" role="alert">' +
                            '<button type="button" class="close" data-growl="dismiss">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            '<span data-growl="icon"></span>' +
                            '<span data-growl="title"></span><br>' +
                            '<span data-growl="message"></span>' +
                            '<a href="#!" data-growl="url"></a>' +
                            '</div>'
                    });
                };
                notify('<?php echo $this->session->flashdata('danger'); ?>', 'danger');
            <?php } ?>
        });
    </script>
</body>
</html>
