<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
       
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            color: #333;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
            color: #555;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?= $title; ?></h1>
        <form action="<?= isset($seminar['id_seminar']) ? base_url('seminar/updateaction') : base_url('seminar/addaction'); ?>" method="post" enctype="multipart/form-data">

            <!-- Hidden Field for ID (Hanya untuk Edit) -->
            <?php if (isset($seminar['id_seminar'])): ?>
                <input type="hidden" name="id_seminar" value="<?= $seminar['id_seminar']; ?>">
            <?php endif; ?>

            <!-- Form Input Nama Seminar -->
            <div class="form-group">
                <label for="nama_seminar">Nama Seminar</label>
                <input type="text" name="nama_seminar" id="nama_seminar" value="<?= isset($seminar['nama_seminar']) ? $seminar['nama_seminar'] : ''; ?>" required>
            </div>

            <!-- Dropdown Kategori Seminar -->
            <div class="form-group">
                <label for="id_kategori">Kategori Seminar</label>
                <select name="id_kategori" id="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori_seminar as $kategori): ?>
                        <option value="<?= $kategori['id_kategori']; ?>" <?= isset($seminar['id_kategori']) && $seminar['id_kategori'] == $kategori['id_kategori'] ? 'selected' : ''; ?>>
                            <?= $kategori['nama_kategori']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Dropdown Lokasi Seminar -->
            <div class="form-group">
                <label for="id_lokasi">Lokasi Seminar</label>
                <select name="id_lokasi" id="id_lokasi" required>
                    <option value="">-- Pilih Lokasi --</option>
                    <?php foreach ($lokasi_seminar as $lokasi): ?>
                        <option value="<?= $lokasi['id_lokasi']; ?>" <?= isset($seminar['id_lokasi']) && $seminar['id_lokasi'] == $lokasi['id_lokasi'] ? 'selected' : ''; ?>>
                            <?= $lokasi['nama_provinsi']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Input Detail Lokasi -->
            <div class="form-group">
                <label for="lokasi">Detail Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="<?= isset($seminar['lokasi']) ? $seminar['lokasi'] : ''; ?>" required>
            </div>

            <!-- Dropdown Departemen -->
            <div class="form-group">
                <label for="id_fakultas">Departemen</label>
                <select name="id_fakultas" id="id_fakultas" required>
                    <option value="">-- Pilih Departemen --</option>
                    <?php foreach ($fakultas as $fakultas): ?>
                        <option value="<?= $fakultas['id_fakultas']; ?>" <?= isset($seminar['id_fakultas']) && $seminar['id_fakultas'] == $fakultas['id_fakultas'] ? 'selected' : ''; ?>>
                            <?= $fakultas['nama_fakultas']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Input Tanggal Pelaksanaan -->
            <div class="form-group">
    <label for="tgl_pelaksana">Tanggal Pelaksanaan</label>
    <!-- Pastikan nilai input diisi dengan $tanggal yang sudah dipisahkan -->
    <input type="date" name="tgl_pelaksana" id="tgl_pelaksana" value="<?= isset($tgl_pelaksana) ? $tgl_pelaksana : ''; ?>" required>
</div>

<!-- Input Jam Mulai -->
<div class="form-group">
    <label for="jam_mulai">Jam Mulai</label>
    <!-- Pastikan nilai input diisi dengan $jam yang sudah dipisahkan -->
    <input type="time" name="jam_mulai" id="jam_mulai" value="<?= isset($jam_mulai) ? $jam_mulai : ''; ?>" required>
</div>


            <!-- Input Deskripsi -->
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" required><?= isset($seminar['deskripsi']) ? $seminar['deskripsi'] : ''; ?></textarea>
            </div>

            <!-- Input Upload Lampiran -->
            <div class="form-group">
                <label for="lampiran">Lampiran (Poster)</label>
                <input type="file" name="lampiran" id="lampiran" accept="image/*">
            </div>

            <button type="submit"><?= isset($seminar['id_seminar']) ? 'Update' : 'Simpan'; ?></button>
        </form>
    </div>
</body>
</html>
