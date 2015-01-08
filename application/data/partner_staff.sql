-- phpMyAdmin SQL Dump
-- version 4.3.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 08 2015 г., 17:17
-- Версия сервера: 5.5.39-MariaDB-wsrep
-- Версия PHP: 5.5.20

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
-- Структура таблицы `partner_staff`
--

CREATE TABLE IF NOT EXISTS `partner_staff` (
`id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL COMMENT 'partners',
  `photo` varchar(64) DEFAULT NULL COMMENT 'Фото сотрудника',
  `first_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL COMMENT 'Краткая информация о сотруднике'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Сотрудники партнерев';

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `partner_staff`
--
ALTER TABLE `partner_staff`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `partner_staff`
--
ALTER TABLE `partner_staff`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
