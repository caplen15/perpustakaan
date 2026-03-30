<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Informasi Buku</h1>

    <?php
    function warnaKategori($kategori){
        if($kategori == "Programming") return "primary";
        elseif($kategori == "Database") return "success";
        elseif($kategori == "Web Design") return "warning";
        else return "secondary";
    }

    // Buku 1
    $judul1 = "Jago Coding 1 Hari";
    $kategori1 = "Programming";
    $bahasa1 = "Indonesia";
    $halaman1 = 390;
    $pengarang1 = "Hamdan Aldi";
    $penerbit1 = "Yenpop Digiprint";
    $tahun1 = 2023;
    $harga1 = 71000;
    $stok1 = 25;
    $isbn1 = "978-602-1222-41-2";
    $berat1 = 450;

    // Buku 2
    $judul2 = "MySQL untuk Pemula : Belajar dari Nol";
    $kategori2 = "Database";
    $bahasa2 = "Indonesia";
    $halaman2 = 420;
    $pengarang2 = "Raffi Ahmadi";
    $penerbit2 = "Bro Media";
    $tahun2 = 2022;
    $harga2 = 90000;
    $stok2 = 8;
    $isbn2 = "978-602-2222-33-4";
    $berat2 = 550;

    // Buku 3
    $judul3 = "Cara Membuat Website dalam 1 Malam : Tips & Trick";
    $kategori3 = "Web Design";
    $bahasa3 = "Indonesia";
    $halaman3 = 300;
    $pengarang3 = "Agus Doni Prasetyo";
    $penerbit3 = "Garamedia";
    $tahun3 = 2021;
    $harga3 = 125000;
    $stok3 = 12;
    $isbn3 = "978-602-3333-44-5";
    $berat3 = 450;
    ?>

    <!-- Buku 1 -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <?php echo $judul1; ?>
                <span class="badge bg-<?php echo warnaKategori($kategori1); ?>">
                    <?php echo $kategori1; ?>
                </span>
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr><th>Kategori</th><td>: <?php echo $kategori1; ?></td></tr>
                <tr><th>Pengarang</th><td>: <?php echo $pengarang1; ?></td></tr>
                <tr><th>Penerbit</th><td>: <?php echo $penerbit1; ?></td></tr>
                <tr><th>Tahun</th><td>: <?php echo $tahun1; ?></td></tr>
                <tr><th>ISBN</th><td>: <?php echo $isbn1; ?></td></tr>
                <tr><th>Bahasa</th><td>: <?php echo $bahasa1; ?></td></tr>
                <tr><th>Halaman</th><td>: <?php echo $halaman1; ?></td></tr>
                <tr><th>Berat</th><td>: <?php echo $berat1; ?> gram</td></tr>
                <tr><th>Harga</th><td>: Rp <?php echo number_format($harga1,0,',','.'); ?></td></tr>
                <tr><th>Stok</th><td>: <?php echo $stok1; ?> buku</td></tr>
            </table>
        </div>
    </div>

    <!-- Buku 2 -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <?php echo $judul2; ?>
                <span class="badge bg-<?php echo warnaKategori($kategori2); ?>">
                    <?php echo $kategori2; ?>
                </span>
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr><th>Kategori</th><td>: <?php echo $kategori2; ?></td></tr>
                <tr><th>Pengarang</th><td>: <?php echo $pengarang2; ?></td></tr>
                <tr><th>Penerbit</th><td>: <?php echo $penerbit2; ?></td></tr>
                <tr><th>Tahun</th><td>: <?php echo $tahun2; ?></td></tr>
                <tr><th>ISBN</th><td>: <?php echo $isbn2; ?></td></tr>
                <tr><th>Bahasa</th><td>: <?php echo $bahasa2; ?></td></tr>
                <tr><th>Halaman</th><td>: <?php echo $halaman2; ?></td></tr>
                <tr><th>Berat</th><td>: <?php echo $berat2; ?> gram</td></tr>
                <tr><th>Harga</th><td>: Rp <?php echo number_format($harga2,0,',','.'); ?></td></tr>
                <tr><th>Stok</th><td>: <?php echo $stok2; ?> buku</td></tr>
            </table>
        </div>
    </div>

    <!-- Buku 3 -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <?php echo $judul3; ?>
                <span class="badge bg-<?php echo warnaKategori($kategori3); ?>">
                    <?php echo $kategori3; ?>
                </span>
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr><th>Kategori</th><td>: <?php echo $kategori3; ?></td></tr>
                <tr><th>Pengarang</th><td>: <?php echo $pengarang3; ?></td></tr>
                <tr><th>Penerbit</th><td>: <?php echo $penerbit3; ?></td></tr>
                <tr><th>Tahun</th><td>: <?php echo $tahun3; ?></td></tr>
                <tr><th>ISBN</th><td>: <?php echo $isbn3; ?></td></tr>
                <tr><th>Bahasa</th><td>: <?php echo $bahasa3; ?></td></tr>
                <tr><th>Halaman</th><td>: <?php echo $halaman3; ?></td></tr>
                <tr><th>Berat</th><td>: <?php echo $berat3; ?> gram</td></tr>
                <tr><th>Harga</th><td>: Rp <?php echo number_format($harga3,0,',','.'); ?></td></tr>
                <tr><th>Stok</th><td>: <?php echo $stok3; ?> buku</td></tr>
            </table>
        </div>
    </div>

</div>
</body>
</html>