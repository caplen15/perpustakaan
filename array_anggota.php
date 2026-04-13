<?php
// Data anggota (multidimensional array)
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "email" => "budi@email.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjaman" => 5
    ],
    [
        "id" => "AGT-002",
        "nama" => "Siti Aminah",
        "email" => "siti@email.com",
        "telepon" => "082345678901",
        "alamat" => "Bandung",
        "tanggal_daftar" => "2024-02-10",
        "status" => "Aktif",
        "total_pinjaman" => 8
    ],
    [
        "id" => "AGT-003",
        "nama" => "Andi Wijaya",
        "email" => "andi@email.com",
        "telepon" => "083456789012",
        "alamat" => "Surabaya",
        "tanggal_daftar" => "2024-03-05",
        "status" => "Non-Aktif",
        "total_pinjaman" => 2
    ],
    [
        "id" => "AGT-004",
        "nama" => "Dewi Lestari",
        "email" => "dewi@email.com",
        "telepon" => "084567890123",
        "alamat" => "Yogyakarta",
        "tanggal_daftar" => "2024-04-01",
        "status" => "Aktif",
        "total_pinjaman" => 10
    ],
    [
        "id" => "AGT-005",
        "nama" => "Rudi Hartono",
        "email" => "rudi@email.com",
        "telepon" => "085678901234",
        "alamat" => "Semarang",
        "tanggal_daftar" => "2024-05-12",
        "status" => "Non-Aktif",
        "total_pinjaman" => 1
    ]
];

// ================== LOGIKA ==================
$total_anggota = count($anggota_list);

$aktif = 0;
$nonaktif = 0;
$total_pinjaman = 0;
$teraktif = $anggota_list[0];

foreach ($anggota_list as $anggota) {
    if ($anggota['status'] == "Aktif") {
        $aktif++;
    } else {
        $nonaktif++;
    }

    $total_pinjaman += $anggota['total_pinjaman'];

    if ($anggota['total_pinjaman'] > $teraktif['total_pinjaman']) {
        $teraktif = $anggota;
    }
}

$persen_aktif = ($aktif / $total_anggota) * 100;
$persen_nonaktif = ($nonaktif / $total_anggota) * 100;
$rata_pinjaman = $total_pinjaman / $total_anggota;

// Filter status (optional dari URL)
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'Semua';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2 class="mb-4">Data Anggota Perpustakaan</h2>

<!-- FILTER -->
<div class="mb-3">
    <a href="?status=Semua" class="btn btn-secondary">Semua</a>
    <a href="?status=Aktif" class="btn btn-success">Aktif</a>
    <a href="?status=Non-Aktif" class="btn btn-danger">Non-Aktif</a>
</div>

<!-- STATISTIK CARDS -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card p-3 bg-primary text-white">
            <h5>Total Anggota</h5>
            <h3><?= $total_anggota ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 bg-success text-white">
            <h5>Aktif</h5>
            <h3><?= round($persen_aktif,2) ?>%</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 bg-danger text-white">
            <h5>Non-Aktif</h5>
            <h3><?= round($persen_nonaktif,2) ?>%</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 bg-warning text-dark">
            <h5>Rata-rata Pinjaman</h5>
            <h3><?= round($rata_pinjaman,2) ?></h3>
        </div>
    </div>
</div>

<!-- TERAKTIF -->
<div class="alert alert-info">
    <strong>Anggota Teraktif:</strong> <?= $teraktif['nama'] ?> (<?= $teraktif['total_pinjaman'] ?> pinjaman)
</div>

<!-- TABEL -->
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
            <th>Total Pinjaman</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($anggota_list as $anggota): ?>
            <?php if ($status_filter == 'Semua' || $anggota['status'] == $status_filter): ?>
            <tr>
                <td><?= $anggota['id'] ?></td>
                <td><?= $anggota['nama'] ?></td>
                <td><?= $anggota['email'] ?></td>
                <td><?= $anggota['telepon'] ?></td>
                <td><?= $anggota['alamat'] ?></td>
                <td><?= $anggota['tanggal_daftar'] ?></td>
                <td><?= $anggota['status'] ?></td>
                <td><?= $anggota['total_pinjaman'] ?></td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>