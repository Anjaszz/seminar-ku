
<div class="">
    <div class="max-w-7xl rounded-xl bg-white mx-auto py-3 px-4 sm:px-6 lg:px-8 flex flex-col gap-4">
    <h1 class="mt-2 text-2xl font-bold text-gray-900"><?= $title ?></h1>
        <div class="flex items-center space-x-2">
            
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm ">
                <a href="<?php echo site_url('home') ?>" class="hover:text-blue-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>
                <span>/</span>
                <a href="#!" class="hover:text-blue-500"><?= $parent ?></a>
                <span>/</span>
                <span class="hover:text-blue-500"><?= $title ?></span>
            </nav>
        </div>
       
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Form Content -->
        <div class="p-6">
            <?= $form_open ?>
            <div class="space-y-6">
                <!-- Name Input -->
                <div class="space-y-2">
                    <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700" ', $label_nama) ?>
                    <div class="mt-1">
                        <?= str_replace('class="', 'class="block w-full px-4 py-3 border-2 rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" ', $input_nama) ?>
                    </div>
                    <?php if (isset($fe_nama)): ?>
                        <p class="text-sm text-red-600"><?= $fe_nama ?></p>
                    <?php endif; ?>
                    <?php if (isset($invalid_nama)): ?>
                        <p class="text-sm text-red-600"><?= $invalid_nama ?></p>
                    <?php endif; ?>
                </div>

                <!-- Seminar Selection -->
                <div class="space-y-2">
                    <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700" ', $label_seminar) ?>
                    <div class="mt-1">
                        <?= str_replace('class="', 'class="block w-full px-4 border-2 py-3 rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" ', $ddseminar) ?>
                    </div>
                </div>

                
<!-- Photo Upload -->
<div class="space-y-2">
    <?= str_replace('class="', 'class="block text-sm font-medium text-gray-700 ', $label_foto) ?>
    <div class="mt-1 flex items-center space-x-4">
        <div class="flex items-center justify-center w-full">
            <label class="flex flex-col w-full h-auto border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 hover:border-blue-400 transition-all p-6">
                <div class="flex flex-col items-center justify-center">
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
                <?= str_replace('class="', 'class="hidden absolute" ', $input_foto) ?>
            </label>
        </div>
    </div>

    <!-- Preview untuk file yang baru diupload -->
    <div id="imagePreview" class="mt-3 hidden">
        <p class="text-sm text-gray-600 mb-2">Preview:</p>
        <img id="preview" src="#" alt="Preview" class="w-48 h-auto rounded-lg border border-gray-200">
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

                <!-- Hidden Input and Submit Button -->
                <div class="flex justify-end pt-6">
                    <?= $input_id ?>
                    <?= str_replace('class="', 'class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ', $submit) ?>
                </div>

            </div>
            <?= $form_close ?>
        </div>
    </div>
</div>

<script>
// Modern form validation
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
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.classList.add('w-32', 'h-32', 'object-cover', 'rounded-lg');
                    
                    const container = fileInput.parentElement;
                    const oldPreview = container.querySelector('img');
                    if (oldPreview) {
                        oldPreview.remove();
                    }
                    container.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>