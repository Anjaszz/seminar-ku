<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #00bfff, #ACB6E5);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            width: 100%;
            max-width: 600px; /* Lebar maksimum */
            margin: 20px; /* Jarak atas dan bawah */
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.2);
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #00bfff;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #ACB6E5;
            box-shadow: 0 0 10px rgba(173, 216, 230, 0.4);
        }

        .btn-primary {
            background: linear-gradient(45deg, #00bfff, #ACB6E5);
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: bold;
            box-shadow: 0 6px 20px rgba(173, 216, 230, 0.5);
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #ACB6E5, #74ebd5);
            box-shadow: 0 12px 40px rgba(173, 216, 230, 0.8);
        }

        h2 {
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert {
            margin-bottom: 20px;
        }

        @media (max-width: 576px) {
            .card {
                padding: 20px;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg">
            <h2><?php echo $title; ?></h2>
            <p class="text-center">Form pendaftaran vendor</p>

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
                <div class="form-group mb-3">
                    <label for="nama_vendor">Nama Vendor:</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" value="<?php echo set_value('nama_vendor'); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="no_telp">No Telepon:</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo set_value('no_telp'); ?>" required>
                </div>

                <div class="form-group mb-3">
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

                <div class="form-group mb-3">
                    <label for="no_rekening">Nomor Rekening:</label>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?php echo set_value('no_rekening'); ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group mb-4">
                    <label for="confirm_password">Konfirmasi Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                    <a href="<?php echo base_url('master/vendor'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
