<?php
session_start();
include '../../config/database.php';

$id_wisata = $_POST["id_wisata"];
$gambar = $_POST["gambar"];

$sql = "delete from wisata where id_wisata=$id_wisata";
$hapus_wisata = mysqli_query($kon, $sql);

//Menghapus gambar, gambar yang dihapus jika selain gambar default
if ($gambar != 'gambar_default.png') {
    unlink("gambar/" . $gambar);
}


?>