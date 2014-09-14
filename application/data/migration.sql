ALTER TABLE `work_categories` ADD `img` VARCHAR(64) NULL DEFAULT NULL AFTER `id`;
----------- 25.08.2014 ---
update materials set materials.size = (select size from materials_oboi where materials_oboi.material_id = materials.id) where materials.id = (select id from materials_oboi where materials_oboi.material_id = materials.id);
update materials set materials.size = 1 where materials.category_id = 38;
update materials set materials.size = 1 where materials.size = 0;
UPDATE `materials` SET `count_text`='м<sup>2<sup>, м<sup>2<sup>, м<sup>2<sup>' WHERE `count_text`='м<sup>2<sup>';
----------- 14.09.2014 ---