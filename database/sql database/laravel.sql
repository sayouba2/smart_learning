-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 juin 2025 à 17:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assignments`
--

CREATE TABLE `assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` datetime NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `assignments`
--

INSERT INTO `assignments` (`id`, `title`, `description`, `due_date`, `course_id`, `teacher_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 'Devoir 1 - Docker pour developper', 'Description du devoir 1', '2025-06-10 23:59:59', 50, 3, NULL, '2025-05-29 20:17:01', '2025-05-29 20:17:01'),
(2, 'Devoir 2 - Cybersécurité', 'Description du devoir 2', '2025-06-12 23:59:59', 51, 3, NULL, '2025-05-29 20:17:01', '2025-05-29 20:17:01'),
(3, 'Devoir 3 - WordPress', 'Description du devoir 3', '2025-06-15 23:59:59', 61, 3, NULL, '2025-05-29 20:17:01', '2025-05-29 20:17:01'),
(4, 'Analyse de texte - chapitre 3s', 'descriptions', '2025-06-03 01:16:00', 54, 3, NULL, '2025-05-29 23:17:33', '2025-05-29 23:17:33');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Développement Web', 'developpement-web', '2025-05-05 17:18:28', '2025-05-05 17:18:28'),
(2, 'Design Graphique', 'design-graphique', '2025-05-05 17:18:28', '2025-05-05 17:18:28'),
(3, 'Marketing Digital', 'marketing-digital', '2025-05-05 17:18:28', '2025-05-05 17:18:28'),
(4, 'Intelligence Artificielle', 'intelligence-artificielle', '2025-05-05 17:18:28', '2025-05-05 17:18:28');

-- --------------------------------------------------------

--
-- Structure de la table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `certificate_id` varchar(255) NOT NULL,
  `issued_at` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chat_histories`
--

CREATE TABLE `chat_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_message` text NOT NULL,
  `bot_response` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `has_certificate` tinyint(1) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL,
  `level` enum('débutant','intermédiaire','avancé') NOT NULL,
  `is_free` tinyint(1) GENERATED ALWAYS AS (`price` = 0) VIRTUAL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `price`, `is_featured`, `has_certificate`, `duration`, `level`, `teacher_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Introduction au HTML & CSS', 'Apprenez les bases du développement web avec HTML et CSS.', 0.00, 0, 1, 10, 'débutant', 3, 1, '2025-05-05 17:19:01', '2025-05-05 17:19:01'),
