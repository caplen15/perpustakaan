<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="bi bi-person-plus"></i> Form Registrasi Anggota</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $success = false;
                        $errors = [];
                        $data = [];

                        // Inisialisasi variabel untuk keep value
                        $nama = $_POST['nama'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $telepon = $_POST['telepon'] ?? '';
                        $alamat = $_POST['alamat'] ?? '';
                        $jk = $_POST['jk'] ?? '';
                        $tgl_lahir = $_POST['tgl_lahir'] ?? '';
                        $pekerjaan = $_POST['pekerjaan'] ?? '';

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            // 1. Validasi Nama
                            if (empty(trim($nama))) {
                                $errors['nama'] = "Nama lengkap wajib diisi.";
                            } elseif (strlen(trim($nama)) < 3) {
                                $errors['nama'] = "Nama minimal 3 karakter.";
                            }

                            // 2. Validasi Email
                            if (empty(trim($email))) {
                                $errors['email'] = "Email wajib diisi.";
                            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $errors['email'] = "Format email tidak valid.";
                            }

                            // 3. Validasi Telepon
                            if (empty(trim($telepon))) {
                                $errors['telepon'] = "Nomor telepon wajib diisi.";
                            } elseif (!preg_match("/^08[0-9]{8,11}$/", $telepon)) {
                                $errors['telepon'] = "Format: 08xxxxxxxxxx (10-13 digit).";
                            }

                            // 4. Validasi Alamat
                            if (empty(trim($alamat))) {
                                $errors['alamat'] = "Alamat wajib diisi.";
                            } elseif (strlen(trim($alamat)) < 10) {
                                $errors['alamat'] = "Alamat minimal 10 karakter.";
                            }

                            // 5. Validasi Jenis Kelamin
                            if (empty($jk)) {
                                $errors['jk'] = "Pilih jenis kelamin.";
                            }

                            // 6. Validasi Tanggal Lahir (Umur min 10 tahun)
                            if (empty($tgl_lahir)) {
                                $errors['tgl_lahir'] = "Tanggal lahir wajib diisi.";
                            } else {
                                $birthDate = new DateTime($tgl_lahir);
                                $today = new DateTime();
                                $age = $today->diff($birthDate)->y;
                                if ($age < 10) {
                                    $errors['tgl_lahir'] = "Umur minimal 10 tahun.";
                                }
                            }

                            // 7. Validasi Pekerjaan
                            if (empty($pekerjaan)) {
                                $errors['pekerjaan'] = "Pilih pekerjaan.";
                            }

                            // Jika tidak ada error
                            if (empty($errors)) {
                                $success = true;
                                $data = [
                                    'Nama' => htmlspecialchars($nama),
                                    'Email' => htmlspecialchars($email),
                                    'Telepon' => htmlspecialchars($telepon),
                                    'Alamat' => htmlspecialchars($alamat),
                                    'Jenis Kelamin' => $jk,
                                    'Tanggal Lahir' => date('d-m-Y', strtotime($tgl_lahir)),
                                    'Pekerjaan' => $pekerjaan
                                ];
                            }
                        }
                        ?>

                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle-fill"></i> Registrasi Berhasil!
                            </div>
                            <div class="card mb-4 bg-light">
                                <div class="card-body">
                                    <h5 class="card-title border-bottom pb-2">Data Terdaftar:</h5>
                                    <table class="table table-sm table-borderless mb-0">
                                        <?php foreach ($data as $label => $val): ?>
                                            <tr>
                                                <th width="30%"><?php echo $label; ?></th>
                                                <td>: <?php echo $val; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control <?php echo isset($errors['nama']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($nama); ?>">
                                <div class="invalid-feedback"><?php echo $errors['nama'] ?? ''; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
                                    <div class="invalid-feedback"><?php echo $errors['email'] ?? ''; ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" name="telepon" class="form-control <?php echo isset($errors['telepon']) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($telepon); ?>" placeholder="08xxxxxxxxxx">
                                    <div class="invalid-feedback"><?php echo $errors['telepon'] ?? ''; ?></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control <?php echo isset($errors['alamat']) ? 'is-invalid' : ''; ?>" rows="3"><?php echo htmlspecialchars($alamat); ?></textarea>
                                <div class="invalid-feedback"><?php echo $errors['alamat'] ?? ''; ?></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label d-block">Jenis Kelamin</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input <?php echo isset($errors['jk']) ? 'is-invalid' : ''; ?>" type="radio" name="jk" id="l" value="Laki-laki" <?php echo ($jk == 'Laki-laki') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="l">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input <?php echo isset($errors['jk']) ? 'is-invalid' : ''; ?>" type="radio" name="jk" id="p" value="Perempuan" <?php echo ($jk == 'Perempuan') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="p">Perempuan</label>
                                    </div>
                                    <div class="text-danger small mt-1"><?php echo $errors['jk'] ?? ''; ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control <?php echo isset($errors['tgl_lahir']) ? 'is-invalid' : ''; ?>" value="<?php echo $tgl_lahir; ?>">
                                    <div class="invalid-feedback"><?php echo $errors['tgl_lahir'] ?? ''; ?></div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Pekerjaan</label>
                                <select name="pekerjaan" class="form-select <?php echo isset($errors['pekerjaan']) ? 'is-invalid' : ''; ?>">
                                    <option value="">-- Pilih Pekerjaan --</option>
                                    <option value="Pelajar" <?php echo ($pekerjaan == 'Pelajar') ? 'selected' : ''; ?>>Pelajar</option>
                                    <option value="Mahasiswa" <?php echo ($pekerjaan == 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                                    <option value="Pegawai" <?php echo ($pekerjaan == 'Pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                    <option value="Lainnya" <?php echo ($pekerjaan == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                                <div class="invalid-feedback"><?php echo $errors['pekerjaan'] ?? ''; ?></div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-send"></i> Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>