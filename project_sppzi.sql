-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Agu 2021 pada 08.41
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sppzi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(5) NOT NULL,
  `nama_admin` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `foto`, `password`) VALUES
('A02', 'Admin', 'A02.jpg', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` varchar(20) NOT NULL,
  `nis` varchar(15) DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `total_tagihan` text DEFAULT NULL,
  `bukti` text DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `nis`, `tgl_pembayaran`, `deskripsi`, `total_tagihan`, `bukti`, `status`, `keterangan`) VALUES
('202107296160000001', '6160', '2021-07-29 00:00:00', NULL, '200000', '3308376c6d5da3f04abce0b419bf90cf.jpg', 0, NULL),
('202107296160000002', '6160', '2021-07-29 00:00:00', NULL, '200000', '95c492cbcffb86578176dbbe7c57719b.jpg', 0, NULL),
('202107296160000003', '6160', '2021-07-29 00:00:00', NULL, '200000', 'default.png', 0, NULL),
('202107296160000004', '6160', '2021-07-29 00:00:00', NULL, '200000', 'aef29a6fc0f1dcd6adfde30904fad022.jpg', 0, NULL),
('202107296160000005', '6160', '2021-07-29 00:00:00', NULL, '200000', 'default.png', 0, NULL),
('202107296160000006', '6160', '2021-07-29 00:00:00', NULL, '200000', 'f64b5311aa32d50fc1b2564bbc9e35c8.jpg', 0, NULL),
('202107296160000007', '6160', '2021-07-29 00:00:00', NULL, '200000', '3fcd9e89214ff62c01e27cf567c5ca41.jpg', 0, NULL),
('202107296160000008', '6160', '2021-07-29 00:00:00', NULL, '200000', '278d21715c5627c3e9acf11133b755c4.jpg', 0, NULL),
('202107296160000009', '6160', '2021-07-29 00:00:00', NULL, '200000', 'edb1ad2e2c522b153d509140b0b498fd.jpg', 0, NULL),
('202107296160000010', '6160', '2021-07-29 00:00:00', NULL, '200000', '478980ce362f9c5b59107e29571b1104.jpg', 0, NULL),
('202107296160000011', '6160', '2021-07-29 00:00:00', NULL, '200000', 'a98de32b0eecd0c372878e6e39af6da5.jpg', 0, NULL),
('202107296160000012', '6160', '2021-07-29 00:00:00', NULL, '200000', 'fe12aba42bd710eb0b2a73f49452c32e.jpg', 0, NULL),
('202107296160000013', '6160', '2021-07-29 00:00:00', NULL, '200000', '6cfc4f9fa1b785f3b2d384651ee4024a.jpg', 2, 'Foto bukti tidak sesuai'),
('202107296160000014', '6160', '2021-07-29 00:00:00', NULL, '200000', 'ea41c10d9e7a1bc0663104027e9fd514.jpg', 1, NULL),
('202107316160000015', '6160', '2021-07-31 15:58:01', NULL, '200000', 'd5495b4241b33931e0fd2576b8eff3bd.jpg', 2, '300.000 pembayaran bulan depan'),
('202108016160000016', '6160', '2021-08-01 10:44:32', 'SPP Bulan Juli; ', '200000', '855386505e0edfe661ccc4eff1d3763b.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` varchar(15) NOT NULL,
  `nama_siswa` text DEFAULT NULL,
  `nisn` text DEFAULT NULL,
  `angkatan` text DEFAULT NULL,
  `kelas` text DEFAULT NULL,
  `jurusan` text DEFAULT NULL,
  `tempat_lahir` text DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` text DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama_siswa`, `nisn`, `angkatan`, `kelas`, `jurusan`, `tempat_lahir`, `tgl_lahir`, `jk`, `alamat`, `no_telp`, `foto`, `password`) VALUES
