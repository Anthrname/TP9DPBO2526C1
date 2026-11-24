-- Database: mvp_kandidat_db
CREATE DATABASE IF NOT EXISTS `mvp_kandidat_db`;
USE `mvp_kandidat_db`;

-- --------------------------------------------------------
-- Struktur tabel `kandidat`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `kandidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `domisili` varchar(100) NOT NULL,
  `skorTes` int(11) NOT NULL DEFAULT 0,
  `pengalamanTahun` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data untuk tabel `kandidat`
INSERT INTO `kandidat` (`id`, `nama`, `posisi`, `domisili`, `skorTes`, `pengalamanTahun`) VALUES
(1, 'Raka Pratama', 'Backend Developer', 'Bandung', 92, 3),
(2, 'Sinta Maharani', 'UI/UX Designer', 'Jakarta', 88, 2),
(3, 'Dimas Nugroho', 'Data Analyst', 'Yogyakarta', 85, 1),
(4, 'Nadia Kusuma', 'Frontend Developer', 'Surabaya', 90, 2),
(5, 'Bagas Setiawan', 'QA Engineer', 'Bandung', 81, 1);

-- --------------------------------------------------------
-- Struktur tabel `lowongan` (Modul Tambahan HR / Rekrutmen)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lowongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namaLowongan` varchar(100) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  `tipePekerjaan` varchar(50) NOT NULL,
  `kuota` int(11) NOT NULL DEFAULT 1,
  `status` varchar(50) NOT NULL DEFAULT 'Dibuka',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data untuk tabel `lowongan`
INSERT INTO `lowongan` (`id`, `namaLowongan`, `departemen`, `tipePekerjaan`, `kuota`, `status`) VALUES
(1, 'Backend Developer', 'Engineering', 'Full-time', 3, 'Dibuka'),
(2, 'Frontend Developer', 'Engineering', 'Full-time', 2, 'Dibuka'),
(3, 'UI/UX Designer', 'Product & Design', 'Full-time', 1, 'Dibuka'),
(4, 'Data Analyst', 'Data Science', 'Contract', 2, 'Dibuka'),
(5, 'QA Engineer', 'Quality Assurance', 'Full-time', 2, 'Ditutup');
