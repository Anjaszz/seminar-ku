<!-- Navigasi Utama -->  
<nav class="bg-white shadow-md fixed w-full top-0 z-50">  
    <div class="max-w-full mx-auto px-6">  
        <div class="flex justify-between items-center h-20">  
            <!-- Logo -->  
            <div class="flex-shrink-0 pl-4">  
                <a href="<?php echo base_url('user/home'); ?>" class="flex items-center">  
                    <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png"   
                         alt="Logo SIMAS"   
                         class="h-10 w-auto">  
                </a>  
            </div>  
  
            <!-- Tombol menu mobile -->  
            <div class="flex items-center md:hidden">  
                <button id="mobileMenuBtn"   
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">  
                    <span class="sr-only">Buka menu utama</span>  
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">  
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>  
                    </svg>  
                </button>  
            </div>  
  
            <!-- Menu Desktop -->  
            <div class="hidden md:flex md:items-center md:space-x-6">  
                <?php if ($this->session->userdata('user_data')): ?>  
                    <!-- Profil Pengguna -->  
                    <a href="<?php echo base_url('user/home/profil'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>  
                        </svg>  
                        <span><?php echo isset($nama_mahasiswa) ? explode(' ', $nama_mahasiswa)[0] : 'Pengguna'; ?></span>  
                    </a>  
  
                    <!-- Beranda -->  
                    <a href="<?php echo base_url('user/home/index'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>  
                        </svg>  
                        Beranda  
                    </a>  
  
                    <!-- Belum Bayar -->  
                    <a href="<?php echo base_url('user/home/belumbayar'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                        </svg>  
                        Belum Bayar  
                        <span class="ml-2 px-1 py-1 text-xs font-medium rounded-full bg-red-100 text-red-600">  
                            <?php echo $jumlah_belum_bayar; ?>  
                        </span>  
                    </a>  
  
                    <!-- Seminar -->  
                    <a href="<?php echo base_url('user/home/terdaftar'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>  
                        </svg>  
                        Seminar  
                        <span class="ml-2 px-1 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-600">  
                            <?php echo $jumlah_seminar; ?>  
                        </span>  
                    </a>  
  
                    <!-- File/Modul -->  
                    <a href="<?php echo base_url('user/home/file'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>  
                        </svg>  
                        File/Modul  
                        <span class="ml-2 px-1 py-1 text-xs font-medium rounded-full bg-green-100 text-green-600">  
                            <?php echo $jumlah_history; ?>  
                        </span>  
                    </a>  
  
                    <!-- History Seminar -->  
                    <a href="<?php echo base_url('user/home/seminar_history'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>  
                        </svg>  
                        History Seminar  
                        <span class="ml-2 px-1 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-600">  
                            <?php echo $jumlah_history; ?>  
                        </span>  
                    </a>  
                    <a href="<?php echo base_url('user/home/komunitas'); ?>"   
                       class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition duration-150">  
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">  
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 3l-6 6-6-6m6 6v12"/>  
                        </svg>  
                        Grup Komunitas  
                        <span class="ml-2 px-1 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-600">  
                            <?php echo $jumlah_komunitas; ?>  
                        </span>  
                    </a> 
  
                    <!-- Tombol Logout -->  
                    <a href="<?php echo base_url('user/auth/logout'); ?>" 
                        class="flex items-center px-2 py-1 rounded-md text-sm font-medium text-red-600 hover:text-red-900 hover:bg-red-100 transition duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </a>
 
                        <?php else: ?>
<div class="flex items-center gap-4">
   <!-- Greeting -->
   <span class="hidden md:block text-gray-600">Hi, Pengunjung</span>
   
   <!-- Auth Buttons -->
   <div class="flex items-center gap-2">
       <a href="<?php echo base_url('user/auth'); ?>"
          class="px-4 py-2 rounded-lg text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 transition-all">
           <i class="fas fa-sign-in-alt mr-1"></i> Masuk
       </a>
       
       <a href="<?php echo base_url('daftar/user'); ?>"
          class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition-all">
           <i class="fas fa-user-plus mr-1"></i> Daftar
       </a>
   </div>
</div>
<?php endif; ?>
            </div>  
        </div>  
    </div>  
  
    <!-- Menu Mobile -->  
    <div class="md:hidden" id="mobileMenu" style="display: none;">  
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">  
            <?php if ($this->session->userdata('user_data')): ?>  
                <!-- Profil Pengguna Mobile -->  
                <a href="<?php echo base_url('user/home/index'); ?>"   
                   class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">  
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Beranda
                    </div>
                </a>
                <!-- Belum Bayar Mobile -->  
                <a href="<?php echo base_url('user/home/belumbayar'); ?>"   
                   class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Belum Bayar  
                        <span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-600">  
                            <?php echo $jumlah_belum_bayar; ?>
</span>
</div>
</a>
<!-- Seminar Mobile -->
<a href="<?php echo base_url('user/home/terdaftar'); ?>"   
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">
<div class="flex items-center">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
</svg>
Seminar
<span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-600">
<?php echo $jumlah_seminar; ?>
</span>
</div>
</a>
<!-- File/Modul Mobile -->
<a href="<?php echo base_url('user/home/file'); ?>"   
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">
<div class="flex items-center">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
</svg>
File/Modul
<span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-600">
<?php echo $jumlah_history; ?>
</span>
</div>
</a>
<!-- History Seminar Mobile -->
<a href="<?php echo base_url('user/home/seminar_history'); ?>"   
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">
<div class="flex items-center">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
History Seminar
<span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-600">
<?php echo $jumlah_history; ?>
</span>
</div>
</a>
<a href="<?php echo base_url('user/home/komunitas'); ?>"   
                    class="block px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-100">
<div class="flex items-center">
<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 3l-6 6-6-6m6 6v12" />
</svg>
Grup Komunitas
<span class="ml-2 px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-600">
<?php echo $jumlah_komunitas; ?>
</span>
</div>
</a> 
                <!-- Tombol Logout Mobile -->  
                <a href="<?php echo base_url('user/auth'); ?>"   
                   class="block px-4 py-2 rounded-md text-base font-medium text-red-600 hover:text-red-900 hover:bg-red-100">  
                    Logout  
                </a>  
                <?php else: ?>
<!-- Mobile Navigation -->
<div class="space-y-2 ">
   <!-- Greeting -->
   <div class="px-2 py-1 text-sm text-gray-600">Hi, Pengunjung</div>
   
   <!-- Auth Links -->
   <a href="<?php echo base_url('user/auth'); ?>"
      class="flex items-center w-full px-2 py-2.5 text-center justify-center rounded-lg bg-green-400 text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all">
       <i class="fas fa-sign-in-alt w-5"></i>
       <span class="ml-3">Masuk</span>
   </a>
   
   <a href="<?php echo base_url('daftar/user'); ?>"
      class="flex items-center w-full px-4 text-center justify-center py-2.5 rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-all">
       <i class="fas fa-user-plus w-5"></i>
       <span class="ml-3">Daftar</span>
   </a>
</div>
<?php endif; ?>
        </div>  
    </div>  
</nav>  
  
<!-- Tambahkan skrip ini untuk toggle menu mobile -->  
<script>  
    document.getElementById('mobileMenuBtn').addEventListener('click', function() {  
        const mobileMenu = document.getElementById('mobileMenu');  
        mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';  
    });  
</script>  
