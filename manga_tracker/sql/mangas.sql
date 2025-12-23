-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 11:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manga_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `mangas`
--

DROP TABLE IF EXISTS `mangas`;
CREATE TABLE IF NOT EXISTS `mangas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mangas`
--

INSERT INTO `mangas` (`id`, `title`, `description`, `status`, `cover_image`, `date_added`, `rating`, `user_id`) VALUES
(1, 'Naruto', 'Naruto is an action shonen-manga that came out in 2004 my birth-year and I finished as a child.', 'Completed', '91RpwagB7uL._AC_UF1000,1000_QL80_.jpg', '2025-12-13 01:44:07', 4, 1),
(2, 'Tokyo Ghoul: re', 'my favorite manga, it is the sequel to tokyo ghoul following Haise Sasaki, after the incident of the Owl Suppression.', 'Completed', 'MV5BNmJkZjUyYjItNjM1MC00YTU1LTgwNjMtMDA4YjdlYzc4MWQzXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg', '2025-12-13 02:07:35', 5, 1),
(3, 'Tokyo Revengers', 'Extremely good story but the problem with this manga was that after the tenjuku arc it hyper focused on the rescuing of mikey instead of the initial plotline.', 'Dropped', '91fvgvLqJML._UF1000,1000_QL80_.jpg', '2025-12-13 02:49:53', 2, 1),
(4, 'Chainsaw Man part one', 'After just seeing the Reze(arc) movie I reignited my love for chainsaw man so I had to add it to this list. Chainsaw man part one is a magnificent read which touches on things such as childhood trauma, hypersexuality within teenage boys as-well as presents the reader with extremely detailed artwork and a compelling story. One of my favorite manga to this day.', 'Completed', '81s8xJUzWGL._AC_UF1000,1000_QL80_.jpg', '2025-12-13 03:31:35', 5, 1),
(5, 'Vagabond', 'I ended Vagabond around chapter 86, it was a great read but the plot seemed a little repetitive for me at where I stopped in the manga. But the main problem for me was when I discovered it was ended abruptly while going on hiatus which thereafter led to me discontinuing my read.', 'Dropped', 'Vagabond_(manga)_vol._1.png', '2025-12-13 03:32:35', NULL, 1),
(6, 'Kaiju No. 8', 'I READ THIS MANGA AT 3 CHAPTERS LOL. This came out on shonen jump+ 3 or 4 years ago and I picked it up because the volume one cover was insane. I have yet to watch the anime and plan to get back into reading it but because I was so early keeping up weekly really got out of hand.', 'Reading', 'Kaiju_No_8.jpg', '2025-12-13 03:33:56', NULL, 1),
(8, 'Demon Slayer', 'Demon slayer was a manga I picked up in 2019-2020, although the mangas art-style is cute it sometimes makes combat look very confusing and underwhelming which the anime compensates for immensely.', 'Completed', '9781974700523_p0_v1_s1200x630.jpg', '2025-12-13 03:38:58', NULL, 1),
(20, 'sd', 'sd', 'Reading', 'unfilledfavorite.png', '2025-12-22 04:40:06', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
