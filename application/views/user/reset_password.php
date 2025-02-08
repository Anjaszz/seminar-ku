<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        /* Password Strength Indicator */
        .strength-meter {
            height: 4px;
            background-color: #eee;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 4px;
            transition: all 0.3s ease;
        }

        .strength-meter div {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-weak { background-color: #ff4d4d; }
        .strength-medium { background-color: #ffd700; }
        .strength-strong { background-color: #00cc00; }
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
        <div class=" max-w-md w-full space-y-8 glass rounded-3xl p-8 shadow-2xl slide-up">
            <div class="flex flex-col items-center space-y-6">
                <div class="w-16 h-16 bg-indigo-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Reset Password</h2>
                <p class="text-gray-600 text-center">Masukkan password baru untuk akun Anda</p>
            </div>

            <?php echo form_open('user/auth/update_password', ['id' => 'resetPasswordForm', 'class' => 'mt-8 space-y-6']); ?>
                <!-- New Password -->
                <div class="group">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-lock text-gray-400"></i>
        </div>
        <input type="password" id="password" name="password"
            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent 
                   bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300"
            placeholder="Password Baru" required>
        <button type="button" onclick="togglePassword('password')"
            class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors duration-200"></i>
        </button>
    </div>
    
    <!-- Password Requirements and Strength -->
    <div id="password-requirements" class="hidden mt-4 space-y-2">
        <div class="strength-meter mt-2">
            <div id="strength-bar"></div>
        </div>
        <p id="strength-text" class="text-xs text-gray-500 mt-1"></p>
        
        <div class="flex items-center space-x-2">
            <i id="length-check" class="fas fa-times text-red-500"></i>
            <span class="text-sm text-gray-600">Min.8 karakter</span>
        </div>
        <div class="flex items-center space-x-2">
            <i id="number-check" class="fas fa-times text-red-500"></i>
            <span class="text-sm text-gray-600">Kombinasi Angka (12345)</span>
        </div>
        <div class="flex items-center space-x-2">
            <i id="case-check" class="fas fa-times text-red-500"></i>
            <span class="text-sm text-gray-600">Kombinasi Huruf (AbCd)</span>
        </div>
        <div class="flex items-center space-x-2">
            <i id="special-check" class="fas fa-times text-red-500"></i>
            <span class="text-sm text-gray-600">Karakter Spesial (!@#$)</span>
        </div>
    </div>
</div>

                <!-- Confirm Password -->
                <div class="group">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="confirm_password" name="confirm_password"
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent 
                                   bg-white bg-opacity-90 backdrop-blur-sm transition-all duration-300"
                            placeholder="Konfirmasi Password Baru" required>
                        <button type="button" onclick="togglePassword('confirm_password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors duration-200"></i>
                        </button>
                    </div>
                </div>

                <input type="hidden" name="email" value="<?php echo $email; ?>">

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl 
                               text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 
                               focus:ring-indigo-500 transition-all duration-300 transform hover:scale-[1.02]">
                        <i class="fas fa-key mr-2"></i>
                        Reset Password
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script>
        // Password Strength Checker
        const passwordInput = document.getElementById('password');
const requirements = document.getElementById('password-requirements');

passwordInput.addEventListener('focus', function() {
    requirements.classList.remove('hidden');
});

passwordInput.addEventListener('blur', function() {
    if (this.value === '') {
        requirements.classList.add('hidden');
    }
});

passwordInput.addEventListener('input', function() {
    requirements.classList.remove('hidden');
    checkPasswordStrength(this.value);
});

function checkPasswordStrength(password) {
    let strength = 0;
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');
    
    // Get check elements
    const lengthCheck = document.getElementById('length-check');
    const numberCheck = document.getElementById('number-check');
    const caseCheck = document.getElementById('case-check');
    const specialCheck = document.getElementById('special-check');

    // Length check
    if (password.length >= 8) {
        strength += 1;
        lengthCheck.className = 'fas fa-check text-green-500';
    } else {
        lengthCheck.className = 'fas fa-times text-red-500';
    }
    
    // Number check
    if (password.match(/[0-9]/)) {
        strength += 1;
        numberCheck.className = 'fas fa-check text-green-500';
    } else {
        numberCheck.className = 'fas fa-times text-red-500';
    }
    
    // Case check
    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
        strength += 1;
        caseCheck.className = 'fas fa-check text-green-500';
    } else {
        caseCheck.className = 'fas fa-times text-red-500';
    }
    
    // Special character check
    if (password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/)) {
        strength += 1;
        specialCheck.className = 'fas fa-check text-green-500';
    } else {
        specialCheck.className = 'fas fa-times text-red-500';
    }

    // Update strength meter
    switch (strength) {
        case 0:
        case 1:
            strengthBar.className = 'strength-weak';
            strengthBar.style.width = '25%';
            strengthText.textContent = 'Lemah';
            strengthText.className = 'text-xs text-red-500 mt-1';
            break;
        case 2:
            strengthBar.className = 'strength-medium';
            strengthBar.style.width = '50%';
            strengthText.textContent = 'Sedang';
            strengthText.className = 'text-xs text-yellow-500 mt-1';
            break;
        case 3:
            strengthBar.className = 'strength-medium';
            strengthBar.style.width = '75%';
            strengthText.textContent = 'Baik';
            strengthText.className = 'text-xs text-blue-500 mt-1';
            break;
        case 4:
            strengthBar.className = 'strength-strong';
            strengthBar.style.width = '100%';
            strengthText.textContent = 'Kuat';
            strengthText.className = 'text-xs text-green-500 mt-1';
            break;
    }
}
        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        // Form Validation
        document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+[\]{};':"\\|,.<>/?~-])[A-Za-z\d!@#$%^&*()_+[\]{};':"\\|,.<>/?~-]{8,}$/;

            if (!passwordRegex.test(password)) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Password tidak valid!',
                    text: 'Password harus terdiri dari minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-3xl',
                        confirmButton: 'rounded-xl'
                    }
                });
            } else if (password !== confirmPassword) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Password tidak cocok!',
                    text: 'Konfirmasi password harus sama dengan password baru.',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-3xl',
                        confirmButton: 'rounded-xl'
                    }
                });
            }
        });

        // Password Visibility Toggle
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = event.currentTarget.querySelector('i');
    
            setTimeout(() => {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
                eyeIcon.style.transform = 'rotate(0deg)';
            }, 150);
        }

       

        // Flash Messages
        <?php if ($this->session->flashdata('password_updated')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo $this->session->flashdata('password_updated'); ?>',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl'
                }
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('password_error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?php echo $this->session->flashdata('password_error'); ?>',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl'
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>