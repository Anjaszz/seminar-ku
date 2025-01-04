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
            <?php echo str_replace('class="btn btn-primary"', 'class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200"', $btntambah) ?>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
        <div class="relative">
            <button class="p-2 hover:bg-gray-100 rounded-full transition-colors duration-200" id="cardOptions">
                <i class="feather icon-more-horizontal"></i>
            </button>
            <!-- Dropdown Menu -->
            <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10" id="cardOptionsMenu">
                <ul class="py-1">
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <i class="feather icon-maximize mr-2"></i>
                        <span>Maximize</span>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <i class="feather icon-minus mr-2"></i>
                        <span>Collapse</span>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <i class="feather icon-refresh-cw mr-2"></i>
                        <span>Reload</span>
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        <i class="feather icon-trash mr-2"></i>
                        <span>Remove</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Seminar</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pelaksanaan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Lampiran</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    foreach ($seminar as $s) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $s->nama_seminar ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center"><?php echo $s->tgl_pelaksana ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <a href="<?php echo base_url("uploads/poster/{$s->lampiran}") ?>" data-lightbox="example-set" data-title="<?php echo $s->nama_seminar ?>">
                                        <img src="<?php echo base_url("uploads/poster/{$s->lampiran}") ?>" class="h-20 w-20 object-cover rounded" alt="">
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <?php if ($s->id_tiket == NULL) : ?>
                                    <button class="inline-flex items-center px-3 py-1 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition-colors duration-200" data-tooltip="Silahkan Masukkan Data Tiket, Pembicara, dan Sponsor">
                                        <i class="feather icon-eye mr-1"></i>
                                        Detail
                                    </button>
                                <?php elseif ($s->id_tiket != NULL) : ?>
                                    <a href="<?php echo site_url("seminar/detail/{$s->id_seminar}") ?>" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg transition-colors duration-200">
                                        <i class="feather icon-eye mr-1"></i>
                                        Detail
                                    </a>
                                <?php endif; ?>

                                <a href="<?php echo site_url("seminar/update/{$s->id_seminar}") ?>" class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-lg transition-colors duration-200">
                                    <i class="feather icon-edit mr-1"></i>
                                    Edit
                                </a>
                                <a href="<?php echo site_url("seminar/delete/{$s->id_seminar}") ?>" class="remove-vendor inline-flex items-center px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors duration-200">
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

<!-- JavaScript for dropdown toggle -->
<script>
document.getElementById('cardOptions').addEventListener('click', function() {
    document.getElementById('cardOptionsMenu').classList.toggle('hidden');
});

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('#cardOptions')) {
        document.getElementById('cardOptionsMenu').classList.add('hidden');
    }
});
</script>

<!-- SweetAlert2 for delete confirmation -->
<script>
document.querySelectorAll('.remove-data').forEach(function(link) {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const url = this.getAttribute('href');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3B82F6',
            cancelButtonColor: '#EF4444',
            confirmButtonText: 'Ya, hapus!',
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
    });
});
</script>