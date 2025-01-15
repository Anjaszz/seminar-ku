<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen mt-20">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto mt-4">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                <div class="bg-indigo-600 text-white px-6 py-4">
                    <h2 class="text-2xl font-bold">Komunitas Anda</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    <?php if (!empty($komunitas_chats)): ?>
                        <?php foreach ($komunitas_chats as $chat): ?>
                            <a href="<?php echo site_url('user/chat/index/'.$chat->id_vendor.'/'.$chat->id_seminar); ?>" 
                               class="block hover:bg-gray-50 transition-colors duration-200">
                                <div class="px-6 py-4 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img src="<?php echo base_url('uploads/poster/'.$chat->lampiran); ?>" 
                                             alt="Foto Lampiran" 
                                             class="w-14 h-14 rounded-full object-cover border-2 border-indigo-100">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-lg font-semibold text-gray-900 truncate"><?php echo $chat->nama_seminar; ?></p>
                                        <p class="text-sm text-gray-600 truncate">
                                            <span class="font-medium text-indigo-600"><?php echo $chat->nama_mhs; ?></span>
                                            : <?php echo $chat->pesan; ?>
                                        </p>
                                    </div>
                                    <?php if (!empty($chat->created_at)): ?>
                                    <div class="text-sm text-gray-500">
                                        <?php echo date('d-m H:i', strtotime($chat->created_at)); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="px-6 py-4 text-center">
                            <p class="text-sm text-gray-500">Tidak ada data chat komunitas.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>