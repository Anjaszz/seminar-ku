<header class="bg-white shadow-sm fixed top-0 left-0 right-0 z-30">
   <div class="mx-auto max-w-full">
       <div class="flex justify-end items-center h-16 px-8">
           <!-- Mobile menu button -->
           <button class="md:hidden text-gray-500 hover:text-gray-700">
               <i class="bi bi-list text-2xl"></i>
           </button>

           <!-- Right Navigation -->
           <div class="flex items-center space-x-4">
               <!-- Profile Dropdown -->
               <div class="">
                   <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none" onclick="toggleDropdown()">
                       <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-gray-200">
                           <img src="<?php echo base_url() ?>assets/images/widget/user.png" alt="Profile" class="w-full h-full object-cover">
                       </div>
                       <span class="hidden md:block font-medium">Master Admin</span>
                       <i class="bi bi-chevron-down text-sm"></i>
                   </button>

                   <!-- Dropdown Menu -->
                   <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 animate-fade-in-down">
                       <div class="px-4 py-3 border-b">
                           <p class="text-sm font-medium text-gray-900">Master Admin</p>
                           <p class="text-sm text-gray-500"><?php echo isset($admin_email) ? $admin_email : 'Email tidak ditemukan'; ?></p> <!-- Ganti dengan email dari database -->
                       </div>
                       <a href="<?php echo site_url('master/auth/logout') ?>" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                           <i class="bi bi-box-arrow-right mr-2"></i>
                           Logout
                       </a>
                   </div>
               </div>
           </div>
       </div>
   </div>
</header>

<!-- Add Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
function toggleDropdown() {
   const dropdown = document.getElementById('profileDropdown');
   dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
   const dropdown = document.getElementById('profileDropdown');
   const profileButton = e.target.closest('button');
   
   if (!profileButton && !dropdown.contains(e.target)) {
       dropdown.classList.add('hidden');
   }
});
</script>

<style>
.animate-fade-in-down {
   animation: fadeInDown 0.2s ease-out;
}

@keyframes fadeInDown {
   from {
       opacity: 0;
       transform: translateY(-10px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}
</style>
