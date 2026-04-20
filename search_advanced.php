<?php
session_start();

// 1. Data Buku (12 Data)
$buku_list = [
    ['kode' => 'B001', 'judul' => 'Pemrograman PHP Modern', 'kategori' => 'Programming', 'pengarang' => 'Budi Raharjo', 'penerbit' => 'Informatika', 'tahun' => 2023, 'harga' => 95000, 'stok' => 10],
    ['kode' => 'B002', 'judul' => 'Mastering MySQL', 'kategori' => 'Database', 'pengarang' => 'Luki Ardi', 'penerbit' => 'Elex Media', 'tahun' => 2021, 'harga' => 85000, 'stok' => 5],
    ['kode' => 'B003', 'judul' => 'UI/UX Design for Beginner', 'kategori' => 'Web Design', 'pengarang' => 'Siska Amelia', 'penerbit' => 'Andi Offset', 'tahun' => 2022, 'harga' => 120000, 'stok' => 0],
    ['kode' => 'B004', 'judul' => 'Jaringan Komputer Pro', 'kategori' => 'Networking', 'pengarang' => 'Dedi Wijaya', 'penerbit' => 'Informatika', 'tahun' => 2020, 'harga' => 75000, 'stok' => 12],
    ['kode' => 'B005', 'judul' => 'Laravel Framework Mastery', 'kategori' => 'Programming', 'pengarang' => 'Budi Raharjo', 'penerbit' => 'Andi Offset', 'tahun' => 2024, 'harga' => 150000, 'stok' => 3],
    ['kode' => 'B006', 'judul' => 'Algoritma & Struktur Data', 'kategori' => 'Programming', 'pengarang' => 'Hadi Suwito', 'penerbit' => 'Elex Media', 'tahun' => 2019, 'harga' => 65000, 'stok' => 0],
    ['kode' => 'B007', 'judul' => 'Bootstrap 5 Responsive', 'kategori' => 'Web Design', 'pengarang' => 'Siska Amelia', 'penerbit' => 'Informatika', 'tahun' => 2023, 'harga' => 80000, 'stok' => 15],
    ['kode' => 'B008', 'judul' => 'Keamanan Siber (Cyber Security)', 'kategori' => 'Networking', 'pengarang' => 'Andri Jaelani', 'penerbit' => 'Elex Media', 'tahun' => 2022, 'harga' => 110000, 'stok' => 7],
    ['kode' => 'B009', 'judul' => 'Data Science dengan Python', 'kategori' => 'Database', 'pengarang' => 'Rina Putri', 'penerbit' => 'Andi Offset', 'tahun' => 2024, 'harga' => 135000, 'stok' => 4],
    ['kode' => 'B010', 'judul' => 'Cloud Computing Essential', 'kategori' => 'Networking', 'pengarang' => 'Dedi Wijaya', 'penerbit' => 'Informatika', 'tahun' => 2021, 'harga' => 90000, 'stok' => 9],
    ['kode' => 'B011', 'judul' => 'React JS vs Vue JS', 'kategori' => 'Programming', 'pengarang' => 'Hadi Suwito', 'penerbit' => 'Elex Media', 'tahun' => 2022, 'harga' => 105000, 'stok' => 2],
    ['kode' => 'B012', 'judul' => 'Desain Grafis Profesional', 'kategori' => 'Web Design', 'pengarang' => 'Rina Putri', 'penerbit' => 'Andi Offset', 'tahun' => 2018, 'harga' => 55000, 'stok' => 20],
];

// 2. Ambil Parameter GET
$keyword = $_GET['keyword'] ?? '';
$kategori = $_GET['kategori'] ?? '';
$min_harga = $_GET['min_harga'] ?? '';
$max_harga = $_GET['max_harga'] ?? '';
$tahun_cari = $_GET['tahun'] ?? '';
$status = $_GET['status'] ?? 'semua';
$sort = $_GET['sort'] ?? 'judul';

// Simpan riwayat pencarian (Bonus)
if (!empty($keyword)) {
    $_SESSION['recent_searches'][$keyword] = time();
}

// 3. Validasi
$errors = [];
if (!empty($min_harga) && !empty($max_harga) && $min_harga > $max_harga) {
    $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum.";
}
if (!empty($tahun_cari) && ($tahun_cari < 1900 || $tahun_cari > date('Y'))) {
    $errors[] = "Tahun harus antara 1900 - " . date('Y');
}

