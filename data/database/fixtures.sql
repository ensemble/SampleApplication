SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

INSERT INTO `page` (`id`, `parent_id`, `lft`, `lvl`, `rgt`, `root`, `order`, `route`, `module`, `moduleId`) VALUES
(1, NULL, 1, 1, 2, NULL, 1, '/', 'welcome', 1),
(2, NULL, 1, 1, 4, NULL, 2, 'about', 'simple', 1),
(3, 2, 2, 2, 3, 2, 2, 'sub', 'simple', 2);

INSERT INTO `page_metadata` (`id`, `page_id`, `title`, `longTitle`, `shortTitle`, `description`, `keywords`) VALUES
(1, 1, 'Home', 'Ensemble sample application', NULL, NULL, NULL),
(2, 2, 'About', NULL, NULL, NULL, NULL),
(3, 3, 'Sub page', NULL, NULL, NULL, NULL);

INSERT INTO `simple_text` (`id`, `content`) VALUES
(1, '<h1>Editable page</h1>\r\n\r\n<p>This is a page where you can modify html. There is also a <a href="about/sub">sub page</a> which you can view and modify. Go to the <a href="admin">admin section</a> to edit both pages.</p>\r\n\r\n<!-- Obviously we change this into a more appropriate WYSIWYG editor. This is just to show the ideas behind the admin interface -->'),
(2, '<h1>Sub page</h1>\r\n\r\n<p>This page is a child of the About page.</p>');
