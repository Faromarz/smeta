-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 05 2014 г., 23:40
-- Версия сервера: 5.1.73
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `smeta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(1, 'Россия'),
(2, 'Китай'),
(3, 'Германия'),
(4, 'Франция'),
(5, 'Австрия'),
(6, 'Бельгия'),
(7, 'Швеция'),
(8, 'Корея'),
(9, 'Польша'),
(10, 'Италия'),
(11, 'Испания'),
(12, 'Турция'),
(13, 'Беларусь'),
(14, 'Португалия'),
(15, 'Украина'),
(17, 'Финляндия'),
(18, 'Чехия'),
(19, 'Сербия'),
(20, 'Венгрия'),
(21, 'Голландия'),
(22, 'Щвеция'),
(23, 'Канада'),
(24, 'Нидерланды'),
(25, 'Индонезия'),
(26, 'ДАД'),
(27, 'Румыния'),
(28, 'Англия'),
(29, 'Белоруссия'),
(30, 'Камерун'),
(31, 'Бразилия'),
(32, 'Панама'),
(33, 'Белорусь'),
(34, 'Перу'),
(35, 'США'),
(36, 'Тайланд'),
(37, 'Бирма'),
(38, 'Америка'),
(39, 'Япония'),
(40, 'Таиланд'),
(41, 'Малайзия'),
(42, 'Швейцария'),
(43, 'Болгария'),
(44, 'Дания'),
(45, 'Великобритания'),
(46, 'Словения'),
(47, 'КНР'),
(48, 'Герминия'),
(49, 'Росиия');