// 4. Proses Filter & Sorting
$hasil = [];
if (empty($errors)) {
    foreach ($buku_list as $buku) {
        // Filter Keyword (Judul/Pengarang)
        if (!empty($keyword) && stripos($buku['judul'], $keyword) === false && stripos($buku['pengarang'], $keyword) === false) continue;
        
        // Filter Kategori
        if (!empty($kategori) && $buku['kategori'] !== $kategori) continue;
        
        // Filter Harga
        if (!empty($min_harga) && $buku['harga'] < $min_harga) continue;
        if (!empty($max_harga) && $buku['harga'] > $max_harga) continue;
        
        // Filter Tahun
        if (!empty($tahun_cari) && $buku['tahun'] != $tahun_cari) continue;
        
        // Filter Status
        if ($status === 'tersedia' && $buku['stok'] <= 0) continue;
        if ($status === 'habis' && $buku['stok'] > 0) continue;

        $hasil[] = $buku;
    }

    // Sorting
    usort($hasil, function($a, $b) use ($sort) {
        if ($sort == 'harga') return $a['harga'] <=> $b['harga'];
        if ($sort == 'tahun') return $b['tahun'] <=> $a['tahun']; // Tahun terbaru dulu
        return strcasecmp($a['judul'], $b['judul']);
    });
}

// 5. Fungsi Highlight (Bonus)
function highlight($text, $search) {
    if (empty($search)) return $text;
    return preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="bg-warning">$1</span>', $text);
}

// 6. Export CSV (Bonus)
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="hasil_pencarian.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Kode', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun', 'Harga', 'Stok']);
    foreach ($hasil as $row) fputcsv($output, $row);
    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pencarian Buku Lanjutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="mb-4"><i class="bi bi-search"></i> Pencarian Buku Lanjutan</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Keyword (Judul/Pengarang)</label>
                            <input type="text" name="keyword" class="form-control" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari buku...">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="Programming" <?= $kategori == 'Programming' ? 'selected' : '' ?>>Programming</option>
                                <option value="Database" <?= $kategori == 'Database' ? 'selected' : '' ?>>Database</option>
                                <option value="Web Design" <?= $kategori == 'Web Design' ? 'selected' : '' ?>>Web Design</option>
                                <option value="Networking" <?= $kategori == 'Networking' ? 'selected' : '' ?>>Networking</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Urutkan Berdasarkan</label>
                            <select name="sort" class="form-select">
                                <option value="judul" <?= $sort == 'judul' ? 'selected' : '' ?>>Judul (A-Z)</option>
                                <option value="harga" <?= $sort == 'harga' ? 'selected' : '' ?>>Harga Terendah</option>
                                <option value="tahun" <?= $sort == 'tahun' ? 'selected' : '' ?>>Tahun Terbaru</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" class="form-control" value="<?= htmlspecialchars($tahun_cari) ?>" placeholder="2024">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Rentang Harga</label>
                            <div class="input-group">
                                <input type="number" name="min_harga" class="form-control" value="<?= htmlspecialchars($min_harga) ?>" placeholder="Min">
                                <span class="input-group-text">-</span>
                                <input type="number" name="max_harga" class="form-control" value="<?= htmlspecialchars($max_harga) ?>" placeholder="Max">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label d-block">Status Ketersediaan</label>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="radio" name="status" value="semua" <?= $status == 'semua' ? 'checked' : '' ?>>
                                <label class="form-check-label">Semua</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="tersedia" <?= $status == 'tersedia' ? 'checked' : '' ?>>
                                <label class="form-check-label text-success">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="habis" <?= $status == 'habis' ? 'checked' : '' ?>>
                                <label class="form-check-label text-danger">Habis</label>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel"></i> Terapkan Filter</button>
                            <a href="search_advanced.php" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0"><?php foreach($errors as $e) echo "<li>$e</li>"; ?></ul>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>Ditemukan <strong><?= count($hasil) ?></strong> buku.</div>
            <?php if (count($hasil) > 0): ?>
                <a href="?<?= $_SERVER['QUERY_STRING'] ?>&export=csv" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Export to CSV
                </a>
            <?php endif; ?>
        </div>

        <div class="table-responsive bg-white p-3 rounded shadow-sm">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode</th>
                        <th>Judul & Pengarang</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($hasil) > 0): ?>
                        <?php foreach ($hasil as $b): ?>
                            <tr>
                                <td><code><?= $b['kode'] ?></code></td>
                                <td>
                                    <div class="fw-bold"><?= highlight($b['judul'], $keyword) ?></div>
                                    <small class="text-muted">Oleh: <?= highlight($b['pengarang'], $keyword) ?></small>
                                </td>
                                <td><span class="badge bg-info text-dark"><?= $b['kategori'] ?></span></td>
                                <td><?= $b['tahun'] ?></td>
                                <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if ($b['stok'] > 0): ?>
                                        <span class="badge bg-success"><?= $b['stok'] ?> Unit</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($_SESSION['recent_searches'])): ?>
            <div class="mt-4 p-3 bg-white border rounded">
                <small class="text-muted">Pencarian Terakhir:</small>
                <?php foreach (array_slice($_SESSION['recent_searches'], -5) as $s => $t): ?>
                    <a href="?keyword=<?= urlencode($s) ?>" class="badge bg-light text-dark text-decoration-none border"><?= $s ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>