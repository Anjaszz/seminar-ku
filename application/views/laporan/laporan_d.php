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
        <div class="flex flex-wrap justify-between items-center mb-6">
            <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
            <div class="flex items-center space-x-4">
                <!-- Delete All Button -->
                <button onclick="confirmDeleteAll('<?php echo site_url('laporan/hapus_semua/' . $id_seminar); ?>')" 
                        class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors duration-200">
                    <i class="feather icon-trash mr-2"></i>
                    Hapus Semua Data
                </button>
                
                <!-- Options Dropdown -->
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
                    </ul>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table id="myTable" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">No</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Peserta</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Email</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Tanggal</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Jam</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Keterangan</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    foreach ($laporan as $l) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?php echo $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?php echo $l->nama_mhs ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?php echo $l->email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <?php if ($l->tgl_khd == NULL) : ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        -
                                    </span>
                                <?php else : ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <?= $l->tgl_khd ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <?php if ($l->jam_khd == NULL) : ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        -
                                    </span>
                                <?php else : ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <?= $l->jam_khd ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <?php if ($l->id_stskhd == NULL) : ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Tidak Hadir
                                    </span>
                                <?php elseif ($l->id_stskhd == 2) : ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <?= $l->nama_stskhd ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <button onclick="confirmDelete('<?php echo site_url('laporan/hapus/' . $l->id_mahasiswa . '/' . $id_seminar); ?>')" 
                                        class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors duration-200">
                                    <i class="feather icon-trash mr-1"></i>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#3B82F6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: '!rounded-lg',
                confirmButton: '!rounded-lg !px-4 !py-2',
                cancelButton: '!rounded-lg !px-4 !py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmDeleteAll(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Seluruh data akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#3B82F6',
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: '!rounded-lg',
                confirmButton: '!rounded-lg !px-4 !py-2',
                cancelButton: '!rounded-lg !px-4 !py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

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