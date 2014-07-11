-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 11 2014 г., 22:01
-- Версия сервера: 5.5.37-MariaDB-wsrep
-- Версия PHP: 5.5.14

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
-- Структура таблицы `material_categories`
--

CREATE TABLE IF NOT EXISTS `material_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `scope` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `repair_id_rate_id` varchar(64) NOT NULL DEFAULT '1,2,3' COMMENT 'typesRepairId_typesRateId',
  PRIMARY KEY (`id`),
  UNIQUE KEY `parent_id_2` (`parent_id`,`name`),
  KEY `parent_id` (`parent_id`,`lvl`,`lft`,`rgt`,`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Дамп данных таблицы `material_categories`
--

INSERT INTO `material_categories` (`id`, `parent_id`, `lvl`, `lft`, `rgt`, `scope`, `name`, `repair_id_rate_id`) VALUES
(1, 0, 1, 1, 2, 1, 'Плинтус', '2_1,2_2,2_3'),
(2, 0, 1, 1, 2, 2, 'Порог', '2_1,2_2,2_3'),
(3, 0, 1, 1, 2, 3, 'Дверь входная', '2_1,2_2,2_3'),
(4, 0, 1, 1, 2, 4, 'Дверь межкомнатная', '2_1,2_2,2_3'),
(5, 0, 1, 1, 2, 5, 'Дверные ручки', '2_1,2_2,2_3'),
(6, 0, 1, 1, 2, 6, 'Замки', '2_1,2_2,2_3'),
(7, 0, 1, 1, 2, 7, 'Защёлки', '2_1,2_2,2_3'),
(8, 0, 1, 1, 2, 8, 'Накладки дверные', '2_1,2_2,2_3'),
(9, 0, 1, 1, 2, 9, 'Петли', '2_1,2_2,2_3'),
(10, 0, 1, 1, 2, 10, 'Цилиндры', '2_1,2_2,2_3'),
(11, 0, 1, 1, 16, 11, 'Обои', 'NULL'),
(12, 0, 1, 1, 2, 12, 'Краска', 'NULL'),
(13, 0, 1, 1, 2, 13, 'Ванна/Кабина', '2_1,2_2,2_3'),
(14, 0, 1, 1, 2, 14, 'Унитаз', '2_1,2_2,2_3'),
(15, 0, 1, 1, 2, 15, 'Умывальник', '2_1,2_2,2_3'),
(16, 0, 1, 1, 2, 16, 'Смеситель', '2_1,2_2,2_3'),
(17, 0, 1, 1, 2, 17, 'Полотенцесушитель', '2_1,2_2,2_3'),
(18, 0, 1, 1, 2, 18, 'Кондикционер', '1_2,2_1,2_2,2_3'),
(19, 0, 1, 1, 2, 19, 'Отопление', '2_2,2_3'),
(20, 0, 1, 1, 2, 20, 'Клей для плитки', 'NULL'),
(21, 0, 1, 1, 2, 21, 'Затирка', '2_1,2_2,2_3'),
(22, 0, 1, 1, 2, 22, 'Клей для обоев', 'NULL'),
(23, 0, 1, 1, 2, 23, 'Подложка', '2_2,2_3'),
(24, 0, 1, 1, 2, 24, 'Клей для пола', '2_2,2_3'),
(25, 0, 1, 1, 2, 25, 'Лак для пола', '2_2,2_3'),
(26, 0, 1, 1, 2, 26, 'Клей для линолеума', 'NULL'),
(27, 0, 1, 1, 2, 27, 'Потолок', '2_1,2_2,2_3'),
(28, 0, 1, 1, 14, 28, 'Пол', '2_1,2_2,2_3'),
(29, 0, 1, 1, 8, 29, 'Окно', '2_1,2_2,2_3'),
(30, 0, 1, 1, 2, 30, 'Для раковины', '2_1,2_2,2_3'),
(31, 0, 1, 1, 2, 31, 'Фартук', '2_1,2_2,2_3'),
(32, 11, 2, 2, 3, 11, 'Виниловые', 'NULL'),
(33, 11, 2, 4, 5, 11, 'Флизелиновые', 'NULL'),
(34, 11, 2, 6, 7, 11, 'Текстильные', 'NULL'),
(35, 11, 2, 8, 9, 11, 'Флоковые', 'NULL'),
(36, 11, 2, 10, 11, 11, 'Натуральные', 'NULL'),
(37, 11, 2, 12, 13, 11, 'Бумажные', 'NULL'),
(38, 11, 2, 14, 15, 11, 'Плитка', 'NULL'),
(39, 28, 2, 2, 3, 28, 'Линолеум', '2_1,2_2,2_3'),
(40, 28, 2, 4, 5, 28, 'Ламинат', '2_1,2_2,2_3'),
(41, 28, 2, 6, 7, 28, 'Паркет', '2_1,2_2,2_3'),
(42, 28, 2, 8, 9, 28, 'Массив', '2_1,2_2,2_3'),
(43, 28, 2, 10, 11, 28, 'Модули', '2_1,2_2,2_3'),
(44, 28, 2, 12, 13, 28, 'Плитка', '2_1,2_2,2_3'),
(45, 0, 1, 1, 2, 32, 'Рукав', '2_1,2_2,2_3'),
(46, 29, 2, 2, 3, 29, 'КВЕ Engine (Newton)', 'NULL'),
(47, 29, 2, 4, 5, 29, 'КВЕ Balance (Grand)', 'NULL'),
(48, 29, 2, 6, 7, 29, 'КВЕ Expert (Nobel)', 'NULL');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;