-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 19 2014 г., 23:43
-- Версия сервера: 5.5.38-MariaDB-wsrep
-- Версия PHP: 5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `remont`
--

-- --------------------------------------------------------

--
-- Структура таблицы `design`
--

CREATE TABLE IF NOT EXISTS `design` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='дизайн';

--
-- Дамп данных таблицы `design`
--

INSERT INTO `design` (`id`, `name`) VALUES
(1, 'Дерево'),
(2, 'Дизайнерский'),
(3, 'Плитка'),
(4, 'Камень'),
(5, 'Бетон'),
(6, 'Кожа'),
(7, 'Модульный'),
(8, 'Мрамор'),
(9, 'Однотонная'),
(10, 'Дерево, Модульный'),
(11, 'Плитка, Камень'),
(12, 'Кожа, Плитка'),
(13, 'Мрамор, Плитка'),
(14, 'дерево дворцовое'),
(15, 'дерево классическое'),
(16, 'абстракция'),
(17, 'плитка дворцовая'),
(18, 'плитка классическая'),
(19, 'модерн'),
(20, 'натуральные материалы');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `design`
--
ALTER TABLE `design`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `design`
--
ALTER TABLE `design`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
