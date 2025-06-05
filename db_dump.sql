/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for iiko
CREATE DATABASE IF NOT EXISTS `iiko` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `iiko`;

-- Dumping structure for table iiko.bills
CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(32) NOT NULL,
  `status` enum('new','paid','cancelled') NOT NULL,
  `created` datetime NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bills_pk_2` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table iiko.bills: ~3 rows (approximately)
INSERT INTO `bills` (`id`, `number`, `status`, `created`, `discount`) VALUES
	(1, '001', 'paid', '2025-06-05 10:25:05', NULL),
	(2, '002', 'paid', '2025-06-05 10:45:05', 100.00),
	(3, '003', 'new', '2025-06-05 10:59:20', 10.00);

-- Dumping structure for table iiko.positions
CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`position_id`),
  KEY `positions_bills_id_fk` (`bill_id`),
  CONSTRAINT `positions_bills_id_fk` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table iiko.positions: ~8 rows (approximately)
INSERT INTO `positions` (`position_id`, `bill_id`, `name`, `quantity`, `price`) VALUES
	(4, 1, 'Банан', 2, 100.00),
	(5, 1, 'Киви', 1, 120.00),
	(6, 1, 'Кофе', 2, 150.00),
	(7, 2, 'Салат', 2, 300.00),
	(8, 2, 'Апельсиновый сок', 2, 200.00),
	(9, 2, 'Форель', 3, 450.00),
	(10, 3, 'Рис', 1, 120.00),
	(11, 3, 'Котлета', 2, 310.00),
	(12, 3, 'Компот', 1, 50.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
