-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 16, 2017 at 10:04 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ddw_assignment1`
--
CREATE DATABASE IF NOT EXISTS `ddw_assignment1` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ddw_assignment1`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `prod_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(65,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `prod_id`, `quantity`, `total_price`) VALUES
(4, 'jonodogo', 'G001', 1, 19.99),
(5, 'ethan', 'G006', 1, 39.99),
(6, 'admin', 'G005', 1, 39.99),
(7, 'admin', 'G005', 1, 39.99);

-- --------------------------------------------------------

--
-- Table structure for table `prod_accessories`
--

CREATE TABLE IF NOT EXISTS `prod_accessories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_type` varchar(255) NOT NULL,
  `prod_license` varchar(255) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `prod_price` decimal(65,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `prod_accessories`
--

INSERT INTO `prod_accessories` (`id`, `prod_id`, `prod_name`, `prod_desc`, `prod_type`, `prod_license`, `prod_stock`, `prod_price`) VALUES
(1, 'A001', 'Xbox 360 wireless controller', 'Plays games on the 360 and PC.', 'Controller', 'Microsoft Xbox', 45, 19.99),
(2, 'A002', 'DualShock 4 controller', 'Play games on the PlayStation 4 and PC', 'Controller', 'Sony PlayStation', 7, 19.99),
(3, 'A003', 'Protective carry case for Nintendo Switch', 'A portable case to keep the Nintendo Switch safe and secure from minor bumps and scratches.', 'Case', 'Nintedo', 5, 9.99),
(4, 'A004', 'PlayStation Plus 12 month Membership', 'Get 12 months of PlayStation Plus.', 'Subscription', 'Sony PlayStation', 3, 99.99),
(5, 'A005', 'Seagate 2TB Game Drive for Xbox One', 'An external hard drive for the Xbox One in a fancy case.', 'Storage', 'Microsoft', 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `prod_consoles`
--

CREATE TABLE IF NOT EXISTS `prod_consoles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_company` varchar(255) NOT NULL,
  `prod_year` int(11) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `prod_price` decimal(65,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `prod_consoles`
--

INSERT INTO `prod_consoles` (`id`, `prod_id`, `prod_name`, `prod_desc`, `prod_company`, `prod_year`, `prod_stock`, `prod_price`) VALUES
(1, 'C001', 'Nintendo Switch', 'Hybrid console for big TV play or portable on the go play.', 'Nintendo', 2017, 123, 299.99),
(2, 'C002', 'PlayStation 4', 'PlayStations 4th iteration of the PlayStation consoles. Capable of 1080p gameplay.', 'Sony PlayStation', 2014, 44, 399.99),
(3, 'C003', 'Xbox One', 'Microsoft 3rd iteration of the Xbox consoles. Capable of 1080p at 60 fps.', 'Microsoft Xbox', 2014, 11, 499.99),
(4, 'C004', 'PlayStation 3', 'PlayStations 3rd iteration of the PlayStations consoles. Play both games and Blue-ray DVDs.', 'Sony PlayStation', 2006, 102, 299.99),
(5, 'C005', 'Xbox 360', 'Microsoft second iteration of the Xbox consoles. Play exclusive titles such as Halo or Gears of War.', 'Microsoft Xbox', 2006, 32, 399.99),
(6, 'C006', 'Nintendo Wii U', 'Predecessor to the Wii, the Wii U has a controller with a built in screen for enhanced gaemplays.', 'Nintendo', 2012, 56, 249.99),
(7, 'C007', 'PlayStation 2', 'PlayStations second iteration of the PlayStation consoles. Most sold console in history.', 'Sony PlayStation', 2000, 222, 279.99),
(8, 'C008', 'Xbox Original', 'The first iteration of the Xbox consoles. Play Exclusive titles such as Halo and Blinxs.', 'Microsoft Xbox', 2000, 99, 339.99),
(9, 'C009', 'Nintendo DS', 'Nintendos most infamous portable gaming device with dual screen play. ', 'Nintendo', 2004, 12, 159.99),
(10, 'C010', 'Nintendo Wii', 'Well known and well loved home console utilising motion controllers to play titles.', 'Nintendo', 2006, 64, 239.99);

-- --------------------------------------------------------

--
-- Table structure for table `prod_games`
--

CREATE TABLE IF NOT EXISTS `prod_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(255) NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `prod_developer` varchar(255) NOT NULL,
  `prod_publisher` varchar(255) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `prod_price` decimal(65,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `prod_games`
--

INSERT INTO `prod_games` (`id`, `prod_id`, `prod_image`, `prod_name`, `prod_desc`, `prod_developer`, `prod_publisher`, `prod_stock`, `prod_price`) VALUES
(1, 'G001', 'sonicrush', 'Sonic Rush', 'Nintendo DS game Blaze the cat is first introduced. Play Both Blaze and Sonic through 2D levels and fight 3D bosses.', 'Dimps', 'Sega', 7, 19.99),
(2, 'G002', 'halo3', 'Halo 3', 'Finish the fight in the trilogy final instalment to stop the Flood and the Covenant once and for all.', 'Bungie', 'Microsoft', 7, 39.99),
(3, 'G003', 'mario', 'New Super Mario Bros', 'Wii platforming game where Mario must save the princess....again.', 'Nintendo EAD', 'Nintendo', 7, 19.99),
(4, 'G004', 'sonicheroes', 'Sonic Heroes', 'Play as various teams consiting of Sonic''s friends in the attempt to thwart Dr Eggmans plan, and another evil lurking in the shadows.', 'Sonic team USA', 'Sega', 12, 15.99),
(5, 'G005', 'borderlands', 'Borderlands Handsome Collection', 'Play both Borderlands 2 and pre-sequal on one disc in remastered HD quality ports on the PS4.', 'Gearbox Software', '2K games', 16, 39.99),
(6, 'G006', 'mcc', 'Master Cheif Collection', 'Play Halo CE, 2,3 and 4 in a all new HD remastered port for the Xbox One. Play in 1080p at 60fps.', '343 Industries', 'Microsoft', 9, 39.99),
(7, 'G007', 'transformers', 'Transformers', 'A PS2 game based on the Armada series, where you take the role of optimus prime to fight megatron and the evil decepticons', 'Melbourne House', 'Atari', 4, 15.99),
(8, 'G008', 'fallout3', 'Fallout 3', 'Its the end of the world, the end!', 'Bethesda Game Studios', 'Bethesda softworks', 3, 1.99),
(9, 'G009', 'sonicmania', 'Sonic Mania', 'Game made by a fan for the fans. Sonic returns to the 2D glory days in this new platformer game.', 'PagodaWest Games, Headcannon', 'Sega', 7, 15.99),
(10, 'G010', 'soniclostworld', 'Sonic Lost World', 'Sonic meets Mario Galaxy, thats it!', 'Sonic Team', 'Sega', 16, 32.99),
(23, 'G098', 'test', 'test name', 'this is a test record', 'by me', 'by me', 2147483647, 9999.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `address`, `access_level`) VALUES
(7, 'admin', '$2y$12$nkncbjig0WVT6uMMhfYqJelGURYS8a4PnZHxxMmnkvILdQBzwoagK', 'jon', 'palmer', 'jpalmer@newmail.com', '123 somewhere, nowwhere, anywhere WN1 3HD', 1),
(13, 'ethan', '$2y$12$2/svIB5asPGkh9ubNM/vxe3JU8ivzHIg031ZMtGP2QlR/qe6yvAuC', 'ethan', 'ethan', 'ethan@ethan.ethan', 'ethan', 3),
(14, 'sarahP', '$2y$12$9weQDFa8nCF/.olvRhxJQ.cHjBMfbxZY0CWPLQ6sx640CnafOOh/W', 'sarah', 'palmer', 's.palmer@fakemail.com', 'New address ave, original town', 2),
(16, 'jonodogo', '$2y$12$B1rpD6N9uIaYE27cD6pHGunmgTdPCOxsb0jmu2RhspdZ8yS2YbAsa', 'jonathan', 'palmer', 'jpalmer@fakemail.fake', 'somewhere, anywhere, nowehere', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
