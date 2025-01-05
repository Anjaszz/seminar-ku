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
                            <span class="text-gray-500"><?= $title ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Scanner Section -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6">
            <!-- Card Header -->
            <div class="flex justify-between items-center mb-6">
                <h5 class="text-xl font-semibold text-gray-800"><?= $nama_seminar ?></h5>
                <div class="relative">
                    <button type="button" class="p-2 hover:bg-gray-100 rounded-full focus:outline-none" data-toggle="dropdown">
                        <i class="feather icon-more-horizontal"></i>
                    </button>
                    <ul class="hidden absolute right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl z-20">
                        <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="feather icon-maximize mr-2"></i> Maximize
                        </a></li>
                        <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="feather icon-minus mr-2"></i> Collapse
                        </a></li>
                        <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="feather icon-refresh-cw mr-2"></i> Reload
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Scanner Content -->
            <div class="space-y-4">
                <!-- Camera Selection -->
                <div id="sourceSelectPanel" class="hidden">
                    <label for="sourceSelect" class="block text-sm font-medium text-gray-700 mb-2">
                        Silahkan Pilih Kamera:
                    </label>
                    <select id="sourceSelect" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                    </select>
                </div>

                <!-- Video Preview -->
                <div class="relative bg-black rounded-lg overflow-hidden">
                    <video id="video" class="w-full aspect-video object-cover"></video>
                    <!-- Scan Overlay -->
                    <div class="absolute inset-0 border-2 border-blue-400 opacity-50 animate-pulse pointer-events-none"></div>
                </div>

                <!-- Hidden Elements -->
                <textarea hidden name="id_peserta" id="result"></textarea>
                <input type="hidden" name="seminar" id="idSeminar" value="<?= $id_seminar ?>">

                <!-- Scan Button -->
                <button id="buttonScan" class="hidden w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    <i class="feather icon-check-circle mr-2"></i>
                    Cek Kehadiran
                </button>
            </div>
        </div>
    </div>

    <!-- Result Section -->
    <div id="showResult" class="bg-white rounded-xl shadow-sm overflow-hidden min-h-[400px]">
        <!-- Result will be loaded here via AJAX -->
        <div class="p-6 flex items-center justify-center h-full">
            <p class="text-gray-500">Hasil scan akan ditampilkan di sini</p>
        </div>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/backend/template/assets/plugins/zxing/zxing.min.js"></script>
<script type="text/javascript">
window.addEventListener('load', function() {
    let selectedDeviceId;
    let audio = new Audio("<?php echo base_url('assets/audio/beep.mp3'); ?>");
    const codeReader = new ZXing.BrowserMultiFormatReader();
    
    codeReader.getVideoInputDevices()
        .then((videoInputDevices) => {
            const sourceSelect = document.getElementById('sourceSelect');
            selectedDeviceId = videoInputDevices[0].deviceId;
            
            if (videoInputDevices.length >= 1) {
                videoInputDevices.forEach((element) => {
                    const sourceOption = document.createElement('option');
                    sourceOption.text = element.label;
                    sourceOption.value = element.deviceId;
                    sourceSelect.appendChild(sourceOption);
                });

                sourceSelect.onchange = () => {
                    selectedDeviceId = sourceSelect.value;
                };

                const sourceSelectPanel = document.getElementById('sourceSelectPanel');
                sourceSelectPanel.classList.remove('hidden');
            }

            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                if (result) {
                    console.log(result);
                    document.getElementById('result').textContent = result.text;
                    audio.play();
                    
                    // Disable scan button temporarily
                    $('#buttonScan').prop('disabled', true);
                    $('#buttonScan').addClass('opacity-50 cursor-not-allowed');
                    
                    setTimeout(() => {
                        $('#buttonScan').prop('disabled', false);
                        $('#buttonScan').removeClass('opacity-50 cursor-not-allowed');
                    }, 2000);
                    
                    $('#buttonScan').click();
                }

                if (err && !(err instanceof ZXing.NotFoundException)) {
                    console.error(err);
                    document.getElementById('result').textContent = err;
                }
            });
        })
        .catch((err) => {
            console.error(err);
            // Show error message to user
            document.getElementById('showResult').innerHTML = `
                <div class="p-6">
                    <div class="bg-red-50 text-red-700 p-4 rounded-lg">
                        <p>Gagal mengakses kamera. Pastikan browser Anda mendukung akses kamera dan Anda telah memberikan izin.</p>
                    </div>
                </div>
            `;
        });
});

// AJAX Process
let halaman = '<?= base_url() ?>';

$("#buttonScan").click(function() {
    let idPeserta = $('#result').val();
    let idSeminar = $('#idSeminar').val();
    let url = halaman + 'scan/proses_kehadiran';
    
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id: idPeserta,
            seminar: idSeminar
        },
        beforeSend: function() {
            $('#showResult').html(`
                <div class="p-6 flex items-center justify-center h-full">
                    <div class="animate-spin rounded-full h-12 w-12 border-4 border-blue-500 border-t-transparent"></div>
                </div>
            `);
        },
        success: function(msg) {
            $('#showResult').html(msg);
        },
        error: function() {
            $('#showResult').html(`
                <div class="p-6">
                    <div class="bg-red-50 text-red-700 p-4 rounded-lg">
                        <p>Terjadi kesalahan saat memproses data. Silakan coba lagi.</p>
                    </div>
                </div>
            `);
        }
    });
});

// Dropdown menu handler
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.querySelector('[data-toggle="dropdown"]');
    const dropdownMenu = dropdownButton.nextElementSibling;
    
    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
</script>