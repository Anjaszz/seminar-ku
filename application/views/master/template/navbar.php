<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SIMAS Dashboard</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Sidebar Navigation -->
<nav id="sidebarNav" class="fixed top-0 left-0 w-64 h-full bg-gray-900 text-white shadow-lg z-40 transition-all duration-300">
   <!-- Logo and Toggle -->
   <div class="flex items-center justify-between p-4 border-b border-gray-800">
       <div class="flex items-center sidebar-content overflow-hidden">
           <img src="<?php echo base_url('assets/images/fav.png'); ?>" alt="Logo" class="w-8 h-8 rounded">
           <span class="ml-3 text-lg font-semibold whitespace-nowrap">SIMAS</span>
       </div>
       <button id="sidebarToggle" class="text-gray-300 hover:text-white absolute -right-4 top-5 bg-gray-900 rounded-full p-1">
    <i class="bi bi-chevron-double-left text-xl transition-transform duration-300 transform" id="toggleIcon"></i>
</button>
   </div>

   <!-- Navigation Menu -->
   <div class="overflow-y-auto h-[calc(100vh-4rem)]">
       <div class="px-4 py-3 sidebar-content">
           <p class="text-xs uppercase text-gray-500 font-semibold">Menu Navigasi</p>
       </div>

       <ul class="space-y-1">
           <!-- Dashboard -->
           <li>
               <a href="<?= site_url('master/home') ?>" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                   <i class="bi bi-grid text-xl min-w-[1.5rem]"></i>
                   <span class="ml-3 sidebar-content">Dashboard</span>
               </a>
           </li>

           <!-- Manajemen Peserta -->
           <li class="relative">
               <button onclick="toggleMenu('pesertaMenu')" class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                   <div class="flex items-center">
                       <i class="bi bi-people text-xl min-w-[1.5rem]"></i>
                       <span class="ml-3 sidebar-content">Manajemen Peserta</span>
                   </div>
                   <i class="bi bi-chevron-down text-sm transition-transform sidebar-content" id="pesertaIcon"></i>
               </button>
               <ul id="pesertaMenu" class="hidden bg-gray-800 py-2">
                   <li><a href="<?= site_url('mahasiswa') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Peserta Terdaftar</a></li>
                   <li><a href="<?= site_url('fakultas') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Per Departemen</a></li>
                   <li><a href="<?= site_url('prodi') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Per Jurusan</a></li>
               </ul>
           </li>

           <!-- Manajemen Vendor -->
           <li class="relative">
               <button onclick="toggleMenu('vendorMenu')" class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                   <div class="flex items-center">
                       <i class="bi bi-building text-xl min-w-[1.5rem]"></i>
                       <span class="ml-3 sidebar-content">Manajemen Vendor</span>
                   </div>
                   <i class="bi bi-chevron-down text-sm transition-transform sidebar-content" id="vendorIcon"></i>
               </button>
               <ul id="vendorMenu" class="hidden bg-gray-800 py-2">
                   <li><a href="<?= site_url('master/vendor') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Vendor</a></li>
                   <li><a href="<?= site_url('master/vendor/vendor_aktif') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Vendor Aktif</a></li>
                   <li><a href="<?= site_url('master/vendor/vendor_nonaktif') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Vendor Nonaktif</a></li>
               </ul>
           </li>

           <!-- Laporan -->
           <li class="relative">
               <button onclick="toggleMenu('laporanMenu')" class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors">
                   <div class="flex items-center">
                       <i class="bi bi-file-text text-xl min-w-[1.5rem]"></i>
                       <span class="ml-3 sidebar-content">Laporan dan Cetak</span>
                   </div>
                   <i class="bi bi-chevron-down text-sm transition-transform sidebar-content" id="laporanIcon"></i>
               </button>
               <ul id="laporanMenu" class="hidden bg-gray-800 py-2">
                   <li><a href="<?= site_url('master/laporan/keuangan') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Keuangan</a></li>
                   <li><a href="<?= site_url('master/laporan/peserta') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Peserta</a></li>
                   <li><a href="<?= site_url('master/laporan/vendor') ?>" class="block px-4 py-2 text-gray-400 hover:text-white pl-12 sidebar-content">Data Vendor</a></li>
               </ul>
           </li>
       </ul>
   </div>
</nav>

<!-- Main Content Area -->
<main class="transition-all duration-300" id="mainContent">
   <!-- Add your main content here -->
</main>

<style>
.sidebar-collapsed {
   width: 4rem !important;
}

#sidebarNav.collapsed .sidebar-content {
   display: none;
}

#sidebarNav.collapsed .min-w-[1.5rem] {
   min-width: 100%;
   margin: 0;
   text-align: center;
}

#sidebarNav.collapsed #sidebarToggle {
   right: -4px;
}

#mainContent {
   margin-left: 16rem;
}

#mainContent.expanded {
   margin-left: 4rem;
}
</style>

<script>
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

function toggleMenu(menuId) {
   const menu = document.getElementById(menuId);
   const icon = document.getElementById(menuId.replace('Menu', 'Icon'));
   
   menu.classList.toggle('hidden');
   if (!menu.classList.contains('hidden')) {
       icon.style.transform = 'rotate(180deg)';
   } else {
       icon.style.transform = 'rotate(0)';
   }
}
</script>

</body>
</html>