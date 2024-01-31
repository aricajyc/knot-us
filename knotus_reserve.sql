-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2024 at 03:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knotus_reserve`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgeter`
--

CREATE TABLE `budgeter` (
  `b_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor` varchar(100) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `detail` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budgeter`
--

INSERT INTO `budgeter` (`b_id`, `user_id`, `vendor`, `price`, `phone`, `detail`) VALUES
(1, 1, 'Suka Dessert', 5679.00, '0123456789', 'Test Quotation Suka Dessert'),
(3, 1, 'Vendor 2', 1545.00, '0123456789', 'test lagi'),
(8, 1, 'Test Vendor 1', 5679.00, '0123456789', 'test'),
(16, 1, 'm1', 1545.00, '0123456789', ''),
(17, 1, 'Vendor 2', 1545.00, '0123456789', 'test lagi');

-- --------------------------------------------------------

--
-- Table structure for table `preset_task`
--

CREATE TABLE `preset_task` (
  `task` varchar(500) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preset_task`
--

INSERT INTO `preset_task` (`task`, `description`, `category`, `status`) VALUES
('Discover your wedding style', 'Pick a theme', 'Venue', '0'),
('Start venue search', 'Find 1-3 venue that suits your theme and add quotation.', 'Venue', '0'),
('Book your reception venue', 'Pick one from your venue quotation', 'Venue', '0'),
('Decide on a vendor list', 'Decide on what and how many vendors do you want. Add quotation.', 'Venue', '0'),
('Book vendor', 'Put the vendor and quotation that you confirmed at Budget Bliss', 'Venue', '0'),
('Research caterers', 'Find 1-3 caterers that suits your budget. Add caterers quotation.', 'Food & Drink', '0'),
('Meet with caterers and food testing', 'Discuss on menu selection and food testing.', 'Food & Drink', '0'),
('Book your caterer', 'Pick one from your quotation.', 'Food & Drink', '0'),
('Save inspiration cake photos', 'Find a cake design that suits your wedding theme.', 'Food & Drink', '0'),
('Research cake bakers', 'Find bakers that can design your dream wedding cake and add quotation', 'Food & Drink', '0'),
('Meet cake bakers', 'Discuss your cake preferences.', 'Food & Drink', '0'),
('Book your cake baker', 'Pick one from your quotation.', 'Food & Drink', '0'),
('Research photographers', 'Find photographers that suits your style and add quotaton', 'Photos & Videos', '0'),
('Research videographers', 'Find videographers that suits your style and add quotation.', 'Photos & Videos', '0'),
('Meet with photographers', 'Discuss your budget and what you want.', 'Photos & Videos', '0'),
('Meet with videographers', 'Discuss your budget and what you want.', 'Photos & Videos', '0'),
('Book your photographer', 'Pick one from your quotation.', 'Photos & Videos', '0'),
('Book your videographer', 'Pick one from your quotation.', 'Photos & Videos', '0'),
('Schedule photoshoot', '', 'Photos & Videos', '0'),
('Finalize shot list', '', 'Photos & Videos', '0'),
('Discover dress style', 'Find an inspiration of your dream wedding dress', 'Attire', '0'),
('Schedule fittings', 'Add dress quotation.', 'Attire', '0'),
('Buy/Rent your wedding attire', 'Pick one dress from your quotation.', 'Attire', '0'),
('Save wedding ring inspiration', '', 'Attire', '0'),
('Shop for wedding rings', 'Add the bill into Budget Bliss so you can track on your spending.', 'Attire', '0'),
('Research bands and DJs', 'Find bands or DJ that suits your wedding theme and budget.', 'Music', '0'),
('Meet with bands and DJs', 'Set an appointment with bands or DJs to discuss song selection and quotation. Add their details at Quotation.', 'Music', '0'),
('Book your band or DJ', 'Make payment and add the band/DJ quotation to budgeter to track your spending.', 'Music', '0'),
('Finalize song list', '', 'Music', '0'),
('Research florists', 'Find florist that suits your wedding theme and budget.', 'Flowers & Decor', '0'),
('Meet with florists', 'Set an appointment to meet with florist and discuss bouquet style for you wedding and ask for quotation. Add their details at Quotation.', 'Flowers & Decor', '0'),
('Save floral inspiration', 'Share floral inspiration with florist.', 'Flowers & Decor', '0'),
('Book your florist', 'Make payment and add the florist quotation to budgeter to track your spending.', 'Flowers & Decor', '0'),
('Discuss with partner about dowry.', '', 'Flowers & Decor', '0'),
('Meet with rental and lighting pros', '', 'Flowers & Decor', '0'),
('List reception extras to buy', 'Add extras to Budgeter to track your spending.', 'Flowers & Decor', '0'),
('Save hair/hijab and makeup photos', 'Find hair/hijab and make up inspiration and share to MUA and hair/hijab stylist. Add their details to quotation.', 'Beauty', '0'),
('Book hair stylists', 'Make payment and add their quotation to Budgeter.', 'Beauty', '0'),
('Book makeup artists', 'Make payment and add their quotation to Budgeter.', 'Beauty', '0');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `t_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` varchar(500) NOT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`t_id`, `user_id`, `task`, `description`, `category`, `status`) VALUES
(1, 1, 'Discover your wedding style', 'Pick a theme', 'Venue', '0'),
(2, 1, 'Start venue search', 'Find 1-3 venue that suits your theme and add quotation.', 'Venue', '0'),
(3, 1, 'Book your reception venue', 'Pick one from your venue quotation', 'Venue', '0'),
(4, 1, 'Decide on a vendor list', 'Decide on what and how many vendors do you want. Add quotation.', 'Venue', '0'),
(5, 1, 'Book vendor', 'Put the vendor and quotation that you confirmed at Budget Bliss', 'Venue', '0'),
(6, 1, 'Research caterers', 'Find 1-3 caterers that suits your budget. Add caterers quotation.', 'Food & Drink', '0'),
(7, 1, 'Meet with caterers and food testing', 'Discuss on menu selection and food testing.', 'Food & Drink', '0'),
(8, 1, 'Book your caterer', 'Pick one from your quotation.', 'Food & Drink', '0'),
(9, 1, 'Save inspiration cake photos', 'Find a cake design that suits your wedding theme.', 'Food & Drink', '0'),
(10, 1, 'Research cake bakers', 'Find bakers that can design your dream wedding cake and add quotation', 'Food & Drink', '0'),
(11, 1, 'Meet cake bakers', 'Discuss your cake preferences.', 'Food & Drink', '0'),
(12, 1, 'Book your cake baker', 'Pick one from your quotation.', 'Food & Drink', '0'),
(13, 1, 'Research photographers', 'Find photographers that suits your style and add quotaton', 'Photos & Videos', '1'),
(14, 1, 'Research videographers', 'Find videographers that suits your style and add quotation.', 'Photos & Videos', '0'),
(15, 1, 'Meet with photographers', 'Discuss your budget and what you want.', 'Photos & Videos', '0'),
(16, 1, 'Meet with videographers', 'Discuss your budget and what you want.', 'Photos & Videos', '0'),
(17, 1, 'Book your photographer', 'Pick one from your quotation.', 'Photos & Videos', '0'),
(18, 1, 'Book your videographer', 'Pick one from your quotation.', 'Photos & Videos', '0'),
(19, 1, 'Schedule photoshoot', '', 'Photos & Videos', '0'),
(20, 1, 'Finalize shot list', '', 'Photos & Videos', '0'),
(21, 1, 'Discover dress style', 'Find an inspiration of your dream wedding dress', 'Attire', '0'),
(22, 1, 'Schedule fittings', 'Add dress quotation.', 'Attire', '0'),
(23, 1, 'Buy/Rent your wedding attire', 'Pick one dress from your quotation.', 'Attire', '0'),
(24, 1, 'Save wedding ring inspiration', '', 'Attire', '0'),
(25, 1, 'Shop for wedding rings', 'Add the bill into Budget Bliss so you can track on your spending.', 'Attire', '0'),
(32, 2, 'Discover your wedding style', 'Pick a theme', 'Venue', '1'),
(33, 2, 'Start venue search', 'Find 1-3 venue that suits your theme and add quotation.', 'Venue', '1'),
(34, 2, 'Book your reception venue', 'Pick one from your venue quotation', 'Venue', '1'),
(35, 2, 'Decide on a vendor list', 'Decide on what and how many vendors do you want. Add quotation.', 'Venue', '0'),
(36, 2, 'Book vendor', 'Put the vendor and quotation that you confirmed at Budget Bliss', 'Venue', '0'),
(37, 2, 'Research caterers', 'Find 1-3 caterers that suits your budget. Add caterers quotation.', 'Food & Drink', '0'),
(38, 2, 'Meet with caterers and food testing', 'Discuss on menu selection and food testing.', 'Food & Drink', '0'),
(39, 2, 'Book your caterer', 'Pick one from your quotation.', 'Food & Drink', '0'),
(40, 2, 'Save inspiration cake photos', 'Find a cake design that suits your wedding theme.', 'Food & Drink', '0'),
(41, 2, 'Research cake bakers', 'Find bakers that can design your dream wedding cake and add quotation', 'Food & Drink', '0'),
(42, 2, 'Meet cake bakers', 'Discuss your cake preferences.', 'Food & Drink', '0'),
(43, 2, 'Book your cake baker', 'Pick one from your quotation.', 'Food & Drink', '0'),
(44, 2, 'Research photographers', 'Find photographers that suits your style and add quotaton', 'Photos & Videos', '0'),
(45, 2, 'Research videographers', 'Find videographers that suits your style and add quotation.', 'Photos & Videos', '0'),
(46, 2, 'Meet with photographers', 'Discuss your budget and what you want.', 'Photos & Videos', '0'),
(47, 2, 'Meet with videographers', 'Discuss your budget and what you want.', 'Photos & Videos', '0'),
(48, 2, 'Book your photographer', 'Pick one from your quotation.', 'Photos & Videos', '0'),
(49, 2, 'Book your videographer', 'Pick one from your quotation.', 'Photos & Videos', '0'),
(50, 2, 'Schedule photoshoot', '', 'Photos & Videos', '0'),
(51, 2, 'Finalize shot list', '', 'Photos & Videos', '0'),
(52, 2, 'Discover dress style', 'Find an inspiration of your dream wedding dress', 'Attire', '0'),
(53, 2, 'Schedule fittings', 'Add dress quotation.', 'Attire', '0'),
(54, 2, 'Buy/Rent your wedding attire', 'Pick one dress from your quotation.', 'Attire', '0'),
(55, 2, 'Save wedding ring inspiration', '', 'Attire', '0'),
(56, 2, 'Shop for wedding rings', 'Add the bill into Budget Bliss so you can track on your spending.', 'Attire', '0'),
(57, 2, 'Research bands and DJs', 'Find bands or DJ that suits your wedding theme and budget.', 'Music', '0'),
(58, 2, 'Meet with bands and DJs', 'Set an appointment with bands or DJs to discuss song selection and quotation. Add their details at Quotation.', 'Music', '0'),
(59, 2, 'Book your band or DJ', 'Make payment and add the band/DJ quotation to budgeter to track your spending.', 'Music', '0'),
(60, 2, 'Finalize song list', '', 'Music', '0'),
(61, 2, 'Research florists', 'Find florist that suits your wedding theme and budget.', 'Flowers & Decor', '0'),
(62, 2, 'Meet with florists', 'Set an appointment to meet with florist and discuss bouquet style for you wedding and ask for quotation. Add their details at Quotation.', 'Flowers & Decor', '0'),
(63, 2, 'Save floral inspiration', 'Share floral inspiration with florist.', 'Flowers & Decor', '0'),
(64, 2, 'Book your florist', 'Make payment and add the florist quotation to budgeter to track your spending.', 'Flowers & Decor', '0'),
(65, 2, 'Discuss with partner about dowry.', '', 'Flowers & Decor', '0'),
(66, 2, 'Meet with rental and lighting pros', '', 'Flowers & Decor', '0'),
(67, 2, 'List reception extras to buy', 'Add extras to Budgeter to track your spending.', 'Flowers & Decor', '0'),
(68, 2, 'Save hair/hijab and makeup photos', 'Find hair/hijab and make up inspiration and share to MUA and hair/hijab stylist. Add their details to quotation.', 'Beauty', '0'),
(69, 2, 'Book hair stylists', 'Make payment and add their quotation to Budgeter.', 'Beauty', '0'),
(70, 2, 'Book makeup artists', 'Make payment and add their quotation to Budgeter.', 'Beauty', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `max_budget` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `name`, `password`, `max_budget`) VALUES
(1, 'test@email.com', 'Test', 'test54321', 30000.00),
(2, 'arica@outlook.com', 'Arica J', 'arica12345', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_quotation`
--

CREATE TABLE `user_quotation` (
  `q_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `detail` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_quotation`
--

INSERT INTO `user_quotation` (`q_id`, `user_id`, `vendor_name`, `price`, `phone`, `detail`) VALUES
(1, 1, 'Suka Dessert', 5679.00, '0123456789', 'Test Quotation Suka Dessert'),
(2, 1, 'Vendor 2', 1545.00, '0123456789', 'test lagi'),
(3, 1, 'Test Vendor 1', 5679.00, '0123456789', 'test'),
(4, 1, 'm1', 1545.00, '0123456789', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgeter`
--
ALTER TABLE `budgeter`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_quotation`
--
ALTER TABLE `user_quotation`
  ADD PRIMARY KEY (`q_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgeter`
--
ALTER TABLE `budgeter`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_quotation`
--
ALTER TABLE `user_quotation`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_quotation`
--
ALTER TABLE `user_quotation`
  ADD CONSTRAINT `user_quotation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
