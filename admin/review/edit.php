<?php
$id_review = $_POST["id_review"];
// mengambil data barang dengan kode paling besar
include '../../config/database.php';
$query = mysqli_query($kon, "SELECT * FROM review k inner join wisata a on a.id_wisata=k.id_wisata where id_review=$id_review");
$data = mysqli_fetch_array($query);

$judul_wisata = $data['judul_wisata'];
$nama = $data['nama'];
$email = $data['email'];
$isi_review = $data['isi_review'];
$id_wisata = $data['id_wisata'];

?>
<form action="review/edit.php" method="post">
    <div class="form-group">
        <input name="id_review" value="<?php echo $id_review; ?>" type="hidden" class="form-control">
        <input name="id_wisata" value="<?php echo $id_wisata; ?>" type="hidden" class="form-control">
    </div>
    <div class="form-group">
        <label>Wisata:</label>
        <input name="nama" value="<?php echo $judul_wisata; ?>" type="text" class="form-control" disabled>
    </div>
    <div class="form-group">
        <label>Nama:</label>
        <input name="nama" value="<?php echo $nama; ?>" type="text" class="form-control" placeholder="Masukan nama"
            required>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Email:</label>
                <input name="email" value="<?php echo $email; ?>" type="email" class="form-control"
                    placeholder="Masukan email" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Review:</label>
                <textarea name="isi_review" class="form-control" rows="5"><?php echo $isi_review; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
            <label> </label>
            <div class="form-check form-switch mx-4" >
                <input type="checkbox" class="form-check-input" id="statusSwitch" name="status" 
                <?php if ($data['status_review'] == 1) echo "checked"; ?> value="1">
                <label class="form-check-label" for="flexSwitchCheckDefault">Publish Review</label>
            </div>
        </div>
        <button type="submit" name="simpan_edit" class="btn btn-dark">Update review</button>
    </div>
</div>
    
</form>

<?php
if (isset($_POST['simpan_edit'])) {
    //Include file koneksi, untuk koneksikan ke database
    include '../../config/database.php';

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $id_review = input($_POST["id_review"]);
    $nama = input($_POST["nama"]);
    $email = input($_POST["email"]);
    $isi_review = input($_POST["isi_review"]);
    $id_wisata = input($_POST["id_wisata"]);
    $status = isset($_POST["status"]) ? 1 : 0;


    //Query input menginput data kedalam tabel anggota
    $sql = "update review set
        nama='$nama',
        email='$email',
        isi_review='$isi_review',
        id_wisata='$id_wisata',
        status_review='$status'
        where id_review=$id_review";

    //Mengeksekusi/menjalankan query 
    $hasil = mysqli_query($kon, $sql);


    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hasil) {
        header("Location:../index.php?halaman=review&edit=berhasil");
    } else {
        header("Location:../index.php?halaman=review&edit=gagal");
        ;

    }

}
?>