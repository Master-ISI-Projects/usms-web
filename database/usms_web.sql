-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 04:47 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usms_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachements`
--

CREATE TABLE `attachements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scholar_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `scholar_year_id`, `created_at`, `updated_at`, `option_id`) VALUES
(1, 'classe de test', 1, '2020-01-12 23:42:55', '2020-01-12 23:42:55', 5),
(2, 'Classe ISI2', 1, '2020-01-13 07:09:57', '2020-01-13 07:09:57', 5);

-- --------------------------------------------------------

--
-- Table structure for table `class_semestres`
--

CREATE TABLE `class_semestres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_semestres`
--

INSERT INTO `class_semestres` (`id`, `classe_id`, `semester_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, NULL, NULL),
(2, 1, 8, NULL, NULL),
(3, 2, 7, NULL, NULL),
(4, 2, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `name`, `created_at`, `updated_at`, `teacher_id`) VALUES
(15, 'Informatique', '2020-01-11 12:53:03', '2020-01-12 09:51:17', 49),
(17, 'Mathematiques', '2020-01-11 12:56:09', '2020-01-11 12:56:09', NULL),
(18, 'Economie', '2020-01-11 12:56:09', '2020-01-11 12:56:09', NULL),
(19, 'Physique', '2020-01-11 12:56:09', '2020-01-11 12:56:09', NULL),
(20, 'Biologie', '2020-01-11 12:56:09', '2020-01-11 12:56:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_at` date DEFAULT NULL,
  `duration` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scholar_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `image`, `description`, `start_at`, `duration`, `scholar_year_id`, `created_at`, `updated_at`) VALUES
(1, 'Devox With Youssfi', 'events_images/1578746881_FB_IMG_15195107514905171.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi ea repellendus ullam, illum possimus natus dicta laboriosam, eaque, quisquam reprehenderit, libero accusamus est! Quam nulla incidunt provident! Doloribus exercitationem libero reiciendis, magnam ex ullam, corrupti nostrum corporis ipsa quaerat delectus nobis eligendi magni? Eos nulla dignissimos quibusdam eaque optio dolore? 22', '2020-01-30', '20 Jours', 1, '2020-01-11 11:43:37', '2020-01-11 11:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `type`, `duration`, `session`, `classe_id`, `module_id`, `created_at`, `updated_at`, `name`) VALUES
(1, 'Controle', '20 minutes', 'Ordonaire', 1, 8, '2020-01-13 01:39:18', '2020-01-13 01:39:18', 'examen de test'),
(2, 'Controle', '60 minutes', 'Ordonaire', 1, 10, '2020-01-13 02:07:29', '2020-01-13 02:07:29', 'Examen mobile');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mark` double(8,2) DEFAULT NULL,
  `session` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_20_01111_create_scholar_years_table', 1),
(4, '2020_01_08_061055_create_departements_table', 1),
(5, '2020_01_08_061218_create_options_table', 1),
(6, '2020_01_08_061236_create_semesters_table', 1),
(7, '2020_01_08_061300_create_modules_table', 1),
(8, '2020_01_08_061353_create_classes_table', 1),
(9, '2020_01_08_061421_create_class_semestres_table', 1),
(10, '2020_01_08_061448_create_students_table', 1),
(11, '2020_01_08_061556_create_registrations_table', 1),
(12, '2020_01_08_061616_create_teachers_table', 1),
(13, '2020_01_08_061653_create_teacher_modules_table', 1),
(14, '2020_01_08_061724_create_exams_table', 1),
(15, '2020_01_08_061803_create_marks_table', 1),
(16, '2020_01_08_061921_create_news_table', 1),
(17, '2020_01_08_061948_create_events_table', 1),
(18, '2020_01_08_062020_create_settings_table', 1),
(19, '2020_01_08_062047_create_school_managers_table', 1),
(20, '2020_01_08_062117_create_attachements_table', 1),
(21, '2020_01_08_084252_create_notifications_table', 1),
(22, '2020_01_10_224023_add_teacher_id_to_departements_table', 2),
(23, '2020_01_11_140426_add_teacher_id_to_options_table', 3),
(24, '2020_01_13_005018_add_option_id_to_classes_table', 4),
(25, '2020_01_13_014626_add_classe_id_to_teacher_modules_table', 5),
(26, '2020_01_13_021617_add_name_exams_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `semester_id`, `created_at`, `updated_at`) VALUES
(8, 'Gestion de projet', 7, '2020-01-11 13:04:59', '2020-01-11 13:04:59'),
(9, 'Oracle', 7, '2020-01-12 09:50:32', '2020-01-12 09:50:32'),
(10, 'Developpement Mobile 2', 8, '2020-01-13 00:54:36', '2020-01-13 00:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `published_at` date DEFAULT NULL,
  `scholar_year_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `image`, `description`, `published_at`, `scholar_year_id`, `created_at`, `updated_at`) VALUES
