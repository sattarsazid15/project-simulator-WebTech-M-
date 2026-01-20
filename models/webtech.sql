-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 09:54 AM
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
-- Database: `webtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT 'COD',
  `status` varchar(50) DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `customer_name`, `contact`, `address`, `total_amount`, `payment_method`, `status`, `order_date`) VALUES
(4, 6, 'M.A.SAZID', '01648960618', 'Uttarpara', 2673000.00, 'COD', 'Cancelled', '2026-01-04 09:29:14'),
(5, 6, 'M.A.SAZID', '01648960618', 'aaaaa', 210000.00, 'COD', 'Delivered', '2026-01-04 10:08:05'),
(6, 9, 'khan', '01648960618', 'aaaaa', 99900.00, 'COD', 'Cancelled', '2026-01-07 22:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_feedback`
--

CREATE TABLE `order_feedback` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `added_by` varchar(50) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `price`, `description`, `image`, `added_by`) VALUES
(3, 'iphone 17 Pro Max', 'mobile', 165000.00, 'Display: 6.9\" LTPO Super Retina XDR OLED, 120Hz with 3000 nits peak brightness\r\n\r\nCamera: 48MP triple camera with periscope zoom, LiDAR scanner, and 4K Dolby Vision video\r\n\r\nProcessor: Apple A19 Pro (3nm) with 6-core GPU for flagship performance\r\n\r\nBattery: Up to 5088mAh with 50% charge in 20 minutes (wired) + MagSafe/Qi2 wireless charging\r\n\r\nConnectivity: 5G, Wi-Fi 7, Bluetooth 6.0, USB-C 3.2, NFC, UWB Gen2\r\n\r\nSpecial Features: Face ID, Ceramic Shield 2 protection, IP68 water resistance, Emergency SOS via satellite, 3D spatial video & audio support\r\n  ', '1767454237.png', 'admin'),
(4, 'iphone 17 air', 'mobile', 130000.00, 'Display: 6.5” LTPO Super Retina XDR OLED, 120Hz, HDR10, Dolby Vision\r\nPlatform: iOS 26\r\nChipset: Apple A19 Pro (3 nm), hexa-core CPU, 5-core Apple GPU\r\nMain Camera: Single 48MP Fusion lens with sensor-shift OIS, dual LED flash, HDR\r\nSelfie Camera: 18MP ultrawide front with 3D depth sensor, HDR, Dolby Vision HDR\r\nVideo: 4K up to 60fps, 1080p up to 240fps, gyro-EIS stabilization\r\nBattery: 3149 mAh Li-Ion, 20W wired, 20W wireless(15W in China), 4.5W reverse wired', '1767455196.png', 'admin'),
(5, 'iphone 16 pro', 'mobile', 121992.00, 'Display: 6.3\" LTPO Super Retina XDR OLED, 120Hz ProMotion, 2000 nits peak brightness\r\n\r\nBuild Quality: Grade 5 titanium frame, Ceramic Shield glass, IP68 certified\r\n\r\nPerformance: Apple A18 Pro chip (3nm), 6-core GPU, iOS 18, USB-C Gen 2\r\n\r\nCamera: Triple 48MP wide + 5x telephoto + ultrawide, ProRes, 3D spatial video, LiDAR\r\n\r\nBattery & Charging: 3582mAh battery, 50% in 30 min, MagSafe, Qi2 & reverse wired charging', '1767455304.png', 'admin'),
(6, 'samsung s24 ultra', 'mobile', 99900.00, 'Display: 6.8\" Dynamic LTPO AMOLED 2X, 120Hz, HDR10+, 2600 nits\r\nCamera: 200MP quad-camera with 5x periscope zoom, 12MP selfie\r\nProcessor: Snapdragon 8 Gen 3 (4nm) for top-tier performance\r\nBattery: 5000mAh with 45W wired, 15W wireless, 4.5W reverse charging\r\nConnectivity: 5G, Wi-Fi 7, Bluetooth 5.3, UWB, Samsung DeX support', '1767455419.jpg', 'admin'),
(7, 'Google Pixel 9 Pro', 'mobile', 93990.00, 'Experience flagship performance with the Google Pixel 9 Pro, featuring a 6.3\" display, 50MP camera, Google Tensor G4 processor, 4700mAh battery and 27W fast charging for seamless efficiency and reliability.', '1767455559.jpg', 'admin'),
(8, 'macbook air m4', 'computer', 112000.00, 'Processor-Processor Brand: Apple | Processor Model: M4 | Processor Core: 10 Core CPU 8 Core GPU,Ram-16 GB Unified\r\n\r\nDisplay-Display Size: 13.6 inch | Display Type: Liquid Retina Display LED IPS | Display Resolution: 2560 x 1664 pixels | Display Features: Wide color (P3) | 500 nits Brightness | True Tone Technology | 1 Billion Colors\r\n', '1767455846.png', 'admin'),
(9, 'macbook pro m4', 'computer', 248000.00, 'Processor: Apple M4 chip with 12-core CPU, 16-core GPU, 16-core Neural Engine\r\nRAM: 24GB, Storage: 512GB/ 1TB SSD\r\nDisplay: 14.2\" Liquid Retina XDR display (3024x1964)\r\nFeatures: Backlit Magic Keyboard, Touch ID, Wi-Fi 6E, Bluetooth 5.3', '1767456006.jpg', 'admin'),
(10, 'Lenovo Legion Pro 5 16ADR10 Ryzen 7 8745HX RTX 5060 8GB Graphics 16\" WQXGA OLED 165Hz Gaming Laptop', 'computer', 210000.00, 'MPN: 83LT0030LK\r\nModel: Legion Pro 5 16ADR10\r\nProcessor: AMD Ryzen 7 8745HX (8C / 16T, 3.6 / 5.1GHz, 8MB L2 / 32MB L3)\r\nRAM: 32GB DDR5-5200, Storage: 1TB M.2 2242 PCIe 4.0x4 NVMe SSD\r\nGraphics: GeForce RTX 5060 8GB GDDR7, Boost Clock 2497MHz\r\nFeatures: RGB Backlit Keyboard, E-shutter, Wi-Fi 7, G-SYNC, Free-Sync Premiu', '1767456188.jpg', 'admin'),
(11, 'ASUS Vivobook 15 OLED M1505YA Ryzen 7 7730U 8GB RAM 15.6\" FHD Laptop', 'computer', 891000.00, 'MPN: M1505YA-L1382\r\nModel: Vivobook 15 OLED M1505YA\r\nProcessor: AMD Ryzen 7 7730U (20MB Cache, up to 4.5 GHz)\r\nRAM: 8GB DDR4, SSD: 512GB M.2 NVMe PCIe 3.0 SSD\r\nDisplay: 15.6\" Full HD (1920 x 1080) OLED, 0.2ms Response Time\r\nFeatures: Backlit Keyboard, Type-C, Privacy Shutter, Wi-Fi 6E', '1767456287.jpg', 'admin'),
(13, 'Sony LinkBuds S WF-LS900N Earbuds', 'gadget', 209000.00, 'MPN: WF-LS900N\r\nModel: LinkBuds S\r\nDriver: 0.2\", Noise Canceling\r\nConnectivity: Bluetooth 5.2\r\nBattery Charge Time: Approx. 2 hrs (USB charging)\r\nBattery Life: Max. 20 hrs (6 hrs+14 hrs)', '1767456538.jpg', 'admin'),
(14, 'KOSPET Tank T3 Ultra 2', 'gadget', 9790.00, 'Model: Tank T3 Ultra 2\r\nDisplay: 1.43” AMOLED, 466x466 Display\r\nFull-metal Bezel & Corning Gorilla Glass 3 Screen\r\nWaterproof: 5 ATM & IP69K (Dive-proof) Water-resistance\r\nFeatures: Dual-Band GPS, 15 U.S. MIL-STD-810H Military Grade Certified', '1767456647.jpg', 'admin'),
(15, 'Baseus Comet Series PPMD10 22.5W 10000mAh Power Bank With Cable', 'gadget', 1650.00, 'Model: PPMD10\r\nPower Capacity: 10000 mAh\r\nType-C Input: 5V=2A, 9V=2A, 12V=1.5A\r\nType-C Output: 5V=3A, 9V=2.22A, 12V=1.5A\r\nMulti-Protocol Certified', '1767456824.jpg', 'admin'),
(16, 'Marshall Major IV Wireless Over-Ear Headphones', 'gadget', 14500.00, 'Weight\r\n\r\n165g\r\n\r\nAudio\r\nFrequency Range\r\n\r\n20-20,000 Hz\r\n\r\nImpedance\r\n\r\n32 Ω\r\n\r\nSensitivity\r\n\r\n99 dB SPL (100mV @ 1kHz)\r\n\r\nDriver Diameter\r\n\r\n40mm\r\n\r\nBattery\r\nBattery Life\r\n\r\nBattery Average Life 80 Hour\r\n\r\nCharging Time\r\n\r\nBattery Charge Time 3 Hours', '1767457009.jpg', 'admin'),
(17, 'Ray-Ban Meta Wayfarer Smart Glasses', 'gadget', 52990.00, 'Camera: 3024×4032px photos, 1440×1920px @30fps videos\r\n\r\nConnectivity: Wi-Fi 6 certified, works with iOS 14.4+ & Android 10+\r\n\r\nMemory: 32GB storage for 500+ photos or 100+ 30s videos\r\n\r\nAudio: 2 custom open-ear speakers, 5-mic array for clear calls and voice commands\r\n\r\nBattery: Up to 4 hrs per charge, extended with charging case', '1767457114.png', 'admin'),
(18, 'DK W1 Pro Folding 4K Toy Drone', 'gadget', 7490.00, 'Foldable and Durable Design\r\nPlay Time: 13-15 minutes\r\n2.4G Remote Control\r\nDistance: 80-100 Meters', '1767457239.jpg', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `repair_requests`
--

CREATE TABLE `repair_requests` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `device_name` varchar(100) NOT NULL,
  `issue_description` text NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `technician_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_requests`
--

INSERT INTO `repair_requests` (`id`, `customer_id`, `device_name`, `issue_description`, `status`, `request_date`, `technician_id`) VALUES
(5, 6, 'samsungA34', 'display', 'Completed', '2026-01-04 09:45:41', 2);

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `shop_details` varchar(150) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `email`, `username`, `password`, `specialization`, `experience`, `dob`, `gender`, `shop_details`, `status`) VALUES
(2, 'sattarsazid1@gmail.com', 'sazid', 'abc', 'abc', 8, '2026-01-19', 'Male', 'jamuna', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(6, 'M.A.SAZID', 'aab', 'sattarsazid1@gmail.com'),
(9, 'khan', 'khan12', 'khan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_feedback`
--
ALTER TABLE `order_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_feedback`
--
ALTER TABLE `order_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `repair_requests`
--
ALTER TABLE `repair_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
