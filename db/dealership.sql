-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 10:51 PM
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
-- Database: `dealership`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` int(20) NOT NULL,
  `car_model` varchar(15) NOT NULL,
  `car_year` int(10) NOT NULL,
  `createdat` datetime(6) DEFAULT current_timestamp(6),
  `appointment_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `make` text NOT NULL,
  `model` varchar(25) NOT NULL,
  `year` int(4) NOT NULL,
  `color` text NOT NULL,
  `price` decimal(50,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`make`, `model`, `year`, `color`, `price`, `image`, `description`, `id`) VALUES
('Lamborghini', 'Aventador SVJ', 2021, 'red', 360000, 'https://cdn.webshopapp.com/shops/305713/files/414541748/image.jpg', 'hjk', 4),
('Lamborghini', 'Revuelto', 2024, 'Orange', 700000, 'https://www.autovisie.nl/wp-content/uploads/2023/03/lamborghini-revuelto-foto-2023-7.jpg', 'new Lambo', 5),
('Lamborghini', 'Veneno', 2013, 'Black', 3300000, 'https://www.razaoautomovel.com/wp-content/uploads/2020/01/Lamborghini_Veneno_Roadster_1_925x520_acf_cropped.jpg', 'V12 engine,\r\n6.5L displacement,\r\n740 HP,\r\n0-100 km/h in 2.9s,\r\n355 km/h top speed,\r\n1490 KG weight,\r\nOpening roof', 7),
('Lamborghini', 'Huracan', 2014, 'Black', 400000, 'https://www.digitaltrends.com/wp-content/uploads/2019/08/2020-lamborghini-huracan-evo-spyder-review-7.jpg?resize=800%2C418&p=1', 'iuqoerqe', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `createdat` datetime DEFAULT current_timestamp(),
  `id` int(10) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`firstname`, `lastname`, `password`, `email`, `phone`, `createdat`, `id`, `role`) VALUES
('Tiago', 'Olim', '$2y$10$qC0HWgemTOBtVc9xMfd18.CE9nVaeaaCmtVbnFKmL4vN6vv32ety.', 'tiago@gmail.com', '0612345678', '2023-10-26 11:24:34', 1, 0),
('diego', 'Kampen', '$2y$10$PAfxxWiqLXRBEBqoi6c7GukuRUv5UwtjN5zAeSnnUDDnD.ZOivYUC', 'diego@gmail.com', '0698765432', '2023-10-27 11:38:09', 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
