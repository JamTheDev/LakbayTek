-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2023 at 11:37 AM
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
-- Table structure for table `PasswordReset`
--

CREATE TABLE `PasswordReset` (
  `id` int(11) NOT NULL,
  `user_id` varchar(24) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `expiration` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PasswordReset`
--

INSERT INTO `PasswordReset` (`id`, `user_id`, `reset_token`, `expiration`) VALUES
(13, 'QDjE-YXS-hRh-Gu0-lmW-', '404f7dd35dd4e7d882ad5abd46a8311ad7e2e77b', '2023-06-07 03:13:06'),
(14, 'QDjE-YXS-hRh-Gu0-lmW-', '4ae5598a9ae8244e91047ecf4bd427a0d8e9efb6', '2023-06-07 04:53:32'),
(15, 'QDjE-YXS-hRh-Gu0-lmW-', '253b8d0be0cef5f1f8ad63f45584e755a4951bcb', '2023-06-07 05:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` varchar(24) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `reference_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Payment`
--

INSERT INTO `Payment` (`payment_id`, `user_id`, `image_path`, `reference_number`) VALUES
(1, 'QDjE-YXS-hRh-Gu0-lmW-', 'uploads/64814b48084a6_CODEFEST-M11-12.png', '675656');

-- --------------------------------------------------------

--
-- Table structure for table `Reservations`
--

CREATE TABLE `Reservations` (
  `reservation_id` varchar(24) NOT NULL,
  `package_id` varchar(24) DEFAULT NULL,
  `user_id` varchar(24) DEFAULT NULL,
  `check_in_date` datetime DEFAULT NULL,
  `check_out_date` datetime NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'PENDING',
  `reservation_status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Reservations`
--

INSERT INTO `Reservations` (`reservation_id`, `package_id`, `user_id`, `check_in_date`, `check_out_date`, `payment_status`, `reservation_status`, `payment_id`) VALUES
('Ldp7pKMd7', '31-40-pax', 'QDjE-YXS-hRh-Gu0-lmW-', '2023-06-19 08:00:00', '2023-06-20 06:00:00', 'PENDING', 'PENDING', NULL),
('MI5hcJYyr', '31-40-pax', 'QDjE-YXS-hRh-Gu0-lmW-', '2023-06-24 12:00:00', '2023-06-29 10:00:00', 'PENDING', 'PENDING', NULL);

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
  `password` text NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `email`, `address`, `gender`, `birthdate`, `password`, `verified`) VALUES
('9qnN3-aU6J-iYaw-JNE', 'REINER CRUZ', 'reiner.buenas@gmail.com', 'SA PUSO NI JUSTINE R. CRUZ', 'Male', '2023-06-07', '$2y$10$.ppB04owW8BFceomDHlEkOfQfOQ.Q9YIeZX3xtWyzC7eQmpPy4qjC', 0),
('D4TP-V9d-QCw-pSa-gPW-', 'Jam Emmanuel', '2004jamvillarosa@gmail.com', 'Hello World!', 'Male', '2023-06-06', '$2y$10$u0gO92TrkvcsMmUgGoeJMOB.ZnMcydD2EF.YKoWOP4BAUSFeWqb.u', 1),
('e+2Gc-eZlN-xQw=-EHf', 'Jam', 'email@email.com', 'doon lng sa kanto', 'Male', '2023-05-31', '$2y$10$NUzpMrMDkQbAt3sVKZNpWekqFknDy0LvJ2xoPRjOUcGJrEufn2RIy', 0),
('g419b-wXpE-zmQG-4lh', 'HELLO WORLD', 'hello.world@gmail.com', 'SA EARTH', 'Male', '2023-06-27', '$2y$10$DXqfq7UdlSeuByvw4mwHces80Gm8z2pL4dELko.iGZI6v4LdnqHdS', 0),
('JZQBz-wual-Bpyg-Dvr', 'ahsdaidjad', 'register.test@gmail.com', 'alsjaiojad', 'Male', '2023-06-14', '$2y$10$8xqMs.N3lVWkv0uiyYBB6uzc6RrgVBH/b.jDuPB/708SEwUirxrq6', 0),
('nNYnC-bHtI-P7kO-Mxf', 'asad', 'helloworld@gmail.com', 'asaa', 'Female', '2023-06-21', '$2y$10$UCXmt0rV9nTvff0sP.EwquyxOTcazdY36hU6li4z32zqMx7fowToq', 0),
('QDjE-YXS-hRh-Gu0-lmW-', 'asdada', 'geod332@gmail.com', 'asdad', 'Male', '2023-06-12', '$2y$10$8Cwx20GUVV8o/Qm8ucIWje9ajDXX9RuGsmI6ONRUmQRZ0TeBTdEcK', 0),
('tn%CS-Mg1F-iI2S-Ytq', 'TITE LOVER', 'tite@puke.com', 'TITE STREET', 'Female', '2023-05-23', '$2y$10$Pyr/WD8hwwopNZHpEGNwTutNuLJF79YqIT4M4rhoankBOg0f1.bse', 0);

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
(33, '51cb4fe63ce58ed2fad7c832e0cbac4c864dc177', '$2y$10$41uJxRJBUjGnIUWvZpedXecOPjccgSWv6sFA3OAXKVRbJIyhIlqZK', 'QDjE-YXS-hRh-Gu0-lmW-', '2023-07-07 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Packages`
--
ALTER TABLE `Packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `PasswordReset`
--
ALTER TABLE `PasswordReset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_id` (`payment_id`);

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
-- AUTO_INCREMENT for table `PasswordReset`
--
ALTER TABLE `PasswordReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Payment`
--
ALTER TABLE `Payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `PasswordReset`
--
ALTER TABLE `PasswordReset`
  ADD CONSTRAINT `PasswordReset_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Payment`
--
ALTER TABLE `Payment`
  ADD CONSTRAINT `Payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`);

--
-- Constraints for table `Reservations`
--
ALTER TABLE `Reservations`
  ADD CONSTRAINT `Reservations_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `Payment` (`payment_id`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
