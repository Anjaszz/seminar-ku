<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <title>Lupa Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

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

        .card-3d {
            transform-style: preserve-3d;
            transform: perspective(1000px);
            transition: transform 0.3s ease;
        }

        .card-3d:hover {
            transform: perspective(1000px) rotateX(2deg) rotateY(2deg);
        }

        @keyframes pulse-ring {
            0% { transform: scale(.85); opacity: 0.8; }
            50% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(.85); opacity: 0.8; }
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
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

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full space-y-8 glass rounded-3xl p-8 shadow-2xl slide-up">
            <!-- Header Section -->
            <div class="flex flex-col items-center space-y-6">
                <!-- Animated Lock Icon -->
                <div class="relative">
                    <div class="w-20 h-20 bg-indigo-600 rounded-full flex items-center justify-center pulse-ring">
                        <i class="fas fa-lock text-white text-3xl"></i>
                    </div>
                </div>
                
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900">Lupa Password?</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
                    </p>
                </div>
            </div>

            <!-- Form Section -->
            <?php echo form_open("user/auth/send_reset_link", ['class' => 'mt-8 space-y-6']); ?>
                <div class="group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl text-gray-900 
                                   placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                   focus:border-transparent bg-white bg-opacity-90 backdrop-blur-sm 
                                   transition-all duration-300 transform hover:scale-[1.02]"
                            placeholder="Masukkan email Anda" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent 
                               text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                               transition-all duration-300 transform hover:scale-[1.02]">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-paper-plane text-indigo-300 group-hover:text-indigo-400 
                                  transition ease-in-out duration-150"></i>
                        </span>
                        Kirim Link Reset
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center mt-4">
                    <a href="<?php echo base_url('user/auth'); ?>" 
                       class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Login
                    </a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <!-- SweetAlert2 Notifications -->
    <script>
        <?php if ($this->session->flashdata('email_sent')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Email Terkirim!',
                text: '<?= $this->session->flashdata('email_sent'); ?>',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'rounded-3xl',
                    title: 'font-bold'
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('email_error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= $this->session->flashdata('email_error'); ?>',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'rounded-3xl',
                    title: 'font-bold'
                }
            });
        <?php endif; ?>

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

        // Input Animation
        const emailInput = document.querySelector('input[type="email"]');
        emailInput.addEventListener('focus', () => {
            emailInput.parentElement.classList.add('transform', 'scale-[1.02]');
        });
        
        emailInput.addEventListener('blur', () => {
            emailInput.parentElement.classList.remove('transform', 'scale-[1.02]');
        });
    </script>
</body>
</html>