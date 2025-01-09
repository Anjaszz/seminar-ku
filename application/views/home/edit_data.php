<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="h-full">
    <div class="min-h-screen flex">
        <div class="flex-1 bg-gradient-to-br from-blue-50 to-white custom-scroll">
            <div class="max-w-3xl mx-auto px-4 py-4">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        <?= $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <div class="glass rounded-2xl p-8 shadow-lg border border-blue-100">
                    <h2 class="text-2xl font-bold text-gray-900"><?= $title; ?></h2>
                    <p class="mt-2 text-gray-600">Lengkapi informasi untuk memperbarui data vendor</p>
                    <?= form_open('home/edit/' . $user['id_vendor']); ?>
                        <div class="space-y-4">
                            <label class="block">
                                Nama Vendor
                                <input type="text" name="nama_vendor" value="<?= set_value('nama_vendor', $user['nama_vendor']); ?>" required>
                            </label>
                            <label class="block">
                                No Telepon
                                <input type="text" name="no_telp" value="<?= set_value('no_telp', $user['no_telp']); ?>" required>
                            </label>
                            <label class="block">
                                Nomor Rekening
                                <input type="text" name="no_rekening" value="<?= set_value('no_rekening', $user['no_rekening']); ?>" required>
                            </label>
                            <label class="block">
                                Nama Bank
                                <select name="id_bank" required>
                                    <option value="">Pilih Bank</option>
                                    <?php foreach ($banks as $bank): ?>
                                        <option value="<?= $bank['id_bank']; ?>" <?= ($user['id_bank'] == $bank['id_bank']) ? 'selected' : ''; ?>>
                                            <?= $bank['nama_bank']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <button type="submit">Simpan Perubahan</button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
