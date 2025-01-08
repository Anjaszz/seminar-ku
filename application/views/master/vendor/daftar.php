<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 font-[Inter]">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

        <div class="mb-6">
                <a href="javascript:history.back()" 
                   class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm hover:bg-white/90 text-gray-700 rounded-lg shadow-sm transition-all duration-200 group">
                    <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform duration-200"></i>
                    <span class="font-medium">Kembali</span>
                </a>
            </div>
        
            <!-- Header -->
            <div class="text-center mb-8 p-6 rounded-2xl bg-white/30 backdrop-blur-md shadow-sm">
                <h2 class="text-3xl font-bold text-gray-800 mb-2"><?= $title; ?></h2>
                <p class="text-gray-700">Daftarkan vendor Anda dan mulai berlangganan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl p-8 border border-white/20">
                <?= form_open('daftar/vendor', ['class' => 'space-y-6']); ?>
                    <!-- Two Column Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Vendor -->
                        <div>
                            <label for="nama_vendor" class="block text-sm font-medium text-gray-700 mb-1">Nama Vendor</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fas fa-building"></i>
                                </span>
                                <input type="text" name="nama_vendor" id="nama_vendor" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= set_value('nama_vendor'); ?>" required>
                            </div>
                            <p class="mt-1 text-sm text-red-600"><?= form_error('nama_vendor'); ?></p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= set_value('email'); ?>" required>
                            </div>
                            <p class="mt-1 text-sm text-red-600"><?= form_error('email'); ?></p>
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" name="no_telp" id="no_telp" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= set_value('no_telp'); ?>" required>
                            </div>
                            <p class="mt-1 text-sm text-red-600"><?= form_error('no_telp'); ?></p>
                        </div>

                        <!-- Bank -->
                        <div>
                            <label for="id_bank" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fas fa-university"></i>
                                </span>
                                <select name="id_bank" id="id_bank" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none"
                                    required>
                                    <option value="">Pilih Bank</option>
                                    <?php if (!empty($banks)): ?>
                                        <?php foreach ($banks as $bank): ?>
                                            <option value="<?= $bank->id_bank; ?>"><?= $bank->nama_bank; ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="">Tidak ada bank tersedia</option>
                                    <?php endif; ?>
                                </select>
                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 pointer-events-none">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-red-600"><?= form_error('id_bank'); ?></p>
                        </div>

                        <!-- No Rekening -->
                        <div>
                            <label for="no_rekening" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fas fa-credit-card"></i>
                                </span>
                                <input type="text" name="no_rekening" id="no_rekening" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    value="<?= set_value('no_rekening'); ?>" required>
                            </div>
                            <p class="mt-1 text-sm text-red-600"><?= form_error('no_rekening'); ?></p>
                        </div>

                        <!-- Paket Berlangganan -->
                        <div>
                            <label for="lama_berlangganan" class="block text-sm font-medium text-gray-700 mb-1">Paket Berlangganan</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                    <i class="fas fa-clock"></i>
                                </span>
                                <select name="lama_berlangganan" id="lama_berlangganan" 
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none"
                                    required>
                                    <option value="">Pilih Paket</option>
                                    <option value="3">3 Bulan - Rp 50.000</option>
                                    <option value="6">6 Bulan - Rp 70.000</option>
                                    <option value="12">1 Tahun - Rp 100.000</option>
                                </select>
                                <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 pointer-events-none">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-red-600"><?= form_error('lama_berlangganan'); ?></p>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Keamanan Akun</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
            <i class="fas fa-lock"></i>
        </span>
        <input type="password" name="password" id="password" 
            class="block w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            required>
        <button type="button" 
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer"
            onclick="togglePassword('password', 'togglePassword')">
            <i class="fas fa-eye" id="togglePassword"></i>
        </button>
    </div>
    <p class="mt-1 text-sm text-red-600"><?= form_error('password'); ?></p>
</div>

<!-- Konfirmasi Password -->
<div>
    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
            <i class="fas fa-lock"></i>
        </span>
        <input type="password" name="confirm_password" id="confirm_password" 
            class="block w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            required>
        <button type="button" 
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer"
            onclick="togglePassword('confirm_password', 'toggleConfirmPassword')">
            <i class="fas fa-eye" id="toggleConfirmPassword"></i>
        </button>
    </div>
    <p class="mt-1 text-sm text-red-600"><?= form_error('confirm_password'); ?></p>
</div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" 
                            class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            Daftar Sekarang
                        </button>
                    </div>
                <?= form_close(); ?>
            </div>


        </div>

        <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10">
        <!-- Bubble effect di background -->
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>
    </div>

    <script>
         function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Prevent form submission when clicking the toggle button
document.querySelectorAll('button[type="button"]').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
    });
});
    </script>
</body>

</html>