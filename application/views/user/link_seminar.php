<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Seminar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 my-28">
        <!-- Header Section -->
        <div class="border-b border-blue-500 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-blue-600 flex items-center">
                <i class="fas fa-link mr-3"></i>
                Link Seminar Online
            </h1>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <!-- Seminar Info -->
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Poster Image -->
                <div class="w-full md:w-1/3">
                    <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" 
                         alt="<?php echo htmlspecialchars($seminar->nama_seminar); ?>"
                         class="w-full h-auto rounded-lg shadow-md">
                </div>

                <!-- Seminar Details -->
                <div class="w-full md:w-2/3">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        <?php echo $seminar->nama_seminar; ?>
                    </h2>

                    <!-- Link Section -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Link Seminar:</label>
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <input type="text" 
                                       id="seminarLink" 
                                       value="<?php echo $seminar->link_seminar; ?>" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       readonly>
                            </div>
                            <button onclick="copyLink()" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                <i class="fas fa-copy mr-2"></i>
                                Copy
                            </button>
                            <a href="<?php echo $seminar->link_seminar; ?>" 
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Buka
                            </a>
                        </div>
                    </div>

                    <!-- Link Info -->
                    <div class="mt-4 text-sm text-gray-600">
                        <p class="flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            Klik tombol copy untuk menyalin link seminar atau klik tombol buka untuk langsung menuju ke seminar.
                        </p>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <script>
    function copyLink() {
        // Get the link input field
        var linkInput = document.getElementById('seminarLink');
        
        // Select the text
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // For mobile devices
        
        // Copy the text
        navigator.clipboard.writeText(linkInput.value).then(() => {
            // Show success message using SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'Link Berhasil Disalin!',
                text: 'Link seminar telah disalin ke clipboard.',
                showConfirmButton: false,
                timer: 1500
            });
        }).catch(err => {
            // Show error message if copying fails
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyalin Link',
                text: 'Terjadi kesalahan saat menyalin link.',
                showConfirmButton: true
            });
        });
    }
    </script>
</body>
</html>