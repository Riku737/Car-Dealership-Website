-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 07:00 PM
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

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `year`, `body_type`, `colour`, `mileage_km`, `price`, `fuel_type`, `condition_id`, `description`, `image_path`) VALUES
(1, 'Chevrolet', 'Impala', 2011, 'Sedan', 'Black', 64322.00, 5000.00, 'Petrol', 1, 'A well-maintained black Chevrolet Impala sedan, offering comfort and smooth driving. Great for daily commuting.', 'images/pexels-mikebirdy-244206.jpg'),
(2, 'Chevrolet', 'Malibu', 2023, 'Sedan', 'Black', 1200.00, 22000.00, 'Petrol', 1, 'A nearly-new 2023 Chevrolet Malibu with minimal mileage. Modern tech, efficient engine, and stylish design.', 'images/pexels-mikebirdy-244206.jpg'),
(3, 'Hyundai', 'Tucson', 2015, 'SUV', 'Blue', 101449.00, 9500.00, 'Petrol', 2, 'Spacious and fuel-efficient 2015 Hyundai Tucson. Great for families and long trips with lots of cargo space.', 'images/pexels-mikebirdy-244206.jpg'),
(4, 'Honda', 'CR-V', 2014, 'SUV', 'White', 79680.00, 10400.00, 'Petrol', 2, 'Reliable and popular white Honda CR-V with moderate mileage. Known for its versatility and safety features.', 'images/pexels-mikebirdy-244206.jpg'),
(5, 'Nissan', 'Frontier', 2014, 'Pickup', 'Gray', 107095.00, 11385.00, 'Petrol', 3, 'Durable Nissan Frontier pickup truck, ideal for hauling and off-road driving. Mechanically sound.', 'images/pexels-mikebirdy-244206.jpg'),
(6, 'Ford', 'Fusion', 2019, 'Sedan', 'Red', 43993.00, 14849.00, 'Petrol', 1, 'Sporty red 2019 Ford Fusion in excellent condition. Comfortable interior with advanced safety features.', 'images/pexels-mikebirdy-244206.jpg'),
(7, 'Nissan', 'Rogue', 2018, 'Crossover', 'Gray', 87266.00, 12731.00, 'Petrol', 2, 'Versatile gray Nissan Rogue crossover with spacious interior and reliable performance.', 'images/pexels-mikebirdy-244206.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
