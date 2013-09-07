-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time:
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `widgets`
--

-- --------------------------------------------------------

--
-- Table structure for table `widget_packs`
--

CREATE TABLE `widget_packs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_pack_size` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Table for storing widget pack sizes' AUTO_INCREMENT=1 ;