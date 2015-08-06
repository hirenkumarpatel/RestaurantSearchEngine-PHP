-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2014 at 08:20 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurantsearchengine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) NOT NULL,
  `admin_email` varchar(40) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_photo` varchar(60) NOT NULL,
  `code` varchar(100) NOT NULL,
  `admin_user_name` varchar(30) NOT NULL,
  `admin_flag` int(1) NOT NULL DEFAULT '0',
  `admin_gender` varchar(6) NOT NULL,
  `admin_phone` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_photo`, `code`, `admin_user_name`, `admin_flag`, `admin_gender`, `admin_phone`) VALUES
(1, 'Hiren Patel', 'hirenpatel18591@gmail.com', 'ec560dff9aaf87483e469b6abd8cd50c', 'hiren.png', 'ec560dff9aaf87483e469b6abd8cd50c', 'hirenpatel185', 1, 'male', '(079) 382-3838'),
(2, 'Bhushan', 'bhushan@gmail.com', '68053af2923e00204c3ca7c6a3150cf7', '', '', '', 0, 'male', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_log_track`
--

CREATE TABLE IF NOT EXISTS `admin_log_track` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_email` varchar(40) NOT NULL,
  `log_ip` varchar(15) NOT NULL,
  `log_status` int(1) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `admin_log_track`
--

INSERT INTO `admin_log_track` (`log_id`, `log_email`, `log_ip`, `log_status`, `log_date`) VALUES
(1, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 00:49:02'),
(2, 'hirenpatel@gmail.com', '::1', 0, '2014-03-03 00:47:38'),
(3, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 00:48:07'),
(4, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 05:00:46'),
(5, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 05:04:54'),
(6, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 05:07:11'),
(7, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-03 05:08:18'),
(8, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 05:08:47'),
(9, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 19:23:10'),
(10, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-03 19:47:34'),
(11, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-19 22:38:14'),
(12, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-19 22:38:25'),
(13, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-19 22:39:54'),
(14, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-20 07:16:15'),
(15, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-20 07:16:21'),
(16, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-20 07:16:27'),
(17, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-20 07:17:21'),
(18, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-20 07:17:43'),
(19, 'hirenpatel.project@gmail.com', '::1', 1, '2014-03-20 19:42:42'),
(20, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-21 06:18:09'),
(21, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-21 06:18:19'),
(22, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 06:20:10'),
(23, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 07:13:45'),
(24, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 07:14:05'),
(25, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 07:16:00'),
(26, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 07:16:07'),
(27, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 20:02:46'),
(28, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 20:42:36'),
(29, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 20:43:01'),
(30, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 20:43:07'),
(31, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-21 20:44:56'),
(32, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-21 20:45:04'),
(33, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 20:45:09'),
(34, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-21 21:34:23'),
(35, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 21:34:28'),
(36, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-21 22:48:08'),
(37, '', '::1', 0, '2014-03-22 18:22:35'),
(38, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-22 19:53:00'),
(39, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 19:53:09'),
(40, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-22 19:53:16'),
(41, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 20:01:34'),
(42, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 20:01:47'),
(43, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 20:02:04'),
(44, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-22 20:02:10'),
(45, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-22 22:19:43'),
(46, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:20:01'),
(47, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:25:48'),
(48, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:25:53'),
(49, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:26:03'),
(50, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-22 22:26:13'),
(51, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:28:43'),
(52, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:31:36'),
(53, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-22 22:47:44'),
(54, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-22 22:47:52'),
(55, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-23 01:10:16'),
(56, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 01:10:26'),
(57, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 01:52:25'),
(58, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:11:50'),
(59, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-23 02:17:24'),
(60, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:17:30'),
(61, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:24:17'),
(62, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:28:38'),
(63, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:29:54'),
(64, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:31:32'),
(65, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:32:23'),
(66, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:49:24'),
(67, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 02:50:22'),
(68, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 20:43:57'),
(69, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 20:46:15'),
(70, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-23 21:04:20'),
(71, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 21:04:30'),
(72, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-23 23:02:05'),
(73, 'hiren_patel18591@yahoo.com', '::1', 1, '2014-03-24 03:20:40'),
(74, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-24 20:06:13'),
(75, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-24 20:06:21'),
(76, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-24 20:15:20'),
(77, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-24 20:16:03'),
(78, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-24 20:16:31'),
(79, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-24 20:16:39'),
(80, 'sharewebtricks@gmail.com', '::1', 0, '2014-03-24 20:27:21'),
(81, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-24 20:28:46'),
(82, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-24 22:15:38'),
(83, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-24 22:15:52'),
(84, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-24 22:20:54'),
(85, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-24 22:22:07'),
(86, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-25 04:49:24'),
(87, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-25 21:19:26'),
(88, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-25 23:19:30'),
(89, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-26 20:06:17'),
(90, 'hirenpatel.project@gmail.com', '::1', 0, '2014-03-26 20:39:57'),
(91, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-26 20:40:04'),
(92, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-27 00:01:05'),
(93, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-27 00:01:14'),
(94, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-27 00:01:25'),
(95, 'bhushan@gmail.com', '::1', 0, '2014-03-27 00:01:45'),
(96, 'hirenpatel185@gmail.com', '::1', 1, '2014-03-27 00:02:46'),
(97, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-27 19:57:37'),
(98, 'hirenpatel185', '::1', 1, '2014-03-27 19:59:46'),
(99, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-27 20:00:29'),
(100, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-27 21:01:42'),
(101, 'hirenpatel185', '::1', 1, '2014-03-27 21:01:55'),
(102, 'hirenpatel185', '::1', 0, '2014-03-27 21:02:34'),
(103, 'hirenpatel185', '::1', 1, '2014-03-27 21:02:43'),
(104, 'hirenpatel185', '::1', 1, '2014-03-27 23:09:08'),
(105, 'hirenpatel18591@gmail.com', '::1', 0, '2014-03-30 21:08:00'),
(106, 'hiren_patel18591@yahoo.com', '::1', 0, '2014-03-30 21:08:08'),
(107, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-30 21:08:15'),
(108, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-30 23:18:27'),
(109, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-31 06:45:47'),
(110, 'hirenpatel18591@gmail.com', '::1', 1, '2014-03-31 21:21:05'),
(111, 'hirenpatel18591@gmail.com', '::1', 1, '2014-04-01 00:46:02'),
(112, 'hirenpatel18591@gmail.com', '::1', 1, '2014-04-01 01:52:51'),
(113, 'hirenpatel18591@gmail.com', '::1', 1, '2014-04-01 20:32:44'),
(114, 'hirenpatel18591@gmail.com', '::1', 0, '2014-04-01 21:30:29'),
(115, 'hirenpatel18591@gmail.com', '::1', 1, '2014-04-01 21:30:37'),
(116, 'hirenpatel18591@gmail.com', '::1', 1, '2014-04-03 05:37:15'),
(117, 'hirenpatel18591@gmail.com', '::1', 1, '2014-04-03 20:03:54'),
(118, 'hirenpatel18591@gmail.com', '::1', 0, '2014-05-16 19:27:10'),
(119, 'hirenpatel18591@gmail.com', '::1', 0, '2014-05-16 19:27:49'),
(120, 'hirenpatel18591@gmail.com', '::1', 0, '2014-05-16 19:27:59'),
(121, 'hirenpatel18591@gmail.com', '::1', 0, '2014-05-16 19:28:42'),
(122, 'hirenpatel18591@gmail.com', '::1', 1, '2014-05-16 19:28:48'),
(123, 'hirenpatel18591@gmail.com', '::1', 1, '2014-05-18 17:55:38'),
(124, 'hirenpatel', '::1', 0, '2014-06-02 16:08:30'),
(125, 'hirenpatel185@gmail.com', '::1', 0, '2014-06-02 16:09:14'),
(126, 'hirenpatel18591@gmail.com', '::1', 0, '2014-06-02 16:09:34'),
(127, 'hirenpatel18591@gmail.com', '::1', 0, '2014-06-02 16:10:33'),
(128, 'hirenpatel18591@gmail.com', '::1', 0, '2014-06-02 16:10:52'),
(129, 'hirenpatel18591@gmail.com', '::1', 1, '2014-06-02 16:11:30'),
(130, 'hirenpatel18591@gmail.com', '::1', 1, '2014-06-02 17:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'Ahmedabad', 1),
(2, 'Gandhinagar', 1),
(3, 'Baroda', 1),
(4, 'Chennai', 6),
(5, 'Pune', 2),
(6, 'Jaipur', 5),
(7, 'Mumbai', 2),
(8, 'kolkata', 4),
(9, 'Delhi', 3),
(10, 'Bangalore', 7),
(11, 'Udaypur', 5),
(12, 'Goa', 8);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` text NOT NULL,
  `review_id` int(11) NOT NULL,
  `foodie_id` int(11) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_text`, `review_id`, `foodie_id`, `comment_date`, `comment_status`) VALUES
(1, 'Nice One dude!', 1, 20, '2014-03-31 15:09:58', 1),
(2, 'Same pinch on that one Bhushan..', 1, 24, '2014-04-01 23:08:58', -1),
(3, 'Good!!', 1, 13, '2014-04-02 00:06:09', 1),
(6, 'Nice one Thanks Bhushan ..\r\nit will help me to choose my restaurant..', 2, 24, '2014-04-02 06:00:07', 1),
(7, '', 0, 3, '2014-04-02 06:44:11', 0),
(8, 'Nice job dude!\r\nThanks..', 10, 3, '2014-04-02 06:44:48', 1),
(9, '', 0, 24, '2014-04-02 19:25:16', 0),
(10, 'great one!', 4, 24, '2014-04-02 19:25:32', 0),
(11, '', 0, 24, '2014-04-02 20:51:40', 0),
(12, 'good!', 7, 24, '2014-04-02 20:51:50', -1),
(13, 'ok', 12, 24, '2014-04-02 20:58:31', 0),
(14, 'nice one!', 6, 24, '2014-04-03 05:36:00', -1),
(15, 'good!', 13, 3, '2014-04-03 20:06:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE IF NOT EXISTS `cuisine` (
  `cuisine_id` int(11) NOT NULL AUTO_INCREMENT,
  `cuisine_name` varchar(30) NOT NULL,
  `cuisine_status` int(1) NOT NULL DEFAULT '0',
  `cuisine_photo` varchar(50) NOT NULL,
  PRIMARY KEY (`cuisine_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`cuisine_id`, `cuisine_name`, `cuisine_status`, `cuisine_photo`) VALUES
(1, 'Gujarati', 1, '15745-gujarati.jpg'),
(2, 'Punjabi', 1, '15043-punjabi11.jpg'),
(3, 'FastFood', 0, '8426-fastfood.jpg'),
(4, 'South Indian', 1, '22588-southindian.jpg'),
(5, 'Chinese', 0, '23940-chinese.jpg'),
(6, 'Mexican', 1, '14701-mexican1.jpg'),
(7, 'Italian', 1, '32731-italian.jpg'),
(9, 'Desserts', 1, '11814-desserts.jpg'),
(11, 'North Indian', 0, '7589-northindian.jpg'),
(12, 'Continental', 1, '8000-continental.jpg'),
(13, 'Jain', 0, '32377-jainfood.jpg'),
(14, 'Pizza', 1, '5498-pizza3.jpg'),
(15, 'Thai', 0, '299-thai.jpg'),
(26, 'French', 1, '18824-french.jpg'),
(27, 'Spanish', 0, ''),
(28, 'Snacks', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_que` varchar(300) NOT NULL,
  `faq_ans` varchar(500) NOT NULL,
  PRIMARY KEY (`faq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `faq_que`, `faq_ans`) VALUES
(1, 'Is Global Cuisine free?', 'Absolutely! Every feature and function you see on it is absolutely free for     \r\n      everyone.\r\n'),
(2, 'Why use Global Cuisine?', 'It helps in selecting the best restaurants according to their locations, budgets, choice of cuisine, ratings among other options. It also acts as a platform for restaurants to increase their visibility and create a brand name for themselves.'),
(3, 'What is a food review?', 'Global Cuisine is a dining guide where food enthusiasts come together to share quality and honest food reviews all over India.\r\nHow to define a quality food review.\r\nYour ratings will not instantly change the score of a restaurant. We will regularly aggregate the ratings from all the reviews and come up with an average score for each item.'),
(4, 'What if I had a bad experience? Can I write a negative review?', 'Absolutely - in fact, we encourage it. Again, Global Cuisine is about telling the  \r\ntruth so that others can make more accurate decisions. Also, the power of the \r\nGlobal Cuisine community may cause a Restaurant owners to think about how to improve their business based on your honest reviews.'),
(5, 'Why is your review put on hold?\r\n', 'The approval of your review varies between a few hours to 2 days at unless it  \r\nhas been rejected.'),
(6, 'Who can see me or my reviews?', 'Everyone can! It is the best way to make sure our community values the truth     \r\n     over all things. Your profile picture, and your first and last name is visible to   \r\n     the entire community. Don''t be afraid to speak the truth. '),
(7, 'What does Global Cuisine do with my private information?', 'We take our foodies privacy very seriously. We do not sell, share, rent, trade, or  \r\n     give away any of your personal information, unless required to do so by the \r\n     law. We hate spam even more than you do.If you feel that your personal privacy \r\n     has been violated in any which way by either the community members or the \r\n     company, please let us know by sending an email.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_to_site`
--

CREATE TABLE IF NOT EXISTS `feedback_to_site` (
  `fb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fb_text` text NOT NULL,
  `fd_id` int(11) NOT NULL,
  PRIMARY KEY (`fb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foodie_been_there`
--

CREATE TABLE IF NOT EXISTS `foodie_been_there` (
  `been_there_id` int(11) NOT NULL AUTO_INCREMENT,
  `foodie_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`been_there_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foodie_detail`
--

CREATE TABLE IF NOT EXISTS `foodie_detail` (
  `foodie_id` int(11) NOT NULL AUTO_INCREMENT,
  `foodie_name` varchar(30) NOT NULL,
  `foodie_email` varchar(50) NOT NULL,
  `foodie_password` varchar(100) NOT NULL,
  `foodie_contact` varchar(10) NOT NULL,
  `foodie_address` varchar(50) NOT NULL,
  `foodie_photo` varchar(50) NOT NULL,
  `foodie_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foodie_status` int(1) NOT NULL DEFAULT '0',
  `foodie_gender` varchar(6) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`foodie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `foodie_detail`
--

INSERT INTO `foodie_detail` (`foodie_id`, `foodie_name`, `foodie_email`, `foodie_password`, `foodie_contact`, `foodie_address`, `foodie_photo`, `foodie_reg_date`, `foodie_status`, `foodie_gender`, `code`) VALUES
(2, 'Jay Patel', 'jaypatel@yahoo.com', 'baba327d241746ee0829e7e88117d4d5', '2147483647', 'Ahmedabad', '', '2014-02-08 22:57:13', 0, '', ''),
(3, 'Neel Joshi', 'neelj.project@gmail.com', 'eac22cf37128b00063a8b2be2589d933', '9632587414', 'Ahmedabad', '', '2014-02-08 23:03:00', 1, '', ''),
(5, 'Keyur Anaghan', 'keyur@gmail.com', '', '9978565478', 'Surat', '', '2014-02-14 21:43:19', 0, '', ''),
(7, 'Riddhi Desai', 'riddhi@yahoo.com', '', '9845741425', 'Gandhinagar', '', '2014-02-14 21:44:49', 0, '', ''),
(8, 'Ganesh Patel', 'ganesh@gmail.com', '', '9999999999', 'Gandhinagar', '', '2014-02-14 21:44:49', 1, '', ''),
(9, 'Nirmala Desai', 'nirmala@yahoo.com', '', '9845741425', 'Ahmedabad', '', '2014-02-14 21:44:54', 0, '', ''),
(11, 'Kumud Desai', 'kumud@yahoo.com', '', '9845741425', 'Gandhinagar', '', '2014-02-14 21:44:54', 0, '', ''),
(12, 'shiv Patel', 'shiv@gmail.com', '', '9988524544', 'Gandhinagar', '', '2014-02-14 21:44:49', 1, '', ''),
(13, 'Himesh Vyas', 'himesh@yahoo.com', '', '9874547854', 'Ahmedabad', '', '2014-02-14 21:44:54', 0, '', ''),
(16, 'Jaymin Patel', 'hiren_patel18591@yahoo.com', 'baba327d241746ee0829e7e88117d4d5', '9631254785', 'Ahmedabad', '', '2014-02-08 22:57:13', 0, '', ''),
(19, 'Alpesh Parmar', 'hiren_patel18591@yahoo.com', 'b877ef72add4184ca02cf2dd8ddf80dd', '9674636257', 'Gandhinagar', '', '2014-03-11 22:43:30', 1, '', 'd85029b484f93a9e5b316022e521f3dc'),
(20, 'Bhushan Jadhav', 'hiren_patel18591@yahoo.com', 'cf1852c25f0fad4d1c0eb5f71e3fe5cb', '', 'Ahmedabad', 'bhushan.jpg', '2014-03-12 00:27:37', 0, '', '12c807db8cbc201d0d1afc0e31671158'),
(21, 'Kirtan Patel', 'hirenpatel18591@gmail.com', '98ba7779dd2f7362f676269e00d677b6', '', 'Surat', '', '2014-03-12 00:32:38', 1, '', 'b13a8f618a37d9f2e0c11ad6bf0c45eb'),
(22, 'krunal Parikh', 'levapatelcommunity@yahoo.com', 'ad0fd5e338f9223b99a187edd9dbfa90', '', 'Surat', '', '2014-03-12 19:15:25', 1, '', '99484b473a648ce05837b9c07c1b78a4'),
(23, 'Dhruv Dave', 'hirenpatel18591@gmail.com', '1eba9614763773df08dd49049663c3e3', '9836634231', 'Gandhinagar', '', '2014-03-12 20:50:35', 1, '', 'b9bdd8e2b99c1e6b70941253818665fa'),
(24, 'Hiren Patel', 'hirenpatel185@gmail.com', 'ec560dff9aaf87483e469b6abd8cd50c', '9834343434', 'Gandhinagar', 'hiren.png', '2014-03-12 23:08:32', 1, '', '403ce3db1dac65daa0bab5e12282a66c');

-- --------------------------------------------------------

--
-- Table structure for table `foodie_favorite`
--

CREATE TABLE IF NOT EXISTS `foodie_favorite` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `foodie_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`favorite_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `foodie_favorite`
--

INSERT INTO `foodie_favorite` (`favorite_id`, `foodie_id`, `rest_id`) VALUES
(1, 20, 3),
(2, 3, 3),
(3, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `foodie_wish_list`
--

CREATE TABLE IF NOT EXISTS `foodie_wish_list` (
  `wish_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `foodie_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`wish_list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `foodie_wish_list`
--

INSERT INTO `foodie_wish_list` (`wish_list_id`, `foodie_id`, `rest_id`) VALUES
(1, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `locality`
--

CREATE TABLE IF NOT EXISTS `locality` (
  `locality_id` int(11) NOT NULL AUTO_INCREMENT,
  `locality_name` varchar(30) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`locality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `locality`
--

INSERT INTO `locality` (`locality_id`, `locality_name`, `city_id`) VALUES
(1, 'Naroda', 1),
(2, 'Bapunagar', 1),
(3, 'Lal daravaja', 1),
(4, 'Ellish Bridge', 1),
(5, 'Navarang Pura', 1),
(6, 'CTM', 1),
(7, 'Sector 15', 2),
(8, 'Sector 2', 2),
(9, 'Sector 21', 2),
(11, 'Noida', 9),
(12, 'Ghaziabad', 9),
(13, 'Thane Area', 7),
(14, 'Mira Road', 7),
(15, 'Vasai', 7),
(16, 'Bandra', 7),
(17, 'howra', 8),
(18, 'karelibage', 3),
(19, 'purasawakkam', 4),
(20, 'somwarpath', 5),
(21, 'chinchwad', 5),
(22, 'thatipur', 6),
(23, 'subhashchowk', 6),
(24, 'chamarajpet', 10),
(25, 'kilariroad', 10),
(29, 'bopal', 0),
(30, 'Sarakhej', 1),
(32, 'S.G. Highway', 1),
(33, 'Sector 28', 2),
(34, 'Thaltej', 1),
(35, 'Bodakdev', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` int(11) NOT NULL,
  `foodie_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`rating_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rate`, `foodie_id`, `rest_id`) VALUES
(1, 4, 1, 1),
(2, 3, 2, 1),
(3, 2, 3, 1),
(4, 4, 1, 3),
(5, 3, 2, 4),
(6, 4, 2, 5),
(7, 4, 4, 6),
(8, 3, 5, 7),
(9, 3, 3, 1),
(10, 4, 24, 13),
(11, 3, 24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_detail`
--

CREATE TABLE IF NOT EXISTS `restaurant_detail` (
  `rest_id` int(11) NOT NULL AUTO_INCREMENT,
  `rest_name` varchar(50) NOT NULL,
  `rest_address` text NOT NULL,
  `rest_contact` varchar(15) NOT NULL,
  `rest_cost` int(5) NOT NULL,
  `rest_payment` varchar(30) NOT NULL,
  `rest_reservation` varchar(25) NOT NULL,
  `rest_time1_on` time NOT NULL,
  `rest_time1_off` time NOT NULL,
  `rest_time2_on` time NOT NULL,
  `rest_time2_off` time NOT NULL,
  `city_id` int(11) NOT NULL,
  `locality_id` int(11) NOT NULL,
  `rest_seo_name` varchar(20) NOT NULL,
  `rest_mobile` varchar(15) NOT NULL,
  `rest_cuisine_id` varchar(50) NOT NULL,
  `rest_air_con` int(1) NOT NULL DEFAULT '0',
  `rest_wifi` int(1) NOT NULL DEFAULT '0',
  `rest_live_music` int(1) NOT NULL DEFAULT '0',
  `rest_candle_light` int(1) NOT NULL DEFAULT '0',
  `rest_parking` int(1) NOT NULL DEFAULT '0',
  `rest_dine_in` int(1) NOT NULL DEFAULT '0',
  `rest_delivery` int(1) NOT NULL DEFAULT '0',
  `rest_catering` int(1) NOT NULL DEFAULT '0',
  `rest_take_away` int(1) NOT NULL DEFAULT '0',
  `rest_pure_veg` int(1) NOT NULL DEFAULT '0',
  `rest_bar` int(1) NOT NULL DEFAULT '0',
  `rest_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rest_owner` varchar(30) NOT NULL,
  `rest_email` varchar(30) NOT NULL,
  `rest_website` varchar(50) NOT NULL,
  `rest_status` int(1) NOT NULL DEFAULT '0',
  `rest_visit_counter` bigint(20) NOT NULL,
  `rest_password` varchar(60) NOT NULL,
  `code` varchar(100) NOT NULL,
  `rest_map` varchar(600) NOT NULL,
  PRIMARY KEY (`rest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `restaurant_detail`
--

INSERT INTO `restaurant_detail` (`rest_id`, `rest_name`, `rest_address`, `rest_contact`, `rest_cost`, `rest_payment`, `rest_reservation`, `rest_time1_on`, `rest_time1_off`, `rest_time2_on`, `rest_time2_off`, `city_id`, `locality_id`, `rest_seo_name`, `rest_mobile`, `rest_cuisine_id`, `rest_air_con`, `rest_wifi`, `rest_live_music`, `rest_candle_light`, `rest_parking`, `rest_dine_in`, `rest_delivery`, `rest_catering`, `rest_take_away`, `rest_pure_veg`, `rest_bar`, `rest_reg_date`, `rest_owner`, `rest_email`, `rest_website`, `rest_status`, `rest_visit_counter`, `rest_password`, `code`, `rest_map`) VALUES
(1, 'Food Fiesta', 'Naroda,Ahmedabad', '(234) 343-4343', 500, 'credit_card,cash', 'Not Required', '11:30:00', '02:30:00', '17:30:00', '22:30:00', 1, 1, 'Food Fiesta', '', '1,3', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2014-06-02 18:05:32', 'Navajivandas Patel', '', 'www.foodfst.com', 1, 2, 'ec560dff9aaf87483e469b6abd8cd50c', '', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3672.0615004495357!2d72.581496!3d23.021514!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e844dbbfe4513%3A0x6c754673b2e543d2!2sFood+Fiesta!5e0!3m2!1sen!2s!4v1401667443496'),
(3, 'Gordhan Thal', 'Gordhan Thal,S.G highway,Ahmedabad', '(079) 565-5636', 500, 'CreditCard,Cash', 'Recommended', '09:30:00', '01:30:00', '06:30:00', '11:30:00', 1, 5, 'Gordhan Thal', '9567565656', '1,2,11', 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, '2014-06-02 18:06:10', 'vivek Thakkar', 'hirenpatel18591@gmail.com', 'www.gordhanthal.com', 1, 83, 'ec560dff9aaf87483e469b6abd8cd50c', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58749.28597497193!2d72.58000000000001!3d23.029999599999964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9adf42075037%3A0x2cb6312ed98e2c92!2sGordhan+Thal!5e0!3m2!1sen!2s!4v1400439864501'),
(4, 'Aura', 'Aura,Bopal,Ahmedabad', '(079) 452-3445', 400, 'CreditCard,Cash', 'Recommended', '09:30:00', '01:30:00', '04:30:00', '11:30:00', 1, 29, 'Aura', '9567565675', '1,2,3,5,6', 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 0, '2014-06-02 18:08:05', 'avinash Patil', 'avinash_patel12@gmail.com', 'www.aura.com', 1, 0, 'ec560dff9aaf87483e469b6abd8cd50c', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29374.837504859912!2d72.46538315000001!3d23.029107049999972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b0b10521dd7%3A0xd5da2d91989498fc!2sAura+Restaurant!5e0!3m2!1sen!2s!4v1401667644293'),
(5, 'Mirch masala', 'Mirch masala', '(079) 634-3435', 600, 'CreditCard,Cash', 'Recommended', '09:36:00', '09:36:00', '09:36:00', '09:36:00', 1, 5, 'Mirch masala', '9675675675', '1,2,3,4,5', 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, '2014-06-02 18:09:49', 'Mr.karan Mehta', 'mirch_masala@gmail.com', 'www.mirchmasala.com', 1, 4, 'ec560dff9aaf87483e469b6abd8cd50c', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117498.57194994371!2d72.58000000000001!3d23.029999599999964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b4e73108d37%3A0x4358693dea3c2b9e!2sMirch+Masala!5e0!3m2!1sen!2s!4v1401667766840'),
(6, 'Rajwadu', 'Rajwadu,Ahmedabad', '(079) 454-3434', 700, 'CreditCard,Cash', 'Not Required', '09:42:00', '09:42:00', '09:42:00', '09:42:00', 1, 5, 'Rajwadu', '9567565675', '1,2', 1, 0, 0, 0, 1, 1, 0, 1, 0, 1, 0, '2014-06-02 18:11:33', 'Mr.rajesh Trivedi', 'rj@gmail.com', 'www.rjwdu.com', 1, 510, 'ec560dff9aaf87483e469b6abd8cd50c', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.5638098496715!2d72.53998499999999!3d23.003062000000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e852314f59d05%3A0xc03bb94d0c1624d9!2sRajwadu!5e0!3m2!1sen!2s!4v1401667846052'),
(7, 'Madhurya', 'Bopal,Ambli,Ahmedabad.', '(079) 345-3363', 500, 'CreditCard,Cash', 'Not Required', '09:00:00', '12:30:00', '06:00:00', '12:00:00', 1, 29, 'Madhuray', '9757575566', '1,2,5', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2014-06-02 18:11:14', 'Mr.chirag', 'ch@gmail.com', 'www.md.com', 1, 2, 'ec560dff9aaf87483e469b6abd8cd50c', '', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3671.7366696442446!2d72.467224!3d23.033439!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b9bffffffff%3A0x96c9f21fc2c6146!2sMadhurya!5e0!3m2!1sen!2s!4v1401667942499'),
(8, 'Pizza Zone', 'Kush Society,\r\nNear  naroda canal,\r\nNaroda,\r\nAhmedabad', '(079) 452-34550', 300, 'Cash', 'Not Required', '10:00:00', '01:00:00', '04:00:00', '11:00:00', 1, 1, 'PizzaZone', '', '14', 1, 0, 0, 0, 0, 1, 1, 0, 1, 1, 0, '2014-06-02 18:11:06', 'Hiren Patel', 'hirenpatel18591@gmail.com', 'www.pizzazone.com', 1, 2, 'ec560dff9aaf87483e469b6abd8cd50c', '03a6b18c0f88fcc88dba1f3dfb19c1a5', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3670.5479202010683!2d72.664062!3d23.077030000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e80d5be59513f%3A0xc8f2dcd51b91237f!2sPizza+Zone!5e0!3m2!1sen!2s!4v1400407520146'),
(9, 'surbhi Restaurant', 'Near Baroda Highway,\r\nCTM,\r\nAhmedabad', '(079) 452-3465', 400, 'CreditCard,Cash', 'Not Required', '09:30:00', '12:30:00', '05:00:00', '11:30:00', 1, 6, 'surabhi Restaurant', '9856478542', '1,2,4,', 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, '2014-06-02 18:10:41', 'Jay Vasani', 'hirenpatel18591@gmail.com', 'www.surabhi.co.in', 0, 0, 'ec560dff9aaf87483e469b6abd8cd50c', '588b4324d37dbfda0d2a75f0277ad450', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29374.642987485928!2d72.58000000000001!3d23.029999599999964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e867115555555%3A0xdc77cb0495440ccb!2sSurabhi+Restaurant!5e0!3m2!1sen!2s!4v1401668083899'),
(12, 'Pakavan', 'Circle B Complex,First Floor,Sarkhej Gandhinagar Highway,Bodakdev,\nAhmedabad', '+91 9979558620', 800, 'Cash', 'Not Required', '11:15:00', '02:00:00', '06:30:00', '11:15:00', 1, 35, 'Pakavan', '9874521023', '1,2,4,13', 1, 0, 0, 1, 1, 1, 0, 1, 1, 1, 0, '2014-06-02 18:12:18', 'Pankajbhai Jain', 'hiren_patel18591@yahoo.com', '', 1, 0, 'ec560dff9aaf87483e469b6abd8cd50c', '7c882f7c7be3a87cefc7b6dcb22d41ca', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.082060903205!2d72.57003999999996!3d23.020758999999963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e845458304747%3A0xa8e78abfdefef06e!2sPakwan+Dining+Hall!5e0!3m2!1sen!2s!4v1401668194890'),
(13, 'Qwiches', 'Maharaja Complex,\r\nOpposite Upper Crust,\r\nVijay Cross Road,\r\nNavrangpura,\r\nAhmedabad', '+91 9898230140', 650, 'Cash', 'Not Required', '10:00:00', '12:00:00', '07:00:00', '11:00:00', 1, 5, 'Qwiches', '9854785412', '1,3,4,5,7,14,', 1, 1, 0, 0, 0, 1, 1, 1, 0, 1, 1, '2014-06-02 18:12:55', 'Dhiren Pandya', 'hiren_patel18591@yahoo.com', 'www.qwiches.in', 1, 5, 'ec560dff9aaf87483e469b6abd8cd50c', '875b5c2ac9b2f8dffaca47c48232333a', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3671.5336275365053!2d72.548986!3d23.040889999999997!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84946ea63bfd%3A0xc1d029553da1b8bf!2sQwiches!5e0!3m2!1sen!2s!4v1401668300973');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_menu`
--

CREATE TABLE IF NOT EXISTS `restaurant_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `rest_menu` varchar(50) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `restaurant_menu`
--

INSERT INTO `restaurant_menu` (`menu_id`, `rest_menu`, `rest_id`) VALUES
(1, '898-27268-rajwadu3.JPG', 1),
(2, '22679-vintage1.jpg', 3),
(3, '7859-17005-mirch_masala1.JPG', 4),
(5, '16453-11938-mirch_masala2.JPG', 5),
(6, '22679-rajwadu2.JPG', 6),
(7, '1197-pakvan1.JPG', 12),
(8, '27268-vintage2.jpg', 3),
(9, '8687-qwiches2.jpg', 13),
(10, '19575-vintage3.jpg', 3),
(11, '25570-qwiches1.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_photo`
--

CREATE TABLE IF NOT EXISTS `restaurant_photo` (
  `rest_photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `rest_photo` varchar(50) NOT NULL,
  `rest_id` int(11) NOT NULL,
  PRIMARY KEY (`rest_photo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `restaurant_photo`
--

INSERT INTO `restaurant_photo` (`rest_photo_id`, `rest_photo`, `rest_id`) VALUES
(1, '9385-32708-rajwadu_img_1.jpg', 2),
(2, '30959-32014-17173-gordhan_img1.jpg', 3),
(3, '10811-19529-gordhan_img4.jpg', 3),
(4, '32764-19239-gordhan_img3.jpg', 3),
(5, '22822-5373-mirchmasala_img_1.JPG', 5),
(6, '26289-26419-rajwadu_img_2.jpg', 6),
(7, '9788-4564-mirchmasala_img_2.JPG', 7),
(8, '26469-gordhan_img2.jpg', 3),
(9, '18840-pakvan1.jpg', 8),
(10, '15192-pakvan1.jpg', 12),
(11, '17585-pakvan2.jpg', 12),
(12, '23958-qwiches_img1.jpg', 13),
(13, '3775-qwiches_img2.jpg', 13),
(14, '1399682703347gordhan_img5.jpg', 3),
(15, '1399682703770gordhan_img6.jpg', 3),
(16, '14341-qwiches_img3.jpg', 13),
(17, '4186-qwiches_img4.jpg', 13),
(18, '30288-qwiches_img5.jpg', 13),
(19, '4747-qwiches_img6.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_text` text NOT NULL,
  `foodie_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_text`, `foodie_id`, `rest_id`, `review_date`, `review_status`) VALUES
(1, 'It''s simply an understatement to say , how fabulous Sankalp is. Serving Ahmedabad since more than 2 decades now and this place has evolved with time!!! From one small restaurant on CG road to expanding over 3 countries is commendable and you just can not complain about their taste . They have maintained the same taste since soo many years. They are impeccable when it comes to do what they are very good at , and so they are the BEST \nI would say , this is not an so called "authentic" south indian restaurant , but it is great to see that the menu card offers a myriad of offerings of all south indian dishes with different varieties , and making a eclectic combination of many cuisines into south indian , and that''s where the fun lies , experimenting with different dishes , rarther than eating the hackneyed south indian delicacies.They surely have done a excellent job with the ever growing menu card !!!\nFrom the normal serving style to transforming into the typical south Indian serving style , definitely caught my attention on my recent visit.\nAfter many visits over the years , I''ve got a chance at least to try out their "signature" dishes !! Varying from the idlis to their mysore dosa and uttapam''s and the latest was cheese corn and the paneer dosa and vegetable idlis for the starters\n\nI''ve tried mysore plain dosa of many places , but no one does the chutneys in it better than Sankalp !!!\nPaneer dosa was definitely a new experience , and if you are a paneer fan , a MUST try\nChsees corn dosa was a bit too cheesy for a dosa !!!!\nAnd as suggested we had the vegetable idli for the starters , it was delicious but a bit too spicy!!\nThe Sambhar and Chutney offerings in the side steal the show !!!\n4 different chutneys , it is possible that you end up eating the chutneys more , before the food arrives!!!\nFor the seating part , the chairs which seem a bit grand royale are anyways comfortable !!!\n\nRating: This place sets benchmarks !! So Not Applicable !!!!!\nPrices are a bit on the higher side , but good things come at a cost !!!!', 24, 4, '2014-03-28 22:32:56', 0),
(2, 'we never ever get tired of going to Birmies as only the place has changed its colors but the food remains as tasty as ever, the staff remains loyal and i have never ever seen them take a leave and yet they are so keen in serving us the Delicious Food and yes always with a smile.\n\n\nOne of my friends had visited Ahmedabad and we decided to meet up at Birmies it was a small waiting as it always is with this place but yes it is worth waiting for such good food. we were called in after 15-20 mins and we sat in our favourite Spot the Last table and fortunately every time we manage to grab hold of that very same old table which had many of our memories linked with it . let it be our First Jobs or let it be a Promotion or any Birthday party this Grub hub has been a hub for our choti-choti parties that we started during our school day, though i miss the old place sometimes but with mostly all the familiar places around it is a bit comforting that i will be served equally good food this time again.\n\n\nSo without looking at the menu we had ordered two Hum pum Paneers which we know would cost 260 + 2 Extra Garlic Breads. \n\nOur order arrived in a short time and it looked promising as ever . but as i was about to grab my first bite a Long Black strand of Hair which was enjoying a free ride on my bread caught my attention and i was sure to bring it to their notice as soon as it told the server about this small discontent he Told us to stop eating and wait for 5 minutes and returned with a New Dish From inside the Kitchen and i saw him throw away the order myself which in fact is a very good thing or else i have some friends who are in this industry and they advise me not to do this or else the Dish goes Straight into the kitchen and comes out on a different plate and yes this time with a little Spirit of Vengeance from the Staff which can not be good thing at all, I hope you understand what i am trying to Convey . I liked this approach a hundered times better and it was great. this is what makes it a great place to hangout. \n\nHe was so polite and courteous i can not express in mere words. This is the kind of service some people offer without charging and Exorbitant amount and it should be picked up by all.\n\nNext item was a Suggestion form a friend the Shalmargo Rice and Yes @viveck Patil it was an instant hit. thank you for introducing us to a new Delicacy. Thank you\n\nThen we moved on to the last part of the meal and ended it with a Rajma Chawal which was as good as always.\n\nI would definately want to go back to such a place. Thank you for the good food and a wonderful experience.', 20, 3, '2014-03-28 22:34:03', 1),
(3, 'It''s simply an understatement to say , how fabulous Sankalp is. Serving Ahmedabad since more than 2 decades now and this place has evolved with time!!! From one small restaurant on CG road to expanding over 3 countries is commendable and you just can not complain about their taste . They have maintained the same taste since soo many years. They are impeccable when it comes to do what they are very good at , and so they are the BEST', 2, 1, '2014-03-29 21:13:49', -1),
(4, 'One of my friends had visited Ahmedabad and we decided to meet up at Birmies it was a small waiting as it always is with this place but yes it is worth waiting for such good food. we were called in after 15-20 mins and we sat in our favourite Spot the Last table and fortunately every time we manage to grab hold of that very same old table which had many of our memories linked with it . let it be our First Jobs or let it be a Promotion or any Birthday party this Grub hub has been a hub for our choti-choti parties that we started during our school day, though i miss the old place sometimes but with mostly all the familiar places around it is a bit comforting that i will be served equally good food this time again.\r\n\r\n\r\nSo without looking at the menu we had ordered two Hum pum Paneers which we know would cost 260 + 2 Extra Garlic Breads. \r\n\r\nOur order arrived in a short time and it looked promising as ever . but as i was about to grab my first bite a Long Black strand of Hair which was enjoying a free ride on my bread caught my attention and i was sure to bring it to their notice as soon as it told the server about this small discontent he Told us to stop eating and wait for 5 minutes and returned with a New Dish From inside the Kitchen and i saw him throw away the order myself which in fact is a very good thing or else i have some friends who are in this industry and they advise me not to do this or else the Dish goes Straight into the kitchen and comes out on a different plate and yes this time with a little Spirit of Vengeance from the Staff which can not be good thing at all, I hope you understand what i am trying to Convey . I liked this approach a hundered times better and it was great. this is what makes it a great place to hangout. \r\n\r\nHe was so polite and courteous i can not express in mere words. This is the kind of service some people offer without charging and Exorbitant amount and it should be picked up by all.\r\n\r\nNext item was a Suggestion form a friend the Shalmargo Rice and Yes @viveck Patil it was an instant hit. thank you for introducing us to a new Delicacy. Thank you\r\n\r\nThen we moved on to the last part of the meal and ended it with a Rajma Chawal which was as good as always.\r\n\r\nI would definately want to go back to such a place. Thank you for the good food and a wonderful experience.', 11, 4, '2014-03-29 21:19:32', -1),
(5, 'I would say , this is not an so called "authentic" south indian restaurant , but it is great to see that the menu card offers a myriad of offerings of all south indian dishes with different varieties , and making a eclectic combination of many cuisines into south indian , and that''s where the fun lies , experimenting with different dishes , rarther than eating the hackneyed south indian delicacies.They surely have done a excellent job with the ever growing menu card !!!\r\nFrom the normal serving style to transforming into the typical south Indian serving style , definitely caught my attention on my recent visit.\r\nAfter many visits over the years , I''ve got a chance at least to try out their "signature" dishes !! Varying from the idlis to their mysore dosa and uttapam''s and the latest was cheese corn and the paneer dosa and vegetable idlis for the starters\r\n\r\nI''ve tried mysore plain dosa of many places , but no one does the chutneys in it better than Sankalp !!!\r\nPaneer dosa was definitely a new experience , and if you are a paneer fan , a MUST try\r\nChsees corn dosa was a bit too cheesy for a dosa !!!!\r\nAnd as suggested we had the vegetable idli for the starters , it was delicious but a bit too spicy!!\r\nThe Sambhar and Chutney offerings in the side steal the show !!!\r\n4 different chutneys , it is possible that you end up eating the chutneys more , before the food arrives!!!\r\nFor the seating part , the chairs which seem a bit grand royale are anyways comfortable !!!\r\n\r\nRating: This place sets benchmarks !! So Not Applicable !!!!!\r\nPrices are a bit on the higher side , but good things come at a cost !!!!', 2, 7, '2014-03-29 22:15:37', 1),
(6, 'I am not a fan of thali food. But in Navratri Rajwadu wears this beautiful avataar and is decked for the celebrations. They have a 100 diya aarti everyday for nine nights and it is a mesmerising experience. \nSo each time we r here for the aarti, almost every year, we stop by for dinner. Rajwadu offers a la carte gujarati food in its retaurant called Madhurya. \nThe Ambiance is open to air there is a puppeteer a pot maker etc right there, swibgs nearby and a huge empty space, has a welcoming-satisfying feeling to it. A\nI always order khichu and sev tameta nu shaak. Khichu is the raw form of papad ( must try) if u never have. It has the fluffiest khichu I haave had outside of home, pour liberal amout of oil and garlic chutney and I can eat plates of it. Sev-Tameta nu sgaak and vaagharelo rotlo was the next item. The rotlo was crushed and when mixed wirh the sev-tameta tasted wonderful. The patras went untouched. The cocunut tikki, dhokla were all very well made. The chhash is very refreshing, however the ginger and lemon drink was very strong. \nOne suggestion I wld like to make is, especially during navratri the aarti takes place at 10 the kitchen closes at 10:30 and food bcomes very rush rush so if during tht time if it could close a little later madhurya wld attract a larger crowd.\nOverall I like it. If there are children they would love the place and the food is a change for your taste buds.\n\nFood;4/5\nAmbiance:5/5\nService:3.5/5\nVfM:3/5', 5, 6, '2014-03-29 22:18:54', 0),
(7, 'Our order arrived in a short time and it looked promising as ever . but as i was about to grab my first bite a Long Black strand of Hair which was enjoying a free ride on my bread caught my attention and i was sure to bring it to their notice as soon as it told the server about this small discontent he Told us to stop eating and wait for 5 minutes and returned with a New Dish From inside the Kitchen and i saw him throw away the order myself which in fact is a very good thing or else i have some friends who are in this industry and they advise me not to do this or else the Dish goes Straight into the kitchen and comes out on a different plate and yes this time with a little Spirit of Vengeance from the Staff which can not be good thing at all, I hope you understand what i am trying to Convey . I liked this approach a hundered times better and it was great. this is what makes it a great place to hangout. He was so polite and courteous i can not express in mere words. This is the kind of service some people offer without charging and Exorbitant amount and it should be picked up by all. Next item was a Suggestion form a friend the Shalmargo Rice and Yes @viveck Patil it was an instant hit. thank you for introducing us to a new Delicacy. Thank you Then we moved on to the last part of the meal and ended it with a Rajma Chawal which was as good as always. I would definately want to go back to such a place. Thank you for the good food and a wonderful experience.', 12, 13, '2014-04-01 20:24:27', 1),
(10, 'This is the best restaurant located at S.G. Highway..\r\nBest restaurant with excellent service and Quality of Food.\r\nHere you can get more than just food and i hope you will definitely get satisfaction.\r\nbest for couples and also for Family .\r\ni Hope you will  enjoy it very much.. ', 24, 1, '2014-04-02 06:40:50', 1),
(12, 'good!', 24, 7, '2014-04-02 20:58:16', 0),
(13, 'Except Satluj (famous for non-veg restaurant), Surabhi is the first restaurant in Naroda. Always over crowded, and long queue of waiting on weekends. North indian food is good, but you wouldnt wish to think of something else then Punjabi and come to Surabhi - you would be disappointed for sure. Good for punjabi food. Price for two would be around 350 to 400 Rs.\r\nI would give it 3 star, by comparing to Punjabi food, price and taste.', 20, 9, '2014-04-03 20:03:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review_thanks`
--

CREATE TABLE IF NOT EXISTS `review_thanks` (
  `thank_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  `foodie_id` int(11) NOT NULL,
  PRIMARY KEY (`thank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `review_thanks`
--

INSERT INTO `review_thanks` (`thank_id`, `review_id`, `foodie_id`) VALUES
(1, 1, 24),
(2, 0, 0),
(3, 6, 24),
(4, 7, 0),
(5, 7, 24),
(6, 13, 24),
(7, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `review_visit`
--

CREATE TABLE IF NOT EXISTS `review_visit` (
  `review_visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `review_id` int(11) NOT NULL,
  PRIMARY KEY (`review_visit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `review_visit`
--

INSERT INTO `review_visit` (`review_visit_id`, `review_id`) VALUES
(1, 10),
(2, 10),
(3, 10),
(4, 10),
(5, 10),
(6, 10),
(7, 12),
(8, 12),
(9, 12),
(10, 12),
(11, 12),
(12, 12),
(13, 12),
(14, 12),
(15, 12),
(16, 12),
(17, 10),
(18, 10),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 6),
(29, 3),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 6),
(35, 6),
(36, 6),
(37, 6),
(38, 6),
(39, 6),
(40, 3),
(41, 1),
(42, 1),
(43, 2),
(44, 2),
(45, 2),
(46, 1),
(47, 6),
(48, 6),
(49, 6),
(50, 6),
(51, 10),
(52, 7),
(53, 7),
(54, 7),
(55, 7),
(56, 7),
(57, 7),
(58, 7),
(59, 7),
(60, 7),
(61, 6),
(62, 7),
(63, 7),
(64, 7),
(65, 13),
(66, 13),
(67, 13),
(68, 13),
(69, 13),
(70, 13),
(71, 13),
(72, 13),
(73, 13),
(74, 1),
(75, 5),
(76, 1),
(77, 5),
(78, 10);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(20) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Gujarat'),
(2, 'Maharashtra'),
(3, 'Delhi'),
(4, 'West Bengal'),
(5, 'Rajasthan'),
(6, 'Tamilnadu'),
(7, 'Karnataka'),
(8, 'Goa');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `visit_id` int(11) NOT NULL AUTO_INCREMENT,
  `visit` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `hit` int(11) NOT NULL,
  PRIMARY KEY (`visit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`visit_id`, `visit`, `visit_date`, `hit`) VALUES
(1, 1, '2014-01-16', 4),
(2, 1, '2014-01-16', 0),
(3, 1, '2014-01-16', 0),
(4, 1, '2014-01-16', 0),
(5, 1, '2014-01-16', 0),
(6, 1, '2014-01-16', 0),
(7, 1, '2014-01-16', 0),
(8, 1, '2014-05-16', 0),
(9, 1, '2014-02-16', 2),
(10, 1, '2014-02-16', 0),
(11, 1, '2014-02-14', 5),
(12, 1, '2014-02-08', 10),
(13, 1, '2014-02-14', 5),
(14, 1, '2014-02-08', 10),
(15, 1, '2014-02-14', 5),
(16, 1, '2014-02-08', 10),
(17, 1, '2014-03-14', 5),
(18, 1, '2014-03-08', 10),
(19, 1, '2014-03-14', 5),
(20, 1, '2014-03-08', 10),
(21, 1, '2014-03-14', 5),
(22, 1, '2014-03-08', 10),
(23, 1, '2014-03-14', 5),
(24, 1, '2014-04-08', 10),
(25, 1, '2014-04-14', 5),
(26, 1, '2014-04-08', 10),
(27, 1, '2014-04-14', 5),
(28, 1, '2014-04-08', 10),
(29, 1, '2014-04-14', 5),
(30, 1, '2014-04-08', 10),
(31, 1, '2014-05-14', 5),
(32, 1, '2014-04-08', 10),
(33, 1, '2014-05-14', 5),
(34, 1, '2014-04-08', 10),
(35, 1, '2014-05-14', 5),
(36, 1, '2014-04-08', 10),
(37, 1, '2014-05-14', 5),
(38, 1, '2014-04-08', 10),
(39, 1, '2014-05-14', 5),
(40, 1, '2014-04-08', 10),
(41, 1, '2014-05-14', 5),
(42, 1, '2014-04-08', 10),
(43, 1, '2014-05-14', 5),
(44, 1, '2014-04-08', 10),
(45, 1, '2014-05-14', 5),
(46, 1, '2014-04-08', 10),
(47, 1, '2014-05-14', 5),
(48, 1, '2014-04-08', 10),
(49, 1, '2014-05-10', 0),
(50, 1, '2014-05-11', 2),
(51, 1, '2014-05-11', 2),
(52, 1, '2014-05-11', 2),
(53, 1, '2014-05-13', 0),
(54, 1, '2014-05-13', 3),
(55, 1, '2014-05-14', 3),
(56, 1, '2014-05-15', 3),
(57, 1, '2014-05-05', 0),
(58, 1, '2014-05-18', 29),
(59, 1, '2014-05-18', 51),
(60, 1, '2014-05-18', 105),
(61, 1, '2014-05-20', 47),
(62, 1, '2014-05-20', 17),
(63, 1, '2014-05-27', 16),
(64, 1, '2014-06-02', 3),
(65, 1, '2014-06-02', 4),
(66, 1, '2014-06-02', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
