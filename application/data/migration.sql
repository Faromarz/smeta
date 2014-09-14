ALTER TABLE `work_categories` ADD `img` VARCHAR(64) NULL DEFAULT NULL AFTER `id`;
----------- 25.08.2014 ---
update materials set materials.size = (select size from materials_oboi where materials_oboi.material_id = materials.id) where materials.id = (select id from materials_oboi where materials_oboi.material_id = materials.id);