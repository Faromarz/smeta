-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 01 2014 г., 22:58
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
-- Структура таблицы `smeta_windows`
--

CREATE TABLE IF NOT EXISTS `smeta_windows` (
`id` int(11) NOT NULL,
  `smeta_rooms_id` int(11) NOT NULL,
  `room_params_def` int(11) NOT NULL DEFAULT '4',
  `count_type` int(11) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `height` double(3,2) NOT NULL,
  `width` double(3,2) NOT NULL,
  `show` tinyint(1) NOT NULL,
  `count` int(11) NOT NULL,
  `smeta_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `smeta_windows`
--
ALTER TABLE `smeta_windows`
 ADD PRIMARY KEY (`id`), ADD KEY `smeta_doors_smeta_id_idx` (`smeta_id`), ADD KEY `room_params_def` (`room_params_def`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `smeta_windows`
--
ALTER TABLE `smeta_windows`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
