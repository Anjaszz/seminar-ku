<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm mb-6 p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="<?= site_url('home') ?>" class="text-gray-500 hover:text-blue-600">
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
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <!-- Card Header -->
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-xl font-semibold text-gray-800"><?= $title ?></h5>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">No</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Nama Seminar</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Tanggal Pelaksanaan</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Sertifikat</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $no = 1;
                    foreach ($sertifikat as $s) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?= $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center"><?= $s->nama_seminar ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center"><?= $s->tgl_pelaksana ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center">
                                    <?php if (!empty($s->sertifikat)) { ?>
                                        <a href="<?= base_url("uploads/sertifikat/{$s->sertifikat}") ?>" 
                                           data-lightbox="example-set" 
                                           data-title="<?= $s->nama_seminar ?>"
                                           class="block">
                                            <img src="<?= base_url("uploads/sertifikat/{$s->sertifikat}") ?>" 
                                                 class="h-20 w-20 object-cover rounded-lg transition-transform duration-200 hover:scale-105" 
                                                 alt="Sertifikat <?= $s->nama_seminar ?>">
                                        </a>
                                    <?php } else { ?>
                                        <span class="text-sm text-gray-500">No Sertifikat</span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex flex-col items-center space-y-2">
                                    <!-- Form Upload -->
                                    <form action="<?= site_url('sertifikat/upload/' . $s->id_seminar) ?>" 
                                          method="post" 
                                          enctype="multipart/form-data" 
                                          class="flex flex-col items-center space-y-2">
                                        <!-- Custom File Input -->
                                        <div class="relative">
                                            <input type="file" 
                                                   name="sertifikat" 
                                                   accept="image/*" 
                                                   required
                                                   class="hidden"
                                                   id="file-<?= $s->id_seminar ?>">
                                            <label for="file-<?= $s->id_seminar ?>" 
                                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-sm rounded-lg transition-all duration-200 cursor-pointer">
                                                <i class="feather icon-file-plus mr-2"></i>
                                                Pilih File
                                            </label>
                                            <span class="selected-file-name text-sm text-gray-500 mt-1 block"></span>
                                        </div>
                                        
                                        <!-- Upload Button -->
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-sm rounded-lg transition-all duration-200">
                                            <i class="feather icon-upload mr-2"></i>
                                            Upload
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <?php if (!empty($s->sertifikat)) { ?>
                                        <a href="<?= site_url('sertifikat/hapus_sertifikat/' . $s->id_seminar) ?>" 
                                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm rounded-lg transition-all duration-200">
                                            <i class="feather icon-trash-2 mr-2"></i>
                                            Hapus
                                        </a>
                                    <?php } else { ?>
                                        <button disabled 
                                                class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 text-sm rounded-lg cursor-not-allowed">
                                            <i class="feather icon-trash-2 mr-2"></i>
                                            Hapus
                                        </button>
                                    <?php } ?>
                                </div>
                            </td>

<script>
// Menangani tampilan nama file yang dipilih
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        const fileNameDisplay = this.parentElement.querySelector('.selected-file-name');
        if (fileName) {
            fileNameDisplay.textContent = fileName;
        } else {
            fileNameDisplay.textContent = '';
        }
    });
});
</script>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>