-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2016 at 08:54 PM
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
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(11) NOT NULL,
  `subreddit_id` int(11) DEFAULT NULL,
  `title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `is_plain_content` tinyint(1) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
(17, 'science', 'The Science subreddit is a place to share new findings. Read about the latest advances in astronomy, biology, medicine, physics and the social sciences. Find and submit the best writeup on the web about a discovery, and make sure it cites its sources.', 21),
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
  `subreddit_id` int(11) DEFAULT NULL,
  `subscriberscol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `c_c_fk1_idx` (`parent_id`), ADD KEY `c_u_fk2_idx` (`author_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subreddits`
--
ALTER TABLE `subreddits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `c_c_fk1` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `c_u_fk2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
