<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Tambahkan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen mt-20">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto mt-4">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <div class="bg-indigo-600 text-white px-6 py-4">
                    <h2 class="text-2xl font-bold">Komunitas Anda</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php if (!empty($komunitas_chats)): ?>
                        <?php foreach ($komunitas_chats as $chat): ?>
                            <div class="block hover:bg-gray-50 transition-colors duration-200">
                                <div class="px-6 py-4 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo base_url('uploads/poster/'.$chat->lampiran); ?>"
                                             alt="Foto Lampiran"
                                             class="w-14 h-14 rounded-full object-cover border-2 border-indigo-100">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <a href="<?php echo site_url('user/chat/index/'.$chat->id_vendor.'/'.$chat->id_seminar); ?>" 
                                           class="block">
                                            <p class="text-lg font-semibold text-gray-900 truncate"><?php echo $chat->nama_seminar; ?></p>
                                            <p class="text-sm text-gray-600 truncate">
                                                <span class="font-medium text-indigo-600"><?php echo $chat->nama_mhs; ?></span>
                                                : <?php echo $chat->pesan; ?>
                                            </p>
                                        </a>
                                    </div>
                                    <?php if (!empty($chat->created_at)): ?>
                                        <div class="text-sm text-gray-500">
                                            <?php echo date('d-m H:i', strtotime($chat->created_at)); ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Tambahkan icon keluar -->
                                    <button onclick="konfirmasiKeluar(<?php echo $chat->id_seminar; ?>)" 
                                            class="text-gray-400 hover:text-red-500 transition-colors">
                                        <i data-feather="log-out"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-6 py-4 text-center">
                            <p class="text-sm text-gray-500">Tidak ada data chat komunitas.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi Feather Icons
        feather.replace();

        function konfirmasiKeluar(idSeminar) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda yakin akan keluar grup komunitas?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request AJAX untuk menghapus data
                    $.ajax({
                        url: '<?php echo site_url('user/home/keluar'); ?>',
                        type: 'POST',
                        data: {
                            id_seminar: idSeminar,
                            id_mahasiswa: <?php echo $this->session->userdata('id_mahasiswa'); ?>,
                            <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if(response.success) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Anda telah keluar dari grup komunitas',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat keluar grup',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan pada server',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>