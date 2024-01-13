DROP PROCEDURE IF EXISTS `get_all_operations_by_card_id`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_all_operations_by_card_id`(user_id bigint)
begin
    select operations.id, operations.accrual_amount, operations.description,
           operation_type_id, card_operation_id,operations.created_at,
            operations.updated_at,
           operations.is_deleted from operations
  inner join cards on cards.id = card_operation_id
  inner join scores on cards.card_score_id = scores.id
    where user_score_id = user_id;
end //
