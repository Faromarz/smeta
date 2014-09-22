-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 22 2014 г., 12:09
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
  `alias` varchar(64) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `length` decimal(4,2) NOT NULL,
  `width` decimal(4,2) NOT NULL,
  `balcony` tinyint(1) DEFAULT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0',
  `windows` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `type`, `alias`, `name`, `length`, `width`, `balcony`, `show`, `windows`) VALUES
(1, 1, NULL, 'Комната №1', 5.50, 3.50, 0, 1, 1),
(2, 1, NULL, 'Комната №2', 5.50, 3.50, 0, 0, 1),
(3, 1, NULL, 'Комната №3', 5.50, 3.50, 0, 0, 1),
(4, 1, NULL, 'Комната №4', 5.50, 3.50, 0, 0, 1),
(5, 1, NULL, 'Комната №5', 5.50, 3.50, 0, 0, 1),
(6, 2, NULL, 'Кухня', 3.00, 3.00, 0, 1, 1),
(7, 3, NULL, 'Коридор', 3.00, 2.00, NULL, 1, NULL),
(9, 4, 'bath', 'Ванна', 1.80, 1.70, NULL, 1, NULL),
(10, 5, 'toilet', 'Туалет', 1.70, 0.80, NULL, 1, NULL),
(8, 4, 'bath_and_toilet', 'Ванна и туалет', 1.80, 1.70, NULL, 0, NULL);
