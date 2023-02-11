-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 09:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyetranspo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buses`
--

CREATE TABLE `tbl_buses` (
  `bus_id` int(11) NOT NULL,
  `bus_number` varchar(50) NOT NULL,
  `driver_id` int(11) NOT NULL DEFAULT 0,
  `bus_plate_number` varchar(50) NOT NULL,
  `bus_operator` varchar(50) NOT NULL,
  `bus_max_capacity` int(11) NOT NULL DEFAULT 0,
  `route_id` int(11) NOT NULL,
  `bus_remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_buses`
--

INSERT INTO `tbl_buses` (`bus_id`, `bus_number`, `driver_id`, `bus_plate_number`, `bus_operator`, `bus_max_capacity`, `route_id`, `bus_remarks`, `date_added`) VALUES
(2, '5896', 1, '995', '8', 2, 2, '', '2023-01-09 10:18:55'),
(3, '1234', 5, '4444', 'Roldan Santos', 25, 3, '', '2023-02-08 11:14:02'),
(4, '9874', 6, '1578', 'Jose Rivera', 15, 4, '', '2023-02-08 11:14:29'),
(5, '3791', 7, '2266', 'Mark Sy', 20, 5, '', '2023-02-08 11:15:07'),
(6, '4716', 8, '3347', 'Karl Maden', 18, 6, '', '2023-02-08 11:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drivers`
--

