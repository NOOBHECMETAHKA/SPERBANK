drop view IF EXISTS `get_all_employee_with_count_jobs`;
create view `get_all_employee_with_count_jobs` as
    select `users`.`id`, `first_name`, `middle_name`, `phone_number`, `login`, `last_name`, count(`employees`.`id`) as `count_jobs` from `employees`
    inner join `sper_bank`.`users` on `users`.`id` = `employees`.`user_employee_id`
    group by `users`.`id`;
