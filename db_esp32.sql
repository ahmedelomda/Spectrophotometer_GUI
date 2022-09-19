-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 10:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_esp32`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_form`
--

CREATE TABLE `db_form` (
  `WL1` int(11) DEFAULT NULL,
  `Wl2` int(11) DEFAULT NULL,
  `Wl3` int(11) DEFAULT NULL,
  `A1` int(11) DEFAULT NULL,
  `A2` int(11) DEFAULT NULL,
  `A3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `db_wlform`
--

CREATE TABLE `db_wlform` (
  `ID` int(11) NOT NULL,
  `WL1` int(11) NOT NULL,
  `Wl2` int(11) NOT NULL,
  `Wl3` int(11) NOT NULL,
  `A1` float NOT NULL,
  `A2` float NOT NULL,
  `A3` float NOT NULL,
  `C1` float NOT NULL,
  `C2` float NOT NULL,
  `C3` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `db_wlform`
--

INSERT INTO `db_wlform` (`ID`, `WL1`, `Wl2`, `Wl3`, `A1`, `A2`, `A3`, `C1`, `C2`, `C3`) VALUES
(32, 500, 420, 302, 0.2519, 0.1675, 0.3459, 0.00287327, 0.00100904, 0.00673481),
(33, 600, 400, 320, 0.3519, 0.2675, 0.5459, 0.00388111, 0.00157353, 0.00904407),
(34, 530, 450, 290, 0.522, 0.633, 0.469, 0.00609315, 0.00422, 0.00519035),
(36, 533, 440, 340, 0.333, 0.555, 0.777, 0.00388701, 0.0037, 0.00859894),
(37, 530, 450, 321, 0.333, 0.555, 0.777, 0.00348509, 0.00390845, 0.00966899);

-- --------------------------------------------------------

--
-- Table structure for table `discrete_rgb`
--

CREATE TABLE `discrete_rgb` (
  `id` int(11) NOT NULL,
  `Light` text NOT NULL,
  `Wavelength` int(11) NOT NULL,
  `Absorbtion` float NOT NULL,
  `Concentration` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discrete_rgb`
--

INSERT INTO `discrete_rgb` (`id`, `Light`, `Wavelength`, `Absorbtion`, `Concentration`) VALUES
(1, 'red', 200, 0, 0),
(2, 'red', 200, 0.333, 0.00348509),
(3, 'red', 630, 0.333, 0.00348509);

-- --------------------------------------------------------

--
-- Table structure for table `discrete_wl`
--

CREATE TABLE `discrete_wl` (
  `sample_name` varchar(30) NOT NULL,
  `discription` varchar(200) DEFAULT NULL,
  `WL1` int(11) DEFAULT NULL,
  `WL2` int(11) DEFAULT NULL,
  `equation` int(11) DEFAULT NULL,
  `WL_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discrete_wl`
--

INSERT INTO `discrete_wl` (`sample_name`, `discription`, `WL1`, `WL2`, `equation`, `WL_3`) VALUES
('Blood', 'dinkjd dcjnkjds jk cj', 620, 430, 0, 350),
('FE', 'dcçdvdfdvv fvfv fv', 600, 430, 0, 438),
('glucose', 'mkdlkvfmv mdvfvklfdmv fk ', 600, 330, 0, 333),
('Iron', 'dinkjd dcjnkjds jk cj', 560, 244, 0, 522),
('Water', 'mkdlkvfmv mdvfvklfdmv fk ', 580, 238, 0, 300);

-- --------------------------------------------------------

--
-- Table structure for table `measurments`
--

CREATE TABLE `measurments` (
  `WL1` int(11) NOT NULL,
  `Wl2` int(11) NOT NULL,
  `Wl3` int(11) NOT NULL,
  `A1` int(11) NOT NULL,
  `A2` int(11) NOT NULL,
  `A3` int(11) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `measurments`
--

INSERT INTO `measurments` (`WL1`, `Wl2`, `Wl3`, `A1`, `A2`, `A3`, `C1`, `C2`, `C3`) VALUES
(530, 400, 320, 0, 0, 0, 0, 0, 0),
(530, 400, 300, 0, 0, 0, 0, 0, 0),
(500, 400, 302, 0, 0, 0, 0, 0, 0),
(500, 405, 302, 0, 0, 0, 0, 0, 0),
(530, 400, 320, 0, 0, 0, 0, 0, 0),
(530, 450, 321, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensordata`
--

CREATE TABLE `sensordata` (
  `id` int(6) UNSIGNED NOT NULL,
  `sensor` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `value1` varchar(10) DEFAULT NULL,
  `value2` varchar(10) DEFAULT NULL,
  `value3` varchar(10) DEFAULT NULL,
  `reading_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp`
--

CREATE TABLE `tbl_temp` (
  `temp_id` int(10) UNSIGNED NOT NULL,
  `temp_value` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_temp`
--

INSERT INTO `tbl_temp` (`temp_id`, `temp_value`) VALUES
(1, 27.5),
(2, 26);

-- --------------------------------------------------------

--
-- Table structure for table `wl_scan`
--

CREATE TABLE `wl_scan` (
  `id` int(11) NOT NULL,
  `Start_WL` int(11) NOT NULL,
  `End_WL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wl_scan`
--

INSERT INTO `wl_scan` (`id`, `Start_WL`, `End_WL`) VALUES
(1, 300, 600),
(2, 300, 600);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_wlform`
--
ALTER TABLE `db_wlform`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `discrete_rgb`
--
ALTER TABLE `discrete_rgb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discrete_wl`
--
ALTER TABLE `discrete_wl`
  ADD PRIMARY KEY (`sample_name`);

--
-- Indexes for table `sensordata`
--
ALTER TABLE `sensordata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_temp`
--
ALTER TABLE `tbl_temp`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `wl_scan`
--
ALTER TABLE `wl_scan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_wlform`
--
ALTER TABLE `db_wlform`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `discrete_rgb`
--
ALTER TABLE `discrete_rgb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sensordata`
--
ALTER TABLE `sensordata`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_temp`
--
ALTER TABLE `tbl_temp`
  MODIFY `temp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wl_scan`
--
ALTER TABLE `wl_scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
