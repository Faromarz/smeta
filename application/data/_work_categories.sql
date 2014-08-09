-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 09 2014 г., 22:02
-- Версия сервера: 5.1.73
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `remont`
--

-- --------------------------------------------------------

--
-- Структура таблицы `work_categoties`
--

CREATE TABLE IF NOT EXISTS `work_categoties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `work_categoties`
--

INSERT INTO `work_categoties` (`id`, `name`) VALUES
(1, 'Стены'),
(2, 'Пол'),
(3, 'Потолок'),
(4, 'Электрика'),
(5, 'Сантехника'),
(6, 'Двери и Окна'),
(7, 'Прочие работы');
