<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <title>Ganti Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />

    <style>
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

        .glass {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .animate-slideup {
            animation: slideUp 0.5s ease forwards;
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

<body class="h-full animate-gradient">
    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 glass rounded-2xl p-8 animate-slideup">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 mb-6">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Ganti Password</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Untuk keamanan data Anda, silakan ubah password Anda
                </p>
            </div>

            <!-- Form -->
            <?php echo form_open('user/auth/ganti_password', [
                'id' => 'gantiPasswordForm',
                'class' => 'mt-8 space-y-6'
            ]); ?>

                <!-- Current Password -->
                <div class="relative group">
                    <label class="text-sm font-medium text-gray-700">Password Saat Ini</label>
                    <div class="mt-1 relative rounded-lg">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="old_password" name="old_password" 
                               class="block w-full pl-10 pr-10 py-3 text-gray-900 placeholder-gray-500 
                                      border border-gray-300 rounded-lg focus:outline-none focus:ring-2 
                                      focus:ring-indigo-500 focus:border-transparent transition-all duration-300" 
                               placeholder="Masukkan password saat ini" required>
                        <button type="button" onclick="togglePassword('old_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors duration-200"></i>
                        </button>
                    </div>
                </div>

              
               <!-- New Password Input with Strength Meter -->
<div class="relative group">
    <label class="text-sm font-medium text-gray-700">Password Baru</label>
    <div class="mt-1 relative rounded-lg">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-key text-gray-400"></i>
        </div>
        <input type="password" id="new_password" name="new_password" 
               class="block w-full pl-10 pr-10 py-3 text-gray-900 placeholder-gray-500 
                      border border-gray-300 rounded-lg focus:outline-none focus:ring-2 
                      focus:ring-indigo-500 focus:border-transparent transition-all duration-300" 
               placeholder="Masukkan password baru" required>
        <button type="button" onclick="togglePassword('new_password')"
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

                <!-- Confirm New Password -->
                <div class="relative group">
                    <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <div class="mt-1 relative rounded-lg">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-check-double text-gray-400"></i>
                        </div>
                        <input type="password" id="confirm_password" name="confirm_password" 
                               class="block w-full pl-10 pr-10 py-3 text-gray-900 placeholder-gray-500 
                                      border border-gray-300 rounded-lg focus:outline-none focus:ring-2 
                                      focus:ring-indigo-500 focus:border-transparent transition-all duration-300" 
                               placeholder="Konfirmasi password baru" required>
                        <button type="button" onclick="togglePassword('confirm_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 transition-colors duration-200"></i>
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg 
                                   text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 
                                   hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 
                                   focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                        <i class="fas fa-key mr-2"></i>
                        Ganti Password
                    </button>

                    <a href="<?php echo base_url('user/home'); ?>" 
                       class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg 
                              text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 
                              focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                              transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script>
       const passwordInput = document.getElementById('new_password');
const requirements = document.getElementById('password-requirements');

passwordInput.addEventListener('focus', function() {
    requirements.classList.remove('hidden');
});

passwordInput.addEventListener('blur', function() {
    if (this.value === '') {
        requirements.classList.add('hidden');
    }
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

passwordInput.addEventListener('input', function() {
    requirements.classList.remove('hidden');
    checkPasswordStrength(this.value);
});

        document.getElementById('new_password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.nextElementSibling;
            const icon = button.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Form Submission
        $(document).ready(function(){
            $('#gantiPasswordForm').on('submit', function(e){
                e.preventDefault();

                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...');

                $.ajax({
                    url: '<?= base_url('user/auth/ganti_password'); ?>',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000,
                                customClass: {
                                    popup: 'rounded-2xl'
                                }
                            }).then(function(){
                                window.location.href = '<?= base_url('user/home'); ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                customClass: {
                                    popup: 'rounded-2xl'
                                }
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirimkan data.',
                            customClass: {
                                popup: 'rounded-2xl'
                            }
                        });
                    },
                    complete: function() {
                        submitButton.prop('disabled', false)
                            .html('<i class="fas fa-key mr-2"></i>Ganti Password');
                    }
                });
            });
        });
    </script>
</body>
</html>