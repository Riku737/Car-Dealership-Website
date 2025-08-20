-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2025 at 12:50 AM
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
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `body_type`, `colour`, `mileage_km`, `price`, `fuel_type`, `condition_id`, `description`, `image`) VALUES
(1, 'Ford', 'Mustang GT', 2016, 'Coupe', 'Black', 56000.00, 26500.00, 'Petrol', 2, 'A black 2016 Ford Mustang GT coupe delivering classic muscle car performance and aggressive styling.', '68a5fdfdca7db_2016_Mustang_GT.jpg'),
(2, 'Audi', 'A4', 2021, 'Sedan', 'Black', 12000.00, 34500.00, 'Petrol', 1, 'Luxury black Audi A4 with low mileage, refined interior, and cutting-edge technology.', '68a5fe35e5283_Black_Audi_A-series.jpg'),
(3, 'Jeep', 'Cherokee', 2019, 'SUV', 'White', 34000.00, 28800.00, 'Petrol', 1, 'Capable white Jeep Cherokee SUV perfect for both urban driving and off-road adventures.', '68a5fe6411731_White_Jeep_Cherokee_Suv.jpg'),
(4, 'Mercedes-Benz', 'A-Class', 2020, 'Hatchback', 'Blue', 22000.00, 31000.00, 'Petrol', 1, 'Sporty and efficient 5-door Mercedes-Benz A-Class in stunning blue with premium features.', '68a5fec27867b_Blue_Mercedes-benz_5-door_Hatchback.jpg'),
(5, 'Mercedes-Benz', 'E300', 2018, 'Sedan', 'Silver', 54000.00, 39000.00, 'Petrol', 3, 'Executive silver Mercedes E300 sedan, known for comfort, performance, and sleek aesthetics.', '68a5fee2c136a_Silver_Mercedes_E300.jpg'),
(6, 'Mercedes-Benz', 'S-Class', 2022, 'Sedan', 'Black', 7000.00, 88000.00, 'Petrol', 1, 'Luxury at its finest — black 2022 Mercedes S-Class with cutting-edge features and ultra-smooth ride.', '68a5feef794e4_A_Mercedes-Benz_S_Class.jpg'),
(7, 'Ducati', 'Monster 821', 2020, 'Motorbike', 'Red', 8900.00, 13200.00, 'Petrol', 1, 'Red Ducati Monster 821 — Italian engineering, thrilling performance, and bold naked-bike design.', '68a5fef7a08dd_Ducati_Monster_821.jpg'),
(8, 'Honda', 'NSX', 1999, 'Coupe', 'Red', 68000.00, 94000.00, 'Petrol', 2, 'Legendary red Honda NSX JDM supercar — lightweight mid-engine performance and timeless styling.', '68a5feff32b9f_Honda_NSX_JDM_Supercar.jpg'),
(9, 'Land Rover', 'Range Rover', 2020, 'SUV', 'White', 45000.00, 68000.00, 'Petrol', 2, 'White Land Rover Range Rover SUV in excellent condition, driven mostly on highways.', '68a5ff108eb27_pexels-mikebirdy-116675.jpg'),
(10, 'Mercedes-Benz', 'GLE', 2021, 'SUV', 'Black', 32000.00, 72000.00, 'Diesel', 1, 'Black Mercedes-Benz GLE parked, luxury trim with full service history.', '68a5ff266dab1_pexels-mikebirdy-14719364.jpg'),
(11, 'Volkswagen', 'Tiguan', 2019, 'SUV', 'Gray', 61000.00, 28000.00, 'Petrol', 2, 'Gray Volkswagen Tiguan compact SUV, great family car with spacious interior.', '68a5ff5d9900e_pexels-mikebirdy-14038635.jpg'),
(12, 'Honda', 'Civic', 2018, 'Sedan', 'Gray', 74000.00, 18000.00, 'Petrol', 3, 'Gray Honda Civic in fair condition, reliable and fuel efficient.', '68a5ff786eec6_pexels-zachary-vessels-26649727-6794815.jpg'),
(13, 'Honda', 'Civic Type R Fn2', 2010, 'Hatchback', 'Blue', 125000.00, 15000.00, 'Petrol', 2, 'Performance-oriented Honda Civic Type R Fn2 with sport seats and upgraded suspension.', '68a5ff8341404_pexels-arturfilms-14821869.jpg'),
(14, 'Ford', 'Focus', 2017, 'Hatchback', 'Grey', 68000.00, 16500.00, 'Petrol', 2, 'Grey Ford Focus hatchback, clean interior and well-maintained.', '68a5ff9477633_pexels-mikebirdy-1007410.jpg'),
(15, 'Ford', 'C-Max', 2016, 'Hatchback', 'Red', 92000.00, 14000.00, 'Diesel', 3, 'Ford C-Max MPV parked on the road, spacious with sliding rear seats.', '68a5ffb665478_pexels-mikebirdy-7808354.jpg'),
(16, 'Tesla', 'Cybertruck', 2024, 'Pickup', 'Silver', 5000.00, 82000.00, 'Electric', 1, 'Silver Tesla Cybertruck, near-new with cutting-edge features.', '68a5ffc18f005_pexels-mylokaye-24734498.jpg'),
(17, 'Ford', 'Bronco', 2022, 'SUV', 'Red', 15000.00, 56000.00, 'Petrol', 1, 'Front view of red Ford Bronco SUV, rugged off-road capabilities.', '68a5ffd526a5c_pexels-owen-outdoors-409204690-33448378.jpg'),
(18, 'Toyota', 'Prius Prime', 2020, 'Sedan', 'White', 30000.00, 24000.00, 'Hybrid', 1, 'White Toyota Prius Prime plug-in hybrid with excellent fuel economy.', '68a650ed21dd5_pexels-2mephoto-17447894.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
