-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2024 pada 16.50
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bidan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `kdObat` char(3) NOT NULL,
  `nmObat` varchar(256) NOT NULL,
  `hargaObat` int(11) NOT NULL,
  `stok` int(5) NOT NULL,
  `ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`kdObat`, `nmObat`, `hargaObat`, `stok`, `ket`) VALUES
('O01', 'Vitonal F', 12000, 6, ''),
('O02', 'Calcid', 10000, 5, ''),
('O03', 'Asam Folat', 15000, 10, ''),
('O04', 'DHA', 13000, 10, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `noRm` char(8) NOT NULL,
  `noIdentitas` varchar(20) NOT NULL,
  `nmSuami` varchar(128) NOT NULL,
  `nmPasien` varchar(128) NOT NULL,
  `tglLahir` date NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tglDaftar` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`noRm`, `noIdentitas`, `nmSuami`, `nmPasien`, `tglLahir`, `noTelp`, `alamat`, `tglDaftar`) VALUES
('RM000001', '3333111103021234', 'Den Bagus Dirgantara', 'Indah Intan Permata', '1990-03-12', '085878805855', 'Bulokerto', '2024-02-28 10:03:20'),
('RM000002', '3313112806876363', 'Wahyu Suboseto', 'Marina Dwi Handayani', '1992-03-12', '087654345678', 'Sragentina\r\n', '2024-03-01 10:03:20'),
('RM000003', '3232332323232323', 'Den Bagus Dirgantara', 'Martanti', '1997-03-02', '08587880598', 'Gemolong,Sragen', '2024-03-03 10:03:20'),
('RM000004', '31231231231231231', 'Jokowi', 'Iriana', '1960-12-12', '000999888776', 'Semanngi, Solo', '2024-05-24 13:23:20'),
('RM000005', '1234567891234561', 'Gibran', 'Istri Gibran', '1991-11-03', '0981091091098', 'Solo', '2024-05-25 08:03:20'),
('RM000006', '3325566677', 'dika', 'lina', '1999-06-03', '089767883344', 'solo', '2024-06-05 09:03:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `idPeriksa` char(15) NOT NULL,
  `noRegistrasi` char(15) NOT NULL,
  `noRm` char(8) NOT NULL,
  `tglPeriksa` date NOT NULL,
  `sistol` varchar(3) NOT NULL,
  `diastol` varchar(3) NOT NULL,
  `bb` float NOT NULL,
  `uk` varchar(5) NOT NULL,
  `tfu` varchar(50) NOT NULL,
  `letak` varchar(50) NOT NULL,
  `djj` varchar(5) NOT NULL,
  `keluhan` text NOT NULL,
  `tindakLanjut` varchar(100) NOT NULL,
  `diagnosa` text NOT NULL,
  `imunisasi` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`idPeriksa`, `noRegistrasi`, `noRm`, `tglPeriksa`, `sistol`, `diastol`, `bb`, `uk`, `tfu`, `letak`, `djj`, `keluhan`, `tindakLanjut`, `diagnosa`, `imunisasi`, `idUser`, `created`) VALUES
('PR2024071500001', 'ID2024071500001', 'RM000002', '2024-07-15', '120', '90', 66, '5', '', '', '', 'nbnbnbnb', 'mmnmnmn', 'bnbnbnb', '', 20, '2024-07-15 21:40:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pr_obat`
--

CREATE TABLE `pr_obat` (
  `idPeriksa` char(15) NOT NULL,
  `kdObat` char(3) NOT NULL,
  `jumlahObat` int(5) NOT NULL,
  `aturan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pr_obat`
--

INSERT INTO `pr_obat` (`idPeriksa`, `kdObat`, `jumlahObat`, `aturan`) VALUES
('PR2024071500001', 'O01', 3, '1 x sehari sehabis makan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi`
--

CREATE TABLE `registrasi` (
  `noRegistrasi` char(15) NOT NULL,
  `noRm` char(15) NOT NULL,
  `tglKunjungan` datetime NOT NULL DEFAULT current_timestamp(),
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `registrasi`
--

INSERT INTO `registrasi` (`noRegistrasi`, `noRm`, `tglKunjungan`, `idUser`) VALUES
('ID2024071500001', 'RM000002', '2024-07-15 21:38:01', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `fullName` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `noTelp` varchar(15) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `fullName`, `alamat`, `noTelp`, `username`, `password`, `role`, `active`, `image`) VALUES
(1, 'Super Admin', '', '012345678901', 'superadmin', '$2y$10$wT4vVN.Ior9mTCVy3OBhjuPNuqzeC0b9O1Dv4JDvHhiWd3I5xFfCu', 1, 1, 'foto-240507-23ef28048f.jpg'),
(20, 'Bidan Satu', 'Jl. Amarilis', '085878805855', 'bidan', '$2y$10$M7CenMkaX5jB3oYHVVAKoOD6QUU5zOMy6Kiw2IIjPYw3En0sp/gpy', 2, 1, 'foto-240322-6b244e47ed.png'),
(21, 'Bidan Dua', 'Laweyan', '087465738945', 'bidan2', '$2y$10$wFNeUjyg.CzqZYVqmOZQNuxUF6OXGWNKRZaEc9ayqEdO.NWST5Tzm', 2, 1, 'foto-240322-e46a69cd32.png'),
(22, 'TESTES', 'TESTETSETS', '12121212121212', 'tes', '$2y$10$MU4LALQAfT0s2hpF89An8O9lPeNU22Yk42/y2ANTodaTWoMMZH6u2', 2, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kdObat`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`noRm`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`idPeriksa`),
  ADD KEY `periksa_ibfk_2` (`idUser`),
  ADD KEY `noRm` (`noRm`),
  ADD KEY `periksa_ibfk_4` (`noRegistrasi`);

--
-- Indeks untuk tabel `pr_obat`
--
ALTER TABLE `pr_obat`
  ADD KEY `idPeriksa` (`idPeriksa`),
  ADD KEY `idTerapi` (`kdObat`);

--
-- Indeks untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`noRegistrasi`),
  ADD KEY `noRm` (`noRm`),
  ADD KEY `idUser` (`idUser`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `periksa_ibfk_3` FOREIGN KEY (`noRm`) REFERENCES `pasien` (`noRm`),
  ADD CONSTRAINT `periksa_ibfk_4` FOREIGN KEY (`noRegistrasi`) REFERENCES `registrasi` (`noRegistrasi`);

--
-- Ketidakleluasaan untuk tabel `pr_obat`
--
ALTER TABLE `pr_obat`
  ADD CONSTRAINT `pr_obat_ibfk_1` FOREIGN KEY (`idPeriksa`) REFERENCES `periksa` (`idPeriksa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pr_obat_ibfk_2` FOREIGN KEY (`kdObat`) REFERENCES `obat` (`kdObat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `registrasi_ibfk_1` FOREIGN KEY (`noRm`) REFERENCES `pasien` (`noRm`),
  ADD CONSTRAINT `registrasi_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
