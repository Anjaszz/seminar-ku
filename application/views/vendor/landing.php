<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <title>Landing Vendor | Simaseminar – Solusi Manajemen Seminar & Webinar</title>
    <meta name="description" content="Simaseminar adalah platform manajemen seminar berbasis web yang membantu peserta menemukan dan mendaftar seminar dengan mudah. Vendor dapat mengelola acara, registrasi, dan sertifikat secara otomatis dalam satu sistem efisien. Kunjungi sekarang">
    <meta property="og:title" content="Simaseminar – Solusi Manajemen Seminar & Webinar">
<meta property="og:description" content="Kelola seminar dengan mudah! Simaseminar membantu peserta menemukan dan mendaftar seminar, serta mempermudah vendor mengelola acara, registrasi, dan sertifikat secara otomatis.">
<meta property="og:image" content="https://simaseminar.web.id/assets/backend/template/assets/images/SIMAS.png">
<meta property="og:url" content="https://simaseminar.web.id">
<meta property="og:type" content="website">
<meta name="keywords" content="manajemen seminar, platform seminar, pendaftaran seminar, event management, sertifikat online, webinar, Simaseminar">
<meta name="robots" content="index, follow">
<link href="<?= base_url('assets/css/animation-landingvendor.css'); ?>" rel="stylesheet">
</head>

<body>
    
<header class="fixed w-full z-50">
    <nav class="bg-white border-gray-200 py-5 dark:bg-gray-900 shadow-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen px-4 mx-auto">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="flex items-center">
                <img src="<?= base_url('assets/images/fav.png') ?>" class="h-6 mr-3 sm:h-9" alt="SIMAS Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">SIMAS</span>
            </a>

            <div class="sm:flex  gap-4 lg:order-2 hidden">
                    <a href="<?= site_url('daftar/vendor'); ?>" class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 focus:outline-none dark:focus:ring-purple-800 shadow-lg hover:shadow-purple-500/50 dark:shadow-lg dark:hover:shadow-purple-800/80 transform hover:-translate-y-0.5 active:translate-y-0 group">
                        <span class="relative flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Daftar
                        </span>
                    </a>

                    <a href="<?= site_url('auth/login'); ?>" class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium transition-all duration-300 ease-in-out bg-white text-purple-600 border-2 border-purple-600 rounded-lg hover:bg-purple-50 focus:ring-4 focus:ring-purple-300 focus:outline-none dark:bg-gray-800 dark:text-purple-400 dark:border-purple-400 dark:hover:bg-gray-700 dark:focus:ring-purple-800 shadow-lg hover:shadow-purple-500/30 dark:shadow-lg dark:hover:shadow-purple-800/60 transform hover:-translate-y-0.5 active:translate-y-0 group">
                        <span class="relative flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Masuk
                        </span>
                    </a>
                </div>

            <!-- Toggle Button for Mobile -->
            <button type="button" onclick="toggleMenu()" class="inline-flex items-center p-2 mr-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Menu -->
            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <!-- Menu List -->
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="" class="block py-2 pl-3 pr-4 text-black bg-purple-700 rounded lg:bg-transparent lg:p-0 dark:text-white">Home</a>
                    </li>
                    <li>
                        <a href="#testimoni" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Testimoni</a>
                    </li>
                    <li>
                        <a href="#price" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Harga</a>
                    </li>
                    <li>
                        <a href="#feature" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Fitur</a>
                    </li>
                    <li>
                        <a href="https://wa.me/6282258040148" class="block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-purple-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Kontak</a>
                    </li>
                </ul>

                <!-- Buttons for Mobile -->
                <div class="flex flex-col gap-4 mt-4 lg:hidden mx-2">
                    <a href="<?= site_url('daftar/vendor'); ?>" class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 focus:outline-none dark:focus:ring-purple-800 shadow-lg hover:shadow-purple-500/50 dark:shadow-lg dark:hover:shadow-purple-800/80 transform hover:-translate-y-0.5 active:translate-y-0 group">
                        <span class="relative flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Daftar
                        </span>
                    </a>

                    <a href="<?= site_url('auth/login'); ?>" class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium transition-all duration-300 ease-in-out bg-white text-purple-600 border-2 border-purple-600 rounded-lg hover:bg-purple-50 focus:ring-4 focus:ring-purple-300 focus:outline-none dark:bg-gray-800 dark:text-purple-400 dark:border-purple-400 dark:hover:bg-gray-700 dark:focus:ring-purple-800 shadow-lg hover:shadow-purple-500/30 dark:shadow-lg dark:hover:shadow-purple-800/60 transform hover:-translate-y-0.5 active:translate-y-0 group">
                        <span class="relative flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Masuk
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<section id="1" class="container mx-auto px-4 py-24 md:py-24 overflow-hidden">
    <div class="grid items-center gap-8 md:grid-cols-2">
        <!-- Left Column -->
        <div class="flex flex-col gap-6 animate-slide-in">
            <h1 class="text-4xl text-gray-800 font-extrabold tracking-tight sm:text-5xl md:text-6xl">
                Kelola Seminar Anda dengan Mudah
            </h1>
            <p class="text-lg text-gray-600">
                Platform modern untuk mengatur seminar, mulai dari registrasi hingga laporan akhir, semuanya dalam satu tempat.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="<?= site_url('daftar/vendor'); ?>" 
                   class="hover-arrow scale-on-hover inline-flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 text-white text-lg font-bold rounded-lg hover:bg-blue-800">
                    Daftar Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor" 
                         class="w-5 h-5">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="4" 
                              d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        <!-- Right Column -->
        <div class="relative mx-auto w-full max-w-lg animate-slide-in-right">
            <div class="animate-float">
                <img src="<?= base_url('assets/images/heroimage.svg'); ?>"
                     alt="Digital products and brands illustration"
                     class="w-full h-auto"/>
            </div>
        </div>
    </div>
