-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2016 at 04:49 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firestation`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'kesh', '');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_info`
--

CREATE TABLE IF NOT EXISTS `brgy_info` (
  `pk_brgy` int(11) NOT NULL,
  `brgy_name` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brgy_info`
--

INSERT INTO `brgy_info` (`pk_brgy`, `brgy_name`) VALUES
(1, 'Apas'),
(2, 'Banilad'),
(3, 'Busay'),
(4, 'Capitol Site'),
(5, 'Carreta'),
(6, 'Cogon Ramos'),
(7, 'Day-as'),
(8, 'Ermita'),
(9, 'Hipodromo'),
(10, 'Kalubihan'),
(11, 'Kamagayan'),
(12, 'Camputhaw'),
(13, 'Kasambagan'),
(14, 'Lahug'),
(15, 'Lorega San Miguel'),
(16, 'Luz'),
(17, 'Mabolo'),
(18, 'Pahina Central'),
(19, 'Parian'),
(20, 'Sambag I'),
(21, 'Sambag II'),
(22, 'San Antonio'),
(23, 'San Roque'),
(24, 'Santa Cruz'),
(25, 'Santo Nino'),
(26, 'Talamban'),
(27, 'Tejero'),
(28, 'Tinago'),
(29, 'T. Padilla'),
(30, 'Zapatera'),
(31, 'Adlaon'),
(32, 'Agsungot'),
(33, 'Bacayan'),
(34, 'Binaliw'),
(35, 'Budlaan'),
(36, 'Cambinocot'),
(37, 'Guba'),
(38, 'Lusaran'),
(39, 'Mabini'),
(40, 'Malubog'),
(41, 'Paril'),
(42, 'Pit-os'),
(43, 'Pulangbato'),
(44, 'San Jose'),
(45, 'Sirao'),
(46, 'Taptap'),
(47, 'Basak Pardo'),
(48, 'Basak San Nicolas'),
(49, 'Bulacao'),
(50, 'Calamba'),
(51, 'Cogon Pardo'),
(52, 'Duljo Fatima'),
(53, 'Guadalupe'),
(54, 'Inayawan'),
(55, 'Kinasang-an Pardo'),
(56, 'Labangon'),
(57, 'Mambaling'),
(58, 'Pahina San Nicolas'),
(59, 'Pasil'),
(60, 'Pardo'),
(61, 'Punta Princesa'),
(62, 'Quiot Pardo'),
(63, 'San Nicolas Proper'),
(64, 'Sawang Calero'),
(65, 'Suba'),
(66, 'Tisa'),
(67, 'Babag'),
(68, 'Bonbon'),
(69, 'Buhisan'),
(70, 'Buot Taop'),
(71, 'Kalunasan'),
(72, 'Pamutan'),
(73, 'Pung-ol Sibugay'),
(74, 'Sapangdaku'),
(75, 'Sinsin'),
(76, 'Sudlon I'),
(77, 'Sudlon II'),
(78, 'Tabunan'),
(79, 'Tagbao'),
(80, 'Toong');

-- --------------------------------------------------------

--
-- Table structure for table `categ_info`
--

CREATE TABLE IF NOT EXISTS `categ_info` (
  `pk_categ` int(11) NOT NULL,
  `category_type` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categ_info`
--

INSERT INTO `categ_info` (`pk_categ`, `category_type`) VALUES
(1, 'alpha'),
(2, 'beta'),
(0, 'No Category');

-- --------------------------------------------------------

--
-- Table structure for table `contact_brgy`
--

CREATE TABLE IF NOT EXISTS `contact_brgy` (
  `pk_contact` int(11) NOT NULL,
  `fk_brgy` int(11) NOT NULL,
  `contact` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_brgy`
--

INSERT INTO `contact_brgy` (`pk_contact`, `fk_brgy`, `contact`) VALUES
(1, 1, '4165101'),
(2, 2, '3460385'),
(3, 2, '3185302'),
(4, 3, '2323259'),
(5, 4, '2534284'),
(6, 5, '2311568'),
(7, 6, '2536750'),
(8, 7, '2563168'),
(9, 8, '2555743'),
(10, 8, '2557491'),
(11, 9, '2324765'),
(12, 10, '4184536'),
(13, 11, '4164740'),
(14, 11, '2542556'),
(15, 12, '2551663'),
(16, 13, '2325340'),
(17, 14, '2315262'),
(18, 14, '2339159'),
(19, 15, '4010240'),
(20, 16, '4127475'),
(21, 16, '4169006'),
(22, 17, '2313013'),
(23, 18, '2551655'),
(24, 19, '2545002'),
(25, 19, '4140799'),
(26, 20, '5055011'),
(27, 20, '4155481'),
(28, 21, '2538367'),
(29, 22, '2546734'),
(30, 22, '2530924'),
(32, 24, '4125783'),
(33, 25, '2549250'),
(34, 26, '3441600'),
(35, 27, '2601764'),
(36, 27, '4167227'),
(37, 28, '2563821'),
(38, 29, '2687466'),
(39, 29, '5121846'),
(40, 30, '2540237'),
(41, 31, '5135511'),
(42, 31, '5128362'),
(43, 31, '5128773'),
(44, 32, '5131337'),
(45, 33, '4011927'),
(46, 34, '3185324'),
(47, 35, '09292738287'),
(48, 36, '09286084953'),
(49, 37, '4192342'),
(50, 38, '09474721857'),
(51, 39, '09295076718'),
(52, 40, '09999004786'),
(53, 41, '09186878427'),
(54, 42, '4011894'),
(55, 43, '3165778'),
(56, 43, '3186651'),
(57, 44, '3440765'),
(58, 45, '09214849753'),
(59, 46, '09096893961'),
(60, 47, '4148382'),
(61, 47, '2616842'),
(62, 47, '2987297'),
(63, 48, '4189898'),
(64, 49, '2722193'),
(65, 49, '2721799'),
(66, 50, '2621198'),
(67, 51, '2723211'),
(68, 51, '2736296'),
(69, 52, '4188092'),
(70, 52, '2686935'),
(71, 53, '2547296'),
(72, 53, '2534669'),
(73, 54, '4173505'),
(74, 54, '4163602'),
(75, 55, '4164566'),
(76, 56, '4140445'),
(77, 57, '2628441'),
(78, 57, '2610453'),
(79, 57, '2665099'),
(80, 58, '4188037'),
(81, 59, '2665265'),
(82, 59, '2615229'),
(83, 59, '2665265'),
(84, 60, '2723419'),
(85, 61, '2363974'),
(86, 61, '2664956'),
(87, 62, '2722210'),
(88, 62, '4179505'),
(89, 62, '4228015'),
(90, 63, '4186148'),
(91, 64, '2629078'),
(92, 65, '4183040'),
(93, 65, '4141278'),
(94, 66, '2618000'),
(95, 67, '09277962971'),
(96, 68, '09474721743'),
(97, 69, '2369895'),
(98, 70, '09063701569'),
(99, 71, '2532253'),
(100, 71, '5128859'),
(101, 71, '2362415'),
(102, 72, '09394286339'),
(103, 73, '09197370254'),
(104, 74, '5146524'),
(105, 74, '2365092'),
(106, 74, '5054398'),
(107, 75, '09172752224'),
(108, 76, '5145901'),
(109, 77, '09192824832'),
(110, 78, '09282261979'),
(111, 78, '09466682156'),
(112, 79, '09198299936'),
(113, 80, '09174880419');

-- --------------------------------------------------------

--
-- Table structure for table `contact_substn`
--

CREATE TABLE IF NOT EXISTS `contact_substn` (
  `pk_scontact` int(11) NOT NULL,
  `fk_substn` int(11) NOT NULL,
  `contact` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_substn`
--

INSERT INTO `contact_substn` (`pk_scontact`, `fk_substn`, `contact`) VALUES
(1, 1, '2550785'),
(2, 1, '4172627'),
(3, 2, '2729411'),
(4, 3, '2628530'),
(5, 4, '2539474'),
(6, 5, '2560541'),
(7, 6, '2543655'),
(8, 6, '4106760'),
(9, 7, '2331510'),
(10, 8, '2330501'),
(11, 8, '4172625'),
(12, 9, '4106759');

-- --------------------------------------------------------

--
-- Table structure for table `contact_user`
--

CREATE TABLE IF NOT EXISTS `contact_user` (
  `pk_ucontact` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `contact` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_user`
--

INSERT INTO `contact_user` (`pk_ucontact`, `fk_user`, `contact`) VALUES
(16, 22, '3465416'),
(19, 26, '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `fire_info`
--

CREATE TABLE IF NOT EXISTS `fire_info` (
  `pk_fire` int(11) NOT NULL,
  `fk_loc` int(11) NOT NULL,
  `fk_categ` int(11) NOT NULL,
  `fk_time` int(11) NOT NULL,
  `fk_notif` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fire_info`
--

INSERT INTO `fire_info` (`pk_fire`, `fk_loc`, `fk_categ`, `fk_time`, `fk_notif`) VALUES
(23, 23, 2, 23, 0),
(22, 22, 2, 22, 0),
(21, 21, 0, 21, 0),
(20, 20, 0, 20, 0),
(19, 19, 1, 19, 3),
(24, 24, 1, 24, 0),
(25, 25, 0, 25, 0),
(26, 26, 0, 26, 0),
(27, 27, 0, 27, 0),
(28, 28, 0, 28, 0),
(29, 29, 0, 29, 2),
(30, 30, 0, 30, 0),
(31, 31, 0, 31, 2),
(32, 32, 0, 32, 0),
(33, 33, 0, 33, 0),
(34, 34, 0, 34, 3),
(35, 35, 0, 35, 0),
(36, 36, 0, 36, 0),
(37, 37, 3, 37, 2),
(38, 38, 0, 38, 0),
(39, 39, 0, 39, 0),
(40, 40, 0, 40, 0),
(41, 41, 0, 41, 0),
(42, 42, 0, 42, 0),
(43, 43, 0, 43, 0),
(44, 44, 0, 44, 3),
(45, 45, 0, 45, 0),
(46, 46, 0, 46, 0),
(47, 47, 1, 47, 0),
(48, 48, 1, 48, 0),
(49, 49, 0, 49, 0),
(50, 50, 1, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `location_info`
--

CREATE TABLE IF NOT EXISTS `location_info` (
  `pk_loc` int(11) NOT NULL,
  `fk_brgy` int(11) NOT NULL,
  `brgy_longitude` decimal(12,6) NOT NULL,
  `brgy_latitude` decimal(12,6) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_info`
--

INSERT INTO `location_info` (`pk_loc`, `fk_brgy`, `brgy_longitude`, `brgy_latitude`, `address`) VALUES
(23, 71, '123.877700', '10.355500', 'Cebu Transcentral Hwy'),
(22, 14, '123.889990', '10.333330', 'Doña Modesta Gaisano St'),
(21, 14, '123.899000', '10.333300', 'Bugoy         Bikers'),
(20, 14, '123.899900', '10.333300', 'Marconi St'),
(19, 14, '0.000000', '0.000000', 'Fulton St'),
(24, 12, '123.896494', '10.312843', 'Queen''s Rd'),
(25, 26, '123.911781', '10.354391', 'University of San Carlos'),
(26, 35, '0.000000', '0.000000', 'Mactan St'),
(27, 35, '0.000000', '0.000000', 'Mactan St'),
(28, 35, '0.000000', '0.000000', 'Mactan St'),
(29, 26, '0.000000', '0.000000', 'dsad'),
(30, 35, '0.000000', '0.000000', 'Mactan St'),
(31, 26, '0.000000', '0.000000', 'sdf'),
(32, 35, '0.000000', '0.000000', 'Mactan St'),
(33, 14, '0.000000', '0.000000', 'Doña Modesta Gaisano St'),
(34, 26, '0.000000', '0.000000', 'fghj'),
(35, 11, '0.000000', '0.000000', '252 Junquera St'),
(36, 35, '123.899900', '10.355000', 'Mactan St'),
(37, 26, '0.000000', '0.000000', 'hghjg'),
(38, 35, '123.899000', '10.355500', 'Mactan St'),
(39, 35, '123.899900', '10.355000', 'Mactan St'),
(40, 35, '123.899000', '10.355000', 'Mactan St'),
(41, 35, '123.899000', '10.355000', 'Mactan St'),
(42, 35, '123.899000', '10.355000', 'Mactan St'),
(43, 14, '123.890000', '10.333000', 'Doña Modesta Gaisano St'),
(44, 26, '0.000000', '0.000000', 'hgyu'),
(45, 35, '123.899000', '10.355000', 'Mactan St'),
(46, 71, '123.876500', '10.345000', 'Kalunasan'),
(47, 35, '123.899000', '10.355500', 'Mactan St'),
(48, 26, '123.919540', '10.367280', 'Hiway 77'),
(49, 26, '123.919540', '10.367280', 'Hiway 77'),
(50, 26, '123.919540', '10.367280', 'Hiway 77');

-- --------------------------------------------------------

--
-- Table structure for table `notif_info`
--

CREATE TABLE IF NOT EXISTS `notif_info` (
  `pk_notif` int(11) NOT NULL,
  `notification_type` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notif_info`
--

INSERT INTO `notif_info` (`pk_notif`, `notification_type`) VALUES
(0, 'Device'),
(1, 'Walk-in'),
(2, 'Phonecall'),
(3, 'Radio');

-- --------------------------------------------------------

--
-- Table structure for table `responsesubstn_info`
--

CREATE TABLE IF NOT EXISTS `responsesubstn_info` (
  `pk_respondsubstn` int(11) NOT NULL,
  `fk_substn` int(11) NOT NULL,
  `fk_fire` int(11) NOT NULL,
  `arvl_time` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responsesubstn_info`
--

INSERT INTO `responsesubstn_info` (`pk_respondsubstn`, `fk_substn`, `fk_fire`, `arvl_time`) VALUES
(46, 4, 23, '2014-11-01 04:45:40'),
(45, 4, 22, '2014-11-01 04:39:33'),
(44, 4, 21, '2016-02-29 07:21:21'),
(43, 2, 21, '2016-02-29 07:20:58'),
(42, 4, 20, '2016-02-29 05:44:06'),
(41, 6, 19, '2016-02-29 05:39:13'),
(47, 4, 24, '2016-03-04 08:52:36'),
(48, 4, 25, '2016-03-04 08:57:19'),
(49, 4, 26, '2016-03-05 06:05:35'),
(50, 4, 26, '2016-03-05 06:05:03'),
(51, 4, 27, '2016-03-05 06:28:39'),
(52, 4, 28, '2016-03-05 06:31:44'),
(53, 4, 29, '2016-03-05 06:32:07'),
(54, 4, 30, '2016-03-05 06:37:12'),
(55, 4, 31, '2016-03-05 06:57:07'),
(56, 4, 32, '2016-03-05 07:42:28'),
(57, 4, 34, '2016-03-05 16:03:08'),
(58, 4, 35, '2016-03-05 16:10:44'),
(59, 4, 36, '2016-03-05 16:14:52'),
(60, 4, 37, '2016-03-05 16:15:47'),
(61, 4, 42, '2016-03-05 17:11:11'),
(62, 4, 43, '2016-03-05 17:14:34'),
(63, 4, 44, '2016-03-05 21:46:42'),
(64, 4, 45, '2016-03-07 22:49:53'),
(65, 4, 46, '2016-03-21 08:55:59'),
(66, 4, 47, '2016-03-21 14:55:16'),
(67, 2, 47, '2016-03-21 14:55:18'),
(68, 9, 48, '2016-03-22 10:11:50'),
(69, 8, 48, '2016-03-22 10:12:39'),
(70, 9, 49, '2016-03-22 15:13:39'),
(71, 8, 49, '2016-03-22 15:13:19'),
(72, 9, 50, '2016-03-24 10:06:14'),
(73, 8, 50, '2016-03-24 10:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `substn_info`
--

CREATE TABLE IF NOT EXISTS `substn_info` (
  `pk_substn` int(11) NOT NULL,
  `substn_name` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `substn_info`
--

INSERT INTO `substn_info` (`pk_substn`, `substn_name`) VALUES
(1, 'Parian'),
(2, 'Pardo'),
(3, 'San Nicolas'),
(4, 'Guadalupe'),
(5, 'Pahina'),
(6, 'Labangon'),
(7, 'Mabolo'),
(8, 'Lahug'),
(9, 'Talamban');

-- --------------------------------------------------------

--
-- Table structure for table `time_info`
--

CREATE TABLE IF NOT EXISTS `time_info` (
  `pk_time` int(11) NOT NULL,
  `notif_time` datetime NOT NULL,
  `resp_time` time NOT NULL,
  `fout_time` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_info`
--

INSERT INTO `time_info` (`pk_time`, `notif_time`, `resp_time`, `fout_time`) VALUES
(23, '2014-11-01 04:44:29', '00:01:11', '2014-11-01 04:46:16'),
(22, '2014-11-01 04:38:24', '00:01:09', '2014-11-01 04:39:50'),
(21, '2016-02-29 07:20:46', '00:00:12', '2016-02-29 07:21:12'),
(20, '2016-02-29 05:44:04', '00:00:02', '2016-02-29 05:44:07'),
(19, '2016-02-29 05:39:11', '00:00:02', '2016-02-29 05:39:14'),
(24, '2016-03-04 08:52:23', '00:00:13', '2016-03-04 08:52:41'),
(25, '2016-03-04 08:57:15', '00:00:04', '2016-03-04 08:57:24'),
(26, '2016-03-05 06:04:56', '00:00:07', '2016-03-05 06:04:59'),
(27, '2016-03-05 06:28:37', '00:00:02', '2016-03-05 06:28:40'),
(28, '2016-03-05 06:31:43', '00:00:01', '2016-03-05 06:31:45'),
(29, '2016-03-05 06:32:06', '00:00:01', '2016-03-05 06:32:09'),
(30, '2016-03-05 06:37:08', '00:00:04', '2016-03-05 06:37:13'),
(31, '2016-03-05 06:57:05', '00:00:02', '2016-03-05 06:57:08'),
(32, '2016-03-05 07:42:27', '00:00:01', '2016-03-05 07:42:29'),
(33, '2016-03-05 15:18:08', '00:00:00', '2016-03-05 15:18:09'),
(34, '2016-03-05 16:03:06', '00:00:02', '2016-03-05 16:03:06'),
(35, '2016-03-05 16:10:42', '00:00:02', '2016-03-05 16:10:45'),
(36, '2016-03-05 16:14:52', '00:00:00', '2016-03-05 16:14:53'),
(37, '2016-03-05 16:15:46', '00:00:01', '2016-03-05 16:15:49'),
(38, '2016-03-05 16:19:16', '00:00:00', '2016-03-05 16:19:17'),
(39, '2016-03-05 16:58:27', '00:00:00', '2016-03-05 16:58:28'),
(40, '2016-03-05 17:05:21', '00:00:00', '2016-03-05 17:05:21'),
(41, '2016-03-05 17:06:22', '00:00:00', '2016-03-05 17:06:52'),
(42, '2016-03-05 17:10:31', '00:00:00', '2016-03-05 17:10:31'),
(43, '2016-03-05 17:14:23', '00:00:11', '2016-03-05 17:14:24'),
(44, '2016-03-05 21:46:35', '00:00:07', '2016-03-05 21:46:35'),
(45, '2016-03-07 22:49:50', '00:00:03', '2016-03-07 22:49:51'),
(46, '2016-03-21 08:55:57', '00:00:02', '2016-03-21 08:55:57'),
(47, '2016-03-21 14:55:14', '00:00:02', '2016-03-21 14:55:29'),
(48, '2016-03-22 10:11:20', '00:00:30', '2016-03-22 10:12:24'),
(49, '2016-03-22 15:11:51', '00:01:28', '2016-03-22 15:12:35'),
(50, '2016-03-24 10:05:46', '00:00:28', '2016-03-24 10:06:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brgy_info`
--
ALTER TABLE `brgy_info`
  ADD PRIMARY KEY (`pk_brgy`);

--
-- Indexes for table `categ_info`
--
ALTER TABLE `categ_info`
  ADD PRIMARY KEY (`pk_categ`);

--
-- Indexes for table `contact_brgy`
--
ALTER TABLE `contact_brgy`
  ADD PRIMARY KEY (`pk_contact`);

--
-- Indexes for table `contact_substn`
--
ALTER TABLE `contact_substn`
  ADD PRIMARY KEY (`pk_scontact`);

--
-- Indexes for table `contact_user`
--
ALTER TABLE `contact_user`
  ADD PRIMARY KEY (`pk_ucontact`);

--
-- Indexes for table `fire_info`
--
ALTER TABLE `fire_info`
  ADD PRIMARY KEY (`pk_fire`);

--
-- Indexes for table `location_info`
--
ALTER TABLE `location_info`
  ADD PRIMARY KEY (`pk_loc`);

--
-- Indexes for table `notif_info`
--
ALTER TABLE `notif_info`
  ADD PRIMARY KEY (`pk_notif`);

--
-- Indexes for table `responsesubstn_info`
--
ALTER TABLE `responsesubstn_info`
  ADD PRIMARY KEY (`pk_respondsubstn`);

--
-- Indexes for table `substn_info`
--
ALTER TABLE `substn_info`
  ADD PRIMARY KEY (`pk_substn`);

--
-- Indexes for table `time_info`
--
ALTER TABLE `time_info`
  ADD PRIMARY KEY (`pk_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `brgy_info`
--
ALTER TABLE `brgy_info`
  MODIFY `pk_brgy` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `categ_info`
--
ALTER TABLE `categ_info`
  MODIFY `pk_categ` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `contact_brgy`
--
ALTER TABLE `contact_brgy`
  MODIFY `pk_contact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT for table `contact_substn`
--
ALTER TABLE `contact_substn`
  MODIFY `pk_scontact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `contact_user`
--
ALTER TABLE `contact_user`
  MODIFY `pk_ucontact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `fire_info`
--
ALTER TABLE `fire_info`
  MODIFY `pk_fire` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `location_info`
--
ALTER TABLE `location_info`
  MODIFY `pk_loc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `notif_info`
--
ALTER TABLE `notif_info`
  MODIFY `pk_notif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `responsesubstn_info`
--
ALTER TABLE `responsesubstn_info`
  MODIFY `pk_respondsubstn` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `substn_info`
--
ALTER TABLE `substn_info`
  MODIFY `pk_substn` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `time_info`
--
ALTER TABLE `time_info`
  MODIFY `pk_time` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
