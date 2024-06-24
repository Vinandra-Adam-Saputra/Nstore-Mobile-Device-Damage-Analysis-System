-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 12:48 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin321');

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `lcd_touchscreen` varchar(50) DEFAULT NULL,
  `getaran` varchar(50) DEFAULT NULL,
  `signal` varchar(50) DEFAULT NULL,
  `suara` varchar(50) DEFAULT NULL,
  `baterai` varchar(50) DEFAULT NULL,
  `port_cas` varchar(50) DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL,
  `housing` varchar(50) DEFAULT NULL,
  `tombol_tombol` varchar(50) DEFAULT NULL,
  `mic` varchar(50) DEFAULT NULL,
  `jenis_kerusakan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `lcd_touchscreen`, `getaran`, `signal`, `suara`, `baterai`, `port_cas`, `mesin`, `housing`, `tombol_tombol`, `mic`, `jenis_kerusakan`) VALUES
(1, 'Responsif', 'Baik', 'Lemah', 'Ada', 'Tidak Terisi', 'Normal', 'Normal', 'Aman', 'Baik', 'Tidak merekam', 'Komponen Elektronik'),
(2, 'Tidak Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Tidak Respon', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(3, 'Responsif', 'Baik', 'Normal', 'Tidak ada', 'Normal', 'Normal', 'Cepat panas', 'Aman', 'Keras', 'Merekam', 'Komponen Fisik'),
(4, 'Tidak Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Restart-restart', 'Aman', 'Tidak respon', 'Merekam', 'Komponen Fisik'),
(5, 'Tidak Tampil', 'Mati', 'Hilang', 'Tidak ada', 'Normal', 'Normal', 'Mati total', 'Pecah', 'Baik', 'Merekam', 'Komponen Utama'),
(6, 'Responsif', 'Mati', 'Normal', 'Tidak Ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Fisik'),
(7, 'Responsif', 'Baik', 'Hilang', 'Ada', 'Normal', 'Normal', 'Normal', 'Pecah', 'Baik', 'Tidak merekam', 'Komponen Elektronik'),
(8, 'Tidak Tampil', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Normal', 'Pecah', 'Baik', 'Merekam', 'Komponen Fisik'),
(9, 'Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Tidak respon', 'Merekam', 'Komponen Fisik'),
(10, 'Responsif', 'Baik', 'Lemah', 'Ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Tidak respon', 'Tidak merekam', 'Komponen Fisik'),
(11, 'Responsif', 'Baik', 'Lemah', 'Ada', 'Tidak Terisi', 'Longgar', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(12, 'Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Keras', 'Merekam tidak bergelombang', 'Komponen Fisik'),
(13, 'Responsif', 'Baik', 'Normal', 'Pecah', 'Habis tak beraturan', 'Normal', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(14, 'Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(15, 'Tidak Tampil', 'Baik', 'Normal', 'Tidak ada', 'Normal', 'Normal', 'Cepat panas', 'Pecah', 'Keras', 'Tidak merekam', 'Komponen Fisik'),
(16, 'Tidak Responsif', 'Baik', 'Lemah', 'Ada', 'Normal', 'Normal', 'Restart-restart', 'Pecah', 'Baik', 'Merekam', 'Komponen Utama'),
(17, 'Tidak Tampil', 'Mati', 'Hilang', 'Tidak ada', 'Tidak Terisi', 'Normal', 'Mati total', 'Pecah', 'Baik', 'Merekam', 'Komponen Utama'),
(18, 'Responsif', 'Baik', 'Normal', 'Tidak ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Baik', 'Tidak merekam', 'Komponen Elektronik'),
(19, 'Tidak Tampil', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Normal', 'Pecah', 'Keras', 'Merekam', 'Komponen Fisik'),
(20, 'Responsif', 'Mati', 'Lemah', 'Tidak ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Fisik'),
(21, 'Tidak Responsif', 'Baik', 'Normal', 'Ada', 'Cepat Habis', 'Normal', 'Cepat panas', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(22, 'Responsif', 'Baik', 'Lemah', 'Pecah', 'Normal', 'Tidak Respon', 'Normal', 'Aman', 'Keras', 'Tidak merekam', 'Komponen Elektronik'),
(23, 'Tidak Tampil', 'Mati', 'Hilang', 'Tidak ada', 'Tidak Terisi', 'Longgar', 'Mati total', 'Pecah', 'Tidak respon', 'Tidak merekam', 'Komponen Utama'),
(24, 'Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Restart-restart', 'Aman', 'Baik', 'Merekam tidak bergelombang', 'Komponen Fisik'),
(25, 'Tidak Responsif', 'Baik', 'Lemah', 'Ada', 'Cepat Habis', 'Tidak Respon', 'Normal', 'Aman', 'Keras', 'Merekam', 'Komponen Elektronik'),
(26, 'Responsif', 'Baik', 'Normal', 'Tidak ada', 'Normal', 'Normal', 'Cepat panas', 'Pecah', 'Baik', 'Merekam', 'Komponen Fisik'),
(27, 'Tidak Tampil', 'Mati', 'Normal', 'Ada', 'Tidak Terisi', 'Normal', 'Restart-restart', 'Aman', 'Tidak respon', 'Merekam', 'Komponen Utama'),
(28, 'Responsif', 'Baik', 'Hilang', 'Pecah', 'Normal', 'Longgar', 'Normal', 'Aman', 'Baik', 'Tidak merekam', 'Komponen Elektronik'),
(29, 'Tidak Responsif', 'Baik', 'Lemah', 'Ada', 'Habis tak beraturan', 'Normal', 'Cepat panas', 'Pecah', 'Keras', 'Merekam', 'Komponen Fisik'),
(30, 'Responsif', 'Mati', 'Normal', 'Tidak ada', 'Normal', 'Tidak Respon', 'Normal', 'Aman', 'Tidak respon', 'Merekam tidak bergelombang', 'Komponen Fisik'),
(31, 'Responsif', 'Baik', 'Normal', 'Ada', 'Normal', 'Normal', 'Normal', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(32, 'Tidak Responsif', 'Baik', 'Lemah', 'Tidak ada', 'Tidak Terisi', 'Tidak Respon', 'Cepat panas', 'Aman', 'Keras', 'Tidak merekam', 'Komponen Elektronik'),
(33, 'Tidak Tampil', 'Mati', 'Hilang', 'Tidak ada', 'Normal', 'Normal', 'Mati total', 'Pecah', 'Tidak respon', 'Merekam', 'Komponen Utama'),
(34, 'Responsif', 'Baik', 'Normal', 'Ada', 'Cepat Habis', 'Normal', 'Restart-restart', 'Aman', 'Baik', 'Merekam tidak bergelombang', 'Komponen Fisik'),
(35, 'Tidak Responsif', 'Baik', 'Lemah', 'Ada', 'Habis tak beraturan', 'Longgar', 'Normal', 'Pecah', 'Keras', 'Tidak merekam', 'Komponen Elektronik'),
(36, 'Responsif', 'Mati', 'Normal', 'Tidak ada', 'Normal', 'Tidak Respon', 'Cepat panas', 'Aman', 'Baik', 'Merekam', 'Komponen Fisik'),
(37, 'Tidak Tampil', 'Baik', 'Hilang', 'Ada', 'Tidak Terisi', 'Normal', 'Restart-restart', 'Pecah', 'Tidak respon', 'Tidak merekam', 'Komponen Utama'),
(38, 'Responsif', 'Baik', 'Lemah', 'Tidak ada', 'Cepat Habis', 'Longgar', 'Normal', 'Aman', 'Baik', 'Merekam tidak bergelombang', 'Komponen Elektronik'),
(39, 'Tidak Responsif', 'Mati', 'Normal', 'Ada', 'Normal', 'Tidak Respon', 'Mati total', 'Aman', 'Keras', 'Merekam', 'Komponen Fisik'),
(40, 'Tidak Tampil', 'Baik', 'Hilang', 'Tidak ada', 'Habis tak beraturan', 'Normal', 'Cepat panas', 'Pecah', 'Tidak respon', 'Tidak merekam', 'Komponen Utama'),
(41, 'Responsif', 'Baik', 'Lemah', 'Ada', 'Tidak Terisi', 'Longgar', 'Restart-restart', 'Aman', 'Baik', 'Merekam', 'Komponen Elektronik'),
(42, 'Tidak Responsif', 'Mati', 'Normal', 'Tidak ada', 'Cepat Habis', 'Tidak Respon', 'Normal', 'Pecah', 'Keras', 'Merekam tidak bergelombang', 'Komponen Fisik'),
(43, 'Responsif', 'Baik', 'Hilang', 'Ada', 'Normal', 'Normal', 'Cepat panas', 'Aman', 'Tidak respon', 'Tidak merekam', 'Komponen Elektronik');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `nama_gejala`) VALUES
(1, 'LCD & Touchscreen'),
(2, 'Getaran'),
(3, 'Signal'),
(4, 'Suara'),
(5, 'Baterai'),
(6, 'Port Cas'),
(7, 'Mesin'),
(8, 'Housing'),
(9, 'Tombol-Tombol'),
(10, 'Mic');

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan`
--

