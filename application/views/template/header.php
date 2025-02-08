<header class="bg-white shadow-sm fixed top-0 left-0 right-0 z-30 h-16">
   <div class="mx-auto max-w-full">
       <div class="flex justify-end items-center h-16 px-8">
           <!-- Mobile menu button -->
           <button class="md:hidden text-gray-500 hover:text-gray-700">
               <i class="bi bi-list text-2xl"></i>
           </button>

           <!-- Right Navigation -->
           <div class="flex items-center space-x-4">
<!-- Profile Dropdown -->
<div class="relative">
    <button class="flex items-center space-x-3 text-gray-700 hover:text-gray-900 focus:outline-none group transition-all duration-200" onclick="toggleDropdown()">
        <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-200 group-hover:border-indigo-500 transition-all duration-200 shadow-sm">
            <img src="<?php echo base_url() ?>assets/images/widget/user.png" alt="Profile" class="w-full h-full object-cover">
        </div>
        <div class="hidden md:flex items-center space-x-2">
            <span class="font-medium text-gray-800">Admin Vendor</span>
            <i class="bi bi-chevron-down text-sm transition-transform duration-200" id="dropdownArrow"></i>
        </div>
    </button>

    <!-- Dropdown Menu -->
    <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-68 bg-white rounded-xl shadow-xl py-2 transform transition-all duration-200 ease-out scale-95 opacity-0">
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-gray-100">
                    <img src="<?php echo base_url() ?>assets/images/widget/user.png" alt="Profile" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-semibold text-gray-800"> <?php echo isset($nama_vendor) ? $nama_vendor : 'SIMAS'; ?></p>
                    <p class="text-sm text-gray-500 truncate">
                        <?php echo isset($admin_email) ? $admin_email : 'Email tidak ditemukan'; ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Menu Items -->
        <div class="px-2 py-2">
            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                <i class="bi bi-person text-lg mr-3"></i>
                Profile Settings
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                <i class="bi bi-gear text-lg mr-3"></i>
                Account Settings
            </a>
        </div>

        <!-- Separator -->
        <div class="h-px bg-gray-100 my-2 mx-2"></div>

        <!-- Logout -->
        <div class="px-2 pb-2">
            <a href="<?php echo site_url('logout') ?>" class="flex items-center px-3 py-2 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors duration-150">
                <i class="bi bi-box-arrow-right text-lg mr-3"></i>
                Logout
            </a>
        </div>
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
    const arrow = document.getElementById('dropdownArrow');
    
    if (dropdown.classList.contains('hidden')) {
        dropdown.classList.remove('hidden');
        dropdown.classList.add('show-dropdown');
        arrow.style.transform = 'rotate(180deg)';
    } else {
        arrow.style.transform = 'rotate(0deg)';
        dropdown.classList.remove('show-dropdown');
        dropdown.classList.add('hidden');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const button = event.target.closest('button');
    
    if (!button && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show-dropdown');
        dropdown.classList.add('hidden');
        document.getElementById('dropdownArrow').style.transform = 'rotate(0deg)';
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

@keyframes slideInDown {
    from {
        transform: translateY(-10px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.show-dropdown {
    display: block !important;
    animation: slideInDown 0.2s ease-out forwards;
    transform-origin: top;
    opacity: 1 !important;
    scale: 1 !important;
}
</style>
