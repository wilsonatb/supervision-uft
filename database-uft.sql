-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 08:34 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supervision_uft`
--
CREATE DATABASE IF NOT EXISTS `supervision_uft` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `supervision_uft`;

-- --------------------------------------------------------

--
-- Table structure for table `decan`
--

CREATE TABLE `decan` (
  `id` int(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `decan_name` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `decan`
--

INSERT INTO `decan` (`id`, `name`, `decan_name`, `document`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(3, 'Ingeniería', 'nombre decano', '487951', '04121503739', 'decano@gmail.com', '2021-03-21 18:46:13', '2021-03-21 18:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `lapse`
--

CREATE TABLE `lapse` (
  `id` int(255) NOT NULL,
  `lapse` varchar(100) DEFAULT NULL,
  `date_range` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lapse`
--

INSERT INTO `lapse` (`id`, `lapse`, `date_range`, `created_at`, `updated_at`) VALUES
(5, '2021-1', '21/03/2021 - 14/04/2021', '2021-03-21 23:18:13', '2021-03-22 07:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `subject_id` int(255) NOT NULL,
  `lapse_id` int(255) NOT NULL,
  `stage_id` int(255) NOT NULL,
  `section_id` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `perfil` varchar(255) DEFAULT '-',
  `forum_info` varchar(255) DEFAULT '-',
  `welcome_course` varchar(255) DEFAULT '-',
  `welcome_video` varchar(255) DEFAULT '-',
  `folder` varchar(255) DEFAULT '-',
  `forum_info_use` varchar(255) DEFAULT '-',
  `forum_doubts` varchar(255) DEFAULT '-',
  `delivery_notes` varchar(255) DEFAULT '-',
  `tools_use` varchar(255) DEFAULT '-',
  `interaction` varchar(255) DEFAULT '-',
  `feedback` varchar(255) DEFAULT '-',
  `final_notes` varchar(255) DEFAULT '-',
  `updated` varchar(255) DEFAULT '-',
  `extracathedral` varchar(255) DEFAULT '-',
  `accomplish` varchar(255) DEFAULT '-',
  `comments` text DEFAULT '-',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-03-08 16:40:13', '2021-03-08 16:40:13'),
(2, 'director', '2021-03-08 16:40:13', '2021-03-08 16:40:13'),
(3, 'operativo', '2021-03-08 16:40:13', '2021-03-08 16:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(100) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(18, 1, 1, '2021-03-21 18:40:26', '2021-03-21 18:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(255) NOT NULL,
  `decan_id` int(255) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

CREATE TABLE `stage` (
  `id` int(255) NOT NULL,
  `stage` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`id`, `stage`, `created_at`, `updated_at`) VALUES
(1, 'Bloque cero', '2021-03-06 14:43:39', '2021-03-06 14:43:39'),
(2, 'Corte I', '2021-03-06 14:43:39', '2021-03-06 14:43:39'),
(3, 'Corte II', '2021-03-06 14:43:39', '2021-03-06 14:43:39'),
(4, 'Corte III', '2021-03-06 14:43:39', '2021-03-06 14:43:39'),
(5, 'Final', '2021-03-06 14:43:39', '2021-03-06 14:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(255) NOT NULL,
  `school_id` int(255) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject_user`
--

CREATE TABLE `subject_user` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `subject_id` int(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `phone`, `email`, `password`, `document`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'Admin', 'admin', '04121503739', 'admin@gmail.com', '$2y$10$y5/jGke/56IxVWHs5frRR.sj/CHWgsB44UICEqks/t0nr8YgJPhJa', '4791987', '2021-03-06 14:04:24', '2021-03-22 07:33:59', 'wJIbkExAUkeK3FKl4BNKddPPy8RLqSqAMFdgXQehHmKOsc2hdYY2VMFBWD8d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `decan`
--
ALTER TABLE `decan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lapse`
--
ALTER TABLE `lapse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parameter_user` (`user_id`),
  ADD KEY `fk_parameter_subject` (`subject_id`),
  ADD KEY `fk_parameter_lapse` (`lapse_id`),
  ADD KEY `fk_parameter_section` (`section_id`),
  ADD KEY `fk_parameter_stage` (`stage_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `fk_role_user_id` (`user_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_school_decan` (`decan_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stage`
--
ALTER TABLE `stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subject_school` (`school_id`);

--
-- Indexes for table `subject_user`
--
ALTER TABLE `subject_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_school_user` (`user_id`),
  ADD KEY `fk_school_subject` (`subject_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `decan`
--
ALTER TABLE `decan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lapse`
--
ALTER TABLE `lapse`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stage`
--
ALTER TABLE `stage`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject_user`
--
ALTER TABLE `subject_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parameter`
--
ALTER TABLE `parameter`
  ADD CONSTRAINT `fk_parameter_lapse` FOREIGN KEY (`lapse_id`) REFERENCES `lapse` (`id`),
  ADD CONSTRAINT `fk_parameter_section` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`),
  ADD CONSTRAINT `fk_parameter_stage` FOREIGN KEY (`stage_id`) REFERENCES `stage` (`id`),
  ADD CONSTRAINT `fk_parameter_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `fk_parameter_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `fk_role_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `fk_school_decan` FOREIGN KEY (`decan_id`) REFERENCES `decan` (`id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject_school` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `subject_user`
--
ALTER TABLE `subject_user`
  ADD CONSTRAINT `fk_school_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `fk_school_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
