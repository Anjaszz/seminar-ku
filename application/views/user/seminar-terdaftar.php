<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminar Yang Diikuti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8  mt-28">
        <div class="border-b border-blue-500 pb-4">
            <h1 class="text-2xl font-bold text-blue-600 flex items-center">
                <i class="fas fa-graduation-cap mr-3"></i>
                Seminar Yang Diikuti
            </h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if (!empty($seminar_data)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($seminar_data as $seminar):
                    $today = new DateTime();
                    $seminar_date = new DateTime($seminar->tgl_pelaksana);
                    $remaining_days = $today->diff($seminar_date)->days;
                ?>
                    <!-- Seminar Card -->
                    <div class="group relative bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="relative aspect-w-3 aspect-h-2 rounded-t-lg overflow-hidden">
                            <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" 
                                 alt="<?php echo htmlspecialchars($seminar->nama_seminar); ?>"
                                 class="w-full h-64 object-cover">
                            
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
                            <h3 class="text-lg font-semibold text-blue-600 mb-2 line-clamp-2 flex items-start">
                                <i class="fas fa-chalkboard-teacher mt-1 mr-2"></i>
                                <?php echo $seminar->nama_seminar; ?>
                            </h3>
                            
                            <!-- Date Info -->
                            <p class="flex items-center text-gray-600 mb-4">
                                <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                <span class="font-medium">
                                    <?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?>
                                </span>
                            </p>

                            <!-- Action Buttons -->
                            <!-- Action Buttons -->
<div class="flex flex-col gap-3 mt-4">
    <a href="<?php echo base_url('user/home/detail/' . $seminar->id_seminar); ?>" 
       class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
        <i class="fas fa-info-circle mr-2"></i>
        Detail
    </a>

    <?php if ($seminar->id_jenis == 1): ?>
        <a href="<?php echo base_url('user/home/linkseminar/' . $seminar->id_seminar); ?>" 
           class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
            <i class="fas fa-link mr-2"></i>
            Link Seminar
        </a>
    <?php else: ?>
        <a href="<?php echo base_url('user/generate/etiket/' . $seminar->id_mahasiswa . '/' . $seminar->id_seminar); ?>" 
           class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
            <i class="fas fa-qrcode mr-2"></i>
            E-Tiket
        </a>
    <?php endif; ?>

    <a href="<?php echo base_url('user/home/gabungKomunitas/' . $seminar->id_seminar); ?>" 
       class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-full text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
        <i class="fas fa-users mr-2"></i>
        Gabung Komunitas
    </a>
</div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center py-12 bg-white rounded-lg shadow-sm">
                <div class="rounded-full bg-blue-100 p-3 mb-4">
                    <i class="fas fa-info-circle text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Seminar</h3>
                <p class="text-gray-500">
                    Anda belum mendaftar pada seminar apapun.
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>