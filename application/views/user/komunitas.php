<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
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
</body>
</html>