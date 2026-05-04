<?php require_once "../../config/database.php"; ?>

<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM anggota WHERE id_anggota=$id")->fetch_assoc();

if(isset($_POST['update'])){

$nama = sanitize($_POST['nama']);
$email = sanitize($_POST['email']);
$telepon = sanitize($_POST['telepon']);

$foto = $data['foto'];

if($_FILES['foto']['name']){
$foto = time().$_FILES['foto']['name'];
move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$foto);
}

$conn->query("UPDATE anggota SET
nama='$nama',
email='$email',
telepon='$telepon',
foto='$foto'
WHERE id_anggota=$id");

header("Location: index.php");
}
?>

<h2>Edit Anggota</h2>

<form method="POST" enctype="multipart/form-data">
<input name="nama" value="<?= $data['nama'] ?>"><br>
<input name="email" value="<?= $data['email'] ?>"><br>
<input name="telepon" value="<?= $data['telepon'] ?>"><br>
<input type="file" name="foto"><br>

<button name="update">Update</button>
</form>