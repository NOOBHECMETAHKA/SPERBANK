DROP TRIGGER IF EXISTS set_NEW_balance_in_score_from_operations;
DELIMITER //

CREATE TRIGGER set_NEW_balance_in_score_from_operations
    AFTER UPDATE ON operations
    FOR EACH ROW
BEGIN
    update `scores`
    set balance = ((select
                        `scores`.`balance` from operations
                   inner join cards on operations.card_operation_id = cards.id
                   inner join scores on cards.card_score_id = scores.id where card_operation_id = NEW.card_operation_id limit 1)
                       + NEW.accrual_amount)
    where `scores`.`id` = (select
            `scores`.`id` from operations
       inner join cards on operations.card_operation_id = cards.id
       inner join scores on cards.card_score_id = scores.id
        where card_operation_id = NEW.card_operation_id
        limit 1);
END;
//

DELIMITER ;
