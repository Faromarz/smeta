-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 05 2014 г., 23:05
-- Версия сервера: 5.1.73
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mastersmeta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `room_params_def`
--

CREATE TABLE IF NOT EXISTS `room_params_def` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `width` double(10,2) DEFAULT NULL,
  `width_min` double(10,2) NOT NULL,
  `width_max` double(10,2) NOT NULL,
  `height` double(10,2) NOT NULL,
  `height_min` double(10,2) NOT NULL,
  `height_max` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `room_params_def`
--

INSERT INTO `room_params_def` (`id`, `name`, `width`, `width_min`, `width_max`, `height`, `height_min`, `height_max`) VALUES
(1, 'Высота потолка', 0.00, 0.00, 0.00, 2.75, 1.50, 4.00),
(2, 'Дверь входная', 0.90, 0.60, 2.00, 2.00, 1.50, 3.00),
(3, 'Дверь межномнатная', 0.80, 0.60, 2.00, 2.00, 1.50, 3.00),
(4, 'Окна', 1.30, 0.40, 2.70, 1.40, 0.90, 2.30);
