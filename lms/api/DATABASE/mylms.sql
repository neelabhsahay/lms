-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 12:47 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";

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
  `email` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `deleted` INT(1) NOT NULL DEFAULT 0,
  `passwordType` ENUM('TP', 'PR') NOT NULL DEFAULT 'TP',
  `accountType` ENUM('EMP', 'ADM', 'SUP') NOT NULL DEFAULT 'EMP',
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
-- username: admin password: admin
--

INSERT INTO `login` (`empId`, `username`, `password`, `passwordType`) VALUES
('EN00001', 'admin', '$2y$10$PrVbIKkll.8e990lauc71.cfm9cQiINQxCsOA/ljsT91FHZhzd49W', '2');

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
  `departmentId` varchar(30) NULL,
  `division` varchar(30) NULL,
  `grade` varchar(30) NULL DEFAULT 'NA',
  `topLevel` varchar(30) NULL DEFAULT 'NA',
  `costCenter` varchar(30) NULL DEFAULT 'NA',
  `email` varchar(40) NOT NULL,
  `contact` BIGINT(30) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfJoin` date NOT NULL,
  `location` varchar(50) NOT NULL,
  `empRole` varchar(40) NOT NULL,
  `url` varchar(200),
  `empType` ENUM('PRO', 'PER', 'TMP', 'INT', 'CNT') NOT NULL DEFAULT 'PRO',
  `empStatus` ENUM('ACT', 'INA') NOT NULL DEFAULT 'ACT',
  `deleted` INT(1) NOT NULL DEFAULT 0,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 
-- Table strcuture for table 'employee_address'
--

CREATE TABLE `employee_address` (
   `empId` varchar(30) NOT NULL,
   `modifiedBy` varchar(30) NOT NULL,
   `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

-- 
-- Table strcuture for table 'employee_bank'
--

