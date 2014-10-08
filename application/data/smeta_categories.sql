-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 08 2014 г., 22:08
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
-- Структура таблицы `smeta_categories`
--

CREATE TABLE IF NOT EXISTS `smeta_categories` (
`id` int(11) NOT NULL,
  `smeta_rooms_id` int(11) NOT NULL,
  `material_categories_id` int(11) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `children_id` int(11) DEFAULT NULL COMMENT 'material_categories.id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `smeta_categories`
--
ALTER TABLE `smeta_categories`
 ADD PRIMARY KEY (`id`), ADD KEY `smeta_rooms_id` (`smeta_rooms_id`,`material_categories_id`), ADD KEY `children_cat_id` (`children_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `smeta_categories`
--
ALTER TABLE `smeta_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
