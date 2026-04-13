<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
require_once 'functions_anggota.php';

// DATA
$anggota_list = [
    ["id"=>"AGT-001","nama"=>"Budi","email"=>"budi@email.com","telepon"=>"0812","alamat"=>"Jakarta","tanggal_daftar"=>"2024-01-15","status"=>"Aktif","total_pinjaman"=>5],
    ["id"=>"AGT-002","nama"=>"Siti","email"=>"siti@email.com","telepon"=>"0822","alamat"=>"Bandung","tanggal_daftar"=>"2024-02-10","status"=>"Aktif","total_pinjaman"=>8],
    ["id"=>"AGT-003","nama"=>"Andi","email"=>"andi@email.com","telepon"=>"0833","alamat"=>"Surabaya","tanggal_daftar"=>"2024-03-05","status"=>"Non-Aktif","total_pinjaman"=>2],
    ["id"=>"AGT-004","nama"=>"Dewi","email"=>"dewi@email.com","telepon"=>"0844","alamat"=>"Jogja","tanggal_daftar"=>"2024-04-01","status"=>"Aktif","total_pinjaman"=>10],
    ["id"=>"AGT-005","nama"=>"Rudi","email"=>"rudi@email.com","telepon"=>"0855","alamat"=>"Semarang","tanggal_daftar"=>"2024-05-12","status"=>"Non-Aktif","total_pinjaman"=>1],
];

// SEARCH
if (isset($_GET['search'])) {
    $anggota_list = search_by_nama($anggota_list, $_GET['search']);
}

// SORT
$anggota_list = sort_by_nama($anggota_list);

// STATISTIK
$total = hitung_total_anggota($anggota_list);
$aktif = hitung_anggota_aktif($anggota_list);
$rata = hitung_rata_rata_pinjaman($anggota_list);
$teraktif = cari_anggota_teraktif($anggota_list);

$nonaktif = $total - $aktif;
?>

<div class="container mt-5">
<h2 class="mb-4">Sistem Anggota</h2>

<!-- SEARCH -->
<form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" placeholder="Cari nama...">
</form>

<!-- STATISTIK -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card p-3 bg-primary text-white">
            Total: <?= $total ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 bg-success text-white">
            Aktif: <?= $aktif ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 bg-danger text-white">
            Non-Aktif: <?= $nonaktif ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 bg-warning">
            Rata Pinjaman: <?= round($rata,2) ?>
        </div>
    </div>
</div>

<!-- TABEL -->
<table class="table table-bordered">
<tr>
    <th>ID</th><th>Nama</th><th>Status</th><th>Pinjaman</th><th>Tanggal</th>
</tr>
<?php foreach ($anggota_list as $a): ?>
<tr>
    <td><?= $a['id'] ?></td>
    <td><?= $a['nama'] ?></td>
    <td><?= $a['status'] ?></td>
    <td><?= $a['total_pinjaman'] ?></td>
    <td><?= format_tanggal_indo($a['tanggal_daftar']) ?></td>
</tr>
<?php endforeach; ?>
</table>

<!-- TERAKTIF -->
<div class="card bg-success text-white p-3">
    <h5>Anggota Teraktif</h5>
    <p><?= $teraktif['nama'] ?> (<?= $teraktif['total_pinjaman'] ?> pinjaman)</p>
</div>

<!-- LIST AKTIF -->
<h4 class="mt-4">Anggota Aktif</h4>
<ul>
<?php foreach (filter_by_status($anggota_list, "Aktif") as $a): ?>
    <li><?= $a['nama'] ?></li>
<?php endforeach; ?>
</ul>

<h4>Anggota Non-Aktif</h4>
<ul>
<?php foreach (filter_by_status($anggota_list, "Non-Aktif") as $a): ?>
    <li><?= $a['nama'] ?></li>
<?php endforeach; ?>
</ul>

</div>

</body>
</html>