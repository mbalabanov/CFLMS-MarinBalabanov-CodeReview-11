-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2020 at 11:54 AM
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
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countryId` int(11) NOT NULL,
  `CountryName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countryId`, `CountryName`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua and Barbuda'),
(7, 'Argentina'),
(8, 'Armenia'),
(9, 'Australia'),
(10, 'Austria'),
(11, 'Azerbaijan'),
(12, 'Bahamas'),
(13, 'Bahrain'),
(14, 'Bangladesh'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Bolivia'),
(22, 'Bosnia and Herzegovina'),
(23, 'Botswana'),
(24, 'Brazil'),
(25, 'Brunei'),
(26, 'Bulgaria'),
(27, 'Burkina Faso'),
(28, 'Burundi'),
(29, 'Albania'),
(30, 'Algeria'),
(31, 'Andorra'),
(32, 'Angola'),
(33, 'Antigua and Barbuda'),
(34, 'Argentina'),
(35, 'Armenia'),
(36, 'Australia'),
(37, 'Austria'),
(38, 'Azerbaijan'),
(39, 'Bahamas'),
(40, 'Bahrain'),
(41, 'Bangladesh'),
(42, 'Barbados'),
(43, 'Belarus'),
(44, 'Belgium'),
(45, 'Belize'),
(46, 'Benin'),
(47, 'Bhutan'),
(48, 'Bolivia'),
(49, 'Bosnia and Herzegovina'),
(50, 'Botswana'),
(51, 'Brazil'),
(52, 'Brunei'),
(53, 'Bulgaria'),
(54, 'Burkina Faso'),
(55, 'Burundi'),
(56, 'Côte d\'Ivoire'),
(57, 'Cabo Verde'),
(58, 'Cambodia'),
(59, 'Cameroon'),
(60, 'Canada'),
(61, 'Central African Republic'),
(62, 'Chad'),
(63, 'Chile'),
(64, 'China'),
(65, 'Colombia'),
(66, 'Comoros'),
(67, 'Congo (Congo-Brazzaville)'),
(68, 'Costa Rica'),
(69, 'Croatia'),
(70, 'Cuba'),
(71, 'Cyprus'),
(72, 'Czechia (Czech Republic)'),
(73, 'Democratic Republic of the Congo'),
(74, 'Denmark'),
(75, 'Djibouti'),
(76, 'Dominica'),
(77, 'Dominican Republic'),
(78, 'Ecuador'),
(79, 'Egypt'),
(80, 'El Salvador'),
(81, 'Equatorial Guinea'),
(82, 'Eritrea'),
(83, 'Estonia'),
(84, 'Eswatini (fmr. \"Swaziland\")'),
(85, 'Ethiopia'),
(86, 'Fiji'),
(87, 'Finland'),
(88, 'France'),
(89, 'Gabon'),
(90, 'Gambia'),
(91, 'Georgia'),
(92, 'Germany'),
(93, 'Ghana'),
(94, 'Greece'),
(95, 'Grenada'),
(96, 'Guatemala'),
(97, 'Guinea'),
(98, 'Guinea-Bissau'),
(99, 'Guyana'),
(100, 'Haiti'),
(101, 'Holy See'),
(102, 'Honduras'),
(103, 'Hungary'),
(104, 'Iceland'),
(105, 'India'),
(106, 'Indonesia'),
(107, 'Iran'),
(108, 'Iraq'),
(109, 'Ireland'),
(110, 'Israel'),
(111, 'Italy'),
(112, 'Jamaica'),
(113, 'Japan'),
(114, 'Jordan'),
(115, 'Kazakhstan'),
(116, 'Kenya'),
(117, 'Kiribati'),
(118, 'Kuwait'),
(119, 'Kyrgyzstan'),
(120, 'Laos'),
(121, 'Latvia'),
(122, 'Lebanon'),
(123, 'Lesotho'),
(124, 'Liberia'),
(125, 'Libya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Madagascar'),
(130, 'Malawi'),
(131, 'Malaysia'),
(132, 'Maldives'),
(133, 'Mali'),
(134, 'Malta'),
(135, 'Marshall Islands'),
(136, 'Mauritania'),
(137, 'Mauritius'),
(138, 'Mexico'),
(139, 'Micronesia'),
(140, 'Moldova'),
(141, 'Monaco'),
(142, 'Mongolia'),
(143, 'Montenegro'),
(144, 'Morocco'),
(145, 'Mozambique'),
(146, 'Myanmar (formerly Burma)'),
(147, 'Namibia'),
(148, 'Nauru'),
(149, 'Nepal'),
(150, 'Netherlands'),
(151, 'New Zealand'),
(152, 'Nicaragua'),
(153, 'Niger'),
(154, 'Nigeria'),
(155, 'North Korea'),
(156, 'North Macedonia'),
(157, 'Norway'),
(158, 'Oman'),
(159, 'Pakistan'),
(160, 'Palau'),
(161, 'Palestine State'),
(162, 'Panama'),
(163, 'Papua New Guinea'),
(164, 'Paraguay'),
(165, 'Peru'),
(166, 'Philippines'),
(167, 'Poland'),
(168, 'Portugal'),
(169, 'Qatar'),
(170, 'Romania'),
(171, 'Russia'),
(172, 'Rwanda'),
(173, 'Saint Kitts and Nevis'),
(174, 'Saint Lucia'),
(175, 'Saint Vincent and the Grenadines'),
(176, 'Samoa'),
(177, 'San Marino'),
(178, 'Sao Tome and Principe'),
(179, 'Saudi Arabia'),
(180, 'Senegal'),
(181, 'Serbia'),
(182, 'Seychelles'),
(183, 'Sierra Leone'),
(184, 'Singapore'),
(185, 'Slovakia'),
(186, 'Slovenia'),
(187, 'Solomon Islands'),
(188, 'Somalia'),
(189, 'South Africa'),
(190, 'South Korea'),
(191, 'South Sudan'),
(192, 'Spain'),
(193, 'Sri Lanka'),
(194, 'Sudan'),
(195, 'Suriname'),
(196, 'Sweden'),
(197, 'Switzerland'),
(198, 'Syria'),
(199, 'Tajikistan'),
(200, 'Tanzania'),
(201, 'Thailand'),
(202, 'Timor-Leste'),
(203, 'Togo'),
(204, 'Tonga'),
(205, 'Trinidad and Tobago'),
(206, 'Tunisia'),
(207, 'Turkey'),
(208, 'Turkmenistan'),
(209, 'Tuvalu'),
(210, 'Uganda'),
(211, 'Ukraine'),
(212, 'United Arab Emirates'),
(213, 'United Kingdom'),
(214, 'United States of America'),
(215, 'Uruguay'),
(216, 'Uzbekistan'),
(217, 'Vanuatu'),
(218, 'Venezuela'),
(219, 'Vietnam'),
(220, 'Yemen'),
(221, 'Zambia'),
(222, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationId` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `town` varchar(100) NOT NULL,
  `postalCode` varchar(100) NOT NULL,
  `country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationId`, `street`, `town`, `postalCode`, `country`) VALUES
