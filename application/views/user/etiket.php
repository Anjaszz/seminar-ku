<?php
// File: application/views/tiket_seminar.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Seminar</title>

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/backend/template/assets/plugins/bootstrap/css/bootstrap.min.css">

    <style>
        .ticket-container {
            width: 90%;
            max-width: 800px;
            margin: auto;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: auto;
        }

        .imgA1 {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .imgB1 {
            position: absolute;
            z-index: 2;
            top: 22.7%;
            right: 5%;
            width: 17.5%;
        }

        .btn {
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.3s;
        }
   
        .d-flex .btn {
            flex: 0 0 50%;
            margin: 10px 2px 10px 10px;
        }

        .seminar-name {
            position: absolute;
            top: 23%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2.5vw;
            font-weight: auto;
            font-style: italic;
            color: #fff;
        }

        .seminar-datetime {
            position: absolute;
            top: 51%;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1vw;
            color: #fff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .seminar-datetime i {
            margin-right: 5px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            animation: fadeIn 0.5s;
            text-align: center;
        }

        .popup-content img {
            width: 300px;
            height: 300px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media only screen and (max-width: 480px) {
            .seminar-name {
                font-size: 3.3vw;
                top: 18.5%;
            }

            .seminar-datetime {
                font-size: 1.3vw;
                top: 38%;
                gap: auto;
            }

            .ticket-container {
                padding: 10px;
            }

            .imgB1 {
                top: 17%;
                right: 5%;
                width: 18%;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4 text-center">
    <p style="font-size: 1.2rem; color: #555; margin-top: 20px;">
        Silahkan lihat QR Code seminar Anda.
    </p>
</div>

<?php
// Simpan tampilan tiket seminar dalam sebuah variabel
$ticketCard = '
<div class="col-sm-12">
    <div class="ticket-container">
        <img class="img-responsive imgA1" src="' . base_url('./assets/images/ticket/tiketsimas1.jpg') . '" />
        <img class="img-responsive imgB1" src="' . $qrcode . '" alt="QR Code" />

        <h4 class="seminar-name">' . $nama_seminar . '</h4>
        <p class="seminar-datetime">
            <i class="fas fa-calendar-alt"></i> 
            ' . date('d M Y', strtotime($tgl_pelaksana)) . ' 
            <i class="fas fa-clock"></i> 
            ' . date('H:i', strtotime($tgl_pelaksana)) . '
        </p>

        <div class="mt-3 d-flex justify-between">
            <button class="btn btn-primary ms-0 w-200 btn-batal" onclick="window.location.href=\'' . base_url('user/home/terdaftar') . '\';">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>

            <button id="btn-show-qrcode" class="btn btn-success" data-mahasiswa="' . $id_mahasiswa . '" data-seminar="' . $id_seminar . '">
                <i class="fas fa-qrcode"></i> Scan QR
            </button>
        </div>
    </div>
</div>
';

// Tampilkan tampilan tiket seminar
echo $ticketCard;
?>

<div id="qrcode-popup" class="popup" style="display: none; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0,0,0,0.5); text-align: center;">
    <div class="popup-content" style="background-color: white; padding: 20px; border-radius: 10px; text-align: center;">
        <h5>Silahkan scan QR code Anda</h5>

        <!-- Timer container with animated Bootstrap icon -->
        <div class="timer-container" style="display: flex; align-items: center; justify-content: center; font-size: 20px; color: red; margin: 10px 0;">
            <i class="bi bi-clock-fill animated-icon"></i> <!-- Bootstrap Icon with animation -->
            <div id="countdown-timer" style="margin-left: 10px;">10</div>
        </div>

        <img src="<?php echo $qrcode; ?>" alt="QR Code" style="width: 300px; height: 300px; margin-top: 10px;">
    </div>
</div>


<!-- JavaScript Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var popup = document.getElementById('qrcode-popup');
    var showQRCodeBtn = document.getElementById('btn-show-qrcode');
    var countdownTimer = document.getElementById('countdown-timer');
    var countdownValue = 10; // Hitungan mundur mulai dari 10 detik

    showQRCodeBtn.addEventListener('click', function() {
        // Panggil fungsi updateScan saat tombol diklik
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
                    text: 'Terjadi kesalahan pada server'
                });
            }
        });

        // Tampilkan popup QR code dan atur timer mundur
        popup.style.display = 'flex';
        document.body.style.pointerEvents = 'none';
        countdownValue = 10; // Reset countdown ke 10 detik
        countdownTimer.textContent = countdownValue;

        // Mulai hitungan mundur
        var countdownInterval = setInterval(function() {
            countdownValue--;
            countdownTimer.textContent = countdownValue;
            
            if (countdownValue <= 0) {
                clearInterval(countdownInterval);
                popup.style.display = 'none';
                document.body.style.pointerEvents = 'auto';

                // Panggil fungsi cekPresensi setelah QR code hilang
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
                                text: response.message
                            }).then(() => {
                                // Redirect ke halaman user/file setelah alert berhasil
                                window.location.href = '<?php echo base_url("user/home/file"); ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan pada server'
                        });
                    }
                });
            }
        }, 1000); // Update setiap 1 detik

    });

    // Tutup popup jika klik di luar
    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
            document.body.style.pointerEvents = 'auto';
        }
    });
});

</script>

</body>
</html>