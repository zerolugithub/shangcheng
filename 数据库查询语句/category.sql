show create table `mall_category`;
CREATE TABLE `mall_category` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL,
  `pid` tinyint(4) NOT NULL DEFAULT '0',
  `is_show` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:不显示\n1：显示',
  `nav_show` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:不在导航显示\n1：在导航显示',
  `key_word` text,
  `cate_sort` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '0:逻辑删除 1:默认值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8