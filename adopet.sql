-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 03, 2018 at 07:53 PM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.8-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adopet`
--

-- --------------------------------------------------------

--
-- Table structure for table `adopting`
--

CREATE TABLE `adopting` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `apply_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adopting`
--

INSERT INTO `adopting` (`id`, `post_id`, `bidder_id`, `message`, `apply_at`, `status`) VALUES
(14, 14, 6, 'Hi\r\n\r\n\r\ntest', '2018-06-29 11:56:28', 1),
(15, 7, 6, 'Sadasdsadsa\r\ndas\r\ndasdasdasd\r\naasdad', '2018-06-30 03:30:55', 0),
(16, 12, 2, 'adadadsadasdsadadsadasdsd', '2018-07-13 03:29:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_pet`
--

CREATE TABLE `category_pet` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_pet`
--

INSERT INTO `category_pet` (`id`, `name`, `parent_id`) VALUES
(8, 'Cat', NULL),
(9, 'Dog', NULL),
(10, 'Anggora', 8),
(11, 'Persia', 8),
(12, 'Himalaya', 8),
(13, 'Domestik', 8),
(14, 'Bengal', 8),
(15, 'Munchkin', 8),
(16, 'Sphynx', 8),
(17, 'Domestik', 9),
(18, 'Kintamani', 9),
(19, 'Ajak/Ajag', 9),
(20, 'Bulldog', 9),
(21, 'Akita', 9),
(22, 'Beagle', 9),
(23, 'Belgian Malinois', 9),
(24, 'Boxer', 9),
(25, 'Cihuahua', 9),
(26, 'Dachshund', 9),
(27, 'Doberman Pinscher', 9),
(28, 'Golden Retriever', 9),
(29, 'Labrador Retriever', 9),
(30, 'Korean Jindo', 9),
(31, 'Maltese', 9),
(32, 'Rottweiler', 9),
(33, 'Pekingese', 9),
(34, 'Pomeranian', 9),
(35, 'Shiba Inu', 9),
(36, 'Mini Pinscher', 9),
(37, 'Fish', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `open_adoption_id` int(11) NOT NULL,
  `link_name` text NOT NULL,
  `is_featured` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `open_adoption_id`, `link_name`, `is_featured`) VALUES
(1, 4, 'a87ff679a2f3e71d9181a67b7542122c/3059172a0ff2e774f146a2af8c4c0f59test.jpg', 0),
(2, 4, 'a87ff679a2f3e71d9181a67b7542122c/3059172a0ff2e774f146a2af8c4c0f59yoga.jpg', 0),
(11, 7, '8f14e45fceea167a5a36dedd4bea2543/41578832bc3d3b011e28834b12cd4088.jpg', 0),
(12, 7, '8f14e45fceea167a5a36dedd4bea2543/1c23bb3174f44f0f0dc714e2b0b4f28b.jpg', 0),
(13, 9, '45c48cce2e2d7fbdea1afc51c7c6ad26/11c423f9c975e93a6e58fe7f56fd4ca5.jpg', 0),
(14, 9, '45c48cce2e2d7fbdea1afc51c7c6ad26/1a9598e4df5264446a92390ac940eea0.jpg', 0),
(19, 11, '6512bd43d9caa6e02c990b0a82652dca/f023858a12e8acc7bbd3ea9118ad63ac.jpg', 1),
(20, 11, '6512bd43d9caa6e02c990b0a82652dca/d2d7604413ea1ab40f0ebf8c77dd1181.jpg', 0),
(21, 12, 'c20ad4d76fe97759aa27a0c99bff6710/cf33557f6cb686f8c254efcc70ffe590.jpg', 0),
(22, 12, 'c20ad4d76fe97759aa27a0c99bff6710/c2ebcd203862153fc4b432aa1a868aeb.jpg', 1),
(23, 13, 'c51ce410c124a10e0db5e4b97fc2af39/6e73b9f397abe4cddced8bb2137bc451.jpg', 1),
(24, 14, 'aab3238922bcc25a6f606eb525ffdc56/a0eabb2b6e44d69ac1991912f2a29b70.png', 0),
(25, 14, 'aab3238922bcc25a6f606eb525ffdc56/2aa401b3e78e2af3308cb195d6e6fba0.jpg', 0),
(26, 15, '9bf31c7ff062936a96d3c8bd1f8f2ff3/6e1758f8630a98817e0eab482e94d2dd.jpg', 1),
(27, 14, 'aab3238922bcc25a6f606eb525ffdc56/19259da5b4bb4d2e3db40cf4ee643c84.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_target` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `type` enum('new_bidder','chosen','other') NOT NULL,
  `date` datetime NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `id_target`, `id_post`, `type`, `date`, `seen`) VALUES
