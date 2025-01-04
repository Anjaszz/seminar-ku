<!-- Page Header -->
<div class="">
    <div class="max-w-7xl rounded-xl bg-white mx-auto py-3 px-4 sm:px-6 lg:px-8 flex flex-col gap-4">
    <h1 class="mt-2 text-2xl font-bold text-gray-900"><?= $title ?></h1>
        <div class="flex items-center space-x-2">
            <a href="<?php echo site_url('home') ?>" class="text-gray-500 hover:text-gray-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            <span class="text-gray-500">/</span>
            <span class="text-gray-500"><?= $parent ?></span>
            <span class="text-gray-500">/</span>
            <span class="text-gray-900 font-medium"><?= $title ?></span>
        </div>
       
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl bg-white mx-auto py-6 sm:px-6 lg:px-8 shadow rounded-lg mt-2">
    <div class=" ">
        <div class="px-4 py-5 sm:p-6">
            <?= $form_open ?>
            <div class="space-y-6">
                <!-- Seminar Selection -->
                <div>
                    <?= $label_seminar ?>
                    <div class="mt-1">
                        <?= str_replace('class="', 'class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm ', $ddseminar) ?>
                    </div>
                </div>

                <!-- Price Input -->
                <div>
                    <?= $label_harga ?>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <?= str_replace('class="', 'class="mt-1 pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm ', $input_harga) ?>
                    </div>
                    <?= str_replace('class="', 'class="mt-1 text-sm text-red-600 ', $fe_harga) ?>
                </div>

                <!-- Slot Input -->
                <div>
                    <?= $label_slot ?>
                    <div class="mt-1">
                        <?= str_replace('class="', 'class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm ', $input_slot) ?>
                    </div>
                    <?= str_replace('class="', 'class="mt-1 text-sm text-red-600 ', $fe_slot) ?>
                </div>

                <!-- Hidden Input and Submit -->
                <div class="flex justify-end">
                    <?= $input_id ?>
                    <?= str_replace('class="', 'class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ', $submit) ?>
                </div>
            </div>
            <?= $form_close ?>
        </div>
    </div>
</div>

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
});

// Currency formatter
const rupiahInput = document.getElementById('rupiah');
if (rupiahInput) {
    rupiahInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value === '') return;
        
        value = new Intl.NumberFormat('id-ID').format(value);
        this.value = `Rp ${value}`;
    });

    rupiahInput.addEventListener('blur', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value === '') return;
        
        value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(value);
        this.value = value;
    });
}
</script>