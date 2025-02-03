-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 فبراير 2025 الساعة 13:21
-- إصدار الخادم: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_platform`
--

-- --------------------------------------------------------

--
-- بنية الجدول `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `application_status` enum('pending','reviewed','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `job_id`, `application_status`) VALUES
(1, 1, 1, 'pending'),
(2, 3, 2, 'reviewed'),
(3, 5, 3, 'accepted'),
(4, 3, 3, 'rejected');

-- --------------------------------------------------------

--
-- بنية الجدول `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `jobs`
--

INSERT INTO `jobs` (`id`, `employer_id`, `title`, `description`, `location`, `created_at`) VALUES
(1, 2, 'Civil Engineer', 'Looking for an experienced civil engineer for a Riyadh-based project.', 'Riyadh', '2025-01-14 16:42:34'),
(2, 4, 'Graphic Designer', 'Seeking a creative graphic designer for a marketing agency.', 'Jeddah', '2025-01-14 16:42:34'),
(3, 4, 'Software Developer', 'Hiring a full-stack developer for web application projects.', 'Dammam', '2025-01-14 16:42:34'),
(4, 1, 'Mechanical Engineer', 'Design and develop mechanical systems for industrial applications.', 'Riyadh', '2025-01-14 18:27:57'),
(5, 2, 'Marketing Specialist', 'Plan and execute marketing strategies to boost brand visibility.', 'Jeddah', '2025-01-14 18:27:57'),
(6, 3, 'Web Developer', 'Build responsive and user-friendly web applications.', 'Dammam', '2025-01-14 18:27:57'),
(7, 4, 'Civil Engineer', 'Supervise construction projects and ensure compliance with safety standards.', 'Riyadh', '2025-01-14 18:27:57'),
(8, 1, 'Data Scientist', 'Analyze large datasets to generate business insights.', 'Riyadh', '2025-01-14 18:27:57'),
(9, 2, 'Software Tester', 'Test software applications for bugs and issues.', 'Makkah', '2025-01-14 18:27:57'),
(10, 3, 'Network Engineer', 'Design and maintain IT infrastructure for a growing company.', 'Medina', '2025-01-14 18:27:57'),
(11, 4, 'Graphic Designer', 'Create visual designs for online and offline campaigns.', 'Riyadh', '2025-01-14 18:27:57'),
(12, 5, 'Human Resources Manager', 'Oversee recruitment and employee relations.', 'Jeddah', '2025-01-14 18:27:57'),
(13, 6, 'Content Writer', 'Write engaging and informative content for blogs and websites.', 'Dammam', '2025-01-14 18:27:57'),
(14, 1, 'Project Manager', 'Coordinate and deliver projects on time and within budget.', 'Khobar', '2025-01-14 18:27:57'),
(15, 2, 'Digital Marketing Specialist', 'Manage and optimize digital marketing campaigns.', 'Riyadh', '2025-01-14 18:27:57'),
(16, 3, 'IT Support Specialist', 'Provide technical support and troubleshoot IT issues.', 'Jeddah', '2025-01-14 18:27:57'),
(17, 4, 'Mobile App Developer', 'Develop and maintain mobile applications for Android and iOS platforms.', 'Dammam', '2025-01-14 18:27:57'),
(18, 5, 'Accountant', 'Manage company financial records and prepare financial reports.', 'Makkah', '2025-01-14 18:27:57'),
(19, 2, 'programmer ', 'java and database ', 'Riyadh', '2025-02-03 03:50:53');

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reset_code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- بنية الجدول `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `resumes`
--

INSERT INTO `resumes` (`id`, `user_id`, `resume_path`, `uploaded_at`) VALUES
(1, 1, '/uploads/ali_resume.pdf', '2025-01-14 16:42:34'),
(2, 3, '/uploads/sara_resume.pdf', '2025-01-14 16:42:34'),
(3, 5, '/uploads/aisha_resume.pdf', '2025-01-14 16:42:34');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('job_seeker','employer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `created_at`) VALUES
(1, 'Ali Al-Harbi', 'ali@example.com', '223', 'job_seeker', '2025-01-14 16:42:34'),
(2, 'Ahmed Al-Qahtani', 'ahmed@example.com', '1212', 'employer', '2025-01-14 16:42:34'),
(3, 'Sara Al-Otaibi', 'sara@example.com', 'password789', 'job_seeker', '2025-01-14 16:42:34'),
(4, 'Faisal Al-Ghamdi', 'faisal@example.com', 'password321', 'employer', '2025-01-14 16:42:34'),
(5, 'Aisha Al-Rajhi', 'aisha@example.com', 'password654', 'job_seeker', '2025-01-14 16:42:34'),
(6, 'Hussein Emad', 'HusseinEmad@gmail.come', '221233', 'job_seeker', '2025-01-14 17:22:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `resumes`
--
ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
