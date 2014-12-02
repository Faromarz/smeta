ALTER TABLE `work_categories` ADD `img` VARCHAR(64) NULL DEFAULT NULL AFTER `id`;
----------- 25.08.2014 ---
update materials set materials.size = (select size from materials_oboi where materials_oboi.material_id = materials.id) where materials.id = (select id from materials_oboi where materials_oboi.material_id = materials.id);
update materials set materials.size = 1 where materials.category_id = 38;
update materials set materials.size = 1 where materials.size = 0;
UPDATE `materials` SET `count_text`='м<sup>2<sup>, м<sup>2<sup>, м<sup>2<sup>' WHERE `count_text`='м<sup>2<sup>';
----------- 19.11.2014 ---
ALTER TABLE  `cities` ADD  `price_coef` INT( 11 ) NOT NULL DEFAULT  '1' COMMENT  'коэффициент цены';


CREATE TABLE IF NOT EXISTS `partner_cities` (
`id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `partner_works` (
`id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `price_econom` decimal(20,2) DEFAULT NULL,
  `price_standart` decimal(20,2) DEFAULT NULL,
  `price_premium` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `partners` ADD  `director_name` VARCHAR( 100 ) NOT NULL;

------------------------ 30.11.2014
ALTER TABLE `smeta_rooms` ADD `door_enable` BOOLEAN NOT NULL AFTER `materials_enable`;
ALTER TABLE `smeta_doors` DROP `smeta_rooms_id`;
ALTER TABLE `smeta_doors` ADD `is_room` BOOLEAN NOT NULL COMMENT 'Дверь дополнительная или для комнат' ;
------------------------ 30.11.2014