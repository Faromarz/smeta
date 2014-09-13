-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 13 2014 г., 15:26
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
-- Структура таблицы `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `length` decimal(4,2) NOT NULL,
  `width` decimal(4,2) NOT NULL,
  `balcony` tinyint(1) DEFAULT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `type`, `name`, `length`, `width`, `balcony`, `show`) VALUES
(1, 1, 'Комната №1', 5.50, 3.50, 0, 1),
(2, 1, 'Комната №2', 5.50, 3.50, 0, 0),
(3, 1, 'Комната №3', 5.50, 3.50, 0, 0),
(4, 1, 'Комната №4', 5.50, 3.50, 0, 0),
(5, 1, 'Комната №5', 5.50, 3.50, 0, 0),
(6, 2, 'Кухня', 3.00, 3.00, 0, 1),
(7, 3, 'Коридор', 3.00, 2.00, NULL, 1),
(8, 4, 'Ванна', 1.80, 1.70, NULL, 1),
(9, 5, 'Туалет', 1.70, 0.80, NULL, 1);
