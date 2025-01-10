<!DOCTYPE html>  
<html lang="en">  
<head>  
    <title>Home</title>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <script src="https://cdn.tailwindcss.com"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">  
    <style>  
        @keyframes float {  
            0% { transform: translateY(0px); }  
            50% { transform: translateY(-10px); }  
            100% { transform: translateY(0px); }  
        }  
          
        .animate-float {  
            animation: float 3s ease-in-out infinite;  
        }  
  
        .gradient-text {  
            background: linear-gradient(to right, #3b82f6, #8b5cf6);  
            -webkit-background-clip: text;  
            -webkit-text-fill-color: transparent;  
        }  
  
        .scrollbar-hide::-webkit-scrollbar {  
            display: none;  
        }  
  
        .card-shadow {  
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);  
        }  
    </style>  
</head>  
<body class="bg-gray-50 mt-20">  
    <!-- Hero Section with Stats -->  
    <header class="relative bg-gradient-to-r from-blue-600 to-purple-600 py-20">  
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">  
            <div class="text-center">  
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl lg:text-6xl animate-float">  
                    Selamat datang, <?php echo $nama_mahasiswa; ?>!  
                </h1>  
                <p class="mt-4 text-xl text-gray-100">  
                    Platform Seminar Terbaik untuk Pengembangan Karirmu  
                </p>  
                <div class="mt-8 flex justify-center space-x-4">  
                    <a href="#upcoming" class="bg-white text-blue-600 px-3 sm:px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition">  
                        Lihat Seminar  
                    </a>  
                    <a href="#about" class="bg-transparent border-2 border-white text-white px-4 sm:px-6 py-3 rounded-lg font-semibold hover:bg-white/10 transition">  
                        Pelajari Lebih Lanjut  
                    </a>  
                </div>  
            </div>  
              
            <!-- Stats Cards -->  
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">  
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 text-white">  
                    <div class="text-3xl font-bold"><?php echo number_format($total_seminars); ?>+</div>  
                    <div class="text-gray-200">Seminar Tersedia</div>  
                </div>  
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 text-white">  
                    <div class="text-3xl font-bold"><?php echo number_format($total_participants); ?>+</div>  
                    <div class="text-gray-200">Peserta Aktif</div>  
                </div>  
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 text-white">  
                    <div class="text-3xl font-bold"><?php echo number_format($success_rate); ?>%</div>  
                    <div class="text-gray-200">Tingkat Kepuasan</div>  
                </div>  
            </div>  
        </div>  
    </header>  
  
    <!-- Search and Filter Section -->  
    <section class="py-8 bg-white shadow-sm">  
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">  
            <form action="<?php echo base_url('user/home/index'); ?>" method="GET" class="space-y-4">  
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">  
                    <!-- Search Bar -->  
                    <div class="md:col-span-2">  
                        <div class="relative">  
                            <input type="text"   
                                   name="search"   
                                   placeholder="Cari seminar..."   
                                   value="<?php echo $this->input->get('search'); ?>"  
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">  
                            <button type="submit" class="absolute right-2 top-2 text-gray-500">  
                                <i class="fas fa-search"></i>  
                            </button>  
                        </div>  
                    </div>  
  
                    <!-- Location Filter -->  
                    <div>  
                        <form method="GET" action="<?php echo base_url('user/home/index'); ?>">  
                            <select name="id_lokasi"   
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  
                                    onchange="this.form.submit()">  
                                <option value="">Semua Lokasi</option>  
                                <?php foreach ($lokasi_seminar as $lokasi): ?>  
                                <option value="<?php echo $lokasi->id_lokasi; ?>"   
                                        <?php echo ($this->input->get('id_lokasi') == $lokasi->id_lokasi) ? 'selected' : ''; ?>>  
                                    <?php echo $lokasi->nama_provinsi; ?>  
                                </option>  
                                <?php endforeach; ?>  
                            </select>  
                        </form>  
                    </div>  
  
                    <!-- Price Filter -->  
                    <div>  
                        <form method="GET" action="<?php echo base_url('user/home/index'); ?>">  
                            <select name="price_range"   
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"  
                                    onchange="this.form.submit()">  
                                <option value="">Semua Harga</option>  
                                <option value="free" <?php echo ($this->input->get('price_range') == 'free') ? 'selected' : ''; ?>>Gratis</option>  
                                <option value="paid" <?php echo ($this->input->get('price_range') == 'paid') ? 'selected' : ''; ?>>Berbayar</option>  
                                <option value="0-50000" <?php echo ($this->input->get('price_range') == '0-50000') ? 'selected' : ''; ?>>Rp 0 - 50.000</option>  
                                <option value="50000-100000" <?php echo ($this->input->get('price_range') == '50000-100000') ? 'selected' : ''; ?>>Rp 50.000 - 100.000</option>  
                                <option value="100000+" <?php echo ($this->input->get('price_range') == '100000+') ? 'selected' : ''; ?>>Rp 100.000+</option>  
                            </select>  
                        </form>  
                    </div>  
  
                    <!-- Quick Filters -->  
                    <div class="flex flex-wrap gap-2 w-full col-span-2">  
                        <button type="button"   
                                class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200 transition"  
                                onclick="filterNearby()">  
                            <i class="fas fa-map-marker-alt mr-2"></i>Terdekat  
                        </button>  
                        <button type="button"   
                                class="px-4 py-2 bg-green-100 text-green-600 rounded-full hover:bg-green-200 transition"  
                                onclick="filterToday()">  
                            <i class="fas fa-calendar-day mr-2"></i>Hari Ini  
                        </button>  
                        <button type="button"   
                                class="px-4 py-2 bg-purple-100 text-purple-600 rounded-full hover:bg-purple-200 transition"  
                                onclick="filterFree()">  
                            <i class="fas fa-ticket-alt mr-2"></i>Gratis  
                        </button>  
                    </div>  
                </div>  
            </form>  
        </div>  
    </section>  
  
    <!-- Featured Categories -->  
    <section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Kategori Populer</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Teknologi -->
            <div 
                onclick="window.location.href='?id_kategori=1';" 
                class="bg-blue-50 rounded-xl p-6 text-center hover:bg-blue-100 transition cursor-pointer">
                <i class="fas fa-laptop-code text-3xl text-blue-600 mb-3"></i>
                <h3 class="font-semibold">Teknologi</h3>
            </div>
            
            <!-- Bisnis -->
            <div 
                onclick="window.location.href='?id_kategori=5';" 
                class="bg-green-50 rounded-xl p-6 text-center hover:bg-green-100 transition cursor-pointer">
                <i class="fas fa-chart-line text-3xl text-green-600 mb-3"></i>
                <h3 class="font-semibold">Bisnis</h3>
            </div>
            
            <!-- Desain -->
            <div 
                onclick="window.location.href='?id_kategori=11';" 
                class="bg-purple-50 rounded-xl p-6 text-center hover:bg-purple-100 transition cursor-pointer">
                <i class="fas fa-paint-brush text-3xl text-purple-600 mb-3"></i>
                <h3 class="font-semibold">Desain</h3>
            </div>
            
            <!-- Kesehatan -->
            <div 
                onclick="window.location.href='?id_kategori=4';" 
                class="bg-red-50 rounded-xl p-6 text-center hover:bg-red-100 transition cursor-pointer">
                <i class="fas fa-heartbeat text-3xl text-red-600 mb-3"></i>
                <h3 class="font-semibold">Kesehatan</h3>
            </div>
        </div>
    </div>
