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
                            <span class="text-gray-500"><?= $parent ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="feather icon-chevron-right text-gray-400 text-sm mx-2"></i>
                            <span class="text-gray-900"><?= $title ?></span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Form Section -->
<div class="bg-white rounded-xl shadow-sm">
    <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800"><?= $title ?></h2>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                <i class="feather icon-more-horizontal"></i>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-10">
                <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="fullscreen">
                    <i class="feather icon-maximize mr-2"></i> Maximize
                </a>
                <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="collapse">
                    <i class="feather icon-minus mr-2"></i> Collapse
                </a>
                <a href="#!" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-action="reload">
                    <i class="feather icon-refresh-cw mr-2"></i> Reload
                </a>
            </div>
        </div>
    </div>

    <div class="p-6">
        <?= str_replace('class="', 'class="space-y-6 ', $form_open) ?>
            <!-- Name Input -->
            <div class="space-y-2">
                <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700 ', $label_nama) ?>
                <div class="mt-1">
                    <?= str_replace('class="', 'class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm ', $input_nama) ?>
                </div>
                <?php if (isset($fe_nama)): ?>
                    <p class="mt-1 text-sm text-red-600"><?= $fe_nama ?></p>
                <?php endif; ?>
                <?php if (isset($invalid_nama)): ?>
                    <p class="mt-1 text-sm text-red-600"><?= $invalid_nama ?></p>
                <?php endif; ?>
            </div>

            <!-- Background Input -->
            <div class="space-y-2">
                <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700 ', $label_latarbelakang) ?>
                <div class="mt-1">
                    <?= str_replace('class="', 'class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm ', $input_latarbelakang) ?>
                </div>
                <?php if (isset($fe_latarbelakang)): ?>
                    <p class="mt-1 text-sm text-red-600"><?= $fe_latarbelakang ?></p>
                <?php endif; ?>
                <?php if (isset($invalid_latarbelakang)): ?>
                    <p class="mt-1 text-sm text-red-600"><?= $invalid_latarbelakang ?></p>
                <?php endif; ?>
            </div>

            <!-- Seminar Selection -->
            <div class="space-y-2">
                <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700 ', $label_seminar) ?>
                <div class="mt-1">
                    <?= str_replace('class="', 'class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm ', $ddseminar) ?>
                </div>
            </div>

            <!-- Photo Upload -->
          <!-- Photo Upload -->
<div class="space-y-2">
    <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700 ', $label_foto) ?>
    <div class="mt-1 flex items-center space-x-4">
        <div class="flex items-center justify-center w-full flex-col">
            <label class="flex flex-col w-full h-auto border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 hover:border-blue-400 transition-all">
                <div class="flex flex-col items-center justify-center p-6">
                    <!-- Icon Upload Cloud -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-blue-500 mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>

                    <!-- Icon Image -->
                    <div class="flex items-center gap-2 text-blue-600 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span class="text-sm">Image files only</span>
                    </div>

                    <p class="text-sm text-gray-600 mb-1">Drag and drop your file here or</p>
                    <span class="text-blue-600 font-medium hover:underline">browse to upload</span>
                </div>
               
                <!-- Preview untuk file yang baru diupload -->
                <div id="imagePreview" class="hidden p-6 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-2">Preview:</p>
                    <img id="preview" src="#" alt="Preview" class="w-48 h-auto rounded-lg border border-gray-200">
                </div>

                <?= str_replace('class="', 'class="hidden absolute" ', $input_foto) ?>
            </label>
        </div>
    </div>

    <?php if(isset($foto) && $foto): ?>
        <div class="mt-3">
            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Current file:</span>
                <span class="font-medium text-gray-700"><?= $foto; ?></span>
            </div>
            <img src="<?= base_url('uploads/photos/' . $foto) ?>" 
                 alt="Current photo" 
                 class="w-48 h-auto rounded-lg border border-gray-200">
        </div>
    <?php endif; ?>
</div>

            <!-- Submit Button -->
            <div class="flex justify-end pt-5">
                <?= $input_id ?>
                <?= str_replace(
                    'class="',
                    'class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ',
                    $submit
                ) ?>
            </div>
        <?= $form_close ?>
    </div>
</div>

<!-- Add Alpine.js for dropdown functionality -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
// Form validation
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    const forms = document.getElementsByClassName('needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // File input preview
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
        const previewContainer = fileInput.closest('div');
        
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.classList.add('mt-2', 'w-32', 'h-32', 'object-cover', 'rounded-lg');
                    
                    const oldPreview = previewContainer.querySelector('img:not([aria-hidden])');
                    if (oldPreview) {
                        oldPreview.remove();
                    }
                    previewContainer.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>