(1, '8 Morris St.', 'Fresno', 'CA 93706', 214),
(2, '9 Lake View Road', 'Janesville', 'WI 53546', 214),
(3, '26 Miller St.', 'Springfield', 'PA 19064', 214),
(4, '78 Princeton St.', 'South Ozone Park', 'NY 11420', 214),
(5, '40 Coffee St.', 'Kingsport', 'TN 37660', 214),
(6, '898 Cottage Ave.', 'Oak Forest', 'IL 60452', 214),
(7, '8621 N. Lawrence St.', 'Herndon', 'VA 20170', 214),
(8, '9261 Ramblewood Street', 'Elizabeth', 'NJ 07202', 205),
(9, '29 High Point Ave.', 'Gulfport', 'MS 39503', 214),
(10, '58 Border St.', 'Jupiter', 'FL 33458', 214),
(11, '91 River Street', 'Bridgeton', 'NJ 08302', 214),
(12, '13 Glenwood Road', 'Henderson', 'KY 42420', 214),
(13, '9997 Green Hill Ave.', 'Ozone Park', 'NY 11417', 214),
(14, '396 Blue Spring Drive', 'Lacey', 'WA 98503', 214),
(15, '288 Bear Hill St.', 'Lanham', 'MD 20706', 214),
(16, '29 Lookout Dr.', 'Sykesville', 'MD 21784', 214),
(17, '56 Indian Spring Avenue', 'Elmhurst', 'NY 11373', 214),
(18, '69 Oakwood Court', 'Ellicott City', 'MD 21042', 214),
(19, '9 West Tunnel Street', 'New Castle', 'PA 16101', 214),
(20, '779 Lexington Road', 'Waterford', 'MI 48329', 214),
(21, '424 E. State Av.', 'Houston', 'GA 30132', 213),
(22, '8905 Purple Finch Ave.', 'Ozone Park', 'NY 11417', 214),
(23, '8994 Woodside Dr.', 'Blackwood', 'NJ 08012', 214),
(24, '4 East Lexington St.', 'Corpus Christi', 'TX 78418', 214),
(32, 'Bleeker Str.', 'Edinburgh', 'ED 123', 179),
(34, 'Test Str. 24', 'Sofia', '1113', 26),
(35, '8 Morris Street', 'Fresno', 'CA 93706', 214);

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
(1, 'Gonzo', 'assets/dogs/dog1.jpg', 'Dog', 'Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus.', 'Catching Balls, Hunting, Scavenging, Collecting bones, Chasing postman', 10, 1),
(2, 'Apollonia', 'assets/dogs/dog2.jpg', 'Dog', 'Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla ma.', 'Running in Circles, Park Visits, Eating A Lot, Running through Mazes, Bursting Balloons, Chasing Own Tail', 3, 2),
(3, 'Maizey', 'assets/dogs/dog3.jpg', 'Dog', 'Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor.', 'Hunting, Scavenging, Running in Circles, Eating A Lot, Bursting Balloons, Chasing Own Tail', 9, 3),
(4, 'Redwing', 'assets/dogs/dog4.jpg', 'Dog', 'Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit.', 'Ball Games, Eating Shoes, Digging Holes, Catching Balls, Hunting, Scavenging', 5, 4),
(5, 'Pokie', 'assets/dogs/dog5.jpg', 'Dog', 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede.', 'Eating Shoes, Digging Holes, Catching Balls, Running through Mazes, Bursting Balloons, Chasing Own Tail', 11, 5),
(6, 'Suyu', 'assets/dogs/dog6.jpg', 'Dog', 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mo.', 'Scavenging, Collecting bones, Eating A Lot', 8, 6),
(7, 'Meathead', 'assets/dogs/dog7.jpg', 'Dog', 'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligu.', 'Catching Balls, Hunting, Scavenging, Running in Circles, Chasing Own Tail', 4, 7),
(8, 'Piccolino', 'assets/dogs/dog8.jpg', 'Dog', 'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligu.', 'Digging Holes, Catching Balls, Hunting, Scavenging', 10, 8),
(9, 'Hickory', 'assets/dogs/dog9.jpg', 'Dog', 'Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligu.', 'Scavenging, Running in Circles, Bursting Balloons', 6, 9),
(10, 'Kaiya', 'assets/dogs/dog10.jpg', 'Dog', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Eating A Lot, Catching Balls, Hunting, Scavenging, Chasing Own Tail', 9, 10),
(11, 'Zanne', 'assets/dogs/dog11.jpg', 'Dog', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Long Walks, Ball Games, Eating Shoes, Digging Holes, Catching Balls, Eating A Lot', 16, 11),
(12, 'Perla', 'assets/dogs/dog12.jpg', 'Dog', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones, Howling', 18, 12),
(13, 'Keanu', 'assets/cats/cat1.jpg', 'Cat', 'Consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoq.', 'Eating Shoes, Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones', 10, 13),
(14, 'Hefner', 'assets/cats/cat2.jpg', 'Cat', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qu.', 'Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 11, 14),
(15, 'Beaner', 'assets/cats/cat3.jpg', 'Cat', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec.', 'Long Walks, Ball Games, Eating Shoes, Digging Holes, Running through Mazes, Eating A Lot', 4, 15),
(16, 'Smilla', 'assets/cats/cat4.jpg', 'Cat', 'Venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras da.', 'Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 4, 16),
(17, 'Angel', 'assets/cats/cat5.jpg', 'Cat', 'Venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras da.', 'Long Walks, Ball Games, Eating Shoes, Digging Holes, Eating A Lot', 9, 17),
(18, 'Mr. Giggles', 'assets/cats/cat6.jpg', 'Cat', 'Venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras.', 'Eating Shoes, Digging Holes, Catching Balls, Hunting, Park Visits, Eating A Lot', 2, 18),
(19, 'Haddie', 'assets/cats/cat7.jpg', 'Cat', 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa qui.', 'Collecting bones, Howling, Running in Circles, Park Visits, Eating A Lot', 16, 19),
(20, 'Izzybelle', 'assets/cats/cat8.jpg', 'Cat', 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa qui.', 'Digging Holes, Catching Balls, Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 10, 20),
(21, 'Splashy', 'assets/cats/cat9.jpg', 'Cat', 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa qui.', 'Long Walks, Ball Games, Eating Shoes, Hunting, Scavenging, Collecting bones, Howling, Eating A Lot', 7, 21),
(22, 'Leni', 'assets/cats/cat10.jpg', 'Cat', 'Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget.', 'Digging Holes, Catching Balls,Howling, Running in Circles, Park Visits, Eating A Lot', 7, 22),
(23, 'Nanetto', 'assets/cats/cat11.jpg', 'Cat', 'Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget.', 'Ball Games, Eating Shoes, Digging Holes, Hunting, Scavenging, Howling, Eating A Lot', 15, 23),
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
(2, 'Admin User', 'admin@admin.com', '38a320b2a67c8003cc748d6666534f2b01f3f08d175440537a5bf86b7d08d5ee', 'assets/user2.png', 'admin'),
(6, 'Super Admin', 'superadmin@admin.com', '38a320b2a67c8003cc748d6666534f2b01f3f08d175440537a5bf86b7d08d5ee', 'assets/user3.png', 'superadmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryId`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationId`),
  ADD KEY `country` (`country`);

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
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `petId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `countries` (`countryId`);

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `location` FOREIGN KEY (`location`) REFERENCES `locations` (`locationId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
