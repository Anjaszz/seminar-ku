<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ganti Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
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

        .reset-password-card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
            margin: 20px;
        }

        .reset-password-card h4 {
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
            border-radius: 0px;
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

        .back-button {
            color: #007bff; /* Ganti warna teks */
            text-decoration: none; /* Hilangkan garis bawah */
            margin-top: 10px; /* Space between buttons */
            font-size: 1rem; /* Ukuran font */
            display: block; /* Membuat link menjadi block element */
            text-align: center; /* Center text */
        }

        .back-button:hover {
            text-decoration: underline; /* Garis bawah saat hover */
        }

        /* Custom styling untuk menampilkan icon dalam field */
        .input-group .form-control {
            position: relative;
            padding-right: 40px; /* Beri ruang untuk ikon */
        }

        .input-group .input-group-append {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
        }

        .show-password {
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .reset-password-card {
                padding: 20px;
                margin: 10px;
            }
        }

        @media (max-width: 576px) {
            .reset-password-card img {
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
<div class="reset-password-card">
    <h3 class="card-title text-center">
        <i class="fa fa-key form-icon"></i> Ganti Password
    </h3>
    <p class="text-center">Untuk keamanan data anda, Silahkan ubah password anda</p>
    <?php echo form_open('user/auth/ganti_password', ['id' => 'gantiPasswordForm']); ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
        <input type="password" id="old_password" class="form-control" name="old_password" placeholder="Masukkan password saat ini" required>
        <div class="input-group-append">
            <span class="input-group-text show-password" id="toggleOldPassword">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Masukkan password baru" required>
        <div class="input-group-append">
            <span class="input-group-text show-password" id="toggleNewPassword">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
        <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Konfirmasi password baru" required>
        <div class="input-group-append">
            <span class="input-group-text show-password" id="toggleConfirmPassword">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Ganti Password</button>

    <a href="<?php echo base_url('user/home'); ?>" class="back-button">
        <i class="fas fa-arrow-left"></i> Beranda
    </a>

    <?php echo form_close(); ?>
</div>
<script>
    $(document).ready(function(){
        $('#gantiPasswordForm').on('submit', function(e){
            e.preventDefault(); // Mencegah reload halaman

            $.ajax({
                url: '<?= base_url('user/auth/ganti_password'); ?>', // Endpoint untuk controller
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        }).then(function(){
                            window.location.href = '<?= base_url('user/home'); ?>'; // Mengarahkan ke halaman home
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error seperti kesalahan koneksi atau server error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirimkan data.',
                    });
                }
            });
        });
    });
    </script>
<script>
    
    // Toggle password visibility
    function togglePasswordVisibility(inputId, toggleId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(toggleId).querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    document.getElementById('toggleOldPassword').addEventListener('click', function () {
        togglePasswordVisibility('old_password', 'toggleOldPassword');
    });
    document.getElementById('toggleNewPassword').addEventListener('click', function () {
        togglePasswordVisibility('new_password', 'toggleNewPassword');
    });
    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
    });

    
</script>


</body>

</html>
