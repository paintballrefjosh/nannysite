-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2010 at 07:11 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `nannysite`
--

-- --------------------------------------------------------

--
-- Table structure for table `nanny_child`
--

CREATE TABLE IF NOT EXISTS `nanny_child` (
  `child_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` int(1) unsigned NOT NULL DEFAULT '0',
  `family_id` int(11) unsigned NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`child_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `nanny_family`
--

CREATE TABLE IF NOT EXISTS `nanny_family` (
  `family_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` int(1) unsigned NOT NULL DEFAULT '0',
  `family_name` varchar(32) NOT NULL,
  `payment_rate` varchar(4) NOT NULL,
  `payment_amount` decimal(11,2) NOT NULL,
  PRIMARY KEY (`family_id`),
  KEY `payment_rate` (`payment_rate`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `nanny_parent`
--

CREATE TABLE IF NOT EXISTS `nanny_parent` (
  `parent_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `family_id` int(11) unsigned NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `email_address` varchar(32) NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `nanny_payment`
--

CREATE TABLE IF NOT EXISTS `nanny_payment` (
  `payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `family_id` int(11) unsigned NOT NULL,
  `payment_date` int(11) unsigned NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `method` varchar(32) NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121235 ;

-- --------------------------------------------------------

--
-- Table structure for table `nanny_schedule`
--

CREATE TABLE IF NOT EXISTS `nanny_schedule` (
  `child_id` int(11) unsigned NOT NULL,
  `start_time` int(11) unsigned NOT NULL,
  `end_time` int(11) unsigned NOT NULL,
  `fee` decimal(11,2) NOT NULL DEFAULT '0.00',
  KEY `child_id` (`child_id`),
  KEY `start_time` (`start_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email_address` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

