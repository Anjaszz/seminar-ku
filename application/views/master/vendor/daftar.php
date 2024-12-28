<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
</head>
<body>
    <div class="container">
        <h2><?= $title; ?></h2>
        <?= form_open('master/vendor/daftar'); ?>
            <div class="form-group">
                <label for="nama_vendor">Nama Vendor</label>
                <input type="text" class="form-control" name="nama_vendor" id="nama_vendor" value="<?= set_value('nama_vendor'); ?>" required>
                <?= form_error('nama_vendor'); ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" required>
                <?= form_error('email'); ?>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telepon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?= set_value('no_telp'); ?>" required>
                <?= form_error('no_telp'); ?>
            </div>
            <div class="form-group">
                <label for="id_bank">Nama Bank</label>
                <select class="form-control" name="id_bank" id="id_bank" required>
                    <option value="">Pilih Bank</option>
                    <?php if (!empty($banks)): ?>
                        <?php foreach ($banks as $bank): ?>
                            <option value="<?= $bank->id_bank; ?>"><?= $bank->nama_bank; ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">Tidak ada bank tersedia</option>
                    <?php endif; ?>
                </select>
                <?= form_error('id_bank'); ?>
            </div>
            <div class="form-group">
                <label for="no_rekening">Nomor Rekening</label>
                <input type="text" class="form-control" name="no_rekening" id="no_rekening" value="<?= set_value('no_rekening'); ?>" required>
                <?= form_error('no_rekening'); ?>
            </div>
            <div class="form-group">
                <label for="lama_berlangganan">Lama Berlangganan</label>
                <select class="form-control" name="lama_berlangganan" id="lama_berlangganan" required>
                    <option value="">Pilih Lama Berlangganan</option>
                    <option value="3">3 Bulan - Rp 50.000</option>
                    <option value="6">6 Bulan - Rp 70.000</option>
                    <option value="12">1 Tahun - Rp 100.000</option>
                </select>
                <?= form_error('lama_berlangganan'); ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <?= form_error('password'); ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                <?= form_error('confirm_password'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Berlangganan</button>
        <?= form_close(); ?>
    </div>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
