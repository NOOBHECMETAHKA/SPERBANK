DROP PROCEDURE IF EXISTS `get_all_card_by_user_id`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_card_by_user_id`(user_id bigint)
begin
    select
        `cards`.`id`, `cards`.`owner`, `cards`.`card_number`,
        `cards`.`ending_date`, `cards`.`CCV_code`,
        `cards`.`card_score_id`, `cards`.`card_type_id`,
        `cards`.`bank_id` from `cards`
            inner join `scores` on `scores`.`id` = `cards`.`card_score_id`

    where `scores`.`user_score_id` = user_id;
end //
