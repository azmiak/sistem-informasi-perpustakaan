-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2024 at 12:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id` int(11) NOT NULL,
  `kode_admin` varchar(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id`, `kode_admin`, `nama_admin`, `password`, `no_hp`) VALUES
(1, 'ZMI', 'Azmi', 'azmi123', 811111111),
(2, 'ZKA', 'Azka', 'azka123', 822222222),
(3, 'ARD', 'Ardi', 'ardi123', 833333333),
(4, 'BAL', 'Iqbal', 'iqbal123', 844444444),
(5, 'ZAK', 'Zaki', 'zaki123', 855555555);

-- --------------------------------------------------------

--
-- Table structure for table `data_anggota`
--

CREATE TABLE `data_anggota` (
  `id` int(20) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nim` int(20) NOT NULL,
  `no_hp` int(20) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_anggota`
--

INSERT INTO `data_anggota` (`id`, `nama_anggota`, `password`, `nim`, `no_hp`, `alamat`) VALUES
(1, 'Ades', 'ades123', 1106969, 8696969, 'Padasuka'),
(2, 'Alan', 'alan123', 11069420, 8888888, 'Sangkuriang'),
(3, 'Fatwa', 'fatwa123', 11072, 8420420, 'Sariwangi'),
(4, 'Daffa', 'daffa123', 11082, 8619619, 'Baros'),
(5, 'Lintar', 'lintar123', 11092, 8080808, 'Cihanjuang');

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id` int(20) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id`, `judul_buku`, `penulis`, `penerbit`, `kategori`, `status`) VALUES
(1, 'Si Juki Komik Strip', 'Faza Meonk', 'Kawah Media', 'Komik', 'Tersedia'),
(7, 'Menu Harian Praktis : Lauk Sayur Dan Dessert', 'Andi Dan Hadi', 'Kawah Media', 'Buku Masakan', 'Dipinjam'),
(8, 'Bahagia Beragama Bersama Gus Baha', 'Khoirul Anam', 'Elex Media Komputindo', 'Agama', 'Tersedia'),
(9, 'Zikir Pagi & Petang Dilengkapi Zikir & Doa Seputar Muslimah', 'Tim Ar-Risalah', 'Qultummedia', 'Agama', 'Dipinjam'),
(10, 'Mein Kampf (Perjuangan Saya)', 'Adolf Hitler', 'Anak Hebat Indonesia', 'Biografi', 'Tidak Tersedia'),
(11, 'Pengantar Hukum Indonesia', ' Alexander Hery, S.E., M.Si.', 'Yrama Widya', 'Hukum', 'Tersedia'),
(12, 'Pengantar Sejarah dan Konsep Estetika', 'Lingga Agung', 'Kanisius', 'Desain', 'Dipinjam'),
(13, 'Serenada', 'Morra Quatro', 'Gagas Media', 'Fiksi', 'Tidak Tersedia'),
(14, 'Hansel Milsya', 'Chelies', 'Akad x Skuad', 'Fiksi', 'Tersedia'),
(15, 'Filosofi Rumah Tradisional Jawa', 'Asti Musman', 'Anak Hebat Indonesia', 'Arsitektur', 'Tersedia'),
(16, 'Ibnu Khaldun : Bapak Ilmu Sosial', 'Ratnani Latifah', 'Salsabila', 'Ilmu Sosial', 'Tidak Tersedia'),
(17, 'Mitologi Arab', 'Dr. Mahmud Salim al-Hut', 'Alvabet', 'Sejarah', 'Tersedia'),
(18, 'Firasat', 'Dr. Ibrahim Elfiky', 'Qantara', 'Filsafat', 'Tidak Tersedia'),
(19, 'Harry Potter And The Sorcerers Stone', 'J.K. Rowling', 'Sinar Star Book', 'Fantasi', 'Tersedia'),
(20, 'Harry Potter And The Order Of The Phoenix', 'J.K. Rowling', 'Sinar Star Book', 'Fantasi', 'Tersedia'),
(21, 'Harry Potter And The Half-Blood Prince', 'J.K. Rowling', 'Sinar Star Book', 'Fantasi', 'Tersedia'),
(22, 'Elon Musk : Tesla Spacex And The Quest For A Fantastic Future', 'Ashlee Vance', 'Sinar Star Book', 'Biografi', 'Tersedia'),
(23, 'Siklus Pasar Saham', 'Raymond Budiman, CFA', 'Elex Media Komputindo', 'Bisnis & Ekonomi', 'Tersedia'),
(24, 'Rumus Lingkaran', 'Tim Lingkaran', 'Kepustakaan Populer Gramedia', 'Bisnis & Ekonomi', 'Tersedia'),
(25, 'Disruption', 'Rhenald Kasali', 'Gramedia Pustaka Utama', 'Bisnis & Ekonomi', 'Tersedia'),
(26, 'Akuntansi Biaya Edisi 5', 'Mulyadi', 'Upp Stim Ykpn', 'Bisnis & Ekonomi', 'Tersedia'),
(27, 'Kalkulus Turunan dan Integral', 'Ayub Subandi', 'Penerbit Informatika', 'Matematika', 'Tersedia'),
(28, 'Buku Ajar Geometri Transformasi', 'Dr. Fatqurhohman, M.Pd.', 'Refika Aditama', 'Matematika', 'Tersedia'),
(29, 'Sukacita Sains', 'Jim al-Khalili', 'Kepustakaan Populer Gramedia', 'Sains', 'Tersedia'),
(30, 'Panduan Riset dan Publikasi Penelitian bagi Akademisi', 'Prof. Dr. Ir. Widodo Budiharto, S.Si., M.Kom., IPM. dan Prof. Bahtiar S. Abbas, Ph.D.', 'Penerbit Andi', 'Sains', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `data_peminjaman`
--

CREATE TABLE `data_peminjaman` (
  `id` int(11) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_peminjaman`
--

INSERT INTO `data_peminjaman` (`id`, `nama_anggota`, `judul_buku`, `tanggal_peminjaman`, `tanggal_pengembalian`) VALUES
(2, 'Alan', 'Si Juki Komik Strip', '2024-05-01', '2024-05-31'),
(3, 'Fatwa', 'Mitologi Arab', '2024-05-01', '2024-05-11'),
(4, 'Ades', 'Harry Potter And The Sorcerers Stone', '2024-05-30', '2024-05-31'),
(5, 'Daffa', 'Siklus Pasar Saham', '2024-05-04', '2024-05-18'),
(6, 'Lintar', 'Buku Ajar Geometri Transformasi', '2024-05-18', '2024-05-31'),
(7, 'Ades', 'Rumus Lingkaran', '2024-05-31', '2024-06-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `data_peminjaman`
--
ALTER TABLE `data_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
