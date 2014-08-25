-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 19 2014 г., 19:39
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mastersmeta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `smeta`
--

CREATE TABLE IF NOT EXISTS `smeta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `geo_id` int(11) NOT NULL,
  `size` double(10,2) NOT NULL,
  `height` double(10,2) NOT NULL,
  `price_materials` double(10,2) NOT NULL,
  `price_work_dem` double(10,2) NOT NULL,
  `price_work_mon` double(10,2) NOT NULL,
  `time_work_dem` double(10,2) NOT NULL,
  `time_work_mon` double(10,2) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `repair_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
