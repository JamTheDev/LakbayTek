-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2023 at 06:43 PM
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
-- Database: `lakbaytek`
--

-- --------------------------------------------------------

--
-- Table structure for table `Packages`
--

CREATE TABLE `Packages` (
  `package_id` varchar(24) NOT NULL,
  `package_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price_weekend` int(11) NOT NULL,
  `price_weekday` int(11) NOT NULL,
  `min_capacity` int(11) NOT NULL,
  `max_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Packages`
--

INSERT INTO `Packages` (`package_id`, `package_name`, `description`, `price_weekend`, `price_weekday`, `min_capacity`, `max_capacity`) VALUES
('1-15-pax', 'Less than 15', 'Intimate &amp; personalized experience for small groups. Unforgettable moments with tailored activities.', 18000, 15000, 1, 15),
('16-20-pax', '16 - 20 pax', 'Memorable journey for medium&mdash;sized groups. Adventure, relaxation &amp; group activities.', 20000, 18000, 16, 20),
('21-30-pax', '21-30 pax', 'Enjoyable travel for larger groups. Scenic locations, group excursions &amp; camaraderie.', 23000, 20000, 21, 30),
('31-40-pax', '31-40 pax', 'Lively &amp; vibrant group experience. Landmarks, team-building &amp; shared adventures.', 25000, 23000, 31, 40),
('41-50-pax', '41-50 pax', 'Grand&mdash;scale group excursion. Diverse locations, exclusive privileges &amp; shared adventure.', 28000, 25000, 41, 50);

-- --------------------------------------------------------

--
-- Table structure for table `Reservations`
--

CREATE TABLE `Reservations` (
  `reservation_id` varchar(24) NOT NULL,
  `package_id` varchar(24) DEFAULT NULL,
  `user_id` varchar(24) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'PENDING',
  `reservation_status` varchar(20) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Reservations`
--

INSERT INTO `Reservations` (`reservation_id`, `package_id`, `user_id`, `date`, `payment_status`, `reservation_status`) VALUES
('0ZdbG-HYJ3-', '21-30-pax', 'g419b-wXpE-zmQG-4lh', '2023-06-15 07:00:00', 'UNPAID', ''),
('KvMkw-k3h9-', '41-50-pax', '9qnN3-aU6J-iYaw-JNE', '2023-06-13 10:00:00', 'UNPAID', '');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` varchar(24) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `email`, `address`, `gender`, `birthdate`, `password`) VALUES
('9qnN3-aU6J-iYaw-JNE', 'REINER CRUZ', 'reiner.buenas@gmail.com', 'SA PUSO NI JUSTINE R. CRUZ', 'Male', '2023-06-07', '$2y$10$.ppB04owW8BFceomDHlEkOfQfOQ.Q9YIeZX3xtWyzC7eQmpPy4qjC'),
('e+2Gc-eZlN-xQw=-EHf', 'Jam', 'email@email.com', 'doon lng sa kanto', 'Male', '2023-05-31', '$2y$10$NUzpMrMDkQbAt3sVKZNpWekqFknDy0LvJ2xoPRjOUcGJrEufn2RIy'),
('g419b-wXpE-zmQG-4lh', 'HELLO WORLD', 'hello.world@gmail.com', 'SA EARTH', 'Male', '2023-06-27', '$2y$10$DXqfq7UdlSeuByvw4mwHces80Gm8z2pL4dELko.iGZI6v4LdnqHdS'),
('tn%CS-Mg1F-iI2S-Ytq', 'TITE LOVER', 'tite@puke.com', 'TITE STREET', 'Female', '2023-05-23', '$2y$10$Pyr/WD8hwwopNZHpEGNwTutNuLJF79YqIT4M4rhoankBOg0f1.bse');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` varchar(24) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(13, 'd88709a361e849b2efd9b950dd90e2e6e2810ef7', '$2y$10$s0NsqYwkAZXUpOFHj6tuU.0A9opRZATPyngO1AL8h9ay5igkeAjTm', 'e+2Gc-eZlN-xQw=-EHf', '2023-06-30 00:00:00'),
(14, 'c82c603cb1a402094cbb5ad0012b961143e95416', '$2y$10$ZBndCw68nuYHGEbbi7J4.OW845WTlCR9tQ2yUtzJSaRWymWwvlJ0y', 'e+2Gc-eZlN-xQw=-EHf', '2023-06-30 00:00:00'),
(21, 'fa669518cf0faa59847d6d0853c1d307e866b479', '$2y$10$xkUXvHmcYk131yeFE99Ape2AHQ8xTyTHxUHsq4ZgtVwYZN29Ib4Fe', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(22, '44cb69060b43eeb1987d6e180e9b25972416209e', '$2y$10$ipE5n0o45wclAbAgSu.H0eXk8A05cX7wcytKuLYr.DNHsAokr6iFC', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(23, '028313c1c9b44fe1cc7f2c22cdbe3d1bfe770b51', '$2y$10$90rf.QOVGJ3kzluZsFInseo/McIQFSYmIuhGkFveLBF.EED0etYmO', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(24, '029ac8f72f574b9a1f27ae9a8ab006703a36dbf9', '$2y$10$IOQ6HKLl.gFDPt03Fm0/2.xp2Y3LkpLECiAUmCrK9OHJbRFWMk5ge', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(25, '6a9830e24946cb51778936f24a3191c21b19f2f4', '$2y$10$UOp922whqipCpDtf..tBbeqDeQKAoROGlxOhOG2qCU81gWWqdxYc.', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(26, '952d426cd029bc398f2a52d1ded3651fbbdb9b4e', '$2y$10$PNqdq3KGW6omRjf9B6cgZu9sM9q5uCZzriE4K8rNS4asuVTsaWK1e', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(27, '63533847e822e2f1c61c0e55d2476044d44c69e6', '$2y$10$e3PcIB9GYodVn5QSn2R2S.69/HuJ1RpTDzOI1utkjf9.vGrwedaI.', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-03 00:00:00'),
(30, '78965e23e12d5551f49c286837aec23592a8b825', '$2y$10$/Off9hSjcVINjCPHuxdYneRiDqppr58.e0lNSkahyN1cOcOpofE86', 'e+2Gc-eZlN-xQw=-EHf', '2023-07-04 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Packages`
--
ALTER TABLE `Packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
