<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAS Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<nav class="fixed top-0 left-0 w-64 h-full bg-gray-900 text-white shadow-lg z-40 transition-all duration-300" id="sidebarNav">
    <div class="navbar-wrapper">
        <!-- Logo Header -->
        <div class="flex items-center justify-between py-3 pr-3 border-b border-gray-800">
            <a href="#" class="flex items-center space-x-3">
            <button id="sidebarToggle" class="text-gray-300 hover:text-white absolute -right-4 top-5 bg-gray-900 rounded-full p-1">
                <i data-feather="chevrons-left" class="w-4 h-4 transition-transform duration-300" id="toggleIcon"></i>
            </button>
                <div class="w-8 h-8 rounded bg-white overflow-hidden">
                    <img src="<?php echo base_url('assets/images/fav.png'); ?>" alt="Logo" class="w-full h-full object-cover object-center">
                </div>
                <span class="text-base font-semibold whitespace-nowrap sidebar-content">
                    <?php echo isset($nama_vendor) ? $nama_vendor : 'SIMAS'; ?>
                </span>
            </a>
            <button id="mobile-collapse" class="text-gray-300 hover:text-white md:hidden">
                <i data-feather="menu"></i>
            </button>
        </div>

        <!-- Navigation Content -->
        <div class="overflow-y-auto h-[calc(100vh-4rem)]">
            <ul class="py-4">
                <!-- Navigation Label -->
                <li class="nav-t px-4 py-2">
                    <span class="text-xs uppercase text-gray-500 font-semibold">Menu Navigasi</span>
                </li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= site_url('home') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <i data-feather="home" class="w-5 h-5"></i>
                        <span class="ml-3 nav-text">Dashboard</span>
                    </a>
                </li>

                <!-- Data Peserta -->
                <li class="nav-item">
                    <a href="<?= site_url('pendaftaran') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <i data-feather="clipboard" class="w-5 h-5"></i>
                        <span class="ml-3 nav-text">Data Peserta</span>
                    </a>
                </li>

                <!-- Data Seminar Dropdown -->
                <li class="nav-item">
                    <button onclick="toggleMenu('seminarMenu')" class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <div class="flex items-center">
                            <i data-feather="mic" class="w-5 h-5"></i>
                            <span class="ml-3 nav-text">Data Seminar</span>
                        </div>
                        <i data-feather="chevron-down" class="w-4 h-4 transition-transform"></i>
                    </button>
                    <ul id="seminarMenu" class="hidden bg-gray-800">
                        <li><a href="<?= site_url('seminar') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Data Seminar</a></li>
                        <li><a href="<?= site_url('tiket') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Data Tiket</a></li>
                        <li><a href="<?= site_url('pembicara') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Data Pembicara</a></li>
                        <li><a href="<?= site_url('sponsor') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Data Sponsor</a></li>
                    </ul>
                </li>

                <!-- Scan Presensi -->
                <li class="nav-item">
                    <a href="<?= site_url('scan') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <i data-feather="clipboard" class="w-5 h-5"></i>
                        <span class="ml-3 nav-text">Scan Presensi</span>
                    </a>
                </li>

                <!-- Laporan dan Cetak Dropdown -->
                <li class="nav-item">
                    <button onclick="toggleMenu('laporanMenu')" class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <div class="flex items-center">
                            <i data-feather="layers" class="w-5 h-5"></i>
                            <span class="ml-3 nav-text">Laporan dan Cetak</span>
                        </div>
                        <i data-feather="chevron-down" class="w-4 h-4 transition-transform"></i>
                    </button>
                    <ul id="laporanMenu" class="hidden bg-gray-800">
                        <li><a href="<?= site_url('laporan/peserta') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Peserta Seminar</a></li>
                        <li><a href="<?= site_url('laporan') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Presensi Seminar</a></li>
                        <li><a href="<?= site_url('laporankeuangan') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Keuangan</a></li>
                    </ul>
                </li>

                <!-- Upload Dropdown -->
                <li class="nav-item">
                    <button onclick="toggleMenu('uploadMenu')" class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                        <div class="flex items-center">
                            <i data-feather="file-text" class="w-5 h-5"></i>
                            <span class="ml-3 nav-text">Upload</span>
                        </div>
                        <i data-feather="chevron-down" class="w-4 h-4 transition-transform"></i>
                    </button>
                    <ul id="uploadMenu" class="hidden bg-gray-800">
                        <li><a href="<?= site_url('sertifikat') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Upload Sertifikat</a></li>
                        <li><a href="<?= site_url('file') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12">Upload File</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<style>
    .sidebar-collapsed {
        width: 4rem !important;
    }
    
    #sidebarNav.collapsed .sidebar-content {
        display: none !important;
    }
    
    #sidebarNav.collapsed .nav-text {
        display: none !important;
    }
    
    #sidebarNav.collapsed .nav-item .pcoded-submenu {
        display: none !important;
    }
    #sidebarNav.collapsed .nav-t {
        display: none !important;
    }

    #sidebarNav.collapsed .feather {
        margin: 0 auto;
        width: 1.5rem;
        height: 1.5rem;
    }
    
    #sidebarNav.collapsed #sidebarToggle {
        right: -4px;
    }

    #sidebarNav.collapsed .nav-item a {
        justify-content: center;
        padding: 0.75rem;
    }

    #sidebarNav.collapsed .nav-item button {
        justify-content: center;
        padding: 0.75rem;
    }
    
    #mainContent {
        margin-left: 16rem;
        transition: margin-left 0.3s;
    }
    
    #mainContent.expanded {
        margin-left: 4rem;
    }

    .nav-text {
        transition: all 0.3s;
    }
</style>

<script>
    // Initialize Feather Icons
    document.addEventListener('DOMContentLoaded', function() {
        feather.replace();
    });

    // Toggle Menu Function
    function toggleMenu(menuId) {
        const menu = document.getElementById(menuId);
        const button = menu.previousElementSibling;
        const icon = button.querySelector('[data-feather="chevron-down"]');
        
        menu.classList.toggle('hidden');
        if (!menu.classList.contains('hidden')) {
            icon.style.transform = 'rotate(180deg)';
        } else {
            icon.style.transform = 'rotate(0)';
        }
    }

    // Sidebar Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebarNav');
        const toggleIcon = document.getElementById('toggleIcon');
        const toggleBtn = document.getElementById('sidebarToggle');
        const mainContent = document.getElementById('mainContent');
        let isCollapsed = false;

        toggleBtn.addEventListener('click', function() {
            isCollapsed = !isCollapsed;
            if(isCollapsed) {
                sidebar.style.width = '4rem';
                sidebar.classList.add('collapsed');
                toggleIcon.style.transform = 'rotate(180deg)';
                mainContent.classList.add('expanded');
            } else {
                sidebar.style.width = '16rem';
                sidebar.classList.remove('collapsed');
                toggleIcon.style.transform = 'rotate(0)';
                mainContent.classList.remove('expanded');
            }
        });
    });

    // Mobile Menu Toggle
    document.getElementById('mobile-collapse').addEventListener('click', function() {
        document.getElementById('sidebarNav').classList.toggle('translate-x-0');
        document.getElementById('sidebarNav').classList.toggle('-translate-x-full');
    });
</script>

</body>
</html>