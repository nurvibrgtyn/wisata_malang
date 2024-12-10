-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Okt 2020 pada 14.44
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_malang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(11) NOT NULL,
  `kode_wisata` char(10) NOT NULL,
  `judul_wisata` varchar(100) NOT NULL,
  `isi_wisata` text NOT NULL,
  `gambar` varchar(100) NOT NULL DEFAULT 'gambar_default.png',
  `harga_tiket` int(10) NOT NULL,
  `jam_buka` char(10) NOT NULL,
  `jam_tutup` char(10) NOT NULL,
  `status` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `kode_wisata`, `judul_wisata`, `isi_wisata`, `gambar`, `harga_tiket`, `jam_buka`, `jam_tutup`, `status`, `id_kategori`, `id_pengguna`) VALUES
(98, 'A0094', 'Jatim Park 1', '&lt;p&gt;Jawa Timur Park 1 atau yang biasa disebut Jatim Park 1 merupakan 
                salah satu tempat rekreasi dan taman belajar yang terdapat di 
                Kota Batu, Jawa Timur Indonesia. Obyek wisata ini berada sekitar 
                20 km dari arah barat Kota Malang, dan kini menjadi salah satu 
                icon wisata terkenal di daerah Kota Malang bahkan Se-Jawa Timur.&lt;/p&gt;', 'JP1_1.png', 100000, '08.30', '16.30', 1, 01, 0),
(100, 'A0100', 'Jatim Park 2', '&lt;p&gt;Jatim Park adalah sebuah tempat rekreasi 
                dan taman belajar yang terdapat di Kota Batu, Jawa Timur. Objek 
                wisata ini berada sekitar 20 km barat Kota Malang, dan kini 
                menjadi salah satu icon wisata Jawa Timur. Objek wisata ini memiliki 
                36 wahana, di antaranya kolam renang raksasa (dengan latar belakang 
                patung Ken Dedes, Ken Arok, dan Mpu Gandring), spinning coaster, dan drop zone.&lt;/p&gt;', 'JP2_1.jpg', 150000, '09.30', '17.30', 1, 01, 0),
(101, 'A0101', 'Jatim Park 3', '&lt;p&gt;Jatim Park 3 berada di desa Beji, Kecamatan 
                Junrejo, Kota Batu. Jatim Park 3 mengusung konsep taman bermain sekaligus 
                edukasi mengenai hewan-hewan purbakala termasuk Dinosaurus di area Dinopark 
                dan area spot foto patung lilin yang lengkap dengan nuansa berbagai negara serta terdapat taman lampu yang luas diarea The Legend Stars.&lt;/p&gt;', 'JP3_1.jpeg', 160000, '11.00', '20.00', 1, 01, 0),
(102, 'A0102', 'Pantai Balekambang', '&lt;p&gt;Pantai Balekambang adalah sebuah pantai 
                di pesisir selatan yang terletak di tepi Samudra Indonesia secara 
                administratif masuk wilayah Dusun Sumber Jambe, Desa Srigonco, Kecamatan 
                Bantur, Kabupaten Malang, Jawa Timur dan merupakan salah satu wisata di 
                Kabupaten Malang sejak 1985 hingga kini. Daya tarik Balekambang utamanya 
                tentu panorama alam, gelombang ombak yang memanjang hampir dua kilometer, 
                serta hamparan pasir nan luas. Area pasir putih terlihat bersih dari sampah 
                maupun kotoran sehingga cukup nyaman bagi pengunjung untuk bermain dan 
                berolahraga. Bahkan tak jarang di pantai ini menjadi tempat latihan sejumlah 
                klub sepak bola seperti Arema dan Persema. Pantai ini pula diresmikan sebagai tempat perkemahan pramuka Kabupaten Malang.&lt;/p&gt;', 'PB1.JPG', 20000, '00.00', '24.00', 1, 03, 0),
(103, 'A0103', 'Paralayang Gunung Banyak', '&lt;p&gt;Paralayang Gunung Banyak, Batu Malang, 
                meluncur dari ketinggian 1300 mdpl dari puncak Gunung Banyak yang lokasinya 
                berada di dusun Brau, desa Arjosari, Kota Batu, Jawa Timur. Mencoba aktivitas 
                Paralayang Batu Malang bisa membuat anda mengucurkan keringat dingin, 
                bersemangat, berteriak sekaligus berdecak kagum. Dan yang penting perlu Anda 
                tahu bahwa Paralayang di Kota Batu ini termasuk kelas terbaik di Indonesia, 
                disamping menuju lokasinya mudah juga didukung dengan pemandangan alamnya yang indah dengan latar belakang beberapa gunung disekitarnya.&lt;/p&gt;', 'PRL1.JPG', 10000, '07.00', '17.00', 1, 04, 0),
(104, 'A0104', 'Malang Night Paradise', '&lt;p&gt;Malang Night Paradise atau MNP merupakan 
                tempat hiburan malam hari dengan konsep taman lampion penuh warna bak di negeri 
                dongeng. Tak cuma menyuguhkan cantiknya cahaya lampion, MNP juga menawarkan 
                berbagai macam wahana hiburan yang akan melengkapi liburanmu. Salah satu wahana andalan yang menjadi favorit wisatawan adalah wahana Magic Journey.&lt;/p&gt;', 'MNP1.JPG', 60000, '17.45', '23.00', 1, 01, 0),
(105, 'A0105', 'Museum Angkut', '&lt;p&gt;Museum Angkut merupakan museum transportasi dan 
                tempat wisata modern yang terletak di Kota Batu, Jawa Timur, sekitar 20 km 
                dari Kota Malang. Museum ini terletak di kawasan seluas 3,8 hektar di lereng 
                Gunung Panderman dan memiliki lebih dari 300 koleksi jenis angkutan tradisional 
                hingga modern. Museum ini terbagi dalam beberapa zona yang didekorasi dengan 
                setting landscape model bangunan dari benua Asia, Eropa hingga Amerika. Di 
                Zona Sunda Kelapa dan Batavia yang merupakan Replika Pelabuhan Sunda Kelapa, dihiasi oleh beberapa alat transportasi kuno seperti becak dan miniatur kapal.&lt;/p&gt;', 'MA1.JPG', 110000, '12.00', '20.00', 1, 02, 0),
(106, 'A0106', 'Kampung Jodipan', '&lt;p&gt;Kampung Wisata Jodipan adalah kampung wisata 
                pertama di Kota Malang berupa sederetan rumah warga di tepi Sungai Brantas 
                yang menampilkan dinding dengan aneka warna yang menarik dan tidak monoton. 
                Kampung ini terletak di Jodipan berada di tepi Sungai Brantas. Kampung Wisata 
                Jodipan ini biasanya dijuluki Kampung Warna Warni. Kampung Warna Warni terdapat 
                di dua wilayah, yaitu Kampung Jodipan dan Kampung Tridi. Antara keduanya 
                dihubungkan dengan jembatan kaca "Ngalam" Indonesia (Ngalam dibaca Malang).&lt;/p&gt;', 'KJ2.jpg', 5000, '07.00', '17.00', 1, 01, 0),
(107, 'A0107', 'Air Terjun Coban Rondo', '&lt;p&gt;Air Terjun Coban Rondo merupakan air terjun 
                yang terletak di Kecamatan Pujon, Kabupaten Malang, Jawa Timur. Air terjun ini 
                mudah dijangkau oleh kendaraan umum. Akses yang paling mudah dengan melalui 
                jalan raya dari Malang ke Batu, dari sebelah timur atau dari Kediri ke Pare 
                menuju Malang dari arah barat. Coban Rondo terletak pada ketinggian 1135 m di atas permukaan laut.&lt;/p&gt;', 'cr1.jpg', 35000, '07.30', '17.00', 1, 07, 0),
(108, 'A0108', 'Kebun Teh Wonosari', '&lt;p&gt;Kebun teh Wonosari menawarkan pemandangan hijau 
                yang memanjakan mata bagi para pengunjung yang datang. Kebun ini berdiri di atas 
                lahan seluas 1.14 hektar, dan menjadi satu-satunya kebun the di Jawa Timur yang 
                diolah sebagai obyek wisata. Kebun Teh Wonosari terletak di dataran tinggi lereng Gunung Arjuna Malang.&lt;/p&gt;', 'KT1.jpeg', 15000, '06.00', '17.00', 1, 07, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `gambar_kategori` varchar(200) NOT NULL DEFAULT 'gambar_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `gambar_kategori`) VALUES
(01, 'Rekreasi', 'themepark.png'),
(02, 'Edukasi', 'education.png'),
(03, 'Bahari', 'beach.png'),
(04, 'Olahraga', 'sport.png'),
(05, 'Budaya', 'culture.png'),
(06, 'Makanan', 'food.png'),
(07, 'Alam', 'nature.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_wisata` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isi_review` text NOT NULL,
  `status_review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `review`
--

INSERT INTO `review` (`id_review`, `id_wisata`, `nama`, `email`, `isi_review`, `status_review`) VALUES
(7, 101, 'Brian', 'brianim4g3s@gmail.com', 'Satu kawasan wahana wisata dengan beberapa tema yang bisa dikunjungi satu per satu. Di sini terdapat Milenial Glow Garden, The Legend Star, Infinity World, Dino Park, FunTech Plaza, dan Museum Musik Dunia. Selain itu, terdapat juga hotel Senyum World. Tinggal pilih sesuai selera. Pastikan memory kamera kosong, karena akan sangat banyak spot menarik untuk diabadikan bareng teman ataupun keluarga.', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `kode_pengguna` char(9) NOT NULL,
  `nama_pengguna` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `no_telp` char(14) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `kode_pengguna`, `nama_pengguna`, `email`, `no_telp`, `username`, `password`, `status`) VALUES
(19, 'U010', 'Admin', 'admin@gmail.com', '0812345678', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(20, 'U020', 'Nurvi B', 'brigityana.nurvi@gmail.com', '0812345678', 'nurvi', '827ccb0eea8a706c4c34a16891f84e7b', 1);
-- password: 12345
-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE `profil` (
  `nama_website` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`nama_website`) VALUES
('DESTINASI WISATA KOTA MALANG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`),
  ADD UNIQUE KEY `judul_wisata` (`judul_wisata`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
