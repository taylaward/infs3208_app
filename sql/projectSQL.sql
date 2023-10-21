-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2023 at 05:30 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'INFS3203'),
(2, 'DECO2500'),
(3, 'CSSE 3012'),
(4, 'Deco0000');

-- --------------------------------------------------------

--
-- Table structure for table `email_auth`
--

CREATE TABLE `email_auth` (
  `email` varchar(60) NOT NULL,
  `token` varchar(100) NOT NULL,
  `validated` tinyint(1) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_auth`
--

INSERT INTO `email_auth` (`email`, `token`, `validated`, `id`) VALUES
('tayla.r.ward@outlook.com', '1a32e805333f817ef53e5c76eb28abd7', 1, 10),
('tward221@eq.edu.au', '135d55cad5cb2dfe8218ad4fc500fb4d', 1, 11),
('lol@lol.com', '5f999774b6f2983bebad4862eb4b4b5a', 1, 12),
('test2@test.com', '8bb005b4a56d93e2b966ce314726936f', 1, 13),
('ardepy@outlook.com', '39a67c4f395505f2bfc34fc60669ff8d', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`) VALUES
(34, 9, 17),
(31, 10, 17),
(28, 11, 21);

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `pin_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(40) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `category_id`, `title`, `body`, `user_id`) VALUES
(9, 1, 'HELLOOOOO EVERYONE', 'Today\r\n\r\n\r\nI\r\n\r\n\r\nDid\r\n\r\n\r\nINFS', 17),
(10, 1, 'sup', 'Lorem ipsum ', 17),
(11, 1, 'HELLOOOO EVERYONE', 'Lorem ipsum', 21),
(13, 1, 'LAtin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, \r\n\r\nsed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', 17),
(14, 1, 'Another latin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 17),
(15, 1, 'Latin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\n\r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 17),
(16, 1, 'Latin again?!?!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \r\n\r\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. \r\n\r\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. \r\nExcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 17),
(17, 1, 'Test', 'kshdbv;bV;KAERBV', 17),
(18, 1, 'ANOTHER', 'KSDJBVLAEDHBFVLAEJBFRV', 17),
(19, 1, 'TEST', 'ASDJHVBLAHBFVLA.E', 17);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `reply_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `body` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`reply_id`, `post_id`, `user_id`, `body`) VALUES
(16, 9, 17, 'hello'),
(17, 9, 17, 'hi there'),
(19, 9, 21, 'hiiii'),
(20, 9, 21, 'hi lol'),
(21, 10, 17, 'hey'),
(22, 11, 21, 'YEAH girl'),
(23, 9, 17, 'haha\n'),
(24, 10, 17, 'hello'),
(25, 10, 17, 'today'),
(26, 9, 17, 'hello world');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint UNSIGNED NOT NULL,
  `username` varchar(41) NOT NULL,
  `email` varchar(30) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sec_one` varchar(40) NOT NULL,
  `sec_one_ans` varchar(40) NOT NULL,
  `sec_two` varchar(40) NOT NULL,
  `sec_two_ans` varchar(40) NOT NULL,
  `pfp_filename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mobile_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `first_name`, `last_name`, `mobile_number`, `status`, `type`, `password`, `sec_one`, `sec_one_ans`, `sec_two`, `sec_two_ans`, `pfp_filename`, `mobile_verified`) VALUES
(6, 'test', 'test@test.com', '', '', '', 0, 0, '$2y$10$Xl04XynDCIxpa0pfikkEt.0ir.95SjbrxId.j/TObSiMr3wPXh9QK', '', '', '', '', '', 0),
(17, 'tay', 'tayla.r.ward@outlook.com', 'JaeWon', 'Yun', '', 1, 0, '$2y$10$2VUwpE.1ZgiAAD95EE.aveOaW3x0p7rTbK6Nu5Hwo1I.jITm/hL5a', '', '', '', '', '/project/writable/pfp/1683103953_d19da23edd34c29e2019.jpg', 0),
(18, 'tayyy', 'tward221@eq.edu.au', '', '', '', 0, 0, '$2y$10$JPp2zJNXGRnrUNnUt5dTG.sPV2/vSdgnOP1ljfWIUN6hnEYOmjoDS', '', '', '', '', '', 0),
(19, 'lol', 'lol@lol.com', '', '', '', 0, 0, '$2y$10$YyEckB0/tec.fWO/jHudE.uEWLcOt.wCDf0.GGDoDwExQ5fvZkz6S', '', '', '', '', '', 0),
(20, 'test2', 'test2@test.com', '', '', '', 0, 0, '$2y$10$8GT/0znVWQ5RgPEURCqbCulgo78qFq9S24q5yhtr9HNsW44maO1LS', '', '', '', '', '', 0),
(21, 'tayy', 'ardepy@outlook.com', '', '', '', 0, 0, '$2y$10$q1jsIWdMQVnD1QqBJkn4dOVbfOgABSOdg1l9tjrjGX7jwNNnwuJ2y', '', '', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`);

--
-- Indexes for table `email_auth`
--
ALTER TABLE `email_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `like_id` (`like_id`),
  ADD KEY `post_id` (`post_id`,`user_id`),
  ADD KEY `user_fk1` (`user_id`);

--
-- Indexes for table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`pin_id`),
  ADD UNIQUE KEY `pin_id` (`pin_id`),
  ADD KEY `post_id` (`post_id`,`user_id`),
  ADD KEY `user_fk2` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD UNIQUE KEY `reply_id` (`reply_id`),
  ADD KEY `user_fk3` (`user_id`),
  ADD KEY `post_fk2` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users` (`user_id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_auth`
--
ALTER TABLE `email_auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `pin_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `post_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pins`
--
ALTER TABLE `pins`
  ADD CONSTRAINT `post_fk1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `post_fk2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_fk3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
