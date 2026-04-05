<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">
        <i class="bi bi-person-check"></i> Status Peminjaman Anggota
    </h1>

    <?php
    // Data Anggota
    $nama_anggota = "Budi Santoso";
    $total_pinjaman = 2;
    $buku_terlambat = 1;
    $hari_keterlambatan = 5;

    // =========================
    // LOGIKA DENDA
    // =========================
    if ($buku_terlambat > 0) {
        $denda = $buku_terlambat * $hari_keterlambatan * 1000;

        if ($denda > 50000) {
            $denda = 50000;
        }
    } else {
        $denda = 0;
    }

    // =========================
    // STATUS PINJAM (IF ELSE)
    // =========================
    if ($buku_terlambat > 0) {
        $status_pinjam = "Tidak Bisa Meminjam";
        $badge = "danger";
        $icon = "x-circle";
        $pesan = "Masih ada buku yang terlambat!";
    } elseif ($total_pinjaman >= 3) {
        $status_pinjam = "Batas Maksimal Tercapai";
        $badge = "warning";
        $icon = "exclamation-triangle";
        $pesan = "Jumlah pinjaman sudah mencapai batas maksimal.";
    } else {
        $status_pinjam = "Boleh Meminjam";
        $badge = "success";
        $icon = "check-circle";
        $pesan = "Silakan meminjam buku.";
    }

    // =========================
    // LEVEL MEMBER (SWITCH)
    // =========================
    switch (true) {
        case ($total_pinjaman <= 5):
            $level = "Bronze";
            break;
        case ($total_pinjaman <= 15):
            $level = "Silver";
            break;
        default:
            $level = "Gold";
            break;
    }
    ?>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-person"></i> <?php echo $nama_anggota; ?>
            </h5>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-8">

                    <p><strong>Total Pinjaman:</strong> <?php echo $total_pinjaman; ?> buku</p>
                    <p><strong>Buku Terlambat:</strong> <?php echo $buku_terlambat; ?> buku</p>
                    <p><strong>Level Member:</strong> 
                        <span class="badge bg-dark"><?php echo $level; ?></span>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <span class="badge bg-<?php echo $badge; ?>">
                            <i class="bi bi-<?php echo $icon; ?>"></i>
                            <?php echo $status_pinjam; ?>
                        </span>
                    </p>

                    <p class="text-muted"><em><?php echo $pesan; ?></em></p>

                    <?php if ($buku_terlambat > 0): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            Anda memiliki keterlambatan selama <?php echo $hari_keterlambatan; ?> hari.
                            <br>
                            <strong>Total Denda: Rp <?php echo number_format($denda, 0, ',', '.'); ?></strong>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i>
                            Tidak ada keterlambatan.
                        </div>
                    <?php endif; ?>

                </div>

                <div class="col-md-4 text-end">
                    <?php if ($status_pinjam == "Boleh Meminjam"): ?>
                        <button class="btn btn-success">
                            <i class="bi bi-book"></i> Pinjam Buku
                        </button>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-lock"></i> Tidak Bisa Meminjam
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>