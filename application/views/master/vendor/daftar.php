<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Vendor | SIMAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />

    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-gradient {
            background: linear-gradient(-45deg, #3b82f6, #4f46e5, #2563eb, #1e40af);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .pricing-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.98);
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.1);
        }

        body {
            background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        .form-input-icon {
            color: #6B7280;
            transition: color 0.2s ease;
        }

        .form-input:focus + .form-input-icon {
            color: #3B82F6;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: rgba(243, 244, 246, 0.1);
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>

<body class="h-full">
    <div class="min-h-screen flex">
        <!-- Left Side - Info & Benefits -->
        <div class="hidden lg:flex lg:flex-1 animate-gradient overflow-hidden">
            <div class="w-full flex flex-col pt-8 relative">
                <div class="max-w-lg mx-auto text-white space-y-4 relative z-10">
                    <!-- Header -->
                    <div class="text-center space-y-4">
                        <div class="w-20 h-20 bg-white/15 rounded-2xl mx-auto flex items-center justify-center animate-float">
                            <i class="fas fa-store text-4xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold tracking-tight">Menjadi Vendor SIMAS</h2>
                        <p class="text-lg text-blue-100">Bergabung dengan kami dan dapatkan berbagai keuntungan</p>
                    </div>

                    <!-- Benefits List -->
                    <div class="space-y-4">
                        <div class="glass-card flex items-start space-x-4 p-5 rounded-xl">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">Pantau Performa</h3>
                                <p class="text-blue-100">Akses dashboard analitik untuk memantau performa seminar dan peserta</p>
                            </div>
                        </div>

                        <div class="glass-card flex items-start space-x-4 p-5 rounded-xl">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tools text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">Kelola dengan Mudah</h3>
                                <p class="text-blue-100">Tool manajemen seminar yang lengkap dan mudah digunakan</p>
                            </div>
                        </div>

                        <div class="glass-card flex items-start space-x-4 p-5 rounded-xl">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-qrcode text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">QR Code System</h3>
                                <p class="text-blue-100">Sistem presensi modern menggunakan QR Code untuk kemudahan tracking</p>
                            </div>
                        </div>

                        <div class="glass-card flex items-start space-x-4 p-5 rounded-xl">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-invoice text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">Laporan Otomatis</h3>
                                <p class="text-blue-100">Generate laporan peserta dan sertifikat secara otomatis</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="glass-card p-6 rounded-xl space-y-4">
                        <h4 class="font-semibold text-lg mb-4">Dukungan Prioritas</h4>
                        <div class="space-y-3 text-blue-100">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-400"></i>
                                <span>Bantuan teknis 24/7</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-400"></i>
                                <span>Panduan penggunaan lengkap</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-green-400"></i>
                                <span>Update fitur berkala</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Support -->
                    <div class="text-center ">
                        <p class="text-blue-100 mb-2">Butuh bantuan?</p>
                        <a href="#" class="inline-flex items-center space-x-2 text-white hover:text-blue-200 transition-colors">
                            <i class="fas fa-headset"></i>
                            <span>Hubungi support kami</span>
                        </a>
                    </div>
                </div>

               
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="flex-1  bg-gradient-to-br from-blue-50 to-white custom-scroll">
            <div class="max-w-3xl mx-auto px-4 py-2">
                <!-- Back Button -->
                <div class="mb-4">
                    <a href="javascript:history.back()" 
                       class="inline-flex items-center px-4 py-2 text-sm text-blue-700 bg-blue-50 rounded-lg shadow-sm hover:bg-blue-100 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <!-- Form Container -->
                <div class="glass rounded-2xl p-6 shadow-lg border border-blue-100">
                    <div class="text-center mb-2">
                        <h2 class="text-2xl font-bold text-gray-900"><?= $title; ?></h2>
                        <p class=" text-gray-600">Lengkapi informasi untuk mendaftar sebagai vendor</p>
                    </div>

                    <?= form_open('daftar/vendor', ['class' => 'space-y-6']); ?>
                        <!-- Personal Information -->
                        <div class="space-y-4">
    <h3 class="text-lg font-medium text-gray-900">Informasi Vendor</h3>
    <div class="space-y-2">
        <!-- Nama Vendor -->
        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Vendor</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-building text-gray-400 form-input-icon"></i>
                </div>
                <input type="text" name="nama_vendor" 
                    class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Masukkan nama vendor"
                    value="<?= set_value('nama_vendor'); ?>" required>
            </div>
        </div>

        <!-- Email -->
        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 form-input-icon"></i>
                </div>
                <input type="email" name="email" 
                    class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="contoh@email.com"
                    value="<?= set_value('email'); ?>" required>
            </div>
        </div>

        <!-- No Telepon -->
        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-phone text-gray-400 form-input-icon"></i>
                </div>
                <input type="text" name="no_telp" 
                    class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="08xx-xxxx-xxxx"
                    value="<?= set_value('no_telp'); ?>" required>
            </div>
        </div>
    </div>
</div>
                        <!-- Bank Information -->
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900">Informasi Bank</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <!-- Bank -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-university text-gray-400 form-input-icon"></i>
                                        </div>
                                        <select name="id_bank" 
                                            class="form-input block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none transition-colors">
                                            <option value="">Pilih Bank</option>
                                            <?php foreach ($banks as $bank): ?>
                                                <option value="<?= $bank->id_bank ?>"><?= $bank->nama_bank ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- No Rekening -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-credit-card text-gray-400 form-input-icon"></i>
                                        </div>
                                        <input type="text" name="no_rekening" 
                                            class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            placeholder="Masukkan nomor rekening"
                                            value="<?= set_value('no_rekening'); ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Package -->
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900">Paket Berlangganan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- 3 Month Package -->
                                <div class="pricing-card p-6 rounded-xl shadow-sm border border-gray-200 hover:border-blue-500 cursor-pointer group">
                                    <input type="radio" name="lama_berlangganan" value="3" class="hidden" id="package3">
                                    <label for="package3" class="cursor-pointer">
                                        <div class="text-center">
                                            <h4 class="font-semibold text-gray-900 group-hover:text-blue-600">3 Bulan</h4>
                                            <p class="mt-2 text-2xl font-bold text-blue-600">Rp 50.000</p>
                                            <p class="mt-1 text-sm text-gray-500">Rp 16.667/bulan</p>
                                        </div>
                                    </label>
                                </div>

                                <!-- 6 Month Package -->
                                <div class="pricing-card p-6 rounded-xl shadow-sm border border-gray-200 hover:border-blue-500 cursor-pointer group">
                                    <input type="radio" name="lama_berlangganan" value="6" class="hidden" id="package6">
                                    <label for="package6" class="cursor-pointer">
                                        <div class="text-center">
                                            <h4 class="font-semibold text-gray-900 group-hover:text-blue-600">6 Bulan</h4>
                                            <p class="mt-2 text-2xl font-bold text-blue-600">Rp 70.000</p>
                                            <p class="mt-1 text-sm text-gray-500">Rp 11.667/bulan</p>
                                        </div>
                                    </label>
                                </div>

                                <!-- 12 Month Package -->
                                <div class="pricing-card p-6 rounded-xl shadow-sm border border-gray-200 hover:border-blue-500 cursor-pointer group">
                                    <input type="radio" name="lama_berlangganan" value="12" class="hidden" id="package12">
                                    <label for="package12" class="cursor-pointer">
                                        <div class="text-center">
                                            <h4 class="font-semibold text-gray-900 group-hover:text-blue-600">1 Tahun</h4>
                                            <p class="mt-2 text-2xl font-bold text-blue-600">Rp 100.000</p>
                                            <p class="mt-1 text-sm text-gray-500">Rp 8.333/bulan</p>
                                            <span class="mt-2 inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Hemat 50%</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="space-y-2">
                            <h3 class="text-lg font-medium text-gray-900">Keamanan Akun</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Password -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400 form-input-icon"></i>
                                        </div>
                                        <input type="password" name="password" id="password"
                                            class="form-input block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            placeholder="Minimal 8 karakter"
                                            required>
                                        <button type="button" onclick="togglePassword('password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-lock text-gray-400 form-input-icon"></i>
                                        </div>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            class="form-input block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                            placeholder="Ulangi password"
                                            required>
                                        <button type="button" onclick="togglePassword('confirm_password')"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="">
                            <button type="submit"
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Daftar Sekarang
                            </button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            
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

        // Package Selection
        document.querySelectorAll('.pricing-card').forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            
            card.addEventListener('click', () => {
                // Remove active state from all cards
                document.querySelectorAll('.pricing-card').forEach(c => {
                    c.classList.remove('border-blue-500', 'ring-2', 'ring-blue-500', 'bg-blue-50');
                });
                
                // Add active state to selected card
                card.classList.add('border-blue-500', 'ring-2', 'ring-blue-500', 'bg-blue-50');
                radio.checked = true;
            });
        });
    </script>
</body>
</html>