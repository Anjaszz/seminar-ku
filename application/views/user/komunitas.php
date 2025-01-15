<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
<<<<<<< HEAD
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 mt-20">
    <div class="container mx-auto py-8">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl">
                    <span class="block text-indigo-600">Komunitas Anda</span>
                </h2>
                <div class="mt-8">
                    <ul class="divide-y divide-gray-200">
                        <?php if (!empty($komunitas_chats)): ?>
                            <?php foreach ($komunitas_chats as $chat): ?>
                                <li class="py-4">
                                    <a href="<?php echo site_url('user/chat/index/'.$chat->id_vendor.'/'.$chat->id_seminar); ?>" class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <img src="<?php echo base_url('uploads/poster/'.$chat->lampiran); ?>" alt="Foto Lampiran" class="w-12 h-12 rounded-full">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-lg font-medium text-gray-900 truncate"><?php echo $chat->nama_seminar; ?></p>
                                            <p class="text-sm text-gray-500 truncate"><?php echo $chat->nama_mhs . ' : ' . $chat->pesan; ?></p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                            <?php echo date('d-m-Y H:i', strtotime($chat->created_at)); ?>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="py-4">
                                <p class="text-sm text-gray-500">Tidak ada data chat komunitas.</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
=======
    <style>
        .chat-list {
            list-style: none;
            padding: 0;
        }
        .chat-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .chat-item img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .chat-item .chat-details {
            flex-grow: 1;
        }
        .chat-item .chat-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .chat-item .chat-message {
            color: #777;
        }
        .chat-item .chat-time {
            font-size: 12px;
            color: #bbb;
            margin-left: 10px;
        }
        .chat-item a {
            display: block;
            width: 100%;
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <h1>Daftar Komunitas</h1>

    <ul class="chat-list mt-20">
        <?php if (!empty($komunitas_chats)): ?>
            <?php foreach ($komunitas_chats as $chat): ?>
                <li class="chat-item">
                    <!-- Link untuk mengarah ke halaman chat -->
                    <a href="<?php echo site_url('user/chat/index/'.$chat->id_vendor.'/'.$chat->id_seminar); ?>">
                        <!-- Gambar Lampiran -->
                        <img src="<?php echo base_url('uploads/poster/'.$chat->lampiran); ?>" alt="Foto Lampiran">
                        
                        <div class="chat-details">
                            <!-- Nama Seminar -->
                            <div class="chat-name"><?php echo $chat->nama_seminar; ?></div>
                            
                            <!-- Pesan Terakhir dalam Satu Baris -->
                            <div>
                                <?php echo $chat->nama_mhs . ' : ' . $chat->pesan; ?>
                            </div>
                        </div>
                        
                        <!-- Nama User dan Waktu -->
                        <div class="chat-time">
                            <div><?php echo date('d-m-Y H:i', strtotime($chat->created_at)); ?></div>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada data chat komunitas.</p>
        <?php endif; ?>
    </ul>
>>>>>>> 66f85a05032edece1964b85ca5a2d87dd6a3b9dc
</body>
</html>