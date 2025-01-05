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
        <!-- Card Header -->
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table id="myTable" class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">No</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">ID User</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nama Peserta</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Email</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Tanggal Transaksi</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($laporan)) { ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">Tidak ada data keuangan.</td>
                        </tr>
                    <?php } else { 
                        $no = 1;
                        foreach ($laporan as $l) { ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?= $no++ ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?= $l->nim ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?= $l->nama_mhs ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><?= $l->email ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><?= date('d-m-Y', strtotime($l->tgl_transaksi)) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">Rp <?= number_format($l->jumlah, 0, ',', '.') ?></td>
                            </tr>
                        <?php } ?>
                        <!-- Total Row -->
                        <tr class="bg-gray-50">
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">Total Transaksi</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-center">Rp <?= number_format($total_transaksi, 0, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SweetAlert Script -->
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