</section>

    
  
<section id="2" class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-md mx-auto py-8 lg:py-16">
        <h2 class="text-center text-xl font-semibold text-gray-700 dark:text-gray-300 mb-6 sponsor-animate">
            Patner Kami
        </h2>
        <div class="grid grid-cols-3 sm:gap-6 gap-1 items-center">
            <!-- Sponsor 1 -->
            <a href="#" class="sponsor-animate sponsor-hover flex items-center justify-center p-3 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">
                <img 
                    src="<?= base_url('assets/images/SIMAS.png') ?>" 
                    alt="Logo SIMAS" 
                    class="sm:h-16 h-10 w-auto object-contain" 
                />
            </a>
            <!-- Sponsor 2 -->
            <a href="#" class="sponsor-animate sponsor-hover flex items-center justify-center p-3 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">
                <img 
                    src="<?= base_url('assets/images/logo-unm.png') ?>" 
                    alt="Logo UNM" 
                    class="sm:h-16 h-10 w-auto object-contain" 
                />
            </a>
            <!-- Sponsor 3 -->
            <a href="#" class="sponsor-animate sponsor-hover flex items-center justify-center p-3 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">
                <img 
                    src="<?= base_url('assets/images/logo-nic.png') ?>" 
                    alt="Logo NIC" 
                    class="sm:h-16 h-10 w-auto object-contain" 
                />
            </a>
        </div>
    </div>
</section>

    
  
<section id="feature" class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-screen-xl px-4 py-16 mx-auto space-y-16 lg:py-24 lg:px-6">
            <!-- First Feature Section -->
            <div class="relative feature-card">
                <!-- Decorative background -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-100/50 to-blue-100/50 dark:from-purple-900/20 dark:to-blue-900/20 rounded-3xl opacity-20"></div>
                
                <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16 relative">
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                            Mengapa anda harus memilih SIMAS?
                        </h2>
                        <p class="text-lg text-gray-500 dark:text-gray-400">
                            Temukan berbagai keunggulan yang menjadikan SIMAS solusi terbaik untuk manajemen seminar Anda.
                        </p>
                    </div>

                    <ul class="space-y-4 border-t border-gray-200 dark:border-gray-700 pt-8">
                    <li class="feature-item flex items-center gap-3">
                                <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-base font-medium text-gray-900 dark:text-white">
                                    Presensi kehadiran dengan QR Code
                                </span>
                            </li>
                            <li class="feature-item flex items-center gap-3">
                                <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-base font-medium text-gray-900 dark:text-white">
                                    Laporan Seminar Otomatis
                                </span>
                            </li>
                            <li class="feature-item flex items-center gap-3">
                                <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-base font-medium text-gray-900 dark:text-white">
                                    Antarmuka Mudah Digunakan
                                </span>
                            </li>
                            <li class="feature-item flex items-center gap-3">
                                <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-base font-medium text-gray-900 dark:text-white">
                                    Generate otomatis Sertifikat
                                </span>
                            </li>
                        </ul>

                        <p class="text-lg text-gray-500 dark:text-gray-400">
                            Semua fitur ini dirancang untuk memberikan pengalaman seminar yang lebih mudah, cepat, dan profesional. Pilih SIMAS sebagai partner terbaik Anda
                        </p>
                    </div>

                    <div class="mt-8 lg:mt-0">
                        <div class="overflow-hidden rounded-2xl shadow-xl">
                            <img class="w-full h-full object-cover" src="<?= base_url('assets/images/image-1.png') ?>" alt="Feature illustration" />
                        </div>
                    </div>
                </div>
            </div>

          
          <!-- Second Feature Section -->