(2, 'UX/UI Design pour les débutants', 'Comprendre les principes du design graphique et de l’expérience utilisateur.', 49.99, 0, 1, 12, 'débutant', 3, 2, '2025-05-05 17:19:01', '2025-05-05 17:19:01'),
(3, 'Publicité sur les réseaux sociaux', 'Maîtrisez les bases du marketing digital sur Facebook, Instagram et autres.', 39.99, 0, 1, 8, 'intermédiaire', 3, 3, '2025-05-05 17:19:01', '2025-05-05 17:19:01'),
(4, 'Apprentissage automatique avec Python', 'Un cours pratique sur l’intelligence artificielle et le machine learning.', 79.99, 0, 1, 15, 'avancé', 3, 4, '2025-05-05 17:19:01', '2025-05-05 17:19:01'),
(45, 'Introduction à Laravel', 'Apprenez les bases du framework Laravel.', 0.00, 1, 1, 10, 'débutant', 3, 1, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(46, 'JavaScript Avancé', 'Maîtrisez les concepts avancés de JS.', 49.99, 1, 1, 20, 'avancé', 3, 2, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(47, 'Python pour débutants', 'Une introduction au langage Python.', 0.00, 0, 1, 12, 'débutant', 3, 3, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(48, 'React de A à Z', 'Développez des interfaces modernes avec React.', 59.99, 1, 1, 18, 'intermédiaire', 3, 4, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(49, 'SQL Pratique', 'Apprenez à interroger des bases de données.', 19.99, 0, 1, 8, 'débutant', 3, 1, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(50, 'Docker pour développeurs', 'Conteneurisation des applications.', 29.99, 1, 1, 10, 'intermédiaire', 3, 2, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(51, 'Cybersécurité', 'Notions de base en sécurité informatique.', 0.00, 0, 1, 15, 'intermédiaire', 3, 3, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(52, 'Machine Learning', 'Les fondations du ML.', 99.99, 1, 1, 25, 'avancé', 3, 4, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(53, 'HTML/CSS pour débutants', 'Créez vos premières pages web.', 0.00, 0, 1, 7, 'débutant', 3, 1, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(54, 'DevOps Essentials', 'Découvrez les pratiques DevOps.', 39.99, 0, 1, 14, 'intermédiaire', 3, 2, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(55, 'Spring Boot', 'Développement d’API avec Spring.', 69.99, 1, 1, 20, 'avancé', 3, 3, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(56, 'Réseaux informatiques', 'Les bases des réseaux.', 0.00, 0, 1, 12, 'débutant', 3, 4, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(57, 'PHP et MySQL', 'Construire des sites dynamiques.', 24.99, 1, 1, 16, 'intermédiaire', 3, 1, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(58, 'Node.js complet', 'Backend avec Node.js et Express.', 79.99, 1, 1, 22, 'avancé', 3, 2, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(59, 'Data Science', 'Analyse de données avec Python.', 89.99, 1, 1, 30, 'avancé', 3, 3, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(60, 'Git et GitHub', 'Gestion de versions de code.', 0.00, 0, 1, 5, 'débutant', 3, 4, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(61, 'WordPress', 'Créer des sites sans coder.', 14.99, 0, 1, 9, 'débutant', 3, 1, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(62, 'Algorithmes', 'Pensée algorithmique et résolution.', 34.99, 1, 1, 13, 'intermédiaire', 3, 2, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(63, 'Laravel API', 'Créer des API REST avec Laravel.', 44.99, 1, 1, 11, 'intermédiaire', 3, 3, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(64, 'Introduction à l’IA', 'Concepts fondamentaux de l’intelligence artificielle.', 0.00, 0, 1, 17, 'débutant', 3, 4, '2025-05-24 21:18:58', '2025-05-24 21:18:58'),
(66, 'Developpement Personnel', 'Ce cours vous permet de vous developper', 10.00, 0, 0, 12, 'débutant', 3, 1, '2025-05-29 19:56:15', '2025-05-29 19:56:15');

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `completed_at`, `created_at`, `updated_at`) VALUES
(3, 4, 1, '2025-05-22 11:36:41', NULL, '2025-05-22 11:36:41'),
(4, 4, 2, '2025-05-20 22:38:03', NULL, '2025-05-20 22:38:03'),
(5, 5, 1, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(6, 5, 2, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(7, 6, 2, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(8, 6, 3, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(9, 7, 1, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(10, 7, 3, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(11, 7, 4, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(12, 8, 4, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(13, 9, 1, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(14, 9, 4, NULL, '2025-05-07 15:12:56', '2025-05-07 15:12:56'),
(15, 4, 3, '2025-05-20 22:55:23', NULL, '2025-05-20 22:55:23'),
(16, 4, 4, '2025-05-24 20:04:48', NULL, '2025-05-24 20:04:48'),
(17, 5, 3, NULL, NULL, NULL),
(18, 10, 1, NULL, NULL, NULL),
(19, 4, 50, NULL, '2025-05-24 21:08:11', '2025-05-24 21:08:11'),
(20, 4, 51, NULL, '2025-05-24 21:39:41', '2025-05-24 21:39:41'),
(21, 4, 61, NULL, '2025-05-24 21:56:58', '2025-05-24 21:56:58'),
(22, 11, 51, '2025-05-24 23:20:15', '2025-05-24 23:17:58', '2025-05-24 23:20:15'),
(23, 12, 51, '2025-05-24 23:29:23', '2025-05-24 23:29:04', '2025-05-24 23:29:23'),
(24, 12, 2, NULL, '2025-05-24 23:37:28', '2025-05-24 23:37:28'),
(25, 11, 3, NULL, '2025-05-25 15:38:12', '2025-05-25 15:38:12'),
(26, 11, 46, NULL, '2025-05-25 15:39:56', '2025-05-25 15:39:56'),
(27, 11, 47, NULL, '2025-05-25 15:40:02', '2025-05-25 15:40:02');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `content`, `order`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Administration réseaux', 'Bonjour le monde', 1, 1, '2025-05-20 18:21:35', '2025-05-20 18:21:35'),
(2, 'Administration réseaux', 'Ceci est notre première leçon', 2, 1, '2025-05-20 18:45:30', '2025-05-20 18:45:30'),
(3, 'Administration réseaux', 'Ceci est notre première leçon', 2, 1, '2025-05-20 18:52:01', '2025-05-20 18:52:01'),
(4, 'Les balises', 'les balises html sont très importantes', 4, 1, '2025-05-20 19:06:44', '2025-05-20 19:06:44');

-- --------------------------------------------------------

--
-- Structure de la table `lesson_completions`
--

CREATE TABLE `lesson_completions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discussion_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_05_135000_create_categories_table', 1),
(5, '2025_05_05_135402_create_courses_table', 1),
(6, '2025_05_05_135425_create_lessons_table', 1),
(7, '2025_05_05_162115_create_enrollments_table', 2),
(8, '2025_05_06_130934_create_certificates_table', 3),
(9, '2025_05_16_003654_add_is_featured_to_courses_table', 3),
(10, '2025_05_17_005000_create_chat_histories_table', 4),
(11, '2025_05_20_185603_create_reviews_table', 5),
(12, '2025_05_20_221629_create_lesson_completions_table', 6),
(13, '2025_05_24_213943_create_resources_table', 7),
(14, '2025_05_24_223041_add_has_certificate_to_courses_table', 8),
(15, '2025_05_25_020502_create_quizzes_table', 9),
(16, '2025_05_25_020529_create_announcements_table', 9),
(17, '2025_05_25_020604_create_settings_table', 9),
(18, '2025_05_25_020620_create_payments_table', 9),
(19, '2025_05_25_020645_create_reports_table', 9),
(20, '2025_05_25_023205_create_questions_table', 9),
(21, '2025_05_25_031415_create_assignments_table', 10),
(22, '2025_05_25_034020_create_discussions_table', 11),
(23, '2025_05_25_034023_create_messages_table', 11);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`options`)),
  `correct_option` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `resources`
--

CREATE TABLE `resources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1BkkkacFUP3wrVkY8ZbWQ32aPKlD3X63Fbylm8Hk', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSW0zWmg2SDJWVlBMWGZlWElFd2YyR21TZGlLWEV4alM2b2Y0UDNYMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWFjaGVyL3N0dWRlbnRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1748955117),
('RWVRx0HMuUlXtTC16rnLi1mkoMIOBbgOqT4vuIEW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibGlQbGxRczJseHhyOEhJMm1KWmNYRXBDaVlWN1ZLQktBdGM0b0NtVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3RlYWNoZXIvc3R1ZGVudHMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748985549),
('yvMea7bwDxNlInOV5dxP6GM0lFyVimDjtW089mCB', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaEU3WjB0QlFMM212cDJVSE9OaVBuUFpURktXbTNCRW16QW5FWDdiVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2VycyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1749134450);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL DEFAULT 'student',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'admin', NULL, NULL, NULL),
(3, 'Yassine SADQI', 'teacher@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'teacher', NULL, NULL, NULL),
(4, 'Sara Quassimi', 'student@example.com', NULL, '$2y$12$kDCcr5eC.QuYWasGcz5dPOopEPRSJWbZNa9.sr4ALsoCeKYnvXmKi', 'student', NULL, '2025-05-06 12:39:10', '2025-05-30 08:55:38'),
(5, 'Étudiant 1', 'etudiant1@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'student', NULL, '2025-05-07 15:08:48', '2025-05-07 15:08:48'),
(6, 'Étudiant 2', 'etudiant2@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'student', NULL, '2025-05-07 15:08:48', '2025-05-07 15:08:48'),
(7, 'Étudiant 3', 'etudiant3@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'student', NULL, '2025-05-07 15:08:48', '2025-05-07 15:08:48'),
(8, 'Étudiant 4', 'etudiant4@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'student', NULL, '2025-05-07 15:08:48', '2025-05-07 15:08:48'),
(9, 'Étudiant 5', 'etudiant5@example.com', NULL, '$2y$12$GH/AYptE/P2S/DuCMvqot.QzdFzIo5zjuFoiqU.Lh84YwO3kBcu.q', 'student', NULL, '2025-05-07 15:08:48', '2025-05-07 15:08:48'),
(10, 'moi', 'moi@example.com', NULL, '$2y$12$30tSxmTGPr5F2dxEpIdEr.GrKryd0QXAEAb4Ph3NQUVQRUNwI7TxW', 'student', NULL, '2025-05-18 20:57:44', '2025-05-18 20:57:44'),
(11, 'SOIHIHOU Nourddine Abasse', 'soi@ex.com', NULL, '$2y$12$bCRUn2se4B97P6jUMHeJT.NJVlmowdYrrpMWteUd/RCCiFBgtGRm6', 'student', NULL, '2025-05-24 23:17:41', '2025-05-24 23:17:41'),
(12, 'OUTEHA Hicham', 'hicham@example.com', NULL, '$2y$12$l9If3ymsy7argvTS7I5cc.odmIDm5YH8BEtjtgZWMxmsd7n/3.tQO', 'admin', NULL, '2025-05-24 23:28:47', '2025-05-29 22:21:39'),
(13, 'un', 'un@ex.com', NULL, '$2y$12$XPoiqbLu7Sc0P4X5kpQ56.DnaJGJ03mkAFEWsztCDoNlLfoZcpWz.', 'student', NULL, '2025-05-29 21:51:56', '2025-05-29 21:51:56'),
(14, 'troi', 'troi@ex.com', NULL, '$2y$12$hjNGD.hufCbCYNRgP5F7m.Jkcte.0XUDzpPh6ZB1t6LChfbArG.Pa', 'student', NULL, '2025-05-29 22:21:04', '2025-05-29 22:21:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_course_id_foreign` (`course_id`);

--
-- Index pour la table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_course_id_foreign` (`course_id`),
  ADD KEY `assignments_teacher_id_foreign` (`teacher_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Index pour la table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `certificates_certificate_id_unique` (`certificate_id`),
  ADD KEY `certificates_user_id_foreign` (`user_id`),
  ADD KEY `certificates_course_id_foreign` (`course_id`);

--
-- Index pour la table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_histories_user_id_foreign` (`user_id`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_teacher_id_foreign` (`teacher_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`);

--
-- Index pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussions_course_id_foreign` (`course_id`),
  ADD KEY `discussions_teacher_id_foreign` (`teacher_id`);

--
-- Index pour la table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Index pour la table `lesson_completions`
--
ALTER TABLE `lesson_completions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_completions_user_id_lesson_id_unique` (`user_id`,`lesson_id`),
  ADD KEY `lesson_completions_lesson_id_foreign` (`lesson_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_discussion_id_foreign` (`discussion_id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_course_id_foreign` (`course_id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Index pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizzes_course_id_foreign` (`course_id`);

--
-- Index pour la table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Index pour la table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resources_course_id_foreign` (`course_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_course_id_foreign` (`course_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chat_histories`
--
ALTER TABLE `chat_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lesson_completions`
--
ALTER TABLE `lesson_completions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `chat_histories`
--
ALTER TABLE `chat_histories`
  ADD CONSTRAINT `chat_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discussions_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `lesson_completions`
--
ALTER TABLE `lesson_completions`
  ADD CONSTRAINT `lesson_completions_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_completions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
