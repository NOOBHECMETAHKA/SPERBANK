DROP PROCEDURE IF EXISTS `get_role_user_by_name`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_role_user_by_name`(role_name varchar(50), user_id bigint)
begin
    select `roles`.`id`, `roles`.`name` as `role` from `employees`
    inner join `users` on `users`.`id` = `user_employee_id`
    inner join `roles` on `roles`.`id` = `role_employee_id`
    where `users`.`id` = user_id and `roles`.`name` = role_name;
end;
