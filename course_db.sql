-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 06:29 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`user_id`, `playlist_id`) VALUES
('q4KzKFM7TpwkF0j1gIg4', 'CwmtQz0Q5Iok2UirVWoC');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark2`
--

CREATE TABLE `bookmark2` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark3`
--

CREATE TABLE `bookmark3` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark4`
--

CREATE TABLE `bookmark4` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Development'),
(2, 'Business'),
(3, 'Design'),
(4, 'Marketing'),
(5, 'Music'),
(6, 'Photography'),
(7, 'Software'),
(8, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `number`, `message`) VALUES
(5, 'indar', 'indarxpro@gmail.com', '085891143660', 'test'),
(6, 'ahmad', 'ahmad@gmail.com', '085891143660', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `yt` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `tutor_id`, `playlist_id`, `title`, `yt`, `description`, `video`, `thumb`, `date`, `status`) VALUES
('DLmUpWtB2706aNnGbFM8', 'uFRb8iVirCDtIVBYDuVu', 'rNpQmmL869SaUQEUWr57', 'Menginstal Linux', '', 'Test\r\nLink yt : https://youtu.be/52Gg9CqhbP8?feature=shared', 'PCCHv96xP1TGivTpeAGX.mp4', '1aSRBFVnSpvNPQOLLBGy.jpg', '2023-10-17', 'active'),
('pP8QC5VDDETtL2HLcBhA', 'uFRb8iVirCDtIVBYDuVu', 'rNpQmmL869SaUQEUWr57', 'test', '', 'test', 'mYOVwXcXjqJpM0o0oaie.mp4', '5NThvaJAWKfh9onqp4B0.jpg', '2023-10-24', 'active'),
('hiVl4iWq4OxbfIZ8M9et', 'uFRb8iVirCDtIVBYDuVu', 'Udi66RYjp51KI2E7woQB', 'test', '', 'test', 'VL5Nt5uP7KoiK1O5oEPT.mp4', 'Y9jSvNd6DR9BxuZhRnp9.gif', '2023-10-24', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `cv_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cv_file_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`cv_id`, `user_id`, `name`, `cv_file_name`, `created_at`) VALUES
(79, '0XHcxRBGzenVxTdDIZlE', '1', 'RWhFa3OrGHfDOwyVQufQ.pdf', '2023-10-23 16:23:20'),
(80, 'q4KzKFM7TpwkF0j1gIg4', '2', 'ccDmkl9odBX1cCr09A1X.pdf', '2023-10-23 16:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `kursus_bayar`
--

CREATE TABLE `kursus_bayar` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  `materi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kursus_gratis`
--

CREATE TABLE `kursus_gratis` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  `materi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kursus_gratis`
--

INSERT INTO `kursus_gratis` (`id`, `tutor_id`, `title`, `link`, `tema`, `description`, `thumb`, `date`, `status`, `materi`) VALUES
('C3jZptBP3rX3a8IWwPRP', 'uFRb8iVirCDtIVBYDuVu', 'Linux', 'http://localhost/project/kursus3.php?get_id=rNpQmmL869SaUQEUWr57', 'Menginstal Distro', 'test', '7gAaOekCTSTAUNDJlg5N.jpg', '2023-10-04', 'active', 'tets'),
('seaDTrxlFJPSRIp744mr', 'uFRb8iVirCDtIVBYDuVu', 'Kursus TKJ', 'http://localhost/project/kursus3.php?get_id=zzOdm9yujMSXs8PXy1Pn', 'Dasar jaringan', 'kursus ini untuk anak - anak TKJ', 'UL8qSZ4jAnc0iNa8RABn.gif', '2023-10-23', 'active', 'Pelajari ....');

-- --------------------------------------------------------

--
-- Table structure for table `kursus_gratis2`
--

CREATE TABLE `kursus_gratis2` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `materi1` longtext NOT NULL,
  `materi2` longtext NOT NULL,
  `materi3` longtext NOT NULL,
  `materi4` longtext NOT NULL,
  `materi5` longtext NOT NULL,
  `materi6` longtext NOT NULL,
  `materi7` longtext NOT NULL,
  `materi8` longtext NOT NULL,
  `materi9` longtext NOT NULL,
  `materi10` longtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `thumb` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `j1` varchar(100) NOT NULL,
  `j2` varchar(100) NOT NULL,
  `j3` varchar(100) NOT NULL,
  `j4` varchar(100) NOT NULL,
  `j5` varchar(100) NOT NULL,
  `j6` varchar(100) NOT NULL,
  `j7` varchar(100) NOT NULL,
  `j8` varchar(100) NOT NULL,
  `j9` varchar(100) NOT NULL,
  `j10` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kursus_gratis2`
--

INSERT INTO `kursus_gratis2` (`id`, `tutor_id`, `title`, `materi1`, `materi2`, `materi3`, `materi4`, `materi5`, `materi6`, `materi7`, `materi8`, `materi9`, `materi10`, `date`, `thumb`, `image`, `status`, `j1`, `j2`, `j3`, `j4`, `j5`, `j6`, `j7`, `j8`, `j9`, `j10`) VALUES
('rNpQmmL869SaUQEUWr57', 'uFRb8iVirCDtIVBYDuVu', 'Menginstal Linux', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n2. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of\r\n\r\n3.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-10-14', 'qB1lVUS174ky78hyww6f.jpg', '', 'active', 'Install dan download Virtual Machine', 'Install distro virtual machine', 'Setting Aplikasi Virtual machine', 'Tambahkan Mesin baru Sesuai os distro', 'Tambahkan Os yang ingin di install', 'Setting Os distro', 'Setting Aplikasi Os ', 'Install os distro', 'Seting jaringan eternet', 'Jalankan aplikasi');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `content_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` varchar(20) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `tema` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `tutor_id`, `title`, `link`, `tema`, `description`, `thumb`, `date`, `status`) VALUES
('Udi66RYjp51KI2E7woQB', 'uFRb8iVirCDtIVBYDuVu', 'Lowongan kerja OPERATOR PRODUKSI Mirea Food BOGOR', 'https://g.co/kgs/Fm3WTK', ' OPERATOR PRODUKSI Mirea Food BOGOR', 'OPERATOR PRODUKSI\r\n\r\nKualifikasi:\r\n• Pria / Wanita\r\n• Pendidikan min. SMA/SMK semua jurusan\r\n• Usia maks. 27 tahun\r\n• Pengalaman min. 1 tahun di manufacturing (produksi makanan diutamakan)\r\n• Mampu berkomunikasi dengan baik\r\n• Cepat tanggap dan teliti\r\n• Bersedia bekerja shift\r\n• Domisili di Cibinong\r\n• Penempatan Cibinong Kab. Bogor\r\n\r\nSend your application to:\r\n\r\nLihat alamat email di karirbogor.com\r\nwith subject:\r\nOP_Nama_Domisili', 'tdcldcwqpk8ores92q8T.png', '2023-10-02', 'active'),
('mcUrxnDNCMSgzk8XduC8', 'uFRb8iVirCDtIVBYDuVu', 'Lowongan kerja Mitra Programmer', 'https://g.co/kgs/d6N552', '(Front-End Developer)', 'Front end developer adalah seseorang yang bertanggung jawab untuk merancang dan membuat aplikasi atau situs web yang user-friendly, responsif, dan interaktif. Meningkatkan pengalaman baik untuk pengguna saat menggunakan aplikasi atau website tersebut selalu menjadi tujuan pekerjaanya.,\r\nMelakukan Perancangan Database. ...\r\nMeningkatkan Struktur Data yang Telah Ada. ...\r\nMerancang Alur Website/Aplikasi. ...\r\nCoding dan Melakukan Testing. ...\r\nMengatur Keamanan Website/Aplikasi. ...\r\nMengatasi masalah yang Muncul di Back End. ...\r\nRiset dan Evaluasi Terhadap Tampilan Desain Website/Aplikasi.', 'lOUp8Hq8NZzzBAEDgUS4.png', '2023-10-04', 'active'),
('CwmtQz0Q5Iok2UirVWoC', 'uFRb8iVirCDtIVBYDuVu', 'Direct Sales BCA Finance - Penempatan Bogor', 'https://g.co/kgs/BFS8Bg', 'Direct Sales BCA Finance', 'Deskripsi kerja :\r\n• Memasarkan produk serta memperluas pasar jaringan BCA Finance melalui telepon\r\n• Melakukan survey dan analisa data kelayakan konsumen\r\n• Menjalin relasi dan hubungan baik dengan rekanan BCA Finance\r\nKualifikasi:\r\n• Pendidikan D3/S1, IPK minimal 2,5 (Terbuka untuk semua jurusan)\r\n• Usia maksimal 24 tahun\r\n• Penempatan di BCA Finance Cabang Bogor', 'NLysVwWMZSwTUL44tEUJ.png', '2023-10-04', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `reset_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reset_password`
--

INSERT INTO `reset_password` (`id`, `email`, `token`, `reset_time`) VALUES
(27, 'indarxpro@gmail.com', '1dc286860965d6379af6d447c5eb4d0aa6b4f55545f7c421f0f33e80bcd7a4c1', 1698042657);

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `name`, `profession`, `email`, `password`, `image`) VALUES
('uFRb8iVirCDtIVBYDuVu', 'Loker Account', 'lawyer', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'gETcjteh2yL16HrluVMv.png'),
('Bqwm4SPSWNvcCbc9MLvl', 'Loker Jakarta', 'lawyer', 'admin2@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1oTvb3enWmDryQGEp2E8.gif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `reset_token`, `reset_token_expiration`) VALUES
('iYjCUPjyg3FuvcEjSJD0', 'indar', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'gj8pdhGJEqTsegO0JwTV.jpeg', NULL, NULL),
('q4KzKFM7TpwkF0j1gIg4', 'indar', 'admin2@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'K91toO7F7FrELTnN3gSr.jpeg', NULL, NULL),
('6eYlXMfnM5HYX7NbRyde', 'pak prass', 'pesat@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'NB9qrrxKqQphw2r2ND4n.jpg', NULL, NULL),
('mOIaVYLdIx10Zlj46oNV', 'udin', 'udin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'uY3VPoWQ8YHQd8NAhyPu.png', NULL, NULL),
('sELu0BXJ1Pg1rSw5hx8d', 'sueb', 'ajg@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'bXaJMXIzruliUD2yqJgj.gif', NULL, NULL),
('I2CL5CeImonWqDXBLLjt', 'indar', 'indar@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ws1abTUa4lKhbngeYUfU.jpg', NULL, NULL),
('kdaqGgQAgIHxEY0feegl', 'mamah', 'emak@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '8oVCOhXNjKO3RRfq1wZK.png', NULL, NULL),
('INEmUiCOla2BT9iP0js0', 'anjay', 'anjay@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2s8t7CHtsEPp5RGFHfMy.jpeg', NULL, NULL),
('ttIgcuNYnQmzbJoWTirX', 'Prasetyo Laksono', 'smkit.pesat@gmail.co', '16c484fa06492a613a9ea29000a5f9352f110cd2', 'oGunukfGAr9NR7G3eejP.jpg', NULL, NULL),
('0XHcxRBGzenVxTdDIZlE', 'indar', 'indarxpro@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'QEVFqlJHdpwhupSDdswX.png', NULL, NULL),
('nHI4AvMniSU3s0YrNDda', 'Indar2', 'indarahda23@gmail.com', 'e1d5bbcf1b34d55e35978656c120694e6cfebf7c', 'sdk603YSZpQXyRBr3zla.jpeg', NULL, NULL),
('e50tJUu8zmSjDKiNWNG6', 'anon', 'anonimusus44@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Y4PoLwSCyI0Xpg3K9cZZ.png', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`cv_id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `cv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
