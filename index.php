<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wisata Malang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include 'config/database.php';
        $ambil_kategori = mysqli_query ($kon,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website;?></a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <?php
         
            include 'config/database.php';
            $sql="select * from kategori";
            $hasil=mysqli_query($kon,$sql);
            while ($data = mysqli_fetch_array($hasil)):
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a>
            </li>
            <?php endwhile; ?>
        </ul>
        <ul class="navbar-nav">
        <li><a class='nav-link' href='index.php?halaman=about'><span class='fas fa-log-in'></span> About Us</a></li>
        </ul>
        <ul class="navbar-nav  ml-auto">
            <?php 
                session_start();
                if (isset($_SESSION["id_pengguna"])) {
                        echo " <li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                }else {
                    echo " <li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                }
            ?>
        </ul>
    </div>
   
</nav>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="admin/wisata/gambar/header.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="admin/wisata/gambar/header2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="admin/wisata/gambar/header3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="jumbotron jumbotron-fluid">
<?php
    $judul="Selamat Datang";   
    include 'config/database.php';
    if (isset($_GET['id'])) {
        $sql="select * from wisata where status=1 and id_wisata=".$_GET['id']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_wisata'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }
?>
    <div class="container">
    <h1 class="display-5 text-center" ><?php echo $judul;?></h1>
    <p class="lead text-justify">Malang, salah satu kota terindah di Jawa Timur, menawarkan berbagai destinasi wisata yang memadukan keindahan alam, sejarah, dan budaya yang kaya. Dari wisata alam pegunungan yang sejuk, air terjun yang menawan, hingga taman hiburan dan objek wisata keluarga yang menyenangkan, Malang adalah tempat yang sempurna untuk berlibur bersama keluarga, teman, atau pasangan.</p>
    <hr class="my-4">
  <p class="text-justify">Temukan berbagai destinasi populer seperti Gunung Bromo, Pantai Balekambang, Coban Rondo, dan Jatim Park, yang menawarkan pengalaman tak terlupakan. Nikmati juga wisata kuliner khas Malang seperti Bakso Malang dan Tahu Tempe Pecel, yang pasti memanjakan lidah Anda.</p>
    </div>
</div>

<div class="container">
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'wisata':
                include "wisata.php";
                break;
            case 'about':
                include "about.php";
                break;
            case 'login':
                include "login.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
</div>

<div class="text-center">
<br>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ocwn5DyvLRI?autoplay=1&mute=1"
                title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright <?php echo $nama_website;?> 2023</p>
</div>
</body>
</html>