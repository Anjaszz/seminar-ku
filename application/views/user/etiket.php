<?php
// File: application/views/tiket_seminar.php
?>
<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Seminar</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        .animate-pulse-custom {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="h-full ">
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8 mt-20">
        <!-- Header Message -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-semibold text-gray-700">
                Tiket Seminar Anda
            </h2>
            <p class="mt-2 text-gray-600">
                Silahkan Scan QR Code seminar Anda.
            </p>
        </div>

        <!-- Ticket Container -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Ticket Image Container -->
                <div class="relative">
                    <img 
                        src="<?php echo base_url('./assets/images/ticket/tiketsimas1.jpg'); ?>" 
                        class="w-full h-auto"
                        alt="Ticket Background"
                    />
                    
                    <!-- QR Code Overlay -->
                    <img 
                        src="<?php echo $qrcode; ?>" 
                        class="absolute top-16 right-4 w-[17%] md:w-[19%]"
                        alt="QR Code"
                    />
                    
                    <!-- Seminar Details Overlay -->
                    <div class="absolute top-1/4 left-1/2 transform -translate-x-1/2 text-center">
                        <h3 class="text-white text-lg md:text-2xl lg:text-3xl font-semibold italic drop-shadow-lg">
                            <?php echo $nama_seminar; ?>
                        </h3>
                        
                        <div class="mt-4 flex items-center justify-center space-x-4 text-white text-sm md:text-base">
                            <span class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <?php echo date('d M Y', strtotime($tgl_pelaksana)); ?>
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                <?php echo date('H:i', strtotime($tgl_pelaksana)); ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-4 bg-gray-50 flex justify-between items-center gap-4">
                    <button 
                        onclick="window.location.href='<?php echo base_url('user/home/terdaftar'); ?>'"
                        class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
                    >
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </button>
                    
                    <button 
                        id="btn-show-qrcode"
                        data-mahasiswa="<?php echo $id_mahasiswa; ?>"
                        data-seminar="<?php echo $id_seminar; ?>"
                        class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors"
                    >
                        <i class="fas fa-qrcode mr-2"></i>
                        Scan QR
                    </button>
                </div>
            </div>
        </div>

        <!-- QR Code Popup -->
        <div id="qrcode-popup" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex justify-center items-center">
            <div class="min-h-screen px-4 text-center justify-center items-center flex">
                <div class=" bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all">
                    <div class="text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                            Silahkan scan QR code Anda
                        </h3>
                        
                        <!-- Timer Display -->
                        <div class="flex items-center justify-center space-x-2 text-red-600 text-xl font-semibold mb-4">
                            <i class="fas fa-clock animate-pulse-custom"></i>
                            <span id="countdown-timer">10</span>
                        </div>
                        
                        <!-- QR Code Image -->
                        <div class="mt-4">
                            <img 
                                src="<?php echo $qrcode; ?>" 
                                alt="QR Code" 
                                class="mx-auto w-64 h-64"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var popup = document.getElementById('qrcode-popup');
        var showQRCodeBtn = document.getElementById('btn-show-qrcode');
        var countdownTimer = document.getElementById('countdown-timer');
        var countdownValue = 10;

        showQRCodeBtn.addEventListener('click', function() {
            // Update scan status
            $.ajax({
                url: '<?php echo base_url("user/generate/updateScan"); ?>',
                type: 'POST',
                data: {
                    id_mahasiswa: showQRCodeBtn.getAttribute('data-mahasiswa'),
                    id_seminar: showQRCodeBtn.getAttribute('data-seminar')
                },
                dataType: 'json',
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan pada server',
                        customClass: {
                            popup: 'rounded-xl'
                        }
                    });
                }
            });

            // Show popup and start countdown
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.style.overflow = 'hidden';
            countdownValue = 10;
            countdownTimer.textContent = countdownValue;

            var countdownInterval = setInterval(function() {
                countdownValue--;
                countdownTimer.textContent = countdownValue;
                
                if (countdownValue <= 0) {
                    clearInterval(countdownInterval);
                    popup.classList.add('hidden');
                    popup.classList.remove('flex');
                    document.body.style.overflow = 'auto';

                    // Check attendance
                    $.ajax({
                        url: '<?php echo base_url("user/generate/cekPresensi"); ?>',
                        type: 'POST',
                        data: {
                            id_mahasiswa: showQRCodeBtn.getAttribute('data-mahasiswa'),
                            id_seminar: showQRCodeBtn.getAttribute('data-seminar')
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                    customClass: {
                                        popup: 'rounded-xl'
                                    }
                                }).then(() => {
                                    window.location.href = '<?php echo base_url("user/home/file"); ?>';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.message,
                                    customClass: {
                                        popup: 'rounded-xl'
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Ajax Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan pada server',
                                customClass: {
                                    popup: 'rounded-xl'
                                }
                            });
                        }
                    });
                }
            }, 1000);
        });

        // Close popup when clicking outside
        
    });
    </script>
</body>
</html>