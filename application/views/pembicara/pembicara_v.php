<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm mb-6 p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="<?php echo site_url('home') ?>" class="text-gray-500 hover:text-blue-600">
                            <i class="feather icon-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="feather icon-chevron-right text-gray-400 text-sm mx-2"></i>
                            <a href="#!" class="text-gray-500 hover:text-blue-600"><?= $title ?></a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="mt-4 md:mt-0">
            <?php echo str_replace(
                'class="btn btn-gradient-success"',
                'class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg hover:from-green-500 hover:to-green-700 transition-colors duration-200"',
                $btntambah
            ) ?>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
        <div class="flex items-center space-x-2">
            <!-- Card Options Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="feather icon-more-horizontal"></i>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-10">
                    <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="fullscreen">
                        <i class="feather icon-maximize mr-2"></i> Maximize
                    </a>
                    <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="collapse">
                        <i class="feather icon-minus mr-2"></i> Collapse
                    </a>
                    <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="reload">
                        <i class="feather icon-refresh-cw mr-2"></i> Reload
                    </a>
                    <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="remove">
                        <i class="feather icon-trash mr-2"></i> Remove
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nama Pembicara</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Latar Belakang</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Seminar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Foto</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    foreach ($pembicara as $p) { ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?php echo $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?php echo $p->nama_pembicara ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900 text-center"><?php echo $p->latar_belakang ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?php echo $p->nama_seminar ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <a href="<?php echo base_url("uploads/pembicara/{$p->foto}") ?>" 
                                       data-lightbox="example-set" 
                                       data-title="<?php echo $p->nama_pembicara ?>"
                                       class="block">
                                        <img src="<?php echo base_url("uploads/pembicara/{$p->foto}") ?>" 
                                             class="h-20 w-20 object-cover rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200" 
                                             alt="<?php echo $p->nama_pembicara ?>">
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <a href="<?php echo site_url("pembicara/update/{$p->id_pembicara}") ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-lg transition-colors duration-200">
                                    <i class="feather icon-edit mr-1"></i>
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Alpine.js for dropdown functionality -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- JavaScript for card actions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fullscreen functionality
    document.querySelector('[data-action="fullscreen"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        document.documentElement.requestFullscreen();
    });

    // Collapse functionality
    document.querySelector('[data-action="collapse"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        const cardBody = this.closest('.bg-white').querySelector('.p-6');
        cardBody.classList.toggle('hidden');
        
        const icon = this.querySelector('i');
        if (cardBody.classList.contains('hidden')) {
            icon.classList.remove('icon-minus');
            icon.classList.add('icon-plus');
        } else {
            icon.classList.remove('icon-plus');
            icon.classList.add('icon-minus');
        }
    });

    // Reload functionality
    document.querySelector('[data-action="reload"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        location.reload();
    });

    // Remove functionality
    document.querySelector('[data-action="remove"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        this.closest('.bg-white').remove();
    });
});
</script>