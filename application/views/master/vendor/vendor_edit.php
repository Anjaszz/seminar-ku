<!-- Header -->
<div class="bg-white rounded-xl shadow-sm mb-6 p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Data Vendor</h1>
            <p class="mt-1 text-sm text-gray-600">Perbarui informasi vendor Anda</p>
        </div>
    </div>
</div>

<!-- Form Card -->
<div class="bg-white rounded-xl shadow-sm">
    <div class="p-6">
        <form action="" method="post" class="space-y-6">
            <!-- Grid Layout untuk Form -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Vendor -->
                <div>
                    <label for="nama_vendor" class="block text-sm font-medium text-gray-700 mb-1">Nama Vendor</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-building"></i>
                        </span>
                        <input type="text" 
                               name="nama_vendor" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= set_value('nama_vendor', $nama_vendor); ?>"
                               required>
                    </div>
                    <?php if(form_error('nama_vendor')): ?>
                        <p class="mt-1 text-sm text-red-600"><?= form_error('nama_vendor'); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" 
                               name="email" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= set_value('email', $email); ?>"
                               required>
                    </div>
                </div>

                <!-- Tanggal Langganan -->
                <div>
                    <label for="tanggal_langganan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Langganan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-calendar"></i>
                        </span>
                        <input type="date" 
                               name="tanggal_langganan" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= set_value('tanggal_langganan', $tanggal_langganan); ?>"
                               required>
                    </div>
                </div>

                <!-- Tanggal Berakhir -->
                <div>
                    <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-calendar-times"></i>
                        </span>
                        <input type="date" 
                               name="tanggal_berakhir" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= set_value('tanggal_berakhir', $tanggal_berakhir); ?>">
                    </div>
                </div>

                <!-- No Telepon -->
                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-phone"></i>
                        </span>
                        <input type="text" 
                               name="no_telp" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= set_value('no_telp', $no_telp); ?>"
                               required>
                    </div>
                </div>

                <!-- Bank -->
                <div>
                    <label for="id_bank" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-university"></i>
                        </span>
                        <select name="id_bank" 
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none"
                                required>
                            <option value="">-- Pilih Bank --</option>
                            <?php foreach ($banks as $bank): ?>
                                <option value="<?= $bank->id_bank; ?>" 
                                        <?= set_select('id_bank', $bank->id_bank, $bank->id_bank == $id_bank); ?>>
                                    <?= $bank->nama_bank; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 pointer-events-none">
                            <i class="fas fa-chevron-down"></i>
                        </span>
                    </div>
                </div>

                <!-- Nomor Rekening -->
                <div>
                    <label for="no_rekening" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-credit-card"></i>
                        </span>
                        <input type="text" 
                               name="no_rekening" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="<?= set_value('no_rekening', $no_rekening); ?>"
                               required>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="<?= site_url('master/vendor'); ?>" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>