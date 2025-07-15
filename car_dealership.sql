-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 04:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_dealership`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `body_type` varchar(255) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `mileage_km` decimal(9,2) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `condition_id` tinyint(3) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `body_type`, `colour`, `mileage_km`, `price`, `fuel_type`, `condition_id`, `description`, `image_path`) VALUES
(1, 'Ford', 'Mustang GT', 2016, 'Coupe', 'Black', 56000.00, 26500.00, 'Petrol', 2, 'A black 2016 Ford Mustang GT coupe delivering classic muscle car performance and aggressive styling.', 'images/2016_Mustang_GT.jpg'),
(2, 'Audi', 'A4', 2021, 'Sedan', 'Black', 12000.00, 34500.00, 'Petrol', 1, 'Luxury black Audi A4 with low mileage, refined interior, and cutting-edge technology.', 'images/Black_Audi_A-series.jpg'),
(3, 'Jeep', 'Cherokee', 2019, 'SUV', 'White', 34000.00, 28800.00, 'Petrol', 1, 'Capable white Jeep Cherokee SUV perfect for both urban driving and off-road adventures.', 'images/White_Jeep_Cherokee_Suv.jpg'),
(4, 'Mercedes-Benz', 'A-Class', 2020, 'Hatchback', 'Blue', 22000.00, 31000.00, 'Petrol', 1, 'Sporty and efficient 5-door Mercedes-Benz A-Class in stunning blue with premium features.', 'images/Blue_Mercedes-benz_5-door_Hatchback.jpg'),
(5, 'Mercedes-Benz', 'E300', 2018, 'Sedan', 'Silver', 54000.00, 39000.00, 'Petrol', 3, 'Executive silver Mercedes E300 sedan, known for comfort, performance, and sleek aesthetics.', 'images/Silver_Mercedes_E300.jpg'),
(6, 'Mercedes-Benz', 'S-Class', 2022, 'Sedan', 'Black', 7000.00, 88000.00, 'Petrol', 1, 'Luxury at its finest — black 2022 Mercedes S-Class with cutting-edge features and ultra-smooth ride.', 'images/A_Mercedes-Benz_S_Class.jpg'),
(7, 'Ducati', 'Monster 821', 2020, 'Motorbike', 'Red', 8900.00, 13200.00, 'Petrol', 1, 'Red Ducati Monster 821 — Italian engineering, thrilling performance, and bold naked-bike design.', 'images/Ducati_Monster_821.jpg'),
(8, 'Honda', 'NSX', 1999, 'Coupe', 'Red', 68000.00, 94000.00, 'Petrol', 2, 'Legendary red Honda NSX JDM supercar — lightweight mid-engine performance and timeless styling.', 'images/Honda_NSX_JDM_Supercar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
