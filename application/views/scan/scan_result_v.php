<!-- Result Card -->
<div class="bg-white rounded-xl h-full">
    <!-- Card Header -->
    <div class="border-b border-gray-200 px-6 py-4">
        <?php if ($this->session->flashdata('message')): ?>
            <div class="mb-4 p-4 rounded-lg <?= strpos($this->session->flashdata('message'), 'success') !== false ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' ?>">
                <?= $this->session->flashdata('message') ?>
            </div>
        <?php endif; ?>
        <h5 class="text-xl font-semibold text-gray-800">Hasil Scan</h5>
    </div>

    <!-- Card Body -->
    <div class="p-6 space-y-8">
        <!-- Seminar Info -->
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">Nama Seminar</p>
                <p class="text-sm text-gray-500 truncate"><?= $nama_seminar ?></p>
            </div>
        </div>

        <!-- User Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID User -->
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-100 text-yellow-600">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">ID User</p>
                    <p class="text-sm text-gray-500 truncate"><?= $nomor_induk ?></p>
                </div>
            </div>

            <!-- Nama Peserta -->
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-100 text-red-600">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Nama Peserta</p>
                    <p class="text-sm text-gray-500 truncate"><?= $nama_mhs ?></p>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                        <i class="fas fa-at"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">Email</p>
                    <p class="text-sm text-gray-500 truncate"><?= $email ?></p>
                </div>
            </div>

            <!-- No Telepon -->
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-green-100 text-green-600">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">No Telepon</p>
                    <p class="text-sm text-gray-500 truncate"><?= $no_telp ?></p>
                </div>
            </div>
        </div>

        <!-- Success Animation (optional, shown when scan is successful) -->
        <div class="text-center mt-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 text-green-500 animate-bounce">
                <i class="fas fa-check text-2xl"></i>
            </div>
        </div>
    </div>
</div>