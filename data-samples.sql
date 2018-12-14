INSERT INTO `wp_Software` (`id`, `name`, `crowdCuts`) VALUES (NULL, 'Insight Lab', 'N'), (NULL, 'Market Pay', 'Y'), (NULL, 'Insight', 'N');

INSERT INTO `wp_Software_Groups` (`id`, `softwareID`, `name`, `isMulti`) VALUES (NULL, '1', 'Managing Surveys', 'N');

INSERT INTO `wp_Software_Options` (`id`, `groupID`, `name`) VALUES (NULL, '1', 'Managing Surveys');

INSERT INTO `wp_Software_Ranges` (`id`, `softwareID`, `name`, `corePrice`, `start`, `stop`) VALUES (NULL, '1', '0', '3650', '0', '0');

INSERT INTO `wp_Software_Prices` (`id`, `optionID`, `rangeID`, `name`, `start`, `stop`, `price`) VALUES (NULL, '1', '1', '1-24', '1', '24', '0');
