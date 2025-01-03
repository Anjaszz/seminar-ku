<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Seminar - <?php echo $seminar->nama_seminar; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
</head>

<body class="bg-gray-50 min-h-screen mt-20">
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header with Gradient -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                <h1 class="text-2xl md:text-3xl font-bold text-white flex items-center gap-3">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <?php echo $seminar->nama_seminar; ?>
                </h1>
            </div>

            <div class="p-6">
                <!-- Image Section -->
                <div class="mb-8">
                    <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" 
                         class="rounded-lg shadow-md w-full object-cover max-h-96 mx-auto"
                         alt="<?php echo $seminar->nama_seminar; ?>">
                </div>

                <!-- Quick Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <!-- Date Card -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <div class="text-blue-600 font-semibold mb-1">Tanggal Acara</div>
                        <div class="text-gray-800 flex items-center gap-2">
                            <i class="fas fa-calendar"></i>
                            <?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?>
                        </div>
                    </div>

                    <!-- Time Card -->
                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <div class="text-green-600 font-semibold mb-1">Waktu Mulai</div>
                        <div class="text-gray-800 flex items-center gap-2">
                            <i class="fas fa-clock"></i>
                            <?php echo date('H:i', strtotime($seminar->tgl_pelaksana)); ?> WIB
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                        <div class="text-purple-600 font-semibold mb-1">Lokasi</div>
                        <div class="text-gray-800 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo $seminar->nama_provinsi; ?>
                        </div>
                    </div>

                    <!-- Ticket Card -->
                    <div class="bg-orange-50 p-4 rounded-lg border border-orange-100">
                        <div class="text-orange-600 font-semibold mb-1">Sisa Tiket</div>
                        <div class="text-gray-800 flex items-center gap-2">
                            <i class="fas fa-ticket-alt"></i>
                            <?php echo $seminar->sisa_tiket; ?> / <?php echo $seminar->slot_tiket; ?>
                        </div>
                    </div>
                </div>

                <!-- Detailed Information -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        <!-- Speaker -->
                        <div class="p-4 hover:bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-4">
                                <div class="font-semibold text-gray-600 md:col-span-1">Pembicara</div>
                                <div class="md:col-span-3 text-gray-800"><?php echo $seminar->nama_pembicara; ?></div>
                            </div>
                        </div>

                        <!-- Detailed Location -->
                        <div class="p-4 hover:bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-4">
                                <div class="font-semibold text-gray-600 md:col-span-1">Detail Lokasi</div>
                                <div class="md:col-span-3 text-gray-800"><?php echo $seminar->lokasi; ?></div>
                            </div>
                        </div>

                        <!-- Background -->
                        <div class="p-4 hover:bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-4">
                                <div class="font-semibold text-gray-600 md:col-span-1">Latar Belakang</div>
                                <div class="md:col-span-3 text-gray-800">
                                    <p class="whitespace-pre-line"><?php echo $seminar->latar_belakang; ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Sponsor -->
                        <div class="p-4 hover:bg-gray-50">
                            <div class="grid grid-cols-1 md:grid-cols-4">
                                <div class="font-semibold text-gray-600 md:col-span-1">Sponsor</div>
                                <div class="md:col-span-3 text-gray-800"><?php echo $seminar->nama_sponsor; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="mt-8 text-center">
                    <button onclick="history.back()" 
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-full hover:bg-blue-700 transition duration-150 ease-in-out shadow-md hover:shadow-lg gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>