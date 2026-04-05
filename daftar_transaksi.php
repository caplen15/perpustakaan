<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">
        <i class="bi bi-journal-text"></i> Daftar Transaksi Peminjaman
    </h1>

    <?php
    // =========================
    // STATISTIK
    // =========================
    $total_transaksi = 0;
    $total_dipinjam = 0;
    $total_dikembalikan = 0;

    for ($i = 1; $i <= 10; $i++) {

        // BREAK di transaksi ke-8
        if ($i == 8) {
            break;
        }

        // CONTINUE untuk skip genap
        if ($i % 2 == 0) {
            continue;
        }

        $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

        $total_transaksi++;

        if ($status == "Dipinjam") {
            $total_dipinjam++;
        } else {
            $total_dikembalikan++;
        }
    }
    ?>

    <!-- ========================= -->
    <!-- CARD STATISTIK -->
    <!-- ========================= -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5><i class="bi bi-list"></i> Total Transaksi</h5>
                    <h2><?php echo $total_transaksi; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5><i class="bi bi-clock"></i> Masih Dipinjam</h5>
                    <h2><?php echo $total_dipinjam; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5><i class="bi bi-check-circle"></i> Dikembalikan</h5>
                    <h2><?php echo $total_dikembalikan; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================= -->
    <!-- TABEL -->
    <!-- ========================= -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Hari</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $no = 1;

                for ($i = 1; $i <= 10; $i++) {

                    // BREAK di 8
                    if ($i == 8) {
                        break;
                    }

                    // CONTINUE genap
                    if ($i % 2 == 0) {
                        continue;
                    }

                    // Generate data
                    $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                    $nama_peminjam = "Anggota " . $i;
                    $judul_buku = "Buku Teknologi Vol. " . $i;
                    $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                    $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                    $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                    // Hitung hari sejak pinjam
                    $hari = floor((time() - strtotime($tanggal_pinjam)) / (60*60*24));

                    // Badge status
                    if ($status == "Dipinjam") {
                        $badge = "warning";
                        $icon = "clock";
                    } else {
                        $badge = "success";
                        $icon = "check-circle";
                    }
                ?>

                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $id_transaksi; ?></td>
                        <td><?php echo $nama_peminjam; ?></td>
                        <td><?php echo $judul_buku; ?></td>
                        <td><?php echo $tanggal_pinjam; ?></td>
                        <td><?php echo $tanggal_kembali; ?></td>
                        <td class="text-center"><?php echo $hari; ?> hari</td>
                        <td class="text-center">
                            <span class="badge bg-<?php echo $badge; ?>">
                                <i class="bi bi-<?php echo $icon; ?>"></i>
                                <?php echo $status; ?>
                            </span>
                        </td>
                    </tr>

                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>