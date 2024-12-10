<?php
session_start();
if (isset($_POST['update_wisata'])) {
    //Include file koneksi, untuk koneksikan ke database


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


        $id_wisata = input($_POST["id_wisata"]);
        $judul_wisata = input($_POST["judul_wisata"]);
        $kategori = input($_POST["kategori"]);
        $status = input($_POST["status"]);
        $isi_wisata = input($_POST["isi_wisata"]);
        $harga_tiket = input($_POST["harga_tiket"]);
        $jam_buka = input($_POST["jam_buka"]);
        $jam_tutup = input($_POST["jam_tutup"]);
        $gambar_saat_ini = $_POST['gambar_saat_ini'];
        $gambar_baru = $_FILES['gambar_baru']['name'];
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $x = explode('.', $gambar_baru);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['gambar_baru']['size'];
        $file_tmp = $_FILES['gambar_baru']['tmp_name'];

        include '../../config/database.php';

        if (!empty($gambar_baru)) {
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                //Mengupload gambar baru
                move_uploaded_file($file_tmp, 'gambar/' . $gambar_baru);

                //Menghapus gambar lama, gambar yang dihapus selain gambar default
                if ($gambar_saat_ini != 'gambar_default.png') {
                    unlink("gambar/" . $gambar_saat_ini);
                }

                $sql = "update wisata set
                    judul_wisata='$judul_wisata',
                    isi_wisata='$isi_wisata',
                    harga_tiket='$harga_tiket',
                    jam_buka='$jam_buka',
                    jam_tutup='$jam_tutup',
                    gambar='$gambar_baru',
                    id_kategori='$kategori',
                    status='$status'
                    where id_wisata=$id_wisata";
            }
        } else {
            $sql = "update wisata set
                    judul_wisata='$judul_wisata',
                    isi_wisata='$isi_wisata',
                    harga_tiket='$harga_tiket',
                    jam_buka='$jam_buka',
                    jam_tutup='$jam_tutup',
                    id_kategori='$kategori',
                    status='$status'
                    where id_wisata=$id_wisata";
        }

        //Mengeksekusi/menjalankan query 
        $edit_wisata = mysqli_query($kon, $sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($edit_wisata) {
            header("Location:../index.php?halaman=wisata&kategori=$kategori&edit=berhasil");
        } else {
            header("Location:../index.php?halaman=wisata&kategori=$kategori&edit=gagal");

        }



    }

}
$id_wisata = $_POST["id_wisata"];
// mengambil data barang dengan kode paling besar
include '../../config/database.php';
$query = mysqli_query($kon, "SELECT * FROM wisata where id_wisata=$id_wisata");
$data = mysqli_fetch_array($query);

?>
<form action="wisata/edit-wisata.php" method="post" enctype="multipart/form-data">
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kode:</label>
                <h3>
                    <?php echo $data['kode_wisata']; ?>
                </h3>
                <input name="kode_wisata" value="<?php echo $data['kode_wisata']; ?>" type="hidden"
                    class="form-control">
                <input name="id_wisata" value="<?php echo $data['id_wisata']; ?>" type="hidden" class="form-control">
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Judul Wisata:</label>
                <input name="judul_wisata" type="text" value="<?php echo $data['judul_wisata']; ?>"
                    class="form-control" placeholder="Masukan nama wisata" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Isi Wisata:</label>
                <textarea name="isi_wisata" class="form-control" rows="5"><?php echo $data['isi_wisata']; ?></textarea>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Harga Tiket Wisata:</label>
                <input name="harga_tiket" type="number" value="<?php echo $data['harga_tiket']; ?>"
                    class="form-control" placeholder="Masukan harga tiket" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Jam Buka:</label>
                <input name="jam_buka" type="text" value="<?php echo $data['jam_buka']; ?>" class="form-control"
                    placeholder="Masukan jam buka" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Jam Tutup:</label>
                <input name="jam_tutup" type="text" value="<?php echo $data['jam_tutup']; ?>" class="form-control"
                    placeholder="Masukan jam tutup" required>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <label>Gambar Saat ini:</label>
            <img src="wisata/gambar/<?php echo $data['gambar']; ?>" class="rounded" width="90%" alt="Cinque Terre">
            <input type="text" name="gambar_saat_ini" value="<?php echo $data['gambar']; ?>" class="form-control" />
        </div>
        <div class="col-sm-6">
            <div id="msg"></div>
            <label>Gambar Baru:</label>
            <input type="file" name="gambar_baru" class="file">
            <div class="input-group my-3">
                <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                <div class="input-group-append">
                    <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                </div>
            </div>
            <img src="https://placehold.it/80x80" id="preview" class="img-thumbnail">
        </div>
    </div>

    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Kategori:</label>
                <select name="kategori" class="form-control">
                    <!-- Menampilkan daftar kategori produk di dalam select list -->
                    <?php

                    $sql = "select * from kategori order by id_kategori asc";
                    $hasil = mysqli_query($kon, $sql);
                    $no = 0;
                    if ($data['id_kategori'] == 0)
                        echo "<option value='0'>-</option>";
                    while ($kt = mysqli_fetch_array($hasil)):
                        $no++;
                        ?>
                        <option <?php if ($data['id_kategori'] == $kt['id_kategori'])
                            echo "selected"; ?>
                            value="<?php echo $kt['id_kategori']; ?>"><?php echo $kt['nama_kategori']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Status:</label>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" <?php if ($data['status'] == 1)
                            echo "checked"; ?> class="form-check-input"
                            name="status" value="1">Publish
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" <?php if ($data['status'] == 0)
                            echo "checked"; ?> class="form-check-input"
                            name="status" value="0">Konsep
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- rows -->
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" name="update_wisata" class="btn btn-success">Update wisata</button>
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