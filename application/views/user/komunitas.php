<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunitas</title>
    <style>
        .chat-list {
            list-style: none;
            padding: 0;
            margin: 0;
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

    <ul class="chat-list">
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
</body>
</html>
