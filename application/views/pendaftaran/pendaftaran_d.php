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
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6">
        <!-- Card Header with Options -->
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
            <div class="relative">
                <button type="button" class="p-2 hover:bg-gray-100 rounded-full focus:outline-none" data-toggle="dropdown">
                    <i class="feather icon-more-horizontal"></i>
                </button>
                <ul class="hidden absolute right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl z-20">
                    <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="feather icon-maximize mr-2"></i> Maximize
                    </a></li>
                    <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="feather icon-minus mr-2"></i> Collapse
                    </a></li>
                    <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="feather icon-refresh-cw mr-2"></i> Reload
                    </a></li>
                    <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="feather icon-trash mr-2"></i> Remove
                    </a></li>
                </ul>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    foreach ($pendaftaran as $r) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $r->nim ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $r->nama_mhs ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->no_telp ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->tgl_daftar ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->jam_daftar ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($r->id_stsbyr == 1) : ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <?= $r->nama_stsbyr ?>
                                    </span>
                                <?php elseif ($r->id_stsbyr == 2) : ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <?= $r->nama_stsbyr ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($r->id_metode == 1) : ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <?= $r->nama_metode ?>
                                    </span>
                                <?php elseif ($r->id_metode == 2) : ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <?= $r->nama_metode ?>
                                    </span>
                                <?php elseif ($r->id_metode == 3) : ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        <?= $r->nama_metode ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="<?= site_url("mahasiswa/detail/{$r->id_mahasiswa}") ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg transition-colors duration-200">
                                    <i class="feather icon-eye mr-1"></i>
                                    Detail
                                </a>
                                <a href="<?= site_url("pendaftaran/update/{$r->id_pendaftaran}") ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-lg transition-colors duration-200">
                                    <i class="feather icon-edit mr-1"></i>
                                    Edit
                                </a>
                                <a href="<?= site_url("pendaftaran/delete/{$r->id_pendaftaran}") ?>" 
                                   class="remove-data inline-flex items-center px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors duration-200">
                                    <i class="feather icon-trash-2 mr-1"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle dropdown menu
    const dropdownButton = document.querySelector('[data-toggle="dropdown"]');
    const dropdownMenu = dropdownButton.nextElementSibling;
    
    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
</script>