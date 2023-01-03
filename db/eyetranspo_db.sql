-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 01:57 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `driver_id` int(11) NOT NULL DEFAULT '0',
  `bus_plate_number` varchar(50) NOT NULL,
  `bus_operator` varchar(50) NOT NULL,
  `bus_max_capacity` int(11) NOT NULL DEFAULT '0',
  `bus_route` text NOT NULL,
  `bus_remarks` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL DEFAULT '0',
  `trip_schedule_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fare` decimal(12,2) NOT NULL DEFAULT '0.00',
  `remarks` text NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip_schedule`
--

CREATE TABLE `tbl_trip_schedule` (
  `trip_schedule_id` int(11) NOT NULL,
  `trip_schedule_marker` text NOT NULL,
  `trip_schedule_time` time NOT NULL,
  `trip_schedule_route` text NOT NULL,
  `trip_schedule_fare` decimal(12,2) NOT NULL DEFAULT '0.00',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_img` text NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `user_category` varchar(1) NOT NULL COMMENT 'P = Passenger; A = Admin; C = Conductor',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_contact_number`, `user_img`, `username`, `password`, `user_category`, `date_added`) VALUES
(1, 'Juan', 'Santos', 'Dela Cruz', '090956565', '', 'admin', '0cc175b9c0f1b6a831c399e269772661', 'A', '2022-12-28 14:38:12');

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
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`transaction_id`);

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
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trip_schedule`
--
ALTER TABLE `tbl_trip_schedule`
  MODIFY `trip_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
