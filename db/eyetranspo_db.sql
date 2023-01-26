-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2023 at 02:57 PM
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
(2, 'uu', 1, '99', '8', 2, 2, '', '2023-01-09 10:18:55');

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
(1, 'pepe', 'smith', 'cruz', 'bcd', '090099', '', '', '2023-01-09 09:46:58');

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
(2, 'Route', '', '2023-01-09 15:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `transaction_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL DEFAULT 0,
  `trip_schedule_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `fare` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remarks` text NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trips`
--

CREATE TABLE `tbl_trips` (
  `trip_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `trip_schedule_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `date_departed` datetime NOT NULL,
  `date_arrived` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `headings` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trip_schedule`
--

CREATE TABLE `tbl_trip_schedule` (
  `trip_schedule_id` int(11) NOT NULL,
  `trip_schedule_marker` text NOT NULL,
  `trip_schedule_time` time NOT NULL,
  `route_id` int(11) NOT NULL,
  `trip_schedule_fare` decimal(12,2) NOT NULL DEFAULT 0.00,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
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
  `user_email` varchar(50) NOT NULL,
  `user_img` text NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `user_category` varchar(1) NOT NULL COMMENT 'P = Passenger; A = Admin; C = Conductor',
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_fname`, `user_mname`, `user_lname`, `user_contact_number`, `user_email`, `user_img`, `username`, `password`, `user_category`, `date_added`) VALUES
(1, 'Juan', 'Santos', 'Dela Cruz', '090956565', 'juan@gmail.com', '', 'admin', '0cc175b9c0f1b6a831c399e269772661', 'A', '2022-12-28 14:38:12'),
(3, 's', 's', 's', 's', 's@d.co', '', 's', 'b148e7f41fdc3be4b14e8d17e068bbad', 'U', '2023-01-05 15:33:57');

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
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_drivers`
--
ALTER TABLE `tbl_drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_route`
--
ALTER TABLE `tbl_route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trips`
--
ALTER TABLE `tbl_trips`
  MODIFY `trip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trip_schedule`
--
ALTER TABLE `tbl_trip_schedule`
  MODIFY `trip_schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
