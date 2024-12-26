
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/css/style.css">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.18/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/style/loginvendor.css">
</head>

<body>
    <div class="auth-wrapper">
        <div class="card">
            <div class="card-body">
                <?php echo form_open("auth/login"); ?>
                
                <div class="d-flex justify-content-center align-items-center mb-4">
                    <h1 class="welcome-title">Selamat Datang Di</h1>
                    <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" alt="SIMAS" class="img-logo">
                </div>

                <h2 class="text-center text-white mb-4">Login</h2>

                <div class="form-container">
                    <div class="input-field">
                        <input type="text" name="identity" id="identity" required>
                        <label for="identity">Username atau Email</label>
                    </div>

                    <div class="input-field password-field">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                        <i class="fas fa-eye-slash toggle-password" onclick="togglePassword()"></i>
                    </div>

                    <a href="<?php echo site_url('auth/forgot_password'); ?>" class="forgot">Lupa Password?</a>

                    <button type="submit" class="btn-login">Login</button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('message')): ?>
    <script>
        Swal.fire({
            title: 'Success',
            html: "<?php echo $this->session->flashdata('message'); ?>",
            icon: "<?php echo $this->session->flashdata('status'); ?>",
            confirmButtonText: 'OK'
        });
    </script>
    <?php endif; ?>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>

</body>
</html>
