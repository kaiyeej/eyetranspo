-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for eyetranspo_db
CREATE DATABASE IF NOT EXISTS `eyetranspo_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `eyetranspo_db`;

-- Dumping structure for table eyetranspo_db.tbl_buses
CREATE TABLE IF NOT EXISTS `tbl_buses` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_number` varchar(50) NOT NULL,
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `bus_plate_number` varchar(50) NOT NULL,
  `bus_operator` varchar(50) NOT NULL,
  `bus_max_capacity` int(11) NOT NULL DEFAULT '0',
  `route_id` int(11) NOT NULL,
  `bus_remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table eyetranspo_db.tbl_buses: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_buses` DISABLE KEYS */;
INSERT INTO `tbl_buses` (`bus_id`, `bus_number`, `driver_id`, `bus_plate_number`, `bus_operator`, `bus_max_capacity`, `route_id`, `bus_remarks`, `date_added`) VALUES
	(3, 'B-001', 1, '000122121', 'Operator', 100, 2, '', '2023-01-26 09:47:48'),
	(4, 'B-002', 1, '00022254', 'MM Lines', 30, 2, '', '2023-01-26 10:04:30');
/*!40000 ALTER TABLE `tbl_buses` ENABLE KEYS */;

-- Dumping structure for table eyetranspo_db.tbl_drivers
CREATE TABLE IF NOT EXISTS `tbl_drivers` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_fname` varchar(50) NOT NULL,
  `driver_mname` varchar(50) NOT NULL,
  `driver_lname` varchar(50) NOT NULL,
  `driver_address` varchar(250) NOT NULL,
  `driver_contact_number` varchar(15) NOT NULL,
  `driver_img` text NOT NULL,
  `driver_remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table eyetranspo_db.tbl_drivers: ~3 rows (approximately)
/*!40000 ALTER TABLE `tbl_drivers` DISABLE KEYS */;
INSERT INTO `tbl_drivers` (`driver_id`, `driver_fname`, `driver_mname`, `driver_lname`, `driver_address`, `driver_contact_number`, `driver_img`, `driver_remarks`, `date_added`) VALUES
	(1, 'Pepe', 'Smith', 'Cruz', 'Brgy. 6, Bacolod City', '09857854241', 'images (2).jpg', '', '2023-01-09 09:46:58'),
	(5, 'Rene', 'Santos', 'Abella', 'Barangay Handumanan, Bacolod City', '09265878454', 'download (3).jpg', '', '2023-01-26 10:07:24'),
	(6, 'Niel', 'Cruz', 'Ipilipil', 'Brgy. Poblacion, Bago City', '09557845125', '1553597532854.jpg', '', '2023-01-26 10:09:02');
/*!40000 ALTER TABLE `tbl_drivers` ENABLE KEYS */;

-- Dumping structure for table eyetranspo_db.tbl_route
CREATE TABLE IF NOT EXISTS `tbl_route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_name` varchar(75) NOT NULL,
  `route_desc` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table eyetranspo_db.tbl_route: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_route` DISABLE KEYS */;
INSERT INTO `tbl_route` (`route_id`, `route_name`, `route_desc`, `date_added`) VALUES
	(2, 'Bacolod-Pulupandan', '', '2023-01-09 15:55:57');
/*!40000 ALTER TABLE `tbl_route` ENABLE KEYS */;

-- Dumping structure for table eyetranspo_db.tbl_transactions
CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_id` int(11) NOT NULL DEFAULT '0',
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fare` decimal(12,2) NOT NULL DEFAULT '0.00',
  `remarks` text NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table eyetranspo_db.tbl_transactions: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_transactions` DISABLE KEYS */;
INSERT INTO `tbl_transactions` (`transaction_id`, `bus_id`, `trip_id`, `user_id`, `fare`, `remarks`, `status`, `date_added`) VALUES
	(1, 3, 2, 3, 0.00, '', 'F', '2023-01-28 15:07:25');
/*!40000 ALTER TABLE `tbl_transactions` ENABLE KEYS */;

-- Dumping structure for table eyetranspo_db.tbl_trips
CREATE TABLE IF NOT EXISTS `tbl_trips` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_id` int(11) NOT NULL,
  `trip_schedule_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_departed` datetime NOT NULL,
  `date_arrived` datetime NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `headings` varchar(10) NOT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table eyetranspo_db.tbl_trips: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_trips` DISABLE KEYS */;
INSERT INTO `tbl_trips` (`trip_id`, `bus_id`, `trip_schedule_id`, `status`, `date_departed`, `date_arrived`, `date_added`, `headings`) VALUES
	(2, 3, 1, 'A', '2023-01-26 09:50:00', '2023-01-26 10:50:00', '0000-00-00 00:00:00', 'North'),
	(3, 4, 1, 'A', '2023-01-26 10:30:00', '2023-01-26 11:30:00', '2023-01-26 10:30:05', 'South'),
	(4, 3, 1, '', '2023-01-28 14:30:00', '2023-01-28 15:59:00', '2023-01-28 14:02:57', 'North');
/*!40000 ALTER TABLE `tbl_trips` ENABLE KEYS */;

-- Dumping structure for table eyetranspo_db.tbl_trip_schedule
CREATE TABLE IF NOT EXISTS `tbl_trip_schedule` (
  `trip_schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_schedule_marker` text NOT NULL,
  `trip_schedule_time` time NOT NULL,
  `route_id` int(11) NOT NULL,
  `trip_schedule_fare` decimal(12,2) NOT NULL DEFAULT '0.00',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trip_schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table eyetranspo_db.tbl_trip_schedule: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_trip_schedule` DISABLE KEYS */;
INSERT INTO `tbl_trip_schedule` (`trip_schedule_id`, `trip_schedule_marker`, `trip_schedule_time`, `route_id`, `trip_schedule_fare`, `date_added`) VALUES
	(1, '', '09:44:00', 2, 23.00, '2023-01-26 09:44:09');
/*!40000 ALTER TABLE `tbl_trip_schedule` ENABLE KEYS */;

-- Dumping structure for table eyetranspo_db.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL DEFAULT '0',
  `user_lname` varchar(50) NOT NULL,
  `user_contact_number` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_img` text NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `user_category` varchar(1) NOT NULL COMMENT 'P = Passenger; A = Admin; C = Conductor',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table eyetranspo_db.tbl_users: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_contact_number`, `user_email`, `user_img`, `username`, `password`, `user_category`, `date_added`) VALUES
	(1, 'Juan', 'Santos', 'Dela Cruz', '090956565', 'juan@gmail.com', '', 'admin', '0cc175b9c0f1b6a831c399e269772661', 'A', '2022-12-28 14:38:12'),
	(3, 's', 's', 's', 's', 's@d.co', '', 's', 'b148e7f41fdc3be4b14e8d17e068bbad', 'U', '2023-01-05 15:33:57');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
