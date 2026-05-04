<?php require_once "../../config/database.php"; ?>

<?php
$limit = 10;
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;

$search = sanitize($_GET['search'] ?? '');
$status = sanitize($_GET['status'] ?? '');
$jk = sanitize($_GET['jk'] ?? '');

$query = "SELECT * FROM anggota WHERE 
(nama LIKE '%$search%' OR email LIKE '%$search%' OR telepon LIKE '%$search%')
AND status LIKE '%$status%'
AND jenis_kelamin LIKE '%$jk%'
LIMIT $start, $limit";

$result = $conn->query($query);

// statistik
$total = $conn->query("SELECT COUNT(*) as t FROM anggota")->fetch_assoc()['t'];
$aktif = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE status='Aktif'")->fetch_assoc()['t'];
$nonaktif = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE status='Nonaktif'")->fetch_assoc()['t'];
?>

<h2>Data Anggota</h2>

<p>Total: <?= $total ?> | Aktif: <?= $aktif ?> | Nonaktif: <?= $nonaktif ?></p>

<form method="GET">
<input name="search" placeholder="Cari..." value="<?= $search ?>">

<select name="status">
<option value="">Semua Status</option>
<option <?= $status=='Aktif'?'selected':'' ?>>Aktif</option>
<option <?= $status=='Nonaktif'?'selected':'' ?>>Nonaktif</option>
</select>

<select name="jk">
<option value="">Semua JK</option>
<option <?= $jk=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
<option <?= $jk=='Perempuan'?'selected':'' ?>>Perempuan</option>
</select>

<button>Filter</button>
</form>

<a href="create.php">+ Tambah</a>

<table border="1">
<tr>
<th>Foto</th>
<th>Nama</th>
<th>Email</th>
<th>Telepon</th>
<th>Status</th>
<th>JK</th>
<th>Aksi</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td>
<?php if($row['foto']): ?>
<img src="uploads/<?= $row['foto'] ?>" width="50">
<?php endif; ?>
</td>

<td><?= $row['nama'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['telepon'] ?></td>

<td style="background:<?= $row['status']=='Aktif'?'green':'red' ?>;color:white">
<?= $row['status'] ?>
</td>

<td><?= $row['jenis_kelamin'] ?></td>

<td>
<a href="edit.php?id=<?= $row['id_anggota'] ?>">Edit</a>
<a href="delete.php?id=<?= $row['id_anggota'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</table>