(3, 5, 9, 'new_bidder', '2018-06-14 09:40:32', 0),
(4, 2, 14, 'new_bidder', '2018-06-29 23:56:28', 1),
(5, 2, 7, 'new_bidder', '2018-06-30 03:30:55', 1),
(6, 6, 12, 'new_bidder', '2018-07-13 15:29:10', 1),
(7, 2, 12, '', '2018-07-13 15:29:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `open_adoption`
--

CREATE TABLE `open_adoption` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `age` int(11) NOT NULL,
  `description` text NOT NULL,
  `poster_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `category_pet` int(11) NOT NULL,
  `lati` decimal(10,8) NOT NULL,
  `longi` decimal(11,8) NOT NULL,
  `status` int(1) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `open_adoption`
--

INSERT INTO `open_adoption` (`id`, `title`, `gender`, `age`, `description`, `poster_id`, `post_date`, `category_pet`, `lati`, `longi`, `status`, `deleted_at`) VALUES
(1, 'test', 0, 0, 'bnnbnmbm', 2, '2018-04-09', 8, '-6.88802470', '107.61968610', 1, NULL),
(2, 'afasgsga', 0, 0, 'gasgsagasgasgsagsagsag', 2, '2018-04-10', 9, '-6.91746390', '107.61912280', 0, NULL),
(3, 'afasgsga', 0, 0, '<p>m,lnjjhj</p>', 2, '2018-04-20', 37, '-6.91702800', '107.61846400', 1, NULL),
(4, 'hfjfgjddd', 0, 0, '<p>asfafasfaf</p>', 2, '2018-04-20', 37, '-6.91746390', '107.61912280', 1, NULL),
(7, 'kucing', 0, 0, '<p>hgjhghgh</p><p></p><ul><li>nbjnbjgb</li><li>jhgjkgkj</li><li>kgjhg</li></ul><p></p>', 2, '2018-04-20', 12, '-6.88682450', '107.61529510', 0, NULL),
(8, 'adopt cat', 0, 0, '<p>ingin memberi kucing karena terlalu banyak&nbsp;</p>', 5, '2018-04-20', 13, '-6.91746390', '107.61912280', 1, NULL),
(9, 'adopt cat', 0, 0, '<p>Ingin memberi kucing karena terlalu banyak&nbsp;</p>', 5, '2018-04-20', 13, '-6.91746390', '107.61912280', 1, NULL),
(11, 'TESTTT', 0, 0, '<p>atsttttttttttttttttttttttttttttt</p><p>asdasdsada</p><p style=\"text-align: center;\">asdasd</p>asdasd', 2, '2018-05-15', 10, '-6.90573827', '107.58173356', 1, NULL),
(12, 'Persia umur 3bulan', 0, 0, 'OPEN ADOPTION<br>', 6, '2018-05-18', 11, '-6.89219687', '107.61555248', 0, NULL),
(13, 'LABRDAOR', 0, 0, 'OPEN ADOPT<br>', 6, '2018-05-18', 29, '-6.89198385', '107.61597090', 1, NULL),
(14, 'mabruk', 1, 10, 'vbgfhdhfdhdfhfdh', 2, '2018-05-29', 14, '-6.93827210', '107.62736389', 0, NULL),
(15, 'jonha', 1, 3, 'yhgukjhkhjkhj', 7, '2018-05-30', 12, '-6.91790910', '107.60945190', 1, NULL),
(16, 'Mabel', 1, 14, 'She is a nice cat<br>', 6, '2018-07-13', 11, '-6.88604330', '107.61387780', 1, '2018-07-13'),
(17, 'Mabel', 1, 14, 'She is a nice cat<br>', 6, '2018-07-13', 11, '-6.88604330', '107.61387780', 1, '2018-07-13'),
(18, 'Putih', 1, 6, 'punya si umar<br>', 6, '2018-07-13', 10, '-6.91475554', '107.61015064', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `verifyHash` varchar(32) NOT NULL,
  `forgotHash` binary(20) DEFAULT NULL,
  `registOn` date NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `bio` varchar(60) DEFAULT NULL,
  `img` text,
  `lati` decimal(10,8) DEFAULT NULL,
  `longi` decimal(11,8) DEFAULT NULL,
  `notif_new_bidder` tinyint(1) DEFAULT '0',
  `notif_choosen` tinyint(1) NOT NULL DEFAULT '0',
  `notif_new_post` tinyint(1) NOT NULL DEFAULT '0',
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `verifyHash`, `forgotHash`, `registOn`, `active`, `name`, `bio`, `img`, `lati`, `longi`, `notif_new_bidder`, `notif_choosen`, `notif_new_post`, `lang`, `deleted_at`) VALUES
(1, 'asdaaaaaaa', '68a8fd0dce1a3fce46bf7befafb3b380', 'aasdasdgunfahminurhakiki@gmail.com', '8051bc27c99f13ff166b89d4694f33df', NULL, '2018-03-28', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', '0000-00-00'),
(2, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.com', 'f6c36570e9ce65739a3012354855d3fe', NULL, '2018-04-04', 1, 'TESTER', 'asdadsadadsdadsadsd', 'c81e728d9d4c2f636f067f89cc14862c.png', '-6.88686350', '107.61530920', 1, 1, 1, '', NULL),
(4, 'abon', '02fde227fdc7b3aa92798cbbfa91996e', 'abon@gmail.com', 'c256df72de9bbdc9ce65bb533ae75843', NULL, '2018-04-20', 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL),
(5, 'yadi', '098f6bcd4621d373cade4e832627b4f6', 'yadirahmat77@gmail.com', '683989b118df289a836378a43f85ba11', NULL, '2018-04-20', 1, NULL, NULL, NULL, '-6.91746390', '107.61912280', 0, 0, 0, '', NULL),
(6, 'meno', 'b075559d96925fe3c69a36e188a78b69', 'agunfahminurhakiki@gmail.com', '8711b998c5cc0a87ab657b270a2d0c23', NULL, '2018-04-20', 1, NULL, NULL, '1679091c5a880faf6fb5e6087eb1b2dc.png', '-6.91446637', '107.61002091', 0, 1, 0, '', NULL),
(7, 'john', 'b075559d96925fe3c69a36e188a78b69', 'johnlast@gmail.com', '50d5abef97e42b214534dc97168efaaf', 0x6ef72f6b7cf0d5b67f2e566c1bd7a58711ab3241, '2018-05-30', 1, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL),
(8, 'adkalkdjakdalskdjlk', 'b3739da601b699163544be415687a214', 'asdasd@asdasdas.com', 'f7286f2d4e1ba1a9dfb61f943c053305', NULL, '2018-08-03', 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'en', NULL),
(9, 'agunbangke', '71292967d3824d0a6b50b6a9b3c86715', 'agun.fn@gmail.com', 'c463b4f204c696f86546d62e0dfd7cfa', NULL, '2018-08-03', 0, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'en', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopting`
--
ALTER TABLE `adopting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`,`bidder_id`),
  ADD KEY `bidder_id` (`bidder_id`);

--
-- Indexes for table `category_pet`
--
ALTER TABLE `category_pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `open_adoption_id` (`open_adoption_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_target` (`id_target`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `open_adoption`
--
ALTER TABLE `open_adoption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_pet` (`category_pet`),
  ADD KEY `poster_id` (`poster_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopting`
--
ALTER TABLE `adopting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category_pet`
--
ALTER TABLE `category_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `open_adoption`
--
ALTER TABLE `open_adoption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adopting`
--
ALTER TABLE `adopting`
  ADD CONSTRAINT `adopting_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `open_adoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adopting_ibfk_2` FOREIGN KEY (`bidder_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_pet`
--
ALTER TABLE `category_pet`
  ADD CONSTRAINT `category_pet_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `category_pet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`open_adoption_id`) REFERENCES `open_adoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `open_adoption` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`id_target`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `open_adoption`
--
ALTER TABLE `open_adoption`
  ADD CONSTRAINT `open_adoption_ibfk_1` FOREIGN KEY (`poster_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `open_adoption_ibfk_2` FOREIGN KEY (`category_pet`) REFERENCES `category_pet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
