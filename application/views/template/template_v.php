<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendor | Simaseminar – Solusi Manajemen Seminar & Webinar</title>
    <meta name="description" content="Simaseminar adalah platform manajemen seminar berbasis web yang membantu peserta menemukan dan mendaftar seminar dengan mudah. Vendor dapat mengelola acara, registrasi, dan sertifikat secara otomatis dalam satu sistem efisien. Kunjungi sekarang">
    <meta property="og:title" content="Simaseminar – Solusi Manajemen Seminar & Webinar">
<meta property="og:description" content="Kelola seminar dengan mudah! Simaseminar membantu peserta menemukan dan mendaftar seminar, serta mempermudah vendor mengelola acara, registrasi, dan sertifikat secara otomatis.">
<meta property="og:image" content="https://simaseminar.web.id/assets/backend/template/assets/images/SIMAS.png">
<meta property="og:url" content="https://simaseminar.web.id">
<meta property="og:type" content="website">
<meta name="keywords" content="manajemen seminar, platform seminar, pendaftaran seminar, event management, sertifikat online, webinar, Simaseminar">
<meta name="robots" content="index, follow">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />
    
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Load other CSS dependencies -->
    <?php $this->load->view('template/css') ?>

    <!-- Custom Background Animation -->
    <style>
        .animated-bg {
            @apply fixed inset-0 -z-10;
            background: linear-gradient(-60deg, #4338ca 50%, #3b82f6 50%);
            animation: gradientSlide 8s ease-in-out infinite alternate;
        }

        .animated-bg-2 {
            @apply fixed inset-0 -z-10 opacity-60;
            background: linear-gradient(-60deg, #6366f1 50%, #2563eb 50%);
            animation: gradientSlide 12s ease-in-out infinite alternate-reverse;
        }

        .animated-bg-3 {
            @apply fixed inset-0 -z-10 opacity-40;
            background: linear-gradient(-60deg, #818cf8 50%, #60a5fa 50%);
            animation: gradientSlide 15s ease-in-out infinite alternate;
        }

        @keyframes gradientSlide {
            from {
                transform: translateX(-25%) translateY(-25%);
            }
            to {
                transform: translateX(25%) translateY(25%);
            }
        }

        /* Loading Bar Animation */
        .loading-bar {
            @apply fixed top-0 left-0 w-full h-1 bg-gray-200;
            z-index: 9999;
        }

        .loading-progress {
            @apply h-full bg-indigo-600;
            animation: loading 2s ease-in-out infinite;
            width: 0%;
        }

        @keyframes loading {
            0% { width: 0; }
            50% { width: 70%; }
            100% { width: 100%; }
        }
    </style>
</head>

<body class="min-h-full">
    <!-- Loading Bar -->
    <div class="loading-bar">
        <div class="loading-progress"></div>
    </div>

    <!-- Animated Background -->
    <div class="animated-bg"></div>
    <div class="animated-bg-2"></div>
    <div class="animated-bg-3"></div>

    <!-- Load Navbar (Sidebar) -->
    <?php $this->load->view('template/navbar') ?>

    <!-- Load Header -->
    <?php $this->load->view('template/header') ?>

    <!-- Main Content -->
    <div class="flex min-h-screen "> <!-- pt-16 accounts for fixed header height -->
        <!-- Main Container -->
        <main class="flex-1 transition-all duration-300" id="mainContent">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="">
                    <!-- Dynamic Content -->
                    <?php echo $contents ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Load JavaScript -->
    <?php $this->load->view('template/js') ?>

    <script>
        // Handle loading bar
        document.addEventListener('DOMContentLoaded', function() {
            const loadingBar = document.querySelector('.loading-bar');
            if (loadingBar) {
                setTimeout(() => {
                    loadingBar.style.display = 'none';
                }, 2000);
            }
        });

        // Ensure proper main content margin based on sidebar state
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.getElementById('mainContent');
            const sidebarNav = document.getElementById('sidebarNav');

            // Initial margin setting
            mainContent.style.marginLeft = sidebarNav.classList.contains('collapsed') ? '4rem' : '16rem';

            // Update margin when sidebar state changes
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.target.classList.contains('collapsed')) {
                        mainContent.style.marginLeft = '4rem';
                    } else {
                        mainContent.style.marginLeft = '16rem';
                    }
                });
            });

            observer.observe(sidebarNav, {
                attributes: true,
                attributeFilter: ['class']
            });
        });
    </script>
</body>
</html>