(3, 'Devoxx Maroc', 'users_images/1578745625_a.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium repellat incidunt aut dolores soluta deserunt voluptatem expedita enim, iusto veniam ad et quidem, mollitia modi voluptate. Amet ab id nemo ad optio ea, esse saepe veritatis quia aliquid enim quis unde animi delectus doloribus odit, veniam suscipit! Reprehenderit dignissimos, incidunt doloremque optio aliquam, sunt! Atque, doloremque molestias sapiente in placeat fugiat distinctio ipsa minus eaque recusandae cum sed illo eveniet inventore quaerat labore dolorem architecto facere! Illum quo ipsam omnis labore nesciunt maiores doloribus, nisi necessitatibus adipisci quaerat tenetur ab atque possimus pariatur voluptate aperiam voluptas, et assumenda nam est?', '2020-01-22', 2, '2020-01-11 00:22:58', '2020-01-12 12:54:21'),
(4, 'ROCKABYE', NULL, NULL, NULL, 1, '2020-01-11 00:25:07', '2020-01-11 00:25:07'),
(6, 'News test', 'new_images/1578743105_pp.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim ipsum, repellat quas nostrum. Quaerat, ab. Recusandae laudantium veritatis id facere consectetur nemo itaque aliquid ipsam doloribus eaque. Consequuntur nobis fugit deserunt, nesciunt fugiat doloribus incidunt provident impedit. Sequi quae cum consequatur! Ducimus porro beatae minus quisquam temporibus, laboriosam rem minima quasi, eaque excepturi? Exercitationem iusto fugiat et numquam dolorum reprehenderit laboriosam ad labore commodi est omnis, rem a, animi distinctio maxime quis dolores reiciendis totam sed libero molestias aperiam quod repudiandae sapiente? Nesciunt incidunt nihil quae dignissimos, alias! Aliquid nemo, minus fugit recusandae deleniti velit et rerum porro voluptates cumque ipsum ex. Sit repudiandae illum maiores, eum voluptatem autem asperiores maxime? Ut libero dicta reiciendis perspiciatis quis soluta, consequuntur voluptatem magnam rerum. Harum nihil recusandae, tempora ipsum, ipsa molestiae. Rerum, quas illo nostrum reiciendis doloremque! Necessitatibus quia ratione repellat consequatur reiciendis reprehenderit nulla facilis vero excepturi ipsum deserunt quos minima est, provident animi consectetur! Dicta quas porro voluptatum repellat, amet tenetur ut odit dolorem quisquam dolorum, consequuntur voluptatibus doloremque ipsum! Distinctio unde, quidem quas sit illum quae. Fugit, obcaecati, quibusdam. Dignissimos officiis in veritatis sunt laudantium nobis animi. Quas dignissimos blanditiis explicabo fugit perspiciatis consectetur sed quos. Accusamus, accusantium. Velit?', '2020-01-14', 1, '2020-01-11 10:45:06', '2020-01-11 10:45:06');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `classe_id`, `created_at`, `updated_at`) VALUES
(2, 'Notification 1', 'non', 1, NULL, '2020-01-13 11:55:15'),
(3, 'Notification 3', 'Teststststststsststst', NULL, '2020-01-13 11:30:40', '2020-01-13 11:30:40'),
(4, 'Notification 3', 'Teststststststsststst', NULL, '2020-01-13 11:31:18', '2020-01-13 11:31:18'),
(5, '1er annee', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam facilis, reiciendis libero! Delectus beatae, quia nam culpa officia eligendi amet!', 1, '2020-01-13 11:32:27', '2020-01-13 11:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `departement_id`, `created_at`, `updated_at`, `teacher_id`) VALUES
(5, 'Ingenieurie des systemes informatiques - (ISI)', 15, '2020-01-11 13:03:28', '2020-01-11 13:03:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `student_id`, `classe_id`, `created_at`, `updated_at`) VALUES
(1, 22, 1, NULL, NULL),
(2, 32, 1, NULL, NULL),
(3, 63, 1, NULL, NULL),
(4, 22, 2, NULL, NULL),
(5, 24, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scholar_years`
--

CREATE TABLE `scholar_years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scholar_year` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scholar_years`
--

INSERT INTO `scholar_years` (`id`, `scholar_year`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, '2020-2021', '2020-01-10', '2021-01-10', '2020-01-10 15:23:57', '2020-01-10 15:23:57'),
(2, '2021-2022', '2021-01-10', '2022-01-10', '2020-01-10 15:23:58', '2020-01-10 15:23:58'),
(3, '2022-2023', '2022-01-10', '2023-01-10', '2020-01-10 15:23:58', '2020-01-10 15:23:58'),
(4, '2023-2024', '2023-01-10', '2024-01-10', '2020-01-10 15:23:58', '2020-01-10 15:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `school_managers`
--

CREATE TABLE `school_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `option_id`, `created_at`, `updated_at`) VALUES
(7, 'S1', 5, '2020-01-11 13:04:45', '2020-01-11 13:04:45'),
(8, 'S2', 5, '2020-01-12 09:50:07', '2020-01-12 09:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'key1', 'value 2', '2020-01-12 23:01:05', '2020-01-12 23:01:05'),
(2, 'key2', 'value 3', '2020-01-12 23:01:05', '2020-01-12 23:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apogee_number` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `apogee_number`, `birth_date`, `user_id`, `created_at`, `updated_at`) VALUES
(21, '4778', '1982-02-14', 45, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(22, '2655', '1951-05-31', 46, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(23, '1566', '1927-12-26', 47, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(24, '2410', '1979-01-23', 48, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(25, '4230', '1997-10-09', 49, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(26, '1034', '1932-08-27', 50, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(27, '1740', '1991-02-02', 51, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(28, '2973', '1950-06-01', 52, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(29, '4360', '1963-10-24', 53, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(30, '1923', '2019-11-15', 54, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(31, '2204', '1995-08-23', 55, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(32, '1251', '1949-07-12', 56, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(33, '3799', '2012-11-26', 57, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(34, '4884', '2012-04-24', 58, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(35, '4551', '1999-03-02', 59, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(36, '2416', '1991-04-18', 60, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(37, '3024', '1992-01-22', 61, '2020-01-11 00:00:25', '2020-01-11 00:00:26'),
(38, '4164', '1940-11-07', 62, '2020-01-11 00:00:26', '2020-01-11 00:00:26'),
(39, '1068', '1947-09-24', 63, '2020-01-11 00:00:26', '2020-01-11 00:00:26'),
(40, '1380', '1974-03-24', 64, '2020-01-11 00:00:26', '2020-01-11 00:00:26'),
(41, '3889', '1974-11-24', 85, '2020-01-11 12:49:02', '2020-01-11 12:49:02'),
(42, '1826', '2008-02-24', 86, '2020-01-11 12:49:02', '2020-01-11 12:49:02'),
(43, '1245', '2016-06-11', 87, '2020-01-11 12:49:02', '2020-01-11 12:49:03'),
(44, '3376', '1940-03-24', 88, '2020-01-11 12:49:03', '2020-01-11 12:49:03'),
(45, '2280', '2018-08-05', 89, '2020-01-11 12:49:03', '2020-01-11 12:49:03'),
(46, '4885', '2016-06-23', 90, '2020-01-11 12:49:03', '2020-01-11 12:49:04'),
(47, '1784', '1997-10-16', 91, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(48, '4456', '1951-11-15', 92, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(49, '4804', '1936-04-15', 93, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(50, '4587', '1930-09-10', 94, '2020-01-11 12:49:04', '2020-01-11 12:49:05'),
(51, '1655', '1988-05-06', 95, '2020-01-11 12:49:05', '2020-01-11 12:49:05'),
(52, '4306', '1996-07-27', 96, '2020-01-11 12:49:05', '2020-01-11 12:49:05'),
(53, '1195', '2011-04-19', 97, '2020-01-11 12:49:05', '2020-01-11 12:49:05'),
(54, '4288', '1997-09-18', 98, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(55, '3623', '1949-03-14', 99, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(56, '3096', '1973-04-27', 100, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(57, '2830', '1941-10-28', 101, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(58, '3176', '1960-07-16', 102, '2020-01-11 12:49:07', '2020-01-11 12:49:07'),
(59, '3569', '1998-07-26', 103, '2020-01-11 12:49:07', '2020-01-11 12:49:07'),
(60, '1057', '2019-07-28', 104, '2020-01-11 12:49:07', '2020-01-11 12:49:07'),
(63, '12342225', '2020-01-09', 128, '2020-01-13 00:33:02', '2020-01-13 00:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `birth_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `birth_date`, `user_id`, `departement_id`, `created_at`, `updated_at`) VALUES
(43, '1947-08-31', 106, 15, '2020-01-11 12:56:04', '2020-01-11 13:06:11'),
(44, '1921-03-10', 107, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(45, '1958-02-26', 108, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(46, '2007-12-30', 109, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(47, '1989-06-01', 110, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(48, '1932-07-05', 111, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(49, '1961-09-02', 112, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(50, '1949-10-21', 113, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(51, '1950-01-11', 114, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(52, '2006-01-01', 115, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(53, '1989-04-06', 116, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(54, '1975-09-10', 117, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(55, '1977-03-21', 118, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(56, '1976-08-05', 119, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(57, '2012-10-19', 120, NULL, '2020-01-11 12:56:08', '2020-01-11 12:56:08'),
(58, '1935-03-31', 121, NULL, '2020-01-11 12:56:08', '2020-01-11 12:56:08'),
(59, '1994-10-15', 122, NULL, '2020-01-11 12:56:08', '2020-01-11 12:56:08'),
(60, '2016-06-19', 123, NULL, '2020-01-11 12:56:09', '2020-01-11 12:56:09'),
(61, '1965-03-01', 124, NULL, '2020-01-11 12:56:09', '2020-01-11 12:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_modules`
--

CREATE TABLE `teacher_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `classe_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `picture`, `tel`, `email`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mikel', 'Deckow', 'M', NULL, '939-553-3234', 'mouad@gmail.com', '$2y$10$jU.fXkChFO5C2BxqUZeBS.wTKZZXwf//n1BJz5VcUkR04seOpsZkq', 'admin', 1, NULL, '2020-01-10 15:21:41', '2020-01-10 15:21:41'),
(4, 'Aliya', 'Franecki', 'M', NULL, '627-641-8588 x069', 'andrew.heller@example.org', '$2y$10$Fq6./Ld.ykzy7CmtfIZWguQeRNgKUbEALgNZsUc.9YdOpj6r8v.gu', 'teacher', 1, NULL, '2020-01-10 15:23:51', '2020-01-10 15:23:51'),
(5, 'River', 'Mante', 'F', NULL, '287-503-5165', 'forest29@example.com', '$2y$10$hL8Q5e6jB8ra6thtYLzWLucWjL9zKE9eaH.q7MDVX0Lj9WleIWOaa', 'teacher', 0, NULL, '2020-01-10 15:23:51', '2020-01-10 15:23:51'),
(6, 'Alfreda', 'Stehr', 'F', NULL, '326.619.5804', 'caden43@example.com', '$2y$10$lD//McOMKVSU/L0W1UWL0ufWlNR6m.lAivTqZEFHaEt1TIy30bDC.', 'teacher', 0, NULL, '2020-01-10 15:23:52', '2020-01-10 15:23:52'),
(7, 'Kaylin', 'Gorczany', 'F', NULL, '1-963-681-1436', 'bogan.grady@example.org', '$2y$10$gbZy68LTnfAabViMJ2i6Je5DS1tJQOYfoxkifcG8RNX31XBXXUuOy', 'teacher', 0, NULL, '2020-01-10 15:23:52', '2020-01-10 15:23:52'),
(8, 'Eldridge', 'Davis', 'M', NULL, '+1-393-757-4537', 'sstokes@example.org', '$2y$10$AU9LLud625aJlpfqNfSoYe.tCBOGY2P1nhqzxN5NWYqd5L/jtpVzq', 'teacher', 0, NULL, '2020-01-10 15:23:52', '2020-01-10 15:23:52'),
(9, 'Kurtis', 'Denesik', 'M', NULL, '458.541.2514 x1459', 'cortney.greenholt@example.net', '$2y$10$hnlubXaDLfdJuv8ZKxnyzeRuZiVmJoOGNiGPrzyiP4QyafETl6cuy', 'teacher', 0, NULL, '2020-01-10 15:23:52', '2020-01-10 15:23:52'),
(10, 'Shanny', 'Hauck', 'F', NULL, '+1.286.758.7431', 'urban56@example.net', '$2y$10$r7FhjwiV/kLVIGn5VC3f/usUdUnr3dEi6TS/ixS/goPrxHZ6G.KS.', 'teacher', 0, NULL, '2020-01-10 15:23:53', '2020-01-10 15:23:53'),
(11, 'Abbie', 'Littel', 'M', NULL, '+1 (236) 416-8274', 'krunte@example.net', '$2y$10$zmx4pQDsc1OzRmjUoKTZNOOQ0q9VmNZfwglAoBLI6Ap1CizzrRopq', 'teacher', 1, NULL, '2020-01-10 15:23:53', '2020-01-10 15:23:53'),
(12, 'Raquel', 'Zulauf', 'F', NULL, '1-476-764-2320', 'emery76@example.org', '$2y$10$f0ePGJBrBwbAgRrhCJuMsubVMRnjnukWxjmsQKa.2dOiKtK.pkw4q', 'teacher', 0, NULL, '2020-01-10 15:23:53', '2020-01-10 15:23:53'),
(13, 'Tony', 'Wilkinson', 'M', NULL, '746-516-5398 x49084', 'aabbott@example.net', '$2y$10$Uxwjj54/SnW8gLuoMkgfe.NrkTE84jReeJcHWiQeV3bVNqn1cR0Lq', 'teacher', 1, NULL, '2020-01-10 15:23:54', '2020-01-10 15:23:54'),
(14, 'Deven', 'Mante', 'F', NULL, '(850) 846-8060 x27062', 'wcruickshank@example.org', '$2y$10$QDmxyTJi3MNWwr2Nf5w4Ve0iLV/Sk6sPnU.oizAT0rPDZI7BYKo72', 'teacher', 1, NULL, '2020-01-10 15:23:54', '2020-01-10 15:23:54'),
(15, 'Janick', 'Hoeger', 'F', NULL, '(341) 348-6870 x054', 'hudson.gerry@example.org', '$2y$10$MNG2AOiFeJxmKb4NoGUHoebNv5pQmrYWYq63MUofS9Z/6TBVFJOlK', 'teacher', 1, NULL, '2020-01-10 15:23:54', '2020-01-10 15:23:54'),
(16, 'Ericka', 'Marvin', 'M', NULL, '634.607.6050 x2496', 'ryan.bernier@example.org', '$2y$10$tkq47Oo3tAdqmWZ3J8pVFuc20IUcjqcyauLRgEFfHK.EoUbpP5NKm', 'teacher', 0, NULL, '2020-01-10 15:23:55', '2020-01-10 15:23:55'),
(17, 'Cory', 'Leuschke', 'F', NULL, '659-284-7541 x21377', 'borer.monserrat@example.com', '$2y$10$iMh9HQs4VUA2k4VIei.aCuKzJYB4jjKGtccHCzOQ2fRJQvaich0ue', 'teacher', 1, NULL, '2020-01-10 15:23:56', '2020-01-10 15:23:56'),
(18, 'Javon', 'McDermott', 'F', NULL, '659-262-7838', 'zstokes@example.net', '$2y$10$8KMXJGONBYJql14xJwEkAeza0w341H8P0brD84hZZYpEl5KgpEDRW', 'teacher', 1, NULL, '2020-01-10 15:23:57', '2020-01-10 15:23:57'),
(19, 'Hollis', 'Weber', 'M', NULL, '+1-217-266-9187', 'marcus.hyatt@example.com', '$2y$10$Sufsc202SjxQYRmWZsvRP.6C6IJPF9xGYXdr4xb1Qp1hIBUCX1z.C', 'teacher', 0, NULL, '2020-01-10 15:23:57', '2020-01-10 15:23:57'),
(20, 'Genoveva', 'Kemmer', 'F', NULL, '1-687-571-6401', 'jaskolski.reanna@example.org', '$2y$10$0hPsEAdcJL2TnsRu8X4wHuNIRG7AMVjQ6D9E1LswNflrg34IJhX9a', 'teacher', 0, NULL, '2020-01-10 15:23:57', '2020-01-10 15:23:57'),
(21, 'Bart', 'Barrows', 'F', NULL, '551-791-3493 x599', 'jettie62@example.net', '$2y$10$F0ifswsJzmRUqMvdwE05uOMCJjjpRsEtJQPIQF1Qy71QjIudtRwe2', 'teacher', 1, NULL, '2020-01-10 15:23:57', '2020-01-10 15:23:57'),
(22, 'Mouad', 'ZIANI', 'M', 'users_images/1578675024_68265231_925497774457268_5745683626545119232_n (1).jpg', '0654899763', 'mouad.ziani1997@gmail.com', '$2y$10$5yexSZy9oZ6x2nt41Ncu4ellOz/NGlyp0T3NW72DwOORj1eNS3F62', 'teacher', 1, NULL, '2020-01-10 15:50:24', '2020-01-10 15:50:24'),
(45, 'Andy', 'Homenick', 'F', NULL, '1-854-672-8152 x94243', 'beaulah.koepp@example.net', '$2y$10$SXaK56y8pBatWw19LI3PoOMtlxSJqkyYQdegw6MEPxfc9wfXhQKLi', 'student', 1, NULL, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(46, 'Morgan', 'Crona', 'F', NULL, '(362) 625-1291', 'greenholt.ignacio@example.org', '$2y$10$NTVyVUOxa50i1A479RGRf.GCVVqdHu1x93m01fXLpeF5SpzyasW2q', 'student', 1, NULL, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(47, 'Remington', 'Parker', 'F', NULL, '1-959-441-6263 x51912', 'gwyman@example.org', '$2y$10$lZ0vhmn2Q1dIw4SZXwLnD.HCLO7UczeXE3z.QgHJpYRul5jjskxXq', 'student', 1, NULL, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(48, 'Trent', 'Lueilwitz', 'M', NULL, '(587) 792-7497 x25651', 'aliza03@example.com', '$2y$10$ivYjHLiYigzxKdbs7GO/9e9WGf7VpsQEOKMgDQLGlZUyk42G9BUAC', 'student', 0, NULL, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(49, 'Griffin', 'Keebler', 'F', NULL, '220-231-4668 x56024', 'alysha12@example.com', '$2y$10$MB/NgvKY99scqxV2v9j0be3.8NcpxXmN5wOoCIxUffrgSUkyE85Li', 'student', 1, NULL, '2020-01-11 00:00:22', '2020-01-11 00:00:22'),
(50, 'Blaise', 'Paucek', 'M', NULL, '+19588417267', 'victoria.goyette@example.org', '$2y$10$NMSXMxuYeuuTY9DcyU06/OEZKutCfduTh86zoHvzM.gbKYHyH3yjO', 'student', 0, NULL, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(51, 'Elda', 'Kuphal', 'F', NULL, '1-447-552-2967', 'fredrick.marquardt@example.com', '$2y$10$mmAuwqL.PQOlddgBZUPW6edVLeQaS4PKmORkBa54dnfluAqSQueGW', 'student', 1, NULL, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(52, 'Christelle', 'Tillman', 'M', NULL, '251.751.8128 x988', 'krath@example.com', '$2y$10$vvenkMFcFEDTRZWWOETBn.TmUxDoQewUqNksNrVATiiQkZ8CGrHdm', 'student', 0, NULL, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(53, 'Magnus', 'Legros', 'M', NULL, '+1 (752) 339-7536', 'mccullough.ebony@example.org', '$2y$10$zYK1OEhDN.XfdtQoVh2tLu5KwVoBeeH4BNiWDurM4i4Ne7RSozXwK', 'student', 0, NULL, '2020-01-11 00:00:23', '2020-01-11 00:00:23'),
(54, 'Chris', 'Heathcote', 'M', NULL, '306-341-8636 x3374', 'vabernathy@example.net', '$2y$10$MpZGuQEhLYt0dMfBbLmueempjexF9PcwvTyauVbn/iUWvrAfoVe9.', 'student', 0, NULL, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(55, 'Milford', 'Gislason', 'F', NULL, '(202) 551-0087 x2793', 'sandra.pacocha@example.com', '$2y$10$IKzUd1S4KhDXgxxxiXrNAevUY7rFo.BWkAPuPUVFAJmmR0/t1JZjW', 'student', 1, NULL, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(56, 'Leonie', 'McDermott', 'M', NULL, '869.403.2707 x1739', 'unader@example.com', '$2y$10$GXBiTfdUFFgBVynqgaZrU.mhkj0DjjuWKgHdNsHmVjq5ayuEjZaU.', 'student', 0, NULL, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(57, 'Genevieve', 'Bosco', 'M', NULL, '868.424.1724 x915', 'glenda.thiel@example.com', '$2y$10$jZ3Z/lB7uL15UmKDMgPtQO/AK4xB3GO0fR2BcvvU7Q3cPbzKkOsO6', 'student', 1, NULL, '2020-01-11 00:00:24', '2020-01-11 00:00:24'),
(58, 'Sallie', 'Schuppe', 'F', NULL, '+1-757-672-9406', 'boyle.landen@example.org', '$2y$10$3E6nbBl3rHHR6N.9kigSIupPu3YhenwnNh8WjwzEPCHm08uHjU9FW', 'student', 1, NULL, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(59, 'Lewis', 'Reichert', 'M', NULL, '(562) 434-2604', 'brayan.willms@example.org', '$2y$10$aEcT5R0DH5g58RkGE46FD.I7P9mQowxIFsZHgTDmPzoFckHlS1mVK', 'student', 0, NULL, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(60, 'Catherine', 'Kerluke', 'F', NULL, '225-322-3109 x6305', 'pswaniawski@example.org', '$2y$10$Kl8A96NzMIwqTMcM6T7Jb.CN3fL0PYOl9nQWgTchKGC1VYmvppGUO', 'student', 0, NULL, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(61, 'Russ', 'Reynolds', 'F', NULL, '856.330.0961 x857', 'cassin.kay@example.net', '$2y$10$W4w1HbRkA6rEBEW3AH8mC.By.OyJzP5MokXCFQ4zZenDZgNsZ4krq', 'student', 1, NULL, '2020-01-11 00:00:25', '2020-01-11 00:00:25'),
(62, 'Stephanie', 'Hartmann', 'F', NULL, '328.380.4774 x727', 'ztreutel@example.com', '$2y$10$lt0cVq65aUe7vd8kBp94FONvn3QImc0alOoiUEmN/UaZ0up8LOw2u', 'student', 0, NULL, '2020-01-11 00:00:26', '2020-01-11 00:00:26'),
(63, 'Garfield', 'Tillman', 'M', NULL, '(695) 687-7591', 'nova70@example.org', '$2y$10$OXvI0wHPp7bRAZrkCMfUceJOk3joiXbMEYmL5wtGMkIW.x5MtIcG6', 'student', 0, NULL, '2020-01-11 00:00:26', '2020-01-11 00:00:26'),
(64, 'Gail', 'Breitenberg', 'F', NULL, '(792) 224-8897', 'edison.bergnaum@example.com', '$2y$10$31.znRQ8HkN4ot/3pWdMguFWrImFc0jXw.goptGRF0S9wbfFrQpI.', 'student', 0, NULL, '2020-01-11 00:00:26', '2020-01-11 00:00:26'),
(69, 'Alexander', 'Emmerich', 'F', NULL, '830-859-8691 x0273', 'luigi.prosacco@example.net', '$2y$10$mDvJ/KO52ZiyG3H42544suSx2yMMmPb/O7Hvoiosj1GvKCoMKBWiS', 'teacher', 0, NULL, '2020-01-11 12:33:05', '2020-01-11 12:33:05'),
(70, 'Chasity', 'Hauck', 'M', NULL, '1-889-388-6004', 'janiya.feil@example.org', '$2y$10$D9iC/ZLxM8PZRgL.viQrbezXdeKxBxXqYdS3NPhgQKAFWCwf/Tbau', 'teacher', 0, NULL, '2020-01-11 12:33:06', '2020-01-11 12:33:06'),
(71, 'Isabel', 'Heathcote', 'F', NULL, '940-995-3003', 'devyn24@example.com', '$2y$10$L9SscDSADtUoBBoj4PlKweplV3pO5MPfrN/q4B2uj1xkhewMwV78u', 'teacher', 0, NULL, '2020-01-11 12:33:06', '2020-01-11 12:33:06'),
(72, 'Chaim', 'Kovacek', 'M', NULL, '1-385-956-6662', 'xwelch@example.org', '$2y$10$RQLUXlP/IeBF4mbcrqA/mOhNspA/B8g/Nh9KXFAoH01xBh.0kZ3Ua', 'teacher', 0, NULL, '2020-01-11 12:33:06', '2020-01-11 12:33:06'),
(73, 'Alfred', 'Breitenberg', 'F', NULL, '(550) 231-7593 x33160', 'else.hyatt@example.com', '$2y$10$5xifTFNdPZirQU6WkvEX7eWpwwpla8nbx8d3PaMvtU/JLtLESGqGa', 'teacher', 1, NULL, '2020-01-11 12:33:07', '2020-01-11 12:33:07'),
(74, 'Gwen', 'Rice', 'M', NULL, '554.777.3937 x4120', 'bartoletti.carlee@example.com', '$2y$10$JEc4hiRSekl4mvGHovbWuez8sbgSUws.cTzvNoPoq.7LlDLkxGSX2', 'teacher', 1, NULL, '2020-01-11 12:33:07', '2020-01-11 12:33:07'),
(75, 'Rozella', 'Wiza', 'M', NULL, '(356) 907-9264', 'maybell.hackett@example.org', '$2y$10$GOlofAQR1KqeSppr14Z0h.v27Nx.hB0689Rpwxtekxsc5uXwuVTbO', 'teacher', 1, NULL, '2020-01-11 12:33:08', '2020-01-11 12:33:08'),
(76, 'Sonya', 'Gaylord', 'F', NULL, '725.230.9566', 'durward.vandervort@example.com', '$2y$10$auzwD2WexaGoO8v8Q1MvS.RwTvWdihEvt4k.N7GmShcVI2TbcKWRS', 'teacher', 1, NULL, '2020-01-11 12:33:09', '2020-01-11 12:33:09'),
(77, 'Israel', 'Senger', 'F', NULL, '790-523-7721 x529', 'jaylan40@example.com', '$2y$10$ea4ZFwcsqHIMeCkc2RnsOOocSSaGdHcBjaaduaIwBb.En3dGSEF62', 'teacher', 1, NULL, '2020-01-11 12:33:09', '2020-01-11 12:33:09'),
(78, 'Deshawn', 'Kilback', 'F', NULL, '407.298.8288 x111', 'mazie72@example.org', '$2y$10$uOAybtCUQP8QhuYDM7E6kesZtPzKXTlHkrrtxQM0EIh650ozJT9gG', 'teacher', 0, NULL, '2020-01-11 12:33:09', '2020-01-11 12:33:09'),
(79, 'Vincenzo', 'Flatley', 'M', NULL, '515-361-6094 x9315', 'rosario.beier@example.org', '$2y$10$xKOVDry8KGz8yugX2nD93.aiyUqFaYTJrGjemOgBBsKjGT.gbhLC.', 'teacher', 0, NULL, '2020-01-11 12:33:10', '2020-01-11 12:33:10'),
(80, 'Gerald', 'Schultz', 'M', NULL, '424.912.4883 x8256', 'dickinson.melody@example.org', '$2y$10$BzQi.oteRbLJvOmg.IFic.DL/nGsxOOPZr4f/dTm8aF/CSzRgNHJW', 'teacher', 0, NULL, '2020-01-11 12:33:10', '2020-01-11 12:33:10'),
(81, 'Phoebe', 'Halvorson', 'F', NULL, '+1-992-653-4698', 'amohr@example.org', '$2y$10$Wxvhg70XnG.x./8OKBl29uxwe66RK39Sk/BiWTvr1aNCS7lf14COi', 'teacher', 0, NULL, '2020-01-11 12:33:10', '2020-01-11 12:33:10'),
(82, 'Ola', 'Kozey', 'M', NULL, '734-549-9819 x48565', 'freddie.hoppe@example.com', '$2y$10$AdPWoRAJphFkxjsIGK07BOd4lOUGroZwiKVdt2mYSrAtEALgkkLjW', 'teacher', 0, NULL, '2020-01-11 12:33:11', '2020-01-11 12:33:11'),
(83, 'Rosalyn', 'Lueilwitz', 'M', NULL, '637.367.7163 x32487', 'melvina.mills@example.com', '$2y$10$nIBl3.VHHBvHkWTDE7.YM.jwymGJVEoN7Eh09PsG3pmSlQiN8Tt.a', 'teacher', 1, NULL, '2020-01-11 12:33:12', '2020-01-11 12:33:12'),
(84, 'Emilie', 'Wehner', 'F', NULL, '(723) 407-4951 x5896', 'marlene.koss@example.net', '$2y$10$.OiJdBGz4KadxULIdP59eebIAiC3V5twLD.BmbreJR1UGzvtNP4VC', 'teacher', 1, NULL, '2020-01-11 12:33:12', '2020-01-11 12:33:12'),
(85, 'Hosea', 'Crooks', 'F', NULL, '1-864-292-9252 x93813', 'morton75@example.com', '$2y$10$IxpWeNbAl9mABexq8XjtTuvGL/lRiB5.C2BCQboFBiunvRI0OXGvW', 'student', 0, NULL, '2020-01-11 12:49:01', '2020-01-11 12:49:01'),
(86, 'Gonzalo', 'Pfannerstill', 'F', NULL, '256-390-0366', 'casper.finn@example.com', '$2y$10$a/7gZSVY413Uc2mwgQxHcOx4OQIC20KLM4dquE7WzeTrPDA3HUuwG', 'student', 1, NULL, '2020-01-11 12:49:02', '2020-01-11 12:49:02'),
(87, 'Reginald', 'Bins', 'F', NULL, '(437) 841-4715', 'mireya98@example.net', '$2y$10$c2M.OFuq1L/JMPEK3t0/i.YLVanuL.Lwf16G/EVFeJtMUKxaVEAEC', 'student', 0, NULL, '2020-01-11 12:49:02', '2020-01-11 12:49:02'),
(88, 'Rafael', 'Gleason', 'M', NULL, '528.923.5435 x311', 'marlen.stoltenberg@example.org', '$2y$10$9iQksUcgFc7NN4PIErQgMe.qm1Ar454em1RQ6ck/hY0VRfy7C3oum', 'student', 1, NULL, '2020-01-11 12:49:03', '2020-01-11 12:49:03'),
(89, 'Katheryn', 'Johnston', 'F', NULL, '1-642-429-7244 x5362', 'hegmann.jamey@example.net', '$2y$10$ZrV4T6PHBzBeMRt9Wzqnieq8VkYVVvPUwCQbUSP9f5xN/1ywNqYsy', 'student', 1, NULL, '2020-01-11 12:49:03', '2020-01-11 12:49:03'),
(90, 'Reid', 'Hoeger', 'F', NULL, '1-481-966-6868 x59871', 'goyette.joe@example.net', '$2y$10$mW0ItFIAgYceIPLXbq4nUOmfsuw7.j3J69Ixgyrij/DnUrL3ft54e', 'student', 1, NULL, '2020-01-11 12:49:03', '2020-01-11 12:49:03'),
(91, 'Mia', 'Kilback', 'M', NULL, '795-202-7928', 'cordie43@example.net', '$2y$10$LNtxHD8JpWoHNWDVF3quuemvYF20JdKTH1NTm5IidWyU5FyYqeNcK', 'student', 1, NULL, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(92, 'Reggie', 'Cassin', 'M', NULL, '1-420-348-9359 x960', 'wava.yundt@example.org', '$2y$10$D/.shKl3J.clHVejIy6ZReP/dsTPKGVNn9zjW/MjD3Ep6vSCdMf/m', 'student', 1, NULL, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(93, 'Vella', 'Raynor', 'F', NULL, '458.478.6887 x26565', 'percy88@example.org', '$2y$10$XCTsHD7pZF/XRRUuxwjHo.2yo1Uaonpsp5fECEYn6WVKWtAaWPnx.', 'student', 0, NULL, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(94, 'Ed', 'Botsford', 'M', NULL, '383-405-5027 x266', 'oreilly.josianne@example.com', '$2y$10$LSLOQ0yO3pbnkMR0A7pRAuBee7.nFihelgifgI.8R5RzbGhCRwQYe', 'student', 1, NULL, '2020-01-11 12:49:04', '2020-01-11 12:49:04'),
(95, 'Napoleon', 'Mayer', 'F', NULL, '(979) 494-4342 x1685', 'xcartwright@example.com', '$2y$10$l1wPnxh1m.D66kVvCVmzA.lc9HQ2gLY7ED3EZthON2he4b30vwPMm', 'student', 1, NULL, '2020-01-11 12:49:05', '2020-01-11 12:49:05'),
(96, 'Parker', 'O\'Keefe', 'M', NULL, '(681) 300-8370', 'xosinski@example.org', '$2y$10$TuEVDnESsTphh3l0u205Ce7b6uF9jhWVMfO6iKd3oTURAT53mUjdu', 'student', 1, NULL, '2020-01-11 12:49:05', '2020-01-11 12:49:05'),
(97, 'Elnora', 'Morissette', 'F', NULL, '+16138559619', 'frances70@example.com', '$2y$10$GfDE7wCOoid.iObhHRWCRuYMa6tRBT9RlKXqTu6f0t53LUMJ6BnwS', 'student', 1, NULL, '2020-01-11 12:49:05', '2020-01-11 12:49:05'),
(98, 'Dorthy', 'Deckow', 'F', NULL, '472-610-4634 x89046', 'helen84@example.net', '$2y$10$C6tJHcg9sbRIdSHifQO7s.8FImzjvn1aWL84ietkg.3fbHLKggasu', 'student', 0, NULL, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(99, 'Emmalee', 'Welch', 'M', NULL, '+1.586.407.9701', 'sauer.rosalinda@example.net', '$2y$10$jD7Ij.KvmT.fTVA6u504a.mqmiyDxJryy3D288KlzSI5w/sDLBBQa', 'student', 1, NULL, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(100, 'Ben', 'Hodkiewicz', 'M', NULL, '929.770.0961 x1191', 'sadie.moen@example.org', '$2y$10$W9hub2oePEYP3XywfDc1cOy4VI.8dJsq5q0AazBYMVXMupRBZCzkq', 'student', 1, NULL, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(101, 'Mozelle', 'Flatley', 'M', NULL, '423-521-3246', 'jschowalter@example.org', '$2y$10$KoyKyqnQ837OBwyWwK11duDlvRMwjsMQ0CDZavVD90QrT3JEYcmlC', 'student', 1, NULL, '2020-01-11 12:49:06', '2020-01-11 12:49:06'),
(102, 'Tyrique', 'Klein', 'M', NULL, '+1.732.695.9843', 'orath@example.org', '$2y$10$MCST85cHZt5Gd4I7L..FqOK3n2TnHBbQamXRclXnWmlekNeAns37C', 'student', 1, NULL, '2020-01-11 12:49:07', '2020-01-11 12:49:07'),
(103, 'Ephraim', 'Bauch', 'F', NULL, '(691) 824-8441 x467', 'nschmitt@example.org', '$2y$10$RhW3BrKIpuNp0sqVRyqXLOASCeMT.vCjSUo/dqT4Dd.ukH2APsfP6', 'student', 1, NULL, '2020-01-11 12:49:07', '2020-01-11 12:49:07'),
(104, 'Hailie', 'Hintz', 'M', NULL, '(663) 296-7229', 'letitia.price@example.org', '$2y$10$EHQOx1QOQQ6aY0npQvQuNuvxdcWpPU37JrUjIlsyzP.KlwroAozTC', 'student', 1, NULL, '2020-01-11 12:49:07', '2020-01-11 12:49:07'),
(106, 'Ara', 'Pfannerstill', 'M', NULL, '529-490-3667 x86996', 'gwolf@example.net', '$2y$10$4OjEEGIREfYKMn1wE6UBHOMae0lFoPhxoKWSxZBGvqKw54xohn0Zy', 'teacher', 0, NULL, '2020-01-11 12:56:04', '2020-01-11 13:06:10'),
(107, 'Monroe', 'Walsh', 'F', NULL, '1-389-597-1864', 'zelma.fahey@example.org', '$2y$10$hxKPi6fV8t8mMq3XyEcoxuENXTLsz70WYe8OuadnZLCk9dDFyl6m.', 'teacher', 1, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(108, 'Sid', 'Jacobson', 'F', NULL, '+1.730.890.2127', 'zhammes@example.com', '$2y$10$Dx/sB29pu1HaZWTz8dwICuBswrFaPe1uj.xF.lwMYNMBz51bBnJfG', 'teacher', 0, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(109, 'Abbie', 'Pfannerstill', 'M', NULL, '+1-618-267-7805', 'baufderhar@example.net', '$2y$10$0mhvJMmUxCaep.CwzEdz6.aLPH2yTI3j3oTx/Empp.LTzbYqdsfjq', 'teacher', 0, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(110, 'Landen', 'Blanda', 'M', NULL, '+1 (380) 625-2452', 'bruce74@example.com', '$2y$10$FUx6ZWMY7WlDGwj2vwTMbu.y6BgW0U4LPgBA.ETMFuTlDzxzGxaOq', 'teacher', 0, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(111, 'Norma', 'Adams', 'F', NULL, '223.313.2185 x6958', 'nikolaus.monique@example.net', '$2y$10$nIfoYP9M5U2k1fscV2HZgu/zuTXa6JvUYk/5ywSqvkBatRncb97Cm', 'teacher', 1, NULL, '2020-01-11 12:56:05', '2020-01-11 12:56:05'),
(112, 'Noble', 'Shields', 'F', NULL, '898.581.1974', 'cormier.chet@example.net', '$2y$10$uWvlmqY2hI/lJwtHJVPWEuvLidoFTSiu9aUmoV2HhYvObn2beXHma', 'teacher', 1, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(113, 'Maxime', 'Howe', 'F', NULL, '674-448-7927 x230', 'makenzie31@example.org', '$2y$10$wtJ8pisyUdrHe7ANSTZ4q.uHe2qO.O7tZmPl46Zm0OQBhyJrNHb56', 'teacher', 0, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(114, 'Donny', 'O\'Reilly', 'M', NULL, '612.429.8072 x2953', 'vaughn.windler@example.org', '$2y$10$i9Pg17MeGsFOla8ZnT9Om.C2sp5KyuDc9FkFpaQyiRnfBHOtGp4Fy', 'teacher', 0, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(115, 'Eldridge', 'Ward', 'M', NULL, '1-482-334-8495', 'ursula69@example.com', '$2y$10$lq/lFag1Q4IEDNeIwXIs9OJvEziONXH2R8teJTRcSKwiDzkjGqFJK', 'teacher', 1, NULL, '2020-01-11 12:56:06', '2020-01-11 12:56:06'),
(116, 'Benton', 'Sipes', 'F', NULL, '686-744-9140 x56199', 'vfeil@example.net', '$2y$10$c/zbVlNG2DElFfhTG9/cpumS.zf3eqPDbcu.sX7ectG/fScpeS.86', 'teacher', 1, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(117, 'Providenci', 'Parker', 'M', NULL, '668-319-1891 x6142', 'haley.emmanuel@example.net', '$2y$10$pnpkvKSiRfT1fG4Okpzs7OnEg0FFn2nS/oGuE63FND0tBR0q520YW', 'teacher', 1, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(118, 'Hiram', 'Blanda', 'M', NULL, '645.952.7852', 'jaime68@example.com', '$2y$10$B/wSoAsqTnmrVCuH1f3yDOOjnimYBF7KpPMMMRxpsZ4UK46IDTFvG', 'teacher', 1, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(119, 'Kenyatta', 'Friesen', 'F', NULL, '+1.585.667.5892', 'yharber@example.net', '$2y$10$Sk2OOoZ8RLl8kKFQuRztuOy/Z7IhtTvk34m4ctR5xvfrl7stNQeWO', 'teacher', 0, NULL, '2020-01-11 12:56:07', '2020-01-11 12:56:07'),
(120, 'Alfreda', 'Beatty', 'F', NULL, '+1 (821) 265-6833', 'fabiola22@example.org', '$2y$10$5QriCWE448Z/75MztGxLrO2PbBaxNaf.D.qzuByxlJFF2RSNqBrAS', 'teacher', 0, NULL, '2020-01-11 12:56:08', '2020-01-11 12:56:08'),
(121, 'Terence', 'Farrell', 'M', NULL, '1-240-662-2736', 'mhamill@example.com', '$2y$10$UVQn80cmdhXoOhxyxbWyi.jzWcy0A0QIe9HlbRP51OdFcSOjaTfQW', 'teacher', 1, NULL, '2020-01-11 12:56:08', '2020-01-11 12:56:08'),
(122, 'Alyce', 'Rath', 'M', NULL, '236.349.3769', 'modesto.wisozk@example.net', '$2y$10$dqQYVKXcza7QtsuQBQBLt.Oing0XstB2Kh8ffh8GsBGdrqEqhcZDC', 'teacher', 1, NULL, '2020-01-11 12:56:08', '2020-01-11 12:56:08'),
(123, 'Alfreda', 'Hoppe', 'M', NULL, '716.708.6060 x272', 'malinda22@example.org', '$2y$10$z4AT5vaK4./PC9uOimb31eMsJ2rnENE/OliadohUSwMTWJkWfyQU2', 'teacher', 0, NULL, '2020-01-11 12:56:09', '2020-01-11 12:56:09'),
(124, 'Otho', 'Dicki', 'M', NULL, '(213) 781-1745 x79883', 'turner.kaya@example.net', '$2y$10$93Bv7/lP4/j676SgX.n4fes86LeuoX2QCKtj0WUXrgltGZ74GxYhC', 'teacher', 0, NULL, '2020-01-11 12:56:09', '2020-01-11 12:56:09'),
(128, 'NAIM2', 'Ismail3', 'M', 'users_images/1578879182_68265231_925497774457268_5745683626545119232_n (1).jpg', '012345678923', 'naim@ismail.com3', NULL, 'student', 1, NULL, '2020-01-13 00:33:02', '2020-01-13 00:41:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachements`
--
ALTER TABLE `attachements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachements_classe_id_foreign` (`classe_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_scholar_year_id_foreign` (`scholar_year_id`),
  ADD KEY `classes_option_id_foreign` (`option_id`);

--
-- Indexes for table `class_semestres`
--
ALTER TABLE `class_semestres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_semestres_classe_id_foreign` (`classe_id`),
  ADD KEY `class_semestres_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departements_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_scholar_year_id_foreign` (`scholar_year_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exams_classe_id_foreign` (`classe_id`),
  ADD KEY `exams_module_id_foreign` (`module_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_exam_id_foreign` (`exam_id`),
  ADD KEY `marks_student_id_foreign` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_scholar_year_id_foreign` (`scholar_year_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_classe_id_foreign` (`classe_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_departement_id_foreign` (`departement_id`),
  ADD KEY `options_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registrations_student_id_foreign` (`student_id`),
  ADD KEY `registrations_classe_id_foreign` (`classe_id`);

--
-- Indexes for table `scholar_years`
--
ALTER TABLE `scholar_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_managers`
--
ALTER TABLE `school_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_managers_user_id_foreign` (`user_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semesters_option_id_foreign` (`option_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_apogee_number_unique` (`apogee_number`),
  ADD KEY `students_user_id_foreign` (`user_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`),
  ADD KEY `teachers_departement_id_foreign` (`departement_id`);

--
-- Indexes for table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_modules_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_modules_module_id_foreign` (`module_id`),
  ADD KEY `teacher_modules_classe_id_foreign` (`classe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachements`
--
ALTER TABLE `attachements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_semestres`
--
ALTER TABLE `class_semestres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scholar_years`
--
ALTER TABLE `scholar_years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school_managers`
--
ALTER TABLE `school_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachements`
--
ALTER TABLE `attachements`
  ADD CONSTRAINT `attachements_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `classes_scholar_year_id_foreign` FOREIGN KEY (`scholar_year_id`) REFERENCES `scholar_years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_semestres`
--
ALTER TABLE `class_semestres`
  ADD CONSTRAINT `class_semestres_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_semestres_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_scholar_year_id_foreign` FOREIGN KEY (`scholar_year_id`) REFERENCES `scholar_years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `exams_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `marks_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_scholar_year_id_foreign` FOREIGN KEY (`scholar_year_id`) REFERENCES `scholar_years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `options_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_managers`
--
ALTER TABLE `school_managers`
  ADD CONSTRAINT `school_managers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `semesters`
--
ALTER TABLE `semesters`
  ADD CONSTRAINT `semesters_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  ADD CONSTRAINT `teacher_modules_classe_id_foreign` FOREIGN KEY (`classe_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_modules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
