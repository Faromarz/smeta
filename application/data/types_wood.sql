-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 19 2014 г., 23:48
-- Версия сервера: 5.5.38-MariaDB-wsrep
-- Версия PHP: 5.5.17

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
-- Структура таблицы `types_wood`
--

CREATE TABLE IF NOT EXISTS `types_wood` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='тип дерева';

--
-- Дамп данных таблицы `types_wood`
--

INSERT INTO `types_wood` (`id`, `name`) VALUES
(1, 'Вишня'),
(2, 'Дуб'),
(3, 'Орех'),
(4, 'Бук'),
(5, 'Мербау'),
(6, 'Афзелия'),
(7, 'Груша'),
(8, 'Каштан'),
(9, 'Венге'),
(10, 'Бамбук'),
(11, 'Слива'),
(12, 'Тик'),
(13, 'Ясень'),
(14, 'Сосна'),
(15, 'Клен'),
(16, 'Акация'),
(17, 'Махагони'),
(18, 'Палисандр'),
(19, 'Гикори'),
(20, 'Лиственница'),
(21, 'Береза'),
(22, 'Зебрано'),
(23, 'Яблоня'),
(24, 'Панга'),
(25, 'Сапеле'),
(26, 'Пекан'),
(27, 'Окан'),
(28, 'Дуссия'),
(29, 'Ипе'),
(30, 'Кедр'),
(31, 'Тали'),
(32, 'Тали<br />Мербау'),
(33, 'Сапеле<br />Мербау'),
(34, 'Ятоба'),
(35, 'Ироко'),
(36, 'Падук'),
(37, 'Сукупира'),
(38, 'Ятоба<br />Мербау'),
(39, 'Ярра (Эвкалипт)'),
(40, 'Кемпас'),
(41, 'Гевея'),
(42, 'Ясень<br />Венге'),
(43, 'Ясень<br />Мербау'),
(44, 'Бук<br />Клен'),
(45, 'Клен<br />Дуб'),
(46, 'Ясень<br />Дуб'),
(47, 'Кемпас<br />Ятоба'),
(48, 'Имбуиа'),
(49, 'Мсаса'),
(50, 'Афрормозия'),
(51, 'Дуб, '),
(52, 'Олива'),
(53, 'Макассар'),
(54, 'Каслин'),
(55, 'Гонкало (тигровое дерево)'),
(56, 'Тауари'),
(57, 'Кумару'),
(58, 'Лаурел');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `types_wood`
--
ALTER TABLE `types_wood`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `types_wood`
--
ALTER TABLE `types_wood`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
