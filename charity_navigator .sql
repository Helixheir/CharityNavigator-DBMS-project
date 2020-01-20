-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2019 at 11:22 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity_navigator`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`harsha`@`localhost` PROCEDURE `get_donations` ()  NO SQL
BEGIN
select d.name,r.oname,r.donation_type,r.quantity
FROM
donations d,reciept r
WHERE d.id=r.id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `name`, `location`, `email`, `created_at`, `phno`) VALUES
(1, 'harsha', 'bangalore', 'sriharshar1999@gmail.com', '2019-11-11 09:20:06', 1234567890),
(2, 'ravan', 'lanka', 'ravan@gmail.com', '2019-11-15 06:07:29', 2147483647),
(3, 'chithra', 'chennai', 'chithra@gmail.com', '2019-11-15 16:52:25', 1233214563),
(4, 'Srikrishna', 'gokulnagar', 'sriharshar1999@gmail.com', '2019-11-17 10:01:33', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `organisations`
--

CREATE TABLE `organisations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `a_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organisations`
--

INSERT INTO `organisations` (`id`, `name`, `location`, `domain`, `description`, `a_name`, `created_at`) VALUES
(2, 'Rally for Rivers', 'bangalore', 'private', 'we are authorized by the UNICEF', 'vathsa', '2019-11-10 18:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `o_login`
--

CREATE TABLE `o_login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o_login`
--

INSERT INTO `o_login` (`id`, `username`, `password`) VALUES
(2, 'Rally for Rivers', 'rally@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reciept`
--

CREATE TABLE `reciept` (
  `id` int(11) NOT NULL,
  `oname` varchar(255) NOT NULL,
  `donation_type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reciept`
--

INSERT INTO `reciept` (`id`, `oname`, `donation_type`, `quantity`, `created_at`) VALUES
(1, 'Rally for Rivers', 'money', 12345, '2019-11-11 09:20:06'),
(2, 'Rally for Rivers', 'clothes', 25, '2019-11-15 06:07:29'),
(3, 'Belaku Charity house', 'money', 1654, '2019-11-15 16:52:25'),
(4, 'Sri Ram Association', 'money', 1234, '2019-11-17 10:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `trustee`
--

CREATE TABLE `trustee` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `oname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phno` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trustee`
--

INSERT INTO `trustee` (`id`, `fname`, `lname`, `oname`, `email`, `phno`, `created_at`) VALUES
(2, 'Chirag', 'tripati', 'Rally for Rivers', 'rally@gmail.com', 1111111111, '2019-11-10 18:05:09');

--
-- Triggers `trustee`
--
DELIMITER $$
CREATE TRIGGER `trigger` AFTER INSERT ON `trustee` FOR EACH ROW BEGIN
INSERT INTO o_login
(id,username,password) VALUES(new.id,new.oname,new.email);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('harsha', 'harsha@gmail.com', '3636'),
('vathsa', 'vathsa@gmail.com', '1010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `organisations`
--
ALTER TABLE `organisations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
