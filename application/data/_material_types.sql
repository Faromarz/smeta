-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 11 2014 г., 09:31
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Структура таблицы `material_types`
--

CREATE TABLE IF NOT EXISTS `material_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Типы материалов' AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `material_types`
--

INSERT INTO `material_types` (`id`, `name`) VALUES
(1, 'Ванна/Кабина'),
(2, 'Дверные ручки'),
(3, 'Дверь входная'),
(4, 'Дверь межкомнатная'),
(5, 'Для раковины'),
(6, 'Замки'),
(7, 'Затирка'),
(8, 'Защёлки'),
(9, 'Клей для линолеума'),
(10, 'Клей для обоев'),
(11, 'Клей для плитки'),
(12, 'Клей для пола'),
(13, 'Кондикционер'),
(14, 'Краска'),
(15, 'Лак для пола'),
(16, 'Накладки дверные'),
(17, 'Обои'),
(18, 'Окно'),
(19, 'Отопление'),
(20, 'Петли'),
(21, 'Плинтус'),
(22, 'Подложка'),
(23, 'Пол'),
(24, 'Полотенцесушитель'),
(25, 'Порог'),
(26, 'Потолок'),
(27, 'Рукав'),
(28, 'Смеситель'),
(29, 'Умывальник'),
(30, 'Унитаз'),
(31, 'Фартук'),
(32, 'Цилиндры');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
