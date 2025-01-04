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
                            <span class="text-gray-500"><?= $title ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="mt-4 md:mt-0">
            <?php echo str_replace('class="btn btn-gradient-success"', 'class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg transition-colors duration-200"', $btntambah) ?>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
        <div class="flex items-center space-x-2">
          
        </div>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Seminar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slot Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    foreach ($tiket as $t) { ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $t->nama_seminar ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp.<?php echo number_format($t->harga_tiket) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $t->slot_tiket ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <a href="<?php echo site_url("tiket/update/{$t->id_tiket}") ?>" 
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

<!-- JavaScript for card actions -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fullscreen functionality
    document.querySelector('[data-action="fullscreen"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.documentElement.requestFullscreen();
    });

    // Collapse functionality
    document.querySelector('[data-action="collapse"]').addEventListener('click', function(e) {
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
    document.querySelector('[data-action="reload"]').addEventListener('click', function(e) {
        e.preventDefault();
        location.reload();
    });

    // Remove functionality
    document.querySelector('[data-action="remove"]').addEventListener('click', function(e) {
        e.preventDefault();
        this.closest('.bg-white').remove();
    });
});
</script>