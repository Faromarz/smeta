-- phpMyAdmin SQL Dump
-- version 4.2.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 09 2014 г., 21:09
-- Версия сервера: 5.5.37-MariaDB-wsrep
-- Версия PHP: 5.5.15

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
-- Структура таблицы `works`
--

CREATE TABLE IF NOT EXISTS `works` (
`id` int(11) NOT NULL,
  `count` varchar(511) DEFAULT NULL,
  `unit` varchar(64) DEFAULT NULL,
  `name` varchar(255) NOT NULL COMMENT 'название работы',
  `repair_ids` varchar(64) DEFAULT NULL,
  `cat_arr` varchar(255) DEFAULT NULL,
  `podceteg_arr` varchar(64) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT 'Категории работ',
  `watch` double(3,1) NOT NULL DEFAULT '1.0',
  `nv_vt` tinyint(1) DEFAULT NULL COMMENT '0  - новострой 1 - вторичка',
  `room_type` varchar(64) DEFAULT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0 - деомнтажные , 1 - монтажные',
  `price` double(20,2) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1012 ;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `count`, `unit`, `name`, `repair_ids`, `cat_arr`, `podceteg_arr`, `category_id`, `watch`, `nv_vt`, `room_type`, `type`, `price`) VALUES
(4, '1', 'шт.', 'Окна', '2_1,2_2,2_3', '46,47,48', NULL, NULL, 0.5, 7, '1,2', 0, 1000.00),
(8, 'CD', 'шт.', 'Дверь входная', '2_1,2_2,2_3', '3', NULL, NULL, 1.0, 7, '1', 0, 500.00),
(10, 'S', 'м<sup>2</sup>', 'Снятие линолеума,ковролина, ламината (без сохранения)', '2_1,2_2,2_3', '39,40', NULL, NULL, 0.1, 7, '3', 0, 200.00),
(11, '1', 'шт.', 'Ванна', '2_1,2_2,2_3', '13', NULL, NULL, 0.5, 7, '4', 0, 1500.00),
(12, '1', 'шт.', 'Умывальник', '2_1,2_2,2_3', '15', NULL, NULL, 0.3, 7, '4', 0, 1000.00),
(13, '1', 'шт.', 'Полотенцесушитель', '2_1,2_2,2_3', '17', NULL, NULL, 0.2, 7, '4', 0, 500.00),
(14, '1', 'шт.', 'Батареи/старый радиатор', '2_1,2_2,2_3', '19', NULL, NULL, 0.3, 7, '1,2', 0, 500.00),
(15, 'S', '', 'Вывоз мусора', '2_1,2_2,2_3', NULL, NULL, NULL, 0.4, 7, '1,2,3,4,5', 0, 100.00),
(504, 'C', 'шт.', 'Дверь межкомнатная', '2_1,2_2,2_3', '4', NULL, NULL, 0.3, 7, '1', 0, 400.00),
(505, 'P', 'м.п.', 'Демонтаж деревянных/пластиковых плинтусов', '2_1,2_2,2_3', '39,40,41,42,43,44', NULL, NULL, 0.1, 7, '1,2,3', 0, 48.00),
(506, 'S', 'м<sup>2</sup>', 'Демонтаж деревянных полов/паркета/ламината', '2_1,2_2,2_3', '39,40,41,42,43,44', NULL, NULL, 0.3, 7, '1', 0, 210.00),
(510, 'S', 'м<sup>2</sup>', 'Удаление плитки с пола', '2_1,2_2,2_3', '44', NULL, NULL, 0.2, 7, '2,4,5', 0, 144.00),
(511, 'S', 'м<sup>2</sup>', 'Демонтаж потолка', '2_1,2_2,2_3', '27', NULL, NULL, 0.2, 7, NULL, 0, 90.00),
(512, 'S', 'м<sup>2</sup>', 'Демонтаж потолка реечного', '2_1,2_2,2_3', '27', NULL, NULL, 0.1, 7, '4', 0, 90.00),
(514, 'P/4', 'м.п.', 'Расшивка меж-плиточных швов', '2_2,2_3', '27', NULL, NULL, 0.2, 7, '1', 0, 276.00),
(515, 'S', 'м<sup>2</sup>', 'Снятие старой краски', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, NULL, 0.5, 7, '2,5', 0, 360.00),
(516, 'S', 'м<sup>2</sup>', 'Смывка мела, побелки с потолка', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, NULL, 0.2, 7, '1,3', 0, 240.00),
(518, 'S/3', 'м<sup>2</sup>', 'Удаление шпаклевки с потолка', '1_2,1_3,2_1,2_2,2_3', '27', NULL, NULL, 0.4, 7, '1,2,3', 0, 198.00),
(519, 'PW', 'м<sup>2</sup>', 'Снятие старых обоев (за слой)', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37', NULL, NULL, 0.2, 7, '1,2,3', 0, 84.00),
(520, 'PW/2', 'м<sup>2</sup>', 'Демонтаж стеновой керамической плитки', '2_1,2_2,2_3', '38', NULL, NULL, 0.2, 7, '4,5', 0, 120.00),
(521, 'P', 'м.п.', 'Демонтаж старой электропроводки', '2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, NULL, 0.1, 7, '1', 0, 36.00),
(522, '1', 'шт.', 'Демонтаж смесителя', '2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, NULL, 0.2, 7, '2,4', 0, 240.00),
(523, '3', 'шт.', 'Демонтаж розеток, выключателей', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, NULL, 0.1, 7, '1,2,3', 0, 60.00),
(524, 'PW/5', 'м<sup>2</sup>', 'Снятие штукатурки со стен, откосов (слой до 1 см)', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, NULL, 0.3, 7, '1,2,3', 0, 60.00),
(525, '1', 'шт.', 'Демонтаж подоконников', '2_1,2_2,2_3', '46,47,48', NULL, NULL, 0.3, 7, '1,2', 0, 240.00),
(767, '1', 'шт.', 'Установка кондиционера, внешнего блока кондиционера и подведение эл-ва', '2_1,2_2,2_3', '18', NULL, 7, 5.0, NULL, '1', 1, 7500.00),
(768, '0', 'шт.', 'Установка домофона   ', '1_1,1_2,1_3,2_1,2_2,2_3', '3', NULL, 0, 2.0, NULL, '2', 1, 13000.00),
(769, 'PW', 'м<sup>2</sup>', 'Нанесение на стены бетоноконтакта/грунтовки (3 слоя)', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 1, 0.1, NULL, '1,2,3,4,5', 1, 150.00),
(770, 'PW', 'м<sup>2</sup>', 'Шпаклёвка стен', '1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 1, 0.3, NULL, '1,2,3', 1, 150.00),
(771, 'PW', 'м<sup>2</sup>', 'Шлифовка стен', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 1, 0.3, NULL, '1,2,3', 1, 150.00),
(772, 'S', 'м<sup>2</sup>', 'Шлифовка потолка ', '1_1,1_2,1_3', '27', NULL, 3, 0.4, NULL, '1,2,3,4,5', 1, 260.00),
(773, 'S', 'м<sup>2</sup>', 'Монтаж потолка подвесного/реечного (с материалами)', '2_1,2_2,2_3', '27', NULL, 3, 0.3, NULL, '4,5', 1, 350.00),
(774, 'S', 'м<sup>2</sup>', 'Монтаж потолка натяжного (с материалами)', '2_1,2_3', '27', NULL, 3, 0.2, NULL, '1,2,3', 1, 840.00),
(775, 'S/3', 'м<sup>2</sup>', 'Монтаж потолка 2-х уровневого (с материалами - из ГКЛ)', '2_3', '27', NULL, 3, 0.3, NULL, '1,2,3', 1, 1200.00),
(776, '1', 'м<sup>2</sup>', 'Ошкуривание и покраска радиатора ', '1_2,1_3,2_1', '19', NULL, 7, 0.5, NULL, '1,2', 1, 750.00),
(777, 'P', 'м<sup>2</sup>', 'Приклеивание потолочных плинтусов', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, 3, 0.1, NULL, '1', 1, 75.00),
(778, 'S', 'м<sup>2</sup>', 'Укладка подложки', '2_1,2_2,2_3', '1', NULL, 2, 0.0, NULL, '1,2,3', 1, 150.00),
(779, 'P', 'м<sup>2</sup>', 'Устройство плинтуса', '1_1,1_2,1_3,2_1,2_2,2_3', '1', NULL, 2, 0.1, NULL, '1,2,3', 1, 90.00),
(780, '5', 'м<sup>2</sup>', 'Облицовка стеновой плитки - Фартук на кухне, затирка швов', '2_1,2_2,2_3', '45', NULL, 1, 0.3, NULL, '2', 1, 840.00),
(782, '1', 'шт.', 'Установка двери входной', '2_1,2_2,2_3', '3', NULL, 6, 3.0, NULL, '3', 1, 3500.00),
(783, '1', 'шт.', 'Установка дверей межкомнатных', '2_1,2_2,2_3', '4', NULL, 6, 2.0, NULL, '1,2,4,5', 1, 2500.00),
(784, '1', 'шт.', 'Установка полотенцесушителя', '2_1,2_2,2_3', '17', NULL, 5, 1.0, NULL, '4', 1, 1500.00),
(785, '1', 'шт.', 'Установка умывальника', '2_1,2_2,2_3', '15', NULL, 5, 1.0, NULL, '4', 1, 2000.00),
(786, '1', 'шт.', 'Установка унитаза', '2_1,2_2,2_3', '14', NULL, 5, 1.0, NULL, '5', 1, 2000.00),
(787, '1', 'шт.', 'Установка смесителя', '2_1,2_2,2_3', '16', NULL, 5, 0.5, NULL, '2,4', 1, 1500.00),
(788, '1', 'шт.', 'Установка смесителя для раковины', '2_1,2_2,2_3', '30', NULL, 5, 0.5, NULL, '4', 1, 1000.00),
(789, '1', 'шт.', 'Установка люстры, бра', '2_1,2_2,2_3', '27', NULL, 3, 0.3, NULL, '1,2,3', 1, 330.00),
(790, '1', 'шт.', 'Установка вентилятора в вытяжку в ванной', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '4', 1, 1000.00),
(791, '1', 'шт.', 'Установка вентилятора в вытяжку в туалете', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '5', 1, 1000.00),
(792, 'CD*2', 'м<sup>2</sup>', 'Ошкуривание и покраска труб/радиатора ', '1_1,1_2,1_3', '19', NULL, 7, 0.1, NULL, '1,2', 1, 750.00),
(793, 'S', 'м<sup>2</sup>', 'Выравнивание пола наливной смесью', '2_3', '39,40,41,42,43,44', NULL, 2, 0.2, NULL, '1,2', 1, 480.00),
(794, 'S', 'м<sup>2</sup>', 'Разметка площадей по уровням с выставлением маяков', '2_1,2_2,2_3', '39,40,41,42,43,44', NULL, 2, 0.5, NULL, '1,2,3,4,5', 1, 72.00),
(795, 'S', 'м<sup>2</sup>', 'Засыпка керамзита под стяжку', '2_2', '39,40,41,42,43,44', NULL, 2, 0.1, NULL, '1,2,3,4,5', 1, 144.00),
(796, 'S', 'м<sup>2</sup>', 'Устройство сухого пола Кнауф', '2_3', '39,40,41,42,43,44', NULL, 2, 0.3, NULL, '1,2,3,4,5', 1, 540.00),
(797, 'S', 'м<sup>2</sup>', 'Стяжка цементно-песчанная до 100 мм', '2_2', '39,40,41,42,43,44', NULL, 2, 0.3, NULL, '1,2,3,4,5', 1, 744.00),
(798, 'S', 'м<sup>2</sup>', 'Частичное выравнивание пола наливной смесью', '1_1,1_2,1_3,2_1', '39,40,41,42,43,44', NULL, 2, 0.2, NULL, '1,2,3', 1, 816.00),
(799, 'S', 'м<sup>2</sup>', 'Грунтовка потолка 1 слой', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, 3, 0.0, NULL, '1,2,3', 1, 36.00),
(800, 'S', 'м<sup>2</sup>', 'Штукатурка потолков до 3 см', '2_3', '27', NULL, 3, 0.5, NULL, '1,2,3', 1, 708.00),
(801, 'S', 'м<sup>2</sup>', 'Шпаклевка потолка', '1_1,1_2,1_3', '27', NULL, 3, 0.4, NULL, '1,2,3', 1, 72.00),
(802, '0', 'м<sup>2</sup>', 'Монтаж звукоизоляции или теплоизоляции', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, 0, 0.1, NULL, '1', 1, 336.00),
(803, 'P/3', 'м.п.', 'Заделка и герметизация меж.плиточных швов', '1_1,1_2,1_3,2_1,2_2,2_3', '44', NULL, 0, 0.3, NULL, '1', 1, 300.00),
(805, '1', 'шт.', 'Монтаж пенопластовой лепнины под люстру', '2_3', '27', NULL, 3, 0.5, NULL, '1', 1, 348.00),
(806, 'P', 'м.п.', 'Монтаж потолочного плинтуса', '2_1,2_2,2_3', '27', NULL, 3, 0.1, NULL, '1,2', 1, 108.00),
(808, 'S', 'м<sup>2</sup>', 'Покраска потолка в 2 слоя', '1_1,1_2,1_3', '27', NULL, 3, 0.3, NULL, '1,2,3,4,5', 1, 120.00),
(809, 'PW', 'м<sup>2</sup>', 'Проклейка потолка малярной сеткой', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, 3, 0.2, NULL, '1,2', 1, 156.00),
(810, 'PW/4', 'м<sup>2</sup>', 'Венецианская/декоративная штукатурка', '2_3', '32,33,34,35,36,37,38', NULL, 1, 1.0, NULL, '2', 1, 960.00),
(811, 'PW', 'м<sup>2</sup>', 'Выравнивание стен штукатуркой', '2_2,2_3', '32,33,34,35,36,37,38', NULL, 1, 0.4, NULL, '1,2,3,4,5', 1, 480.00),
(812, 'CD', 'шт.', 'Изготовление арок из гипсокартона (ГКЛ) свыше 1м', '2_3', '32,33,34,35,36,37,38', NULL, 6, 2.0, NULL, '2', 1, 3156.00),
(813, '1', 'шт.', 'Монтаж вентилляционной решетки', '2_2,2_3', '32,33,34,35,36,37,38', NULL, 4, 0.2, NULL, '2', 1, 336.00),
(814, 'PW/2', 'м<sup>2</sup>', 'Монтаж звукоизоляции(Изовер,пенопласт,шуманет.)', '2_3', '32,33,34,35,36,37,38', NULL, 1, 0.2, NULL, '1', 1, 420.00),
(816, '2', 'м<sup>2</sup>', 'Монтаж ниш в стенах из кирпича', '2_3', '32,33,34,35,36,37,38', NULL, 1, 0.5, NULL, '2', 1, 3360.00),
(817, '2', 'м<sup>2</sup>', 'Монтаж перегародок из гипсокартона (1 слой)', '2_2,2_3', '32,33,34,35,36,37,38', NULL, 1, 0.5, NULL, '5', 1, 888.00),
(818, 'P', 'м.п.', 'Оклеивание обойного бордюра', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 1, 0.1, NULL, '1', 1, 144.00),
(819, 'P', 'м.п.', 'Проклейка швов  гипсокартонных листов серпянкой/малярным бинтом', '2_3', '27', NULL, 3, 0.0, NULL, '1,2,3', 1, 66.00),
(820, 'PW/3', 'м<sup>2</sup>', 'Частичное выравнивание стен (под поклейку обоев)', '1_1,1_2,1_3', '32,33,34,35,36,37', NULL, 1, 0.2, NULL, '1,2,3', 1, 180.00),
(821, 'PW', 'м<sup>2</sup>', 'Шпаклевка и шлифовка стены под обои', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37', NULL, 1, 0.6, NULL, '1', 1, 252.00),
(822, 'P/4', 'м.п.', 'Грунтовка откосов', '1_1,1_2,1_3,2_1,2_2,2_3', '46,47,48', NULL, 6, 0.0, NULL, '1,2,3', 1, 36.00),
(823, 'P/4', 'м.п.', 'Покраска откосов', '1_1,1_2', '46,47,48', NULL, 6, 0.2, NULL, '1,2', 1, 168.00),
(824, 'P/4', 'м<sup>2</sup>', 'Установка пластиковых откосов', '1_2,1_3,2_1', '46,47,48', NULL, 6, 0.2, NULL, '1,2', 1, 120.00),
(825, 'P/4', 'м.п.', 'Штукатурка откосов', '2_2,2_3', '46,47,48', NULL, 6, 0.5, NULL, '1,2', 1, 672.00),
(826, 'P/3', 'м.п.', 'Покраска подоконников', '1_1', '46,47,48', NULL, 6, 0.2, NULL, '1,2', 1, 342.00),
(827, 'P/3', 'м.п.', 'Шпаклевка откосов', '2_2,2_3', '46,47,48', NULL, 6, 0.4, NULL, '1,2', 1, 324.00),
(828, '3', 'шт.', 'Монтажные вырезы в плитке (смеситель, п/сушитель, обход водопр. И фановых труб, лючок,вентиляция,розетки, выключатели и т.д.)', '2_1,2_2,2_3', '44', NULL, 2, 0.3, NULL, '2,4,5', 1, 120.00),
(830, 'P', 'м.п.', 'Укладка керамического уголка по ванне', '2_1,2_3', '44', '3', 2, 1.0, NULL, '4', 1, 240.00),
(831, '1', 'шт.', 'Монтаж радиатора отопления на штатное место', '2_1', '19', NULL, 7, 1.0, NULL, '1,2', 1, 1740.00),
(832, '1', 'шт.', 'Монтаж смесителя', '2_1,2_3', '16', NULL, 5, 0.5, NULL, '4', 1, 720.00),
(833, '1', 'шт.', 'Монтаж тройника (полипропилен)', '2_1,2_3', NULL, NULL, 4, 0.3, NULL, '2,4,5', 1, 180.00),
(834, '1', 'шт.', 'Монтаж тройника (металл)', '2_3', NULL, NULL, 4, 0.3, NULL, '2,4,5', 1, 300.00),
(835, '1', 'шт.', 'Перенос радиатора', '2_2,2_3', '19', NULL, 7, 3.0, NULL, '1', 1, 5166.00),
(836, '1', 'шт.', 'Установка термо-регулятора на радиатор отопления', '2_2,2_3', '19', NULL, 4, 1.5, NULL, '1,2', 1, 870.00),
(837, '1', 'шт.', 'Врезка замка, ручек', '2_1,2_2,2_3', '3,4,5', NULL, 6, 1.0, NULL, '1,2,3,4,5', 1, 1440.00),
(838, '1', 'м<sup>2</sup>', 'Расширение проема ( бетон )', '2_2,2_3', NULL, NULL, 6, 1.0, NULL, '3', 1, 360.00),
(839, '1', 'шт.', 'Установка добора', '2_2,2_3', NULL, NULL, 6, 0.3, NULL, '1,2,3,4,5', 1, 960.00),
(840, '1', 'шт.', 'Установка порожка,стыковочной планки', '2_1,2_2,2_3', '39,40,41,42,43,44', NULL, 2, 0.2, NULL, '1,2,3,4,5', 1, 240.00),
(841, '3', 'шт.', 'Установка наличника на дверь на “жидкие гвозди“ (2 стороны)', '2_1,2_2,2_3', '3,4', NULL, 6, 0.3, NULL, '1,2,3,4,5', 1, 300.00),
(842, '1', 'шт.', 'Установка ограничителя открывания двери', '2_1,2_2,2_3', '3,4', NULL, 6, 0.2, NULL, '1,2,3,4,5', 1, 120.00),
(843, '1', 'м.п.', 'Штукатурка откосов дверных шириной до 40 см', '2_1,2_2,2_3', '3,4', NULL, 6, 0.5, NULL, '3', 1, 769.20),
(844, '5', 'м<sup>2</sup>', 'Устройство штукатурной армировочной сетки 5х5 на откосы', '2_1,2_2,2_3', NULL, NULL, 6, 0.2, NULL, '1,2,3', 1, 90.00),
(845, '1', 'шт.', 'Диагностика (прозвонка) электропроводки', '1_1,1_2,1_3', '32,33,34,35,36,37,38', NULL, 4, 0.5, NULL, '1,2,3,4,5', 1, 120.00),
(846, '3', 'шт.', 'Замена розетки, выключателя на старом месте', '1_1,1_2,1_3', '32,33,34,35,36,37,38', NULL, 4, 0.3, NULL, '1,2,3,4,5', 1, 180.00),
(847, '1', 'шт.', 'Монтаж крюка под люстру.', '2_1,2_2,2_3', '27', NULL, 3, 0.3, NULL, '1,2', 1, 300.00),
(848, '1', 'шт.', 'Ревизия электрощита на лестничной клетке', '2_1,2_2,2_3', NULL, NULL, 4, 1.5, NULL, '3', 1, 2400.00),
(849, '1', 'точка', 'Подключение TV, телеф. кабеля к главному щиту.', '2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 4, 1.0, NULL, '1,2', 1, 420.00),
(851, '1', 'шт.', 'Сборка люстры', '2_1,2_2,2_3', '27', NULL, 4, 1.0, NULL, '1', 1, 360.00),
(852, '4', 'шт.', 'Сверление отверстий под установку точечного светильника в гипсокартоне ', '2_3', '27', NULL, 3, 0.1, NULL, '1,2,3', 1, 240.00),
(853, '4', 'шт.', 'Сверление отверстий под установку точечного светильника в реечном потолке', '2_1,2_2,2_3', '27', NULL, 3, 0.2, NULL, '4,5', 1, 360.00),
(854, '3', 'шт.', 'Установка коробки распаячной накладной', '2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 4, 0.1, NULL, '1,2,3', 1, 360.00),
(855, '1', 'шт.', 'Установка телевизионного краба.', '2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, 4, 0.2, NULL, '3', 1, 540.00),
(856, 'PW/2', 'м<sup>2</sup>', 'Покраска стен', '1_1,1_2,1_3,2_1,2_2,2_3', '12', NULL, 1, 0.2, NULL, '1', 1, 120.00),
(858, 'S', 'м<sup>2</sup>', 'Кладка керамогранитной плитки на пол', '2_2,2_3', '44', '3', 2, 1.2, NULL, '2,4,5', 1, 1920.00),
(859, 'S', 'м<sup>2</sup>', 'Кладка керамической плитки на пол', '2_1', '44', '3', 2, 1.0, NULL, '2,4,5', 1, 900.00),
(860, '4', 'шт.', 'Установка и подключение светильника потолочного', '2_1,2_2,2_3', '27', NULL, 4, 0.5, NULL, '4,5', 1, 420.00),
(861, '20', 'м<sup>2</sup>', 'Возведение стен из пазогребневой плиты    плиты (100 мл) по 650руб. За 1м2', '2_3', NULL, NULL, 1, 1.0, NULL, '4', 1, 1475.00),
(862, '6', 'шт.', 'Монтаж электроточки (розетки и/или интернет, и/или телефон, и/ли телевизор)', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '1,2,3,4', 1, 300.00),
(863, 'P/5', 'м.п.', 'Штробление стен (создание канала для проводки)', '2_1,2_2,2_3', NULL, NULL, 1, 0.3, NULL, '1,2,3,4,5', 1, 300.00),
(864, '15', 'м.п.', 'Прокладка силового провода', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '3', 1, 50.00),
(865, '0', 'шт.', 'Установка системы «Умный дом» (10-50тыс.$, только индивидуальный проект)', '2_3', NULL, NULL, 7, 20.0, NULL, '1', 1, 800000.00),
(866, '3', 'м.п.', 'Штробление горячей, холодной воды и канализации', '2_1,2_2,2_3', NULL, NULL, 5, 0.3, NULL, '4,5', 1, 450.00),
(867, 'S', 'м<sup>2</sup>', 'Произведение гидроизоляционных работ (ванна, туалет)', '2_1,2_2,2_3', NULL, NULL, 5, 0.3, NULL, '4,5', 1, 200.00),
(868, 'S', 'м<sup>2</sup>', 'Установка тёплого пола ', '2_2,2_3', '44', '3', 2, 0.2, NULL, '2,4,5', 1, 600.00),
(869, 'PW', 'м<sup>2</sup>', 'Оклеивание стен флизелиновыми обоями', '1_1,2_1', '33', '1', 1, 0.1, NULL, '1,2,3', 1, 210.00),
(870, 'PW', 'м<sup>2</sup>', 'Оклеивание стен бумажными обоями', '1_1,1_2,1_3,2_1,2_2,2_3', '37', '6', 1, 0.2, NULL, '1,2,3', 1, 216.00),
(871, 'PW', 'м<sup>2</sup>', 'Оклеивание стен виниловыми обоями (с подбором рисунка)', '1_1,1_2,1_3,2_1,2_2,2_3', '32', '2', 1, 0.1, NULL, '1,2,3', 1, 336.00),
(872, '0', 'м<sup>2</sup>', 'Оклеивание стен стеклообоями', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37', NULL, 1, 0.1, NULL, '1,2,3', 1, 180.00),
(873, 'PW', 'м<sup>2</sup>', 'Оклеивание стен флоковыми обоями', '1_1,1_2,1_3,2_1,2_2,2_3', '35', '4', 1, 0.1, NULL, '1,2,3', 1, 432.00),
(874, 'PW', 'м<sup>2</sup>', 'Оклеивание стен натуральными обоями', '1_1,1_2,1_3,2_1,2_2,2_3', '36', '5', 1, 0.2, NULL, '1,2,3', 1, 432.00),
(875, 'PW', 'м<sup>2</sup>', 'Оклеивание стен текстильными обоями', '1_1,1_2,1_3,2_1,2_2,2_3', '34', '3', 1, 0.2, NULL, '1,2,3', 1, 432.00),
(876, 'S', 'м<sup>2</sup>', 'Настил линолеума', '1_1,1_2,1_3,2_1', '39', '1', 2, 0.2, NULL, '1,2,3,5', 1, 150.00),
(877, 'S', 'м<sup>2</sup>', 'Укладка ламината', '1_1,1_2,1_3,2_1,2_2,2_3', '40', '2', 2, 0.2, NULL, '1,2,3', 1, 400.00),
(878, 'S', 'м<sup>2</sup>', 'Укладка пробки', '2_1,2_3', '0', '4', 2, 0.3, NULL, '1,2,3,5', 1, 400.00),
(879, 'S', 'м<sup>2</sup>', 'Укладка паркета', '1_2,2_1,2_2,2_3', '41', '5', 2, 2.5, NULL, '1,2,3', 1, 540.00),
(880, 'S', 'кв.м.', 'Укладка массива', '1_2,2_1,2_2,2_3', '42', '6', 2, 2.0, NULL, '1,2,3', 1, 1000.00),
(881, 'S', 'кв.м.', 'Укладка модулей', '1_2,2_1,2_2,2_3', '43', '7', 2, 2.0, NULL, '1,2,3', 1, 1350.00),
(882, 'PW', 'кв.м.', 'Облицовка стеновой плитки в ванной, туалете   затирка швов', '2_1,2_2,2_3', '38', '7', 1, 1.5, NULL, '4,5', 1, 840.00),
(883, '1', 'шт.', 'Установка ванны с подключением', '2_1,2_2,2_3', '13', NULL, 5, 3.0, NULL, '4', 1, 4000.00),
(884, '1', 'шт.', 'Установка душевой кабины с подключением', '1_1,1_2,1_3,2_1,2_2,2_3', '13', NULL, 5, 5.0, NULL, '4', 1, 5200.00),
(885, '1', 'шт.', 'Установка вентилятора в вытяжку на кухне', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '2', 1, 1000.00),
(886, '2', 'шт.', 'Монтаж запорного(шарового)крана', '2_1,2_2,2_3', NULL, NULL, 5, 0.5, NULL, '5', 1, 696.00),
(887, '1', 'шт.', 'Монтаж встроенного смесителя типа (Hansgrohe-ibox)', '2_3', NULL, NULL, 5, 0.8, NULL, '2,4,5', 1, 2040.00),
(888, '1', 'шт.', 'Монтаж выходов канализации', '2_1,2_2,2_3', NULL, NULL, 5, 1.0, NULL, '2,4,5', 1, 96.00),
(889, '1', 'шт.', 'Замена подводящих кранов', '1_2,1_3', NULL, NULL, 5, 1.0, NULL, '4,5', 1, 360.00),
(890, '1', 'шт.', 'Монтаж инсталляции (туалет,биде)', '2_1,2_2,2_3', NULL, NULL, 5, 3.0, NULL, '5', 1, 3480.00),
(896, '1', 'шт.', 'Монтаж сантехнического люка', '2_1,2_2,2_3', NULL, NULL, 5, 2.0, NULL, '5', 1, 456.00),
(901, '5', 'м.п.', 'Прокладка канализационных труб 110мм', '2_1,2_2,2_3', NULL, NULL, 5, 0.5, NULL, '5', 1, 168.00),
(902, '1', 'м.п.', 'Прокладка канализационных труб 50мм', '2_1,2_2,2_3', NULL, NULL, 5, 0.5, NULL, '2,4,5', 1, 108.00),
(903, '1', 'шт.', 'Установка водонагревателя', '2_2,2_3', NULL, NULL, 5, 2.0, NULL, '4', 1, 660.00),
(904, '2', 'шт.', 'Навес аксессуаров (бумага держ., крючков, вешалок и т.д.)', '1_2,1_3,2_1,2_2,2_3', NULL, NULL, 1, 0.3, NULL, '2,4,5', 1, 240.00),
(905, '2', 'шт.', 'Установка редуктора давления и манометра', '2_2,2_3', NULL, NULL, 5, 0.5, NULL, '5', 1, 1044.00),
(906, '2', 'шт.', 'Установка коллектора в сборе', '2_1,2_2,2_3', NULL, NULL, 5, 1.0, NULL, '5', 1, 1200.00),
(907, '1', 'шт.', 'Установка душ.Штанги', '2_1,2_2,2_3', NULL, NULL, 5, 0.3, NULL, '4', 1, 360.00),
(908, '2', 'шт.', 'Установка самоочищаюещго фильтра очистки воды', '2_2,2_3', NULL, NULL, 5, 1.0, NULL, '5', 1, 2436.00),
(909, '1', 'шт.', 'Установка обратного клапана', '2_2,2_3', NULL, NULL, 5, 0.5, NULL, '4', 1, 360.00),
(910, '1', 'шт.', 'Установка сифона под умывальник', '2_1,2_2,2_3', NULL, NULL, 5, 1.0, NULL, '4', 1, 444.00),
(911, '2', 'шт.', 'Установка счётчика воды', '2_1,2_2,2_3', NULL, NULL, 5, 1.0, NULL, '5', 1, 720.00),
(912, '3', 'м.п.', 'Запил плитки под 45 гр.', '2_3', NULL, NULL, 2, 0.6, NULL, '4,5', 1, 420.00),
(913, 'PW', 'м<sup>2</sup>', 'Затирка плитки', '2_1,2_2,2_3', '28,44', NULL, 1, 0.1, NULL, '4,5', 1, 72.00),
(915, 'P', 'м.п.', 'Укладка элементов бордюра', '2_2,2_3', NULL, NULL, 2, 1.0, NULL, '4,5', 1, 540.00),
(916, '1', 'шт.', 'Монтаж экрана под ванну', '2_1,2_2,2_3', '13', NULL, 2, 1.0, NULL, '4', 1, 900.00),
(917, '6', 'шт.', 'Расчет и монтаж форсунок, лейки(Hansgrohe-ibox)', '2_3', NULL, NULL, 5, 3.0, NULL, '4', 1, 600.00),
(918, '1', 'шт.', 'Установка раздвежных пластиковых штор в ванной', '2_3', '13', NULL, 5, 2.0, NULL, '4', 1, 1200.00),
(919, '1', 'шт.', 'Установка смесителя ванной', '2_1,2_2,2_3', '13', NULL, 5, 0.5, NULL, '4', 1, 960.00),
(920, '1', 'шт.', 'Установка шторки для душа', '1_1,1_2,1_3,2_1,2_2', '13', NULL, 5, 0.5, NULL, '4', 1, 1800.00),
(921, '6', 'шт.', 'Высверливание отверстий под подрозетники', '2_1,2_2,2_3', NULL, NULL, 1, 0.4, NULL, '1,2,3,4', 1, 480.00),
(922, '1', 'точка', 'Подключение силового кабеля к главному щиту.', '2_1,2_2,2_3', NULL, NULL, 4, 1.0, NULL, '3', 1, 480.00),
(923, '1', 'шт.', 'Установка УЗО (устройство защитного отключения)', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '3', 1, 720.00),
(924, '10', 'шт.', 'Установка автомата электрического.', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '3', 1, 540.00),
(925, '1', 'шт.', 'Установка двухполюсного автомата', '2_1,2_2,2_3', NULL, NULL, 4, 0.3, NULL, '3', 1, 240.00),
(926, '1', 'шт.', 'Установка звонка, с кнопкой', '2_1,2_2,2_3', NULL, NULL, 4, 1.0, NULL, '3', 1, 240.00),
(927, '1', 'шт.', 'Установка и подключение терморегулятора теплого пола', '2_2,2_3', NULL, NULL, 4, 1.0, NULL, '2,4,5', 1, 480.00),
(928, '0', 'шт.', 'Установка и подключение светильника настенного, бра.', '1_1,1_2,1_3,2_1,2_2,2_3', NULL, NULL, 0, 1.0, NULL, '1', 1, 960.00),
(929, '6', 'шт.', 'Установка подразетника', '2_1,2_2,2_3', NULL, NULL, 4, 0.2, NULL, '1,2,3,4', 1, 420.00),
(931, '1', 'шт.', 'Установка розетки для электроплиты', '2_1,2_2,2_3', NULL, NULL, 4, 0.2, NULL, '2', 1, 600.00),
(932, '1', 'шт.', 'Установка щита электрического внутреннего, подготовка ниши', '2_2,2_3', NULL, NULL, 4, 2.0, NULL, '3', 1, 4800.00),
(933, '1', 'шт.', 'Установка щита электрического накладного', '2_1', NULL, NULL, 4, 1.0, NULL, '3', 1, 2400.00),
(934, '1', 'шт.', 'Установка электрического счетчика', '2_1,2_2,2_3', NULL, NULL, 4, 0.5, NULL, '3', 1, 960.00),
(935, '1', 'шт.', 'Распайка и монтаж электрощита (Внутренний до 24 модулей)', '2_2', NULL, NULL, 4, 3.0, NULL, '3', 1, 2160.00),
(936, '1', 'шт.', 'Распайка и монтаж электрощита( Внутренний до 36 модулей)', '2_3', NULL, NULL, 4, 4.0, NULL, '3', 1, 2520.00),
(937, '1', 'шт.', 'Распайка и монтаж электрощита( Накладной до 24 модулей)', '2_1', NULL, NULL, 4, 2.0, NULL, '3', 1, 1080.00),
(1008, '0', 'м2', 'Шпаклёвка стен (в 1 слой)', '1_1,1_2,1_3,2_1,2_2,2_3', '32,33,34,35,36,37,38', NULL, NULL, 1.0, NULL, '3', 1, NULL),
(1009, '0', 'м2', 'Шпаклевка потолка (за один слой)', '1_1,1_2,1_3,2_1,2_2,2_3', '27', NULL, NULL, 1.0, NULL, '1', 1, NULL),
(1010, '0', 'м2', 'Монтаж перегородок из гипсокартона (1 слой)', '1_1,1_2,1_3,2_1,2_2,2_3', NULL, NULL, NULL, 1.0, NULL, '1', 1, NULL),
(1011, '0', NULL, 'Монтаж перегородок из гипсокартона', '1_1,1_2,1_3,2_1,2_2,2_3', NULL, NULL, NULL, 1.0, NULL, '1', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `works`
--
ALTER TABLE `works`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name_2` (`name`), ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1012;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
