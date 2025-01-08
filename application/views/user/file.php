<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File/Modul</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-20">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-blue-600 flex items-center border-b border-blue-500 pb-4">
                <i class="fas fa-file-alt mr-3"></i>
                File/Modul
            </h1>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">
                    Silakan unduh file/modul yang Anda ikuti.
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-600">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Nama Seminar
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                File
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        $no = 1;
                        foreach ($file_data as $s) { ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $no++ ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $s->nama_seminar ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php if (!empty($s->file)) { ?>
                                        <div class="flex items-center justify-center space-x-2">
                                            <i class="fas fa-file-download text-blue-500"></i>
                                            <span class="truncate max-w-xs"><?= htmlspecialchars($s->file) ?></span>
                                        </div>
                                    <?php } else { ?>
                                        <span class="text-gray-400">No File</span>
                                    <?php } ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex justify-center">
                                        <?php if (empty($s->file)): ?>
                                            <button disabled 
                                                    class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">
                                                <i class="fas fa-download mr-2"></i>
                                                Unduh
                                            </button>
                                        <?php else: ?>
                                            <a href="<?= base_url('uploads/file/' . $s->file); ?>" 
                                               download
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                                <i class="fas fa-download mr-2"></i>
                                                Unduh
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Empty State (if needed) -->
            <?php if (empty($file_data)): ?>
                <div class="py-12">
                    <div class="text-center">
                        <i class="fas fa-file-alt text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak Ada File</h3>
                        <p class="text-gray-500">Belum ada file/modul yang tersedia.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>