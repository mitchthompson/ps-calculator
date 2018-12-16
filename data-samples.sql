INSERT INTO `wp_Software` (`id`, `name`, `crowdCuts`) VALUES (NULL, 'Insight Lab', 'N'), (NULL, 'Market Pay', 'Y'), (NULL, 'Insight', 'N');

INSERT INTO `wp_Software_Groups` (`id`, `softwareID`, `name`, `isMulti`) VALUES (NULL, '1', 'Managing Surveys', 'N');

INSERT INTO `wp_Software_Options` (`id`, `groupID`, `name`) VALUES (NULL, '1', 'Managing Surveys');

INSERT INTO `wp_Software_Ranges` (`id`, `softwareID`, `name`, `corePrice`, `start`, `stop`) VALUES (NULL, '1', '0', '3560', '0', '0'), (NULL, '1', '1', '3560', '1', '1'), (NULL, '1', '2-3', '3560', '2', '3'), (NULL, '1', '4-9', '3560', '4', '9');
