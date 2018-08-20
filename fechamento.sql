--ATUALIZAÇÃO 14/06

ALTER TABLE `atividades` ADD `destaque` BOOLEAN NULL DEFAULT FALSE AFTER `empresa_id`;

;

UPDATE `atividades` SET `destaque` = '1', `created_at` = NULL, `updated_at` = NULL, `deleted_at` = NULL WHERE `atividades`.`id` >= 278