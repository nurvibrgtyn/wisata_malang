
<div class="card mb-4">
    <div class="card-header">
        <button type="button" id="btn-tambah-wisata" class="btn btn-primary"><span class="text"><i class="fas fa-car fa-sm"></i> Tambah wisata</span></button>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Harga Tiket</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // include database
                include '../config/database.php';
                // perintah sql untuk menampilkan daftar wisata
                $id_kategori=$_GET['kategori'];
                $sql="select * from wisata inner join kategori on kategori.id_kategori=wisata.id_kategori where kategori.id_kategori='$id_kategori' order by id_wisata desc";
                $hasil=mysqli_query($kon,$sql);
                $no=0;
                //Menampilkan data dengan perulangan while
                while ($data = mysqli_fetch_array($hasil)):
                $no++;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><img  src="wisata/gambar/<?php echo $data['gambar'];?>" alt="Card image cap" width="80px"></td>
                <td><?php echo $data['judul_wisata']; ?></td>
                <td><?php echo  $data['nama_kategori'];  ?></td>
                <td><?php echo  $data['harga_tiket'];  ?></td>
                <td><?php echo  $data['jam_buka'];  ?></td>
                <td><?php echo  $data['jam_tutup'];  ?></td>
                <td><?php echo $data['status'] == 1 ? "<span class='text-success'>Publish</span>" : "<span class='text-warning'>Konsep</span>"; ?> </td>
                <td>   
                    <button class="btn-edit-wisata btn btn-warning btn-circle" id_wisata="<?php echo $data['id_wisata']; ?>" kode_wisata="<?php echo $data['kode_wisata']; ?>" data-toggle="tooltip" title="Edit wisata" data-placement="top">Edit</button> 
                    <button class="btn-hapus-wisata btn btn-danger btn-circle"  id_wisata="<?php echo $data['id_wisata']; ?>"  gambar="<?php echo $data['gambar']; ?>"  data-toggle="tooltip" title="Hapus wisata" data-placement="top">Hapus</button>
                </td>
            </tr>
            <!-- bagian akhir (penutup) while -->
            <?php endwhile; ?>
            </tbody>
        </table>
     
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

<input type="hidden" name="kategori" id="kategori" value="<?php echo $_GET['kategori'];?>" />

<script>

    $('#btn-tambah-wisata').on('click',function(){
        var kategori = $('#kategori').val();
        $.ajax({
            url: 'wisata/tambah-wisata.php',
            data: {kategori:kategori},
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Wisata';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });

        // fungsi edit wisata
    $('.btn-edit-wisata').on('click',function(){
    
        var id_wisata = $(this).attr("id_wisata");
        var kode_wisata = $(this).attr("kode_wisata");
     
        $.ajax({
            url: 'wisata/edit-wisata.php',
            method: 'post',
            data: {id_wisata:id_wisata,kode_wisata:kode_wisata},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Wisata #'+kode_wisata;
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });


    // fungsi hapus wisata
    $('.btn-hapus-wisata').on('click',function(){

        var id_wisata = $(this).attr("id_wisata");
        var gambar = $(this).attr("gambar");
        var kategori = $('#kategori').val();
        konfirmasi=confirm("Yakin ingin menghapus?")
        
        if (konfirmasi){
            $.ajax({
                url: 'wisata/hapus-wisata.php',
                method: 'post',
                data: {id_wisata:id_wisata,gambar:gambar},
                success:function(data){
                    window.location.href = 'index.php?halaman=wisata&kategori='+kategori+'&hapus=berhasil';
                }
            });
        }

     
    });

</script>