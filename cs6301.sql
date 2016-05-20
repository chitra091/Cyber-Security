-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2015 at 07:31 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs6301`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int(5) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(30) NOT NULL,
  `emp_add` varchar(30) NOT NULL,
  `emp_ph_no` varchar(10) NOT NULL,
  `emp_sal` float NOT NULL,
  `emp_state` varchar(30) NOT NULL,
  `emp_country` varchar(30) NOT NULL,
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `emp_name` (`emp_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_add`, `emp_ph_no`, `emp_sal`, `emp_state`, `emp_country`) VALUES
(2, 'John Paul ', '2800 Waterview Pkwy', '4695102365', 12844, 'texas', 'us'),
(4, 'Ashley Davis', '2700 Waterview Pkwy', '4695109867', 9845.1, 'texas', 'us'),
(5, 'Jeff', '2700 Waterview Pkwy', '4695105645', 453.23, 'texas', 'us');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(2) NOT NULL AUTO_INCREMENT,
  `permission_type` varchar(30) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_type`) VALUES
(1, 'all'),
(2, 'add'),
(3, 'delete'),
(4, 'edit');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(5) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `permission_id` int(2) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `permission_id`) VALUES
(1, 'admin', 1),
(22, 'developer', 2),
(24, 'manager', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role_id` int(5) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', 1),
(2, 'dev1', 'dev1', 22),
(3, 'dev2', 'dev2', 22),
(4, 'man1', 'man1', 24);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