CREATE TABLE `kerusakan` (
  `id_kerusakan` int(11) NOT NULL,
  `nama_kerusakan` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kerusakan`
--

INSERT INTO `kerusakan` (`id_kerusakan`, `nama_kerusakan`, `deskripsi`) VALUES
(1, 'Komponen Elektronik', 'Komponen elektronik mencakup berbagai bagian penting yang bertanggung jawab atas fungsi listrik dan konektivitas perangkat mobile Anda. Kerusakan pada komponen ini dapat meliputi masalah dengan baterai (seperti baterai cepat habis atau tidak bisa mengisi daya), gangguan pada antena sinyal yang menyebabkan koneksi buruk, kerusakan pada port pengisian daya yang membuat perangkat sulit atau tidak bisa diisi dayanya, masalah pada speaker atau mikrofon yang mempengaruhi kualitas suara, atau gangguan pada sensor-sensor seperti accelerometer atau gyroscope. Kerusakan pada komponen elektronik biasanya mempengaruhi kinerja perangkat tanpa harus terlihat secara fisik'),
(2, 'Komponen Fisik', 'Komponen fisik merujuk pada bagian-bagian perangkat mobile yang dapat dilihat dan disentuh secara langsung. Ini termasuk housing atau casing perangkat, layar sentuh (touchscreen), tombol-tombol fisik (seperti tombol power, volume, atau home), kamera, dan port-port eksternal. Kerusakan pada komponen fisik bisa berupa retak atau pecah pada layar, tombol yang macet atau tidak responsif, housing yang rusak atau terlepas, touchscreen yang tidak merespon dengan baik, atau kerusakan pada lensa kamera. Masalah pada komponen fisik umumnya dapat langsung terlihat atau dirasakan saat menggunakan perangkat'),
(3, 'Komponen Utama', 'Komponen utama mengacu pada \'otak\' dari perangkat mobile Anda, yaitu mainboard atau motherboard. Mainboard adalah sirkuit terintegrasi yang menghubungkan dan mengontrol semua fungsi perangkat. Kerusakan pada komponen utama biasanya merupakan masalah yang paling serius dan kompleks. Gejala kerusakan bisa bervariasi, mulai dari perangkat yang tidak mau menyala sama sekali, sering restart sendiri, hang atau freeze, hingga masalah software yang persisten yang tidak bisa diselesaikan dengan cara biasa. Kerusakan pada mainboard bisa disebabkan oleh berbagai faktor seperti kerusakan fisik parah, korsleting, atau masalah pabrikasi. Perbaikan komponen utama umumnya memerlukan keahlian teknis tinggi dan mungkin membutuhkan penggantian mainboard secara keseluruhan.');

-- --------------------------------------------------------

--
-- Table structure for table `opsi_gejala`
--

CREATE TABLE `opsi_gejala` (
  `id_opsi` int(11) NOT NULL,
  `id_gejala` int(11) DEFAULT NULL,
  `nama_opsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opsi_gejala`
--

INSERT INTO `opsi_gejala` (`id_opsi`, `id_gejala`, `nama_opsi`) VALUES
(1, 1, 'Responsif'),
(2, 1, 'Tidak Responsif'),
(3, 1, 'Tidak Tampil'),
(4, 2, 'Baik'),
(5, 2, 'Mati'),
(6, 3, 'Normal'),
(7, 3, 'Lemah'),
(8, 3, 'Hilang'),
(9, 4, 'Ada'),
(11, 4, 'Tidak ada'),
(14, 5, 'Normal'),
(15, 5, 'Tidak Terisi'),
(16, 5, 'Habis tak Beraturan'),
(17, 6, 'Normal'),
(18, 6, 'Tidak Respon'),
(19, 6, 'Longgar'),
(20, 7, 'Normal'),
(21, 7, 'Cepat Panas'),
(22, 7, 'Restart-restart'),
(23, 7, 'Mati Total'),
(24, 8, 'Aman'),
(25, 8, 'Pecah'),
(26, 9, 'Baik'),
(27, 9, 'Tidak Respon'),
(28, 9, 'Keras'),
(29, 10, 'Merekam'),
(30, 10, 'Tidak Merekam'),
(32, 10, 'Merekam tidak bergelombang');

-- --------------------------------------------------------

--
-- Table structure for table `saran`
--

CREATE TABLE `saran` (
  `id_saran` int(11) NOT NULL,
  `isi_saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saran`
--

INSERT INTO `saran` (`id_saran`, `isi_saran`) VALUES
(1, 'kamera saya rusak kak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`id_kerusakan`);

--
-- Indexes for table `opsi_gejala`
--
ALTER TABLE `opsi_gejala`
  ADD PRIMARY KEY (`id_opsi`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kerusakan`
--
ALTER TABLE `kerusakan`
  MODIFY `id_kerusakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `opsi_gejala`
--
ALTER TABLE `opsi_gejala`
  MODIFY `id_opsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opsi_gejala`
--
ALTER TABLE `opsi_gejala`
  ADD CONSTRAINT `opsi_gejala_ibfk_1` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
