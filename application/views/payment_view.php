<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Seminar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-aAcgMzhiaWCUYg6y"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff; /* White background for the card */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            text-align: center; /* Center text */
        }
        h2 {
            color: #007bff; /* Bootstrap primary color */
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px; /* Adjust the size as needed */
            margin-bottom: 20px; /* Space between logo and title */
        }
        .button-container {
            display: flex; /* Menggunakan flexbox */
            justify-content: space-between; /* Membuat tombol berada di kiri dan kanan */
            margin-top: 20px; /* Memberikan jarak atas */
        }
        .btn-custom {
            flex: 1; /* Membuat tombol memiliki lebar yang sama */
            margin: 0 5px; /* Memberikan margin antar tombol */
            padding: 15px; /* Padding untuk tombol */
            font-size: 18px; /* Ukuran font tombol */
            border-radius: 5px; /* Membuat sudut tombol melengkung */
            transition: background-color 0.3s; /* Transisi untuk perubahan warna */
        }
        #continue-button {
            background-color: #28a745; /* Green background */
            border: none;
            color: white;
        }
        #continue-button:hover {
            background-color: #218838; /* Darker green on hover */
        }
        #back-button {
            background-color: #007bff; /* Blue background */
            border: none;
            color: white;
        }
        #back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo base_url() ?>assets/backend/template/assets/images/SIMAS.png" alt="SIMAS Logo" class="img-fluid mb-4">
        <h2>Anda akan diarahkan ke halaman pembayaran</h2>
        <div class="button-container">
            <button id="continue-button" class="btn-custom">
                <i class="fas fa-check"></i> Lanjutkan
            </button>
            <button id="back-button" class="btn-custom" onclick="history.back()">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>
    </div>

    <script type="text/javascript">
        var continueButton = document.getElementById('continue-button');
        continueButton.addEventListener('click', function () {
            window.snap.pay('<?php echo $snap_token; ?>', {
                onSuccess: function(result) {
                    console.log('success', result);

                    // Mengirim data pembayaran ke server
                    fetch('<?php echo base_url('Payment/confirm_payment'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_pendaftaran: '<?php echo $id_pendaftaran; ?>', // Pastikan id_pendaftaran terisi dengan benar
                            status: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Menampilkan alert dengan SweetAlert2
                            Swal.fire({
                                icon: 'success',
                                title: 'Pembayaran Berhasil',
                                text: 'Pembayaran Anda telah berhasil. Terima kasih!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                // Setelah alert ditutup, redirect ke halaman sukses
                                window.location.href = '<?php echo base_url("user/home"); ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Berhasil',
                                text: 'Pembayaran berhasil, tetapi terjadi kesalahan dalam memperbarui status.',
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
                    console.log('pending', result);
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Sedang Diproses',
                        text: 'Pembayaran sedang diproses, harap tunggu.',
                    });
                },
                onError: function(result) {
                    console.log('error', result);
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
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
