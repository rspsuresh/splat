-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 08:01 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `splatnew`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE `admin1` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `assess` (
  `id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `value` text NOT NULL,
  `asses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assess`
--

INSERT INTO `assess` (`id`, `question`, `from_user`, `to_user`, `project`, `value`, `asses_id`) VALUES
(7, 21, 1, 1, 1, '1', 5),
(8, 21, 1, 2, 1, '2', 5),
(9, 21, 1, 33, 1, '3', 5),
(10, 23, 1, 1, 1, '4', 5),
(11, 23, 1, 2, 1, '5', 5),
(12, 23, 1, 33, 1, '6', 5),
(13, 21, 2, 1, 1, '0', 0),
(14, 21, 2, 2, 1, '6', 0),
(15, 21, 2, 33, 1, '0', 0),
(16, 21, 2, 34, 1, '0', 0),
(17, 21, 2, 27, 1, '0', 0),
(20, 23, 2, 1, 1, '0', 0),
(21, 23, 2, 2, 1, '7', 0),
(22, 23, 2, 33, 1, '0', 0),
(23, 23, 2, 34, 1, '0', 0),
(24, 23, 2, 27, 1, '0', 0),
(27, 24, 2, 1, 1, '0', 0),
(28, 24, 2, 2, 1, '6', 0),
(29, 24, 2, 33, 1, '0', 0),
(30, 24, 2, 34, 1, '0', 0),
(31, 24, 2, 27, 1, '0', 0),
(34, 28, 2, 1, 1, '', 0),
(35, 28, 2, 2, 1, 'dsfdsfdsfdsf', 0),
(36, 28, 2, 33, 1, '', 0),
(37, 28, 2, 34, 1, '', 0),
(38, 28, 2, 27, 1, '', 0),
(39, 21, 1, 34, 1, '0', 5),
(40, 21, 1, 27, 1, '0', 5),
(41, 23, 1, 34, 1, '0', 5),
(42, 23, 1, 27, 1, '10', 5),
(43, 24, 1, 1, 1, '0', 5),
(44, 24, 1, 2, 1, '0', 5),
(45, 24, 1, 33, 1, '0', 5),
(46, 24, 1, 34, 1, '0', 5),
(47, 24, 1, 27, 1, '0', 5),
(48, 28, 1, 1, 1, 'test', 5),
(49, 28, 1, 2, 1, 'test', 5),
(50, 28, 1, 33, 1, 'test', 5),
(51, 28, 1, 34, 1, 'test', 5),
(52, 28, 1, 27, 1, 'test', 5),
(53, 29, 1, 1, 1, '0', 5),
(54, 29, 1, 2, 1, '0', 5),
(55, 29, 1, 33, 1, '0', 5),
(56, 29, 1, 34, 1, '0', 5),
(57, 29, 1, 27, 1, '0', 5),
(58, 30, 1, 1, 1, '', 5),
(59, 30, 1, 2, 1, '', 5),
(60, 30, 1, 33, 1, '', 5),
(61, 30, 1, 34, 1, '', 5),
(62, 30, 1, 27, 1, '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `assess_comments`
--

CREATE TABLE `assess_comments` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `comments` text NOT NULL,
  `asses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assess_comments`
--

INSERT INTO `assess_comments` (`id`, `project`, `from_user`, `to_user`, `comments`, `asses_id`) VALUES
(1, 1, 1, 1, 'Good', 5),
(2, 1, 1, 2, 'Great', 5),
(3, 1, 1, 33, 'Excellent', 5),
(4, 1, 1, 34, 'dfdfsdf', 5),
(5, 1, 1, 27, 'hgyy', 5);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `year` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `type`, `institution`, `faculty`, `department`, `year`, `description`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'ScriptWriting', 1, 1, 1, 1, '02/28/2018', 'MA ScriptWriting', 'active', 28, '2018-02-06 14:27:49', '2018-02-06 14:27:49'),
(2, 'Cinematography', 2, 1, 1, 1, '02/01/2018', 'MA Cinematography', 'active', 28, '2018-02-06 15:00:12', '2018-02-06 15:00:12'),
(8, 'Journalism', 1, 1, 3, 0, '02/07/2018', 'Journalism', 'active', 28, '2018-02-06 14:59:12', '2018-02-06 14:59:12'),
(9, 'Cinematography 1', 2, 1, 2, 0, '02/27/2018', 'MA Cinematography 1', 'inactive', 28, '2018-02-06 15:34:10', '2018-02-06 15:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `course_types`
--

CREATE TABLE `course_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `delete_custom_question` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delete_custom_question`
--

INSERT INTO `delete_custom_question` (`id`, `question_id`, `course_id`) VALUES
(1, 30, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`) VALUES
(1, 'Department of Media Prod', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `name`, `ins_id`, `description`, `status`, `created_date`) VALUES
(4, 'Registration template', 1, '<p>fgfdgdfgdfgdfgdfgdfgdf</p>', 'active', '2017-10-01 18:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institution` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `institution`, `description`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'Faculty of Media & Communication', 1, 'Faculty of Media & Communication', 'active', 1, '2017-11-02 16:17:36', '2017-11-02 16:17:36'),
(2, 'Faculty of Health & Social science', 1, 'Faculty of Health & Social science', 'active', 4, '2018-02-12 06:16:31', '2018-02-12 06:16:31'),
(3, 'Faculty of Management', 1, 'Faculty of Management', 'active', 4, '2018-02-12 06:17:11', '2018-02-12 06:17:11'),
(7, 'Faculty of Science & Technology', 1, 'Faculty of Science & Technology', 'active', 4, '2018-02-12 06:17:24', '2018-02-12 06:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` enum('active','inactive','locked') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `course_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Group 11', 1, 'active', '2017-12-30 00:00:00', '2018-04-28 18:46:41'),
(2, 'Group 2', 1, 'active', '2017-12-29 19:55:25', '2018-04-28 18:50:58'),
(3, 'Group 3', 1, 'active', '2018-02-08 05:00:48', '2018-05-05 09:53:27'),
(4, 'Group 4', 1, 'active', '2018-02-21 06:35:10', '2018-02-21 06:35:10'),
(5, 'Group 5', 1, 'active', '2018-02-21 06:36:22', '2018-02-21 06:36:22'),
(6, 'Group 6', 1, 'active', '2018-02-21 06:48:14', '2018-02-21 06:48:14'),
(7, 'Group 7', 1, 'active', '2018-02-21 06:49:05', '2018-02-21 06:49:05'),
(8, 'Group   8', 1, 'active', '2018-02-21 06:50:28', '2018-04-28 18:51:15'),
(9, 'Group 9', 1, 'active', '2018-05-03 19:38:44', '2018-05-03 19:38:44'),
(10, 'Group 10', 1, 'active', '2018-05-03 19:40:53', '2018-05-03 20:26:24'),
(11, 'Group 11', 1, 'active', '2018-05-03 19:41:19', '2018-05-03 19:41:19'),
(12, 'Group 12', 1, 'active', '2018-05-03 20:19:58', '2018-05-03 20:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `group_master`
--

CREATE TABLE `group_master` (
  `id` int(11) NOT NULL,
  `g_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_master`
--

INSERT INTO `group_master` (`id`, `g_name`, `created_by`, `status`) VALUES
(2, 'Rockers', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`id`, `user_id`, `group_id`, `status`, `created_date`, `updated_date`) VALUES
(5, 1, 3, 'active', '2018-02-08 06:27:29', '2018-02-08 06:27:29'),
(6, 2, 3, 'active', '2018-02-08 06:29:21', '2018-02-08 06:29:21'),
(7, 33, 3, 'active', '2018-02-08 06:30:07', '2018-02-08 06:30:07'),
(8, 34, 3, 'active', '2018-04-02 18:47:34', '2018-04-02 18:47:34'),
(9, 27, 3, 'active', '2018-04-02 18:47:34', '2018-04-02 18:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `description`, `status`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'Bournemouth University', 'Bournemouth University', 'active', 1, '2017-09-25 16:57:20', '2017-09-25 16:57:20'),
(3, 'new university', '', 'active', 1, '2017-10-01 18:00:02', '2017-10-01 18:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `institution_user`
--

CREATE TABLE `institution_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `g_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution_user`
--

INSERT INTO `institution_user` (`id`, `user_id`, `prj_id`, `institution`, `faculty`, `course`, `g_id`) VALUES
(6, 2, 1, 1, 1, 1, 2),
(7, 1, 1, 1, 1, 1, 2),
(8, 4, 1, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `multipleassesment`
--

CREATE TABLE `multipleassesment` (
  `id` int(11) NOT NULL,
  `prj_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('I','A') NOT NULL DEFAULT 'I',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `multipleassesment`
--

INSERT INTO `multipleassesment` (`id`, `prj_id`, `due_date`, `status`, `created_date`) VALUES
(3, 2, '2018-05-01', 'A', '2018-05-03 21:04:04'),
(4, 2, '2018-05-21', 'I', '2018-05-03 21:04:04'),
(5, 1, '2017-11-09', 'A', '2018-05-04 19:56:05'),
(6, 1, '2018-05-19', 'I', '2018-05-04 19:58:06'),
(7, 3, '2018-05-06', 'I', '2018-05-18 17:46:25'),
(8, 3, '2018-05-31', 'I', '2018-05-18 17:46:25'),
(9, 3, '2018-06-30', 'I', '2018-05-18 17:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('current','archieved') NOT NULL DEFAULT 'current',
  `assess_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `institution`, `faculty`, `course`, `description`, `status`, `assess_date`, `created_by`, `created_date`, `updated_date`) VALUES
(1, 'Project 1', 1, 1, 1, 'Project 1', 'current', '2017-11-09', 28, '2018-05-04 19:58:06', '2018-05-04 19:58:06'),
(2, 'Unit -I Project name(2018-2019)', 1, 1, 1, 'test', 'current', '0000-00-00', 28, '2018-05-03 21:04:03', '2018-05-03 21:04:03'),
(3, 'unit II pjt 2018 -2029', 1, 1, 1, 'test by staff', 'current', '0000-00-00', 29, '2018-05-18 17:46:24', '2018-05-18 17:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `project_groups`
--

CREATE TABLE `project_groups` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_groups`
--

INSERT INTO `project_groups` (`id`, `project_id`, `group_id`) VALUES
(2, 2, 2),
(7, 1, 3),
(8, 1, 4),
(9, 1, 5),
(10, 1, 7),
(11, 1, 8),
(12, 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `type` enum('default','custom') NOT NULL DEFAULT 'custom',
  `q_type` enum('R','S') NOT NULL DEFAULT 'R',
  `course` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `q_type`, `course`, `institution`, `faculty`, `status`) VALUES
(5, 'Test', 'default', 'R', 0, 0, 0, 'active'),
(6, 'Extent to which you can be relied upon to carry out allocated roles / tasks', 'default', 'R', 0, 0, 0, 'active'),
(10, 'Extent to which you are punctual and committed', 'custom', 'R', 0, 0, 0, 'active'),
(11, 'Extent to which you are punctual and committed', 'custom', 'R', 0, 0, 0, 'active'),
(12, 'Extent to which you are punctual and committed', 'custom', 'R', 0, 0, 0, 'active'),
(13, 'Extent to which you are punctual and committed', 'default', 'R', 0, 0, 0, 'active'),
(14, 'Extent to which you accept advice and criticism', 'default', 'R', 0, 0, 0, 'active'),
(15, 'Extent to which you offer high quality management / technical skills for your role', 'default', 'R', 0, 0, 0, 'active'),
(21, 'Extent to which you are punctual and committed', 'custom', 'R', 1, 1, 1, 'active'),
(23, 'Extent to which you offer high quality management / technical skills for your role', 'custom', 'R', 1, 1, 1, 'active'),
(24, 'Extent to which you are punctual and committed', 'custom', 'R', 1, 1, 1, 'active'),
(25, 'what  is  your name .tell us about yourself?  dfdsfdsfd', 'default', 'S', 0, 0, 0, 'inactive'),
(26, 'default question to be deleted by staff', 'default', 'S', 0, 0, 0, 'inactive'),
(28, 'what  is  your name .tell us about yourself?', 'custom', 'S', 1, 1, 1, 'inactive'),
(29, 'test tesr?', 'custom', 'R', 1, 1, 1, 'active'),
(30, 'hi tom and jerry how are you ?', 'default', 'S', 1, 1, 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `profile`, `role`, `course_id`, `institution_id`, `fac_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'dhamuace@gmail.com', '12345', 'Dhamuu', 'RR', 'img1511376198075.jpg', 5, 1, 1, 1, 'active', '2017-08-18 00:00:00', '2018-02-07 16:45:36'),
(2, 'lsivakumar@bournemouth.ac.uk', '123', 'Lokesh', 'S', '', 5, 1, 1, 1, 'active', '2017-08-18 00:00:00', '2018-02-07 16:45:55'),
(4, 'awoodfall@bournemouth.ac.uk', '123', 'Ashley', 'Woodfall', '', 3, 1, 1, 1, 'active', '2017-09-24 19:43:48', '2017-09-24 19:43:48'),
(19, 'rsprampaul14321@gmail.com', '123', '', '', '', 5, 0, 0, 0, 'inactive', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'fyndup@gmail.com', '123', 'Fynd', 'UP', '', 5, 1, 1, 1, 'active', '2017-12-28 14:20:27', '2017-12-28 14:20:27'),
(28, 'admin@splat.com', '123', 'Splat', 'Admin', '', 1, 1, 1, 1, 'active', '2017-12-28 00:00:00', '2017-12-28 00:00:00'),
(29, 'staff@splat.com', 'test', 'Staff', 'Dhamu', '', 3, 1, 1, 1, 'active', '2018-02-06 17:59:46', '2018-02-06 17:59:46'),
(32, 'test@gmail.com', 'p@ssw0rd', 'TestDhamu', 'Dhamu', '', 3, 1, 1, 1, 'active', '2018-02-07 13:03:05', '2018-02-07 14:28:52'),
(33, 'testt@gmail.com', '60bddc7e', 'Import', 'User', '', 5, 1, 1, 1, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'test2@gmail.com', '9511c696', 'Import2', 'User', '', 5, 1, 1, 1, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'admin@splat.com', '123sdfsad', 'fdsfsdf', 'sdfdsfdsf', '', 3, 1, 1, 1, 'active', '2018-04-08 17:42:34', '2018-04-08 17:42:34'),
(41, 'admin@splat.com', '123sdfsad', 'fdsfsdf', 'sdfdsfdsf', '', 3, 1, 1, 1, 'active', '2018-04-08 17:43:44', '2018-04-08 17:43:44'),
(42, 'fsdfsdfsdf@gmail.com', '123', 'dfdsfsd', 'sdfdsfsdf', '', 3, 1, 1, 1, 'active', '2018-04-08 18:07:20', '2018-04-08 18:07:20'),
(43, 'vinayagatamilan@gmail.com', 'vinayaga', 'vinayaga', 'tamilan', '', 3, 1, 1, 1, 'active', '2018-04-08 18:16:58', '2018-04-08 18:16:58'),
(44, 'adduser@splat.com', 'test1234', 'testest', 'lastname', '', 3, 1, 1, 1, 'active', '2018-04-08 18:20:03', '2018-04-08 18:20:03'),
(45, 'addsdfdsfuser@splat.com', 'safsafsdaf', 'testest', 'lastname', '', 3, 1, 1, 1, 'active', '2018-04-08 18:21:30', '2018-04-08 18:21:30'),
(46, 'addsdfdsfuser@splat.com', 'aduser', 'testest', 'lastname', '', 3, 1, 1, 1, 'active', '2018-04-08 18:23:35', '2018-04-08 18:23:35'),
(47, 'adsdfsdfmin@splat.com', '123fvsdf', 'sdfsdf', 'dsfsdf', '', 3, 1, 1, 1, 'active', '2018-04-08 18:25:24', '2018-04-08 18:25:24'),
(48, 'admfvdsfsfin@splat.com', '123', 'sdfsd', 'sdfdsf', '', 3, 1, 1, 1, 'active', '2018-04-08 18:30:38', '2018-04-08 18:30:38'),
(49, 'adfdsfsdfmin@splat.com', '123sdfsd', 'dfdsfsd', 'sdfds', '', 3, 1, 1, 1, 'active', '2018-04-08 18:32:29', '2018-04-08 18:32:29'),
(50, 'dsadas@splat.com', '123asdsad', 'asdsadsa', 'sadasdasd', '', 3, 1, 1, 1, 'active', '2018-04-08 18:33:43', '2018-04-08 18:33:43'),
(51, 'dsadas@splat.com', 'sfasfsadfsd', 'asdsadsa', 'sadasdasd', '', 3, 1, 1, 1, 'active', '2018-04-08 18:36:46', '2018-04-08 18:36:46'),
(52, 'admhgygtyin@splat.com', '123454', 'trtu', 'jgjdj', '', 3, 1, 1, 1, 'active', '2018-04-08 18:40:14', '2018-04-08 18:40:14'),
(53, 'admdfsdfdsin@splat.com', '123sdf', 'ffsd', 'dfsdfsdf', '', 3, 1, 1, 1, 'active', '2018-04-08 18:56:23', '2018-04-08 18:56:23'),
(54, 'addsfdsfmin@splat.com', '1dsfdsf23', 'fdsfds', 'dsfdsf', '', 3, 1, 1, 1, 'active', '2018-04-08 18:57:25', '2018-04-08 18:57:25'),
(55, 'lsivakumar@bournemouth.ac.uk', '123', 'fsdfsdf', 'dfsdfsd', '', 3, 1, 1, 1, 'active', '2018-04-09 15:58:11', '2018-04-09 15:58:11'),
(56, 'jghgjhy', 'fgfghft', 'fhgfhg', 'gfhghfhg', '', 3, 1, 1, 1, 'active', '2018-04-09 16:05:25', '2018-04-09 16:05:25'),
(57, 'ytt@gmail.com', 'test', 'nkjh;', ',;,;,;', '', 3, 1, 1, 1, 'active', '2018-04-09 16:18:59', '2018-04-09 16:18:59'),
(58, 'ytt@gmail.com', 'fsdfdsf', 'nkjh;', ',;,;,;', '', 3, 1, 1, 1, 'active', '2018-04-09 16:20:48', '2018-04-09 16:20:48'),
(59, 'rewr@gmail.com', 'dfdsfdsf', 'fdsfdsf', 'dsfdsdsf', '', 3, 1, 1, 1, 'active', '2018-04-09 16:36:14', '2018-04-09 16:36:14'),
(60, 'dfdsf@gmail.com', 'sdsd', 'sadsad', 'sadsads', '', 3, 1, 1, 1, 'active', '2018-04-09 16:42:22', '2018-04-09 16:42:22'),
(61, 'srer@gmail.com', 'sfsadfdf', 'dfdsfdsf', 'dsfdsfdsfdsf', '', 3, 1, 1, 1, 'active', '2018-04-09 16:47:57', '2018-04-09 16:47:57'),
(62, 'dsfdsf', 'dsfdsf', 'dsfdsf', 'dsfdsfdsf', '', 3, 1, 1, 1, 'active', '2018-04-09 16:48:45', '2018-04-09 16:48:45'),
(63, 'sdsadsa@gmail.com', 'testest', 'sdsadsad', 'sadsadsfdsf', '', 3, 1, 1, 1, 'active', '2018-04-09 17:07:14', '2018-04-09 17:07:14'),
(64, 'ramesh213@gmail.com', 'ac918bdb', 'trichy', 'testsurendar', '', 5, 1, 1, 1, 'inactive', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'ramesh098@gmail.com', 'dabe3b7c', 'madurai', 'testsrivatsan', '', 5, 1, 1, 1, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'ramesh096@gmail.com', '65791e36', 'theni', 'testsiva', '', 5, 1, 1, 1, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'ramesh125@gmail.com', '31c818da', 'didugal', 'testambi', '', 5, 1, 1, 1, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'ramesh126@gmail.com', '3ab3b961', 'kambam', 'test purus', '', 5, 1, 1, 1, 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'dewewewesert@gmail.com', 'sdsd', 'ewew', 'wewewe', '', 5, 1, 1, 1, 'active', '2018-05-12 09:42:23', '2018-05-12 09:42:23'),
(72, 'amit.ad1i4@yahoo.com', 'myfaceback', 'ramesh', 'keerthi', '', 3, 1, 1, 1, 'active', '2018-05-16 18:45:23', '2018-05-16 18:45:23'),
(73, 'teststaff@splat.com', '123', 'teststaff', 'E', '', 3, 1, 1, 1, 'active', '2018-05-20 18:50:24', '2018-05-20 18:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `course_id`) VALUES
(6, 32, 8),
(5, 32, 1),
(7, 1, 1),
(8, 1, 2),
(9, 2, 1),
(10, 2, 2),
(11, 33, 1),
(14, 34, 1),
(13, 27, 1),
(15, 35, 1),
(16, 36, 1),
(17, 37, 1),
(18, 38, 1),
(19, 39, 1),
(20, 40, 9),
(21, 41, 9),
(22, 42, 9),
(23, 43, 8),
(24, 44, 8),
(25, 45, 8),
(26, 46, 8),
(27, 47, 2),
(28, 48, 9),
(29, 49, 2),
(30, 50, 1),
(31, 51, 1),
(32, 52, 1),
(33, 53, 9),
(34, 54, 1),
(35, 55, 2),
(36, 56, 2),
(37, 57, 2),
(38, 58, 2),
(39, 59, 2),
(40, 60, 1),
(41, 61, 2),
(42, 62, 2),
(43, 63, 1),
(44, 64, 1),
(45, 65, 1),
(46, 66, 1),
(47, 67, 1),
(48, 68, 1),
(49, 69, 1),
(50, 70, 1),
(51, 71, 2),
(52, 72, 2),
(53, 72, 9),
(54, 73, 2),
(55, 73, 8),
(56, 73, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_faculties`
--

CREATE TABLE `user_faculties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_faculties`
--

INSERT INTO `user_faculties` (`id`, `user_id`, `faculty_id`) VALUES
(6, 32, 3),
(5, 32, 1),
(7, 1, 1),
(8, 1, 2),
(9, 2, 1),
(10, 2, 2),
(11, 27, 1),
(12, 33, 1),
(13, 34, 1),
(14, 40, 2),
(15, 41, 2),
(16, 42, 2),
(17, 43, 2),
(18, 44, 3),
(19, 45, 3),
(20, 46, 3),
(21, 47, 1),
(22, 48, 2),
(23, 49, 1),
(24, 50, 1),
(25, 51, 1),
(26, 52, 1),
(27, 53, 2),
(28, 54, 1),
(29, 55, 1),
(30, 56, 1),
(31, 57, 1),
(32, 58, 1),
(33, 59, 1),
(34, 60, 1),
(35, 61, 1),
(36, 62, 1),
(37, 63, 1),
(38, 64, 1),
(39, 65, 1),
(40, 66, 1),
(41, 67, 1),
(42, 68, 1),
(43, 71, 1),
(44, 72, 1),
(45, 72, 2),
(46, 73, 1),
(47, 73, 2),
(48, 73, 3),
(49, 73, 7);

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
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
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
-- Indexes for table `group_master`
--
ALTER TABLE `group_master`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assess`
--
ALTER TABLE `assess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `assess_comments`
--
ALTER TABLE `assess_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_types`
--
ALTER TABLE `course_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delete_custom_question`
--
ALTER TABLE `delete_custom_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `group_master`
--
ALTER TABLE `group_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `institution_user`
--
ALTER TABLE `institution_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `multipleassesment`
--
ALTER TABLE `multipleassesment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_groups`
--
ALTER TABLE `project_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `user_courses`
--
ALTER TABLE `user_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user_faculties`
--
ALTER TABLE `user_faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
