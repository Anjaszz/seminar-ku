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
                            <span class="text-gray-500"><?= $parent ?></span>
                        </div>
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

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden ">
        <div class="p-6 text-center flex flex-col items-center justify-center">
            <div class="w-32 h-32 mx-auto mb-4">
                <img class="w-full h-full object-cover rounded-full" 
                     src="<?php echo base_url() ?>assets/images/widget/user.png" 
                     alt="Profile-user">
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $nama_vendor ?></h3>
            <?php if ($status == 1): ?>
                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-green-100 text-green-800">
                    Aktif
                </span>
            <?php else: ?>
                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-red-100 text-red-800">
                    Nonaktif
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="md:col-span-2 bg-white rounded-xl shadow-sm">
        <div class="p-6">
            <!-- Detail Items -->
            <div class="space-y-6">
                <!-- Tanggal Langganan -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-red-100 text-red-600">
                            <i class="fas fa-street-view text-lg"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Tanggal Langganan</h4>
                        <p class="text-sm text-gray-500"><?= $tanggal_langganan ?></p>
                    </div>
                </div>

                <!-- Bank -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-blue-100 text-blue-600">
                            <i class="fas fa-university text-lg"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Nama Bank</h4>
                        <p class="text-sm text-gray-500"><?= $nama_bank ?: 'Tidak tersedia' ?></p>
                    </div>
                </div>

                <!-- Nomor Rekening -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-yellow-100 text-yellow-600">
                            <i class="fas fa-credit-card text-lg"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Nomor Rekening</h4>
                        <p class="text-sm text-gray-500"><?= $no_rekening ?: 'Tidak tersedia' ?></p>
                    </div>
                </div>

                <!-- Tanggal Berakhir -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-red-100 text-red-600">
                            <i class="fas fa-calendar text-lg"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Tanggal Berakhir</h4>
                        <p class="text-sm text-gray-500"><?= $tanggal_berakhir ?></p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-indigo-100 text-indigo-600">
                            <i class="fas fa-at text-lg"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Email</h4>
                        <p class="text-sm text-gray-500"><?= $email ?></p>
                    </div>
                </div>

                <!-- No Telepon -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-green-100 text-green-600">
                            <i class="fas fa-mobile-alt text-lg"></i>
                        </span>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">No Telepon</h4>
                        <p class="text-sm text-gray-500"><?= $no_telp ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>