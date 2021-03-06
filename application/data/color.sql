-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 19 2014 г., 23:52
-- Версия сервера: 5.5.38-MariaDB-wsrep
-- Версия PHP: 5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `remont`
--

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE IF NOT EXISTS `color` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=777 DEFAULT CHARSET=utf8 COMMENT='Цвет оттенок';

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`id`, `name`) VALUES
(1, 'Розовый'),
(2, 'Бежевый'),
(3, 'Красный'),
(4, 'Коричневый'),
(5, 'Бежевый, Коричневый'),
(6, 'Желтый'),
(7, 'Фиолетовый'),
(8, 'Зеленый'),
(9, 'Белый'),
(10, 'Коричневый, Черный'),
(11, 'Серо-коричневый'),
(12, 'Бежевый, Серый'),
(13, 'Серый'),
(14, 'Бежевый, Желтый'),
(15, 'Бежевый, Серебро'),
(16, 'Серебро, Черный'),
(17, 'Серо-коричневый, Зеленый'),
(18, 'Коричневый, Бежевый'),
(19, 'Серо-коричневый, Коричневый'),
(20, 'Бежевый, Золото'),
(21, 'Коричневый, Оранжевый'),
(22, 'Коричневый, Красный'),
(23, 'Бежевый, Белый'),
(24, 'Коричневый, Серо-коричневый'),
(25, 'Белый, Серый'),
(26, 'Коричневый, Желтый'),
(27, 'Коричневый, Розовый'),
(28, 'Черный'),
(29, 'Желтый, Коричневый, Серо-коричневый'),
(30, 'Желтый, Коричневый'),
(31, 'Розовый, Коричневый'),
(32, 'Серый, Серо-коричневый'),
(33, 'Желтый, Бежевый'),
(34, 'Красный, Коричневый'),
(35, 'Белый, Бежевый'),
(36, 'Черный, Серый'),
(37, 'Коричневый, Золото'),
(38, 'Красный, Коричневый, Оранжевый'),
(39, 'Розовый, Серо-коричневый'),
(40, 'Серый, Серо-коричневый, Коричневый'),
(41, 'Серо-коричневый, Серый'),
(42, 'Серый, Черный'),
(43, 'Оранжевый, Коричневый'),
(44, 'Коричневый, Фиолетовый'),
(45, 'Розовый, Бежевый'),
(46, 'Серый, Бежевый'),
(47, 'Серо-коричневый, Бежевый'),
(48, 'Бежевый, Серо-коричневый'),
(49, 'Бежевый, Оранжевый'),
(50, 'Серый, Зеленый'),
(51, 'Бежевый, Розовый'),
(52, 'Серый, Розовый'),
(53, 'Золото, Коричневый'),
(54, 'Оранжевый'),
(55, 'Черный, Коричневый'),
(56, 'Розовый, Красный'),
(57, 'Серый, Коричневый'),
(58, 'Коричневый, Серый'),
(59, 'Коричневый, Белый'),
(60, 'Бежевый, Серо-коричневый, Серый'),
(61, 'Серый, Белый'),
(62, 'Синий, Голубой, Желтый, Зеленый, Коричневый'),
(63, 'Золото'),
(64, 'Синий'),
(65, 'Бежевый, Коричневый, Желтый'),
(66, 'Коричневый, Розовый, Красный'),
(67, 'Белый, Бирюзовый'),
(68, 'Красный, Желтый'),
(69, 'Оранжевый, Желтый'),
(70, 'Золото, Желтый'),
(71, 'Красный, Черный'),
(72, 'Бежевый, Белый, Серый'),
(73, 'Бирюзовый'),
(74, 'Серо-коричневый, Коричневый, Бежевый'),
(75, 'Серый, Бежевый, Серо-коричневый'),
(76, 'Желтый, Золото'),
(77, 'Золото, Коричневый, Желтый'),
(78, 'Оранжевый, Бежевый'),
(79, 'Коричневый, Бежевый, Розовый'),
(80, 'Бежевый, Розовый, Красный'),
(81, 'Коричневый, '),
(82, 'Черный, '),
(83, 'Коричневый, Бежевый, '),
(84, 'Бежевый, Коричневый, '),
(85, 'Бежевый, Белый, '),
(86, 'Бежевый, '),
(87, 'Серый, '),
(88, 'Серый, Коричневый, '),
(89, 'Коричневый, Серый, '),
(90, 'Коричневый, Желтый, '),
(91, 'Бежевый, Серый, '),
(92, 'Оранжевый, '),
(93, 'Зеленый, '),
(94, 'Бежевый, Оранжевый, '),
(95, 'Оранжевый, Бежевый, '),
(96, 'Серый, Серо-коричневый, '),
(97, 'Серо-коричневый, Серый, '),
(98, 'Серый, Бежевый, '),
(99, 'Серо-коричневый, Коричневый, '),
(100, 'Бежевый, Розовый, '),
(101, 'Бежевый, Желтый, '),
(102, 'Голубой, '),
(103, 'Синий, '),
(104, 'Бирюзовый, '),
(105, 'Красный, '),
(106, 'Оранжевый, Розовый, '),
(107, 'Желтый, '),
(108, 'Розовый, Оранжевый, '),
(109, 'Голубой, Серый, '),
(110, 'Бирюзовый, Синий, '),
(111, 'Желтый, Бежевый, '),
(112, 'Белый, '),
(113, 'Белый, Серый, '),
(114, 'Фиолетовый, Синий, '),
(115, 'Серый, Голубой, '),
(116, 'Оранжевый, Коричневый, '),
(117, 'Серый, Зеленый, '),
(118, 'Серый, Черный, '),
(119, 'Коричневый, Черный, '),
(120, 'Коричневый, Бежевый, Серый, '),
(121, 'Коричневый, Оранжевый, '),
(122, 'Розовый, Фиолетовый, '),
(123, 'Бирюзовый, Зеленый, '),
(124, 'Белый, Бежевый, '),
(125, 'Голубой, Синий, '),
(126, 'Розовый, '),
(127, 'Желтый, Бирюзовый, '),
(128, 'Серый, Белый, '),
(129, 'Фиолетовый, '),
(130, 'Серый<br />Черный'),
(131, 'Голубой'),
(132, 'Коричневый<br />Оранжевый'),
(133, 'Бежевый<br />Коричневый<br />Оранжевый'),
(134, 'Белый<br />Зеленый'),
(135, 'Коричневый<br />Черный'),
(136, 'Бордово-красный'),
(137, 'Черный<br />Белый'),
(138, 'Бежевый<br />Белый<br />Зеленый, '),
(139, 'Розовый<br />Бежевый'),
(140, 'Черный<br />Серый'),
(141, 'Серебро'),
(142, 'Бежевый<br />Коричневый'),
(143, 'Серый<br />Зеленый'),
(144, 'Бежевый<br />Оранжевый'),
(145, 'Зеленый<br />Серый<br />Золото'),
(146, 'Бежевый<br />Серый'),
(147, 'Розовый<br />Оранжевый'),
(148, 'Коричневый<br />Бежевый'),
(149, 'Белый<br />Бежевый'),
(150, 'Оранжевый<br />Розовый'),
(151, 'Черный<br />Бежевый<br />Коричневый, '),
(152, 'Коричневый<br />Бежевый, '),
(153, 'Черный<br />Белый<br />Коричневый, '),
(154, 'Бежевый<br />Серый, '),
(155, 'Коричневый<br />Оранжевый<br />Серый'),
(156, 'Белый<br />Серый<br />Черный'),
(157, 'Белый<br />Черный<br />Коричневый'),
(158, 'Коричневый<br />Бордово-красный'),
(159, 'Серый<br />Серебро'),
(160, 'Серебро<br />Серый'),
(161, 'Серый<br />Золото'),
(162, 'Бежевый<br />Желтый'),
(163, 'Бирюзовый<br />Серый'),
(164, 'Зеленый<br />Бирюзовый<br />Бежевый'),
(165, 'Серый<br />Коричневый'),
(166, 'Желтый<br />Бордово-красный'),
(167, 'Оранжевый<br />Золото'),
(168, 'Голубой<br />Синий'),
(169, 'Бирюзовый<br />Коричневый'),
(170, 'Бежевый<br />Белый'),
(171, 'Бежевый<br />Розовый<br />Коричневый'),
(172, 'Бежевый<br />Бордово-красный<br />Бирюзовый<br />Коричневый<br />Розовый'),
(173, 'Розовый<br />Бордово-красный'),
(174, 'Белый<br />Бежевый<br />Розовый<br />Зеленый'),
(175, 'Черный<br />Серый<br />Серебро'),
(176, 'Зеленый<br />Белый'),
(177, 'Бежевый<br />Черный'),
(178, 'Бордово-красный<br />Бежевый'),
(179, 'Бежевый<br />Оранжевый<br />Коричневый'),
(180, 'Серый<br />Бежевый<br />Розовый<br />Голубой'),
(181, 'Коричневый<br />Золото<br />Оранжевый'),
(182, 'Бордово-красный<br />Оранжевый'),
(183, 'Оранжевый<br />Бордово-красный'),
(184, 'Коричневый<br />Белый<br />Бежевый'),
(185, 'Голубой<br />Бежевый<br />Белый'),
(186, 'Фиолетовый<br />Розовый'),
(187, 'Бежевый<br />Белый<br />Розовый'),
(188, 'Бежевый<br />Коричневый<br />Черный'),
(189, 'Синий<br />Бежевый'),
(190, 'Оранжевый<br />Коричневый'),
(191, 'Серый<br />Белый<br />Черный'),
(192, 'Черный<br />Бежевый<br />Коричневый'),
(193, 'Бежевый<br />Зеленый'),
(194, 'Коричневый<br />Зеленый<br />Серый'),
(195, 'Белый<br />Коричневый'),
(196, 'Белый<br />Серый'),
(197, 'Бежевый<br />Розовый'),
(198, 'Бежевый<br />Белый<br />Коричневый'),
(199, 'Коричневый<br />Бордово-красный<br />Черный'),
(200, 'Серый<br />Голубой'),
(201, 'Зеленый<br />Голубой'),
(202, 'Зеленый<br />Коричневый'),
(203, 'Бирюзовый<br />Синий'),
(204, 'Фиолетовый<br />Коричневый<br />Розовый'),
(205, 'Бордово-красный<br />Черный<br />Коричневый'),
(206, 'Коричневый<br />Голубой'),
(207, 'Бирюзовый<br />Зеленый'),
(208, 'Белый<br />Бирюзовый'),
(209, 'Черный<br />Фиолетовый'),
(210, 'Фиолетовый<br />Синий'),
(211, 'Оранжевый<br />Желтый'),
(212, 'Черный<br />Коричневый'),
(213, 'Голубой<br />Бежевый'),
(214, 'Зеленый<br />Синий'),
(215, 'Синий<br />Черный'),
(216, 'Синий<br />Фиолетовый'),
(217, 'Белый<br />Золото'),
(218, 'Золото<br />Белый'),
(219, 'Бордово-красный, '),
(220, 'Бирюзовый<br />Черный'),
(221, 'Желтый<br />Бирюзовый'),
(222, 'Голубой<br />Коричневый'),
(223, 'Желтый<br />Коричневый'),
(224, 'Бордово-красный<br />Коричневый<br />Бежевый'),
(225, 'Черный<br />Бирюзовый<br />Коричневый'),
(226, 'Бежевый<br />Черный<br />Коричневый'),
(227, 'Черный<br />Фиолетовый<br />Серый'),
(228, 'Фиолетовый<br />Черный'),
(229, 'Черный<br />Оранжевый'),
(230, 'Белый<br />Серый<br />Серебро'),
(231, 'Голубой<br />Розовый<br />Оранжевый'),
(232, 'Оранжевый<br />Коричневый<br />Серый'),
(233, 'Белый<br />Черный'),
(234, 'Коричневый<br />Бежевый<br />Бирюзовый'),
(235, 'Коричневый<br />Бежевый<br />Белый'),
(236, 'Оранжевый<br />Коричневый<br />Бежевый'),
(237, 'Бежевый<br />Коричневый<br />Зеленый'),
(238, 'Зеленый<br />Бирюзовый'),
(239, 'Коричневый<br />Зеленый'),
(240, 'Бирюзовый<br />Зеленый<br />Серый'),
(241, 'Желтый<br />Бежевый'),
(242, 'Бежевый<br />Серый<br />Коричневый'),
(243, 'Бежевый<br />Белый<br />Серый'),
(244, 'Коричневый<br />Серый<br />Бежевый'),
(245, 'Коричневый<br />Белый'),
(246, 'Коричневый<br />Бежевый<br />Черный'),
(247, 'Зеленый<br />Бежевый'),
(248, 'Золото<br />Бежевый'),
(249, 'Бирюзовый<br />Голубой'),
(250, 'Белый<br />Голубой'),
(251, 'Бирюзовый<br />Коричневый<br />Золото'),
(252, 'Серый<br />Бежевый<br />Розовый'),
(253, 'Серый<br />Бирюзовый<br />Коричневый'),
(254, 'Коричневый<br />Серый<br />Золото'),
(255, 'Коричневый<br />Бежевый<br />Золото'),
(256, 'Золото<br />Желтый'),
(257, 'Белый<br />Серебро<br />Серый'),
(258, 'Оранжевый<br />Золото<br />Коричневый'),
(259, 'Желтый<br />Золото'),
(260, 'Белый<br />Серебро'),
(261, 'Розовый<br />Бордово-красный<br />Оранжевый'),
(262, 'Желтый<br />Оранжевый'),
(263, 'Зеленый<br />Желтый'),
(264, 'Голубой<br />Серый'),
(265, 'Бордово-красный<br />Розовый<br />Оранжевый'),
(266, 'Коричневый<br />Серый<br />Бежевый, '),
(267, 'Белый<br />Серый, '),
(268, 'Коричневый<br />Серый, '),
(269, 'Коричневый<br />Серый'),
(270, 'Коричневый<br />Бирюзовый'),
(271, 'Серый<br />Белый'),
(272, 'Белый<br />Синий, '),
(273, 'Голубой<br />Синий, '),
(274, 'Черный<br />Коричневый<br />Бежевый'),
(275, 'Синий<br />Белый<br />Голубой'),
(276, 'Голубой<br />Белый'),
(277, 'Серый<br />Бежевый'),
(278, 'Синий<br />Серый<br />Голубой'),
(279, 'Синий<br />Золото'),
(280, 'Серый<br />Коричневый<br />Зеленый'),
(281, 'Бежевый<br />Золото'),
(282, 'Бежевый<br />Коричневый<br />Серый<br />Оранжевый'),
(283, 'Бежевый<br />Коричневый<br />Серый'),
(284, 'Бежевый<br />Оранжевый<br />Коричневый<br />Серый'),
(285, 'Желтый<br />Бежевый<br />Серый'),
(286, 'Бежевый<br />Оранжевый<br />Бордово-красный'),
(287, 'Оранжевый<br />Красный'),
(288, 'Бежевый<br />Желтый<br />Оранжевый<br />Коричневый'),
(289, 'Белый<br />Розовый'),
(290, 'Оранжевый<br />Белый<br />Коричневый'),
(291, 'Голубой<br />Белый<br />Синий'),
(292, 'Красный<br />Белый<br />Коричневый'),
(293, 'Оранжевый<br />Бежевый'),
(294, 'Бордово-красный<br />Коричневый'),
(295, 'Коричневый<br />Розовый'),
(296, 'Розовый<br />Белый'),
(297, 'Черный<br />Синий'),
(298, 'Розовый<br />Серый'),
(299, 'Розовый<br />Красный'),
(300, 'Розовый<br />Коричневый'),
(301, 'Розовый<br />Красный<br />Бордово-красный'),
(302, 'Зеленый<br />Бежевый<br />Черный'),
(303, 'Розовый<br />Красный<br />Коричневый'),
(304, 'Бордово-красный<br />Бежевый<br />Розовый'),
(305, 'Розовый<br />Бордово-красный<br />Красный'),
(306, 'Голубой<br />Синий<br />Бежевый'),
(307, 'Голубой<br />Бежевый<br />Синий'),
(308, 'Коричневый<br />Зеленый<br />Оранжевый'),
(309, 'Зеленый<br />Черный'),
(310, 'Коричневый<br />Фиолетовый'),
(311, 'Коричневый<br />Оранжевый, '),
(312, 'Бежевый<br />Оранжевый, '),
(313, 'Коричневый<br />Оранжевый<br />Бежевый, '),
(314, 'Серый<br />Черный, '),
(315, 'Белый<br />Бежевый, '),
(316, 'Бежевый<br />Коричневый, '),
(317, 'Бежевый<br />Белый<br />Розовый, '),
(318, 'Бежевый<br />Бордово-красный<br />Розовый'),
(319, 'Бежевый<br />Белый, '),
(320, 'Зеленый<br />Бирюзовый, '),
(321, 'Бежевый<br />Желтый, '),
(322, 'Серый<br />Зеленый<br />Бордово-красный'),
(323, 'Оранжевый<br />Коричневый, '),
(324, 'Оранжевый<br />Бежевый<br />Коричневый'),
(325, 'Коричневый<br />Оранжевый<br />Бежевый'),
(326, 'Коричневый<br />Серый<br />Черный'),
(327, 'Серый<br />Голубой<br />Синий'),
(328, 'Голубой<br />Синий<br />Бежевый<br />Коричневый<br />Серый'),
(329, 'Голубой<br />Синий<br />Бирюзовый'),
(330, 'Белый<br />Серый<br />Бежевый'),
(331, 'Золото<br />Коричневый'),
(332, 'Коричневый<br />Бордово-красный<br />Серый'),
(333, 'Черный<br />Зеленый<br />Серый<br />Фиолетовый'),
(334, 'Белый<br />Розовый<br />Бежевый<br />Коричневый'),
(335, 'Черный<br />Белый<br />Серый<br />Серебро'),
(336, 'Черный<br />Коричневый<br />Бежевый<br />Розовый'),
(337, 'Бордово-красный<br />Оранжевый<br />Коричневый'),
(338, 'Бордово-красный<br />Коричневый<br />Оранжевый'),
(339, 'Бежевый<br />Белый<br />Коричневый, '),
(340, 'Серый<br />Белый<br />Бежевый<br />Розовый, '),
(341, 'Зеленый<br />Коричневый<br />Бежевый, '),
(342, 'Белый<br />Серый<br />Черный, '),
(343, 'Зеленый<br />Бежевый<br />Коричневый, '),
(344, 'Белый<br />Бежевый<br />Коричневый, '),
(345, 'Зеленый<br />Коричневый<br />Бежевый<br />Серый<br />Черный, '),
(346, 'Белый<br />Серый<br />Серебро, '),
(347, 'Бежевый<br />Серый<br />Коричневый, '),
(348, 'Белый<br />Серый<br />Бежевый<br />Розовый, '),
(349, 'Белый<br />Серый<br />Зеленый, '),
(350, 'Золото<br />Коричневый, '),
(351, 'Бежевый<br />Серый<br />Зеленый<br />Голубой<br />Синий<br />Коричневый, '),
(352, 'Бежевый<br />Коричневый<br />Белый<br />Золото<br />Голубой, '),
(353, 'Зеленый<br />Бежевый<br />Оранжевый'),
(354, 'Бежевый<br />Зеленый<br />Оранжевый'),
(355, 'Оранжевый<br />Бежевый<br />Зеленый'),
(356, 'Бежевый<br />Коричневый<br />Синий'),
(357, 'Бежевый<br />Синий<br />Оранжевый<br />Коричневый'),
(358, 'Белый<br />Серый<br />Бежевый, '),
(359, 'Черный<br />Белый<br />Серый<br />Коричневый, '),
(360, 'Черный<br />Белый<br />Серый<br />Фиолетовый, '),
(361, 'Бежевый<br />Красный, '),
(362, 'Синий<br />Золото, '),
(363, 'Оранжевый<br />Красный, '),
(364, 'Белый<br />Голубой<br />Коричневый, '),
(365, 'Белый<br />Синий<br />Желтый, '),
(366, 'Коричневый<br />Зеленый<br />Черный'),
(367, 'Белый<br />Оранжевый'),
(368, 'Серый<br />Голубой<br />Оранжевый'),
(369, 'Оранжевый<br />Черный<br />Коричневый'),
(370, 'Серый<br />Голубой<br />Бежевый'),
(371, 'Белый<br />Черный<br />Желтый<br />Розовый<br />Оранжевый<br />Голубой<br />Зеленый<br />Синий'),
(372, 'Белый<br />Черный<br />Желтый'),
(373, 'Черный<br />Бежевый<br />Зеленый'),
(374, 'Черный<br />Золото, '),
(375, 'Розовый<br />Бежевый<br />Коричневый, '),
(376, 'Бежевый<br />Розовый, '),
(377, 'Розовый<br />Фиолетовый, '),
(378, 'Красный<br />Коричневый, '),
(379, 'Бежевый<br />Коричневый<br />Серый, '),
(380, 'Коричневый<br />Бежевый<br />Желтый'),
(381, 'Голубой<br />Серый, '),
(382, 'Оранжевый<br />Черный<br />Белый'),
(383, 'Черный<br />Коричневый<br />Серый'),
(384, 'Бордово-красный<br />Белый'),
(385, 'Красный<br />Коричневый'),
(386, 'Коричневый<br />Красный<br />Оранжевый'),
(387, 'Коричневый<br />Черный<br />Бежевый'),
(388, 'Оранжевый<br />Бордово-красный<br />Коричневый, '),
(389, 'Оранжевый<br />Желтый, '),
(390, 'Бежевый<br />Серый<br />Белый, '),
(391, 'Коричневый<br />Оранжевый<br />Черный'),
(392, 'Коричневый<br />Желтый'),
(393, 'Желтый<br />Зеленый'),
(394, 'Золото<br />Оранжевый<br />Бежевый'),
(395, 'Коричневый<br />Красный'),
(396, 'Золото<br />Бежевый, '),
(397, 'Бежевый<br />Золото, '),
(398, 'Серый<br />Коричневый, '),
(399, 'Черный<br />Белый, '),
(400, 'Белый<br />Желтый, '),
(401, 'Коричневый<br />Желтый, '),
(402, 'Серый<br />Розовый'),
(403, 'Черный<br />Коричневый<br />Серый, '),
(404, 'Бордово-красный<br />Зеленый'),
(405, 'Серый<br />Бежевый, '),
(406, 'Коричневый<br />Бордово-красный<br />Оранжевый'),
(407, 'Оранжевый<br />Бордово-красный<br />Коричневый'),
(408, 'Коричневый<br />Оранжевый<br />Белый<br />Черный<br />Серый'),
(409, 'Черный<br />Бежевый, '),
(410, 'Коричневый<br />Бежевый<br />Синий, '),
(411, 'Бежевый<br />Коричневый<br />Оранжевый, '),
(412, 'Серый<br />Бежевый<br />Коричневый, '),
(413, 'Бежевый<br />Коричневый<br />Синий, '),
(414, 'Бордово-красный<br />Серый, '),
(415, 'Бежевый<br />Оранжевый<br />Выбеленый'),
(416, 'Золотой<br />Бежевый'),
(417, 'Выбеленый'),
(418, 'Бежевый<br />Выбеленый<br />Металлик'),
(419, 'Бежевый<br />Серебристый'),
(420, 'Выбеленый<br />Бежевый<br />Белый'),
(421, 'Красный<br />Оранжевый'),
(422, 'Белый<br />Выбеленый'),
(423, 'Бежевый<br />Золотой'),
(424, 'Коричневый<br />Золотой'),
(425, 'Коричневый<br />Бордовый'),
(426, 'Бежевый<br />Металлик'),
(427, 'Бежевый<br />Выбеленый'),
(428, 'Бежевый<br />Коричневый<br />Золотой'),
(429, 'Серый<br />Золотой<br />Белый'),
(430, 'Оранжевый<br />Бордовый<br />Коричневый'),
(431, 'Золотой<br />Коричневый'),
(432, 'Золотой<br />Оранжевый'),
(433, 'Золотой<br />Желтый'),
(434, 'Золотой<br />Бежевый<br />Коричневый'),
(435, 'Бордовый'),
(436, 'Оранжевый<br />Золотой'),
(437, 'Золотой<br />Коричневый<br />Оранжевый'),
(438, 'Белый<br />Бежевый<br />Выбеленый'),
(439, 'Бордовый<br />Красный'),
(440, 'Коричневый<br />Бордовый<br />Красный<br />Оранжевый'),
(441, 'Серебристый'),
(442, 'Коричневый<br />Красный<br />Бордовый'),
(443, 'Выбеленый<br />Бежевый'),
(444, 'Золотой<br />Красный<br />Коричневый'),
(445, 'Бежевый<br />Серый<br />Выбеленый'),
(446, 'Бежевый<br />Белый<br />Выбеленый'),
(447, 'Золотой<br />Коричневый<br />Желтый'),
(448, 'Выбеленый<br />Белый'),
(449, 'Серый<br />Выбеленый'),
(450, 'Золотой'),
(451, 'Коричневый<br />Серебристый'),
(452, 'Бежевый<br />Коричневый<br />Желтый<br />Золотой'),
(453, 'Бордовый<br />Коричневый'),
(454, 'Серый<br />Серебристый<br />Выбеленый'),
(455, 'Серебристый<br />Серый'),
(456, 'Серый<br />Коричневый<br />Бежевый'),
(457, 'Золотой<br />Розовый<br />Красный'),
(458, 'Коричневый<br />Выбеленый'),
(459, 'Бежевый<br />Красный'),
(460, 'Бежевый<br />Белый<br />Голубой<br />Выбеленый'),
(461, 'Золотой<br />Желтый<br />Коричневый'),
(462, 'Серый<br />Золотой'),
(463, 'Красный<br />Бордовый<br />Коричневый'),
(464, 'Бордовый<br />Золотой'),
(465, 'Бежевый<br />Коричневый<br />Серебристый'),
(466, 'Серебристый<br />Металлик<br />Коричневый'),
(467, 'Бежевый<br />Серый<br />Серебристый'),
(468, 'Черный<br />Металлик'),
(469, 'Серебристый<br />Бежевый'),
(470, 'Бежевый<br />Белый<br />Серебристый'),
(471, 'Бордовый<br />Красный<br />Коричневый'),
(472, 'Серый<br />Серебристый<br />Золотой'),
(473, 'Коричневый<br />Черный<br />Желтый'),
(474, 'Коричневый<br />Выбеленый<br />Красный'),
(475, 'Бежевый<br />Розовый<br />Серый'),
(476, 'Коричневый<br />Металлик'),
(477, 'Красный<br />Оранжевый<br />Коричневый'),
(478, 'Оранжевый<br />Розовый<br />Бежевый'),
(479, 'Черный<br />Выбеленый'),
(480, 'Бежевый<br />Коричневый<br />Розовый'),
(481, 'Бордовый<br />Коричневый<br />Красный'),
(482, 'Коричневый<br />Розовый<br />Красный'),
(483, 'Выбеленый<br />Желтый'),
(484, 'Белый<br />Коричневый<br />Выбеленый'),
(485, 'Бежевый<br />Бордовый<br />Розовый'),
(486, 'Серебристый<br />Металлик<br />Белый'),
(487, 'Белый<br />Розовый<br />Бежевый'),
(488, 'Коричневый<br />Черный<br />Бордовый'),
(489, 'Черный<br />Серый<br />Коричневый'),
(490, 'Коричневый<br />Розовый<br />Черный'),
(491, 'Бежевый<br />Золотой<br />Розовый'),
(492, 'Коричневый<br />Бежевый<br />Бордовый'),
(493, 'Коричневый<br />Черный<br />Металлик'),
(494, 'Бежевый<br />Белый<br />Зеленый<br />Розовый'),
(495, 'Голубой<br />Белый<br />Серый<br />Розовый'),
(496, 'Белый<br />Зеленый<br />Голубой<br />Оранжевый'),
(497, 'Белый<br />Зеленый<br />Оранжевый<br />Голубой'),
(498, 'Белый<br />Голубой<br />Зеленый'),
(499, 'Белый<br />Голубой<br />Синий<br />Зеленый'),
(500, 'Белый<br />Зеленый<br />Голубой<br />Розовый'),
(501, 'Белый<br />Зеленый<br />Розовый<br />Синий'),
(502, 'Белый<br />Зеленый<br />Голубой<br />Фиолетовый'),
(503, 'Зеленый<br />Белый<br />Голубой'),
(504, 'Синий<br />Оранжевый<br />Красный<br />Фиолетовый'),
(505, 'Белый<br />Зеленый<br />Оранжевый'),
(506, 'Зеленый<br />Оранжевый<br />Голубой<br />Красный'),
(507, 'Белый<br />Серый<br />Синий'),
(508, 'Белый<br />Серый<br />Голубой'),
(509, 'Белый<br />Зеленый<br />Красный<br />Голубой'),
(510, 'Белый<br />Голубой<br />Зеленый<br />Желтый'),
(511, 'Белый<br />Зеленый<br />Розовый'),
(512, 'Голубой<br />Зеленый<br />Розовый'),
(513, 'Белый<br />Голубой<br />Красный'),
(514, 'Синий<br />Оранжевый<br />Розовый'),
(515, 'Серый<br />Желтый<br />Розовый'),
(516, 'Зеленый<br />Голубой<br />Желтый'),
(517, 'Розовый<br />Желтый<br />Фиолетовый<br />Зеленый'),
(518, 'Белый<br />Зеленый<br />Голубой<br />Желтый'),
(519, 'Розовый<br />Голубой<br />Желтый<br />Зеленый'),
(520, 'Белый<br />Фиолетовый'),
(521, 'Белый<br />Синий'),
(522, 'Зеленый<br />Розовый'),
(523, 'Белый<br />Синий<br />Зеленый'),
(524, 'Белый<br />Фиолетовый<br />Розовый'),
(525, 'Белый<br />Зеленый<br />Синий'),
(526, 'Белый<br />Зеленый<br />Синий<br />Розовый'),
(527, 'Белый<br />Зеленый<br />Голубой'),
(528, 'Желтый<br />Голубой<br />Красный<br />Оранжевый'),
(529, 'Белый<br />Серый<br />Зеленый'),
(530, 'Белый<br />Оранжевый<br />Зеленый'),
(531, 'Белый<br />Оранжевый<br />Синий<br />Желтый'),
(532, 'Синий<br />Серый'),
(533, 'Фиолетовый<br />Бежевый'),
(534, 'Бордовый<br />Оранжевый<br />Белый'),
(535, 'Бордовый<br />Бежевый'),
(536, 'Черный<br />Серебристый'),
(537, 'Красный<br />Золотой'),
(538, 'Бежевый<br />Фиолетовый'),
(539, 'Серый<br />Синий'),
(540, 'Бежевый<br />Бордовый'),
(541, 'Белый<br />Красный<br />Бежевый'),
(542, 'Белый<br />Серый<br />Желтый'),
(543, 'Белый<br />Голубой<br />Желтый'),
(544, 'Белый<br />Бежевый<br />Серый'),
(545, 'Белый<br />Красный<br />Серый'),
(546, 'Белый<br />Красный'),
(547, 'Бежевый<br />Розовый<br />Желтый'),
(548, 'Белый<br />Розовый<br />Серый'),
(549, 'Белый<br />Желтый'),
(550, 'Белый<br />Желтый<br />Розовый'),
(551, 'Белый<br />Коричневый<br />Серый'),
(552, 'Розовый<br />Желтый<br />Белый'),
(553, 'Белый<br />Желтый<br />Голубой<br />Розовый'),
(554, 'Серый<br />Белый<br />Желтый'),
(555, 'Красный<br />Черный'),
(556, 'Оранжевый<br />Серый'),
(557, 'Бежевый<br />Голубой'),
(558, 'Синий<br />Белый'),
(559, 'Серый<br />Оранжевый'),
(560, 'Желтый<br />Синий'),
(561, 'Голубой<br />Розовый'),
(562, 'Розовый<br />Голубой'),
(563, 'Черный<br />Розовый'),
(564, 'Розовый<br />Фиолетовый'),
(565, 'Золотой<br />Бордовый'),
(566, 'Синий<br />Золотой'),
(567, 'Белый<br />Золотой'),
(568, 'Белый<br />Бежевый<br />Коричневый'),
(569, 'Белый<br />Черный<br />Розовый'),
(570, 'Белый<br />Бордовый'),
(571, 'Черный<br />Бежевый'),
(572, 'Черный<br />Бежевый<br />Розовый'),
(573, 'Красный<br />Белый'),
(574, 'Черный<br />Серый<br />Золотой'),
(575, 'Серый<br />Серебристый'),
(576, 'Желтый<br />Золотой'),
(577, 'Синий<br />Коричневый'),
(578, 'Зеленый<br />Серый'),
(579, 'Серый<br />Желтый'),
(580, 'Серый<br />Фиолетовый'),
(581, 'Бежевый<br />Красный<br />Золотой'),
(582, 'Бежевый<br />Синий'),
(583, 'Серый<br />Бордовый'),
(584, 'Бежевый<br />Золотой<br />Зеленый'),
(585, 'Желтый<br />Белый'),
(586, 'Фиолетовый<br />Серый'),
(587, 'Голубой<br />Коричневый<br />Бежевый'),
(588, 'Белый<br />Зеленый<br />Фиолетовый'),
(589, 'Белый<br />Зеленый<br />Желтый'),
(590, 'Белый<br />Зеленый<br />Бордовый'),
(591, 'Желтый<br />Серый'),
(592, 'Серый<br />Зеленый<br />Фиолетовый'),
(593, 'Черный<br />Зеленый'),
(594, 'Зеленый<br />Бордовый'),
(595, 'Фиолетовый<br />Белый'),
(596, 'Зеленый<br />Фиолетовый'),
(597, 'Черный<br />Красный'),
(598, 'Бежевый<br />Желтый<br />Серый'),
(599, 'Голубой<br />Зеленый'),
(600, 'Серебристый<br />Черный'),
(601, 'Золотой<br />Голубой'),
(602, 'Бежевый<br />Коричневый<br />Серый<br />Черный'),
(603, 'Белый<br />Серебристый'),
(604, 'Черный<br />Серый<br />Серебристый'),
(605, 'Белый<br />Серебристый<br />Серый'),
(606, 'Бордовый<br />Красный<br />Коричневый<br />Золотой'),
(607, 'Розовый<br />Бордовый'),
(608, 'Бордовый<br />Розовый'),
(609, 'Бордовый<br />Серый'),
(610, 'Синий<br />Серебристый'),
(611, 'Золотой<br />Красный'),
(612, 'Коричневый<br />Синий'),
(613, 'Черный<br />Золотой'),
(614, 'Красный<br />Бежевый'),
(615, 'Синий<br />Голубой'),
(616, 'Голубой<br />Золотой'),
(617, 'Золотой<br />Фиолетовый'),
(618, 'Бежевый<br />Серый<br />Фиолетовый'),
(619, 'Бежевый<br />Серебристый<br />Серый'),
(620, 'Бежевый<br />Серый<br />Золотой'),
(621, 'Бежевый<br />Розовый<br />Серебристый'),
(622, 'Бежевый<br />Голубой<br />Серебристый'),
(623, 'Бежевый<br />Золотой<br />Серебристый'),
(624, 'Желтый<br />Розовый'),
(625, 'Бежевый<br />Коричневый<br />Голубой'),
(626, 'Синий<br />Коричневый<br />Голубой'),
(627, 'Голубой<br />Серебристый'),
(628, 'Серебристый<br />Белый<br />Голубой'),
(629, 'Золотой<br />Серый'),
(630, 'Серебристый<br />Золотой'),
(631, 'Красный<br />Оранжевый<br />Фиолетовый<br />Желтый'),
(632, 'Оранжевый<br />Зеленый'),
(633, 'Бордовый<br />Фиолетовый<br />Белый'),
(634, 'Красный<br />Серебристый'),
(635, 'Серебристый<br />Голубой'),
(636, 'Серебристый<br />Коричневый'),
(637, 'Красный<br />Серый<br />Серебристый'),
(638, 'Красный<br />Бордовый'),
(639, 'Серебристый<br />Белый'),
(640, 'Голубой<br />Зеленый<br />Красный'),
(641, 'Бежевый<br />Зеленый<br />Розовый'),
(642, 'Бежевый<br />Зеленый<br />Серый'),
(643, 'Бежевый<br />Зеленый<br />Голубой'),
(644, 'Бежевый<br />Черный<br />Золотой'),
(645, 'Желтый<br />Серебристый'),
(646, 'Фиолетовый<br />Золотой'),
(647, 'Серый<br />Красный'),
(648, 'Серый<br />Фиолетовый<br />Золотой'),
(649, 'Серый<br />Белый<br />Серебристый'),
(650, 'Серый<br />Золотой<br />Оранжевый'),
(651, 'Серый<br />Золотой<br />Красный'),
(652, 'Серый<br />Золотой<br />Фиолетовый'),
(653, 'Бежевый<br />Золотой<br />Коричневый'),
(654, 'Бежевый<br />Зеленый<br />Желтый'),
(655, 'Бежевый<br />Серый<br />Зеленый'),
(656, 'Бежевый<br />Красный<br />Серебристый'),
(657, 'Зеленый<br />Розовый<br />Бежевый'),
(658, 'Красный<br />Розовый<br />Бежевый'),
(659, 'Красный<br />Серебристый<br />Золотой'),
(660, 'Бежевый<br />Белый<br />Зеленый'),
(661, 'Розовый<br />Бежевый<br />Коричневый'),
(662, 'Бежевый<br />Оранжевый<br />Розовый'),
(663, 'Бежевый<br />Розовый<br />Зеленый'),
(664, 'Бежевый<br />Белый<br />Красный'),
(665, 'Золотой<br />Серебристый'),
(666, 'Бежевый<br />Коричневый<br />Красный'),
(667, 'Бежевый<br />Фиолетовый<br />Зеленый'),
(668, 'Бежевый<br />Красный<br />Розовый'),
(669, 'Коричневый<br />Золото'),
(670, 'Черный<br />Серый<br />Коричневый, '),
(671, 'Бежевый<br />Серый<br />Оранжевый'),
(672, 'Коричневый<br />Розовый, '),
(673, 'Бежевый<br />Серый<br />Оранжевый<br />Коричневый'),
(674, 'Бордово-красный<br />Желтый'),
(675, 'Золото<br />Бордово-красный'),
(676, 'Сталь полированная, '),
(677, 'белый глянцевый'),
(678, 'чёрный глянцевый'),
(679, 'чёрный матовый'),
(680, 'Черно-белый'),
(681, 'Хром, '),
(682, 'Хром'),
(683, 'Хром<br />Электро, '),
(684, 'Хром<br />Белый, '),
(685, 'Colorado, '),
(686, 'графит'),
(687, 'Темно-бежевый<br />Бежевый<br />Розовый<br />Черный<br />Коричневый<br />Светло-серый<br />Зеленый'),
(688, 'Жасмин<br />Мокко<br />Грей<br />Шампань<br />Крем<br />Антрацит<br />Мулена<br />Коньяк'),
(689, 'Мокко<br />Жасмин<br />Грей<br />Шампань<br />Крем<br />Антрацит<br />Мулена<br />Коньяк'),
(690, 'Жасмин<br />Мокко<br />Грей<br />Шампань<br />Крем<br />Антрацит<br />Мулена<br />Коньяк, '),
(691, 'Темно-бежевый<br />Бежевый<br />Розовый<br />Черный<br />Коричневый<br />Светло-серый<br />Зеленый, '),
(692, 'хром глянцевый'),
(693, 'Бронза, '),
(694, 'Золото, '),
(695, 'Салатовый'),
(696, 'Антрацит'),
(697, 'Белый глянец'),
(698, 'Жемчужно-серый глянец'),
(699, 'Белый дуб'),
(700, 'Красный Бриллиант'),
(701, 'Карри'),
(702, 'Белый бриллиант, '),
(703, 'алюминий/хром'),
(704, 'бел/хром, '),
(705, 'серо-серебрянный'),
(706, 'серый акрил'),
(707, 'алюминий'),
(708, 'Бронза'),
(709, 'Бордово-красный<br />Черный'),
(710, 'Бежевый<br />Бордово-красный'),
(711, 'Оранжевый<br />Розовый<br />Коричневый'),
(712, 'Розовый<br />Коричневый, '),
(713, 'Коричневый<br />Черный, '),
(714, 'Коричневый<br />Черный<br />Серый'),
(715, 'Бордово-красный<br />Коричневый, '),
(716, 'Черный<br />'),
(717, 'Серый<br />Синий, '),
(718, 'Желтый<br />Бежевый, '),
(719, 'Голубой<br />Бирюзовый, '),
(720, 'Бежевый<br />Бирюзовый, '),
(721, 'Оранжевый<br />Бежевый, '),
(722, 'Розовый<br />Бежевый, '),
(723, 'Голубой<br />Бежевый, '),
(724, 'Черный<br />Серый, '),
(725, 'Оранжевый<br />Коричневый<br />Бежевый, '),
(726, 'Белый<br />Бордово-красный, '),
(727, 'Белый<br />Черный, '),
(728, 'Бежевый<br />Черный, '),
(729, 'Желтый<br />Синий, '),
(730, 'Бежевый<br />Зеленый, '),
(731, 'Бежевый<br />Бордово-красный, '),
(732, 'Зеленый<br />Серый<br />Бежевый'),
(733, 'Серый<br />Черный<br />Бежевый'),
(734, 'Серый<br />Желтый<br />Бежевый'),
(735, 'Бежевый<br />Серый<br />Черный'),
(736, 'Оранжевый<br />Коричневый<br />Бордово-красный'),
(737, 'Зеленый<br />Черный<br />Серый'),
(738, 'Зеленый<br />Бежевый<br />Серый'),
(739, 'Оранжевый<br />Розовый<br />Серый'),
(740, 'Белый<br />Голубой, '),
(741, 'Бежевый<br />Голубой, '),
(742, 'Красный<br />Бордово-красный, '),
(743, 'Белый<br />Бежевый<br />Серый, '),
(744, 'Серебро, '),
(745, 'Серый<br />Белый<br />Розовый, '),
(746, 'Серый<br />Белый, '),
(747, 'Белый<br />Серый<br />Синий, '),
(748, 'Белый<br />Розовый, '),
(749, 'Зеленый<br />Серый, '),
(750, 'Красный<br />Золото<br />Розовый, '),
(751, 'Розовый<br />Бежевый<br />Золото, '),
(752, 'Розовый<br />Красный, '),
(753, 'Серебро<br />Коричневый, '),
(754, 'Белый<br />Зеленый, '),
(755, 'Белый<br />Серый<br />Розовый, '),
(756, 'Красный<br />Оранжевый, '),
(757, 'Черный<br />Коричневый, '),
(758, 'Белый<br />Серый<br />Коричневый, '),
(759, 'Белый<br />Бежевый<br />Оранжевый, '),
(760, 'Бежевый<br />Зеленый<br />Коричневый, '),
(761, 'Белый<br />Коричневый, '),
(762, 'Красный<br />Коричневый<br />Бежевый, '),
(763, 'Бежевый<br />Желтый<br />Коричневый, '),
(764, 'Бирюзовый<br />Голубой, '),
(765, 'Бежевый<br />Голубой<br />Розовый, '),
(766, 'Розовый<br />Серый, '),
(767, 'Голубой<br />Фиолетовый<br />Бежевый, '),
(768, 'Синий<br />Белый<br />Желтый<br />Зеленый<br />Коричневый, '),
(769, 'Синий<br />Белый<br />Желтый<br />Зеленый, '),
(770, 'Синий<br />Белый<br />Зеленый<br />Оранжевый, '),
(771, 'Синий<br />Белый<br />Зеленый<br />Желтый, '),
(772, 'Коричневый<br />Белый<br />Зеленый<br />Оранжевый, '),
(773, 'Синий<br />Белый<br />Зеленый<br />Желтый<br />Бордово-красный, '),
(774, 'Белый<br />Синий<br />Зеленый<br />Бордово-красный<br />Желтый, '),
(775, 'Серый<br />Белый<br />Бежевый, '),
(776, 'Коричневый<br />Бордово-красный, ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `color`
--
ALTER TABLE `color`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=777;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
