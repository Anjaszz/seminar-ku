<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seminar yang Belum Dibayar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  mt-28">
        <div class="border-b border-blue-500 pb-4">
            <h1 class="text-2xl font-bold text-blue-600 flex items-center">
                <i class="fas fa-money-check-alt mr-2"></i>
                Seminar yang Belum Dibayar
            </h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($seminar_data)): ?>
                <?php foreach ($seminar_data as $seminar): 
                    $today = new DateTime();
                    $seminar_date = new DateTime($seminar->tgl_pelaksana);
                    $remaining_days = $today->diff($seminar_date)->days;
                ?>
                    <!-- Seminar Card -->
                    <div class="group relative bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="relative aspect-w-16 aspect-h-16 overflow-hidden rounded-t-lg">
                            <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" 
                                 class="object-cover w-full h-64"
                                 alt="<?php echo htmlspecialchars($seminar->nama_seminar); ?>">
                            <!-- Remaining Days Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?php echo $remaining_days; ?> Hari Lagi
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                <i class="fas fa-chalkboard-teacher text-blue-500 mr-2"></i>
                                <?php echo $seminar->nama_seminar; ?>
                            </h3>
                            
                            <!-- Seminar Details -->
                            <div class="space-y-2 mb-4">
                                <p class="flex items-center text-gray-600">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                    <span class="font-medium">
                                        <?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?>
                                    </span>
                                </p>
                                <p class="flex items-center text-gray-600">
                                    <i class="fas fa-tags text-blue-500 mr-2"></i>
                                    <span class="font-medium">
                                        Rp <?php echo number_format($seminar->harga_tiket, 0, ',', '.'); ?>
                                    </span>
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 mt-4">
                                <a href="<?php echo base_url('payment/bayar/' . $seminar->id_seminar); ?>" 
                                   class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <i class="fas fa-money-bill mr-2"></i>
                                    Bayar
                                </a>
                                <button class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 btn-batal"
                                        data-url="<?php echo base_url('user/home/batal/' . $seminar->id_pendaftaran); ?>">
                                    <i class="fas fa-ban mr-2"></i>
                                    Batalkan
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="rounded-lg bg-blue-50 p-6 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-info-circle text-4xl text-blue-500 mb-4"></i>
                            <p class="text-lg font-medium text-blue-900">
                                Tidak ada seminar yang belum dibayar.
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- SweetAlert2 Scripts -->
    <script>
        document.querySelectorAll('.btn-batal').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan aksi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-lg',
                        cancelButton: 'rounded-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });

        // Success Alert
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Pembatalan Berhasil',
                text: '<?php echo $this->session->flashdata('success'); ?>',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'rounded-lg'
                }
            });
        <?php endif; ?>

        // Error Alert
        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Pembatalan Gagal',
                text: '<?php echo $this->session->flashdata('error'); ?>',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'rounded-lg'
                }
            });
        <?php endif; ?>
    </script>
</body>
</html>