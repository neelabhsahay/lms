-- MySQL Script to Create Tables for Lab Resource Management
-- Tables: host, asic, device, port
-- Switch to lab resource database
USE lab_resource_schema;

-- Create user table 
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    deleted BOOLEAN NOT NULL DEFAULT FALSE, 
    password_hash VARCHAR(255) NOT NULL,
    password_type ENUM('PR', 'TP') NOT NULL DEFAULT 'TP',
    modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login_at TIMESTAMP NULL DEFAULT NULL, -- This field is updated by your application on successful login
    privilege_level ENUM('user', 'editor', 'admin') NOT NULL DEFAULT 'user' -- Define explicit privilege levels
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create host table first (as it's referenced by device table)
CREATE TABLE IF NOT EXISTS host (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status ENUM('up', 'down', 'removed') NOT NULL DEFAULT 'up',
    mgmt_ip VARCHAR(45),
    bmc_ip VARCHAR(45),
    updated_by VARCHAR(100),
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    present_used_by VARCHAR(255), -- This field is referencs user table, not made foreign key because use table can be form other place
    reserved_at DATETIME,
    INDEX idx_name (name),
    INDEX idx_status (status),
    INDEX idx_mgmt_ip (mgmt_ip)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create asic table (referenced by device table)
CREATE TABLE IF NOT EXISTS asic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    asic_type VARCHAR(255) NOT NULL UNIQUE,
    updated_by VARCHAR(100),
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_asic_type (asic_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create device table (references host and asic tables)
CREATE TABLE IF NOT EXISTS device (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type ENUM('nic', 'switch') NOT NULL,
    asic INT,
    mgmt_ip VARCHAR(45),
    console_ip VARCHAR(45),
    console_port INT,
    updated_by VARCHAR(100),
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    present_on INT,
    INDEX idx_name (name),
    INDEX idx_type (type),
    INDEX idx_mgmt_ip (mgmt_ip),
    FOREIGN KEY (present_on) REFERENCES host(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (asic) REFERENCES asic(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create port table (references device table and itself)
CREATE TABLE IF NOT EXISTS port (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    connected INT,
    present_on INT,
    updated_by VARCHAR(100),
    updated_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_name (name),
    FOREIGN KEY (connected) REFERENCES port(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (present_on) REFERENCES device(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
