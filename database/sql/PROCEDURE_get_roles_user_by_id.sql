DROP PROCEDURE IF EXISTS `get_roles_user_by_id`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_roles_user_by_id`(user_id bigint)
begin
    select `roles`.`name` from `employees`
    inner join `roles` on `roles`.`id` = `role_employee_id`
    where  `employees`.`user_employee_id` = user_id;
end;
