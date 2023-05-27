-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 مايو 2023 الساعة 21:37
-- إصدار الخادم: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web4`
--

-- --------------------------------------------------------

--
-- بنية الجدول `profile`
--

CREATE TABLE `profile` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `admin` int(1) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `profile`
--

INSERT INTO `profile` (`id`, `username`, `Email`, `Password`, `admin`, `created_at`, `Image`) VALUES
(4, 'admin', 'f@gmail.com', '123456789', 1, '2023-05-26', '2023-05-2613-50-48f8284c7581fbd7e31dab630087998cf3.jpg'),
(5, 'samy', 'f@gmail.com', '123456789', 0, '2023-05-26', '2023-05-2616-15-38f8284c7581fbd7e31dab630087998cf3.jpg'),
(6, 'faisal2', 'f@gmail.com', '123456789', 0, '2023-05-26', '2023-05-2616-16-1218c909e3704d9c82ee00a980d35519cc.jpg'),
(7, 'asem', 'fa@gmail.com', '123456789', 0, '2023-05-26', '2023-05-2616-17-26f8284c7581fbd7e31dab630087998cf3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`,`created_at`),
  ADD UNIQUE KEY `id` (`id`,`created_at`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
