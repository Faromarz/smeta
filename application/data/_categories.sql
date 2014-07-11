-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 27 2014 г., 14:08
-- Версия сервера: 5.5.37-0ubuntu0.13.10.1
-- Версия PHP: 5.5.3-1ubuntu2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `_smeta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `scope` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `img` varchar(64) DEFAULT NULL,
  `img_alt` varchar(64) DEFAULT NULL,
  `img_title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parent_id_2` (`parent_id`,`name`),
  KEY `parent_id` (`parent_id`,`lvl`,`lft`,`rgt`,`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `lvl`, `lft`, `rgt`, `scope`, `name`, `img`, `img_alt`, `img_title`) VALUES
(14, 0, 1, 1, 10, 2, 'Ремонт в комплексе', '14.jpg', NULL, NULL),
(15, 14, 2, 2, 3, 2, 'Порядок проведения ремонтных работ', NULL, NULL, NULL),
(16, 14, 2, 4, 5, 2, 'Ремонт капитальный - этапы', NULL, NULL, NULL),
(17, 14, 2, 6, 7, 2, 'Ремонт капитальный - как он есть', NULL, NULL, NULL),
(18, 14, 2, 8, 9, 2, 'Ремонт косметический', NULL, NULL, NULL),
(20, 0, 1, 1, 10, 3, 'Потолок', '20.jpg', NULL, NULL),
(21, 0, 1, 1, 12, 4, 'Стены', '21.jpg', NULL, NULL),
(22, 0, 1, 1, 12, 5, 'Пол', '22.jpg', NULL, NULL),
(23, 0, 1, 1, 16, 6, 'Сантехника', '23.jpg', NULL, NULL),
(24, 0, 1, 1, 10, 7, 'Электрика', '24.jpg', NULL, NULL),
(25, 0, 1, 1, 2, 8, 'Отопление', '25.jpg', NULL, NULL),
(26, 0, 1, 1, 20, 9, 'Двери', '26.jpg', NULL, NULL),
(37, 20, 2, 2, 3, 3, 'Натяжной потолок', NULL, NULL, NULL),
(38, 20, 2, 4, 5, 3, 'Подвесной потолок', NULL, NULL, NULL),
(39, 20, 2, 6, 7, 3, 'Реечный потолок', NULL, NULL, NULL),
(40, 20, 2, 8, 9, 3, 'Зеркальный потолок', NULL, NULL, NULL),
(52, 22, 2, 2, 3, 5, 'Ламинатные полы', NULL, NULL, NULL),
(53, 22, 2, 4, 5, 5, 'Паркетные полы', NULL, NULL, NULL),
(54, 22, 2, 6, 7, 5, 'Плиточные полы', NULL, NULL, NULL),
(55, 22, 2, 8, 9, 5, 'Линолеум', NULL, NULL, NULL),
(56, 22, 2, 10, 11, 5, 'Полы с подогревом', NULL, NULL, NULL),
(57, 23, 2, 2, 3, 6, 'Смесители и краны', NULL, NULL, NULL),
(58, 23, 2, 4, 5, 6, 'Очистка воды', NULL, NULL, NULL),
(59, 23, 2, 6, 7, 6, 'Раковина', NULL, NULL, NULL),
(60, 23, 2, 8, 9, 6, 'Ванна', NULL, NULL, NULL),
(61, 23, 2, 10, 11, 6, 'Унитаз', NULL, NULL, NULL),
(62, 23, 2, 12, 13, 6, 'Трубы, водопровод', NULL, NULL, NULL),
(63, 23, 2, 14, 15, 6, 'Душ и кабины', NULL, NULL, NULL),
(64, 24, 2, 2, 3, 7, 'Розетки и выключатели', NULL, NULL, NULL),
(65, 24, 2, 4, 5, 7, 'Проводка', NULL, NULL, NULL),
(66, 24, 2, 6, 7, 7, 'Электрощит', NULL, NULL, NULL),
(67, 24, 2, 8, 9, 7, 'Монтаж проводки', NULL, NULL, NULL),
(68, 21, 2, 2, 3, 4, 'Декорирование', NULL, NULL, NULL),
(70, 21, 2, 4, 5, 4, 'Штукатурные работы', NULL, NULL, NULL),
(72, 21, 2, 6, 7, 4, 'Обои', NULL, NULL, NULL),
(73, 21, 2, 8, 9, 4, 'Кафель и плитка', NULL, NULL, NULL),
(74, 21, 2, 10, 11, 4, 'Покраска', NULL, NULL, NULL),
(75, 26, 2, 14, 15, 9, 'Входные', NULL, NULL, NULL),
(76, 26, 2, 16, 17, 9, 'Межкомнатные', NULL, NULL, NULL),
(77, 26, 2, 18, 19, 9, 'Замки', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
