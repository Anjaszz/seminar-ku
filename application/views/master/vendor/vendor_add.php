<div class="container">
    <h2><?php echo $title; ?></h2>
    <p>Form untuk menambahkan data vendor baru:</p>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo base_url('master/vendor/add'); ?>" method="post">
        <div class="form-group">
            <label for="nama_vendor">Nama Vendor:</label>
            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?php echo set_value('nama_vendor'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="no_telp">No Telepon:</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo set_value('no_telp'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="id_bank">Nama Bank:</label>
            <select class="form-control" id="id_bank" name="id_bank" required>
                <option value="">Pilih Bank</option>
                <?php foreach ($banks as $bank) : ?>
                    <option value="<?php echo $bank->id_bank; ?>" <?php echo set_select('id_bank', $bank->id_bank); ?>>
                        <?php echo $bank->nama_bank; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="no_rekening">Nomor Rekening:</label>
            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?php echo set_value('no_rekening'); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        <a href="<?php echo base_url('master/vendor'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