<div class="relative feature-card">
    <!-- Decorative background -->
    <div class="absolute inset-0 bg-gradient-to-r from-purple-100/50 to-blue-100/50 dark:from-purple-900/20 dark:to-blue-900/20 rounded-3xl opacity-20"></div>
    
    <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16 relative">
        <div class="space-y-8 lg:order-2">
            <div class="space-y-4">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    Keunggulan yang Kami Tawarkan
                </h2>
                <p class="text-lg text-gray-500 dark:text-gray-400">
                    Kami menghadirkan solusi inovatif yang dirancang untuk memberikan pengalaman seminar terbaik.
                </p>
            </div>

            <ul class="space-y-4 border-t border-gray-200 dark:border-gray-700 pt-8">
                <li class="feature-item flex items-center gap-3">
                    <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-base font-medium text-gray-900 dark:text-white">
                        Akses Kapan Saja dan di Mana Saja
                    </span>
                </li>
                <li class="feature-item flex items-center gap-3">
                    <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-base font-medium text-gray-900 dark:text-white">
                        Manajemen Data Terintegrasi
                    </span>
                </li>
                <li class="feature-item flex items-center gap-3">
                    <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-base font-medium text-gray-900 dark:text-white">
                        Notifikasi Real-Time
                    </span>
                </li>
                <li class="feature-item flex items-center gap-3">
                    <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-base font-medium text-gray-900 dark:text-white">
                        Dukungan Pelaporan Visual
                    </span>
                </li>
                <li class="feature-item flex items-center gap-3">
                    <svg class="w-5 h-5 text-purple-500 dark:text-purple-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-base font-medium text-gray-900 dark:text-white">
                        Skalabilitas untuk Berbagai Kebutuhan
                    </span>
                </li>
            </ul>

            <p class="text-lg text-gray-500 dark:text-gray-400">
                Gabungkan teknologi modern dan kemudahan manajemen dengan SIMAS. Pastikan setiap seminar yang Anda kelola berjalan lancar tanpa hambatan.
            </p>
        </div>

        <div class="mt-8 lg:mt-0 lg:order-1">
            <div class="overflow-hidden rounded-2xl shadow-xl feature-image-left">
                <img class="w-full h-full object-cover feature-image-hover" 
                     src="<?= base_url('assets/images/image-2.png') ?>" 
                     alt="Feature illustration" />
            </div>
        </div>
    </div>
