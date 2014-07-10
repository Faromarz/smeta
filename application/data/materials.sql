-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 10 2014 г., 15:14
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
-- Структура таблицы `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `species_id` int(11) NOT NULL COMMENT 'material_species ID',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` float(12,2) NOT NULL,
  `count_text` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `country_id` int(11) NOT NULL COMMENT 'country ID',
  PRIMARY KEY (`id`),
  KEY `species_id` (`species_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Таблица материалов' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
