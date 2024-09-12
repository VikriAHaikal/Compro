-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 10:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcompro`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `isi`, `tanggal_waktu`, `kategori`, `gambar`, `penulis`) VALUES
(1, 'MY SISKOP ADIS', 'System online koperasi berbasis aplikasi yang dapat memberikan kemudahan dan pelayananan secara cepat kepada anggota seperti pengajuan pinjaman, tabungan, adis mart, aneka usaha dll. Jika Anda adalah anggota Kopkar PT Adis Dimension Footwear dan belum memiliki aplikasi ini, Anda bisa mendownload aplikasinya di Playstore', '2023-09-06 10:19:00', 'Pendidikan', 'uploads/SYSKOP.png', 'Fatkhul Rohman'),
(2, 'ANNIVERSARY KOPERASI ADIS', 'Pada tanggal 17 september 2022 koperasi adis mengadakan anniversary dengan tema \"Transformasi Bersama Mencapai Sejahtera\".', '2022-09-17 11:05:00', 'Sosial', 'uploads/ANIV.jpg', 'Fatkhul Rohman'),
(3, 'BAZZAR ', 'Koperasi karyawan PT. Adis juga mengadakan bazar yang diadakan setahun 3 kali. Dalam bazar tersebut barang-barang  rumah tangga, elektronik, kendaraan bermotor, alat kesehatan, pernak pernik hiasan rumah dan lain sebagai tersedia dengan harga terjangkau. Bazar diadakan dikantin adis 1 dan kantin adis 2. Para karyawan sangat antusias dalam hadirnya bazar yang diadakan oleh koperasi karyawan PT. Adis.', '2015-12-06 11:10:00', 'Sosial', 'uploads/BAZZAR.jpg', 'Fatkhul Rohman'),
(4, 'SANTUNAN ANAK YATIM', 'Santunan anak yatim yang diadakan di Panti Asuhan DAARUNNAS', '2016-10-25 11:17:00', 'Sosial', 'uploads/SANTUNAN_YATIM.jpg', 'Fatkhul Rohman');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `slogan_perusahaan` varchar(255) DEFAULT NULL,
  `alamat` varchar(50) NOT NULL,
  `toggle_button_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `nama_perusahaan`, `slogan_perusahaan`, `alamat`, `toggle_button_status`) VALUES
(1, 'Koperasi Konsumen Karyawan PT Adis Dimension Footwear', 'Sejahtera Bersama Anggota', 'Jalan Raya Serang KM 24 Balaraja Tangerang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_logo`
--

CREATE TABLE `company_logo` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `logo_perusahaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_logo`
--

INSERT INTO `company_logo` (`id`, `company_id`, `logo_perusahaan`) VALUES
(7, 1, 'uploads/kopkars.png'),
(8, 1, 'uploads/adfs.png');

-- --------------------------------------------------------

--
-- Table structure for table `company_social_icons`
--

CREATE TABLE `company_social_icons` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `icon_name` varchar(255) NOT NULL,
  `icon_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_social_icons`
--

INSERT INTO `company_social_icons` (`id`, `company_id`, `icon_name`, `icon_url`) VALUES
(10, 1, 'yt.png', 'https://youtube.com/@koperasiadis2278'),
(11, 1, 'email.png', 'https://mail.google.com/mail/u/0/#inbox?compose=CllgCJfqcBKCkCHqvSNmvQhlBTHTGPcwSngzhGXtWHqZtRtSdCldJsfXlctNvWBkpDbbxjXPjZg'),
(12, 1, 'wa.png', 'https://wa.me/6287777883993');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `link_gmaps` varchar(100) NOT NULL,
  `url_gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama_perusahaan`, `deskripsi`, `link_gmaps`, `url_gambar`) VALUES
(1, 'Adismart 1 ', 'Adismart 1 adalah Pusat Perbelanjaan Berbasis Mini Market yang berlokasi di PT Adis Dimension Footwear', 'https://www.google.com/maps/place/Agenpos+Kopkar+Adis/@-6.19874,106.4534763,18.83z/data=!4m14!1m7!3m', 'uploads/mart.jpg'),
(3, 'Adismart 2', 'Adismart 2 adalah Pusat Perbelanjaan Berbasis Mini Market yang berlokasi di PT Adis Dimension Footwear Plan 2', 'https://goo.gl/maps/n9kxyuF6NXLfLBfcA', 'uploads/mart.jpg'),
(4, 'Adismart Ciruas', 'Adismart Ciruas adalah Pusat Perbelanjaan Berbasis Mini Market yang berlokasi di daerah Ciruas', 'https://goo.gl/maps/iVB48wszxcBwYLHR9', 'uploads/mart.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `company_id`, `nama_menu`, `deskripsi`) VALUES
(1, 1, 'Tentang Koperasi', 'Kenal Lebih Dekat Dengan Koperasi'),
(2, 1, 'Berita', 'Kabar Terbaru Dari Koperasi'),
(3, 1, 'Produk', 'Unit Yang Tersedia di Koperasi'),
(4, 1, 'Lokasi', 'Lokasi Terkait Adismart'),
(5, 1, 'Mitra Koperasi Adis', 'Hubungan Kerjasama Koperasi Adis');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id` int(11) NOT NULL,
  `tingkat` varchar(10) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`id`, `tingkat`, `keterangan`, `tahun`, `gambar`) VALUES
(11, 'Nasional', 'Koperasi Berprestasi', 2008, 'uploads/NASIONAL_2008.jpg'),
(12, 'Nasional', 'Koperasi Berprestasi', 2008, 'uploads/NASIONAL2_2008.jpg'),
(13, 'Nasional', 'Koperasi Berprestasi', 2014, 'uploads/NASIONAL_2014.jpg'),
(14, 'Nasional', 'Koperasi Berprestasi', 2019, 'uploads/NASIONAL_2019.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori` enum('Unit Simpan Pinjam (USP)','Unit Ritel','Unit Jasa','Usaha Mikro Kecil & Menengah (UMKM)') NOT NULL,
  `gambar_produk` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `kategori`, `gambar_produk`) VALUES
