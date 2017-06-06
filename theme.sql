-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2017 at 03:21 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_cuisine`
--

--

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `libelle`) VALUES
(1, 'Recettes Sucrées'),
(2, 'Recettes Salées'),
(3, 'Recettes du monde'),
(7, 'Réunionaises'),
(8, 'Desserts rapides'),
(9, 'Biscuits et mignardises'),
(10, 'Tartes et gâteaux'),
(11, 'Cakes'),
(12, 'Apéros/Entrées'),
(13, 'Tartes et quiches'),
(14, 'Gratins et lasagnes'),
(15, 'Autres plats végétariens'),
(16, 'Irlandaises'),
(17, 'Asiatiques'),
(18, 'Indiennes'),
(19, 'Yaourts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