CREATE TABLE `employee_bank` (
   `empId` varchar(30) NOT NULL,
   `modifiedBy` varchar(30) NOT NULL,
   `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

-- 
-- Table strcuture for table 'employee_personal'
--

CREATE TABLE `employee_personal` (
   `empId` varchar(30) NOT NULL,
   `aadhaar` BIGINT(30) NULL,
   `pan` varchar(30) NULL,
   `dateOfBirth` date NOT NULL,
   `modifiedBy` varchar(30) NOT NULL,
   `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

-- --------------------------------------------------------
-- Table structure for table `employee_family`
--

CREATE TABLE `employee_family` (
  `familyId` int(40) NOT NULL,
  `empId` varchar(30) NOT NULL,
  `familyName` varchar(200) NOT NULL,
  `relation` varchar(30) NOT NULL,
  `nationality` varchar(30) NULL,
  `gender` ENUM('Male', 'Female', 'Third') NOT NULL,
  `contact` BIGINT(30) NULL,
  `dateOfBirth` date  NULL,
  `bloodGroup` varchar(50) NULL,
  `location` varchar(50) NOT NULL,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

--
-- Table Structure for deperment
--

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leaveId` varchar(20) NOT NULL,
  `leaveType` varchar(30) NOT NULL,
  `leaveMax` int(11) NOT NULL DEFAULT 0,
  `leaveProvMax` int(11) NOT NULL DEFAULT 0,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `emp_leaves_status`
--

CREATE TABLE `emp_leaves_status` (
  `empId` varchar(30) NOT NULL,
  `leaveId` varchar(20) NOT NULL,
  `year` YEAR(4) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leaveCarried` DECIMAL(20, 2) NOT NULL DEFAULT '0.00',
  `leaveInYear` DECIMAL(20, 2) NOT NULL DEFAULT '0.00',
  `leaveUsed` DECIMAL(20, 2) NOT NULL DEFAULT '0.00',
  `modifiedBy` varchar(30) NOT NULL,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `emp_leaves_request`
--

CREATE TABLE `emp_leaves_request` (
  `reqId` int(11) NOT NULL,
  `empId` varchar(30) NOT NULL,
  `leaveId` varchar(20) NOT NULL,
  `year` int(6) NOT NULL DEFAULT 2021,
  `appliedBy` varchar(30) NOT NULL,
  `appliedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leaveDays` DECIMAL(20, 2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `reason` varchar(400) NULL,
  `approver` varchar(30) NOT NULL,
  `status` ENUM('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
  `leaveRqtState` ENUM('Applied', 'Revoke') NOT NULL DEFAULT 'Applied',
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table 'holiday'
--

CREATE TABLE `holidays` (
  `holidayId` int(11) NOT NULL,
  `holidayName` varchar(100) NOT NULL,
  `holidayDate` date NOT NULL,
  `year` YEAR(4) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table 'travel'
--

CREATE TABLE `travel_requests` (
  `travelReqId` int(11) NOT NULL,
  `empId` varchar(30) NOT NULL,
  `travelType` varchar(50) NOT NULL,
  `origin` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `tripStartDate` date NOT NULL,
  `tripEndDate` date NOT NULL,
  `orgVp` varchar(50) NULL,
  `travelPropose` varchar(50) NOT NULL,
  `travelJustification` varchar(200) NOT NULL,
  `status` ENUM('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
  `createdOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `travel_request_status` (
  `travelReqStatusId` BIGINT NOT NULL,
  `travelReqId` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `modifiedby` varchar(30) NOT NULL,
  `state` ENUM('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
  `createdOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `travel_expense` (
  `travelExpenseId` BIGINT NOT NULL,
  `travelReqId` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` DECIMAL(5,2) NOT NULL,
  `description` varchar(200) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `exchangeRate` DECIMAL(5,2) NOT NULL,
  `createdOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Indexes for table `admins`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);
ALTER TABLE `login`
  ADD UNIQUE (`empId`);
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
-- FOREIGN KEY for emp_leaves_status
--
ALTER TABLE `emp_leaves_status`
   ADD CONSTRAINT FK_EmpStatus FOREIGN KEY (empId) REFERENCES employees (empId)
   ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `emp_leaves_status`
   ADD CONSTRAINT FK_LeaveStatus FOREIGN KEY (leaveId) REFERENCES leaves (leaveId)
   ON DELETE CASCADE ON UPDATE RESTRICT;


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

--
-- FOREIGN KEY for emp_leaves_request
--
ALTER TABLE `emp_leaves_request`
   ADD CONSTRAINT FK_EmpRequest FOREIGN KEY (empId) REFERENCES employees (empId)
   ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `emp_leaves_request`
   ADD CONSTRAINT FK_LeaveRequest FOREIGN KEY (leaveId) REFERENCES leaves (leaveId)
   ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `emp_leaves_request`
   ADD CONSTRAINT FK_ApproverRequest FOREIGN KEY (approver) REFERENCES employees (empId)
   ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `emp_leaves_request`
   ADD CONSTRAINT FK_AppliedByRequest FOREIGN KEY (appliedBy) REFERENCES employees (empId)
   ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- PRIMARY KEY & FOREIGN KEY for employee_address
--
ALTER TABLE `employee_address`
  ADD PRIMARY KEY (`empId`);

ALTER TABLE `employee_address`
  ADD CONSTRAINT FK_EmpAddress FOREIGN KEY (empId) REFERENCES employees (empId)
  ON DELETE CASCADE ON UPDATE RESTRICT;
--
-- AUTO_INCREMENT for table `employee_family`
--
ALTER TABLE `employee_family`
  ADD PRIMARY KEY (`familyId`);
ALTER TABLE `employee_family`
  MODIFY `familyId` int(11) NOT NULL AUTO_INCREMENT;

--
-- FOREIGN KEY for employee_family
--
ALTER TABLE `employee_family`
   ADD CONSTRAINT FK_EmpFamily FOREIGN KEY (empId) REFERENCES employees(empId)
   ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- PRIMARY KEY & FOREIGN KEY for employee_address
--
ALTER TABLE `employee_bank`
  ADD PRIMARY KEY (`empId`);
  
ALTER TABLE `employee_bank`
  ADD CONSTRAINT FK_EmpAddress FOREIGN KEY (empId) REFERENCES employees (empId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- PRIMARY KEY & FOREIGN KEY for employee_personal
--
ALTER TABLE `employee_personal`
  ADD PRIMARY KEY (`empId`);

ALTER TABLE `employee_personal`
  ADD CONSTRAINT FK_EmpPersonal FOREIGN KEY (empId) REFERENCES employees (empId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`holidayId`);
ALTER TABLE `holidays`
  MODIFY `holidayId` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `travel_requests`
--
ALTER TABLE `travel_requests`
  ADD PRIMARY KEY (`travelReqId`);
ALTER TABLE `travel_requests`
  MODIFY `travelReqId` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `travel_requests`
  ADD CONSTRAINT FK_EmpTravel FOREIGN KEY (empId) REFERENCES employees (empId)
  ON DELETE CASCADE ON UPDATE RESTRICT;


--
-- AUTO_INCREMENT for table `travel_request_status`
--
ALTER TABLE `travel_request_status`
  ADD PRIMARY KEY (`travelReqStatusId`);
ALTER TABLE `travel_request_status`
  MODIFY `travelReqStatusId` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `travel_request_status`
  ADD CONSTRAINT FK_EmpTravelReq FOREIGN KEY (travelReqId) REFERENCES travel_requests (travelReqId)
  ON DELETE CASCADE ON UPDATE RESTRICT;


--
-- AUTO_INCREMENT for table `travel_expense`
--
ALTER TABLE `travel_expense`
  ADD PRIMARY KEY (`travelExpenseId`);
ALTER TABLE `travel_expense`
  MODIFY `travelExpenseId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `travel_expense`
  ADD CONSTRAINT FK_EmpTravelExpen FOREIGN KEY (travelReqId) REFERENCES travel_requests (travelReqId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

