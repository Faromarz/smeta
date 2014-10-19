-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 19 2014 г., 20:10
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
-- Структура таблицы `laminat`
--

CREATE TABLE IF NOT EXISTS `material_params` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `material_id` int(10) unsigned NOT NULL,
  `type_len` varchar(127) DEFAULT NULL COMMENT 'тип',
  `art` varchar(255) DEFAULT NULL COMMENT 'артикул',
  `manuf_id` int(10) DEFAULT NULL COMMENT 'Производитель',
  `colection_id` int(10) DEFAULT NULL COMMENT 'Коллекция',
  `country_id` int(10) DEFAULT NULL COMMENT 'Страна',
  `country_manuf_id` int(10) DEFAULT NULL COMMENT 'страна производитель',
  `class` int(2) DEFAULT NULL,
  `thic` double(3,1) DEFAULT NULL COMMENT 'толщина',
  `thic_all` varchar(64) DEFAULT NULL COMMENT 'Общая толщина',
  `thic_zad` varchar(63) DEFAULT NULL COMMENT 'Толщина защитного слоя',
  `roll_width` varchar(63) DEFAULT NULL COMMENT 'Ширина рулона (м)',
  `roll_long` varchar(63) DEFAULT NULL COMMENT 'Длина рулона (м):',
  `rate` varchar(63) DEFAULT NULL COMMENT 'Норма отпуска',
  `flam` varchar(63) DEFAULT NULL COMMENT 'Класс горючести',
  `type_diz` varchar(63) DEFAULT NULL COMMENT 'Тип дизайна:',
  `design_id` int(10) DEFAULT NULL COMMENT 'Дизайн',
  `type_wood_id` int(10) DEFAULT NULL COMMENT 'Порода дерева',
  `color_id` int(10) DEFAULT NULL COMMENT 'Цвет',
  `count_line` varchar(125) DEFAULT NULL COMMENT 'Количество полос',
  `fasca` varchar(255) DEFAULT NULL COMMENT 'Фаска',
  `dimens` varchar(255) DEFAULT NULL COMMENT 'Габариты Д*ш*в',
  `pasc` varchar(63) DEFAULT NULL COMMENT 'В упаковке',
  `tara_mass` varchar(63) DEFAULT NULL COMMENT 'Вес упаковки',
  `tara_vol` varchar(63) DEFAULT NULL COMMENT 'обьем укаповки',
  `moise` varchar(125) DEFAULT NULL COMMENT 'Влагостойкость',
  `palleta` varchar(255) DEFAULT NULL COMMENT 'паплета',
  `density` varchar(255) DEFAULT NULL,
  `materia` varchar(255) DEFAULT NULL COMMENT 'Материал',
  `element` varchar(255) DEFAULT NULL COMMENT 'Элементы',
  `finct` varchar(255) DEFAULT NULL COMMENT 'Назначение',
  `view` varchar(255) DEFAULT NULL COMMENT 'Вид плитки',
  `thic_cm` varchar(255) DEFAULT NULL COMMENT 'Размер (см)',
  `struct` varchar(255) DEFAULT NULL COMMENT 'Структура поверхности',
  `styl` varchar(255) DEFAULT NULL COMMENT 'Стил',
  `gama` varchar(255) DEFAULT NULL COMMENT 'Цветовая гамма',
  `type_prob` varchar(255) DEFAULT NULL COMMENT 'тип укладки',
  `pocr` varchar(255) DEFAULT NULL COMMENT 'Покрытие',
  `dimens_1` varchar(255) DEFAULT NULL COMMENT 'Размер (Д х Ш х В)',
  `dres` varchar(255) DEFAULT NULL COMMENT 'Досок в упаковке',
  `selekc` varchar(255) DEFAULT NULL COMMENT 'Селекция',
  `tver` varchar(255) DEFAULT NULL COMMENT 'Твердость по Бринеллю',
  `view_ob` varchar(255) DEFAULT NULL COMMENT 'Вид обработки',
  `pol_top` varchar(255) DEFAULT NULL COMMENT 'Толщина верхнего слоя (мм)',
  `dress` varchar(255) DEFAULT NULL COMMENT 'Размер доски (мм):	',
  `dress_count` varchar(255) DEFAULT NULL COMMENT 'Досок в упаковке :',
  `siz` varchar(255) DEFAULT NULL COMMENT 'размер',
  `cou` varchar(255) DEFAULT NULL COMMENT 'Кол-во',
  `ob_yp` varchar(255) DEFAULT NULL COMMENT 'Объем упаковки, м.куб.',
  `pyt_s` varchar(255) DEFAULT NULL COMMENT 'Тип соединения',
  `tolsch` varchar(255) DEFAULT NULL COMMENT 'По толщине (мм)',
  `new` varchar(255) DEFAULT NULL COMMENT 'Новинка',
  `modul_in` varchar(255) DEFAULT NULL COMMENT 'Модулей в упаковке',
  `modul_siz` varchar(255) DEFAULT NULL COMMENT 'Размер модуля (мм)',
  `wid` varchar(255) DEFAULT NULL COMMENT 'Ширина (м)',
  `lon` varchar(255) DEFAULT NULL COMMENT 'Длина (м)',
  `pl` varchar(255) DEFAULT NULL COMMENT 'Площадь (м.кв.):',
  `pom` varchar(255) DEFAULT NULL COMMENT 'помещение',
  `fac` varchar(255) DEFAULT NULL COMMENT 'Фактура:',
  `r_img` varchar(255) DEFAULT NULL COMMENT 'Размер рисунка:',
  `t_m` varchar(255) DEFAULT NULL COMMENT 'Тип материала',
  `coun_yp` varchar(255) DEFAULT NULL COMMENT 'Кол-во в упаковке',
  `im` varchar(255) DEFAULT NULL COMMENT 'Рисунок',
  `cod` varchar(255) DEFAULT NULL COMMENT 'код товара',
  `thic_mm` varchar(255) DEFAULT NULL COMMENT 'Размер, мм',
  `pov` varchar(255) DEFAULT NULL COMMENT 'Поверхность',
  `dec` varchar(255) DEFAULT NULL COMMENT 'Декор',
  `vt` varchar(255) DEFAULT NULL COMMENT 'Мощность, Вт:',
  `sekc` varchar(255) DEFAULT NULL COMMENT 'Кол-во секций',
  `countru_br` varchar(255) DEFAULT NULL COMMENT 'Страна бренда',
  `r_w` varchar(255) DEFAULT NULL COMMENT 'Режимы работы',
  `m_oh` varchar(255) DEFAULT NULL COMMENT 'Мощность охлаждения (кВт',
  `m_ob` varchar(255) DEFAULT NULL COMMENT 'Мощность обогрева (кВт)',
  `ser` varchar(255) DEFAULT NULL COMMENT 'Серия',
  `pl_p` int(10) DEFAULT NULL COMMENT 'Площадь помещения (до кв.м.):',
  `u_csh` varchar(255) DEFAULT NULL COMMENT 'Уровень шума (внутр. блок), дБ',
  `u_csh_v` varchar(255) DEFAULT NULL COMMENT 'Уровень шума (внешн. блок), дБ',
  `kvt` varchar(255) DEFAULT NULL COMMENT 'Потребляемая мощность, кВт',
  `p_vz` varchar(255) DEFAULT NULL COMMENT 'Производительность по воздуху, м3/ч:',
  `v_t` int(10) DEFAULT NULL COMMENT 'Напряжение питания, В',
  `grt_vn` varchar(255) DEFAULT NULL COMMENT 'Габариты, Ш?В?Г (внутр. блок), мм:',
  `grt_n` varchar(255) DEFAULT NULL COMMENT 'Габариты, Ш?В?Г (внешн. блок), мм',
  `m_v_b` varchar(255) DEFAULT NULL COMMENT 'Масса (внутр. блок), кг:',
  `m_n_b` varchar(255) DEFAULT NULL COMMENT 'Масса (внешн. блок), кг',
  `compl` varchar(255) DEFAULT NULL COMMENT 'Комплектация:',
  `vid_u` varchar(255) DEFAULT NULL COMMENT 'Вид установки',
  `long` varchar(255) DEFAULT NULL COMMENT 'Длина (мм)',
  `widh` varchar(255) DEFAULT NULL COMMENT 'Ширина (мм)',
  `hid` varchar(255) DEFAULT NULL COMMENT 'Высота (мм)',
  `val` varchar(255) DEFAULT NULL COMMENT 'Объем (л)',
  `form` varchar(255) DEFAULT NULL COMMENT 'Форма',
  `widh_` varchar(255) DEFAULT NULL COMMENT 'Ширина, мм',
  `hid_` varchar(255) DEFAULT NULL COMMENT 'Высота, мм',
  `gl` varchar(255) DEFAULT NULL COMMENT 'Глубина, мм',
  `view_m` varchar(255) DEFAULT NULL COMMENT 'Вид монтажа',
  `otv` varchar(255) DEFAULT NULL COMMENT 'Отверстие под смеситель',
  PRIMARY KEY (`id`),
  KEY `products_id` (`products_id`,`manuf_id`,`colection_id`,`countru_id`,`countru_manuf_id`,`design_id`,`type_id`,`color_id`),
  KEY `manuf_id` (`manuf_id`),
  KEY `countru_id` (`countru_id`,`countru_manuf_id`),
  KEY `countru_manuf_id` (`countru_manuf_id`),
  KEY `colection_id` (`colection_id`),
  KEY `design_id` (`design_id`),
  KEY `type_id` (`type_id`),
  KEY `color_id` (`color_id`),
  KEY `type` (`type`),
  KEY `room` (`room`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27471 ;
