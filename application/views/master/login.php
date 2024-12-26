
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-600 to-purple-700 flex items-center justify-center p-4">
    
    <div class="w-full max-w-md">
        <div class="glass-morphism rounded-2xl shadow-2xl p-8">
            
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Admin Login</h1>
                <p class="text-gray-200">Masuk Ke akun anda</p>
            </div>

            <!-- Flash Message -->
            <?php if ($this->session->flashdata('error')): ?>
            <div class="bg-red-500 bg-opacity-20 border border-red-300 text-red-100 px-4 py-3 rounded mb-6">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?php echo site_url('master/auth/login'); ?>" method="POST" class="space-y-6">
                
                <!-- Email Field -->
                <div>
                    <label class="block text-white mb-2" for="email">Email</label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg border border-gray-300 border-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200"
                               placeholder="Enter your email"
                               required>
                        <span class="absolute right-3 top-3 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-white mb-2" for="password">Password</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg border border-gray-300 border-opacity-20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200"
                               placeholder="Enter your password" 
                               required>
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-3 text-gray-700 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#222831">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:-translate-y-0.5">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        }
    </script>
</body>
</html>
