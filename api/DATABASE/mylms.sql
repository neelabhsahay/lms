-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2016 at 12:47 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylms`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `empId` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `passwordType` varchar(3) NOT NULL DEFAULT 'TP',
  `accountType` varchar(3) NOT NULL DEFAULT 'EMP',
  `modifyedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`empId`, `username`, `password`, `passwordType`) VALUES
('EN00001', 'admin', '72c5a4143e012d2d999449d7d42bbc63d5693779', '2');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empId` varchar(30) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NULL,
  `lastName` varchar(50)  NULL,
  `manager` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` BIGINT(30) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfJoin` date NOT NULL,
  `location` varchar(50) NOT NULL,
  `empRole` varchar(40) NOT NULL,
  `empType` varchar(40) NOT NULL DEFAULT 'PRO',
  `empStatus` int(2) NOT NULL DEFAULT '1',
  `modifyedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leaveId` varchar(20) NOT NULL,
  `leaveType` varchar(30) NOT NULL,
  `leaveMax` int(11) NOT NULL,
  `leaveProvMax` int(11) NOT NULL,
  `modifyedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `emp_leaves_status`
--

CREATE TABLE `emp_leaves_status` (
  `empId` varchar(30) NOT NULL,
  `leaveId` varchar(20) NOT NULL,
  `year` int(6) NOT NULL,
  `leaveCarried` DECIMAL(3, 2) NOT NULL DEFAULT '0.00',
  `leaveInYear` DECIMAL(3, 2) NOT NULL DEFAULT '0.00',
  `leaveUsed` DECIMAL(3, 2) NOT NULL DEFAULT '0.00',
  `modifiedBy` varchar(30) NOT NULL,
  `modifyedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `emp_leaves_request`
--

CREATE TABLE `emp_leaves_request` (
  `reqId` int(11) NOT NULL,
  `empId` varchar(30) NOT NULL,
  `leaveId` varchar(20) NOT NULL,
  `appliedBy` varchar(30) NOT NULL,
  `appliedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leaveDays` DECIMAL(3, 2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `reason` varchar(400),
  `approver` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Applied',
  `modifyedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empId`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leaveId`);
--
-- Indexes for table `emp_leaves_status`
--
ALTER TABLE `emp_leaves_status`
  ADD PRIMARY KEY (`leaveId`, `empId`, `year`);
--
-- Indexes for table `emp_leaves_request`
--
ALTER TABLE `emp_leaves_request`
  ADD PRIMARY KEY (`reqId`);

--
-- AUTO_INCREMENT for table `emp_leaves_request`
--
ALTER TABLE `emp_leaves_request`
  MODIFY `reqId` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
