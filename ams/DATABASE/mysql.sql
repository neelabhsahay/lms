-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 12:47 PM
-- Server version: 10.0.17-MariaDB
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";

--
-- Database: `myams`
--

--
-- Table structure for table: `category`
--

CREATE TABLE `category` (
  `categoryId` BIGINT NOT NULL,
  `name` varchar(50) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);
ALTER TABLE `category`
  MODIFY `categoryId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: `delivery`
--

CREATE TABLE `delivery` (
  `deliveryId` BIGINT NOT NULL,
  `name` varchar(50) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deliveryId`);
ALTER TABLE `delivery`
  MODIFY `deliveryId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: `sub_category`
--

CREATE TABLE `sub_category` (
  `subCategoryId` BIGINT NOT NULL,
  `name` varchar(50) NOT NULL,
  `categoryId` BIGINT NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subCategoryId`);
ALTER TABLE `sub_category`
  MODIFY `subCategoryId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `sub_category`
  ADD CONSTRAINT FK_Category FOREIGN KEY (categoryId) REFERENCES category (categoryId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: `items`
--

CREATE TABLE `items` (
  `itemId` BIGINT NOT NULL,
  `name` varchar(50) NOT NULL,
  `categoryId` BIGINT NOT NULL,
  `deliveryId` BIGINT NOT NULL,
  `subCategoryId` BIGINT NOT NULL,
  `isExpired` TINYINT NOT NULL DEFAULT false,
  `barcode` BIGINT NOT NULL DEFAULT 0,
  `serialNo` BIGINT NOT NULL DEFAULT 0,
  `description` varchar(200) NULL,
  `hasAtrribute` TINYINT NOT NULL DEFAULT false,
  `productCode` varchar(50) NOT NULL DEFAULT 0,
  `manufactureId` INT NOT NULL DEFAULT 0,
  `brandId` INT NOT NULL DEFAULT 0,
  `deleted` INT(1) NOT NULL DEFAULT 0,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);
ALTER TABLE `items`
  MODIFY `itemId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `items`
  ADD CONSTRAINT FK_Category FOREIGN KEY (categoryId) REFERENCES category (categoryId)
  ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `items`
  ADD CONSTRAINT FK_SubCategory FOREIGN KEY (subCategoryId) REFERENCES sub_category (subCategoryId)
  ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `items`
  ADD CONSTRAINT FK_Delivery FOREIGN KEY (deliveryId) REFERENCES delivery (deliveryId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` BIGINT NOT NULL,
  `propertyField` varchar(50) NOT NULL,
  `propertyValue` varchar(50) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);
ALTER TABLE `attribute`
  MODIFY `attributeId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: `attribute_items`
--
CREATE TABLE `attribute_items` (
  `attributeId` BIGINT NOT NULL,
  `itemId` BIGINT NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `attribute_items`
  ADD CONSTRAINT FK_Attribute FOREIGN KEY (attributeId) REFERENCES attribute (attributeId)
  ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `attribute_items`
  ADD CONSTRAINT FK_Item FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: `stocks`
--
CREATE TABLE `stocks` (
  `stockId` BIGINT NOT NULL,
  `name` varchar(50) NOT NULL,
  `itemId` BIGINT NOT NULL,
  `inventoryDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numInStock` BIGINT NOT NULL DEFAULT 0,
  `numAssigned` BIGINT NOT NULL DEFAULT 0,
  `location` varchar(50)  NULL,
  `locationCode` varchar(30)  NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stockId`);
ALTER TABLE `stocks`
  MODIFY `stockId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `stocks`
  ADD CONSTRAINT FK_StocksItem FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: lot_info
--

CREATE TABLE `lot_info` (
  `lotInfoId` BIGINT NOT NULL,
  `itemId` BIGINT NOT NULL,
  `quantity` BIGINT NOT NULL DEFAULT 0,
  `purchaseDate` date NOT NULL,
  `purchasePricePerUnit` DECIMAL(20, 2) NOT NULL DEFAULT 0.0,
  `dateOfOrder` date NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `lot_info`
  ADD PRIMARY KEY (`lotInfoId`);
ALTER TABLE `lot_info`
  MODIFY `lotInfoId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `lot_info`
  ADD CONSTRAINT FK_ItemLot FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: notification
--

CREATE TABLE `notification` (
  `notificationId` BIGINT NOT NULL,
  `empId` varchar(20) NOT NULL,
  `itemId` BIGINT NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationId`);
ALTER TABLE `notification`
  MODIFY `notificationId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `notification`
  ADD CONSTRAINT FK_ItemNot FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: fileLinks
--

CREATE TABLE `fileLinks` (
  `attachmentId` BIGINT NOT NULL,
  `recordType` varchar(30) NOT NULL,
  `recordId` BIGINT NOT NULL,
  `fileLink` varchar(50) NOT NULL,
  `fileName` varchar(100) NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `fileLinks`
  ADD PRIMARY KEY (`attachmentId`);
ALTER TABLE `fileLinks`
  MODIFY `attachmentId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: depreciation
--

CREATE TABLE `depreciation` (
  `depreciationId` BIGINT NOT NULL,
  `itemId` BIGINT NOT NULL,
  `depreciationDate` date NOT NULL,
  `depreciationAmount` DECIMAL(20, 2) NOT NULL DEFAULT 0.0,
  `bookValue` DECIMAL(20, 2) NOT NULL DEFAULT 0.0,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `depreciation`
  ADD PRIMARY KEY (`depreciationId`);
ALTER TABLE `depreciation`
  MODIFY `depreciationId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `notification`
  ADD CONSTRAINT FK_ItemNot FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: maintenances
--

CREATE TABLE `maintenances` (
  `maintenanceId` BIGINT NOT NULL,
  `itemId` BIGINT NOT NULL,
  `maintenanceDate` date NOT NULL,
  `maintenanceDescription` varchar(100) NULL,
  `maintenancePerformedBy` varchar(20) NULL,
  `maintenanceCost` DECIMAL(20, 2) NOT NULL DEFAULT 0.0,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`maintenanceId`);
ALTER TABLE `maintenances`
  MODIFY `maintenanceId` BIGINT NOT NULL AUTO_INCREMENT;

ALTER TABLE `maintenances`
  ADD CONSTRAINT FK_ItemMaint FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: reports
--

CREATE TABLE `reports` (
  `reportId` BIGINT NOT NULL,
  `reportName` varchar(30) NOT NULL,
  `reportDesc` varchar(200) NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `reports`
  ADD PRIMARY KEY (`reportId`);
ALTER TABLE `reports`
  MODIFY `reportId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: status
--

CREATE TABLE `status` (
  `statusId` BIGINT NOT NULL,
  `status` varchar(30) NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `status`
  ADD PRIMARY KEY (`statusId`);
ALTER TABLE `status`
  MODIFY `statusId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: variables
--

CREATE TABLE `variables` (
  `variableId` BIGINT NOT NULL,
  `firstAgreedDate` date NOT NULL,
  `agreeDateEnc` date NOT NULL,
  `regName` varchar(30) NULL,
  `regEmail` varchar(30) NULL,
  `regNo` INT NOT NULL,
  `FicscalLastDay` date NOT NULL,
  `FicscalLastMonth` date NOT NULL,
  `NotYetDeleted` INT(1) NULL,
  `Version` DECIMAL(5,2) NULL,
  `DV` varchar(30) NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `variables`
  ADD PRIMARY KEY (`variableId`);
ALTER TABLE `variables`
  MODIFY `variableId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: vendors
--

CREATE TABLE `vendors` (
  `vendorId` BIGINT NOT NULL,
  `vendorName` varchar(50) NOT NULL,
  `contactFirstName` varchar(30) NULL,
  `contactLastName` varchar(30) NULL,
  `address` varchar(100) NULL,
  `city` varchar(50) NULL,
  `stateOrProvince` varchar(50) NULL,
  `postalCode` INT NOT NULL,
  `country` varchar(30) NULL,
  `phoneNumber` INT NOT NULL,
  `faxNumber` INT NOT NULL,
  `note` varchar(200) NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendorId`);
ALTER TABLE `vendors`
  MODIFY `vendorId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: employee_assets
--

CREATE TABLE `employee_assets` (
  `empAssetsId` BIGINT NOT NULL,
  `empId` varchar(30) NOT NULL,
  `itemId` BIGINT NOT NULL,
  `dateOut` datetime NOT NULL,
  `dateReturn` datetime NOT NULL,
  `note` varchar(200) NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `employee_assets`
  ADD PRIMARY KEY (`empAssetsId`);
ALTER TABLE `employee_assets`
  MODIFY `empAssetsId` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `employee_assets`
  ADD CONSTRAINT FK_ItemEmp FOREIGN KEY (itemId) REFERENCES items (itemId)
  ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Table structure for table: transaction
--

--
-- Table structure for table: orders
--

CREATE TABLE `orders` (
  `orderId` BIGINT NOT NULL,
  `empId` varchar(30) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(2) NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);
ALTER TABLE `orders`
  MODIFY `orderId` BIGINT NOT NULL AUTO_INCREMENT;

--
-- Table structure for table: order_items
--

CREATE TABLE `order_items` (
  `orderId` BIGINT NOT NULL,
  `itemId` BIGINT NOT NULL,
  `numOfItems` INT NOT NULL,
  `quantity` int NULL,
  `createdOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` TIMESTAMP NOT NULL  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);
ALTER TABLE `orders`
  MODIFY `orderId` BIGINT NOT NULL AUTO_INCREMENT;
