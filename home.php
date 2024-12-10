<div class="row">
    <?php

    include 'config/database.php';
    if (isset($_GET['kategori'])) {
        $sql = "select * from wisata where status=1 and id_kategori=" . $_GET['kategori'] . " order by id_wisata desc";
    } else {
        $sql = "select * from wisata where status=1 order by id_wisata desc";
    }


    $hasil = mysqli_query($kon, $sql);
    $jumlah = mysqli_num_rows($hasil);
    if ($jumlah > 0) {
        while ($data = mysqli_fetch_array($hasil)):
            ?>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <a href="index.php?halaman=wisata&id=<?php echo $data['id_wisata']; ?>"><img
                            src="admin/wisata/gambar/<?php echo $data['gambar']; ?>" width="100%" alt="Cinque Terre"></a>
                    <div class="caption">
                        <h3 class="text-center">
                            <?php echo $data['judul_wisata']; ?>
                        </h3>
                        <p class="text-justify">
                            <?php
                            $ambil = $data["isi_wisata"];
                            $panjang = strip_tags(html_entity_decode($ambil, ENT_QUOTES, "ISO-8859-1"));
                            echo substr($panjang, 0, 200); ?>
                        </p>
                        <p><a href="index.php?halaman=wisata&id=<?php echo $data['id_wisata']; ?>"
                                class="btn btn-secondary btn-block" role="button">Selengkapnya</a></p>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
    } else {
        echo "<div class='alert alert-warning'> Tidak ada wisata pada kategori ini.</div>";
    }
    ;
    ?>
</div>