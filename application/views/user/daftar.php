<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar peserta</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />

    <style>
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in-left {
            animation: slideInLeft 0.8s ease-out;
        }

        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }

        .form-background {
            background-image: radial-gradient(circle at 30% 107%, #3b82f6 0%, #1d4ed8 5%, #1e3a8a 45%, #172554 60%, #0c1630 90%);
        }
        
input[type="number"]::-webkit-inner-spin-button, 
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

    </style>
</head>
<body class="h-full form-background">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-6xl">
            <!-- Side-by-side Layout -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row">
                <!-- Left Section - Welcome Content -->
                <div class="lg:w-1/3 bg-gradient-to-br from-blue-600 to-blue-900 p-8 text-white relative overflow-hidden slide-in-left">
    <div class="relative z-10">
        <h2 class="text-3xl font-bold mb-6">Selamat Datang di SIMAS</h2>
        <p class="text-blue-100 mb-8">Bergabunglah dengan komunitas akademik kami dan mulailah perjalanan sukses Anda bersama kami.</p>
        
        <!-- Elemen Dekoratif -->
        <div class="space-y-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span>Keunggulan dalam Pendidikan</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users"></i>
                </div>
                <span>Komunitas yang Dinamis</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <span>Inovasi & Penelitian</span>
            </div>
        </div>
    </div>
    
    <!-- Lingkaran Dekoratif -->
    <div class="absolute -bottom-32 -right-32 w-64 h-64 bg-blue-500 rounded-full opacity-20"></div>
    <div class="absolute -bottom-48 -right-48 w-96 h-96 bg-blue-600 rounded-full opacity-20"></div>
</div>


                <!-- Right Section - Form -->
                <div class="lg:w-2/3 p-8 bg-gray-50 slide-in-right">
                    <form id="form-daftar" action="<?= base_url('daftar/simpan'); ?>" method="post" class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8">Informasi Pribadi</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <input type="text" id="nama_mhs" name="nama_mhs" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 placeholder-transparent focus:border-blue-500 focus:outline-none bg-white"
                                        placeholder="Nama" value="<?= set_value('nama_mhs') ?>" required>
                                    <label for="nama_mhs" 
                                        class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600 transition-all 
                                               peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 
                                               peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-blue-500">
                                        Nama Lengkap
                                    </label>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <input type="email" id="email" name="email" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 placeholder-transparent focus:border-blue-500 focus:outline-none bg-white"
                                        placeholder="Email" value="<?= set_value('email') ?>" required>
                                    <label for="email" 
                                        class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600 transition-all 
                                               peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 
                                               peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-blue-500">
                                        Email
                                    </label>
                                </div>
                            </div>

                            <!-- No. Telpon -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <input type="tel" id="no_telp" name="no_telp" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 placeholder-transparent focus:border-blue-500 focus:outline-none bg-white"
                                        placeholder="Telepon" inputmode="numeric" pattern="[0-9]*" required>
                                    <label for="no_telp" 
                                        class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600 transition-all 
                                               peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 
                                               peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-blue-500">
                                        No. Telepon
                                    </label>
                                </div>
                            </div>

                            <!-- Usia -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <input type="number" id="tanggal_lahir" name="tanggal_lahir" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 placeholder-transparent focus:border-blue-500 focus:outline-none bg-white"
                                        placeholder="Usia" min="0" max="120" required>
                                    <label for="tanggal_lahir" 
                                        class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600 transition-all 
                                               peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 
                                               peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-blue-500">
                                        Usia (Tahun)
                                    </label>
                                </div>
                            </div>

                            <!-- Departemen -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <select id="id_fakultas" name="id_fakultas" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none bg-white appearance-none"
                                        required>
                                        <option value="">Pilih Departemen</option>
                                        <?php foreach ($fakultas as $f): ?>
                                            <option value="<?= $f->id_fakultas ?>"><?= $f->nama_fakultas ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600">
                                        Departemen
                                    </label>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Jurusan -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <select id="id_prodi" name="id_prodi" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none bg-white appearance-none"
                                        required>
                                        <option value="">Pilih Jurusan</option>
                                    </select>
                                    <label class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600">
                                        Jurusan
                                    </label>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <input type="password" id="password" name="password" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 placeholder-transparent focus:border-blue-500 focus:outline-none bg-white"
                                        placeholder="Password" required>
                                    <label for="password" 
                                        class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600 transition-all 
                                               peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 
                                               peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-blue-500">
                                        Password
                                    </label>
                                    <button type="button" id="togglePassword" 
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="group transform transition-all duration-300 ">
                                <div class="relative">
                                    <input type="password" id="confirm_password" name="confirm_password" 
                                        class="peer w-full px-4 py-3 rounded-xl border-2 border-gray-200 placeholder-transparent focus:border-blue-500 focus:outline-none bg-white"
                                        placeholder="Konfirmasi Password" required>
                                    <label for="confirm_password" 
                                        class="absolute left-4 -top-2.5 bg-gray-50 px-2 text-sm text-gray-600 transition-all 
                                               peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 
                                               peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-blue-500">
                                        Konfirmasi Password
                                    </label>
                                    <button type="button" id="toggleConfirmPassword" 
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit" 
                                class="w-full bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold 
                                       transform transition-all duration-300 
                                       hover:bg-blue-700  hover:shadow-lg 
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>
                    <div class="flex items-center text-center justify-center mt-2">
            <a href="<?php echo base_url('user/auth'); ?>" class="text-sm font-medium text-gray-800 ">
               Sudah punya akun? <span class="text-blue-600 hover:text-text-blue-800 hover:underline transition-colors duration-200"> Masuk disini</span>
            </a>

        </div>
                </div>
            </div>
        </div>
    </div>



    <script>
    $(document).ready(function () {
        // Form submission handler with loading animation
        $('#form-daftar').on('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn
                .prop('disabled', true)
                .html(`
                    <div class="flex items-center justify-center space-x-2">
                        <div class="w-4 h-4 rounded-full animate-bounce bg-white"></div>
                        <div class="w-4 h-4 rounded-full animate-bounce bg-white" style="animation-delay: 0.1s"></div>
                        <div class="w-4 h-4 rounded-full animate-bounce bg-white" style="animation-delay: 0.2s"></div>
                    </div>
                `);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
    if (response.status == 'success') {
        // Success animation and redirect
        Swal.fire({
            icon: 'success',
            title: 'Pendaftaran Berhasil!',
            text: response.message,
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                popup: 'animate__animated animate__fadeInUp'
            }
        }).then(function() {
            window.location.href = response.redirect; // Gunakan URL dari response
        });
    } else {
        // Error animation
        Swal.fire({
            icon: 'error',
            title: 'Pendaftaran Gagal',
            html: response.message,
            customClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    }
},
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Terjadi kesalahan pada server. Coba lagi nanti.',
                        customClass: {
                            popup: 'animate__animated animate__shakeX'
                        }
                    });
                },
                complete: function() {
                    submitBtn
                        .prop('disabled', false)
                        .html('Daftar Sekarang');
                }
            });
        });

        // Dynamic Prodi loading with loading animation
        $('#id_fakultas').change(function () {
            var fakultas_id = $(this).val();
            if (fakultas_id != '') {
                const prodiSelect = $('#id_prodi');
                
                // Tambahkan animasi loading pada dropdown prodi
                prodiSelect.prop('disabled', true)
                    .html('<option value="">Loading...</option>')
                    .parent('.relative')
                    .addClass('opacity-75');

                $.ajax({
                    url: "<?= base_url('daftar/get_prodi_by_fakultas') ?>",
                    method: "POST",
                    data: {id_fakultas: fakultas_id},
                    dataType: "json",
                    success: function (data) {
                        var options = '<option value="">Pilih Program Studi</option>';
                        $.each(data, function (key, value) {
                            options += '<option value="' + value.id_prodi + '">' + value.nama_prodi + '</option>';
                        });
                        
                        // Animasi fade saat mengupdate opsi
                        prodiSelect
                            .fadeOut(200, function() {
                                $(this).html(options).fadeIn(200);
                            })
                            .prop('disabled', false)
                            .parent('.relative')
                            .removeClass('opacity-75');
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal memuat data Program Studi',
                            customClass: {
                                popup: 'animate__animated animate__shakeX'
                            }
                        });
                        
                        prodiSelect
                            .html('<option value="">Pilih Program Studi</option>')
                            .prop('disabled', false)
                            .parent('.relative')
                            .removeClass('opacity-75');
                    }
                });
            }
        });

        // Enhanced password visibility toggle with animation
        $('#togglePassword, #toggleConfirmPassword').on('click', function() {
            const button = $(this);
            const input = button.siblings('input');
            const icon = button.find('i');
            
           
            
            setTimeout(() => {
                const type = input.attr('type') === 'password' ? 'text' : 'password';
                input.attr('type', type);
                icon
                    .toggleClass('fa-eye fa-eye-slash')
                    .css('transform', 'rotate(0deg)');
            }, 150);
        });

        // Input field animations
        $('input, select').on('focus', function() {
            $(this).parent('.relative')
                .addClass('transform scale-[1.02] z-10')
                .css('transition', 'all 0.3s ease');
        }).on('blur', function() {
            $(this).parent('.relative')
                .removeClass('transform scale-[1.02] z-10');
        });

        // Add ripple effect to submit button
        $('button[type="submit"]').on('mousedown', function(e) {
            const btn = $(this);
            const ripple = $('<span></span>');
            const btnOffset = btn.offset();
            const xPos = e.pageX - btnOffset.left;
            const yPos = e.pageY - btnOffset.top;

            ripple.addClass('absolute rounded-full bg-white opacity-30')
                .css({
                    top: yPos,
                    left: xPos,
                    width: 0,
                    height: 0
                });

            btn.append(ripple);

            const size = Math.max(btn.width(), btn.height());
            
            ripple.animate({
                width: size * 2,
                height: size * 2,
                top: yPos - size,
                left: xPos - size,
                opacity: 0
            }, 400, function() {
                ripple.remove();
            });
        });

        // Add floating label animations
        $('.peer').on('input', function() {
            const label = $(this).siblings('label');
            if ($(this).val()) {
                label.addClass('text-blue-500 -top-2.5 text-sm');
            } else {
                label.removeClass('text-blue-500');
            }
        });
    });
</script>