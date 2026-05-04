<?php require_once "../../config/database.php"; ?>

<?php
if(isset($_POST['submit'])){

$kode = sanitize($_POST['kode']);
$nama = sanitize($_POST['nama']);
$email = sanitize($_POST['email']);
$telepon = sanitize($_POST['telepon']);
$alamat = sanitize($_POST['alamat']);
$tgl = $_POST['tanggal_lahir'];
$jk = sanitize($_POST['jenis_kelamin']);
$pekerjaan = sanitize($_POST['pekerjaan']);

// validasi umur
$umur = date('Y') - date('Y', strtotime($tgl));
if($umur < 10) die("Umur minimal 10 tahun");

// validasi telepon
if(!preg_match('/^08[0-9]{8,11}$/',$telepon)) die("Format telepon salah");

// upload foto
$foto = '';
if($_FILES['foto']['name']){
$foto = time().$_FILES['foto']['name'];
move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$foto);
}

$tanggal_daftar = date('Y-m-d');

$conn->query("INSERT INTO anggota
(kode_anggota,nama,email,telepon,alamat,tanggal_lahir,jenis_kelamin,pekerjaan,tanggal_daftar,foto)
VALUES
('$kode','$nama','$email','$telepon','$alamat','$tgl','$jk','$pekerjaan','$tanggal_daftar','$foto')");

header("Location: index.php");
}
?>

<h2>Tambah Anggota</h2>

<form method="POST" enctype="multipart/form-data">
<input name="kode" required placeholder="Kode"><br>
<input name="nama" required><br>
<input type="email" name="email" required><br>
<input name="telepon" required><br>
<textarea name="alamat" required></textarea><br>
<input type="date" name="tanggal_lahir" required><br>

<select name="jenis_kelamin">
<option>Laki-laki</option>
<option>Perempuan</option>
</select><br>

<input name="pekerjaan"><br>
<input type="file" name="foto"><br>

<button name="submit">Simpan</button>
</form>