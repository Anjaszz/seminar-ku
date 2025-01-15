<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Komunitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header -->
        <div class="mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Chat Komunitas</h3>
        </div>

        <!-- Chat Box -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="h-[500px] overflow-y-auto p-4" id="chat-container">
                <?php foreach ($chats as $chat): ?>
                    <div class="mb-4">
                        <div class="flex items-start space-x-3">
                            <!-- Avatar placeholder -->
                            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                                <span class="text-white text-sm">
                                    <?= substr($chat['nama_mhs'], 0, 1); ?>
                                </span>
                            </div>
                            
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <span class="font-medium text-gray-900"><?= $chat['nama_mhs']; ?></span>
                                    <span class="ml-2 text-xs text-gray-500"><?= $chat['created_at']; ?></span>
                                </div>
                                
                                <div class="text-gray-700">
                                    <?php if ($chat['tipe_file'] === 'text'): ?>
                                        <p class="text-gray-700"><?= $chat['pesan']; ?></p>
                                    <?php elseif ($chat['tipe_file'] === 'image'): ?>
                                        <div class="mt-2 max-w-xs">
                                            <img src="<?= base_url($chat['file_path']); ?>" 
                                                alt="Uploaded image" 
                                                class="rounded-lg max-h-48 w-auto object-cover">
                                        </div>
                                    <?php elseif ($chat['tipe_file'] === 'document'): ?>
                                        <div class="mt-2">
                                            <a href="<?= base_url($chat['file_path']); ?>" 
                                               target="_blank"
                                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Download Document
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Message Input Form -->
        <form action="<?= site_url('user/chat/send'); ?>" method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id_vendor" value="<?= $id_vendor; ?>">
            <input type="hidden" name="id_seminar" value="<?= $id_seminar; ?>">
            
            <div class="relative">
                <textarea 
                    name="pesan" 
                    rows="3"
                    class="block w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-900 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    placeholder="Tulis pesan..."
                    required
                ></textarea>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <label class="relative cursor-pointer">
                        <input type="file" name="file" class="hidden" id="file-input">
                        <div class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            Lampirkan File
                        </div>
                    </label>
                    <span class="text-sm text-gray-500" id="file-name"></span>
                </div>

                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Kirim
                </button>
            </div>
        </form>
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
    </script>
</body>
</html>