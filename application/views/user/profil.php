<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen p-4 md:p-6">
        <!-- Header -->
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-bold text-indigo-600 flex items-center gap-3 pb-2 border-b border-indigo-200">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </h2>
        </div>

        <!-- Profile Card -->
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <!-- Profile Header -->
                <div class="relative p-3 md:p-6 text-center bg-gradient-to-r from-indigo-500 to-blue-500">
                    <div class="relative inline-block">
                        <?php if (!empty($mahasiswa->foto)): ?>
                            <img src="<?php echo base_url('assets/images/profil/' . $mahasiswa->foto); ?>" 
                                 alt="Gambar Profil" 
                                 class="md:w-32 md:h-32 w-24 h-24 rounded-full border-4 border-white object-cover mx-auto shadow-lg">
                        <?php else: ?>
                            <div class="md:w-32 md:h-32 w-24 h-24 rounded-full border-4 border-white bg-gray-200 flex items-center justify-center mx-auto">
                                <i class="fas fa-user text-6xl text-gray-400"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="absolute top-4 right-4 text-white hover:text-gray-200 transition-colors" 
                            title="Edit Profil" 
                            data-toggle="modal" 
                            data-target="#editProfileModal">
                        <i class="fas fa-edit text-xl"></i>
                    </button>
                    <h3 class="md:mt-4 mt-1 text-2xl font-bold text-white">
                        <?php echo $mahasiswa->nama_mhs; ?>
                    </h3>
                </div>

                <!-- Profile Information -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4 gap-2">
                        <div class="space-y-4">
                            <div class="bg-gray-50 p-3 sm:p-3 rounded-lg">
                                <h4 class="text-sm text-gray-500 mb-1">ID User</h4>
                                <p class="font-semibold"><?php echo $mahasiswa->nim; ?></p>
                            </div>
                            <div class="bg-gray-50  p-3 sm:p-4 rounded-lg">
                                <h4 class="text-sm text-gray-500 mb-1">Email</h4>
                                <p class="font-semibold break-words"><?php echo $mahasiswa->email; ?></p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-gray-50  p-3 sm:p-4 rounded-lg">
                                <h4 class="text-sm text-gray-500 mb-1">No HP</h4>
                                <p class="font-semibold"><?php echo $mahasiswa->no_telp; ?></p>
                            </div>
                            <div class="bg-gray-50  p-3 sm:p-4 rounded-lg">
                                <h4 class="text-sm text-gray-500 mb-1">Jurusan</h4>
                                <p class="font-semibold"><?php echo $mahasiswa->nama_prodi; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-3 md:mt-6">
                        <a href="<?php echo base_url('user/home/seminar_history/'); ?>" 
                           class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-history"></i>
                            <span>History Seminar</span>
                        </a>
                        <a href="<?php echo base_url('user/auth/ubah_password/'); ?>" 
                           class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                            <i class="fas fa-key"></i>
                            <span>Ubah Password</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-lg shadow-xl">
                    <div class="modal-header border-b border-gray-200 p-4">
                        <h5 class="text-xl font-bold text-gray-700">Edit Profil</h5>
                        <button type="button" class="text-gray-400 hover:text-gray-500" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editProfileForm" action="<?php echo base_url('user/home/updateProfil'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body p-4">
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_mhs" class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa</label>
                                    <input type="text" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           id="nama_mhs" 
                                           name="nama_mhs" 
                                           value="<?php echo $mahasiswa->nama_mhs; ?>" 
                                           required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           id="email" 
                                           name="email" 
                                           value="<?php echo $mahasiswa->email; ?>" 
                                           required>
                                </div>
                                <div>
                                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                                    <input type="text" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           id="no_telp" 
                                           name="no_telp" 
                                           value="<?php echo $mahasiswa->no_telp; ?>" 
                                           required>
                                </div>
                                <div>
                                    <label for="id_prodi" class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            id="id_prodi" 
                                            name="id_prodi" 
                                            required>
                                        <option value="">Pilih Jurusan</option>
                                        <?php foreach ($prodi as $p): ?>
                                            <option value="<?php echo $p->id_prodi; ?>" 
                                                    <?php echo ($p->id_prodi == $mahasiswa->id_prodi) ? 'selected' : ''; ?>>
                                                <?php echo $p->nama_prodi; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Unggah Foto Profil</label>
                                    <input type="file" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                           id="foto" 
                                           name="foto" 
                                           accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-t border-gray-200 p-4">
                            <button type="button" 
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors" 
                                    data-dismiss="modal">Batal</button>
                            <button type="submit" 
                                    name="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors ml-2">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#editProfileForm').on('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Simpan perubahan?',
                    text: "Pastikan semua data sudah benar.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData(this);

                        $.ajax({
                            url: $(this).attr('action'),
                            type: $(this).attr('method'),
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log('Response from server:', response);
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data berhasil diperbarui!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    $('#editProfileModal').modal('hide');
                                    location.reload();
                                });
                            },
                            error: function(xhr, status, error) {
                                console.error('Error occurred:', error);
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan: ' + error,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>