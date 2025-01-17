<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tambahkan link font Montserrat di bagian head -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Chat Komunitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100 mt-20">
    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
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
                        <div class="flex items-end <?= $is_sender ? 'flex-row-reverse' : 'flex-row' ?> gap-2 max-w-[80%] group">
                            <?php if (!$is_sender): ?>
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex-shrink-0 flex items-center justify-center">
                                    <span class="text-white text-sm">
                                        <?= substr($chat['nama_mhs'], 0, 1); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="flex flex-col relative">
                                <div class="<?= $is_sender ? 'bg-[#DCF8C6] rounded-[20px] rounded-tr-none' : 'bg-white rounded-[20px] rounded-tl-none' ?> px-4 py-2 shadow-sm">
                                    <?php if (!$is_sender): ?>
                                        <div class="text-base font-montserrat font-bold text-emerald-300 mb-0.1" style="font-family: 'Montserrat', sans-serif;">
                                            <?= $chat['nama_mhs']; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($chat['tipe_file'] === 'text'): ?>
                                        <div class="text-base font-normal text-gray-700 leading-relaxed">
                                            <?= $chat['pesan']; ?>
                                        </div>
                                        <?php if ($is_sender): ?>
                                            <div class="hidden group-hover:flex gap-2 justify-end mt-1 mr-1">
                                                <button onclick="editChat('<?= $chat['id_chat']; ?>', '<?= htmlspecialchars($chat['pesan'], ENT_QUOTES); ?>')" 
                                                        class="text-blue-600 hover:text-blue-800 p-1 bg-white rounded-full shadow-sm hover:shadow-md transition-all">
                                                    <i data-feather="edit-2" class="w-3 h-3"></i>
                                                </button>
                                                <button onclick="deleteChat('<?= $chat['id_chat']; ?>')" 
                                                        class="text-red-600 hover:text-red-800 p-1 bg-white rounded-full shadow-sm hover:shadow-md transition-all">
                                                    <i data-feather="trash-2" class="w-3 h-3"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif ($chat['tipe_file'] === 'image'): ?>
                                        <div>
                                            <img src="<?= base_url($chat['file_path']); ?>" 
                                                 alt="Uploaded image" 
                                                 class="rounded-lg max-h-48 w-auto object-cover">
                                        </div>
                                        <?php if ($is_sender): ?>
                                            <div class="hidden group-hover:flex gap-2 justify-end mt-1 mr-1">
                                                <button onclick="deleteChat('<?= $chat['id_chat']; ?>')" 
                                                        class="text-red-600 hover:text-red-800 p-1 bg-white rounded-full shadow-sm hover:shadow-md transition-all">
                                                    <i data-feather="trash-2" class="w-3 h-3"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
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
                                        <?php if ($is_sender): ?>
                                            <div class="hidden group-hover:flex gap-2 justify-end mt-1 mr-1">
                                                <button onclick="deleteChat('<?= $chat['id_chat']; ?>')" 
                                                        class="text-red-600 hover:text-red-800 p-1 bg-white rounded-full shadow-sm hover:shadow-md transition-all">
                                                    <i data-feather="trash-2" class="w-3 h-3"></i>
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <div class="text-xs text-gray-500 <?= $is_sender ? 'text-right' : 'text-left' ?> mt-1">
                                        <?= date('H:i', strtotime($chat['created_at'])); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Message Input Form -->
        <form id="chatForm" action="<?= site_url('user/chat/send'); ?>" method="post" enctype="multipart/form-data" 
              class="bg-white p-4 border-t border-gray-200 rounded-lg shadow-sm">
            <input type="hidden" name="id_vendor" value="<?= $id_vendor; ?>">
            <input type="hidden" name="id_seminar" value="<?= $id_seminar; ?>">
            <input type="hidden" name="id_chat" id="id_chat" value="">
            
            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <textarea 
                        name="pesan" 
                        id="pesan"
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

                    <button type="submit" 
                            class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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

    <script>
        // Inisialisasi Feather Icons
        feather.replace();

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

        // Fungsi untuk edit chat
        function editChat(id_chat, pesan) {
            document.getElementById('id_chat').value = id_chat;
            document.getElementById('pesan').value = pesan;
            document.getElementById('pesan').focus();
        }

        // Fungsi untuk delete chat
        function deleteChat(id_chat) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah anda yakin ingin menghapus pesan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete
                    $.ajax({
                        url: '<?= site_url('user/chat/delete'); ?>',
                        type: 'POST',
                        data: {
                            id_chat: id_chat,
                            <?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_hash(); ?>'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if(response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Pesan telah dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', 'Gagal menghapus pesan', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Terjadi kesalahan pada server', 'error');
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>