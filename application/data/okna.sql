-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 16 2014 г., 20:29
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
-- Структура таблицы `okna`
--

CREATE TABLE IF NOT EXISTS `okna` (
`id` int(11) unsigned NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `base_gluh` float NOT NULL,
  `base_povorot` float NOT NULL,
  `base_povorot_otk` float NOT NULL,
  `podokonnik_otliv` float NOT NULL,
  `otkos_shtuk` float NOT NULL,
  `otkos_plastik` float NOT NULL,
  `montaj` float NOT NULL,
  `setka` float NOT NULL,
  `stvorka2` float NOT NULL,
  `stvorka3` float NOT NULL,
  `framuga` float NOT NULL,
  `color_wood` float NOT NULL,
  `site` text CHARACTER SET utf8 NOT NULL,
  `tel` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(200) CHARACTER SET utf8 NOT NULL,
  `dop_info1` text CHARACTER SET utf8 NOT NULL,
  `dop_info2` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `okna`
--

INSERT INTO `okna` (`id`, `cat_id`, `price`, `base_gluh`, `base_povorot`, `base_povorot_otk`, `podokonnik_otliv`, `otkos_shtuk`, `otkos_plastik`, `montaj`, `setka`, `stvorka2`, `stvorka3`, `framuga`, `color_wood`, `site`, `tel`, `address`, `dop_info1`, `dop_info2`) VALUES
(1, 46, 24, 40, 500, 2000, 50, 10, 20, 20, 10, 1000, 2000, 500, 4000, 'www.окна.ру', '555 66 77', 'ленина 10', 'КБЕ Эталон – классическая профильная система, технология производства которой «отточена» до совершенства. Она представлена на российском рынке более 15 лет. За это время оконные компании проработали все нюансы сборки окна из профиля КБЕ_Эталон. Поэтому данная система стала классикой пластиковых окон!  Окна из профиля КБЕ_Эталон способны изменить Ваш интерьер, добавить изюминку в привычную обстановку. Классический вид пластикового окна может усовершенствовать цветовой дизайн, так как наряду с уплотнителем черного цвета профиль КБЕ_Эталон производится с коэкструдированным серым уплотнителем. Он придаст окнам благородный вид и сделает световой проем визуально больше.', 'Экономичное решение на базе недорогого и надежного профиля КВЕ Объект. 58 мм. монтажная глубина и 3 воздушные камеры.'),
(2, 47, 40, 40, 500, 2000, 50, 10, 20, 20, 10, 1000, 2000, 500, 4000, 'раз', '3344466', 'ленина 10', 'КБЕ Эксперт – современная профильная система, отвечающая высоким требованиям по теплоизоляции. КБЕ_Эксперт имеет монтажную ширину 70 мм, что позволяет сделать монтажный шов на 20% шире и лучше утеплить его. Широкий 5-камерный профиль позволяет установить более толстый стеклопакет, что значительно увеличивает теплоизоляцию помещения. Именно поэтому оконные системы из профиля КБЕ_Эксперт получили название «Окна максимального комфорта».', ' Качественный профиль, серое уплотнение, 70 мм. монтажная глубина и 5 воздушных камер - это окна КВЕ Expert. Тепло – зимой, прохлада – летом!'),
(3, 48, 30, 40, 500, 2000, 50, 10, 20, 20, 10, 1000, 2000, 500, 4000, 'фыв', '4352', 'фафыв аф', 'Система Balance  разработана на основе лучших западных технологий с учетом российских климатических особенностей. КБЕ_Эталон  расширяет основные достоинства системы КБЕ Эталон. Благодаря комбинации КБЕ_Эталон с «широкой рамой» (монтажная глубина 127 мм), система получает дополнительные преимущества:      более высокий коэффицент сопротивления теплопередаче;     уменьшение теплопотерь через края оконного проема в стене.   Наряду с описанными выше преимуществами, КБЕ_Эталон  обладает прочими достоинствами пластиковых окон, изготовленных из базовой системы КБЕ_Эталон: отличная звукоизоляция, хорошие теплоизоляционные свойства, долговечность, экологичность и простота ухода.', 'Ключевое преимущество окон серии КВЕ Balance состоит в том, что вы покупаете теплые окна, монтажной глубиной 70 мм по цене обычных!');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `okna`
--
ALTER TABLE `okna`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `okna`
--
ALTER TABLE `okna`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
