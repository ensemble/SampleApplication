SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

INSERT INTO `page` (`id`, `parent_id`, `lft`, `lvl`, `rgt`, `root`, `route`, `module`, `moduleId`) VALUES
(1, NULL, 1, 1, 4, NULL, '/', 'simple', 1),
(2, 1, 2, 2, 3, 1, 'about', 'simple', 2);

INSERT INTO `page_metadata` (`id`, `page_id`, `title`, `longTitle`, `shortTitle`, `description`, `keywords`) VALUES
(1, 1, 'test', NULL, NULL, NULL, NULL),
(2, 2, 'about', NULL, NULL, NULL, NULL);

INSERT INTO `simple_text` (`id`, `content`) VALUES
(1, 'This is a very simple text'),
(2, 'This is another (but again really simple!) piece of text');