('12345', 'Axaxa', '12345', '2021', 'XI', 'AK', 'Semarang', '2021-08-14', 'Laki-laki', 'AXAx', '81325611594', 'default.png', '8c1db72e3e355a0597719a51fd6ec620'),
('6160', 'AGUS JUNI PRANOTO', '0048872563', '2020', 'X', 'Animasi', 'Semarang', '2004-08-11', 'Perempuan', 'Jl. Gedongsongo Barat RT 008/002', '81326002385', '6160.jpg', '01c3c766ce47082b1b130daedd347ffd'),
('6161', 'ALVIN NANDA IKHSANI', '0052451392', '2020', NULL, NULL, 'Semarang', NULL, 'Perempuan', 'Kp Keperan 451 RT 002 RW 011', '85156135202', 'default.png', '\r'),
('6162', 'ALYA ADRISTI ', '0053789371', '2020', NULL, NULL, 'Semarang', '0000-00-00', 'Laki-laki', 'Jl. Kumudasmoro Dalam RT 005 RW 005', '81326002385', 'default.png', ''),
('6163', 'AMELIA DWI FEBRIANI', '0051070336', '2020', NULL, NULL, 'Brebes', NULL, 'Laki-laki', 'Jl. Barusari I/280 RT 003 RW 001', '85159199880', 'default.png', '\r'),
('6164', 'ARDELIA PISISTA', '0055420901', '2020', 'XI', 'PM', 'Semarang', '2012-08-18', 'Laki-laki', 'Wonolopo RT 002 RW 010', '87721191226', 'default.png', '\r'),
('6165', 'BUNGA APRILLIANI', '0030834081', '2020', NULL, NULL, 'Curup', '0000-00-00', 'Laki-laki', 'Jl. Medan Baru Blok 3 RT 013 RW 005', '87820579636', 'default.png', '\r'),
('6168', 'ILHAM AGUSTINO', '0044714579', '2021', NULL, NULL, 'Semarang', '0000-00-00', 'Perempuan', 'Jl. Jonggring Saloko III/3 RT 005 RW 012', '', 'default.png', '\r'),
('6169', 'JASMINE AYU PRATISTHA', '0051071983', '2021', NULL, NULL, 'Semarang', '0000-00-00', 'Laki-laki', 'Jl. Wonodri Kopen Timur RT 004 RW 005', '', 'default.png', '\r'),
('6170', 'KAYLA ZAFIRA RAMADHANI', '0045901274', '2021', NULL, NULL, 'Semarang', '0000-00-00', 'Laki-laki', 'Jl. Lodan II RT 008 RW 005', '', 'default.png', '\r'),
('6171', 'KEILA RAHMA ALINA PUTRI', '0052116872', '2021', NULL, NULL, 'Klaten', '0000-00-00', 'Laki-laki', 'Krosakan RT 002 RW 001', '', 'default.png', '\r'),
('6172', 'KURNIAWATI', '0053366070', '2021', NULL, NULL, 'Kendal', '0000-00-00', 'Laki-laki', 'Bedagan II/498 RT 007 RW 002', '', 'default.png', '\r'),
('6173', 'MAR\'ATUS SHOLIKHATUL LADHUNA', '0050953631', '2021', NULL, NULL, 'Semarang', '0000-00-00', 'Laki-laki', 'Jl. Borobudur Utara RT 007 RW 003', '', 'default.png', '\r');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan`
--

CREATE TABLE `tb_tagihan` (
  `id` int(11) NOT NULL,
  `angkatan` text DEFAULT NULL,
  `biaya` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_tagihan`
--

INSERT INTO `tb_tagihan` (`id`, `angkatan`, `biaya`, `keterangan`) VALUES
(3, '2020', '200000', 'SPP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan_siswa`
--

CREATE TABLE `tb_tagihan_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(15) DEFAULT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `ket_tambahan` text DEFAULT NULL,
  `batas_waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indeks untuk tabel `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tagihan_siswa`
--
ALTER TABLE `tb_tagihan_siswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan_siswa`
--
ALTER TABLE `tb_tagihan_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
