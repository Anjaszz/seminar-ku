<!DOCTYPE html>    
<html lang="en">    
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title><?= $title; ?></title>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
</head>    
<body class="bg-gray-50">    
    <!-- Flash Messages -->    
    <?php if($this->session->flashdata('success')): ?>    
        <div class="max-w-3xl mx-auto px-4 mb-4">    
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">    
                <span class="block sm:inline"><?= $this->session->flashdata('success'); ?></span>    
            </div>    
        </div>    
    <?php endif; ?>    
    
    <?php if($this->session->flashdata('error')): ?>    
        <div class="max-w-3xl mx-auto px-4 mb-4">    
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">    
                <span class="block sm:inline"><?= $this->session->flashdata('error'); ?></span>    
            </div>    
        </div>    
    <?php endif; ?>    
    
    <div class="max-w-3xl mx-auto px-4 py-8">    
        <div class="mb-8">    
            <h1 class="text-2xl font-bold text-gray-900 text-center"><?= $title; ?></h1>    
            <p class="mt-2 text-center text-gray-600">Silakan isi formulir di bawah ini dengan lengkap dan benar</p>    
        </div>    
    
        <div class="bg-white shadow rounded-lg p-6">    
            <form action="<?= isset($seminar['id_seminar']) ? base_url('seminar/updateaction') : base_url('seminar/addaction'); ?>" method="post" enctype="multipart/form-data" class="space-y-6">    
                    
                <?php if (isset($seminar['id_seminar'])): ?>    
                    <input type="hidden" name="id_seminar" value="<?= $seminar['id_seminar']; ?>">    
                <?php endif; ?>    
    
                <!-- Nama Seminar -->    
                <div>    
                    <label for="nama_seminar" class="block text-sm font-medium text-gray-700">Nama Seminar</label>    
                    <div class="mt-1">    
                        <input type="text" name="nama_seminar" id="nama_seminar"     
                               value="<?= isset($seminar['nama_seminar']) ? $seminar['nama_seminar'] : set_value('nama_seminar'); ?>"    
                               class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm    
                                      <?= form_error('nama_seminar') ? 'border-red-300' : ''; ?>"    
                               required>    
                    </div>    
                    <?php if(form_error('nama_seminar')): ?>    
                        <p class="mt-1 text-sm text-red-600"><?= form_error('nama_seminar'); ?></p>    
                    <?php endif; ?>    
                </div>    
    
                <!-- Kategori Seminar -->    
                <div>    
                    <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori Seminar</label>    
                    <div class="mt-1">    
                        <select name="id_kategori" id="id_kategori"     
                                class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm    
                                       <?= form_error('id_kategori') ? 'border-red-300' : ''; ?>"    
                                required>    
                            <option value="">-- Pilih Kategori --</option>    
                            <?php foreach ($kategori_seminar as $kategori): ?>    
                                <option value="<?= $kategori['id_kategori']; ?>"     
                                        <?= (isset($seminar['id_kategori']) && $seminar['id_kategori'] == $kategori['id_kategori']) || set_value('id_kategori') == $kategori['id_kategori'] ? 'selected' : ''; ?>>    
                                    <?= $kategori['nama_kategori']; ?>    
                                </option>    
                            <?php endforeach; ?>    
                        </select>    
                    </div>    
                    <?php if(form_error('id_kategori')): ?>    
                        <p class="mt-1 text-sm text-red-600"><?= form_error('id_kategori'); ?></p>    
                    <?php endif; ?>    
                </div>    
    
                <!-- Lokasi Seminar -->    
                <div>    
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi Seminar</label>    
                    <div class="mt-1 relative">    
                        <input type="text" name="lokasi" id="lokasi"     
                               value="<?= isset($seminar['lokasi']) ? $seminar['lokasi'] : set_value('lokasi'); ?>"    
                               class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"    
                               required autocomplete="off">    
                        <div id="suggestions" class="absolute z-10 bg-white border border-gray-300 w-full mt-1 hidden"></div>    
                    </div>    
                </div>    
    
                <!-- Hidden Fields for Latitude and Longitude -->    
                <input type="hidden" name="latitude" id="latitude">    
                <input type="hidden" name="longitude" id="longitude">    
    
                <!-- Departemen -->    
                <div>    
                    <label for="id_fakultas" class="block text-sm font-medium text-gray-700">Departemen</label>    
                    <div class="mt-1">    
                        <select name="id_fakultas" id="id_fakultas"     
                                class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"    
                                required>    
                            <option value="">-- Pilih Departemen --</option>    
                            <?php foreach ($fakultas as $fak): ?>    
                                <option value="<?= $fak['id_fakultas']; ?>"     
                                        <?= (isset($seminar['id_fakultas']) && $seminar['id_fakultas'] == $fak['id_fakultas']) || set_value('id_fakultas') == $fak['id_fakultas'] ? 'selected' : ''; ?>>    
                                    <?= $fak['nama_fakultas']; ?>    
                                </option>    
                            <?php endforeach; ?>    
                        </select>    
                    </div>    
                </div>    
    
                <!-- Tanggal dan Waktu Group -->    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">    
                    <!-- Tanggal Pelaksanaan -->    
                    <div>    
                        <label for="tgl_pelaksana" class="block text-sm font-medium text-gray-700">Tanggal Pelaksanaan</label>    
                        <div class="mt-1">    
                            <input type="date" name="tgl_pelaksana" id="tgl_pelaksana"     
                                   value="<?= isset($tgl_pelaksana) ? $tgl_pelaksana : set_value('tgl_pelaksana'); ?>"    
                                   class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"    
                                   required>    
                        </div>    
                    </div>    
    
                    <!-- Jam Mulai -->    
                    <div>    
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>    
                        <div class="mt-1">    
                            <input type="time" name="jam_mulai" id="jam_mulai"     
                                   value="<?= isset($jam_mulai) ? $jam_mulai : set_value('jam_mulai'); ?>"    
                                   class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"    
                                   required>    
                        </div>    
                    </div>    
                </div>    
    
                <!-- Deskripsi -->    
                <div>    
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>    
                    <div class="mt-1">    
                        <textarea name="deskripsi" id="deskripsi" rows="4"    
                                  class="px-4 py-2 block w-full border-2 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"    
                                  required><?= isset($seminar['deskripsi']) ? $seminar['deskripsi'] : set_value('deskripsi'); ?></textarea>    
                    </div>    
                </div>    
    
                <!-- Lampiran -->    
                <div>    
                    <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-2">Lampiran (Poster)</label>    
                    <div class="mt-1 relative border-2 border-dashed border-gray-300 rounded-lg p-6 hover:bg-gray-50 hover:border-blue-400 transition-all">    
                        <div class="flex flex-col items-center">    
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-blue-500 mb-3">    
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />    
                            </svg>    
                            <div class="flex items-center gap-2 text-blue-600 mb-2">    
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">    
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />    
                                </svg>    
                                <span class="text-sm">Hanya file gambar</span>    
                            </div>    
                            <p class="text-sm text-gray-600 mb-1">Seret dan lepas file Anda di sini atau</p>    
                            <label for="lampiran" class="cursor-pointer text-blue-600 font-medium hover:underline">telusuri untuk mengunggah</label>    
                            <input type="file" name="lampiran" id="lampiran" accept="image/*" class="hidden" onchange="previewImage(this)" <?= !isset($seminar['id_seminar']) ? 'required' : ''; ?>>    
                        </div>    
                    </div>    
    
                    <div id="imagePreview" class="mt-3 hidden">    
                        <p class="text-sm text-gray-600 mb-2">Prabaca:</p>    
                        <img id="preview" src="#" alt="Preview" class="w-48 h-auto rounded-lg border border-gray-200">    
                    </div>    
    
                    <?php if(isset($seminar['lampiran']) && $seminar['lampiran']): ?>    
                        <div class="mt-3">    
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">    
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">    
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />    
                                </svg>    
                                <span>File saat ini:</span>    
                                <span class="font-medium text-gray-700"><?= $seminar['lampiran']; ?></span>    
                            </div>    
                            <img src="<?= base_url('uploads/poster/' . $seminar['lampiran']) ?>" alt="Poster saat ini" class="w-48 h-auto rounded-lg border border-gray-200">    
                        </div>    
                    <?php endif; ?>    
                </div>    
    
                <!-- Tombol Kirim -->    
                <div class="pt-4">    
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">    
                        <?= isset($seminar['id_seminar']) ? 'Perbarui Seminar' : 'Simpan Seminar'; ?>    
                    </button>    
                </div>    
            </form>    
        </div>    
    </div>    
    
    <script>    
        // Nominatim API untuk saran lokasi    
        document.getElementById('lokasi').addEventListener('input', function() {    
            const query = this.value;    
            const suggestions = document.getElementById('suggestions');    
            suggestions.innerHTML = ''; // Bersihkan saran sebelumnya    
            if (query.length > 2) {    
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&accept-language=id`)    
                    .then(response => response.json())    
                    .then(data => {    
                        if (data.length > 0) {    
                            suggestions.classList.remove('hidden');    
                            data.forEach(location => {    
                                // Memfilter lokasi untuk hanya yang ada di Indonesia  
                                if (location.display_name.includes('Indonesia')) {  
                                    const suggestionItem = document.createElement('div');    
                                    suggestionItem.textContent = location.display_name;    
                                    suggestionItem.classList.add('suggestion-item', 'cursor-pointer', 'p-2', 'hover:bg-gray-200');    
                                    suggestionItem.onclick = function() {    
                                        document.getElementById('lokasi').value = location.display_name;    
                                        document.getElementById('latitude').value = location.lat;    
                                        document.getElementById('longitude').value = location.lon;    
                                        suggestions.classList.add('hidden');    
                                    };    
                                    suggestions.appendChild(suggestionItem);    
                                }  
                            });    
                        } else {    
                            suggestions.classList.add('hidden');    
                        }    
                    })    
                    .catch(error => {    
                        console.error('Error fetching location data:', error);    
                    });    
            } else {    
                suggestions.classList.add('hidden');    
            }    
        });    
    
        // Prabaca file input    
        function previewImage(input) {    
            const preview = document.getElementById('preview');    
            const previewContainer = document.getElementById('imagePreview');    
    
            if (input.files && input.files[0]) {    
                const reader = new FileReader();    
                    
                reader.onload = function(e) {    
                    preview.src = e.target.result;    
                    previewContainer.classList.remove('hidden');    
                }    
                    
                reader.readAsDataURL(input.files[0]);    
            } else {    
                preview.src = '#';    
                previewContainer.classList.add('hidden');    
            }    
        }    
    </script>    
</body>    
</html>  
