DROP PROCEDURE IF EXISTS `get_data_to_update_score_balance`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_data_to_update_score_balance`(card_id bigint)
begin
    select
        `scores`.`id` as `id`, `scores`.`balance` as `balance` from operations
        inner join cards on operations.card_operation_id = cards.id
        inner join scores on cards.card_score_id = scores.id
    where card_operation_id = card_id
    limit 1;
end //
