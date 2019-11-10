-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2019 at 05:13 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE IF NOT EXISTS `admin1` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`id`, `username`, `password`, `role`, `ins_id`, `fac_id`, `course_id`, `name`, `status`, `created_date`, `updated_date`) VALUES
(1, 'admin@splat.com', '123', 1, 1, 1, 1, 'Administrator', 'active', '2017-08-17 00:00:00', '2017-08-17 00:00:00'),
(2, 'suresh@gmail.com', 'test', 1, 1, 1, 1, 'sureshrampaul', 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'kalai@gmail.com', '1234', 2, 1, 1, 1, 'test', 'active', '2017-09-26 19:38:25', '2017-09-26 19:38:25'),
(4, 'dsfsfds', 'dsfdsfsd', 1, 3, 1, 1, 'dsfdsfsdf', 'active', '2017-09-27 20:48:37', '2017-09-27 20:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `assess`
--

CREATE TABLE IF NOT EXISTS `assess` (
  `id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `value` text NOT NULL,
  `grp_id` int(11) NOT NULL,
  `submitted_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assess`
--

INSERT INTO `assess` (`id`, `question`, `from_user`, `to_user`, `project`, `value`, `grp_id`, `submitted_at`) VALUES
(1, 23, 787, 787, 8, '10', 2, '2019-09-15 09:59:14'),
(2, 23, 787, 789, 8, '3', 2, '2019-09-15 09:59:14'),
(3, 23, 787, 790, 8, '3', 2, '2019-09-15 09:59:14'),
(4, 23, 787, 786, 8, '2', 2, '2019-09-15 09:59:14'),
(5, 24, 787, 787, 8, 'best', 2, '2019-09-15 09:59:14'),
(6, 24, 787, 789, 8, 'poor', 2, '2019-09-15 09:59:14'),
(7, 24, 787, 790, 8, 'poor', 2, '2019-09-15 09:59:14'),
(8, 24, 787, 786, 8, 'poor', 2, '2019-09-15 09:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `assess_comments`
--

CREATE TABLE IF NOT EXISTS `assess_comments` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `comments` text NOT NULL,
  `asses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `course_type` varchar(100) NOT NULL,
  `course_level` varchar(50) DEFAULT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `anonymous` tinyint(3) DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `type`, `course_type`, `course_level`, `institution`, `faculty`, `department`, `year`, `description`, `status`, `anonymous`, `created_by`, `created_date`, `updated_date`) VALUES
(6, 'Television production', NULL, 'M.Sc', '2', 1, 4, 0, 'Sep-2019', 'desc', 'active', 1, 28, '2019-09-15 16:37:59', '2019-09-15 16:37:59'),
(7, 'Sound production 2019', NULL, 'MA', '1', 1, 4, 0, 'Sep-2019', 'test', 'active', 2, 783, '2019-09-16 17:53:42', '2019-09-16 17:53:42'),
(8, 'Managing People', NULL, 'MA', '1', 1, 5, 0, 'Oct-2019', 'test', 'active', 1, 28, '2019-10-14 13:27:43', '2019-10-14 13:27:43'),
(9, 'Managing People', NULL, 'MSC', '1', 1, 5, 0, 'Sep-2019', '', 'active', 1, 795, '2019-10-22 13:16:35', '2019-10-22 13:16:35'),
(10, 'Test course', NULL, 'MA', '1', 1, 4, 0, 'Nov-2019', 'test test', 'active', 1, 28, '2019-11-01 13:47:35', '2019-11-01 13:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `course_types`
--

CREATE TABLE IF NOT EXISTS `course_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_types`
--

INSERT INTO `course_types` (`id`, `name`, `status`) VALUES
(1, 'MA (Hons)', 'active'),
(2, 'BA (Hons)', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `delete_custom_question`
--

CREATE TABLE IF NOT EXISTS `delete_custom_question` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institution` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `institution`, `description`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(4, 'Faculty of Media and Communications', 1, 'desc', 'active', 28, '2019-09-15 16:34:54', '2019-09-15 16:34:54'),
(5, 'Faculty of Management', 1, '', 'active', 28, '2019-10-14 13:24:25', '2019-10-14 13:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` enum('active','inactive','locked') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `course_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Group 2', 6, 'active', '2019-09-15 16:43:10', '2019-09-15 16:43:10'),
(2, 'Group 1', 6, 'active', '2019-09-15 16:43:10', '2019-09-15 16:43:10'),
(3, 'Group 2', 7, 'active', '2019-09-16 17:56:42', '2019-09-16 17:56:42'),
(4, 'Group 1', 7, 'active', '2019-09-16 17:56:42', '2019-09-16 17:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`id`, `user_id`, `group_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 784, 1, 'active', '2019-09-15 04:43:10', '2019-09-15 04:43:10'),
(2, 785, 1, 'active', '2019-09-15 04:43:10', '2019-09-15 04:43:10'),
(9, 786, 2, 'active', '2019-09-15 16:45:05', '2019-09-15 16:45:05'),
(4, 787, 2, 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(5, 788, 1, 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(6, 789, 2, 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(7, 790, 2, 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(8, 791, 1, 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(19, 784, 3, 'active', '2019-09-16 18:02:14', '2019-09-16 18:02:14'),
(21, 785, 3, 'active', '2019-09-24 18:40:32', '2019-09-24 18:40:32'),
(12, 786, 4, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(13, 787, 4, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(14, 788, 3, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(15, 789, 4, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(16, 790, 4, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(17, 792, 4, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(18, 791, 3, 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE IF NOT EXISTS `institutions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `description`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'Bournemouth University', 'Bournemouth University', 'active', 1, '2017-09-25 16:57:20', '2017-09-25 16:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `institution_user`
--

CREATE TABLE IF NOT EXISTS `institution_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `g_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_send`
--

CREATE TABLE IF NOT EXISTS `mail_send` (
  `id` int(11) NOT NULL,
  `i_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `as_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail_send`
--

INSERT INTO `mail_send` (`id`, `i_id`, `c_id`, `as_id`, `f_id`, `u_id`) VALUES
(1, 1, 6, 8, 4, 784),
(2, 1, 6, 8, 4, 785),
(3, 1, 6, 8, 4, 786),
(4, 1, 6, 8, 4, 787),
(5, 1, 6, 8, 4, 788),
(6, 1, 6, 8, 4, 789),
(7, 1, 6, 8, 4, 790),
(8, 1, 6, 8, 4, 791),
(9, 1, 7, 9, 4, 784),
(10, 1, 7, 9, 4, 785),
(11, 1, 7, 9, 4, 786),
(12, 1, 7, 9, 4, 787),
(13, 1, 7, 9, 4, 788),
(14, 1, 7, 9, 4, 789),
(15, 1, 7, 9, 4, 790),
(16, 1, 7, 9, 4, 791),
(17, 1, 7, 9, 4, 792),
(18, 1, 6, 8, 4, 784),
(19, 1, 6, 8, 4, 785),
(20, 1, 6, 8, 4, 786),
(21, 1, 6, 8, 4, 787),
(22, 1, 6, 8, 4, 788),
(23, 1, 6, 8, 4, 789),
(24, 1, 6, 8, 4, 790),
(25, 1, 6, 8, 4, 791),
(26, 1, 6, 8, 4, 784),
(27, 1, 6, 8, 4, 785),
(28, 1, 6, 8, 4, 786),
(29, 1, 6, 8, 4, 787),
(30, 1, 6, 8, 4, 788),
(31, 1, 6, 8, 4, 789),
(32, 1, 6, 8, 4, 790),
(33, 1, 6, 8, 4, 791),
(34, 1, 6, 8, 4, 784),
(35, 1, 6, 8, 4, 785),
(36, 1, 6, 8, 4, 786),
(37, 1, 6, 8, 4, 787),
(38, 1, 6, 8, 4, 788),
(39, 1, 6, 8, 4, 789),
(40, 1, 6, 8, 4, 790),
(41, 1, 6, 8, 4, 791);

-- --------------------------------------------------------

--
-- Table structure for table `multipleassesment`
--

CREATE TABLE IF NOT EXISTS `multipleassesment` (
  `id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `due_date` datetime NOT NULL,
  `status` enum('I','A','C') NOT NULL DEFAULT 'I',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('current','completed','inactive') NOT NULL DEFAULT 'inactive',
  `assess_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `institution`, `faculty`, `course`, `description`, `status`, `assess_date`, `created_by`, `created_date`, `updated_date`) VALUES
(8, 'Tele Assessment 1', 1, 4, 6, 'desc', 'completed', '2019-09-23 12:00:00', 28, '2019-09-15 17:00:22', '2019-09-15 17:00:22'),
(9, 'Test 1', 1, 4, 7, 'test', 'current', '2019-09-24 17:57:00', 783, '2019-09-16 17:58:12', '2019-09-16 17:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `project_groups`
--

CREATE TABLE IF NOT EXISTS `project_groups` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `type` enum('default','custom') NOT NULL DEFAULT 'custom',
  `q_type` enum('R','S') NOT NULL DEFAULT 'R',
  `course` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `q_type`, `course`, `institution`, `faculty`, `status`) VALUES
(23, 'How do you rate the peers ?', 'custom', 'R', 6, 1, 4, 'active'),
(24, 'Comments about this peer: ', 'custom', 'S', 6, 1, 4, 'active'),
(25, 'Q1 rate', 'custom', 'R', 7, 1, 4, 'active'),
(26, 'Q2 text', 'custom', 'S', 7, 1, 4, 'active'),
(27, 'Contribution to ideas, group plans and discussions by the peer.', 'default', 'R', 0, 0, 0, 'active'),
(28, 'Extent to which the peer can be relied upon to carry out allocated roles / tasks.\r\n', 'default', 'R', 0, 0, 0, 'active'),
(29, 'Extent to which the peer is punctual and committed.', 'default', 'R', 0, 0, 0, 'active'),
(30, 'Extent to which the peer accepts advice and criticism.\r\n', 'default', 'R', 0, 0, 0, 'active'),
(31, 'Extent to which the peer offered high quality management / technical skills for the role.', 'default', 'R', 0, 0, 0, 'active'),
(32, 'Comments about the peer. ', 'default', 'S', 0, 0, 0, 'active'),
(33, 'test text?', 'default', 'S', 0, 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userdetails`
--

CREATE TABLE IF NOT EXISTS `tbl_userdetails` (
  `id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `grp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_userdetails`
--

INSERT INTO `tbl_userdetails` (`id`, `course`, `grp_id`, `user_id`) VALUES
(1, 6, 1, 784),
(2, 6, 1, 785),
(4, 6, 2, 787),
(5, 6, 1, 788),
(6, 6, 2, 789),
(7, 6, 2, 790),
(8, 6, 1, 791),
(9, 6, 2, 786),
(11, 7, 3, 785),
(12, 7, 4, 786),
(13, 7, 4, 787),
(14, 7, 3, 788),
(15, 7, 4, 789),
(16, 7, 4, 790),
(17, 7, 4, 792),
(18, 7, 3, 791),
(19, 7, 3, 784),
(20, 7, 4, 785),
(21, 7, 3, 785);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`id`, `name`, `s_name`, `status`) VALUES
(1, 'superuser', 'Admin', 1),
(3, 'staff ', 'Staff', 1),
(5, 'student', 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `send_email` int(11) DEFAULT NULL,
  `course_id` varchar(100) DEFAULT NULL,
  `institution_id` int(11) NOT NULL,
  `fac_id` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=800 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `profile`, `role`, `send_email`, `course_id`, `institution_id`, `fac_id`, `status`, `created_date`, `updated_date`) VALUES
(28, 'admin@splat.com', 'admin@splat.com', '123', 'Splat', 'Admin', '', 1, 0, '1', 1, '1', 'active', '2017-12-28 00:00:00', '2017-12-28 00:00:00'),
(783, 'Lokez21', 'Lokez21@gmail.com', '123', 'Lokesh', 'Siva', '', 3, NULL, '6,7', 1, '4', 'active', '2019-09-15 16:41:20', '2019-09-15 16:41:20'),
(784, 'sboxtest1', 'sboxtest1@bournemouth.ac.uk', '123', 'Leila', 'Origami', ' ', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:10', '2019-10-05 18:05:33'),
(785, 'sboxtest10', 'sboxtest10@bournemouth.ac.uk', '5eacd6f4', 'Zoe', 'Weasel', ' ', 5, NULL, '7', 1, '4', 'active', '2019-09-15 04:43:10', '2019-09-24 18:40:32'),
(786, 'ben.kenbobi', 'ben.kenbobi@bournemouth.ac.uk', '7c70dbbf', 'Benjamin', 'Kenbobi', ' ', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:10', '2019-09-15 16:45:05'),
(787, 'sboxtest4', 'sboxtest4@bournemouth.ac.uk', '123', 'Lance', 'Calropian', 'psmi.png', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:10', '2019-09-15 04:43:10'),
(788, 'sboxtest5', 'sboxtest5@bournemouth.ac.uk', '5b740b57', 'Max', 'Windwho', ' ', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(789, 'sboxtest6', 'sboxtest6@bournemouth.ac.uk', '039fd569', 'Paul', 'Damron', ' ', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(790, 'hedgers', 'hedgers@bournemouth.ac.uk', 'b35f0b77', 'Poppy', 'Amidodo', ' ', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(791, 'rey.sandman', 'rey.sandman@bournemouth.ac.uk', '0f397ac7', 'Rey', 'Sandman', ' ', 5, NULL, '6', 1, '4', 'active', '2019-09-15 04:43:11', '2019-09-15 04:43:11'),
(792, 'bob.fett', 'bob.fett@bournemouth.ac.uk', '35aa4eda', 'Bob', 'Fett', ' ', 5, NULL, '7', 1, '4', 'active', '2019-09-16 05:56:42', '2019-09-16 05:56:42'),
(793, 'test', 'test@gmail.com', 'RycU8d0A', 'First name', 'last name', '', 3, NULL, '6', 1, '4', 'active', '2019-10-20 14:49:02', '2019-10-20 14:49:02'),
(794, 'yangy', 'yangy@bournemouth.ac.uk', '123', 'Yumei', 'Yang', '', 3, NULL, '8', 1, '5', 'active', '2019-10-21 14:39:04', '2019-10-21 14:39:04'),
(798, 'Rsprampaul14321', 'Rsprampaul14321@gmail.com', 'dQoYkiTp', 'Suresh', 'Suresh', '', 3, NULL, '7', 1, '4', 'active', '2019-10-23 17:44:04', '2019-10-23 17:44:04'),
(799, 'lsivakumar', 'lsivakumar@bournemouth.ac.uk', 'x11ay89s', 'lokesh ', 'shivakumar', '', 3, NULL, '6,7,8,9', 1, '4,5', 'active', '2019-10-26 09:07:40', '2019-10-26 09:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE IF NOT EXISTS `user_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `course_id`) VALUES
(1, 28, 6),
(36, 783, 7),
(23, 784, 7),
(4, 785, 6),
(11, 786, 6),
(6, 787, 6),
(7, 788, 6),
(8, 789, 6),
(9, 790, 6),
(10, 791, 6),
(35, 783, 6),
(22, 784, 6),
(14, 785, 7),
(15, 786, 7),
(16, 787, 7),
(17, 788, 7),
(18, 789, 7),
(19, 790, 7),
(20, 792, 7),
(21, 791, 7),
(24, 28, 8),
(37, 793, 6),
(38, 794, 8),
(53, 799, 9),
(52, 799, 8),
(51, 799, 7),
(50, 799, 6),
(43, 798, 7),
(45, 798, 6),
(54, 28, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_faculties`
--

CREATE TABLE IF NOT EXISTS `user_faculties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_faculties`
--

INSERT INTO `user_faculties` (`id`, `user_id`, `faculty_id`) VALUES
(19, 783, 4),
(12, 784, 4),
(3, 785, 4),
(10, 786, 4),
(5, 787, 4),
(6, 788, 4),
(7, 789, 4),
(8, 790, 4),
(9, 791, 4),
(11, 792, 4),
(20, 793, 4),
(21, 794, 5),
(31, 799, 5),
(30, 799, 4),
(25, 798, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin1`
--
ALTER TABLE `admin1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assess`
--
ALTER TABLE `assess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question` (`question`),
  ADD KEY `from_user` (`from_user`),
  ADD KEY `to_user` (`to_user`),
  ADD KEY `project` (`project`);

--
-- Indexes for table `assess_comments`
--
ALTER TABLE `assess_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project` (`project`),
  ADD KEY `from_user` (`from_user`),
  ADD KEY `to_user` (`to_user`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `institution` (`institution`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `course_types`
--
ALTER TABLE `course_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delete_custom_question`
--
ALTER TABLE `delete_custom_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution` (`institution`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institution_user`
--
ALTER TABLE `institution_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `institution` (`institution`),
  ADD KEY `institution_2` (`institution`),
  ADD KEY `faculty` (`faculty`,`course`),
  ADD KEY `institution_3` (`institution`),
  ADD KEY `faculty_2` (`faculty`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `mail_send`
--
ALTER TABLE `mail_send`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multipleassesment`
--
ALTER TABLE `multipleassesment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution` (`institution`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `project_groups`
--
ALTER TABLE `project_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_userdetails`
--
ALTER TABLE `tbl_userdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_faculties`
--
ALTER TABLE `user_faculties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin1`
--
ALTER TABLE `admin1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assess`
--
ALTER TABLE `assess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `assess_comments`
--
ALTER TABLE `assess_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `course_types`
--
ALTER TABLE `course_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `delete_custom_question`
--
ALTER TABLE `delete_custom_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `institution_user`
--
ALTER TABLE `institution_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_send`
--
ALTER TABLE `mail_send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `multipleassesment`
--
ALTER TABLE `multipleassesment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `project_groups`
--
ALTER TABLE `project_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_userdetails`
--
ALTER TABLE `tbl_userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=800;
--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user_faculties`
--
ALTER TABLE `user_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assess`
--
ALTER TABLE `assess`
  ADD CONSTRAINT `fk_assess_f_user` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assess_project` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assess_question` FOREIGN KEY (`question`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assess_t_user` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `assess_comments`
--
ALTER TABLE `assess_comments`
  ADD CONSTRAINT `fk_assess_c_f_user` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assess_c_project` FOREIGN KEY (`project`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assess_c_t_user` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_course_faculty` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_course_instition` FOREIGN KEY (`institution`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_types_id` FOREIGN KEY (`type`) REFERENCES `course_types` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `fk_institution_id` FOREIGN KEY (`institution`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `institution_user`
--
ALTER TABLE `institution_user`
  ADD CONSTRAINT `fk_institution_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_institution_user_course` FOREIGN KEY (`course`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_institution_user_faculty` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_institution` FOREIGN KEY (`institution`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_course` FOREIGN KEY (`course`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_faculty` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_institution` FOREIGN KEY (`institution`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
