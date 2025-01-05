<!-- Main Navigation -->
<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-full mx-auto px-6">
        <div class="flex justify-between items-center h-20">
            <!-- Logo - Now with more left padding -->
            <div class="flex-shrink-0 pl-4">
                <a href="<?php echo base_url('user/home'); ?>" class="flex items-center">
                    <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" 
                         alt="SIMAS Logo" 
                         class="h-10 w-auto">
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button id="mobileMenuBtn" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu - Increased spacing -->
            <div class="hidden md:flex md:items-center md:space-x-6">
                <!-- Profile -->
                <a href="<?php echo base_url('user/home/profil'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span><?php echo isset($nama_mahasiswa) ? explode(' ', $nama_mahasiswa)[0] : 'User'; ?></span>
                </a>

                <!-- Home -->
                <a href="<?php echo base_url('user/home/index'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

               

                <!-- Belum Bayar -->
                <a href="<?php echo base_url('user/home/belumbayar'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Belum Bayar
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-600">
                        <?php echo $jumlah_belum_bayar; ?>
                    </span>
                </a>

                <!-- Seminar -->
                <a href="<?php echo base_url('user/home/terdaftar'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Seminar
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-600">
                        <?php echo $jumlah_seminar; ?>
                    </span>
                </a>

                <!-- File/Modul -->
                <a href="<?php echo base_url('user/home/file'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    File/Modul
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-600">
                        <?php echo $jumlah_history; ?>
                    </span>
                </a>

                <!-- History Seminar -->
                <a href="<?php echo base_url('user/home/seminar_history'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    History Seminar
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-600">
                        <?php echo $jumlah_history; ?>
                    </span>
                </a>

                <!-- Logout Button -->
                <a href="<?php echo base_url('user/auth'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-red-600 hover:text-red-900 hover:bg-red-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" id="mobileMenu" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <!-- Mobile menu items with increased spacing -->
            <a href="<?php echo base_url('user/home/profil'); ?>" 
               class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profil
                </div>
            </a>
              <!-- Home -->
              <a href="<?php echo base_url('user/home/index'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>



                <!-- Belum Bayar -->
                <a href="<?php echo base_url('user/home/belumbayar'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Belum Bayar
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-600">
                        <?php echo $jumlah_belum_bayar; ?>
                    </span>
                </a>

                <!-- Seminar -->
                <a href="<?php echo base_url('user/home/terdaftar'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Seminar
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-600">
                        <?php echo $jumlah_seminar; ?>
                    </span>
                </a>

                <!-- File/Modul -->
                <a href="<?php echo base_url('user/home/file'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    File/Modul
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-600">
                        <?php echo $jumlah_history; ?>
                    </span>
                </a>

                <!-- History Seminar -->
                <a href="<?php echo base_url('user/home/seminar_history'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    History Seminar
                    <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-600">
                        <?php echo $jumlah_history; ?>
                    </span>
                </a>

                <!-- Logout Button -->
                <a href="<?php echo base_url('user/auth'); ?>" 
                   class="flex items-center px-4 py-2 rounded-md text-sm font-medium text-red-600 hover:text-red-900 hover:bg-red-100 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
        </div>
    </div>
</nav>

<!-- Add this script for mobile menu toggle -->
<script>
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';
    });
</script>