</div>
        </div>
    </section>
    
  
    <section class="bg-white dark:bg-gray-900" id='testimoni'>
    <div class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-4 lg:gap-16 xl:gap-24 lg:py-24 lg:px-6">
        <div class="col-span-2 mb-8 testimoni-header">
            <p class="text-lg font-medium text-purple-600 dark:text-purple-500">Testimoni</p>
            <h2 class="mt-3 mb-4 text-3xl font-extrabold tracking-tight text-gray-900 md:text-3xl dark:text-white">
                SIMAS Telah Dipercaya oleh Banyak Pihak
            </h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                Ratusan seminar sukses telah kami bantu kelola dengan teknologi yang andal dan layanan terbaik.
            </p>
            <div class="pt-6 mt-6 space-y-4 border-t border-gray-200 dark:border-gray-700">
            </div>
        </div>
        <div class="col-span-2 space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0">
            <!-- Stats Card 1 -->
            <div class="stats-card testimoni-stats p-4 rounded-lg">
                <svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500 testimoni-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="mb-2 text-2xl font-bold dark:text-white">99% Kepuasan Pelanggan</h3>
                <p class="font-light text-gray-500 dark:text-gray-400">Mayoritas pengguna kami merasa puas dengan fitur, layanan, dan kemudahan yang ditawarkan SIMAS.</p>
            </div>

            <!-- Stats Card 2 -->
            <div class="stats-card testimoni-stats p-4 rounded-lg">
                <svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500 testimoni-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                <h3 class="mb-2 text-2xl font-bold dark:text-white">200k+ Peserta</h3>
                <p class="font-light text-gray-500 dark:text-gray-400">Lebih dari 200 ribu peserta telah menghadiri seminar yang dikelola melalui SIMAS, memastikan setiap acara berjalan lancar.</p>
            </div>

            <!-- Stats Card 3 -->
            <div class="stats-card testimoni-stats p-4 rounded-lg">
                <svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500 testimoni-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="mb-2 text-2xl font-bold dark:text-white">100+ Seminar Berhasil Dikelola</h3>
                <p class="font-light text-gray-500 dark:text-gray-400">Mulai dari seminar pendidikan hingga konferensi bisnis berskala besar, SIMAS telah menjadi solusi utama bagi penyelenggara.</p>
            </div>

            <!-- Stats Card 4 -->
            <div class="stats-card testimoni-stats p-4 rounded-lg">
                <svg class="w-10 h-10 mb-2 text-purple-600 md:w-12 md:h-12 dark:text-purple-500 testimoni-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                </svg>
                <h3 class="mb-2 text-2xl font-bold dark:text-white">50+ Institusi dan Perusahaan</h3>
                <p id="price" class="font-light text-gray-500 dark:text-gray-400">Berbagai institusi pendidikan, organisasi, dan perusahaan telah menggunakan SIMAS untuk menyelenggarakan acara mereka dengan mudah.</p>
            </div>
        </div>
    </div>
</section>
    
  
    
<section  class="bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                Investasi untuk Kesuksesan Seminar Anda
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300">
                Pilih paket yang sesuai dengan kebutuhan Anda. Nikmati kemudahan mengelola seminar dengan SIMAS.
            </p>
        </div>

        <!-- Pricing Cards -->
        <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">
    <!-- Starter Plan -->
    <div  class="pricing-card rounded-2xl bg-white dark:bg-gray-800 shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Starter</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Mulai perjalanan seminar Anda dengan fitur lengkap
            </p>
            <div class="flex items-center justify-center mb-6">
                <span class="text-4xl font-bold text-gray-900 dark:text-white">Rp</span>
                <span class="text-5xl font-bold text-gray-900 dark:text-white mx-2">50.000</span>
                <span class="text-gray-500 dark:text-gray-400">/3 Bulan</span>
            </div>
        </div>

        <ul class="space-y-4 mb-8">
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Akses ke semua fitur premium SIMAS
                </span>
            </li>
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Manajemen seminar yang mudah
                </span>
            </li>
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Sistem pendaftaran otomatis
                </span>
            </li>
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Dukungan pelanggan
                </span>
            </li>
        </ul>

        <a href="<?= site_url('daftar/vendor'); ?>">
        <button  class="w-full py-4 px-6 rounded-xl font-medium transition-colors duration-200 bg-purple-100 hover:bg-purple-200 text-purple-600 dark:bg-purple-900 dark:hover:bg-purple-800 dark:text-purple-100">
        Mulai Sekarang
        </button>
        </a>
    </div>

    <!-- Popular Plan -->
    <div class="pricing-card rounded-2xl bg-white dark:bg-gray-800 shadow-xl border-2 border-purple-500 transform lg:-translate-y-4 p-8 transition-all duration-300 hover:shadow-xl">
        <div class="absolute -top-5 left-0 right-0 mx-auto w-32 rounded-full bg-purple-500 text-white text-sm py-1 text-center font-medium">
            Terpopuler
        </div>

        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Popular</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Solusi terpopuler untuk seminar berkala
            </p>
            <div class="flex items-center justify-center mb-6">
                <span class="text-4xl font-bold text-gray-900 dark:text-white">Rp</span>
                <span class="text-5xl font-bold text-gray-900 dark:text-white ">70.000</span>
                <span class="text-gray-500 dark:text-gray-400">/6 Bulan</span>
            </div>
        </div>

        <ul class="space-y-4 mb-8">
            <li class="flex items-center hover:animate-bounce transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Semua fitur Starter
                </span>
            </li>
            <li class="flex items-center hover:animate-bounce transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Dashboard analitik lengkap
                </span>
            </li>
            <li class="flex items-center hover:animate-bounce transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Prioritas dukungan pelanggan
                </span>
            </li>
            <li class="flex items-center hover:animate-bounce transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Update fitur terbaru
                </span>
            </li>
        </ul>
        <a href="<?= site_url('daftar/vendor'); ?>">
        <button  class="w-full py-4 px-6 rounded-xl font-medium transition-colors duration-200 bg-purple-600 hover:bg-purple-200 text-white dark:bg-purple-900 dark:hover:bg-purple-800 dark:text-purple-100">
        Mulai Sekarang
        </button>
        </a>
    </div>

    <!-- Professional Plan -->
    <div class="pricing-card rounded-2xl bg-white dark:bg-gray-800 shadow-lg p-8 transition-all duration-300 hover:shadow-xl">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Professional</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Untuk penyelenggara seminar profesional
            </p>
            <div class="flex items-center justify-center mb-6">
                <span class="text-4xl font-bold text-gray-900 dark:text-white">Rp</span>
                <span class="text-5xl font-bold text-gray-900 dark:text-white ">100.000</span>
                <span class="text-gray-500 dark:text-gray-400">/1 Tahun</span>
            </div>
        </div>

        <ul class="space-y-4 mb-8">
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Semua fitur Popular
                </span>
            </li>
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Laporan analitik khusus
                </span>
            </li>
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Dukungan prioritas 24/7
                </span>
            </li>
            <li class="flex items-center hover:animate-pulse transition-transform duration-200 hover:scale-105">
                <i class="far fa-check-circle check-icon fa-lg" style="color: #00f0a8;"></i>
                <span class="text-gray-600 dark:text-gray-300 ml-3">
                    Fitur kustomisasi lanjutan
                </span>
            </li>
        </ul>

        <a href="<?= site_url('daftar/vendor'); ?>">
        <button  class="w-full py-4 px-6 rounded-xl font-medium transition-colors duration-200 bg-purple-100 hover:bg-purple-200 text-purple-600 dark:bg-purple-900 dark:hover:bg-purple-800 dark:text-purple-100">
        Mulai Sekarang
        </button>
        </a>
       
    </div>
