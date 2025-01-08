<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Langganan Vendor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script> <!-- Ganti dengan client key Anda -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .payment-container {
            margin-top: 50px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-container">
            <h2 class="text-center">Pembayaran Langganan Vendor</h2>
            <p class="text-center">Anda akan diarahkan ke halaman pembayaran. Silakan klik tombol di bawah ini untuk melanjutkan.</p>
            <div class="text-center">
                <button id="pay-button" class="btn btn-primary btn-lg btn-custom">Bayar Sekarang</button>
                <a href="<?= site_url('daftar/vendor'); ?>" class="btn btn-secondary btn-lg">Kembali</a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('<?= $snap_token; ?>', {
                onSuccess: function(result) {
                    // Kirim data ke server untuk menyimpan transaksi
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
                                text: 'Pembayaran Anda telah berhasil. Terima kasih!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = '<?= site_url('daftar/success'); ?>'; // Redirect ke halaman sukses
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal',
                                text: 'Terjadi kesalahan dalam memperbarui status pembayaran.',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Terjadi kesalahan dalam mengirimkan data pembayaran ke server.',
                        });
                    });
                },
                onPending: function(result) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Sedang Diproses',
                        text: 'Pembayaran sedang diproses, harap tunggu.',
                    });
                },
                onError: function(result) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Terjadi kesalahan dalam proses pembayaran.',
                    });
                },
                onClose: function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Dibatalkan',
                        text: 'Kamu menutup popup tanpa menyelesaikan pembayaran.',
                    });
                }
            });
        };
    </script>
</body>
</html>
