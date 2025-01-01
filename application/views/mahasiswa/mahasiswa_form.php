<!DOCTYPE html>
<html>
<head>
  <title><?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-3xl font-bold mb-6 text-indigo-600"><?= $title ?></h2>
      <p class="text-gray-600 mb-8">Form untuk menambahkan data mahasiswa baru:</p>

      <?php if ($fe_namamhs || $fe_email || $fe_notelp) : ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded">
          <?php echo $fe_namamhs . $fe_email . $fe_notelp; ?>
        </div>
      <?php endif; ?>

      <?= $formopen ?>
        <div class="space-y-6">
          <div>
            <?= $lnama_mhs ?>
            <?= str_replace('class="form-control"', 'class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500"', $inputnama_mhs) ?>
            <?php if ($fe_namamhs): ?>
              <p class="mt-1 text-sm text-red-600"><?= $ivnama_mhs ?></p>
            <?php endif; ?>
          </div>

          <div>
            <?= $lfakultas ?>
            <?= str_replace('class="form-control"', 'class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500"', $ddfakultas) ?>
          </div>

          <div>
            <?= $lprodi ?>
            <?= str_replace('class="form-control"', 'class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500"', $ddprodi) ?>
          </div>

          <div>
            <?= $lemail ?>
            <?= str_replace('class="form-control"', 'class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500"', $iemail) ?>
            <?php if ($fe_email): ?>
              <p class="mt-1 text-sm text-red-600"><?= $ivemail ?></p>
            <?php endif; ?>
          </div>

          <div>
            <?= $lno_telp ?>
            <?= str_replace('class="form-control"', 'class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500"', $inputno_telp) ?>
            <?php if ($fe_notelp): ?>
              <p class="mt-1 text-sm text-red-600"><?= $ivnotelp ?></p>
            <?php endif; ?>
          </div>

          <div>
            <?= $ltanggal_lahir ?>
            <?= str_replace('class="form-control"', 'class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-indigo-500"', $inputtanggal_lahir) ?>
          </div>

          <?= $inputid ?>

          <div class="flex justify-end space-x-4">
            <?= str_replace('class="btn btn-gradient-info"', 'class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"', $submit) ?>
            <a href="<?php echo site_url('mahasiswa'); ?>" class="bg-white text-indigo-600 font-semibold py-3 px-6 rounded-lg border-2 border-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              Kembali
            </a>
          </div>
        </div>
      <?= $formclose ?>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      <?php if ($this->session->flashdata('success')) : ?>
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '<?= $this->session->flashdata('success') ?>',
          showConfirmButton: false,
          timer: 1500
        });
      <?php endif; ?>

      $('#fakultas').change(function() {
        var fakultas_id = $(this).val();
        if (fakultas_id != '') {
          $.ajax({
            url: "<?php echo base_url('mahasiswa/get_prodi_by_fakultas'); ?>",
            method: "POST",
            data: {fakultas_id: fakultas_id},
            success: function(data) {
              $('#prodi').html(data);
            },
            error: function() {
              Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal mengambil data jurusan',
                showConfirmButton: true,
              });
            }
          });
        } else {
          $('#prodi').html('<option value="">Pilih Jurusan</option>');
        }
      });
    });
    document.getElementById('no_telp').addEventListener('input', function(e) {
   let input = e.target.value.replace(/\D/g, '');
   
   // Allow full deletion
   if (input.length === 0) {
       e.target.value = '';
       return;
   }
   
   // Format number
   if (input.length > 4) {
       input = input.substring(0, 4) + '-' + input.substring(4);
   }
   if (input.length > 9) {
       input = input.substring(0, 9) + '-' + input.substring(9);
   }
   
   // Add 08 prefix if needed
   if (!input.startsWith('08')) {
       input = '08' + input.substring(2);
   }
   
   e.target.value = input;
});
  </script>
</body>
</html>