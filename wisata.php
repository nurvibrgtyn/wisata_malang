<?php
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
include 'config/database.php';
$id_wisata = input($_GET['id']);
$query = mysqli_query($kon, "select * from wisata a inner join kategori k on k.id_kategori=a.id_kategori where id_wisata='" . $id_wisata . "' limit 1");
$data = mysqli_fetch_assoc($query);
?>
<div class="row">
    <div class="col-sm-8">
        <div class="thumbnail">

            <img src="admin/wisata/gambar/<?php echo $data['gambar']; ?>" width="100%" alt="Cinque Terre">
            <div class="caption">
                <br>
                <?php
                echo strip_tags(html_entity_decode($data["isi_wisata"], ENT_QUOTES, "ISO-8859-1")); // Mengonversi tanda kutip ganda dan tunggal
                ?>
            </div>
            <br>
            <div class="card">
                <h5 class="card-header">Informasi</h5>
                <div class="card-body">
                    <h6>Harga Tiket Masuk: Rp
                        <?php echo $data["harga_tiket"]; ?>
                    </h6>
                    <h6>Jam Buka:
                        <?php echo $data["jam_buka"]; ?> WIB
                    </h6>
                    <h6>Jam Tutup:
                        <?php echo $data["jam_tutup"]; ?> WIB
                    </h6>
                </div>
            </div>

            <?php
            if (isset($_GET['review'])) {
                //Mengecek nilai variabel add yang telah di enskripsi dengan method md5()
                if ($_GET['review'] == 'berhasil') {
                    echo "<div class='alert alert-success'>review telah terkirim, menunggu persetujuan dari admin</div>";
                } else {
                    echo "<div class='alert alert-danger'>review gagal</div>";
                }
            }
            ?>
            <br>

            <div class="card">
                <h5 class="card-header">Review</h5>
                <?php
                include 'config/database.php';
                $sql = "select * from review where id_wisata=$id_wisata and status_review=1 order by id_review desc";
                $hasil = mysqli_query($kon, $sql);
                while ($review = mysqli_fetch_array($hasil)):
                    ?>
                    <div class="card-body">
                        <h5>
                            <?php echo $review['nama']; ?>
                        </h5>
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="gambar/user.png" width="100%" alt="Cinque Terre">
                            </div>
                            <div class="col-sm-11">
                                <?php echo $review['isi_review']; ?>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php endwhile; ?>
            </div>
            <p>

            <div class="review">
                <form method="post" action="simpan-review.php">
                    <label>
                        <h2>Tinggalkan Review</h2>
                    </label>
                    <div class="form-group">
                        <input type="hidden" name="id_wisata" value="<?php echo $data['id_wisata']; ?>"
                            class="form-control">
                        <input type="hidden" name="status" value="0" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Review:</label>
                        <textarea class="form-control" name="review" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="form_review" class="btn btn-dark" value="Kirim Review">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="row">
            <div class="card col-sm-12">
                <h4 class="card-header ">Rekomendasi Wisata</h4>

                <?php
                include 'config/database.php';
                $sql = "select * from wisata where status=1 order by id_wisata desc";
                $hasil = mysqli_query($kon, $sql);
                while ($data = mysqli_fetch_array($hasil)):
                    ?>

                    <div class="card-body">
                        <h5><a class="text-dark" href="index.php?halaman=wisata&id=<?php echo $data['id_wisata']; ?>"><?php echo $data['judul_wisata']; ?></a></h5>
                        <div class="row">
                            <div class="col-xl-3">
                                <img src="admin/wisata/gambar/<?php echo $data['gambar']; ?>" width="100%"
                                    alt="Cinque Terre">
                            </div>
                            <div class="col-sm-9">
                                <?php
                                $ambil = $data["isi_wisata"];
                                $panjang = strip_tags(html_entity_decode($ambil, ENT_QUOTES, "ISO-8859-1"));

                                echo substr($panjang, 0, 100);
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>