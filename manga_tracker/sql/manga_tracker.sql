-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2025 at 07:29 AM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `manga_id` int(11) NOT NULL,
  `author_user_id` int(11) DEFAULT NULL,
  `author_name` varchar(60) DEFAULT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `manga_id`, `author_user_id`, `author_name`, `body`, `created_at`) VALUES
(5, 24, 4, NULL, 'test msg from dummy acc on jiles profile', '2025-12-22 17:04:45'),
(17, 24, 1, NULL, 'sds', '2025-12-24 15:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `directmessages`
--

CREATE TABLE `directmessages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp(),
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directmessages`
--

INSERT INTO `directmessages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`, `read_at`) VALUES
(1, 1, 5, 'hi', '2025-12-25 15:20:51', '2025-12-25 15:21:18'),
(2, 5, 1, 'hi', '2025-12-25 15:21:21', '2025-12-25 15:26:39'),
(3, 1, 5, 'hiiii', '2025-12-25 15:37:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `addressee_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected','blocked') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `responded_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `requester_id`, `addressee_id`, `status`, `created_at`, `responded_at`) VALUES
(1, 5, 4, 'accepted', '2025-12-24 14:18:08', '2025-12-24 14:31:58'),
(6, 6, 4, 'accepted', '2025-12-24 16:34:03', '2025-12-24 16:37:44'),
(7, 1, 6, 'rejected', '2025-12-24 17:11:39', '2025-12-24 17:58:14'),
(8, 5, 1, 'accepted', '2025-12-24 17:26:16', '2025-12-24 17:30:38'),
(9, 4, 1, 'pending', '2025-12-24 17:26:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mangas`
--

CREATE TABLE `mangas` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` tinyint(4) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(23, 'Jujutsu Kaisen', 'Jujutsu Kaisen (JJK), follows teenage boy Yuji Itadori who is in a world that harbors cursed spirits. He becomes a jujutsu sorcerer and works with his friends and sensei, Gojo Satoru to track down all the fingers of the curse that possesses his body Sukuna. this is arguably my top 3 manga ever it is amazingly written and the adaptation is nothing to scoff at.', 'Completed', 'cover_6949db1bc5e757.13539695.jpg', '2025-12-22 23:58:19', 5, 1),
(24, 'My Hero Academia', 'this is an anime that got me back into watching anime in 2016. I loved the story telling of the early seasons and the end half really brought everything back together.', 'Completed', 'cover_6949dbd98ca2b4.76374121.jpg', '2025-12-23 00:01:29', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_hash`) VALUES
(1, 'jiles', '$2y$10$NoUc0ouPw1rcMVBd/46oIOEuKhjr6BYHFypqVs73fitUbvc6eKRBe', '$2y$10$5ucuERrJEtv/gYqAknm30O4ftWVOwCRlZDXrzljIuRMrspj8hlRn2'),
(4, 'username1', '', '$2y$10$NEhI88cPV3RV8nlCV.pjbeD.4qs1Z4eB.F7NuFefYMeBcNDrwz7N.'),
(5, 'username2', '', '$2y$10$D74fGfT9czwKBb4zqo/MqeD6vn7oGpaISxIGNUMxKuWGHel6tMZC2'),
(6, 'username3', '', '$2y$10$UyE2NtgmnqpUOEzNMf77KOR20y8enRpRTidbfgKcsJMTvSqSUR5YK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manga_id` (`manga_id`),
  ADD KEY `author_user_id` (`author_user_id`);

--
-- Indexes for table `directmessages`
--
ALTER TABLE `directmessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sender_receiver` (`sender_id`,`receiver_id`,`sent_at`),
  ADD KEY `idx_receiver_sender` (`receiver_id`,`sender_id`,`sent_at`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_request` (`requester_id`,`addressee_id`),
  ADD KEY `idx_requester` (`requester_id`,`status`),
  ADD KEY `idx_addressee` (`addressee_id`,`status`);

--
-- Indexes for table `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `directmessages`
--
ALTER TABLE `directmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mangas`
--
ALTER TABLE `mangas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_manga` FOREIGN KEY (`manga_id`) REFERENCES `mangas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_user` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `directmessages`
--
ALTER TABLE `directmessages`
  ADD CONSTRAINT `fk_dm_receiver` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_dm_sender` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `fk_friends_addressee` FOREIGN KEY (`addressee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_friends_requester` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