</section>

  
    <!-- Horizontal Seminar Scroll -->  
    <section id="upcoming" class="py-12 bg-gray-50">
    <?php  
    if (empty($seminar_data)) {  
        echo '<div class="text-center py-8">
                <p class="text-gray-600">Tidak ada seminar yang ditemukan.</p>
              </div>';  
    } else {
        $seminar_tersisa = array_filter($seminar_data, fn($s) => !$s->is_slot_habis);
        $jumlah_seminar_tersisa = count($seminar_tersisa);
        echo '<div class="text-center py-4">
                <p class="text-gray-800 font-semibold">
                    Ada <span class="text-blue-600">' . $jumlah_seminar_tersisa . '</span> seminar dengan slot tersedia.
                </p>
              </div>';
    }
    ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold gradient-text">Seminar Mendatang</h2>
            <p class="text-gray-600 mt-2">Geser untuk melihat lebih banyak seminar</p>
        </div>

        <div class="relative">
            <div class="overflow-x-auto scrollbar-hide cursor-grab active:cursor-grabbing" id="seminar-scroll">
                <div class="flex space-x-6 pb-4">
                    <?php foreach ($seminar_data as $seminar): ?>
                    <div class="flex-none w-80">
                        <div class="bg-white rounded-xl card-shadow hover:shadow-xl transition-all duration-300">
                            <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>"
                                 class="w-full h-48 object-cover rounded-t-xl"
                                 alt="<?php echo $seminar->nama_seminar; ?>">
                            <div class="p-6">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">
                                    <?php echo $seminar->nama_seminar; ?>
                                </h3>
                                <!-- Nama Vendor -->
                                <p class="text-sm text-gray-500 ">
                                    Oleh: <span class="text-gray-700 font-medium"><?php echo $seminar->nama_vendor; ?></span>
                                </p>
                                <div class="flex items-center space-x-2 text-sm text-gray-600 ">
                                    <i class="fas fa-calendar"></i>
                                    <span><?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?></span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="flex items-center space-x-3 bg-gray-50 rounded-lg md:p-3 p-1 mb-1">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="h-full rounded-full transition-all duration-500
                                            <?php   
                                                if ($seminar->remaining_days <= 7) {  
                                                    echo 'bg-red-500';  
                                                } else if ($seminar->remaining_days <= 14) {  
                                                    echo 'bg-yellow-500';  
                                                } else {  
                                                    echo 'bg-green-500';  
                                                }  
                                            ?>"
                                            style="width: <?php echo number_format($seminar->progress, 0); ?>%">
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 min-w-fit">
                                        <i class="fas fa-clock text-gray-600"></i>
                                        <span class="font-bold
                                            <?php  
                                                if ($seminar->remaining_days <= 7) echo 'text-red-500';  
                                                else if ($seminar->remaining_days <= 14) echo 'text-yellow-500';   
                                                else echo 'text-green-500';  
                                            ?>">
                                            <?php echo $seminar->remaining_days; ?>
                                        </span>
                                        <span class="text-sm text-gray-600">Hari tersisa</span>
                                    </div>
                                </div>

                                <!-- Price and Action Buttons -->
                                <div class="flex flex-col items-start justify-between w-full gap-3">
                                    <span class="text-blue-600 font-semibold">
                                        Rp <?php echo number_format($seminar->harga_tiket, 0, ',', '.'); ?>
                                    </span>
                                    <div class="flex flex-row gap-3 items-center w-full">
                                        <?php if ($seminar->is_history): ?>
                                            <a href="<?php echo base_url('user/home/seminar_history/' . $seminar->id_seminar); ?>"
                                               class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                                <i class="fas fa-history"></i> History
                                            </a>
                                        <?php elseif ($seminar->is_slot_habis): ?>
                                            <button class="px-4 py-2 bg-red-100 text-red-600 rounded-lg cursor-not-allowed" disabled>
                                                <i class="fas fa-times"></i> Habis
                                            </button>
                                        <?php elseif (isset($seminar->is_registered) && $seminar->id_stsbyr == 1): ?>
                                            <button class="px-4 py-2 bg-gray-100 w-full text-gray-600 rounded-lg cursor-not-allowed" disabled>
                                                <i class="fas fa-check"></i> Diikuti
                                            </button>
                                        <?php elseif ($seminar->is_registered): ?>
                                            <a href="<?php echo base_url('payment/bayar/' . $seminar->id_seminar); ?>"
                                               class="px-4 py-2 bg-yellow-500 w-full text-center text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                                <i class="fas fa-money-bill"></i> Bayar
                                            </a>
                                        <?php else: ?>
                                            <button class="daftar-seminar px-4 py-2 w-full text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200"
                                                    onclick="window.location.href='<?php echo base_url('user/home/daftar/' . $seminar->id_seminar); ?>'">
                                                <i class="fas fa-user-plus"></i> Daftar
                                            </button>
                                        <?php endif; ?>

                                        <a href="<?php echo base_url('user/home/detail/' . $seminar->id_seminar); ?>"
                                           class="px-4 py-2 w-full bg-blue-500 text-white text-center rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- All Seminars Section -->  
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold gradient-text">Semua Seminar</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach ($seminar_data as $seminar): ?>
            <div class="bg-white rounded-xl card-shadow hover:shadow-xl transition-all duration-300">
                <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>"
                     class="w-full h-48 object-cover rounded-t-xl"
                     alt="<?php echo $seminar->nama_seminar; ?>">
                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">
                        <?php echo $seminar->nama_seminar; ?>
                    </h3>
                    <!-- Nama Vendor -->
                    <p class="text-sm text-gray-500 mb-4">
                        Oleh: <span class="text-gray-700 font-medium"><?php echo $seminar->nama_vendor; ?></span>
                    </p>
                    <div class="flex items-center space-x-2 text-sm text-gray-600 mb-4">
                        <i class="fas fa-calendar"></i>
                        <span><?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?></span>
                    </div>

                    <!-- Price and Action Buttons -->
                    <div class="flex flex-col items-start justify-between w-full gap-3">
                        <span class="text-blue-600 font-semibold">
                            Rp <?php echo number_format($seminar->harga_tiket, 0, ',', '.'); ?>
                        </span>
                        <div class="flex flex-row gap-3 items-center w-full">
                            <?php if ($seminar->is_slot_habis): ?>
                                <button class="px-4 py-2 bg-red-100 text-red-600 rounded-lg cursor-not-allowed" disabled>
                                    <i class="fas fa-times"></i> Habis
                                </button>
                            <?php elseif ($seminar->is_registered): ?>
                                <button class="px-4 py-2 bg-gray-100 w-full text-gray-600 rounded-lg cursor-not-allowed" disabled>
                                    <i class="fas fa-check"></i> Diikuti
                                </button>
                            <?php else: ?>
                                <button class="daftar-seminar px-4 py-2 w-full text-center bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200"
                                        onclick="window.location.href='<?php echo base_url('user/home/daftar/' . $seminar->id_seminar); ?>'">
                                    <i class="fas fa-user-plus"></i> Daftar
                                </button>
                            <?php endif; ?>

                            <a href="<?php echo base_url('user/home/detail/' . $seminar->id_seminar); ?>"
                               class="px-4 py-2 w-full bg-blue-500 text-white text-center rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

  
    <!-- Why Choose Us -->  
    <section class="py-12 bg-white">  
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">  
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Mengapa Memilih Kami?</h2>  
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">  
                <div class="text-center">  
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">  
                        <i class="fas fa-certificate text-2xl text-blue-600"></i>  
                    </div>  
                    <h3 class="text-xl font-semibold mb-2">Sertifikat Resmi</h3>  
                    <p class="text-gray-600">Dapatkan sertifikat resmi yang diakui untuk setiap seminar yang Anda ikuti</p>  
                </div>  
                <div class="text-center">  
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">  
                        <i class="fas fa-users text-2xl text-green-600"></i>  
                    </div>  
                    <h3 class="text-xl font-semibold mb-2">Pembicara Ahli</h3>  
                    <p class="text-gray-600">Belajar langsung dari para ahli dan praktisi terbaik di bidangnya</p>  
                </div>  
                <div class="text-center">  
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">  
                        <i class="fas fa-clock text-2xl text-purple-600"></i>  
                    </div>  
                    <h3 class="text-xl font-semibold mb-2">Fleksibel</h3>  
                    <p class="text-gray-600">Ikuti seminar sesuai jadwal dan kebutuhan Anda</p>  
                </div>  
            </div>  
        </div>  
    </section>  
  
    <!-- Testimonials -->  
    <section class="py-12 bg-gray-50">  
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">  
            <?php foreach ($testimonials as $testimonial): ?>  
            <div class="bg-white p-6 rounded-xl shadow-md">  
                <div class="flex items-center mb-4">  
                    <img src="<?php echo $testimonial['avatar']; ?>" class="w-12 h-12 rounded-full" alt="Avatar">  
                    <div class="ml-4">  
                        <h4 class="font-semibold"><?php echo $testimonial['name']; ?></h4>  
                        <div class="flex text-yellow-400">  
                            <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>  
                                <i class="fas fa-star"></i>  
                            <?php endfor; ?>  
                        </div>  
                    </div>  
                </div>  
                <p class="text-gray-600"><?php echo $testimonial['content']; ?></p>  
            </div>  
            <?php endforeach; ?>  
        </div>  
    </section>  
  
    <!-- CTA Section -->  
    <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">  
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">  
            <h2 class="text-3xl font-bold text-white mb-4">Siap untuk Memulai?</h2>  
            <p class="text-xl text-gray-100 mb-8">Daftar sekarang dan kembangkan potensi Anda bersama kami</p>  
            <a href="daftar" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition" id="startNowButton">  
                Mulai Sekarang  
            </a>  
        </div>  
    </section>  
  
    <script>  
        // Function to check login status and redirect if not logged in  
        function checkLoginAndRegister(seminarId) {  
            <?php if (!$this->session->userdata('user_data')): ?>  
                // Jika pengguna belum login, arahkan ke halaman login  
                window.location.href = '<?php echo base_url('user/auth'); ?>';  
            <?php else: ?>  
                // Jika pengguna sudah login, lanjutkan dengan pendaftaran seminar  
                console.log("Mendaftar seminar ID: " + seminarId);  
                // Tambahkan logika pendaftaran seminar di sini  
            <?php endif; ?>  
        }  
  
        // Mulai Sekarang Button  
        document.getElementById('startNowButton').addEventListener('click', function() {  
            <?php if (!$this->session->userdata('user_data')): ?>  
                // Jika pengguna belum login, arahkan ke halaman login  
                window.location.href = '<?php echo base_url('user/auth'); ?>';  
            <?php else: ?>  
                // Jika pengguna sudah login, lakukan tindakan lain jika diperlukan  
                console.log("Pengguna sudah login, lakukan tindakan lain jika diperlukan.");  
            <?php endif; ?>  
        });  
  
        // Add smooth scrolling behavior for seminar cards  
        const scrollContainer = document.getElementById('seminar-scroll');  
        let isDown = false;  
        let startX;  
        let scrollLeft;  
  
        scrollContainer.addEventListener('mousedown', (e) => {  
            isDown = true;  
            scrollContainer.style.cursor = 'grabbing';  
            startX = e.pageX - scrollContainer.offsetLeft;  
            scrollLeft = scrollContainer.scrollLeft;  
        });  
  
        scrollContainer.addEventListener('mouseleave', () => {  
            isDown = false;  
            scrollContainer.style.cursor = 'grab';  
        });  
  
        scrollContainer.addEventListener('mouseup', () => {  
            isDown = false;  
            scrollContainer.style.cursor = 'grab';  
        });  
  
        scrollContainer.addEventListener('mousemove', (e) => {  
            if (!isDown) return;  
            e.preventDefault();  
            const x = e.pageX - scrollContainer.offsetLeft;  
            const walk = (x - startX) * 2;  
            scrollContainer.scrollLeft = scrollLeft - walk;  
        });  
  
        // Flash Messages  
        <?php if ($this->session->flashdata('message_success')): ?>  
            Swal.fire({  
                icon: 'success',  
                title: 'Berhasil',  
                text: '<?php echo $this->session->flashdata('message_success'); ?>',  
                showConfirmButton: false,  
                timer: 2000  
            });  
        <?php endif; ?>  
  
        <?php if ($this->session->flashdata('message_error')): ?>  
            Swal.fire({  
                icon: 'error',  
                title: 'Gagal',  
                text: '<?php echo $this->session->flashdata('message_error'); ?>',  
                showConfirmButton: false,  
                timer: 2000  
            });  
        <?php endif; ?>  
  
        function filterNearby() {  
            if (navigator.geolocation) {  
                navigator.geolocation.getCurrentPosition(function(position) {  
                    // Here you would typically send these coordinates to your backend  
                    // and filter seminars based on distance  
                    const lat = position.coords.latitude;  
                    const lng = position.coords.longitude;  
                      
                    // Add these as hidden inputs to your form and submit  
                    const form = document.createElement('form');  
                    form.method = 'GET';  
                    form.action = '<?php echo base_url('user/home/index'); ?>';  
                      
                    const latInput = document.createElement('input');  
                    latInput.type = 'hidden';  
                    latInput.name = 'lat';  
                    latInput.value = lat;  
                      
                    const lngInput = document.createElement('input');  
                    lngInput.type = 'hidden';  
                    lngInput.name = 'lng';  
                    lngInput.value = lng;  
                      
                    form.appendChild(latInput);  
                    form.appendChild(lngInput);  
                    document.body.appendChild(form);  
                    form.submit();  
                });  
            } else {  
                alert('Geolocation is not supported by this browser.');  
            }  
        }  
  
        function filterToday() {  
            window.location.href = '<?php echo base_url('user/home/index'); ?>?date=today';  
        }  
  
        function filterFree() {  
            window.location.href = '<?php echo base_url('user/home/index'); ?>?price_range=free';  
        }  
    </script>  
</body>  
</html>  
