-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 05:17 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr10_markus_szokoll_biglibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `surname`) VALUES
(1, 'Johannes', 'Aal'),
(2, 'Hans', 'Aanrud'),
(3, 'Emil', 'Aarestrup'),
(4, 'Soazig', 'Aaron'),
(5, 'Ivar', 'Aasen'),
(6, 'Petrus', 'Abaelardus'),
(7, 'Lynn', 'Abbey'),
(8, 'Jacob', 'Abbott'),
(9, 'John Stevens', 'Cabot Abbott'),
(10, 'Rebecca', 'Abe'),
(11, 'Hans Karl', 'Abel'),
(12, 'Curt', 'Abel-Musgrave');

-- --------------------------------------------------------

--
-- Table structure for table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `fk_media_type` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `img_link` varchar(100) NOT NULL,
  `fk_author_id` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `short_description` varchar(50) NOT NULL,
  `publish_date` date NOT NULL,
  `fk_publisher_id` int(11) NOT NULL,
  `status` enum('available','reserved') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medias`
--

INSERT INTO `medias` (`id`, `fk_media_type`, `title`, `img_link`, `fk_author_id`, `isbn`, `short_description`, `publish_date`, `fk_publisher_id`, `status`) VALUES
(1, 1, 'Die letzte Königin', '1.jpg', 1, '3452352345456', 'This is the short description.', '2000-11-08', 1, 'available'),
(2, 1, 'Witchmark', '2.jpg', 1, '7654456776987', 'Außergewöhnliche Geschichte, bla bla bla', '1999-11-08', 1, 'available'),
(3, 2, 'Die Krone', '3.jpg', 1, '5428987612345', 'Sie leuchtet nicht.', '1399-11-08', 10, 'reserved'),
(4, 2, 'The House', '4.jpg', 11, '9876123476234', 'Your house is mine!', '2001-11-08', 3, 'reserved'),
(5, 3, 'The Car', '5.jpg', 8, '5454545454545', 'Your car is mine!', '2002-11-08', 2, 'available'),
(6, 1, 'The woman', '6.jpg', 5, '6474849484746', 'The woman is your mother.', '1699-11-08', 5, 'available'),
(7, 1, 'The Window', '7.jpg', 10, '8473646576879', 'Just jump out!', '2002-11-08', 6, 'reserved'),
(8, 2, 'The test', '8.jpg', 2, '8575647586978', 'You failed again!', '1899-11-08', 3, 'available'),
(9, 1, 'The Child', '9.jpg', 2, '7485960798766', 'This Child is your son.', '1998-11-08', 4, 'available'),
(10, 1, 'The Loser', '10.jpg', 11, '0000000000000', 'It\'s your diary!', '2019-03-16', 11, 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `media_type`
--

CREATE TABLE `media_type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media_type`
--

INSERT INTO `media_type` (`id`, `name`) VALUES
(1, 'book'),
(2, 'CD'),
(3, 'DVD');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `size` enum('big','medium','small') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `address`, `size`) VALUES
(1, 'AOK', 'Hamburgergasse 1, Hamburg', 'big'),
(2, 'Arche Verlag', 'Zürich', 'medium'),
(3, 'ArsEdition', 'München', 'medium'),
(4, 'AS Verlag', 'Zürich', 'big'),
(5, 'Aula-Verlag', 'Wiebelsheim', 'big'),
(6, 'Axel Dielmann-Verlag', 'Frankfurt am Main', 'medium'),
(7, 'Baltischer Musikverlag', 'Stettin', 'small'),
(8, 'Berlin Verlag', 'Berlin', 'small'),
(9, 'R. Brockhaus Verlag', 'Witten', 'big'),
(10, 'Brunnen Verlag', 'Gießen', 'small'),
(11, 'Bund-Verlag', 'Frankfurt am Main', 'big');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `userFirstName` varchar(50) DEFAULT NULL,
  `userLastName` varchar(50) DEFAULT NULL,
  `userEmail` varchar(50) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `userFirstName`, `userLastName`, `userEmail`, `userPassword`) VALUES
(1, 'Markus', 'Szokoll', 'markus.szokoll@gmx.at', '12345'),
(2, 'a', 'b', 'c', '18ac3e7343f016890c510e93f935261169d9e3f565436429830faf0934f4f8e4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author_id` (`fk_author_id`),
  ADD KEY `fk_publisher_id` (`fk_publisher_id`);

--
-- Indexes for table `media_type`
--
ALTER TABLE `media_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `media_type`
--
ALTER TABLE `media_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medias`
--
ALTER TABLE `medias`
  ADD CONSTRAINT `medias_ibfk_1` FOREIGN KEY (`fk_author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `medias_ibfk_2` FOREIGN KEY (`fk_publisher_id`) REFERENCES `publisher` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
