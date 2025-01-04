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
        <div class="overflow-x-auto">
            <table id="myTable" class="min-w-full divide-y divide-gray-200">
                
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $no = 1;
                    foreach ($mahasiswa as $r) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $r->nama_mhs ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $r->kode_fakultas ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <?= $r->nama_prodi ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->no_telp ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Jika ada pagination, tambahkan disini dengan format yang sama seperti tabel vendor -->
            <?php if (isset($total_items) && isset($items_per_page)): ?>
            <?php
            $total_pages = ceil($total_items / $items_per_page);
            
            if ($total_pages > 1): ?>
            <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                <!-- Pagination content -->
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
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
</script>