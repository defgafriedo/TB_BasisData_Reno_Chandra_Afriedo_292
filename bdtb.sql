-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 06:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdtb`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kerusakan`
--

CREATE TABLE `jenis_kerusakan` (
  `id_kerusakan` int(11) NOT NULL,
  `nama_kerusakan` varchar(30) NOT NULL,
  `penanganan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kerusakan`
--

INSERT INTO `jenis_kerusakan` (`id_kerusakan`, `nama_kerusakan`, `penanganan`) VALUES
(8, 'Retak lelah dan deformasi', 'penambalan'),
(9, 'Retak', 'perbaikan sistem drainase dan penambalan'),
(10, 'Distorsi', 'penambahan lapisan permukaan baru'),
(11, 'Kegemukan', 'menghamparkan atau menaburkan agregat panas yan kemudian dipadatkan'),
(12, 'Lubang-lubang', 'pembersihan lapisan aspal dan menganti lapisan baru'),
(13, 'Pengausan', 'menutup area permukaan jalan aspal yang rusak dengan buras, latasir atau latasbun'),
(14, 'Stripping', 'pembersihan lapisan dan dilapisi dengan buras');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_transaksi`
--

CREATE TABLE `laporan_transaksi` (
  `id_laporan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_kerusakan` int(11) NOT NULL,
  `tanggal_laporan` date NOT NULL,
  `bukti_laporan` varchar(200) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_transaksi`
--

INSERT INTO `laporan_transaksi` (`id_laporan`, `id_user`, `id_lokasi`, `id_kerusakan`, `tanggal_laporan`, `bukti_laporan`, `id_petugas`) VALUES
(1, 3, 17, 8, '2022-07-08', 'https://news.detik.com/berita-jawa-timur/d-5477624/dear-bupati-jalan-rusak-dan-berlubang-masih-banyak-bertebaran-di-sidoarjo', 6),
(3, 3, 23, 8, '2022-07-08', 'https://jualbatusplit.files.wordpress.com/2016/03/retak-struktural-fatigue-cracking.jpg?w=584', NULL),
(4, 3, 23, 8, '2022-07-07', 'https://jualbatusplit.files.wordpress.com/2016/03/retak-struktural-fatigue-cracking.jpg?w=584', 6);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `nama_kecamatan` varchar(30) NOT NULL,
  `nama_kelurahan` varchar(30) NOT NULL,
  `alamat_detail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id_lokasi`, `nama_kecamatan`, `nama_kelurahan`, `alamat_detail`) VALUES
(17, 'Klojen', 'Klojen', 'Jl. Pattimura 51 Malang'),
(18, 'Klojen', 'Rampal Celaket', 'Jl. Kasembon 8B Malang'),
(19, 'Klojen', 'Samaan', 'Jl. Kaliurang Barat 121 Malang'),
(20, 'Klojen', 'Kidul Dalem', 'Jl. MGR S Pranoto 32 Malang'),
(21, 'Klojen', 'Sukoharjo', 'Jl. Arismunandar, Malang'),
(22, 'Blimbing', 'Blimbing', 'Jl. LA Sucipto 15 Malang'),
(23, 'Blimbing', 'Balearjosari', 'Jl. Balearjosari 9 Malang'),
(24, 'Blimbing', 'Arjosari', 'Jl. Teluk Pelabuhan Ratu 378 Malang'),
(25, 'Blimbing', 'Purwodadi', 'Jl. A Yani Utara 148 Malang'),
(26, 'Blimbing', 'Polowijen', 'Jl. A Yani Utara 2A Malang'),
(27, 'Lowokwaru', 'Tasikmadu', 'Jl. Raya Tasikmadu, Malang'),
(28, 'Lowokwaru', 'Tunggulwulung', 'Jl. Raya Bawang 1 Malang'),
(29, 'Lowokwaru', 'Merjosari', 'Jl. Mertojoyo 1 Malang'),
(30, 'Lowokwaru', 'Tlogomas', 'Jl. Raya Tlogomas 56 Malang'),
(31, 'Lowokwaru', 'Dinoyo', 'Jl. MT Haryono XIII Malang'),
(32, 'Sukun', 'Ciptomulyo', 'Jl. Kol. Sugiono VIII/1 Malang'),
(33, 'Sukun', 'Gadang', 'Jl. Kol. Sugiono 190 Malang'),
(34, 'Sukun', 'Bandungrejosari', 'Jl. S Supriyadi 30 Malang'),
(35, 'Sukun', 'Sukun', 'Jl. Rajawali F-5 Malang'),
(36, 'Sukun', 'Tanjungrejo', 'Jl. Mergan Terusan 1 Malang'),
(37, 'KedungKandang', 'Kotalama', 'Jl. Kebalen Wetan 5 Malang'),
(38, 'KedungKandang', 'Mergosono', 'Jl. Kol. Sugiono V Malang'),
(39, 'KedungKandang', 'Bumiayu', 'Jl. Kyai Parseh Jaya 35 Malang'),
(40, 'KedungKandang', 'Wonokoyo', 'Jl. Kali Anyar 1 Malang'),
(41, 'KedungKandang', 'Buring', 'Jl. Puncak Buring Indah 1 Malang');

