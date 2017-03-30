-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-29 04:36:27
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practice`
--

-- --------------------------------------------------------

--
-- 表的结构 `t_artical`
--

CREATE TABLE `t_artical` (
  `artical_id` int(11) NOT NULL,
  `artical_title` varchar(255) NOT NULL COMMENT '文章标题',
  `artical_comment` longtext NOT NULL COMMENT '文章内容',
  `column_id` tinyint(4) NOT NULL COMMENT '文章所属栏目',
  `is_red` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否加红',
  `is_top` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `alert_time` int(11) NOT NULL DEFAULT '0' COMMENT '置顶时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `t_artical`
--

INSERT INTO `t_artical` (`artical_id`, `artical_title`, `artical_comment`, `column_id`, `is_red`, `is_top`, `alert_time`) VALUES
(1, 'è¿™æ˜¯ç”Ÿæ´»ç±»çš„æ–‡ç« ', 'ç”Ÿæ´»', 1, 1, 1, 1489560533),
(7, 'è¿™æ˜¯å¥åº·ç±»æ–‡ç« ', 'å¥åº·', 4, 0, 1, 1489560361),
(6, 'è¿™æ˜¯å…»ç”Ÿç±»çš„æ–‡ç« ', 'å…»ç”Ÿ', 3, 0, 1, 1489560531),
(5, 'è¿™æ˜¯æ–°é—»ç±»æ–‡ç« ', 'æ–°é—»124354', 2, 0, 1, 1489560484),
(8, 'æ–°é—»2', 'æ–°é—»2', 2, 0, 0, 0),
(9, 'ç”Ÿæ´»2', 'ç”Ÿæ´»2', 1, 1, 0, 0),
(10, 'å…»ç”Ÿ2', 'å…»ç”Ÿ2', 3, 1, 0, 0),
(11, 'ç”Ÿæ´»3', 'è¿™æ˜¯ç”Ÿæ´»3', 1, 0, 1, 1489565469);

-- --------------------------------------------------------

--
-- 表的结构 `t_classify`
--

CREATE TABLE `t_classify` (
  `column_id` tinyint(4) NOT NULL COMMENT '类别ID',
  `column_name` varchar(20) NOT NULL COMMENT '类别名称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `t_classify`
--

INSERT INTO `t_classify` (`column_id`, `column_name`) VALUES
(1, 'ç”Ÿæ´»'),
(2, 'æ–°é—»'),
(3, 'å…»ç”Ÿ'),
(4, 'å¥åº·1'),
(5, 'ç”Ÿæ´»2'),
(6, 'ç”Ÿæ´»4'),
(7, 'ç”Ÿæ´»5'),
(8, 'ç”Ÿæ´»6'),
(9, 'ç”Ÿæ´»7');

-- --------------------------------------------------------

--
-- 表的结构 `t_message`
--

CREATE TABLE `t_message` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `message_time` int(10) UNSIGNED NOT NULL COMMENT '留言时间',
  `ip` varchar(200) NOT NULL COMMENT 'IP地址',
  `replay` varchar(200) NOT NULL COMMENT '回复留言',
  `message` longtext NOT NULL COMMENT '留言内容',
  `artical_id` int(11) NOT NULL COMMENT '所属文章ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE `t_user` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `username` varchar(15) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`) VALUES
(1, 'tom', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_artical`
--
ALTER TABLE `t_artical`
  ADD PRIMARY KEY (`artical_id`);

--
-- Indexes for table `t_classify`
--
ALTER TABLE `t_classify`
  ADD PRIMARY KEY (`column_id`);

--
-- Indexes for table `t_message`
--
ALTER TABLE `t_message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `t_artical`
--
ALTER TABLE `t_artical`
  MODIFY `artical_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `t_classify`
--
ALTER TABLE `t_classify`
  MODIFY `column_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '类别ID', AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `t_message`
--
ALTER TABLE `t_message`
  MODIFY `message_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
