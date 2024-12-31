<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            transition: color 0.3s;
        }

        h2:hover {
            color: #0056b3;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #007bff;
        }

        .edit-icon {
            cursor: pointer;
            color: #007bff;
            font-size: 1.5rem;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .table th {
            background-color: #007bff;
            color: white;
            text-align: left;
        }

        .table td {
            font-weight: 500;
            padding: 5px;
        }

        .table tr {
            height: 40px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-left">
            <i class="fas fa-user icon"></i> Profil
        </h2>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center position-relative">
                <?php if (!empty($mahasiswa->foto)): ?>
                    <img src="<?php echo base_url('assets/images/profil/' . $mahasiswa->foto); ?>" alt="Gambar Profil" class="profile-image">
                <?php else: ?>
                    <i class="fas fa-user icon" style="font-size: 80px; color: #007bff;"></i>
                <?php endif; ?>
                <a href="#" class="edit-icon" title="Edit Profil" data-toggle="modal" data-target="#editProfileModal">
                    <i class="fas fa-edit"></i>
                </a>
                <p class="profile-name" style="font-size: 30px;"><?php echo $mahasiswa->nama_mhs; ?></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>ID User</th>
                            <td><?php echo $mahasiswa->nim; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $mahasiswa->email; ?></td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td><?php echo $mahasiswa->no_telp; ?></td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td><?php echo $mahasiswa->nama_prodi; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="button-container">
                    <a href="<?php echo base_url('user/home/seminar_history/'); ?>" class="btn btn-info">
                        <i class="fas fa-history"></i> History Seminar
                    </a>
                    <a href="<?php echo base_url('user/auth/ubah_password/'); ?>" class="btn btn-warning">
                        <i class="fas fa-key"></i> Ubah Password
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Profil -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editProfileForm" action="<?php echo base_url('user/home/updateProfil'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_mhs">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="<?php echo $mahasiswa->nama_mhs; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $mahasiswa->email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No HP</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $mahasiswa->no_telp; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_prodi">Jurusan</label>
                            <select class="form-control" id="id_prodi" name="id_prodi" required>
                                <option value="">Pilih Jurusan</option>
                                <?php foreach ($prodi as $p): ?>
                                    <option value="<?php echo $p->id_prodi; ?>" <?php echo ($p->id_prodi == $mahasiswa->id_prodi) ? 'selected' : ''; ?>>
                                        <?php echo $p->nama_prodi; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Unggah Foto Profil</label>
                            <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Script untuk Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Script untuk Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
$(document).ready(function() {
    $('#editProfileForm').on('submit', function(e) {
        e.preventDefault(); // Mencegah pengiriman default

        // Tampilkan konfirmasi SweetAlert
        Swal.fire({
            title: 'Simpan perubahan?',
            text: "Pastikan semua data sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData(this); // Mengambil data dari form

                $.ajax({
                    url: $(this).attr('action'), // URL action dari form
                    type: $(this).attr('method'), // Metode pengiriman
                    data: formData,
                    contentType: false, // Menghindari pengaturan content type
                    processData: false, // Menghindari pengolahan data
                    success: function(response) {
                        console.log('Response from server:', response); // Tambahkan log respons
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil diperbarui!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#editProfileModal').modal('hide'); // Menutup modal
                            location.reload(); // Reload halaman setelah sukses
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error); // Tambahkan log error
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
