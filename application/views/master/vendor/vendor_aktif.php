<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm mb-6 p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="<?php echo site_url('master/home') ?>" class="text-gray-500 hover:text-blue-600">
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Vendor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Langganan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $no = ($current_page - 1) * $items_per_page + 1;
                    foreach ($vendor as $r) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $r->nama_vendor ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $r->active === '1' 
                                    ? 'bg-green-100 text-green-800' 
                                    : 'bg-red-100 text-red-800' ?>">
                                    <?= $r->active === '1' ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->tgl_subs ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $r->no_telp ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="<?= site_url("master/vendor/detail/{$r->id_vendor}") ?>" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg transition-colors duration-200">
                                    <i class='feather icon-eye mr-1'></i>
                                    Detail
                                </a>
                                <a href="#" 
                                   data-url="<?= site_url("master/vendor/nonaktifkan/{$r->id_vendor}") ?>" 
                                   class="nonaktif-vendor inline-flex items-center px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors duration-200">
                                    <i class='feather icon-x mr-1'></i>
                                    Nonaktifkan Akun
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Pagination section -->
            <?php
            $total_pages = ceil($total_items / $items_per_page);
            
            if ($total_pages > 1): ?>
            <div class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                <!-- Mobile pagination -->
                <div class="flex flex-1 justify-between sm:hidden">
                    <?php if ($current_page > 1): ?>
                        <a href="?page=<?= $current_page - 1 ?>" 
                           class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Previous
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($current_page < $total_pages): ?>
                        <a href="?page=<?= $current_page + 1 ?>" 
                           class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Next
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Desktop pagination -->
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <!-- Info -->
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan
                            <span class="font-medium"><?= ($current_page - 1) * $items_per_page + 1 ?></span>
                            sampai
                            <span class="font-medium"><?= min($current_page * $items_per_page, $total_items) ?></span>
                            dari
                            <span class="font-medium"><?= $total_items ?></span>
                            data
                        </p>
                    </div>

                    <!-- Page numbers -->
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <?php 
                            // Hapus perhitungan total_pages disini karena sudah dihitung di atas
                            $current_url = current_url();
                            ?>
                            
                            <!-- Previous button -->
                            <?php if ($current_page > 1): ?>
                                <a href="?page=<?= $current_page - 1 ?>" 
                                   class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <i class="feather icon-chevron-left h-5 w-5"></i>
                                </a>
                            <?php endif; ?>

                            <!-- Page numbers -->
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <?php if ($i <= 2 || $i >= $total_pages - 1 || abs($i - $current_page) <= 1): ?>
                                    <a href="?page=<?= $i ?>" 
                                       class="relative inline-flex items-center px-4 py-2 text-sm font-semibold <?= $i === (int)$current_page 
                                            ? 'z-10 bg-blue-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600' 
                                            : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php elseif ($i == 3 || $i == $total_pages - 2): ?>
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300">...</span>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <!-- Next button -->
                            <?php if ($current_page < $total_pages): ?>
                                <a href="?page=<?= $current_page + 1 ?>" 
                                   class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                    <i class="feather icon-chevron-right h-5 w-5"></i>
                                </a>
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Konfirmasi Nonaktifkan dengan SweetAlert2 -->
<script>
document.addEventListener('click', function(event) {
    if (event.target.closest('.nonaktif-vendor')) {
        event.preventDefault();
        const button = event.target.closest('.nonaktif-vendor');
        const url = button.getAttribute('data-url');

        // Tampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Nonaktifkan vendor ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Nonaktifkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Lakukan nonaktifkan dengan AJAX
                $.ajax({
                    url: url,
                    type: 'POST', // Sesuaikan dengan metode yang digunakan di server
                    success: function(response) {
                        // Tampilkan notifikasi berhasil
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Vendor Berhasil dinonaktifkan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload halaman setelah sukses
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan notifikasi gagal
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan ',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }
});
</script>
