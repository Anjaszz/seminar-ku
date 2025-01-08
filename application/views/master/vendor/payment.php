<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Langganan Vendor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background: linear-gradient(-45deg, #3b82f6, #4f46e5, #2563eb, #1e40af);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        .custom-btn-shadow:hover {
            box-shadow: 0 10px 20px -10px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>

<body class="h-full bg-gradient-to-br from-blue-50 to-white">
    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-2xl">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-blue-600 rounded-2xl mx-auto flex items-center justify-center animate-float mb-6">
                    <i class="fas fa-credit-card text-white text-4xl"></i>
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">Pembayaran Langganan Vendor</h2>
                <p class="text-lg text-gray-600">Selesaikan pembayaran Anda untuk mengaktifkan layanan vendor</p>
            </div>

            <div class="glass rounded-2xl p-8 shadow-xl mb-8">
                <div class="space-y-6 mb-8">
                    <div class="flex items-center justify-between pb-6 border-b border-gray-200">
                        <span class="text-gray-600">Status Pembayaran</span>
                        <span class="px-2 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                            Menunggu Pembayaran
                        </span>
                    </div>

                    <!-- Total Pembayaran -->
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-blue-600">Rp <?= number_format($this->session->userdata('harga'), 0, ',', '.'); ?></span>
                    </div>
                </div>

                <div class="grid grid-cols-4 gap-4 mb-8">
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors group">
                        <i class="fab fa-cc-visa text-3xl text-gray-400 group-hover:text-blue-600"></i>
                    </div>
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-red-50 transition-colors group">
                        <i class="fab fa-cc-mastercard text-3xl text-gray-400 group-hover:text-red-500"></i>
                    </div>
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 transition-colors group">
                        <i class="fa-solid fa-wallet text-3xl text-gray-400 group-hover:text-green-600"></i>
                    </div>
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors group">
                        <i class="fas fa-university text-3xl text-gray-400 group-hover:text-green-600"></i>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button id="pay-button" class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transform transition-all duration-200 custom-btn-shadow">
                        <i class="fas fa-lock mr-2"></i>
                        Bayar Sekarang
                    </button>
                    <a href="<?= site_url('daftar/vendor'); ?>" class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transform transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="text-center text-gray-500 text-sm flex items-center justify-center">
                <i class="fas fa-shield-alt mr-2 text-green-500"></i>
                Pembayaran Anda aman dan terenkripsi
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('<?= $snap_token; ?>', {
                onSuccess: function(result) {
                    fetch('<?= site_url('daftar/handle_payment'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(result)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil',
                                text: 'Terima kasih! Pembayaran Anda telah berhasil diproses.',
                                showConfirmButton: false,
                                timer: 2000,
                                customClass: {
                                    popup: 'rounded-xl',
                                    title: 'text-xl font-bold',
                                    content: 'text-gray-600'
                                }
                            }).then(() => {
                                window.location.href = '<?= site_url('daftar/success'); ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Terjadi kesalahan dalam memperbarui status pembayaran.',
                                customClass: {
                                    popup: 'rounded-xl'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Terjadi kesalahan dalam mengirimkan data pembayaran.',
                            customClass: {
                                popup: 'rounded-xl'
                            }
                        });
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Diproses',
                        text: 'Mohon tunggu, pembayaran Anda sedang diproses.',
                        customClass: {
                            popup: 'rounded-xl'
                        }
                    });
                },
                onError: function(result) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Terjadi kesalahan dalam proses pembayaran.',
                        customClass: {
                            popup: 'rounded-xl'
                        }
                    });
                },
                onClose: function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Dibatalkan',
                        text: 'Anda menutup halaman pembayaran sebelum menyelesaikan transaksi.',
                        customClass: {
                            popup: 'rounded-xl'
                        }
                    });
                }
            });
        };
    </script>
</body>
</html>
