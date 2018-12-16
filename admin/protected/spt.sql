-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2017 at 01:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
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
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`, `ins_id`, `fac_id`, `course_id`, `name`, `status`, `created_date`, `updated_date`) VALUES
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
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assess`
--

INSERT INTO `assess` (`id`, `question`, `from_user`, `to_user`, `project`, `value`) VALUES
(1, 1, 1, 1, 1, 10),
(2, 1, 1, 2, 1, 10),
(3, 2, 1, 1, 1, 10),
(4, 2, 1, 2, 1, 10),
(5, 1, 2, 1, 1, 10),
(6, 1, 2, 2, 1, 10),
(7, 2, 2, 1, 1, 10),
(8, 2, 2, 2, 1, 10),
(9, 1, 2, 2, 2, 8),
(10, 1, 2, 1, 2, 10),
(11, 2, 2, 2, 2, 7),
(12, 2, 2, 1, 2, 8),
(13, 1, 4, 2, 1, 4),
(14, 1, 4, 1, 1, 8),
(15, 1, 4, 4, 1, 10),
(16, 2, 4, 2, 1, 8),
(17, 2, 4, 1, 1, 7),
(18, 2, 4, 4, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `assess_comments`
--

CREATE TABLE `assess_comments` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assess_comments`
--

INSERT INTO `assess_comments` (`id`, `project`, `from_user`, `to_user`, `comments`) VALUES
(1, 1, 1, 1, 'Good work fgfgfg'),
(2, 1, 1, 2, 'Excellent. He done is job very well. nice class'),
(3, 1, 2, 1, 'He is innovative and good teammate.'),
(4, 1, 2, 2, 'As a team lead I\'m satisfied for handled well.'),
(5, 2, 2, 2, 'gfdgdfgdfgdf'),
(6, 2, 2, 1, 'fgfdgfdgdfgfd'),
(7, 1, 4, 2, 'werirjweoiriwetjorit'),
(8, 1, 4, 1, 'rtojutiorejutrioturt'),
(9, 1, 4, 4, 'rtieutoiretieturiet');

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
  `year` varchar(4) NOT NULL,
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
(1, 'MA ScriptWriting', 1, 1, 1, 1, '2017', 'MA ScriptWriting', 'active', 1, '2017-08-17 20:11:06', '2017-08-17 20:11:06'),
(2, 'MA Cinematography', 2, 1, 1, 1, '2016', 'MA Cinematography', 'active', 1, '2017-08-17 20:12:44', '2017-08-17 20:12:44');

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
(1, 'MA', 'active'),
(2, 'MAU', 'active');

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
(1, 'Faculty of Media & Communication', 1, 'Faculty of Media & Communication', 'active', 1, '2017-11-02 16:17:36', '2017-11-02 16:17:36');

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
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `g_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution_user`
--

INSERT INTO `institution_user` (`id`, `user_id`, `institution`, `faculty`, `course`, `g_id`) VALUES
(6, 2, 1, 1, 1, 0),
(7, 1, 1, 1, 1, 0),
(8, 4, 1, 1, 1, 0);

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
(1, 'Project 1', 1, 1, 1, 'Project 1', 'current', '2017-10-26', 1, '2017-08-18 21:33:59', '2017-08-18 21:33:59'),
(2, 'Project 2', 1, 1, 1, 'Project 2', 'archieved', '2017-08-26', 1, '2017-08-18 21:28:43', '2017-08-18 21:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `type` enum('default','custom') NOT NULL DEFAULT 'custom',
  `course` int(11) NOT NULL,
  `institution` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `type`, `course`, `institution`, `faculty`, `status`) VALUES
(1, 'Contribution to the ideas, groups and discussions', 'custom', 1, 1, 1, 'active'),
(2, 'Extent to which the person can be relied to carry out task', 'custom', 1, 1, 1, 'active'),
(3, 'tgretretertret', 'custom', 1, 1, 1, 'active'),
(4, 'hhdfghdfghdfhdfh', 'default', 0, 0, 0, 'active');

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
(1, 'superuser', 'Superuser', 1),
(2, 'faculties', 'Faculty', 1),
(3, 'staff ', 'Staff', 1),
(4, 'admin', 'Admin/Uniadmin', 1);

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
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `course_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `fac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `profile`, `status`, `created_date`, `updated_date`, `course_id`, `institution_id`, `fac_id`) VALUES
(1, 'dhamuace@gmail.com', '123456', 'Dhamodharan test user venki', 'Raj kumar', '', 'active', '2017-08-18 00:00:00', '2017-08-18 00:00:00', 1, 1, 1),
(2, 'lsivakumar@bournemouth.ac.uk', 'test', 'Lokesh', 'S', '', 'active', '2017-08-18 00:00:00', '2017-08-18 00:00:00', 1, 1, 1),
(4, 'rsp@gmail.com', 'test', 'test', 'test', '', 'active', '2017-09-24 19:43:48', '2017-09-24 19:43:48', 1, 1, 1),
(15, 'suresh.r@rapidcareitservices.com', '', '', '', '', 'inactive', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1, 1),
(16, 'suresh.p@rapidcareitservices.com', '', '', '', '', 'inactive', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0),
(17, 'ghgfhgfh', 'gfhgfh', 'gfhgfh', 'gfhgfhgf', '', 'active', '2017-11-04 05:26:08', '2017-11-04 05:26:08', 0, 0, 0),
(18, 'ss@gmail.com', 'stest', 'suresh', 'ramesh', 'imagine.jpg', 'active', '2017-11-04 05:34:09', '2017-11-04 05:34:09', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- Indexes for table `group_master`
--
ALTER TABLE `group_master`
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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institution` (`institution`),
  ADD KEY `faculty` (`faculty`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assess`
--
ALTER TABLE `assess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `assess_comments`
--
ALTER TABLE `assess_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course_types`
--
ALTER TABLE `course_types`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `group_master`
--
ALTER TABLE `group_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
  ADD CONSTRAINT `fk_course_department` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
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