(1, 'Perpanjang Pajak', 'Unit Simpan Pinjam (USP)', 'uploads/jasa.jpg'),
(3, 'Jasa Peminjaman Kendaraan', 'Unit Jasa', 'uploads/IMG_8759.jpg'),
(4, 'Nice Coffee', 'Usaha Mikro Kecil & Menengah (UMKM)', 'uploads/Picture1.png'),
(5, 'Mini Market', 'Unit Ritel', 'uploads/IMG_3619-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `start_page`
--

CREATE TABLE `start_page` (
  `id` int(11) NOT NULL,
  `nama_konten` varchar(255) NOT NULL,
  `nama_lagu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `start_page`
--

INSERT INTO `start_page` (`id`, `nama_konten`, `nama_lagu`) VALUES
(3, 'uploads/adis.mp4', 'uploads/Hari Merdeka - Lirik Lagu Nasional Indonesia (mp3cut.net) (1).mp3');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `nama_submenu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `menu_id`, `nama_submenu`) VALUES
(1, 1, 'Sejarah '),
(2, 1, 'Visi & Misi'),
(5, 2, 'Pendidikan'),
(6, 2, 'Sosial'),
(7, 2, 'Teknologi'),
(8, 3, 'Unit Ritel'),
(9, 3, 'Unit Simpan Pinjam (USP)'),
(10, 3, 'Unit Jasa'),
(11, 3, 'UMKM'),
(12, 4, 'Adismart 1'),
(13, 4, 'Adismart 2'),
(14, 4, 'Adismart Ciruas'),
(15, 4, 'Adismart Balaraja (Comingsoon)'),
(25, 1, 'Struktur Pengurus '),
(51, 5, 'Partnership'),
(52, 5, 'Sponsorship'),
(53, 5, 'Mitra Adismart'),
(54, 1, 'Penghargaan'),
(55, 2, 'Lainnya'),
(56, 5, 'Lokasi Mitra');

-- --------------------------------------------------------

--
-- Table structure for table `tentang`
--

CREATE TABLE `tentang` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tentang`
--

INSERT INTO `tentang` (`id`, `judul`, `isi`, `gambar`) VALUES
(2, 'Sejarah', 'Koperasi Konsumen Karyawan PT Adis Dimension Footwear berdiri dengan dukungan penuh dari manajemen dalam rangka meningkatkan kesejahteraan karyawan terbukti dengan dibangunnya Gedung koperasi yang baru pada tahun 2012 dan 2018. Kopkar Adis dalam menjalankan kegiatan operasionalnya dengan menggunakan sistem yang sudah terintegrasi dan real time on line di Smartphone. Koperasi Karyawan PT. Adis Dimension Footwear adalah sebuah koperasi yang didirikan pada tanggal 11 September tahun 1991. Koperasi ini berlokasi di Kabupaten Tangerang Balaraja.', 'uploads/Screenshot (166).png'),
(3, 'Visi & Misi', 'VISI \r\nMenjadi Koperasi yang modern, transparan, terpercaya dan partner perusahaan dalam meningkatkan kesejahteraan Anggota.\r\nMISI \r\n• PELAYANAN TERBAIK \r\nMemberikan Pelayanan yang terbaik kepada anggota, sesuai jati diri koperasi \r\n• PROFESIONAL PEKERJA \r\nPengelolaan secara professional, transparan, dan kehati-hatian \r\n• INTERGRASI SISTEM \r\nMengembangkan sistem secara terpadu dengan digitalisasi \r\n• HUBUNGAN KERJASAMA \r\nMenjalin kerjasama usaha dengan pihak lain \r\n• LINGKUNGAN SOSIAL \r\nBerperan dalam meningkatkan kesejahteraan lingkungan', 'uploads/Untitled_design__1_-removebg-preview.png'),
(4, 'Struktur Organisasi', 'Penasehat : Meliputi BOD PT Adis Dimension Footwear\r\nPengawas : Meliputi Perwakilan Dari Anggota Dari Setiap Bagian\r\nPengurus : Meliputi Perwakilan Dari Anggota Dari Setiap Bagian', 'uploads/Picture1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`) VALUES
(1, 'Adis1', 'kopkaradis1@gmail.com', 'adis1', 'bb7ac2cdadae3381cdb8cbe25380f783');

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE `warna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kode_warna` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `nama`, `kode_warna`) VALUES
(2, 'Warna Default', '#3362f0'),
(3, 'Header Bottom', '#ffffff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_logo`
--
ALTER TABLE `company_logo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `company_social_icons`
--
ALTER TABLE `company_social_icons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `start_page`
--
ALTER TABLE `start_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_logo`
--
ALTER TABLE `company_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_social_icons`
--
ALTER TABLE `company_social_icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `start_page`
--
ALTER TABLE `start_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `company_logo`
--
ALTER TABLE `company_logo`
  ADD CONSTRAINT `company_logo_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `company_social_icons`
--
ALTER TABLE `company_social_icons`
  ADD CONSTRAINT `company_social_icons_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
