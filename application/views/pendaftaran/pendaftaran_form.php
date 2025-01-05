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
                            <a href="#!" class="text-gray-500 hover:text-blue-600"><?= $parent ?></a>
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

<!-- Form Section -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6">
        <!-- Card Header with Options -->
        <div class="flex justify-between items-center mb-6">
            <h5 class="text-xl font-semibold text-gray-800"><?= $form ?></h5>
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
                    <li><a href="#!" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="feather icon-trash mr-2"></i> Remove
                    </a></li>
                </ul>
            </div>
        </div>

        <!-- Form Content -->
        <?= $formopen ?>
        <div class="max-w-xl mx-auto space-y-6">
            <!-- Peserta Field -->
            <div class="space-y-2">
                <?php
                // Mengubah class pada label
                $label_peserta = str_replace('class="form-label"', 'class="block text-sm font-medium text-gray-700 mb-1"', $label_peserta);
                echo $label_peserta;
                
                // Mengubah class pada dropdown
                $ddpeserta = str_replace(
                    'class="form-control"',
                    'class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"',
                    $ddpeserta
                );
                echo $ddpeserta;
                ?>
                <div class="valid-feedback text-sm text-green-600"></div>
            </div>

            <!-- Status Pembayaran Field -->
            <div class="space-y-2">
                <?php
                $label_statusbyr = str_replace('class="form-label"', 'class="block text-sm font-medium text-gray-700 mb-1"', $label_statusbyr);
                echo $label_statusbyr;
                
                $ddstatusbyr = str_replace(
                    'class="form-control"',
                    'class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"',
                    $ddstatusbyr
                );
                echo $ddstatusbyr;
                ?>
                <div class="valid-feedback text-sm text-green-600"></div>
            </div>

            <!-- Metode Pembayaran Field -->
            <div class="space-y-2" id="metode" style="display: none;">
                <?php
                $label_metodebyr = str_replace('class="form-label"', 'class="block text-sm font-medium text-gray-700 mb-1"', $label_metodebyr);
                echo $label_metodebyr;
                
                $ddmetodebyr = str_replace(
                    'class="form-control"',
                    'class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"',
                    $ddmetodebyr
                );
                echo $ddmetodebyr;
                ?>
                <div class="valid-feedback text-sm text-green-600"></div>
            </div>

            <!-- Hidden Fields and Submit -->
            <div class="pt-4">
                <?= $inputid ?>
                <?= $input_seminar ?>
                <?php
                // Mengubah class pada tombol submit
                $submit = str_replace(
                    'class="btn btn-primary"',
                    'class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"',
                    $submit
                );
                echo $submit;
                ?>
            </div>
        </div>
        <?= $formclose ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle dropdown menu
    const dropdownButton = document.querySelector('[data-toggle="dropdown"]');
    const dropdownMenu = dropdownButton.nextElementSibling;
    
    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Form validation
    const forms = document.getElementsByClassName('needs-validation');
    Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});

// Toggle metode pembayaran
document.getElementById('sts_byr').addEventListener('change', function() {
    const metodeDiv = document.getElementById('metode');
    if (this.value === '1') {
        metodeDiv.style.display = 'block';
    } else {
        metodeDiv.style.display = 'none';
    }
});
</script>