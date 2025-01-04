<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Breadcrumb -->
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-4 py-4 bg-white rounded-xl shadow-md">
            <div class="flex items-center space-x-2 text-gray-600 text-sm">
                <a href="<?php echo site_url('home') ?>" class="hover:text-blue-600">
                    <i class="fas fa-home"></i>
                </a>
                <span>/</span>
                <a href="#!" class="hover:text-blue-600"><?= $parent ?></a>
                <span>/</span>
                <span class="text-gray-500"><?= $title ?></span>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mt-2"><?= $title ?></h1>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 text-center">
                    <img class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-white shadow" 
                         src="<?php echo base_url() ?>assets/images/widget/user.png" 
                         alt="Profile">
                    <h2 class="text-xl font-bold text-gray-800 mt-4"><?= $nama_mhs ?></h2>
                    <div class="mt-6 pt-6 border-t">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-800"><?= $nama_prodi ?></h3>
                            <p class="text-gray-500">Departemen</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Details Card -->
            <div class="md:col-span-2 bg-white rounded-xl shadow-sm">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Profile Details</h2>
                        <a href="<?php echo site_url("mahasiswa/update/{$id_mahasiswa}") ?>" 
                           class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit
                        </a>
                    </div>

                    <div class="space-y-6">
                        <!-- Department -->
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-street-view text-red-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Departemen</p>
                                <p class="text-gray-800"><?= $nama_fakultas ?></p>
                            </div>
                        </div>

                        <!-- Major -->
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-tag text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Jurusan</p>
                                <p class="text-gray-800"><?= $nama_prodi ?></p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-at text-indigo-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="text-gray-800"><?= $email ?></p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-mobile-alt text-green-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">No Telepon</p>
                                <p class="text-gray-800"><?= $no_telp ?></p>
                            </div>
                        </div>

                        <!-- Birthday -->
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-birthday-cake text-purple-500"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500">Tanggal Lahir</p>
                                <p class="text-gray-800"><?= $tanggal_lahir ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>