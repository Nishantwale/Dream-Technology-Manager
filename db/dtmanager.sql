-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2020 at 08:13 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dtmanager`
--
CREATE DATABASE IF NOT EXISTS `dtmanager` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dtmanager`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `password`) VALUES
(1, 'shree@dream-technology.in', 'S3993SHRI*+i');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE IF NOT EXISTS `bank_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` text NOT NULL,
  `account_name` text NOT NULL,
  `account_no` text NOT NULL,
  `ifsc_code` text NOT NULL,
  `branch_name` text NOT NULL,
  `other_info` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `create_link`
--

CREATE TABLE IF NOT EXISTS `create_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` text NOT NULL,
  `security_code` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `office_name` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `primary_contact_no` text NOT NULL,
  `other_contact_no` text NOT NULL,
  `logo` text NOT NULL,
  `password` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `office_name`, `email`, `address`, `primary_contact_no`, `other_contact_no`, `logo`, `password`, `date`, `time`) VALUES
(2, 'ash b', 'dfd', 'fg@h.com', 'fds', '3543512345', '4456', 'ZazfUzV90b.png', 'dsg', '2020-10-16', '16-58-30 PM'),
(3, 'shree', 'dfd', 'fg@h.com', 'fds', '3543512345', '4456', 'wdDlCQYMNW.png', 'dsg', '2020-10-16', '16-59-07 PM'),
(6, 'hfgh', 'sdfdf', 'rtrt@gmIL.COM', 'fghdfh', '5675123443', '5654', 'xGfknWiYYA.png', 'AAA', '2020-10-17', '16-09-24 PM');

-- --------------------------------------------------------

--
-- Table structure for table `customer_services`
--

CREATE TABLE IF NOT EXISTS `customer_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` text NOT NULL,
  `service` text NOT NULL,
  `project_name` text NOT NULL,
  `amount` text NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customer_services`
--

INSERT INTO `customer_services` (`id`, `customer_name`, `service`, `project_name`, `amount`, `status`, `date`, `time`) VALUES
(1, '3', '3', 'TEST', '5000', 'cancel', '2020-10-16', '19-10-56 PM'),
(2, '3', '2', 'TEST', '500', 'show in company profile', '2020-10-16', '19-11-45 PM'),
(3, '2', '2', 'testt', '5000', 'cancel', '2020-10-16', '19-12-01 PM'),
(4, '2', '3', 'TEST WORK', '10000', 'don''t show in company profile', '2020-10-17', '15-33-48 PM'),
(5, '2', '3', 'AAA', '10000', 'don''t show in company profile', '2020-10-17', '15-34-13 PM'),
(6, '2', '2', 'fgcgd', '5454', 'don''t show in company profile', '2020-10-17', '16-01-07 PM'),
(7, '2', '3', 'fdgdg', '111', 'don''t show in company profile', '2020-10-17', '16-16-22 PM');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `gender` text NOT NULL,
  `dob` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  `pincode` text NOT NULL,
  `aadhar_no` text NOT NULL,
  `id_size_photo` text NOT NULL,
  `aadhar_attachment` text NOT NULL,
  `attachment1` text NOT NULL,
  `attachment2` text NOT NULL,
  `attachment3` text NOT NULL,
  `designation` text NOT NULL,
  `joining_date` text NOT NULL,
  `working_technology` text NOT NULL,
  `salary` text NOT NULL,
  `remark` text NOT NULL,
  `job_location` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expences_list`
--

CREATE TABLE IF NOT EXISTS `expences_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_type` text NOT NULL,
  `expence` varchar(200) NOT NULL,
  `amount` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_mgt`
--

CREATE TABLE IF NOT EXISTS `expenses_mgt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expenses` text NOT NULL,
  `amount` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `experience_certificate`
--

CREATE TABLE IF NOT EXISTS `experience_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` text NOT NULL,
  `emp_name` text NOT NULL,
  `date_of_letter` date NOT NULL,
  `duration_from` text NOT NULL,
  `duration_to` text NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `letter_attachment` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` text NOT NULL,
  `total_amount` text NOT NULL,
  `discount_amount` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `customer_id`, `total_amount`, `discount_amount`, `date`, `time`) VALUES
(1, '1', '11555', '2000', '2020-10-16', '13-52-27 PM'),
(2, '1', '10000', '0', '2020-10-17', '14-58-55 PM'),
(3, '2', '300', '0', '2020-10-17', '15-42-05 PM');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_cart`
--

CREATE TABLE IF NOT EXISTS `invoice_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` text NOT NULL,
  `customer_id` text NOT NULL,
  `service` text NOT NULL,
  `actual_amount` text NOT NULL,
  `discount_amount` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `invoice_cart`
--

INSERT INTO `invoice_cart` (`id`, `transaction_id`, `customer_id`, `service`, `actual_amount`, `discount_amount`, `date`, `time`) VALUES
(2, '1', '1', '2', '5555', '1000', '2020-10-16', '13-52-27 PM'),
(3, '1', '1', '3', '6000', '1000', '2020-10-16', '13-52-27 PM'),
(4, '2', '1', '3', '10000', '0', '2020-10-17', '14-58-55 PM'),
(5, '3', '2', '2', '100', '0', '2020-10-17', '15-42-05 PM'),
(6, '3', '2', '2', '100', '0', '2020-10-17', '15-42-05 PM'),
(7, '3', '2', '2', '100', '0', '2020-10-17', '15-42-05 PM');

-- --------------------------------------------------------

--
-- Table structure for table `offer_letters`
--

CREATE TABLE IF NOT EXISTS `offer_letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text1` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_report`
--

