-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 05:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `low cal energy drink`
--

-- --------------------------------------------------------

--
-- Table structure for table `drink_names`
--

CREATE TABLE `drink_names` (
  `drink_name` varchar(30) NOT NULL,
  `manufacturer` varchar(35) NOT NULL,
  `flavor_profile` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci COMMENT='stores energy drinks and their manufacturers';

--
-- Dumping data for table `drink_names`
--

INSERT INTO `drink_names` (`drink_name`, `manufacturer`, `flavor_profile`) VALUES
('alphaland', '3d', 'lemonade'),
('baja burst', 'ryse', 'lime'),
('berry blue', '3d', 'blue raspberry'),
('blood raz', 'bucked up', 'red raspberry'),
('blue raspberry', 'ghost', 'blue raspberry'),
('blue raz', 'bucked up', 'blue raspberry'),
('candy punch', '3d', 'fruit punch'),
('cherry limeade', 'reign', 'cherry and lime'),
('cherry limenade', 'ghost', 'cherry and lime'),
('citrus', 'ghost', 'citrus'),
('citrus dew', '3d', 'citrus'),
('country time lemonade', 'ryse', 'lemonade'),
('faze pop', 'ghost', 'bomb pop'),
('frost', '3d', 'citrus'),
('galaxy lime', '3d', 'lime'),
('grape', '3d', 'grape'),
('grape gainz', 'bucked up', 'grape'),
('gym n juice', 'bucked up', 'citrus'),
('killa oj', 'bucked up', 'orange'),
('kool aid tropical punch', 'ryse', 'fruit punch'),
('lemon lime', 'prime', 'lemon and lime'),
('liberty pop', '3d', 'bomb pop'),
('lilikoi lychee', 'reign', 'passion fruit and lychee'),
('mango tango', 'bucked up', 'mango'),
('melon mania', 'reign', 'watermelon'),
('miami', 'bucked up', 'tropical'),
('orange cream', 'ghost', 'orange cream'),
('orange dreamsicle', 'reign', 'orange cream'),
('orange mango', 'prime', 'orange and mango'),
('pink lemonade', 'bucked up', 'pink lemonade'),
('prime blue raspberry', 'prime', 'blue raspberry'),
('pump n grind', 'bucked up', 'grape and green apple'),
('razzle berry', 'reign', 'berry'),
('redberry', 'ghost', 'red raspberry'),
('reignbow sherbet', 'reign', 'citrus sherbet'),
('ring pop berry blast', 'ryse', 'berry'),
('rocket pop', 'bucked up', 'bomb pop'),
('smarties original flavor', 'ryse', 'fruit punch'),
('sour green apple', 'ghost', 'green apple'),
('sour watermelon', 'ghost', 'watermelon'),
('strawberry kiwi', 'bucked up', 'strawberry kiwi'),
('strawberry watermelon', 'prime', 'strawberry and watermelon'),
('sunburst', '3d', 'tropical'),
('sunny d tangy original', 'ryse', 'orange'),
('swedish fish', 'ghost', 'swedish fish'),
('tiger\'s blood', 'ryse', 'tiger\'s blood'),
('tropical mango', 'ghost', 'mango'),
('tropical punch', 'prime', 'fruit punch'),
('tropical storm', 'reign', 'orange and pineapple'),
('ultra black', 'monster', 'cherry'),
('ultra blue', 'monster', 'citrus and berry'),
('ultra fiesta mango', 'monster', 'mango'),
('ultra gold', 'monster', 'pineapple'),
('ultra paradise', 'monster', 'kiwi and lime'),
('ultra peachy keen', 'monster', 'peach'),
('ultra red', 'monster', 'berry'),
('ultra rosa', 'monster', 'grapefruit'),
('ultra strawberry dreams', 'monster', 'strawberry'),
('ultra sunrise', 'monster', 'orange'),
('ultra violet', 'monster', 'grape'),
('ultra watermelon', 'monster', 'watermelon'),
('white gummy bear', 'reign', 'white gummy bear'),
('wild orchard', 'bucked up', 'peach'),
('zero ultra', 'monster', 'citrus');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_info`
--

CREATE TABLE `manufacturer_info` (
  `manufacturer` varchar(35) NOT NULL,
  `caffeine_content (mg)` decimal(20,2) NOT NULL DEFAULT 0.00,
  `b12_content (mcg)` decimal(20,2) NOT NULL DEFAULT 0.00,
  `b_content (mg)` decimal(20,2) NOT NULL DEFAULT 0.00,
  `carnitine_content (mg)` decimal(20,2) NOT NULL DEFAULT 0.00,
  `taurine_content (mg)` decimal(20,2) NOT NULL DEFAULT 0.00,
  `beta_a_content (g)` decimal(20,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci COMMENT='contains manufacturers and their corresponding ingredients';

--
-- Dumping data for table `manufacturer_info`
--

INSERT INTO `manufacturer_info` (`manufacturer`, `caffeine_content (mg)`, `b12_content (mcg)`, `b_content (mg)`, `carnitine_content (mg)`, `taurine_content (mg)`, `beta_a_content (g)`) VALUES
('3d', '200.00', '3.40', '31.78', '250.00', '250.00', '0.00'),
('bucked up', '300.00', '200.00', '25.00', '0.00', '100.00', '2.00'),
('ghost', '200.00', '2.40', '17.70', '1000.00', '1000.00', '0.00'),
('monster', '150.00', '11.76', '28.08', '198.66', '1000.00', '0.00'),
('prime', '200.00', '3.60', '2.55', '0.00', '100.00', '0.00'),
('reign', '300.00', '6.00', '22.84', '0.00', '0.00', '0.00'),
('ryse', '200.00', '0.00', '0.00', '0.00', '500.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `recommends`
--

CREATE TABLE `recommends` (
  `username` varchar(30) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `drink_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci COMMENT='stores drink recommendation';

-- --------------------------------------------------------

--
-- Table structure for table `review_identifiers`
--

CREATE TABLE `review_identifiers` (
  `reviewID` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `drink_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci COMMENT='contains identifying information concerning reviews';

-- --------------------------------------------------------

--
-- Table structure for table `review_information`
--

CREATE TABLE `review_information` (
  `username` varchar(30) NOT NULL,
  `drink_name` varchar(30) NOT NULL,
  `rating` int(2) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci COMMENT='contains review information';

--
-- Dumping data for table `review_information`
--

INSERT INTO `review_information` (`username`, `drink_name`, `rating`, `comment`) VALUES
('Dvwg', 'miami', 4, ''),
('Dvwg', 'reignbow sherbet', 6, 'pretty good, crash not worth'),
('Dvwg', 'rocket pop', 8, ''),
('Dvwg', 'tropical storm', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `location` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci COMMENT='Stores user data';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `email`, `location`) VALUES
('Dvwg', '$2y$10$0oIinPiKjVem5TpoVfSlmuUFgSCf4XZvjAj9f4IWEz7cRhKnXIbDi', 'Alejandro', 'dvwg@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drink_names`
--
ALTER TABLE `drink_names`
  ADD PRIMARY KEY (`drink_name`),
  ADD KEY `FK_drink_names_manufacturer_info` (`manufacturer`);

--
-- Indexes for table `manufacturer_info`
--
ALTER TABLE `manufacturer_info`
  ADD PRIMARY KEY (`manufacturer`);

--
-- Indexes for table `recommends`
--
ALTER TABLE `recommends`
  ADD PRIMARY KEY (`username`,`datetime`),
  ADD KEY `FK_recommends_drink_names` (`drink_name`);

--
-- Indexes for table `review_identifiers`
--
ALTER TABLE `review_identifiers`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `FK_review_identifiers_drink_names` (`drink_name`),
  ADD KEY `FK_review_identifiers_user` (`username`);

--
-- Indexes for table `review_information`
--
ALTER TABLE `review_information`
  ADD PRIMARY KEY (`username`,`drink_name`),
  ADD KEY `drink_name` (`drink_name`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `review_identifiers`
--
ALTER TABLE `review_identifiers`
  MODIFY `reviewID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drink_names`
--
ALTER TABLE `drink_names`
  ADD CONSTRAINT `FK_drink_names_manufacturer_info` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturer_info` (`manufacturer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recommends`
--
ALTER TABLE `recommends`
  ADD CONSTRAINT `FK_recommends_drink_names` FOREIGN KEY (`drink_name`) REFERENCES `drink_names` (`drink_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_recommends_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review_identifiers`
--
ALTER TABLE `review_identifiers`
  ADD CONSTRAINT `FK_review_identifiers_drink_names` FOREIGN KEY (`drink_name`) REFERENCES `drink_names` (`drink_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_review_identifiers_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review_information`
--
ALTER TABLE `review_information`
  ADD CONSTRAINT `FK_review_information_drink_names` FOREIGN KEY (`drink_name`) REFERENCES `drink_names` (`drink_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_review_information_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
