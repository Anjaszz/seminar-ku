<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Komunitas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h3>Chat Komunitas</h3>
        <div class="chat-box border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;">
            <?php foreach ($chats as $chat): ?>
                <div class="chat-message mb-2">
                    <strong><?= $chat['nama_mhs']; ?>:</strong>
                    <?php if ($chat['tipe_file'] === 'text'): ?>
                        <p><?= $chat['pesan']; ?></p>
                    <?php elseif ($chat['tipe_file'] === 'image'): ?>
                        <p><img src="<?= base_url($chat['file_path']); ?>" alt="Image" class="img-fluid" style="max-height: 200px;"></p>
                    <?php elseif ($chat['tipe_file'] === 'document'): ?>
                        <p><a href="<?= base_url($chat['file_path']); ?>" target="_blank">Download Document</a></p>
                    <?php endif; ?>
                    <small class="text-muted"><?= $chat['created_at']; ?></small>
                </div>
            <?php endforeach; ?>
        </div>
        <form action="<?= site_url('user/chat/send'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_vendor" value="<?= $id_vendor; ?>">
            <input type="hidden" name="id_seminar" value="<?= $id_seminar; ?>">
            <div class="mb-3">
                <textarea name="pesan" class="form-control" placeholder="Tulis pesan..." required></textarea>
            </div>
            <div class="mb-3">
                <input type="file" name="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</body>
</html>
