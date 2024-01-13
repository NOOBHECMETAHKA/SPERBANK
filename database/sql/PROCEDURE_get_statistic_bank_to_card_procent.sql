DROP PROCEDURE IF EXISTS `get_statistic_banks`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_statistic_Banks`()
SELECT DISTINCT(banks.name), round(count(cards.id) / (select count(*) from `cards`) * 100, 0) as `procent` FROM `banks`
                                                                                                                    inner join `cards` on `cards`.`bank_id` = `banks`.`id`
GROUP BY `banks`.`name`
LIMIT 10;

