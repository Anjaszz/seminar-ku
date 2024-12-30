<!DOCTYPE html>
<html>
<head>
  <title>Tambah Data Vendor</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-3xl font-bold mb-6 text-indigo-600"><?php echo $title; ?></h2>
      <p class="text-gray-600 mb-8">Form untuk menambahkan data vendor baru:</p>

      <?php if (validation_errors()) : ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded">
          <?php echo validation_errors(); ?>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')) : ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>

      <form action="<?php echo base_url('master/vendor/add'); ?>" method="post" class="space-y-6">
        <div>
          <label for="nama_vendor" class="block text-gray-700 font-semibold mb-2">Nama Vendor</label>
          <input type="text" id="nama_vendor" name="nama_vendor" value="<?php echo set_value('nama_vendor'); ?>" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500" required>
        </div>

        <div>
          <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
          <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500" required>
        </div>

        <div>
          <label for="no_telp" class="block text-gray-700 font-semibold mb-2">No Telepon</label>
          <input type="text" id="no_telp" name="no_telp" value="<?php echo set_value('no_telp'); ?>" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500" required>
        </div>

        <div>
          <label for="id_bank" class="block text-gray-700 font-semibold mb-2">Nama Bank</label>
          <select id="id_bank" name="id_bank" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500" required>
            <option value="">Pilih Bank</option>
            <?php foreach ($banks as $bank) : ?>
              <option value="<?php echo $bank->id_bank; ?>" <?php echo set_select('id_bank', $bank->id_bank); ?>>
                <?php echo $bank->nama_bank; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div>
          <label for="no_rekening" class="block text-gray-700 font-semibold mb-2">Nomor Rekening</label>
          <input type="text" id="no_rekening" name="no_rekening" value="<?php echo set_value('no_rekening'); ?>" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500" required>
        </div>

        <div class="flex justify-end space-x-4">
          <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Tambah Data
          </button>
          <a href="<?php echo base_url('master/vendor'); ?>" class="bg-white text-indigo-600 font-semibold py-3 px-6 rounded-lg border-2 border-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Kembali
          </a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>