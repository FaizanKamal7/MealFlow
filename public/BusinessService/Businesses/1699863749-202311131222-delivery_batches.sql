-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 09:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nixus_erp`
--

--
-- Dumping data for table `delivery_batches`
--

INSERT INTO `delivery_batches` (`id`, `batch_start_time`, `batch_end_time`, `batch_start_map_coordinates`, `batch_end_map_coordinates`, `status`, `driver_id`, `vehicle_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
('9a379d75-22c4-4237-9895-074dbfd044f0', NULL, NULL, NULL, NULL, 'Assigned', '9a2f8265-6628-4d6a-a356-96035204c64c', NULL, NULL, '2023-09-25 05:09:15', '2023-09-25 05:09:15'),
('9a379dbc-1d39-4ad6-9fd3-46611d058af0', '2023-09-15 08:00:23', NULL, '30.3308401,71.247499', NULL, 'Pending', '9a2f817b-ae03-4680-b553-1c7170faea31', '9a8ff645-0981-47c2-a0e2-223dc861ad17', NULL, '2023-09-25 05:10:02', '2023-09-27 01:43:40');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
