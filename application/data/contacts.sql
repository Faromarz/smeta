-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 30 2014 г., 22:09
-- Версия сервера: 5.5.39-MariaDB-wsrep
-- Версия PHP: 5.5.18

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
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
`id` int(11) NOT NULL,
  `phone_remont` varchar(64) NOT NULL,
  `phone_partner` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address_legal` varchar(255) NOT NULL,
  `address_for_correspondence` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `ogrn` varchar(64) NOT NULL,
  `inn` varchar(64) NOT NULL,
  `cpp` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `phone_remont`, `phone_partner`, `email`, `name`, `address_legal`, `address_for_correspondence`, `address`, `ogrn`, `inn`, `cpp`) VALUES
(1, '7 (926) 597-74-99', '7 (903) 100-71-31', 'ab@mastersmeta.ru', 'ООО «Мастерсмета»', '119019, г. Москва, ул. Арбат, 1, пом. IV', '119049, г. Москва, Ленинский пр., 1/2, корп. 1', 'г. Москва, Смоленская площадь, 3 ( БЦ «СМОЛЕНСКИЙ ПАССАЖ», 7-й этаж)', '5137746000453', '7704848696', '770401001');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
