-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2020 at 05:26 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ogiri_answer`
--

CREATE TABLE `ogiri_answer` (
  `id_answer` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `question` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `id_user` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ogiri_answer`
--

INSERT INTO `ogiri_answer` (`id_answer`, `id_question`, `question`, `time`, `id_user`, `answer`, `liked`) VALUES
(32, 10, '古くからある身の回りの技術として何がある？どうしたらそれをより「人間らしく」できる？', '2020-10-23 02:19:22', 'taku', '椅子、体の個別の部位のサイズに合わせたオーダーメイド家具', 0),
(33, 3, '先週、いちばん時間のかかった/つらかった作業はなに？どうしたら楽にできる？', '2020-10-23 02:25:09', 'taku', 'クリーニングの出す代行', 0),
(34, 12, '最近優れていると思ったアプリの一番の特徴は？それを自分のプロダクトに活かすなら？', '2020-10-23 02:25:44', 'taku', 'Tinder, スワイプで「楽しく」「継続的に」。他人のアイディアを評価！', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ogiri_answer`
--
ALTER TABLE `ogiri_answer`
  ADD PRIMARY KEY (`id_answer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ogiri_answer`
--
ALTER TABLE `ogiri_answer`
  MODIFY `id_answer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
