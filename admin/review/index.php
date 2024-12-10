<div class="card mb-4">
    <div class="card-header">
        <h4>Daftar Review</h4>
    </div>
    <div class="card-body">
        <?php
        if (isset($_GET['tambah'])) {
            //Mengecek nilai variabel tambah 
            if ($_GET['tambah'] == 'berhasil') {
                echo "<div class='alert alert-success'><strong>Berhasil!</strong> review telah di tambahkan!</div>";
            } else if ($_GET['tambah'] == 'gagal') {
                echo "<div class='alert alert-danger'><strong>Gagal!</strong> review gagal di tambahkan!</div>";
            }
        }
        if (isset($_GET['edit'])) {
            //Mengecek nilai variabel edit 
            if ($_GET['edit'] == 'berhasil') {
                echo "<div class='alert alert-success'><strong>Berhasil!</strong> review telah di edit!</div>";
            } else if ($_GET['edit'] == 'gagal') {
                echo "<div class='alert alert-danger'><strong>Gagal!</strong> review gagal di edit!</div>";
            }
        }
        if (isset($_GET['hapus'])) {
            //Mengecek nilai variabel hapus 
            if ($_GET['hapus'] == 'berhasil') {
                echo "<div class='alert alert-success'><strong>Berhasil!</strong> review telah di hapus!</div>";
            } else if ($_GET['hapus'] == 'gagal') {
                echo "<div class='alert alert-danger'><strong>Gagal!</strong> review gagal di hapus!</div>";
            }
        }
        ?>
        <!-- Tabel daftar review -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Wisata</th>
                        <th>Isi Review</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // include database
                    include '../config/database.php';
                    // perintah sql untuk menampilkan daftar review
                    $sql = "select * from review k inner join wisata a on a.id_wisata=k.id_wisata order by id_review desc";
                    $hasil = mysqli_query($kon, $sql);
                    $no = 0;
                    //Menampilkan data dengan perulangan while
                    while ($data = mysqli_fetch_array($hasil)):
                        $no++;
                        ?>
                        <tr>
                            <td>
                                <?php echo $no; ?>
                            </td>
                            <td>
                                <?php echo $data['nama']; ?>
                            </td>
                            <td>
                                <?php echo $data['email']; ?>
                            </td>
                            <td>
                                <?php echo $data['judul_wisata']; ?>
                            </td>
                            <td class="text-justify">
                                <?php echo $data['isi_review']; ?>
                            </td>
                            <td>
                                <?php echo $data['status_review'] == 1 ? "<span class='text-success'>Publish</span>" : "<span class='text-danger'>Tidak Dipublish</span>"; ?>
                            </td>
                            <td>
                                <button class="btn-edit btn btn-warning btn-circle"
                                    id_review="<?php echo $data['id_review']; ?>">Edit</button>
                                <button class="btn-hapus btn btn-danger btn-circle"
                                    id_review="<?php echo $data['id_review']; ?>">Hapus</button>
                            </td>
                        </tr>
                        <!-- bagian akhir (penutup) while -->
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Bagian header -->
            <div class="modal-header">
                <h4 class="modal-title" id="judul"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Bagian body -->
            <div class="modal-body">
                <div id="tampil_data">

                </div>
            </div>
            <!-- Bagian footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<script>

    // fungsi edit review
    $('.btn-edit').on('click', function () {

        var id_review = $(this).attr("id_review");

        $.ajax({
            url: 'review/edit.php',
            method: 'post',
            data: { id_review: id_review },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Edit Review #' + id_review;
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi hapus review
    $('.btn-hapus').on('click', function () {

        var id_review = $(this).attr("id_review");

        konfirmasi = confirm("Yakin ingin menghapus?")

        if (konfirmasi) {
            $.ajax({
                url: 'review/hapus.php',
                method: 'post',
                data: { id_review: id_review },
                success: function (data) {
                    window.location.href = 'index.php?halaman=review&hapus=berhasil';
                }
            });
        }
    });

</script>