-- --------------------------------------------------------

--
-- Table structure for table `penanganan_laporan`
--

CREATE TABLE `penanganan_laporan` (
  `id_penanganan` int(11) NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `tanggal_pengerjaan` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `bukti_selesai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penanganan_laporan`
--

INSERT INTO `penanganan_laporan` (`id_penanganan`, `id_teknisi`, `tanggal_pengerjaan`, `tanggal_selesai`, `bukti_selesai`) VALUES
(1, 9, '2022-07-07', '2022-07-23', 'https://www.iglobalnews.co.id/wp-content/uploads/2017/10/IMG20170919095015.jpg'),
(4, 8, '2022-07-08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `no_telp`, `alamat`) VALUES
(6, 'Reno Chandra Afriedo', 'defgafriedo', 'admin', '082113123132', 'jl simpang indah 413'),
(7, 'Aisha Aileen Nathania', 'aisha', 'admin', '08921331231', 'jl mangis merah no 1'),
(8, 'Astrid Rahdian Amanda', 'astrid', 'admin', '082132132138', 'jl mangis merah no 2'),
(9, 'Aubrey Fathia Pelangi', 'fathia', 'admin', '08229112213123', 'jl mangis merah no 3'),
(10, 'Alana Liora Gantari', 'alana', 'admin', '089284812323', 'jl mangis merah no 4'),
(11, 'Afra Rainey Keysa', 'afra', 'admin', '0821132321432', 'jl mangis merah no 5'),
(12, 'Bernadette Patricia Mabella', 'patricia', 'admin', '0822931931931', 'jl mangis merah no 6'),
(13, 'Bilha Priyanka Inara', 'inara', 'admin', '087313912123', 'jl mangis merah no 7'),
(14, 'Bonita Tanya Suhaila', 'tanya', 'admin', '0891389001', 'jl mangis merah no 8'),
(15, 'Brigita Aubrey Teodora', 'teodora', 'admin', '08129419319', 'jl mangis merah no 9'),
(16, 'Christina Prerana Naura', 'christina', 'admin', '08912949301', 'jl mangis merah no 10');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id_teknisi` int(11) NOT NULL,
  `nama_teknisi` varchar(50) NOT NULL,
  `kontrak_berakhir` date NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `alamat_teknisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id_teknisi`, `nama_teknisi`, `kontrak_berakhir`, `no_telp`, `alamat_teknisi`) VALUES
(8, 'lamajaconst', '2023-07-05', '081231234989', 'jl sulfat 3'),
(9, 'rikalaconst', '2023-07-05', '082113123132', 'jl sulfat 19'),
(10, 'lumbaconst', '2022-07-07', '08229193393', 'jl sulfat 123');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_telp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `alamat`, `no_telp`) VALUES
(1, 'Dono Sujiwo', 'sujiwo', 'user', 'jl batu blok 4', '08229193393'),
(2, 'Dina Kowalski', 'dina123', 'user', 'jl simpang indah 3', '082291354434'),
(3, 'Reno Chandra Afriedo', 'renoedo', 'user', 'jl simpang sulfat', '0821129123112'),
(4, 'Alisa Rika', 'alisa', 'user', 'jl simpang indah 2', '081231234989'),
(5, 'Bunga Citra Firlana', 'bunga', 'user', 'jl lokasi luar no 4', '08879768932'),
(7, 'defgafriedo', 'defgafriedo', 'user', 'jl gunung semeru', '08218219212');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_kerusakan`
--
ALTER TABLE `jenis_kerusakan`
  ADD PRIMARY KEY (`id_kerusakan`);

--
-- Indexes for table `laporan_transaksi`
--
ALTER TABLE `laporan_transaksi`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_kerusakan` (`id_kerusakan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `penanganan_laporan`
--
ALTER TABLE `penanganan_laporan`
  ADD PRIMARY KEY (`id_penanganan`),
  ADD KEY `id_teknisi` (`id_teknisi`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id_teknisi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_kerusakan`
--
ALTER TABLE `jenis_kerusakan`
  MODIFY `id_kerusakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `laporan_transaksi`
--
ALTER TABLE `laporan_transaksi`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `penanganan_laporan`
--
ALTER TABLE `penanganan_laporan`
  MODIFY `id_penanganan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id_teknisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporan_transaksi`
--
ALTER TABLE `laporan_transaksi`
  ADD CONSTRAINT `laporan_transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `laporan_transaksi_ibfk_2` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`),
  ADD CONSTRAINT `laporan_transaksi_ibfk_3` FOREIGN KEY (`id_kerusakan`) REFERENCES `jenis_kerusakan` (`id_kerusakan`),
  ADD CONSTRAINT `laporan_transaksi_ibfk_4` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);

--
-- Constraints for table `penanganan_laporan`
--
ALTER TABLE `penanganan_laporan`
  ADD CONSTRAINT `penanganan_laporan_ibfk_1` FOREIGN KEY (`id_teknisi`) REFERENCES `teknisi` (`id_teknisi`),
  ADD CONSTRAINT `penanganan_laporan_ibfk_2` FOREIGN KEY (`id_penanganan`) REFERENCES `laporan_transaksi` (`id_laporan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
