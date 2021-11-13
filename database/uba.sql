-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2021 at 08:40 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uba`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_ID` int(10) NOT NULL,
  `acc_Number` varchar(10) DEFAULT NULL,
  `acc_Type` varchar(120) NOT NULL,
  `acc_Date` date DEFAULT NULL,
  `acc_Balance` double DEFAULT NULL,
  `cli_ID` int(10) DEFAULT NULL,
  `branch_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_ID`, `acc_Number`, `acc_Type`, `acc_Date`, `acc_Balance`, `cli_ID`, `branch_ID`) VALUES
(176, '1818291428', 'Savings', '2021-08-12', 50, 176, 2),
(177, '1818273736', 'Savings', '2021-08-12', 20, 177, 2),
(178, '6262431787', 'Savings', '2021-08-30', 50, 178, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_ID` int(10) NOT NULL,
  `bank_Name` varchar(120) NOT NULL,
  `bank_Address` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_ID`, `bank_Name`, `bank_Address`) VALUES
(1, 'Fnb', 'Soshanguve'),
(2, 'Capitec', 'Sosha');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_ID` int(10) NOT NULL,
  `branch_Code` int(6) NOT NULL,
  `branch_Name` varchar(120) NOT NULL,
  `branch_Address` varchar(120) NOT NULL,
  `branch_Date` date DEFAULT NULL,
  `bank_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_ID`, `branch_Code`, `branch_Name`, `branch_Address`, `branch_Date`, `bank_ID`) VALUES
(1, 121212, 'Soshanguve', 'Matlala Street', '2021-06-16', 1),
(2, 181818, 'Gauteng', 'Sosha', '2012-02-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cli_ID` int(10) NOT NULL,
  `cli_Name` varchar(120) NOT NULL,
  `cli_Surname` varchar(120) NOT NULL,
  `cli_Address` varchar(120) NOT NULL,
  `cli_Phone` varchar(20) NOT NULL,
  `cli_Email` varchar(120) NOT NULL,
  `cli_Password` varchar(255) NOT NULL,
  `cli_Prov` varchar(120) NOT NULL,
  `level` int(10) NOT NULL,
  `cli_IDNo` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cli_ID`, `cli_Name`, `cli_Surname`, `cli_Address`, `cli_Phone`, `cli_Email`, `cli_Password`, `cli_Prov`, `level`, `cli_IDNo`) VALUES
(176, 'Simphiwe', 'Mthanti', 'Flathela', '0724283941', 'admidfgdfn@fnb.com', '$2y$10$7WXgJbaurc8h6Dwuoz9kR.uAlNAwuxei2x7f7J3OuxesHVTGGlD1q', 'Western Cape', 2, '9702185854086'),
(177, 'Simphiwe', 'Mthanti', 'Flathela', '0724283941', 'admidfgdfn@fnb.com', '$2y$10$1Ro7HS8wtchYm6FvySviEujXpF1.5GB3bASea.5i6H0beHgGWpQy.', 'North West', 2, '9602185854086'),
(178, 'Simphiwe', 'Mthanti', 'Flathela', '0724283941', 'admidfgdfn@fnb.com', '$2y$10$OVp.nXdEi7y.0jaeeEiQDe6Gta6rCo.B8rphf9WF/5LW.dsC7pzc6', 'North West', 2, '9602185854086');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_ID` int(10) NOT NULL,
  `emp_Name` varchar(120) NOT NULL,
  `emp_Surname` varchar(120) NOT NULL,
  `emp_Number` varchar(120) NOT NULL,
  `emp_Email` varchar(120) NOT NULL,
  `emp_Address` varchar(120) NOT NULL,
  `emp_Password` text NOT NULL,
  `bank_ID` int(10) NOT NULL,
  `emp_Prov` varchar(120) NOT NULL,
  `level` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_ID`, `emp_Name`, `emp_Surname`, `emp_Number`, `emp_Email`, `emp_Address`, `emp_Password`, `bank_ID`, `emp_Prov`, `level`) VALUES
(12, 'Siyabonga', 'Gumede', '724101990', 'admin@capitec.com', 'Osizweni', '$2y$10$dfMHDYZH1Vg7tlvF1jJQs.2uAnxzmDOg/gZwI0Tj0h52coQQwaedK', 2, 'Mpumalanga', 3),
(13, 'simphiwe', 'Mthanti', '922333193', 'admin@fnb.com', 'Sdfsdfsdfsd', '$2y$10$lAZ5Jd1uyHFBO2Dja8V.GOUvjQqbaXf7Gz/Tacnv36vAYlq/WhG8a', 1, 'Northern Cape', 3),
(100, 'SB MNTAMBO', 'Gama', '922499728', 'mntambosanelisiwe26@gmail.com', '83 MDLALOSE STREET, NQUTHU', '$2y$10$amNfZ4r473kC0YSyNE2xuuzO94YBqi7Jmw3PoVW8oJvQ0FxoZOf.a', 1, 'KwaZulu Natal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `trans_ID` int(10) NOT NULL,
  `trans_Type` varchar(120) NOT NULL,
  `trans_Amount` double DEFAULT NULL,
  `acc_Number` varchar(10) NOT NULL,
  `trans_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_ID`, `trans_Type`, `trans_Amount`, `acc_Number`, `trans_Date`) VALUES
(109, 'Airtime from Account No 1818273736  Capitec to  Cell Phone 0658314141 CELLC R30', 30, '1818273736', '2021-08-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_ID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_ID`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cli_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cli_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `trans_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
