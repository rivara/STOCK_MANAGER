-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.23-0ubuntu0.20.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla sgm_devel.users: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$S8geeGZMMshnMGUl641nDuhqLClvvD8O6X43NE8Z/4m0prAebPPkO', 'w7Bq6zlS1Lw9wVu1I6XChRqEKIyXHAxZ2QSBVhWUcsEKZJYWpdcAzcjmL7wj', NULL, NULL, NULL),
	(2, 'Supervisor', 'dnota@dnota.com', NULL, '$2y$10$cQdZNvSbbwhqL.tThfm0WuZXy9uUW1FfJdm/vFWhq45eDkixySZVS', NULL, '2020-11-20 09:41:39', '2021-01-11 11:15:05', NULL),
	(3, 'Técnico', 'tecnico@dnota.com', NULL, '$2y$10$GTKGK4RfW40qUQfTUYp.Q.LhOJnQS38Jwg7x2iLKXh9WVZMXYoLGe', NULL, '2020-11-26 12:43:59', '2021-02-01 10:04:06', NULL),
	(4, 'María Colina', 'mcolina@dnota.com', NULL, '$2y$10$8/SpLea80uyQTtQ3grq4J.kkdXPljgzhAj0gT1EC6WOp2yjC2Pgg.', NULL, '2021-01-28 10:15:34', '2021-01-28 10:15:34', NULL),
	(5, 'María Ortega', 'mortega@dnota.com', NULL, '$2y$10$ONkf0iM9WRckw7ercq6RH.yhB.J8FWNag2PYaEJcNiduqMdIjzNYW', NULL, '2021-01-28 10:16:13', '2021-01-28 10:16:13', NULL),
	(6, 'Silvia Mera', 'smera@dnota.com', NULL, '$2y$10$pNtg2gZHqM0VtPRlEQGOBedeVVry.wq7DdF8G6umJdrZAr6AWVzb2', 'JrBEkqStuzBEhp1XX4vzZqYIZk45fMftrBKrugv1L61wIZ8c6LOT6M1Urzua', '2021-01-28 10:16:43', '2021-01-28 10:16:43', NULL),
	(7, 'Alba Lendez', 'alendez@dnota.com', NULL, '$2y$10$oRsYoJaO81S89qrZW9vOm.2kIPnPWJDkDWiUHLjD2E65GKr1wIOEW', NULL, '2021-01-28 10:17:26', '2021-01-28 10:17:26', NULL),
	(8, 'Miguel Angel del Peso', 'madelpeso@dnota.com', NULL, '$2y$10$HJXFxnd2A5isKwCTfxSljOyaMmYinhZ5I7AvCZkcLs0b4UHFZEg3G', NULL, '2021-01-28 10:19:29', '2021-01-28 10:19:29', NULL),
	(9, 'Roberto Maroto', 'rmaroto@dnota.com', NULL, '$2y$10$yexZsyLVhSRZsbZVabSJY.B/f9ewu0EkZXs5wWYjZ4j4KBFrJgRTu', NULL, '2021-01-28 10:22:18', '2021-01-28 10:22:18', NULL),
	(10, 'Miguel Angel Martín', 'mamartin@dnota.com', NULL, '$2y$10$Bcqw4EiPBwizb0aStvCeFu2Lazc5watJkVO0vyp8Iblw.sQt7L8fK', NULL, '2021-01-28 10:23:09', '2021-01-28 10:23:09', NULL),
	(11, 'Luis García', 'lgarcia@dnota.com', NULL, '$2y$10$LENqXrP7iIWnvkKIgaWr3e.mRNUQDjUDnKyd1/Tt.4tTSq1pm6LSq', NULL, '2021-01-28 10:23:37', '2021-01-28 10:23:37', NULL),
	(12, 'Javier Matías', 'jmgarcia@dnota.com', NULL, '$2y$10$EBXLFtabxDKPfJ/3ckioa.DWM20HovGtHM7Cuyl4UmMM6.aWk0vLa', NULL, '2021-01-28 10:24:22', '2021-01-28 10:24:22', NULL),
	(13, 'Angel San Juan', 'asanjuan@dnota.com', NULL, '$2y$10$kcTpceDe/Wd5I8tCJD2lSe21U8vAlgLvmHuoXIQLnqLVmyk1QN81K', NULL, '2021-01-28 10:25:10', '2021-01-28 10:25:10', NULL),
	(14, 'Marcial Nguema', 'mnguema@dnota.com', NULL, '$2y$10$7pyqEfksc3QlagoSI/51Q.lq5xQIpAxpnWfshygrQ4iIiG7yeuJPO', NULL, '2021-01-28 10:29:49', '2021-01-28 10:29:49', NULL),
	(15, 'Susana Martínez', 'smizquierdo@dnota.com', NULL, '$2y$10$ybdGtJ5bOi3rpg/oKaWIcOkQiHEkqIZYLB7XeCcYDpoCY.GOrmUgm', NULL, '2021-01-28 11:13:08', '2021-01-28 11:13:08', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
