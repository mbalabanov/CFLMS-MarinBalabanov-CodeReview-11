-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 11:39 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cflms-marinbalabanov-codereview-11`
--
CREATE DATABASE IF NOT EXISTS `cflms-marinbalabanov-codereview-11` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cflms-marinbalabanov-codereview-11`;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationId` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `postalCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationId`, `street`, `town`, `postalCode`) VALUES
(1, '8 Morris St.', 'Fresno', 'CA 93706'),
(2, '9 Lake View Rd.', 'Janesville', 'WI 53546'),
(3, '26 Miller St.', 'Springfield', 'PA 19064'),
(4, '78 Princeton St.', 'South Ozone Park', 'NY 11420'),
(5, '40 Coffee St.', 'Kingsport', 'TN 37660'),
(6, '898 Cottage Ave.', 'Oak Forest', 'IL 60452'),
(7, '8621 N. Lawrence St.', 'Herndon', 'VA 20170'),
(8, '9261 Ramblewood Street', 'Elizabeth', 'NJ 07202'),
(9, '29 High Point Ave.', 'Gulfport', 'MS 39503'),
(10, '58 Border St.', 'Jupiter', 'FL 33458'),
(11, '91 River Street', 'Bridgeton', 'NJ 08302'),
(12, '13 Glenwood Road', 'Henderson', 'KY 42420'),
(13, '9997 Green Hill Ave.', 'Ozone Park', 'NY 11417'),
(14, '396 Blue Spring Drive', 'Lacey', 'WA 98503'),
(15, '288 Bear Hill St.', 'Lanham', 'MD 20706'),
(16, '29 Lookout Dr.', 'Sykesville', 'MD 21784'),
(17, '56 Indian Spring Avenue', 'Elmhurst', 'NY 11373'),
(18, '69 Oakwood Court', 'Ellicott City', 'MD 21042'),
(19, '9 West Tunnel Street', 'New Castle', 'PA 16101'),
(20, '779 Lexington Road', 'Waterford', 'MI 48329'),
(21, '424 E. State Avenue', 'Dallas', 'GA 30132'),
(22, '8905 Purple Finch Ave.', 'Ozone Park', 'NY 11417'),
(23, '8994 Woodside Dr.', 'Blackwood', 'NJ 08012'),
(24, '4 East Lexington St.', 'Corpus Christi', 'TX 78418');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `petId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `descriptions` varchar(200) DEFAULT NULL,
  `hobbies` varchar(200) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`petId`, `name`, `image`, `type`, `descriptions`, `hobbies`, `age`, `location`) VALUES