</div>



        <!-- Footer CTA -->
        <div class="mt-12 text-center">
            <p class="text-gray-500 dark:text-gray-400">
                Butuh solusi khusus? 
                <a href="#contact" class="text-purple-600 hover:text-purple-700 font-medium">
                    Hubungi kami
                </a>
            </p>
        </div>
    </div>
</section>
  
   
<section class="relative overflow-hidden bg-gradient-to-b from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 py-16 sm:py-24">
    <!-- Gradient Blurs -->
    <div class="gradient-blur top-0 left-1/4 opacity-75"></div>
    <div class="gradient-blur bottom-0 right-1/4 opacity-75"></div>

    <div class="relative max-w-screen-xl px-4 mx-auto">
        <div class="max-w-screen-md mx-auto text-center">
            <!-- Price Badge -->
            <div class="inline-block price-badge">
                <div class="mb-8 inline-flex items-center justify-center px-4 py-2 bg-purple-100 dark:bg-purple-900/30 rounded-full">
                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.616a1 1 0 01.894-1.79l1.599.8L9 4.323V3a1 1 0 011-1z"/>
                    </svg>
                    <span class="text-sm font-semibold text-purple-600 dark:text-purple-400">Mulai dengan hanya Rp.50.000</span>
                </div>
            </div>

            <!-- Main Content -->
            <h2 class="mb-6 text-4xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white md:text-5xl">
                Siap Mengelola Seminar Anda dengan SIMAS?
            </h2>
            
            <p class="mb-8 text-lg font-normal text-gray-600 dark:text-gray-300 lg:text-xl">
                Jangan tunggu lebih lama lagi! Daftar sekarang dan nikmati kemudahan dalam mengelola seminar dengan SIMAS. 
                <span class="block mt-4">
                    Dengan akses seumur hidup, Anda dapat menikmati berbagai fitur canggih yang akan mempermudah setiap tahap seminar Anda.
                </span>
            </p>

            <!-- Features List -->
            <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-left">
                <div class="feature-box flex items-center space-x-3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">Pendaftaran Peserta</span>
                </div>
                <div class="feature-box flex items-center space-x-3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">Sertifikat Digital</span>
                </div>
                <div class="feature-box flex items-center space-x-3 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-gray-700 dark:text-gray-300">Laporan Lengkap</span>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <a href="<?= site_url('daftar/vendor'); ?>" class="cta-button inline-flex items-center justify-center px-8 py-4 text-base font-medium text-white bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl hover:from-purple-700 hover:to-indigo-700 focus:ring-4 focus:ring-purple-300 focus:outline-none dark:focus:ring-purple-800 shadow-lg">
                    <span>Gabung Sekarang</span>
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                <p class="text-sm text-gray-500 dark:text-gray-400">Mulai kelola seminar Anda dengan lebih profesional</p>
            </div>
        </div>
    </div>
