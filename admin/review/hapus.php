<?php
session_start();
include '../../config/database.php';

$id_review = $_POST["id_review"];
$gambar = $_POST["gambar"];

$sql = "delete from review where id_review=$id_review";
$hapus_review = mysqli_query($kon, $sql);


?>