-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 15 2014 г., 23:12
-- Версия сервера: 5.5.38-MariaDB-wsrep
-- Версия PHP: 5.5.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Структура таблицы `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
`id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `length` decimal(4,2) NOT NULL,
  `width` decimal(4,2) NOT NULL,
  `balcony` tinyint(1) DEFAULT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `type`, `name`, `length`, `width`, `balcony`, `show`) VALUES
(1, 1, 'Комната №1', '5.50', '3.50', 0, 1),
(2, 1, 'Комната №2', '5.50', '3.50', 0, 0),
(3, 1, 'Комната №3', '5.50', '3.50', 0, 0),
(4, 1, 'Комната №4', '5.50', '3.50', 0, 0),
(5, 1, 'Комната №5', '5.50', '3.50', 0, 0),
(6, 2, 'Кухня', '3.00', '3.00', 0, 1),
(7, 3, 'Коридор', '3.00', '2.00', NULL, 1),
(9, 4, 'Ванна', '1.80', '1.70', NULL, 1),
(10, 5, 'Туалет', '1.70', '0.80', NULL, 1),
(8, 4, 'Ванна и туалет', '1.80', '1.70', NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
