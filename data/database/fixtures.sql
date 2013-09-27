-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 27 Sept 2013 om 12:02
-- Serverversie: 5.1.63
-- PHP-Versie: 5.3.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sample_application`
--

--
-- Gegevens worden uitgevoerd voor tabel `page`
--

INSERT INTO `page` (`id`, `parent_id`, `lft`, `lvl`, `rgt`, `root`, `order`, `visible`, `route`, `module`, `moduleId`) VALUES
(1, NULL, 1, 1, 2, NULL, 1, 1, '/', 'welcome', 1),
(2, NULL, 1, 1, 4, NULL, 2, 1, 'about', 'simple', 1),
(3, 2, 2, 2, 3, 2, 2, 1, 'sub', 'simple', 2);

--
-- Gegevens worden uitgevoerd voor tabel `page_metadata`
--

INSERT INTO `page_metadata` (`id`, `page_id`, `title`, `longTitle`, `shortTitle`, `description`, `keywords`) VALUES
(1, 1, 'Home', 'Ensemble sample application', NULL, NULL, NULL),
(2, 2, 'About', NULL, NULL, NULL, NULL),
(3, 3, 'Sub page', NULL, NULL, NULL, NULL);

--
-- Gegevens worden uitgevoerd voor tabel `simple_text`
--

INSERT INTO `simple_text` (`id`, `content`) VALUES
(1, '<h1>Editable page</h1>\r\n\r\n<p>This is a page where you can modify html. There is also a <a href="about/sub">sub page</a> which you can view and modify. Go to the <a href="admin">admin section</a> to edit both pages.</p>\r\n\r\n<!-- Obviously we change this into a more appropriate WYSIWYG editor. This is just to show the ideas behind the admin interface -->'),
(2, '<h1>Sub page</h1>\r\n\r\n<p>This page is a child of the About page.</p>');

--
-- Gegevens worden uitgevoerd voor tabel `user`
--


--
-- Gegevens worden uitgevoerd voor tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `default`, `parent`) VALUES
('admin', 0, 'guest'),
('guest', 1, NULL);

--
-- Gegevens worden uitgevoerd voor tabel `user_role_linker`
--

