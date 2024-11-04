-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 08:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_railway`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_amount` varchar(10) NOT NULL,
  `booking_date` varchar(30) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coach_no` varchar(30) NOT NULL,
  `booking_fordate` varchar(30) NOT NULL,
  `pnr_no` varchar(30) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_status`, `booking_amount`, `booking_date`, `discount_amount`, `user_id`, `coach_no`, `booking_fordate`, `pnr_no`, `station_id`) VALUES
(1, 1, '450.00', '2024-10-03', 0, 8, '2334', '2024-10-11', '123', 5),
(2, 1, '551.00', '2024-10-07', 0, 8, '2234', '2024-10-09', '3455', 0),
(3, 0, '', '2024-10-09', 0, 8, '', '', '', 0),
(4, 1, '210.00', '2024-10-09', 0, 10, '56', '2024-10-12', '456', 7),
(5, 1, '180.00', '2024-10-09', 0, 12, '3', '2024-10-20', '34', 11),
(6, 1, '110.00', '2024-10-09', 0, 12, '5', '2024-10-11', '556', 9),
(7, 1, '350.00', '2024-10-10', 0, 13, '45678', '2024-10-25', '456', 12),
(8, 1, '110.00', '2024-10-10', 0, 10, '2', '2024-10-19', '456', 9),
(9, 0, '', '2024-11-02', 0, 14, '', '', '', 0),
(10, 1, '540.00', '2024-11-02', 108, 16, '23456', '2024-11-07', '234567', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1,
  `food_id` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_qty`, `food_id`, `cart_status`, `booking_id`) VALUES
(16, 3, 21, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(7, 'snacks'),
(8, 'drinks'),
(10, 'desserts'),
(12, 'noodles'),
(13, 'chicken');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_content` varchar(255) NOT NULL,
  `complaint_date` varchar(30) NOT NULL,
  `complaint_reply` varchar(255) NOT NULL,
  `complaint_status` varchar(50) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_content`, `complaint_date`, `complaint_reply`, `complaint_status`, `rest_id`, `user_id`, `complaint_title`) VALUES
(1, 'Haii', '0000-00-00', 'Good morning', '', 8, 8, 'Good'),
(2, 'kjas', '0000-00-00', '', '', 8, 8, 'hai'),
(3, 'Bad', '0000-00-00', '', '', 8, 8, 'Good'),
(4, 'fghjk', '', '', '', 8, 8, 'bad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(16, 'Ernakulam'),
(22, 'thrissur'),
(27, 'alappuzha'),
(29, 'thiruvananthapuram'),
(30, 'kollam'),
(31, 'kozhikode'),
(33, 'malappuram'),
(34, 'kasaragod'),
(35, 'palakkad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(255) NOT NULL,
  `feedback_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(30) NOT NULL,
  `food_price` int(11) NOT NULL,
  `food_photo` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `food_desc` varchar(100) NOT NULL,
  `food_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`food_id`, `food_name`, `food_price`, `food_photo`, `category_id`, `rest_id`, `food_desc`, `food_type`) VALUES
(20, 'chicken cutlet', 40, '', 0, 20, 'yghb', 'NON'),
(21, 'veg friedrice', 180, '', 12, 20, 'iuytrdfgh', 'VEG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(30) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'aluva', 0),
(2, 'ekm south', 0),
(3, 'varkala', 0),
(5, 'ambalappuzha', 5),
(7, 'pala', 6),
(10, 'Kothamangalam', 25),
(14, 'ambalappuzha', 27),
(15, 'nadathara', 22),
(17, 'vadakara', 31),
(18, 'kottakkal', 33),
(19, 'kalanad', 34),
(20, 'alappuzha stn', 27),
(21, 'nelliyampathi', 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_content` varchar(100) NOT NULL,
  `rating_count` int(11) NOT NULL,
  `rating_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_content`, `rating_count`, `rating_date`, `user_id`, `food_id`) VALUES
