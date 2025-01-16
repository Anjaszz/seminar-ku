<!-- Header Section -->
<div class="bg-white rounded-xl shadow-sm mb-6 p-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?= $title ?></h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="<?php echo site_url('home') ?>" class="text-gray-500 hover:text-blue-600">
                            <i class="feather icon-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="feather icon-chevron-right text-gray-400 text-sm mx-2"></i>
                            <a href="<?php echo site_url('seminar') ?>" class="text-gray-500 hover:text-blue-600">
                                Seminar
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="feather icon-chevron-right text-gray-400 text-sm mx-2"></i>
                            <span class="text-gray-500"><?= $title ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- QR Code Section -->
<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden">
    <div class="p-6">
        <div class="max-w-2xl mx-auto">
            <!-- Seminar Info -->
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2"><?= $seminar->nama_seminar ?></h2>
                <p class="text-gray-600">
                    <i class="feather icon-calendar mr-2"></i>
                    <?= date('d F Y H:i', strtotime($seminar->tgl_pelaksana)) ?> WIB
                </p>
            </div>

            <!-- QR Code Display -->
            <div class="flex flex-col items-center justify-center space-y-4">
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
                    <img src="<?= base_url('uploads/qr_image/' . $qr_image) ?>" 
                         alt="QR Code Presensi" 
                         class="w-96 h-96"> <!-- Ukuran diperbesar -->
                </div>
                
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-4">
                        Scan QR Code ini untuk melakukan presensi pada seminar
                    </p>
                    
                    <div class="space-y-4"> <!-- Changed to vertical stack -->
                        <div>
                            <button onclick="toggleScan(this)" 
                                    data-seminar-id="<?= $seminar->id_seminar ?>"
                                    data-current-status="<?= $seminar->id_scan ?>"
                                    class="inline-flex items-center px-4 py-2 rounded-lg transition-colors
                                           <?= $seminar->id_scan == 1 ? 
                                               'bg-red-600 hover:bg-red-700 text-white' : 
                                               'bg-green-600 hover:bg-green-700 text-white' ?>">
                                <i class="feather <?= $seminar->id_scan == 1 ? 'icon-x' : 'icon-check' ?> mr-2"></i>
                                <?= $seminar->id_scan == 1 ? 'Nonaktifkan Presensi' : 'Aktifkan Presensi' ?>
                            </button>
                        </div>
                        <div>
                            <a href="<?= base_url('uploads/qr_image/' . $qr_image) ?>" 
                               download="qrcode_<?= $seminar->nama_seminar ?>.png"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="feather icon-download mr-2"></i>
                                Download QR Code
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleScan(button) {
    const seminarId = button.dataset.seminarId;
    const currentStatus = button.dataset.currentStatus;
    
    $.ajax({
        url: '<?= site_url('genqr/toggle_scan') ?>',
        type: 'POST',
        data: {
            id_seminar: seminarId,
            current_status: currentStatus,
            <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
        },
        dataType: 'json',
        beforeSend: function() {
            // Disable button dan tambahkan loading state
            button.disabled = true;
            button.innerHTML = '<i class="feather icon-loader mr-2 animate-spin"></i>Memproses...';
        },
        success: function(response) {
            console.log('Response:', response); // Untuk debugging
            
            if (response && response.success) {
                // Update tampilan button
                const newStatus = response.status;
                if (newStatus == 1) {
                    button.classList.remove('bg-green-600', 'hover:bg-green-700');
                    button.classList.add('bg-red-600', 'hover:bg-red-700');
                    button.innerHTML = '<i class="feather icon-x mr-2"></i>Nonaktifkan Presensi';
                } else {
                    button.classList.remove('bg-red-600', 'hover:bg-red-700');
                    button.classList.add('bg-green-600', 'hover:bg-green-700');
                    button.innerHTML = '<i class="feather icon-check mr-2"></i>Aktifkan Presensi';
                }
                button.dataset.currentStatus = newStatus;
                
                // Tampilkan notifikasi sukses
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    timer: 3000,
                    showConfirmButton: false
                });
            } else {
                throw new Error(response.message || 'Terjadi kesalahan');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error details:', {xhr, status, error}); // Untuk debugging
            
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.'
            });
            
            // Kembalikan button ke status sebelumnya
            const currentStatus = button.dataset.currentStatus;
            if (currentStatus == 1) {
                button.innerHTML = '<i class="feather icon-x mr-2"></i>Nonaktifkan Presensi';
            } else {
                button.innerHTML = '<i class="feather icon-check mr-2"></i>Aktifkan Presensi';
            }
        },
        complete: function() {
            // Enable button kembali
            button.disabled = false;
        }
    });
}
</script>