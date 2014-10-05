-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 05 2014 г., 20:00
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
-- Структура таблицы `material_categories`
--

CREATE TABLE IF NOT EXISTS `material_categories` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `scope` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `repair_id_rate_id` varchar(64) NOT NULL DEFAULT '1,2,3' COMMENT 'typesRepairId_typesRateId',
  `rooms_type` varchar(32) NOT NULL COMMENT 'RoomsType',
  `calculation` varchar(255) NOT NULL COMMENT 'S-площадь, P-периметр, count - количество'
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material_categories`
--

INSERT INTO `material_categories` (`id`, `parent_id`, `lvl`, `lft`, `rgt`, `scope`, `name`, `repair_id_rate_id`, `rooms_type`, `calculation`) VALUES
(1, 0, 1, 1, 2, 1, 'Плинтус', '2_1,2_2,2_3', '1,2,3', 'CountPlinth'),
(2, 0, 1, 1, 2, 2, 'Порог', '2_1,2_2,2_3', '', 'CountDoor'),
(3, 0, 1, 1, 2, 3, 'Дверь входная', '2_1,2_2,2_3', '3', '1'),
(4, 0, 1, 1, 2, 4, 'Дверь межкомнатная', '2_1,2_2,2_3', '1,2,4,5', 'CountDoor'),
(5, 0, 1, 1, 2, 5, 'Дверные ручки', '2_1,2_2,2_3', '', 'CountDoor'),
(6, 0, 1, 1, 2, 6, 'Замки', '2_1,2_2,2_3', '', '1'),
(7, 0, 1, 1, 2, 7, 'Защёлки', '2_1,2_2,2_3', '', '1'),
(8, 0, 1, 1, 2, 8, 'Накладки дверные', '2_1,2_2,2_3', '', 'CountDoor'),
(9, 0, 1, 1, 2, 9, 'Петли', '2_1,2_2,2_3', '', 'CountLoop'),
(10, 0, 1, 1, 2, 10, 'Цилиндры', '2_1,2_2,2_3', '', 'CountDoor'),
(11, 0, 1, 1, 16, 11, 'Обои', '1_1,1_2,1_3,2_1,2_2,2_3', '1,2,3', 'SizeWall'),
(12, 0, 1, 1, 2, 12, 'Краска', '1_1,1_2,1_3,2_1,2_2,2_3', '', '0'),
(13, 0, 1, 1, 2, 13, 'Ванна/Кабина', '2_1,2_2,2_3', '4', '1'),
(14, 0, 1, 1, 2, 14, 'Унитаз', '2_1,2_2,2_3', '5', '1'),
(15, 0, 1, 1, 2, 15, 'Умывальник', '2_1,2_2,2_3', '4', '1'),
(16, 0, 1, 1, 2, 16, 'Смеситель', '2_1,2_2,2_3', '4', '1'),
(17, 0, 1, 1, 2, 17, 'Полотенцесушитель', '2_1,2_2,2_3', '4', '1'),
(18, 0, 1, 1, 2, 18, 'Кондикционер', '1_2,2_1,2_2,2_3', '1,2', '1'),
(19, 0, 1, 1, 2, 19, 'Отопление', '2_2,2_3', '1,2,3', '1'),
(20, 0, 1, 1, 2, 20, 'Клей для плитки', '1_1,1_2,1_3,2_1,2_2,2_3', '', '0'),
(21, 0, 1, 1, 2, 21, 'Затирка', '2_1,2_2,2_3', '', '0'),
(22, 0, 1, 1, 2, 22, 'Клей для обоев', '1_1,1_2,1_3,2_1,2_2,2_3', '', '0'),
(23, 0, 1, 1, 2, 23, 'Подложка', '2_2,2_3', '', '0'),
(24, 0, 1, 1, 2, 24, 'Клей для пола', '2_2,2_3', '', '0'),
(25, 0, 1, 1, 2, 25, 'Лак для пола', '2_2,2_3', '', '0'),
(26, 0, 1, 1, 2, 26, 'Клей для линолеума', '1_1,1_2,1_3,2_1,2_2,2_3', '', '0'),
(27, 0, 1, 1, 2, 27, 'Потолок', '2_1,2_2,2_3', '1,2,3', 'Perimeter'),
(28, 0, 1, 1, 14, 28, 'Пол', '2_1,2_2,2_3', '1,2,3', 'Perimeter'),
(29, 0, 1, 1, 8, 29, 'Окно', '2_1,2_2,2_3', '1,2,3', 'CountWindows'),
(30, 0, 1, 1, 2, 30, 'Для раковины', '2_1,2_2,2_3', '2,4,6', '1'),
(31, 0, 1, 1, 2, 31, 'Фартук', '2_1,2_2,2_3', '2', 'AreaApron'),
(32, 11, 2, 2, 3, 11, 'Виниловые', '1_1,1_2,1_3,2_1,2_2,2_3', '1,2,3', 'SizeWall'),
(33, 11, 2, 4, 5, 11, 'Флизелиновые', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'SizeWall'),
(34, 11, 2, 6, 7, 11, 'Текстильные', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'SizeWall'),
(35, 11, 2, 8, 9, 11, 'Флоковые', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'SizeWall'),
(36, 11, 2, 10, 11, 11, 'Натуральные', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'SizeWall'),
(37, 11, 2, 12, 13, 11, 'Бумажные', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'SizeWall'),
(38, 11, 2, 14, 15, 11, 'Плитка', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'SizeWall'),
(39, 28, 2, 2, 3, 28, 'Линолеум', '2_1,2_2,2_3', '1,2,3', 'Perimeter'),
(40, 28, 2, 4, 5, 28, 'Ламинат', '2_1,2_2,2_3', '', 'Perimeter'),
(41, 28, 2, 6, 7, 28, 'Паркет', '2_1,2_2,2_3', '', 'Perimeter'),
(42, 28, 2, 8, 9, 28, 'Массив', '2_1,2_2,2_3', '', 'Perimeter'),
(43, 28, 2, 10, 11, 28, 'Модули', '2_1,2_2,2_3', '', 'Perimeter'),
(44, 28, 2, 12, 13, 28, 'Плитка', '2_1,2_2,2_3', '', 'Perimeter'),
(45, 0, 1, 1, 2, 32, 'Рукав', '2_1,2_2,2_3', '0', 'AreaApron'),
(46, 29, 2, 2, 3, 29, 'КВЕ Engine (Newton)', '1_1,1_2,1_3,2_1,2_2,2_3', '1,2,3', 'CountWindows'),
(47, 29, 2, 4, 5, 29, 'КВЕ Balance (Grand)', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'CountWindows'),
(48, 29, 2, 6, 7, 29, 'КВЕ Expert (Nobel)', '1_1,1_2,1_3,2_1,2_2,2_3', '', 'CountWindows');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `material_categories`
--
ALTER TABLE `material_categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `parent_id_2` (`parent_id`,`name`), ADD KEY `parent_id` (`parent_id`,`lvl`,`lft`,`rgt`,`scope`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `material_categories`
--
ALTER TABLE `material_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
