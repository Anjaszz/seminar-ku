<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />

    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient {
            /* Changed gradient colors to create more contrast */
            background: linear-gradient(-45deg, #1e1b4b, #312e81, #4338ca, #3730a3);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .animate-slideup {
            animation: slideUp 0.5s ease forwards;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Updated orb colors */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(15px);
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }

        .orb-1 {
            width: 150px;
            height: 150px;
            background: rgba(59, 130, 246, 0.4);
            top: 10%;
            left: 10%;
        }

        .orb-2 {
            width: 200px;
            height: 200px;
            background: rgba(79, 70, 229, 0.4);
            top: 20%;
            right: 15%;
            animation-delay: -2s;
        }

        .orb-3 {
            width: 100px;
            height: 100px;
            background: rgba(37, 99, 235, 0.4);
            bottom: 15%;
            right: 20%;
            animation-delay: -4s;
        }
    </style>
</head>

<body class="h-full animate-gradient overflow-hidden">
    <!-- Decorative Orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full">
            <!-- Card Container -->
            <div class="glass rounded-2xl p-8 shadow-2xl animate-slideup">
                <?php echo form_open("auth/login", ['class' => 'space-y-6']); ?>
                    <!-- Logo & Title Section -->
                    <div class="text-center space-y-4">
                        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" 
                             alt="SIMAS" 
                             class="h-24 mx-auto animate-float"
                             style="filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1))">
                        <div class="space-y-2">
                            <h2 class="text-2xl font-bold text-white">Selamat Datang Di SIMAS</h2>
                            <p class="text-blue-200">Vendor Login Portal</p>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="space-y-6 mt-8">
                        <!-- Username/Email Field -->
                        <div class="group">
                            <label for="identity" class="block text-sm font-medium text-blue-200 mb-2">
                                Username atau Email
                            </label>
                            <div class="relative rounded-lg">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="identity" name="identity" required
                                    class="block w-full pl-10 pr-3 py-3 text-gray-900 placeholder-gray-500 
                                           bg-white bg-opacity-90 border border-transparent rounded-lg
                                           focus:outline-none focus:ring-2 focus:ring-blue-500 
                                           focus:border-transparent transition-all duration-300"
                                    placeholder="Masukkan username atau email">
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="group">
                            <label for="password" class="block text-sm font-medium text-blue-200 mb-2">
                                Password
                            </label>
                            <div class="relative rounded-lg">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" id="password" name="password" required
                                    class="block w-full pl-10 pr-10 py-3 text-gray-900 placeholder-gray-500 
                                           bg-white bg-opacity-90 border border-transparent rounded-lg
                                           focus:outline-none focus:ring-2 focus:ring-blue-500 
                                           focus:border-transparent transition-all duration-300"
                                    placeholder="Masukkan password">
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors duration-200"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-right">
                            <a href="<?php echo site_url('auth/forgot_password'); ?>" 
                               class="text-sm font-medium text-blue-200 hover:text-white transition-colors duration-200">
                                Lupa Password?
                            </a>
                        </div>

                        <!-- Updated button style -->
    <button type="submit" 
        class="w-full flex justify-center items-center py-3 px-4 border border-transparent 
               rounded-lg text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 
               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 
               transition-all duration-300">
        <i class="fas fa-sign-in-alt mr-2"></i>
        Login
    </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('button[onclick="togglePassword()"] i');
            
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

        // SweetAlert for Messages
        <?php if ($this->session->flashdata('message')): ?>
            Swal.fire({
                title: 'Success',
                html: "<?php echo $this->session->flashdata('message'); ?>",
                icon: "<?php echo $this->session->flashdata('status'); ?>",
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-lg'
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>