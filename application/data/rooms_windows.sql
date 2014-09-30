-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 29 2014 г., 21:34
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
-- Структура таблицы `rooms_windows`
--

CREATE TABLE IF NOT EXISTS `rooms_windows` (
`id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL COMMENT 'rooms',
  `window_id` int(11) NOT NULL COMMENT 'room_params_def'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `rooms_windows`
--

INSERT INTO `rooms_windows` (`id`, `room_id`, `window_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(3, 3, 4),
(4, 4, 4),
(5, 5, 4),
(6, 6, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `rooms_windows`
--
ALTER TABLE `rooms_windows`
 ADD PRIMARY KEY (`id`), ADD KEY `room_id` (`room_id`,`window_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `rooms_windows`
--
ALTER TABLE `rooms_windows`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
