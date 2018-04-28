-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2018 at 05:21 AM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.1.16-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_mibd`
--

-- --------------------------------------------------------

--
-- Table structure for table `kasus`
--

CREATE TABLE `kasus` (
  `id` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `klien_id` int(11) NOT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) NOT NULL,
  `closed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `kasus_lengkap`
-- (See below for the actual view)
--
CREATE TABLE `kasus_lengkap` (
`id` int(11)
,`nama` varchar(256)
,`closed_at` datetime
,`klien_id` int(11)
,`klien_nama` varchar(128)
,`klien_email` varchar(128)
,`klien_username` varchar(128)
,`klien_role` varchar(50)
,`karyawan_id` int(11)
,`karyawan_nama` varchar(128)
,`karyawan_email` varchar(128)
,`karyawan_username` varchar(128)
,`karyawan_role` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'generic kasus');

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `konten` varchar(512) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `pesan_lengkap`
-- (See below for the actual view)
--
CREATE TABLE `pesan_lengkap` (
`id` int(11)
,`konten` varchar(512)
,`created_at` datetime
,`kasus_id` int(11)
,`klien_id` int(11)
,`user_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `kasus_lengkap`
--
DROP TABLE IF EXISTS `kasus_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kasus_lengkap`  AS  (select `kasus`.`id` AS `id`,`kasus`.`nama` AS `nama`,`kasus`.`closed_at` AS `closed_at`,`kl`.`id` AS `klien_id`,`kl`.`name` AS `klien_nama`,`kl`.`email` AS `klien_email`,`kl`.`username` AS `klien_username`,`kl`.`role` AS `klien_role`,`ky`.`id` AS `karyawan_id`,`ky`.`name` AS `karyawan_nama`,`ky`.`email` AS `karyawan_email`,`ky`.`username` AS `karyawan_username`,`ky`.`role` AS `karyawan_role` from ((((`kasus` left join `user` `ky` on((`ky`.`id` = `kasus`.`karyawan_id`))) join `klien` on((`klien`.`id_user` = `kasus`.`klien_id`))) join `user` `kl` on((`klien`.`id_user` = `kl`.`id`))) join `kategori` on((`kategori`.`id` = `kasus`.`kategori_id`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `pesan_lengkap`
--
DROP TABLE IF EXISTS `pesan_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pesan_lengkap`  AS  select `pesan`.`id` AS `id`,`pesan`.`konten` AS `konten`,`pesan`.`created_at` AS `created_at`,`pesan`.`kasus_id` AS `kasus_id`,`klien`.`id` AS `klien_id`,`pesan`.`user_id` AS `user_id` from (`pesan` left join `klien` on((`klien`.`id_user` = `pesan`.`user_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kasus`
--
ALTER TABLE `kasus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klien` (`klien_id`),
  ADD KEY `karyawan` (`karyawan_id`),
  ADD KEY `kategori` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klien_rel` (`id_user`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kasus` (`kasus_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kasus`
--
ALTER TABLE `kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `klien`
--
ALTER TABLE `klien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kasus`
--
ALTER TABLE `kasus`
  ADD CONSTRAINT `karyawan` FOREIGN KEY (`karyawan_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `klien` FOREIGN KEY (`klien_id`) REFERENCES `klien` (`id`);

--
-- Constraints for table `klien`
--
ALTER TABLE `klien`
  ADD CONSTRAINT `klien_rel` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `kasus` FOREIGN KEY (`kasus_id`) REFERENCES `kasus` (`id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