(1, 'Gonzo', 'assets/dogs/dog1.jpg', 'Dog', 'Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus.', 'Catching Balls, Hunting, Scavenging, Collecting bones', 10, 1),
(2, 'Apollonia', 'assets/dogs/dog2.jpg', 'Dog', 'Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla ma.', 'Running in Circles, Park Visits, Eating A Lot, Running through Mazes, Bursting Balloons, Hunting Own Tail', 13, 2),
(3, 'Maizey', 'assets/dogs/dog3.jpg', 'Dog', 'Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor.', 'Hunting, Scavenging, Running in Circles, Eating A Lot, Bursting Balloons, Hunting Own Tail', 9, 3),
(4, 'Redwing', 'assets/dogs/dog4.jpg', 'Dog', 'Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit.', 'Ball Games, Eating Shoes, Digging Holes, Catching Balls, Hunting, Scavenging', 15, 4),
(5, 'Pokie', 'assets/dogs/dog5.jpg', 'Dog', 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede.', 'Eating Shoes, Digging Holes, Catching Balls, Running through Mazes, Bursting Balloons, Hunting Own Tail', 11, 5),
(6, 'Suyu', 'assets/dogs/dog6.jpg', 'Dog', 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mo.', 'Scavenging, Collecting bones, Eating A Lot', 17, 6),
(7, 'Meathead', 'assets/dogs/dog7.jpg', 'Dog', 'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligu.', 'Catching Balls, Hunting, Scavenging, Running in Circles, Hunting Own Tail', 4, 7),
(8, 'Piccolino', 'assets/dogs/dog8.jpg', 'Dog', 'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligu.', 'Digging Holes, Catching Balls, Hunting, Scavenging', 10, 8),
(9, 'Hickory', 'assets/dogs/dog9.jpg', 'Dog', 'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligu.', 'Scavenging, Running in Circles, Bursting Balloons', 6, 9),
(10, 'Kaiya', 'assets/dogs/dog10.jpg', 'Dog', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Eating A Lot, Catching Balls, Hunting, Scavenging, Hunting Own Tail', 9, 10),
(11, 'Zanne', 'assets/dogs/dog11.jpg', 'Dog', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Long Walks, Ball Games, Eating Shoes, Digging Holes, Catching Balls, Eating A Lot', 16, 11),
(12, 'Perla', 'assets/dogs/dog12.jpg', 'Dog', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones, Howling', 18, 12),
(13, 'Keanu', 'assets/cats/cat1.jpg', 'Cat', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Eating Shoes, Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones', 10, 13),
(14, 'Hefner', 'assets/cats/cat2.jpg', 'Cat', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu.', 'Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 11, 14),
(15, 'Beaner', 'assets/cats/cat3.jpg', 'Cat', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec.', 'Long Walks, Ball Games, Eating Shoes, Digging Holes, Running through Mazes, Eating A Lot', 20, 15),
(16, 'Smilla', 'assets/cats/cat4.jpg', 'Cat', 'Venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras da.', 'Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 4, 16),
(17, 'Angel', 'assets/cats/cat5.jpg', 'Cat', 'Venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras da.', 'Long Walks, Ball Games, Eating Shoes, Digging Holes, Eating A Lot', 19, 17),
(18, 'Mr. Giggles', 'assets/cats/cat6.jpg', 'Cat', 'Venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras.', 'Eating Shoes, Digging Holes, Catching Balls, Hunting, Park Visits, Eating A Lot', 2, 18),
(19, 'Haddie', 'assets/cats/cat7.jpg', 'Cat', 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa qui.', 'Collecting bones, Howling, Running in Circles, Park Visits, Eating A Lot', 16, 19),
(20, 'Izzybelle', 'assets/cats/cat8.jpg', 'Cat', 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa qui.', 'Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 10, 20),
(21, 'Splashy', 'assets/cats/cat9.jpg', 'Cat', 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa qui.', 'Long Walks, Ball Games, Eating Shoes, Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 7, 21),
(22, 'Leni', 'assets/cats/cat10.jpg', 'Cat', 'Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget.', 'Digging Holes, Catching Balls,Howling, Running in Circles, Park Visits, Eating A Lot', 19, 22),
(23, 'Nanetto', 'assets/cats/cat11.jpg', 'Cat', 'Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget.', 'Ball Games, Eating Shoes, Digging Holes, Hunting, Scavenging, Howling, Park Visits, Eating A Lot', 15, 23),
(24, 'Joni', 'assets/cats/cat12.jpg', 'Cat', 'Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget.', 'Hunting, Scavenging, Howling, Eating A Lot', 11, 24);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userImage` varchar(100) DEFAULT NULL,
  `userType` enum('user','admin','superadmin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `userImage`, `userType`) VALUES
(1, 'Test User', 'test1@test.com', '38a320b2a67c8003cc748d6666534f2b01f3f08d175440537a5bf86b7d08d5ee', 'assets/user1.png', 'user'),
(2, 'Admin User', 'admin@admin.com', '38a320b2a67c8003cc748d6666534f2b01f3f08d175440537a5bf86b7d08d5ee', 'assets/user2.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`petId`),
  ADD KEY `location` (`location`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `petId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `location` FOREIGN KEY (`location`) REFERENCES `locations` (`locationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
