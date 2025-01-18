<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <title>Login Peserta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes slide-up {
            0% { transform: translateY(100px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .slide-up {
            animation: slide-up 0.6s ease-out;
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.3; }
            100% { transform: scale(0.8); opacity: 0.5; }
        }

        .pulse-ring::before {
            content: '';
            position: absolute;
            left: -8px;
            top: -8px;
            right: -8px;
            bottom: -8px;
            border: 2px solid #4F46E5;
            border-radius: inherit;
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        /* 3D Floating Effect */
        .card-3d {
            transform-style: preserve-3d;
            transform: perspective(1000px);
            transition: transform 0.3s ease;
        }

        .card-3d:hover {
            transform: perspective(1000px) rotateX(2deg) rotateY(2deg);
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

        /* Gradient Background Animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
    </style>
</head>

<body class="h-full animate-gradient overflow-hidden">
    <!-- Decorative Elements -->
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0">
            <div class="absolute w-96 h-96 -top-48 -left-48 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-float"></div>
            <div class="absolute w-96 h-96 -top-48 -right-48 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute w-96 h-96 -bottom-48 -left-48 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-float" style="animation-delay: -4s;"></div>
            <div class="absolute w-96 h-96 -bottom-48 -right-48 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-float" style="animation-delay: -6s;"></div>
        </div>
    </div>

     <!-- Back Button -->
    
    <!-- Main Content -->
    <div class="min-h-screen max-w-md mx-auto flex flex-col items-center justify-center  relative z-10">
    <div class="self-start mb-3 ml-2">
                    <a href="javascript:history.back()" 
                       class="inline-flex items-center px-4 py-2 text-sm text-blue-700 bg-blue-50 opacity-80 rounded-lg shadow-sm hover:bg-blue-100 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>
        <div class=" w-full space-y-8 glass rounded-3xl p-8 shadow-2xl slide-up">
            <?php echo form_open("user/auth", ['class' => 'space-y-6']); ?>
                <!-- Logo -->
                <div class="flex flex-col items-center justify-center space-y-4">
                    <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" 
                         alt="SIMAS Logo" 
                         class="w-32 h-auto transform transition-transform duration-500 hover:scale-110">
                    <h2 class="text-2xl font-bold text-gray-900">Masuk Kedalam Akun</h2>
                </div>

                <!-- Email Field -->
                <div class="group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <?php echo form_input([
                            'name' => 'email',
                            'class' => 'block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300',
                            'placeholder' => 'Masukkan Email',
                            'required' => 'required'
                        ]); ?>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <?php echo form_password([
                            'name' => 'password',
                            'id' => 'password',
                            'class' => 'block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300',
                            'placeholder' => 'Masukkan Password',
                            'required' => 'required'
                        ]); ?>
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors duration-200"></i>
                        </button>
                    </div>
                </div>

                <!-- Captcha -->
                <div class="space-y-2">
                    <p id="captcha-question" class="text-center text-gray-700 font-medium"></p>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-shield-alt text-gray-400"></i>
                        </div>
                        <?php echo form_input([
                            'name' => 'captcha',
                            'id' => 'captcha-answer',
                            'class' => 'block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300',
                            'placeholder' => 'Jawaban Captcha',
                            'required' => 'required',
                            'type' => 'tel',
                            'inputmode' => 'numeric',
                            'pattern' => '[0-9]*'
                        ]); ?>
                    </div>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-right">
                    <a href="<?php echo base_url('user/auth/forgot_password'); ?>" 
                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                        Lupa Password?
                    </a>
                </div>

                <!-- Login Button -->
                <div>
                    <?php echo form_button([
                        'type' => 'submit',
                        'class' => 'group relative w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-[1.02]'
                    ], '<i class="fas fa-sign-in-alt mr-2"></i> MASUK'); ?>
                </div>

            <?php echo form_close(); ?>
            <div class="flex items-center text-center justify-center">
            <a href="<?php echo base_url('daftar/user'); ?>" class="text-sm font-medium text-gray-800 ">
               Belum punya akun? <span class="text-blue-600 hover:text-text-blue-800 hover:underline transition-colors duration-200"> Daftar disini</span>
            </a>

        </div>
        </div>
       
    </div>

    <?php if ($this->session->flashdata('login_success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil',
            text: '<?= $this->session->flashdata('login_success'); ?>',
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                popup: 'animate__animated animate__fadeInUp'
            }
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
            timer: 2000,
            customClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    </script>
    <?php endif; ?>

    <script>
        // Password Toggle
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePassword.querySelector('i').classList.toggle('fa-eye');
            togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
        });

        // Captcha
        function generateCaptcha() {
            const num1 = Math.floor(Math.random() * 10);
            const num2 = Math.floor(Math.random() * 10);
            document.getElementById('captcha-question').innerText = `Berapa hasil dari ${num1} + ${num2}?`;
            return num1 + num2;
        }

        let captchaAnswer = generateCaptcha();

        document.getElementById('captcha-answer').addEventListener('input', function() {
            this.setCustomValidity(this.value != captchaAnswer ? "Jawaban salah" : "");
        });

        // 3D Card Effect
        const card = document.querySelector('.card-3d');
        
        document.addEventListener('mousemove', (e) => {
            if (!card) return;
            
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 30;
            const rotateY = (centerX - x) / 30;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        document.addEventListener('mouseleave', () => {
            if (!card) return;
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        });

        // Input Focus Effects
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('transform', 'scale-[1.02]');
            });
            
            input.addEventListener('blur', () => {
                input.parentElement.classList.remove('transform', 'scale-[1.02]');
            });
        });
    </script>
</body>
</html>