CREATE TABLE IF NOT EXISTS `payment_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `services_id` text NOT NULL,
  `cust_id` text NOT NULL,
  `cust_name` text NOT NULL,
  `service_no` text NOT NULL,
  `service_name` text NOT NULL,
  `project_name` text NOT NULL,
  `opening_amount` text NOT NULL,
  `paid_amount` text NOT NULL,
  `bal_amount` text NOT NULL,
  `sms` text NOT NULL,
  `email` text NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` text NOT NULL,
  `language` text NOT NULL,
  `c_name` text NOT NULL,
  `fees` text NOT NULL,
  `student1_name` text NOT NULL,
  `student1_email` text NOT NULL,
  `student1_contact` text NOT NULL,
  `student2_name` text NOT NULL,
  `student2_email` text NOT NULL,
  `student2_contact` text NOT NULL,
  `student3_name` text NOT NULL,
  `student3_email` text NOT NULL,
  `student3_contact` text NOT NULL,
  `student4_name` text NOT NULL,
  `student4_email` text NOT NULL,
  `student4_contact` text NOT NULL,
  `student5_name` text NOT NULL,
  `student5_email` text NOT NULL,
  `student5_contact` text NOT NULL,
  `reg_date` date NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_payment`
--

CREATE TABLE IF NOT EXISTS `project_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` text NOT NULL,
  `project_name` text NOT NULL,
  `amount` text NOT NULL,
  `sms` text NOT NULL,
  `email` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_updates`
--

CREATE TABLE IF NOT EXISTS `project_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` text NOT NULL,
  `project_id` text NOT NULL,
  `update_details` text NOT NULL,
  `attachment` text NOT NULL,
  `status` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE IF NOT EXISTS `quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` text NOT NULL,
  `actual_amount` text NOT NULL,
  `discount_amount` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `cust_id`, `actual_amount`, `discount_amount`, `date`, `time`) VALUES
(2, '2', '2200', '0', '2020-10-17', '14-27-12 PM'),
(3, '3', '7190', '7983', '2020-10-17', '16-21-07 PM');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_cart`
--

CREATE TABLE IF NOT EXISTS `quotation_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` text NOT NULL,
  `cust_id` text NOT NULL,
  `cust_name` text NOT NULL,
  `service_id` text NOT NULL,
  `service_name` text NOT NULL,
  `comment` text NOT NULL,
  `actual_amount` text NOT NULL,
  `discount_amount` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `quotation_cart`
--

INSERT INTO `quotation_cart` (`id`, `transaction_id`, `cust_id`, `cust_name`, `service_id`, `service_name`, `comment`, `actual_amount`, `discount_amount`, `date`, `time`) VALUES
(3, '2', '2', 'ash b', '2', 'WEBSITE', 'TEST', '1000', '0', '2020-10-17', '14-27-12 PM'),
(4, '2', '2', 'ash b', '2', 'WEBSITE', 'TEST', '1200', '0', '2020-10-17', '14-27-12 PM'),
(5, '3', '3', 'shree', 'select', '', ' jhjgjghj', '6565', '656', '2020-10-17', '16-21-07 PM'),
(6, '3', '3', 'shree', 'select', '', 'dfdfg', '56', '6756', '2020-10-17', '16-21-07 PM'),
(7, '3', '2', 'ash b', 'select', '', 'safsdf', '565', '567', '2020-10-17', '16-21-08 PM'),
(8, '3', '2', 'ash b', 'select', '', 'df', '4', '4', '2020-10-17', '16-21-08 PM');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` text NOT NULL,
  `emp_name` text NOT NULL,
  `payment` text NOT NULL,
  `payment_date` text NOT NULL,
  `payment_mode` text NOT NULL,
  `attachment` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `services` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `services`) VALUES
(2, 'df fggg'),
(3, 'ANDROID'),
(5, 'automobile'),
(6, 'ere'),
(9, 'ddddf');

-- --------------------------------------------------------

--
-- Table structure for table `sms_panel`
--

CREATE TABLE IF NOT EXISTS `sms_panel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` text NOT NULL,
  `language` text NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_invoice`
--

CREATE TABLE IF NOT EXISTS `tmp_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` text NOT NULL,
  `service` text NOT NULL,
  `actual_amount` text NOT NULL,
  `discount_amount` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tmp_invoice`
--

INSERT INTO `tmp_invoice` (`id`, `customer_id`, `service`, `actual_amount`, `discount_amount`) VALUES
(5, '2', '3', '656', '65');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_quotation`
--

CREATE TABLE IF NOT EXISTS `tmp_quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` text NOT NULL,
  `cust_name` text NOT NULL,
  `service_id` text NOT NULL,
  `service_name` text NOT NULL,
  `comment` text NOT NULL,
  `actual_amount` text NOT NULL,
  `discount_amount` text NOT NULL,
  `date` date NOT NULL,
  `time` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
