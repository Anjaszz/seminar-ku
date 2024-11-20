<div class="card">
    <div class="card-header">
        <h4>Edit Data Vendor</h4>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_vendor">Nama Vendor</label>
                <input type="text" name="nama_vendor" class="form-control" value="<?= set_value('nama_vendor', $nama_vendor); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_langganan">Tanggal Langganan</label>
                <input type="date" name="tanggal_langganan" class="form-control" value="<?= set_value('tanggal_langganan', $tanggal_langganan); ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_berakhir">Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir" class="form-control" value="<?= set_value('tanggal_berakhir', $tanggal_berakhir); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?= set_value('email', $email); ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No Telepon</label>
                <input type="text" name="no_telp" class="form-control" value="<?= set_value('no_telp', $no_telp); ?>" required>
            </div>
            <div class="form-group">
                <label for="id_bank">Nama Bank</label>
                <select name="id_bank" id="id_bank" class="form-control" required>
                    <option value="">-- Pilih Bank --</option>
                    <?php foreach ($banks as $bank): ?>
                        <option value="<?= $bank->id_bank; ?>" <?= set_select('id_bank', $bank->id_bank, $bank->id_bank == $id_bank); ?>>
                            <?= $bank->nama_bank; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="no_rekening">Nomor Rekening</label>
                <input type="text" name="no_rekening" class="form-control" value="<?= set_value('no_rekening', $no_rekening); ?>" required>
            </div>
            <button type="submit" class="btn btn-gradient-primary">Simpan Perubahan</button>
            <a href="<?= site_url('master/vendor'); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
