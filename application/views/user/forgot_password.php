<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lupa Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Background dan animasi gradasi */
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        /* Wave animasi */
        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
        }

        /* Card Lupa Password */
        .forgot-password-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 5%;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
            margin: 20px;
        }

        .forgot-password-card h4 {
            text-align: center;
            margin: 20px 0;
            font-weight: 500;
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            color: black;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: black;
            padding: 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .btn-primary {
            width: 100%;
            background-color: #0056b3;
            border: none;
            font-size: 1rem;
            padding: 10px;
            border-radius: 50px;
            font-weight: bold;
        }

        .btn-primary i {
            margin-right: 8px;
        }

        .btn-primary:hover {
            background-color: #004494;
        }

        @media (max-width: 768px) {
            .forgot-password-card {
                padding: 20px;
                margin: 10px;
            }
        }

        @media (max-width: 576px) {
            .forgot-password-card img {
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <!-- Background Wave -->
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>

    <div class="forgot-password-card">
        <h4 class="card-title text-center">
            <i class="fa fa-lock form-icon"></i> Lupa Password
        </h4>
        <p class="text-center">Masukkan email Anda untuk mengatur ulang password</p>
        <?php echo form_open("user/auth/send_reset_link"); ?>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim Link Reset</button>
        <?php echo form_close(); ?>
    </div>

    <!-- SweetAlert2 for Email Success/Error -->
    <?php if ($this->session->flashdata('email_sent')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $this->session->flashdata('email_sent'); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('email_error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= $this->session->flashdata('email_error'); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
