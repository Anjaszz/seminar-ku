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
           <?php echo str_replace(['btn btn-gradient-success'], ['inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200'], $btntambah) ?>
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
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Peserta</th>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Telepon</th>
                       <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                   </tr>
               </thead>
               <tbody class="bg-white divide-y divide-gray-200">
                   <?php 
                   $no = ($current_page - 1) * $items_per_page + 1;
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
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                               <a href="<?= site_url("mahasiswa/detail/{$r->id_mahasiswa}") ?>" 
                                  class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg transition-colors duration-200">
                                   <i class='feather icon-eye mr-1'></i>
                                   Detail
                               </a>
                               <a href="<?= site_url("mahasiswa/update/{$r->id_mahasiswa}") ?>" 
                                  class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 hover:bg-yellow-200 rounded-lg transition-colors duration-200">
                                   <i class='feather icon-edit mr-1'></i>
                                   Edit
                               </a>
                               <button data-url="<?= site_url('mahasiswa/delete/' . $r->id_mahasiswa) ?>" 
                                       class="remove-mahasiswa inline-flex items-center px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg transition-colors duration-200">
                                   <i class='feather icon-trash-2 mr-1'></i>
                                   Hapus
                               </button>
                           </td>
                       </tr>
                   <?php } ?>
               </tbody>
           </table>
       </div>

     <!-- Pagination -->
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
                <!-- Previous button -->
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?= $current_page - 1 ?>" 
                       class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <i class="feather icon-chevron-left h-5 w-5"></i>
                    </a>
                <?php endif; ?>

                <!-- Page numbers -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $current_page): ?>
                        <span class="relative z-10 inline-flex items-center bg-blue-600 px-4 py-2 text-sm font-semibold text-white"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?page=<?= $i ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50"><?= $i ?></a>
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

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('click', function(event) {
   if (event.target.closest('.remove-mahasiswa')) {
       event.preventDefault();
       const button = event.target.closest('.remove-mahasiswa');
       const url = button.getAttribute('data-url');

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
               $.ajax({
                   url: url,
                   type: 'POST',
                   success: function(response) {
                       Swal.fire({
                           title: 'Berhasil!',
                           text: 'Data berhasil dihapus.',
                           icon: 'success',
                           customClass: {
                               popup: '!rounded-lg',
                               confirmButton: '!rounded-lg !px-4 !py-2 !bg-blue-600'
                           }
                       }).then(() => {
                           location.reload();
                       });
                   },
                   error: function(xhr, status, error) {
                       Swal.fire({
                           title: 'Gagal!',
                           text: 'Terjadi kesalahan saat menghapus data.',
                           icon: 'error',
                           customClass: {
                               popup: '!rounded-lg',
                               confirmButton: '!rounded-lg !px-4 !py-2 !bg-blue-600'
                           }
                       });
                   }
               });
           }
       });
   }
});
</script>