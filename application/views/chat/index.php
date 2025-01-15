<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<!-- Tambahkan link font Montserrat di bagian head -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Chat Komunitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 mt-20">
    <div class=" max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <!-- Header -->
        <div class="bg-white rounded-t-lg shadow-sm border border-gray-200 p-4">
    <div class="flex items-center gap-2">
        <!-- Icon komunitas -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.62-1M9 20H4v-2a3 3 0 015.62-1M16 3.13a4 4 0 110 7.75M8 3.13a4 4 0 110 7.75M12 17h0" />
        </svg>
        <!-- Teks komunitas dan nama seminar -->
        <span class="text-gray-800 font-medium">Komunitas:</span>
        <span class="text-blue-600"><?= htmlspecialchars($nama_seminar); ?></span>
    </div>
</div>







        <!-- Chat Box -->
        <div class="bg-[#E8ECF0] rounded-b-lg shadow-sm border-x border-b border-gray-200 mb-6">
    <div class="h-[500px] overflow-y-auto p-4" id="chat-container">
        <?php foreach ($chats as $chat): ?>
            <?php $is_sender = $chat['id_mahasiswa'] === $this->session->userdata('id_mahasiswa'); ?>
            
            <div class="mb-4 <?= $is_sender ? 'flex flex-col items-end' : 'flex flex-col items-start' ?>">
                <div class="flex items-end <?= $is_sender ? 'flex-row-reverse' : 'flex-row' ?> gap-2 max-w-[80%] group relative">
                    <?php if (!$is_sender): ?>
                        <!-- Avatar untuk pesan dari orang lain -->
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex-shrink-0 flex items-center justify-center">
                            <span class="text-white text-sm">
                                <?= substr($chat['nama_mhs'], 0, 1); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <div class="flex flex-col relative">
                        <div class="<?= $is_sender ? 'bg-[#DCF8C6] rounded-[20px] rounded-tr-none' : 'bg-white rounded-[20px] rounded-tl-none' ?> px-4 py-2 shadow-sm">
                            <?php if (!$is_sender): ?>
                                <!-- Nama pengirim dengan style baru -->
                                <div class="text-base font-montserrat font-bold text-emerald-600 mb-1" style="font-family: 'Montserrat', sans-serif;">
                                    <?= $chat['nama_mhs']; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($chat['tipe_file'] === 'text'): ?>
                                <div class="text-base font-normal text-gray-700 leading-relaxed">
                                    <?= $chat['pesan']; ?>
                                </div>
                            <?php elseif ($chat['tipe_file'] === 'image'): ?>
                                <div>
                                    <img src="<?= base_url($chat['file_path']); ?>" 
                                        alt="Uploaded image" 
                                        class="rounded-lg max-h-48 w-auto object-cover">
                                </div>
                            <?php elseif ($chat['tipe_file'] === 'document'): ?>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <a href="<?= base_url($chat['file_path']); ?>" 
                                       target="_blank"
                                       class="text-blue-600 hover:underline text-sm">
                                        Download Document
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Waktu chat di luar bubble -->
                    <div class="text-xs text-gray-500 self-end <?= $is_sender ? 'mr-2' : 'ml-2' ?>">
                        <?= date('H:i', strtotime($chat['created_at'])); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

            <!-- Message Input Form -->
            <form action="<?= site_url('user/chat/send'); ?>" method="post" enctype="multipart/form-data" 
                  class="bg-white p-4 border-t border-gray-200">
                <input type="hidden" name="id_vendor" value="<?= $id_vendor; ?>">
                <input type="hidden" name="id_seminar" value="<?= $id_seminar; ?>">
                
                <div class="flex items-end gap-2">
                    <div class="flex-1">
                        <textarea 
                            name="pesan" 
                            rows="1"
                            class="block w-full rounded-full border border-gray-300 px-4 py-2 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm resize-none"
                            placeholder="Tulis pesan..."
                            required
                        ></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="cursor-pointer">
                            <input type="file" name="file" class="hidden" id="file-input">
                            <div class="p-2 text-gray-500 hover:text-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </div>
                        </label>

                        <button 
                            type="submit" 
                            class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mt-1">
                    <span class="text-sm text-gray-500" id="file-name"></span>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom of chat
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;

        // Show selected file name
        const fileInput = document.getElementById('file-input');
        const fileName = document.getElementById('file-name');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;
            }
        });

        // Auto resize textarea
        const textarea = document.querySelector('textarea');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
</body>
</html>