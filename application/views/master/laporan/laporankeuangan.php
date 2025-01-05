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
                       <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                       <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Vendor</th>
                       <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Transaksi</th>
                       <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Masuk</th>
                   </tr>
               </thead>
               <tbody class="bg-white divide-y divide-gray-200">
                   <?php foreach ($laporan as $l) { ?>
                       <tr class="hover:bg-gray-50">
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?= $l->id_transaksi ?></td>
                           <td class="px-6 py-4 whitespace-nowrap text-center">
                               <div class="text-sm font-medium text-gray-900"><?= $l->nama_vendor ?></div>
                           </td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><?= $l->tgl_transaksi ?></td>
                           <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                               Rp <?= number_format($l->jumlah_masuk, 2) ?>
                           </td>
                       </tr>
                   <?php } ?>
                   <!-- Total Row -->
                   <tr class="bg-gray-50">
                       <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
                           Total Pemasukan
                       </td>
                       <td class="px-6 py-4 whitespace-nowrap text-right text-base font-bold text-green-600">
                           Rp <?= number_format($total_pemasukan, 2) ?>
                       </td>
                   </tr>
               </tbody>
           </table>

           <!-- Jika ada pagination, tambahkan disini -->
           <?php if (isset($total_items) && isset($items_per_page)): ?>
               <?php
               $total_pages = ceil($total_items / $items_per_page);
               if ($total_pages > 1): ?>
                   <!-- Pagination section sama seperti sebelumnya -->
               <?php endif; ?>
           <?php endif; ?>
       </div>
   </div>
</div>