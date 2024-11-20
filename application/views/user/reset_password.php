<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            height: 100vh; /* Mengatur tinggi menjadi penuh */
            display: flex; /* Menggunakan flexbox */
            justify-content: center; /* Memusatkan secara horizontal */
            align-items: center; /* Memusatkan secara vertikal */
            background: linear-gradient(315deg, rgba(101, 0, 94, 1) 3%, rgba(60, 132, 206, 1) 38%, rgba(48, 238, 226, 1) 68%, rgba(255, 25, 25, 1) 98%);
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

        .reset-password-card .form-icon {
            font-size: 1.5rem;
            margin-bottom: auto;
            color: black;
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
    </style>
</head>
<body>

<div class="reset-password-card">
    <h3 class="card-title text-center">
        <i class="fa fa-key form-icon"></i> Reset Password
    </h3>
    <p class="text-center">Masukkan password baru Anda</p>
    <?php echo form_open('user/auth/update_password', ['id' => 'resetPasswordForm']); ?>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
        <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan password baru" required>
        <div class="input-group-append">
            <span class="input-group-text show-password" onclick="togglePassword('password')"><i class="fa fa-eye"></i></span>
        </div>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
        </div>
        <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Konfirmasi password baru" required>
        <div class="input-group-append">
            <span class="input-group-text show-password" onclick="togglePassword('confirm_password')"><i class="fa fa-eye"></i></span>
        </div>
    </div>

    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Reset Password</button>
    <?php echo form_close(); ?>
</div>

<!-- SweetAlert logic for password update success/error -->
<script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+[\]{};':"\\|,.<>\/?~-])[A-Za-z\d!@#$%^&*()_+[\]{};':"\\|,.<>\/?~-]{8,}$/;


        // Validasi password dengan regex
        if (!passwordRegex.test(password)) {
            event.preventDefault(); // Mencegah form dikirim jika password tidak valid
            Swal.fire({
                icon: 'error',
                title: 'Password tidak valid!',
                text: 'Password harus terdiri dari minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.',
                confirmButtonText: 'OK'
            });
        } else if (password !== confirmPassword) {
            event.preventDefault(); // Mencegah form dikirim jika konfirmasi password tidak cocok
            Swal.fire({
                icon: 'error',
                title: 'Password tidak cocok!',
                text: 'Konfirmasi password harus sama dengan password baru.',
                confirmButtonText: 'OK'
            });
        } else {
            // Menampilkan SweetAlert untuk konfirmasi reset password
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password Anda telah berhasil direset.',
                confirmButtonText: 'OK'
            });
        }
    });

    <?php if ($this->session->flashdata('password_updated')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '<?php echo $this->session->flashdata('password_updated'); ?>',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('password_error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?php echo $this->session->flashdata('password_error'); ?>',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>

    // Toggle Password Visibility
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = event.currentTarget.querySelector('i');
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

<!-- Wave Background -->
<div class="wave"></div>
<div class="wave"></div>
<div class="wave"></div>

</body>
</html>
