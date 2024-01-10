DROP PROCEDURE IF EXISTS `insert_employee_by_name_role_and_id_user`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee_by_name_role_and_id_user`(role_updated varchar(50), user_id bigint)
begin
    INSERT INTO `employees` (`id`, `user_employee_id`, `role_employee_id`, `is_deleted`, `created_at`, `updated_at`)
    VALUES (NULL, user_id, (select `roles`.`id` from `roles` where `roles`.`name` = role_updated), '0', NULL, NULL);
end