(1, 'hai', 4, '2024-10-03', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rest`
--

CREATE TABLE `tbl_rest` (
  `rest_id` int(11) NOT NULL,
  `rest_name` varchar(30) NOT NULL,
  `rest_email` varchar(30) NOT NULL,
  `rest_contact` varchar(30) NOT NULL,
  `rest_address` varchar(255) NOT NULL,
  `rest_photo` varchar(50) NOT NULL,
  `rest_proof` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `rest_status` int(11) NOT NULL DEFAULT 0,
  `rest_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rest`
--

INSERT INTO `tbl_rest` (`rest_id`, `rest_name`, `rest_email`, `rest_contact`, `rest_address`, `rest_photo`, `rest_proof`, `place_id`, `rest_status`, `rest_password`) VALUES
(13, 'alph', 'alph125@gmail.com', '9400203333', 'scvbnmkliuy', 'DSC_0036.JPG', 'DSC_0036.JPG', 15, 2, 'Alph1234'),
(14, 'rasha', 'rasha125@gmail.com', '9400203888', 'hgfdrtyui', 'DSC_0036.JPG', 'DSC_0036.JPG', 18, 1, 'Rasha1234'),
(15, 'jisna', 'jisna125@gmail.com', '9400203777', 'rtyuikjhgfdxcvb', 'DSC_0036.JPG', 'DSC_0036.JPG', 17, 1, 'Jisna1234'),
(16, 'Ananya', 'ananya125@gmail.com', '9400303777', 'tyuikjhgfc', 'DSC_0036.JPG', 'DSC_0036.JPG', 19, 2, 'Ananya123'),
(17, 'thaj', 'thaj125@gmail.com', '9988775566', 'drtyujnbvcvbnm', 'DSC_0036.JPG', 'DSC_0036.JPG', 14, 1, 'Thaj@1234'),
(18, 'aadhil', 'aadhil125@gmail.com', '8765409812', 'oiuytrdfvgbhnjmk', 'DSC_0036.JPG', 'DSC_0036.JPG', 18, 1, 'Aadhil@1234'),
(19, 'Jain', 'jain125@gmail.com', '9876523456', 'o87ytgfvbhjmn ', 'DSC_0036.JPG', 'DSC_0036.JPG', 14, 0, 'Jain@1234'),
(20, 'Anu', 'anu125@gmail.com', '9422203803', 'iuytgfgvbn', 'DSC_0036.JPG', 'DSC_0036.JPG', 15, 1, 'Anu@1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_station`
--

CREATE TABLE `tbl_station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(30) NOT NULL,
  `station_address` varchar(255) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_station`
--

INSERT INTO `tbl_station` (`station_id`, `station_name`, `station_address`, `place_id`) VALUES
(2, 'athira', 'jhgds', 1),
(3, 'Aluva', 'ryury', 3),
(5, 'Alngamaly', 'jhgds', 9),
(7, 'ambalappuzha sth', 'sdfghj', 14),
(8, 'nadathara nrth', ' sdhjhgfd', 15),
(9, 'kottakkal nrth', ' yuikjhg', 18),
(11, 'vadakara nrth', ' kjhgfdghn', 17),
(12, 'kalanad stn', ' ghjkmnb', 19),
(13, 'amz south', ' iuytfcghjm', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_contact` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_contact`, `user_email`, `user_password`) VALUES
(15, 'Alwin', '9873455678', 'alwin125@gmail.com', 'Alwin@1234'),
(16, 'Arathi', '9499203803', 'arathi125@gmail.com', 'Arathi@1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_rest`
--
ALTER TABLE `tbl_rest`
  ADD PRIMARY KEY (`rest_id`);

--
-- Indexes for table `tbl_station`
--
ALTER TABLE `tbl_station`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_rest`
--
ALTER TABLE `tbl_rest`
  MODIFY `rest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_station`
--
ALTER TABLE `tbl_station`
  MODIFY `station_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
