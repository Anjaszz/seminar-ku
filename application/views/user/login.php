<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

        @keyframes dropIn {
            0% {
                opacity: 0;
                transform: translateY(-100px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
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
            animation: dropIn 1s ease-out;
        }

        .login-card img {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px;
        }

        .login-card h4 {
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

        .input-group .form-control {
            position: relative;
            padding-right: 40px;
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

        /* Styling untuk captcha */
        .captcha-label {
    font-weight: bold;
    margin-bottom: 5px; /* Jarak antara label dan field input */
    text-align: 295; /* Mengatur teks agar berada di tengah */
    display: block; /* Memastikan label menempati satu baris penuh */
}
.form-captcha {
    display: flex;
    flex-direction: column;
    align-items: 40%; /* Memusatkan form di tengah */
    margin: 38px ; /* Margin otomatis untuk memusatkan div */
    text-align: 50%; /* Memusatkan teks di dalam form */
    width: 100%; /* Pastikan input memenuhi lebar form */
    max-width: 285px; /* Lebar maksimal input */
}

.captcha-input {
    width: 100%; /* Pastikan input memenuhi lebar form */
    max-width: 300px; /* Lebar maksimal input */
}





        @media (max-width: 768px) {
            .login-card {
                padding: 20px;
                margin: 10px;
            }

            body {
                overflow-x: hidden;
            }
            .form-captcha {
    display: flex;
    flex-direction: column;
    align-items: 40%; /* Memusatkan form di tengah */
    margin: 37px ; /* Margin otomatis untuk memusatkan div */
    text-align: 50%; /* Memusatkan teks di dalam form */
    width: 100%; /* Pastikan input memenuhi lebar form */
    max-width: 296px; /* Lebar maksimal input */
}
        }

        @media (max-width: 576px) {
            .login-card img {
                max-width: 300px;
            }
            .form-captcha {
    display: flex;
    flex-direction: column;
    align-items: 40%; /* Memusatkan form di tengah */
    margin: 37px ; /* Margin otomatis untuk memusatkan div */
    text-align: 50%; /* Memusatkan teks di dalam form */
    width: 100%; /* Pastikan input memenuhi lebar form */
    max-width: 296px; /* Lebar maksimal input */
}
        }
    </style>
</head>

<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="login-card">
        <?php echo form_open("user/auth"); ?>
        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" alt="SIMAS Logo" class="img-fluid mb-4">
        <h4 class="f-w-400">Masuk Kedalam Akun</h4>

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <?php echo form_input(['name' => 'nim', 'class' => 'form-control', 'placeholder' => 'Masukkan NIM', 'required' => 'required']); ?>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>
            <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'id' => 'password', 'placeholder' => 'Masukkan Password', 'required' => 'required']); ?>
            <div class="input-group-append">
                <span class="input-group-text show-password" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
        </div>

        <!-- Captcha Input -->
        <div class="form-captcha">
    <span id="captcha-question" class="captcha-label"></span> <!-- Teks Captcha -->
    <div class="input-group">
        <?php echo form_input([
            'name' => 'captcha', 
            'class' => 'form-control captcha-input', 
            'placeholder' => 'Jawaban', 
            'required' => 'required', 
            'id' => 'captcha-answer',
            'type' => 'tel', // Menggunakan type="tel" untuk menampilkan keyboard angka
            'inputmode' => 'numeric', // Menampilkan keyboard angka pada perangkat seluler
            'pattern' => '[0-9]*', // Hanya angka
        ]); ?>
    </div>
</div>



        <p class="text-center mt-3"><a href="<?php echo base_url('user/auth/forgot_password'); ?>">Lupa Password?</a></p>

        <?php echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], '<i class="fas fa-sign-in-alt"></i> LOGIN'); ?>
        <?php echo form_close(); ?>
    </div>

    <?php if ($this->session->flashdata('login_success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: '<?= $this->session->flashdata('login_success'); ?>',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = '<?= base_url("dashboard") ?>';
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login_error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= $this->session->flashdata('login_error'); ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    <?php endif; ?>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePassword.querySelector('i').classList.toggle('fa-eye');
            togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Generate random captcha question
        function generateCaptcha() {
            const num1 = Math.floor(Math.random() * 10);
            const num2 = Math.floor(Math.random() * 10);
            document.getElementById('captcha-question').innerText = `Berapa hasil dari ${num1} + ${num2}?`;
            return num1 + num2; // Return the answer
        }

        let captchaAnswer = generateCaptcha();

        document.getElementById('captcha-answer').addEventListener('input', function () {
            this.setCustomValidity(this.value != captchaAnswer ? "Jawaban salah" : "");
        });
    </script>
</body>

</html>
