-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 20 2014 г., 19:34
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
-- Структура таблицы `types_rate`
--

CREATE TABLE IF NOT EXISTS `types_rate` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `alias` varchar(64) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Тарифы ремонта';

--
-- Дамп данных таблицы `types_rate`
--

INSERT INTO `types_rate` (`id`, `name`, `alias`) VALUES
(1, 'Эконом', 'econom'),
(2, 'Стандарт', 'standart'),
(3, 'Премиум', 'premium');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `types_rate`
--
ALTER TABLE `types_rate`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `types_rate`
--
ALTER TABLE `types_rate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
