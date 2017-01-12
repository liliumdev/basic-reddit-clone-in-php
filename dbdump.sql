-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2017 at 11:11 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `basicreddit`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` int(11) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `content`, `author_id`, `created_at`, `post_id`, `votes`) VALUES
(6, NULL, 'jojoj', 1, '2017-01-08 23:56:58', 9, 3),
(7, NULL, 'nice comment bro', 4, '2017-01-09 00:47:12', 9, 2),
(8, NULL, 'feh', 4, '2017-01-09 00:52:44', 9, 1),
(9, NULL, 'qqqqqq', 4, '2017-01-09 00:58:37', 9, 1),
(10, NULL, 'geeg', 4, '2017-01-09 01:00:42', 7, 2),
(11, NULL, 'efef', 4, '2017-01-09 01:00:44', 7, 1),
(12, NULL, '@liliumdev meni fin komentar jel?', 1, '2017-01-09 01:02:08', 9, 1),
(13, NULL, 'nope it aint funneh', 4, '2017-01-09 01:06:12', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `subreddit_id` int(11) DEFAULT NULL,
  `title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `is_plain_content` tinyint(1) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `comments` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `votes`, `subreddit_id`, `title`, `content`, `is_plain_content`, `author_id`, `comments`, `created_at`) VALUES
(7, 2, 14, 'fefe', 'feef', NULL, 1, 2, '2017-01-08 23:34:16'),
(8, 3, 14, 'heeheh', 'eheheheh', NULL, 1, 0, '2017-01-08 23:34:19'),
(9, 2, 14, 'megfeg', 'egegeg', NULL, 1, 5, '2017-01-09 00:47:06'),
(10, 0, 14, 'eheheh', 'afsfasf', NULL, 4, 0, '2017-01-08 23:34:36'),
(11, 1, 14, 'heheh', 'eheheh', NULL, 1, 0, '2017-01-08 23:44:21'),
(12, 1, 15, 'innit funny', 'a joke heheheh haha', NULL, 4, 1, '2017-01-09 01:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `subreddits`
--

CREATE TABLE IF NOT EXISTS `subreddits` (
`id` int(11) NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscribers` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `subreddits`
--

INSERT INTO `subreddits` (`id`, `title`, `description`, `subscribers`) VALUES
(14, 'AskBRCIP', '/r/AskBRCIP is the place to ask and answer thought-provoking questions.', 29),
(15, 'funny', 'reddit''s largest humour depository', 27),
(16, 'todayilearned', 'You learn something new every day; what did you learn today? Submit interesting and specific facts about something that you just found out here.', 24),
(17, 'science', 'The Science subreddit is a place to share new findings. Read about the latest advances in astronomy, biology, medicine, physics and the social sciences. Find and submit the best writeup on the web about a discovery, and make sure it cites its sources.', 22),
(18, 'pics', '100% BETTER QUALITY THAN /R/ASKBRCIP', 19),
(19, 'worldnews', 'A place for major news from around the world, excluding US-internal news.', 17),
(20, 'IAmA', 'I Am A, where the mundane becomes fascinating and the outrageous suddenly seems normal.', 16),
(21, 'gaming', 'A subreddit for (almost) anything related to games - video games, board games, card games, etc. (but not sports).', 15),
(22, 'videos', 'A great place for video content of all kinds.', 15),
(23, 'movies', 'News and Discussion about Major Motion Pictures', 11),
(24, 'copia', 'ppor ccoasfpsof just testing', 10),
(25, 'nsfw', 'not safe for work', 9);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subreddit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `user_id`, `subreddit_id`) VALUES
(11, 1, 14),
(12, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$5M11PkqqsP4Jdyxf.N2EeOyYM.tPZGtbhlhtjKKpA.E7AVIOEzEXa', 'ahmed.popovic@gmail.com'),
(4, 'liliumdev', '$2y$10$.owFakVi05PZPMmvIKpo8OM1MI3Fg4SNwj2LWaW5NpK0bSSLwLdfi', 'skydesign04@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_comment_votes`
--

CREATE TABLE IF NOT EXISTS `user_comment_votes` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_comment_votes`
--

INSERT INTO `user_comment_votes` (`id`, `user_id`, `comment_id`, `value`) VALUES
(1, 4, 6, 1),
(2, 4, 7, -1),
(3, 4, 10, 1),
(4, 1, 6, 1),
(5, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_votes`
--

CREATE TABLE IF NOT EXISTS `user_votes` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user_votes`
--

INSERT INTO `user_votes` (`id`, `user_id`, `post_id`, `value`) VALUES
(8, 4, 7, 1),
(9, 4, 8, 1),
(10, 1, 7, -1),
(11, 1, 8, 1),
(12, 1, 9, 1),
(13, 4, 12, 1),
(14, 4, 10, -1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `c_c_fk1_idx` (`parent_id`), ADD KEY `c_u_fk2_idx` (`author_id`), ADD KEY `c_u_fk3_idx` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD KEY `p_u_fk1_idx` (`author_id`), ADD KEY `p_s_fk2_idx` (`subreddit_id`);

--
-- Indexes for table `subreddits`
--
ALTER TABLE `subreddits`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
 ADD PRIMARY KEY (`id`), ADD KEY `s_u_fk1_idx` (`user_id`), ADD KEY `s_s_fk2_idx` (`subreddit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_comment_votes`
--
ALTER TABLE `user_comment_votes`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_10_idx` (`comment_id`), ADD KEY `fk_11_idx` (`user_id`);

--
-- Indexes for table `user_votes`
--
ALTER TABLE `user_votes`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_user_vote_user_idx` (`user_id`), ADD KEY `fk_user_vote_post_idx` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `subreddits`
--
ALTER TABLE `subreddits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_comment_votes`
--
ALTER TABLE `user_comment_votes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_votes`
--
ALTER TABLE `user_votes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `c_u_fk2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `c_u_fk3` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `p_s_fk2` FOREIGN KEY (`subreddit_id`) REFERENCES `subreddits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `p_u_fk1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
ADD CONSTRAINT `s_s_fk2` FOREIGN KEY (`subreddit_id`) REFERENCES `subreddits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `s_u_fk1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_comment_votes`
--
ALTER TABLE `user_comment_votes`
ADD CONSTRAINT `fk_10` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_11` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_votes`
--
ALTER TABLE `user_votes`
ADD CONSTRAINT `fk_user_vote_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_user_vote_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
