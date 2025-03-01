<?php
session_start();

//Include file koneksi, untuk koneksikan ke database
if (isset($_POST['publish']) || isset($_POST['simpan_konsep'])) {

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['publish'])) {
            $status = 1;
        } else {
            $status = 0;
        }
        //Include database
        include '../../config/database.php';

        $kode_wisata = input($_POST["kode_wisata"]);
        $judul_wisata = input($_POST["judul_wisata"]);
        $kategori = input($_POST["kategori"]);
        $isi_wisata = input($_POST["isi_wisata"]);
        $harga_tiket = input($_POST["harga_tiket"]);
        $jam_buka = input($_POST["jam_buka"]);
        $jam_tutup = input($_POST["jam_tutup"]);
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        //$ukuran	= $_FILES['gambar']['size'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if (!empty($gambar)) {
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                //Mengupload gambar
                move_uploaded_file($file_tmp, 'gambar/' . $gambar);

                //Menambah wisata dengan gambar
                $sql = "insert into wisata (kode_wisata,judul_wisata,isi_wisata,harga_tiket,jam_buka,jam_tutup,gambar,status,id_kategori) values
                    ('$kode_wisata','$judul_wisata','$isi_wisata','$harga_tiket','$jam_buka','$jam_tutup','$gambar','$status','$kategori')";
            }

        } else {
            //Menambah wisata tanpa gambar, maka gambar_defauilt.png yang akan digunakan
            $sql = "insert into wisata (kode_wisata,judul_wisata,isi_wisata,harga_tiket,jam_buka,jam_tutup,status,id_kategori) values
                    ('$kode_wisata','$judul_wisata','$isi_wisata','$harga_tiket','$jam_buka','$jam_tutup','$status','$kategori')";

        }

        //Mengeksekusi/menjalankan query 
        $simpan_wisata = mysqli_query($kon, $sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($simpan_wisata) {
            header("Location:../index.php?halaman=wisata&kategori=$kategori&add=berhasil");
        } else {
            header("Location:../index.php?halaman=wisata&kategori=$kategori&add=gagal");

        }

    }
}

// mengambil data produk dengan kode paling besar
include '../../config/database.php';
$query = mysqli_query($kon, "SELECT max(id_wisata) as kodeTerbesar FROM wisata");
$data = mysqli_fetch_array($query);
$id_wisata = $data['kodeTerbesar'];
$id_wisata++;
$huruf = "A";
$kodewisata = $huruf . sprintf("%04s", $id_wisata);

?>
<form action="wisata/tambah-wisata.php" method="post" enctype="multipart/form-data">
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kode:</label>
                <h3>
                    <?php echo $kodewisata; ?>
                </h3>
                <input name="kode_wisata" value="<?php echo $kodewisata; ?>" type="hidden" class="form-control">
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Judul Wisata:</label>
                <input name="judul_wisata" type="text" class="form-control" placeholder="Masukan nama wisata" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Isi Wisata:</label>
                <textarea name="isi_wisata" class="form-control" rows="5"></textarea>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Harga Tiket:</label>
                <input name="harga_tiket" type="number" class="form-control" placeholder="Masukan harga tiket" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Jam Buka:</label>
                <input name="jam_buka" type="text" class="form-control" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Jam Tutup:</label>
                <input name="jam_tutup" type="text" class="form-control" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div id="msg"></div>
                <label>Gambar:</label>
                <input type="file" name="gambar" class="file">
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                    <div class="input-group-append">
                        <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                    </div>
                </div>
                <img src="gambar_default.png" id="preview" class="img-thumbnail">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" class="form-control">
                    <?php
                    echo $id_kategori = $_POST['kategori'];
                    include '../../config/database.php';
                    $sql = "select * from kategori where id_kategori='$id_kategori' limit 1";
                    $hasil = mysqli_query($kon, $sql);
                    while ($data = mysqli_fetch_array($hasil)):
                        ?>
                        <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" name="publish" class="btn btn-success">Publish</button>
                <button type="submit" name="simpan_konsep" class="btn btn-warning">Simpan Draft</button>
            </div>

        </div>

    </div>
</form>
<style>
    .file {
        visibility: hidden;
        position: absolute;
    }
</style>
<script>
    $(document).on("click", "#pilih_gambar", function () {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>