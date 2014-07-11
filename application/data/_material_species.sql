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
-- Структура таблицы `material_species`
--

CREATE TABLE IF NOT EXISTS `material_species` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL COMMENT 'material_types ID',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Виды материалов' AUTO_INCREMENT=46 ;

--
-- Дамп данных таблицы `material_species`
--

INSERT INTO `material_species` (`id`, `type_id`, `name`) VALUES
(1, 1, ''),
(2, 2, ''),
(3, 3, ''),
(4, 4, ''),
(5, 5, ''),
(6, 6, ''),
(7, 7, ''),
(8, 8, ''),
(9, 9, ''),
(10, 10, ''),
(11, 11, ''),
(12, 12, ''),
(13, 13, ''),
(14, 14, ''),
(15, 15, ''),
(16, 16, ''),
(17, 17, 'Виниловые'),
(18, 17, 'Флизелиновые'),
(19, 17, 'Текстильные'),
(20, 17, 'Флоковые'),
(21, 17, 'Натуральные'),
(22, 17, 'Бумажные'),
(23, 17, 'Плитка'),
(24, 18, 'КВЕ Balance (Grand)'),
(25, 18, 'КВЕ Engine (Newton)'),
(26, 18, 'КВЕ Expert (Nobel)'),
(27, 19, ''),
(28, 20, ''),
(29, 21, ''),
(30, 22, ''),
(31, 23, 'Ламинат'),
(32, 23, 'Линолеум'),
(33, 23, 'Массив'),
(34, 23, 'Модули'),
(35, 23, 'Паркет'),
(36, 23, 'Плитка'),
(37, 24, ''),
(38, 25, ''),
(39, 26, ''),
(40, 27, ''),
(41, 28, ''),
(42, 29, ''),
(43, 30, ''),
(44, 31, ''),
(45, 32, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