</section>


    <footer class="bg-white text-black py-8">
  <div class="container mx-auto">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full lg:w-1/4 px-4 mb-8">
        <img src="<?php echo base_url('assets/backend/template/assets/images/SIMAS.png'); ?>" alt="Logo" class="mb-4 max-w-[150px]">
        <p class="text-gray-600">Sistem Manajemen Seminar</p>
        <div class="flex space-x-4 mt-4">
          <a href="#" class="hover:opacity-80 transition-opacity duration-200">
            <img src="<?php echo base_url('assets/images/appstore.svg'); ?>" alt="App Store" class="h-12">
          </a>
          <a href="#" class="hover:opacity-80 transition-opacity duration-200">
            <img src="<?php echo base_url('assets/images/googleplay.svg'); ?>" alt="Play Store" class="h-12">
          </a>
        </div>
      </div>
      <div class="w-full lg:w-1/4 px-4 mb-8">
        <h5 class="mb-4 text-xl font-bold">Menu</h5>
        <ul class="space-y-2">
          <li><a href="/landingVendor" class="text-gray-600 hover:text-black transition-colors duration-200">Beranda</a></li>
          <li><a href="/user/home" class="text-gray-600 hover:text-black transition-colors duration-200">Cari Seminar</a></li>
          <li><a href="/landingVendor" class="text-gray-600 hover:text-black transition-colors duration-200">Tentang Kami</a></li>
          <li><a href="https://wa.me/6285711297160" class="text-gray-600 hover:text-black transition-colors duration-200">Kontak</a></li>
        </ul>
      </div>
      <div class="w-full lg:w-1/4 px-4 mb-8">
        <h5 class="mb-4 text-xl font-bold">Kontak Kami</h5>
        <p class="text-gray-600 mb-2">Jl. Raya Jatiwaringin No.2, RT.8/RW.13, Cipinang Melayu, Kec. Makasar, Kota Jakarta Timur, DKI Jakarta 13620</p>
        <p class="text-gray-600">
    Email: <a href="mailto:admin@simaseminar.web.id" class="text-blue-600 hover:underline">
    admin@simaseminar.web.id
    </a>
    <br>
    Telp: <a href="tel:+625711297160" class="text-blue-600 hover:underline">
        +62 571 1297 160
    </a>
</p>

      </div>
      <div class="w-full lg:w-1/4 px-4 mb-8">
        <h5 class="mb-4 text-xl font-bold">Ikuti Kami</h5>
        <div class="flex space-x-4">
          <a href="https://www.facebook.com/profile.php?id=61573009317299" class="text-gray-400 hover:text-black transition-colors duration-200">
            <i class="fab fa-facebook text-2xl"></i>
          </a>
          <a href="https://x.com/SimasSeminar"  class="text-gray-400 hover:text-black transition-colors duration-200">
            <i class="fab fa-twitter text-2xl"></i>  
          </a>
          <a href="https://www.instagram.com/simaseminar" class="text-gray-400 hover:text-black transition-colors duration-200">
            <i class="fab fa-instagram text-2xl"></i>
          </a>
          <a href="https://youtube.com/@simaseminar" class="text-gray-400 hover:text-black transition-colors duration-200">
            <i class="fab fa-youtube text-2xl"></i>
          </a>
        </div>
      </div>
    </div>
    <hr class="border-gray-800 my-8">
    <div class="text-center text-gray-600">
      <p>&copy; 2025 Sistem Manajemen Seminar. All rights reserved.</p>
    </div>
  </div>
</footer>

</body>
<script>
    function toggleMenu() {
        const menu = document.getElementById("mobile-menu-2");
        menu.classList.toggle("hidden");
    }
</script>

</html>