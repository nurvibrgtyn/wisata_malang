<?php
if (isset($_POST['form_review'])) {
    //Include file koneksi, untuk koneksikan ke database
    include 'config/database.php';

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $id_wisata = input($_POST["id_wisata"]);
    $nama = input($_POST["nama"]);
    $email = input($_POST["email"]);
    $review = input($_POST["review"]);
    $status = input($_POST["status"]);


    //Query input menginput data kedalam tabel 
    $sql = "insert into review (id_wisata,nama,email,isi_review,status_review) values
        ('$id_wisata','$nama','$email','$review','$status')";
    //Mengeksekusi/menjalankan query 
    $hasil = mysqli_query($kon, $sql);


    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hasil) {
        header("Location:index.php?halaman=wisata&id=$id_wisata&review=berhasil");
    } else {
        header("Location:index.php?halaman=wisata&id=$id_wisata&review=gagal");

    }

}
?>