CREATE TABLE `tbl_drivers` (
  `driver_id` int(11) NOT NULL,
  `driver_fname` varchar(50) NOT NULL,
  `driver_mname` varchar(50) NOT NULL,
  `driver_lname` varchar(50) NOT NULL,
  `driver_address` varchar(250) NOT NULL,
  `driver_contact_number` varchar(15) NOT NULL,
  `driver_img` text NOT NULL,
  `driver_remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_drivers`
--

INSERT INTO `tbl_drivers` (`driver_id`, `driver_fname`, `driver_mname`, `driver_lname`, `driver_address`, `driver_contact_number`, `driver_img`, `driver_remarks`, `date_added`) VALUES
(1, 'pepe', 'smith', 'cruz', 'bcd', '090099', '', '', '2023-01-09 09:46:58'),
(5, 'Carlo', 'Bill', 'Aquino', 'Brgy. Borsling', '09551234567', '', '', '2023-02-08 11:09:36'),
(6, 'Cardo', 'Lumay', 'Dalisay', 'Brgy. Borslak', '09441234567', '', '', '2023-02-08 11:10:07'),
(7, 'Rigor', 'Ramos', 'dela Rama', 'Purok Carding', '09111234567', '', '', '2023-02-08 11:10:41'),
(8, 'Mark', 'Tahi', 'Miklang', 'Brgy. Biring', '09781234567', '', '', '2023-02-08 11:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_route`
--

CREATE TABLE `tbl_route` (
  `route_id` int(11) NOT NULL,
  `route_name` varchar(75) NOT NULL,
  `route_desc` varchar(250) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_route`
--

INSERT INTO `tbl_route` (`route_id`, `route_name`, `route_desc`, `date_added`) VALUES
(2, 'La Castellana - Bacolod', '', '2023-01-09 15:55:57'),
(3, 'Bacolod - La Castellana', '', '2023-02-08 11:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL DEFAULT 0,
  `trip_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `fare` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remarks` text NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `destination` text DEFAULT '0,0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`transaction_id`, `bus_id`, `trip_id`, `user_id`, `fare`, `remarks`, `status`, `date_added`, `destination`) VALUES
(1, 2, 1, 9, '15.00', 'Report', 'C', '2023-02-07 09:50:35', '0,0'),
(2, 2, 1, 9, '15.00', '', 'C', '2023-02-08 09:47:53', '10.6007459,122.926862'),
(3, 2, 1, 13, '15.00', '', 'C', '2023-02-08 10:40:39', '10.6840053,122.9563021'),
(4, 2, 1, 13, '15.00', '', 'C', '2023-02-08 10:49:02', '10.6713397,122.9510716'),
(5, 2, 1, 13, '15.00', '', 'C', '2023-02-08 10:56:35', '10.503405,122.9663018'),
(6, 2, 1, 13, '15.00', '', 'C', '2023-02-08 10:57:06', '10.6713397,122.9510716'),
(7, 2, 1, 0, '15.00', '', 'C', '2023-02-08 11:00:03', '10.7528182,123.0875623'),
(8, 2, 1, 13, '15.00', '', 'C', '2023-02-08 11:18:55', '10.3194742,123.0198024'),
(9, 3, 3, 13, '15.00', '', 'C', '2023-02-08 11:22:58', '10.3194742,123.0198024'),
(10, 2, 2, 13, '15.00', '', 'C', '2023-02-08 11:37:42', '10.503405,122.9663018'),
(11, 2, 2, 13, '15.00', '', 'C', '2023-02-08 11:45:07', '10.6713397,122.9510716'),
(12, 2, 2, 13, '15.00', '', 'P', '2023-02-08 11:54:25', '10.6713397,122.9510716');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trips`
--

CREATE TABLE `tbl_trips` (
  `trip_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trip_schedule_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_departed` datetime NOT NULL,
  `date_arrived` datetime NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `headings` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_trips`
--

INSERT INTO `tbl_trips` (`trip_id`, `bus_id`, `user_id`, `trip_schedule_id`, `status`, `date_departed`, `date_arrived`, `date_added`, `headings`) VALUES
(1, 2, 4, 1, '1', '2023-02-07 14:22:00', '2023-02-08 13:22:00', '0000-00-00 00:00:00', 'TO BACOLOD'),
(2, 2, 12, 1, '', '2023-02-08 19:07:00', '2023-02-08 21:07:00', '2023-02-08 11:08:10', 'TO LA CAST'),
(3, 3, 4, 1, '', '2023-02-08 08:19:00', '2023-02-08 09:40:00', '2023-02-08 11:20:44', 'TO LA CAST'),
(4, 2, 4, 1, '', '2023-02-11 16:01:00', '2023-02-11 22:01:00', '2023-02-11 16:01:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip_schedule`
--

CREATE TABLE `tbl_trip_schedule` (
  `trip_schedule_id` int(11) NOT NULL,
  `trip_schedule_marker` text NOT NULL,
  `trip_schedule_time` time NOT NULL,
  `route` varchar(20) NOT NULL,
  `trip_schedule_fare` decimal(12,2) NOT NULL DEFAULT 0.00,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_trip_schedule`
--

INSERT INTO `tbl_trip_schedule` (`trip_schedule_id`, `trip_schedule_marker`, `trip_schedule_time`, `route`, `trip_schedule_fare`, `date_added`) VALUES
(1, 'test', '08:20:00', 'TO BACOLOD', '15.00', '2023-01-16 05:23:32'),
(2, '', '06:00:00', 'TO LA CASTELLANA', '75.00', '2023-02-08 11:17:24'),
(3, '', '09:15:00', 'TO LA CASTELLANA', '105.00', '2023-02-08 11:17:54'),
(4, '', '07:35:00', 'TO LA CASTELLANA', '89.00', '2023-02-08 11:18:16'),
(5, '', '08:25:00', 'TO LA CASTELLANA', '35.00', '2023-02-08 11:18:35'),
(6, '', '15:55:00', 'TO LA CASTELLANA', '3.00', '2023-02-11 15:55:46'),
(7, '', '16:00:00', 'TO BACOLOD', '89.00', '2023-02-11 16:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL DEFAULT '0',
  `user_lname` varchar(50) NOT NULL,
  `user_contact_number` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_img` text NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `user_category` varchar(1) NOT NULL COMMENT 'P = Passenger; A = Admin; C = Conductor',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `location` text DEFAULT '0.0',
  `id_token` text DEFAULT NULL,
  `status` varchar(1) NOT NULL COMMENT 'Approved, Pending and Blocked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_contact_number`, `user_email`, `user_img`, `username`, `password`, `user_category`, `date_added`, `location`, `id_token`, `status`) VALUES
(1, 'Juan', 'Santos', 'Dela Cruz', '090956565', 'juan@gmail.com', '', 'admin', '0cc175b9c0f1b6a831c399e269772661', 'A', '2022-12-28 14:38:12', '0.0', NULL, 'A'),
(4, 'Juan', 'Test', 'Dela Cruz', '62727282', 'hh@gmail.com', '', 'a', '0cc175b9c0f1b6a831c399e269772661', 'C', '2023-01-12 15:16:24', '0.0', NULL, 'A'),
(8, 'Ginery', 'Eumalde', 'Songaling', '0975672868', '', '', 'Ginx', '7fc56270e7a70fa81a5935b72eacbe29', 'U', '2023-01-16 09:38:21', '10.66633,122.94318', 'fqyFM08eRcWWUdy88d1dYE:APA91bGZwKcc6_pSJJ2ORd6jYIE06P4Loefb-Tzq0VmYzaGNDBRbbcTKP8ngEylg-uGFUFrmV4J-Lv3t5uzq-voKMYn2eXMya3hXjqnhuBVdv26pj7qVJcDJ4gOHuZv4qpgp41ytiUGi', 'A'),
(9, 'Anne', 'Cruz', 'Santos', '09096961991', '', '', 'Anne', '19fdf51d7001bd6430bc30fcaaa570c5', 'U', '2023-01-17 18:11:15', '0,0', 'enuNZpqYSDamM8dA0fM0qw:APA91bE8RYojJRxqIwK66mZzgZfaiRQrq3PI48mxq3bguseRgvarKM1MNKtzUr6dY1q6c-KMjM2_JXS9yCC87Exq08B0uILQbSfvDCN6LOBVriiEOpxlRoUDOQh09Hwhy2UA6fMA__He', 'A'),
(10, 'Anne', 'Smith', 'White', 'Hj', '', '', 'Anne', '19fdf51d7001bd6430bc30fcaaa570c5', 'U', '2023-02-07 17:49:27', '0.0', NULL, 'A'),
(11, 'Anne', 'Anne', 'Anne', '09', '', 'rn_image_picker_lib_temp_908a60c4-6b52-405e-a815-c2e6b422211d.jpg.jpg', 'Anne', '19fdf51d7001bd6430bc30fcaaa570c5', 'U', '2023-02-08 17:46:57', '0.0', NULL, ''),
(12, 'Karen', 'Smith', 'Doe', '09661234567', 'karensd@gmail.com', '', 'karen_sd', '718c21b7b40d2ce38c73df5692cba69f', 'C', '2023-02-08 17:58:30', '10.664421,122.9417285', 'enuNZpqYSDamM8dA0fM0qw:APA91bE8RYojJRxqIwK66mZzgZfaiRQrq3PI48mxq3bguseRgvarKM1MNKtzUr6dY1q6c-KMjM2_JXS9yCC87Exq08B0uILQbSfvDCN6LOBVriiEOpxlRoUDOQh09Hwhy2UA6fMA__He', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buses`
--
ALTER TABLE `tbl_buses`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `tbl_route`
--
ALTER TABLE `tbl_route`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `tbl_trips`
--
ALTER TABLE `tbl_trips`
  ADD PRIMARY KEY (`trip_id`);

--
-- Indexes for table `tbl_trip_schedule`
--
ALTER TABLE `tbl_trip_schedule`
  ADD PRIMARY KEY (`trip_schedule_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_buses`
--
ALTER TABLE `tbl_buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_trips`
--
ALTER TABLE `tbl_trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_trip_schedule`
--
ALTER TABLE `tbl_trip_schedule`
  MODIFY `trip_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
