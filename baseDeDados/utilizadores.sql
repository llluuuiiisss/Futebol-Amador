-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Dez-2019 às 00:37
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `futebolamador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ccnumber` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `saldo` int(11) NOT NULL,
  `teams` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`username`, `password`, `ccnumber`, `contact`, `mail`, `fname`, `lname`, `admin`, `saldo`, `teams`) VALUES
('admin', 'admin', 99999999, 999888777, 'admin@admin.com', 'admin', 'admin', 1, 1000000, ''),
('diogo', 'a', 14625962, 913212559, 'diogoboinas@gmail.com', 'Diogo', 'Boinas', 0, 175, ''),
('a', 'a', 0, 0, 'a', 'a', 'a', 0, -85, ''),
('b', 'a', 0, 0, 'b', 'b', 'b', 0, -15, ''),
('freitas', 'a', 2147483647, 936768310, 'luisfreitas1999@hotmail.com', 'Luis', 'Freitas', 0, 190, ''),
('cr7', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 1, 9990, ''),
('quaresma', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, ''),
('quim', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, ''),
('maregolo', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, ''),
('eliseu', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 9990, ''),
('pepe', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, ''),
('ramos', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, ''),
('messi', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, ''),
('vandyke', 'a', 321321321, 43223423, 'mail@mail.com', 'cristiano', 'Norway', 0, 10000, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
