/*
Navicat MySQL Data Transfer

Source Server         : ecshop
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : mall

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-06-25 21:43:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mall_admin
-- ----------------------------
DROP TABLE IF EXISTS `mall_admin`;
CREATE TABLE `mall_admin` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_name` varchar(32) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` char(6) NOT NULL COMMENT '密码密钥',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of mall_admin
-- ----------------------------
INSERT INTO `mall_admin` VALUES ('1', 'admin', 'f2f4f56afc6f452036dfd82ae0be1011', 'zsn106');

-- ----------------------------
-- Table structure for mall_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `mall_admin_role`;
CREATE TABLE `mall_admin_role` (
  `admin_id` smallint(5) unsigned NOT NULL COMMENT '管理员ID',
  `role_id` tinyint(3) unsigned NOT NULL COMMENT '角色ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员-角色表';

-- ----------------------------
-- Records of mall_admin_role
-- ----------------------------

-- ----------------------------
-- Table structure for mall_attribute
-- ----------------------------
DROP TABLE IF EXISTS `mall_attribute`;
CREATE TABLE `mall_attribute` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `type_id` tinyint(3) unsigned NOT NULL COMMENT '商品类型ID',
  `attr_name` varchar(50) NOT NULL COMMENT '属性名称',
  `attr_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性类型 0：唯一属性 1：单选属性',
  `attr_input_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性值录入方式 0：手工录入 1：列表选择',
  `attr_value` varchar(100) NOT NULL DEFAULT '' COMMENT '列表可选值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_attribute
-- ----------------------------
INSERT INTO `mall_attribute` VALUES ('1', '1', '颜色', '1', '1', '黑色,白色,红色,金色');
INSERT INTO `mall_attribute` VALUES ('2', '1', '规格', '1', '1', '32G,64G,128G');
INSERT INTO `mall_attribute` VALUES ('3', '1', '重量', '0', '0', '');
INSERT INTO `mall_attribute` VALUES ('4', '1', '材质', '0', '0', '');
INSERT INTO `mall_attribute` VALUES ('5', '1', '屏幕', '1', '1', '4.7\',5.0\',5.5\'');
INSERT INTO `mall_attribute` VALUES ('6', '1', '型号', '0', '0', '');
INSERT INTO `mall_attribute` VALUES ('7', '1', '商品编号', '0', '0', '');

-- ----------------------------
-- Table structure for mall_brand
-- ----------------------------
DROP TABLE IF EXISTS `mall_brand`;
CREATE TABLE `mall_brand` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `brand_name` varchar(100) NOT NULL COMMENT '品牌名称',
  `brand_web` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌网址',
  `brand_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '品牌描述',
  `sort` int(10) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `is_show` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1-显示 0-不显示',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '增加时间',
  `brand_logo` varchar(100) NOT NULL DEFAULT '' COMMENT '品牌LOGO',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_brand
-- ----------------------------
INSERT INTO `mall_brand` VALUES ('1', '小米', 'www.mi.com', '1111', '50', '1', '1498026609', '1498017679', 'Uploads/20170621//594a127180f54.png');
INSERT INTO `mall_brand` VALUES ('2', '华为', 'www.huawei.com', '华为', '50', '1', '1498026629', '1498017779', 'Uploads/20170621//594a128510090.png');
INSERT INTO `mall_brand` VALUES ('3', '摩托罗拉', 'www.moto.com', '摩托罗拉', '50', '0', '0', '1498017818', '');
INSERT INTO `mall_brand` VALUES ('4', 'Apple', 'www.apple.com', 'Apple', '50', '1', '1498026640', '1498017847', 'Uploads/20170621//594a129089d12.png');
INSERT INTO `mall_brand` VALUES ('5', 'OPPO', 'www.oppo.com', 'oppo', '50', '1', '1498026454', '1498017883', '');
INSERT INTO `mall_brand` VALUES ('6', '三星', 'www.samsung.com', 'three stars', '50', '1', '1498026617', '1498017979', 'Uploads/20170621//594a127942d80.png');
INSERT INTO `mall_brand` VALUES ('7', 'dsf', 'df', 'adf', '50', '0', '0', '1498024771', 'Uploads/20170621//594a0b43b3629.png');
INSERT INTO `mall_brand` VALUES ('8', 'wer', 'wer', 'er', '50', '0', '0', '1498024798', 'Uploads/20170621//594a0b5ee9c09.png');

-- ----------------------------
-- Table structure for mall_category
-- ----------------------------
DROP TABLE IF EXISTS `mall_category`;
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_category
-- ----------------------------
INSERT INTO `mall_category` VALUES ('1', '手机', '0', '1', '1', '4G手机', '50', '0');
INSERT INTO `mall_category` VALUES ('2', '书', '0', '1', '1', '计算机', '50', '0');
INSERT INTO `mall_category` VALUES ('3', '笔记本电脑', '0', '1', '1', '', '50', '0');
INSERT INTO `mall_category` VALUES ('4', '移动设备', '0', '1', '1', '4G手机', '50', '1');
INSERT INTO `mall_category` VALUES ('5', '电脑类型', '0', '1', '1', '笔记本电脑', '50', '1');
INSERT INTO `mall_category` VALUES ('6', '数码时尚', '0', '1', '1', '数码相机', '50', '1');
INSERT INTO `mall_category` VALUES ('7', '手机', '4', '1', '0', '', '50', '1');
INSERT INTO `mall_category` VALUES ('8', '平板电脑', '4', '1', '0', '', '50', '1');
INSERT INTO `mall_category` VALUES ('9', '笔记本电脑', '5', '1', '0', '', '50', '1');
INSERT INTO `mall_category` VALUES ('10', '台式机电脑', '5', '1', '0', '', '50', '1');
INSERT INTO `mall_category` VALUES ('11', '一体机', '5', '1', '0', '', '50', '1');
INSERT INTO `mall_category` VALUES ('12', '自拍神器', '6', '1', '0', '', '50', '1');
INSERT INTO `mall_category` VALUES ('13', '数码相机', '6', '1', '0', '', '50', '1');

-- ----------------------------
-- Table structure for mall_goods
-- ----------------------------
DROP TABLE IF EXISTS `mall_goods`;
CREATE TABLE `mall_goods` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goods_name` varchar(50) NOT NULL COMMENT '商品名称',
  `goods_sn` varchar(32) NOT NULL COMMENT '商品货号',
  `cate_id` tinyint(3) unsigned NOT NULL COMMENT '所属栏目分类',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '品牌',
  `type_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '商品类型Id',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_thumb` varchar(125) NOT NULL DEFAULT '0' COMMENT '商品缩略图',
  `goods_img` varchar(125) NOT NULL DEFAULT '0' COMMENT '商品图',
  `goods_ori` varchar(125) NOT NULL DEFAULT '0' COMMENT '商品原图',
  `goods_sort` int(11) NOT NULL DEFAULT '100' COMMENT '商品排序',
  `goods_desc` varchar(255) DEFAULT '' COMMENT '商品描述',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词 空格隔开',
  `goods_weight` decimal(8,3) NOT NULL DEFAULT '0.000' COMMENT '商品重量',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `is_new` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是新品 0：不是新品 1：是新品',
  `is_best` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是精品 0：不是 1：是',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是热卖 0：不是 1是',
  `is_sale` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否上架 0：未上架 1：上架',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '增加时间',
  `goods_click` int(11) NOT NULL DEFAULT '0' COMMENT '商品访问量',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除 0 -不删除 1-删除  表示删除到回收站（逻辑删除）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_goods
-- ----------------------------
INSERT INTO `mall_goods` VALUES ('1', 'apple 7p', 'SN14981350172298', '7', '4', '1', '7777.00', '8888.00', 'Goods/2017-06-22/thumb_594bb9e91ac6c.jpg', 'Goods/2017-06-22/img_594bb9e91ac6c.jpg', 'Goods/2017-06-22/594bb9e91ac6c.jpg', '100', '<p>red</p>', 'NB', '0.000', '77', '1', '1', '1', '1', '0', '1498135017', '0', '0');
INSERT INTO `mall_goods` VALUES ('2', '1234', 'SN14981352121032', '4', '0', '0', '1232.00', '23.00', '0', '0', '0', '100', '', '23', '0.000', '12', '0', '1', '0', '1', '0', '1498135212', '0', '1');
INSERT INTO `mall_goods` VALUES ('3', '123', 'SN14981365822662', '4', '1', '0', '123.00', '123.00', '0', '0', '0', '100', '<p>123</p>', '', '0.000', '123', '0', '1', '0', '1', '0', '1498136582', '0', '1');
INSERT INTO `mall_goods` VALUES ('4', '3wer', 'SN14981370971525', '4', '1', '0', '333.00', '33.00', '0', '0', '0', '100', '<p>33</p>', '33', '0.000', '33', '0', '1', '0', '1', '0', '1498137097', '0', '1');

-- ----------------------------
-- Table structure for mall_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `mall_goods_attr`;
CREATE TABLE `mall_goods_attr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `goods_id` smallint(6) NOT NULL COMMENT '商品ID',
  `attr_id` smallint(6) NOT NULL COMMENT '属性ID',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- ----------------------------
-- Records of mall_goods_attr
-- ----------------------------
INSERT INTO `mall_goods_attr` VALUES ('47', '1', '2', '32G');
INSERT INTO `mall_goods_attr` VALUES ('46', '1', '1', '红色');
INSERT INTO `mall_goods_attr` VALUES ('45', '1', '6', 'A1586');
INSERT INTO `mall_goods_attr` VALUES ('44', '1', '5', '5.5\'');
INSERT INTO `mall_goods_attr` VALUES ('43', '1', '5', '5.0\'');
INSERT INTO `mall_goods_attr` VALUES ('42', '1', '5', '4.7\'');
INSERT INTO `mall_goods_attr` VALUES ('41', '1', '4', '8mm*128mm*80mm');
INSERT INTO `mall_goods_attr` VALUES ('40', '1', '3', '123g');
INSERT INTO `mall_goods_attr` VALUES ('39', '1', '2', '64G');
INSERT INTO `mall_goods_attr` VALUES ('38', '1', '2', '32G');
INSERT INTO `mall_goods_attr` VALUES ('37', '1', '1', '白色');
INSERT INTO `mall_goods_attr` VALUES ('36', '1', '1', '黑色');
INSERT INTO `mall_goods_attr` VALUES ('48', '1', '3', '123');
INSERT INTO `mall_goods_attr` VALUES ('49', '1', '4', '金属');
INSERT INTO `mall_goods_attr` VALUES ('50', '1', '5', '4.7\'');
INSERT INTO `mall_goods_attr` VALUES ('51', '1', '6', 'A586');

-- ----------------------------
-- Table structure for mall_goods_photos
-- ----------------------------
DROP TABLE IF EXISTS `mall_goods_photos`;
CREATE TABLE `mall_goods_photos` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `goods_id` smallint(5) unsigned NOT NULL COMMENT '商品ID',
  `goods_ori` varchar(100) NOT NULL DEFAULT '' COMMENT '原图',
  `goods_thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品图片';

-- ----------------------------
-- Records of mall_goods_photos
-- ----------------------------

-- ----------------------------
-- Table structure for mall_privilege
-- ----------------------------
DROP TABLE IF EXISTS `mall_privilege`;
CREATE TABLE `mall_privilege` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `priv_name` varchar(32) NOT NULL COMMENT '权限名称',
  `pid` smallint(5) unsigned NOT NULL COMMENT '权限父类ID',
  `module_name` varchar(32) NOT NULL DEFAULT '' COMMENT '改权限对应的模块名',
  `controller_name` varchar(32) NOT NULL DEFAULT '' COMMENT '改权限对应的控制器名',
  `action_name` varchar(32) NOT NULL DEFAULT '' COMMENT '改权限对应的方法名',
  `is_show` tinyint(4) DEFAULT '1' COMMENT '是否在导航栏目显示 1(默认）-显示 0-不显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of mall_privilege
-- ----------------------------
INSERT INTO `mall_privilege` VALUES ('1', '商品管理', '0', '', '', '', '1');
INSERT INTO `mall_privilege` VALUES ('2', '权限管理', '0', '', '', '', '1');
INSERT INTO `mall_privilege` VALUES ('3', '商品添加', '1', 'Admin', 'Goods', 'add', '1');
INSERT INTO `mall_privilege` VALUES ('4', '商品列表', '1', 'Admin', 'Goods', 'lst', '1');
INSERT INTO `mall_privilege` VALUES ('5', '商品修改', '4', 'Admin', 'Goods', 'edit', '0');
INSERT INTO `mall_privilege` VALUES ('6', '商品删除', '4', 'Admin', 'Goods', 'del', '0');
INSERT INTO `mall_privilege` VALUES ('7', '管理员列表', '2', 'Admin', 'Admin', 'lst', '1');
INSERT INTO `mall_privilege` VALUES ('8', '管理员日志', '2', 'Admin', 'Admin', 'log', '1');
INSERT INTO `mall_privilege` VALUES ('9', '管理员增加', '7', 'Admin', 'Admin', 'add', '0');
INSERT INTO `mall_privilege` VALUES ('10', '管理员修改', '7', 'Admin', 'Admin', 'edit', '0');
INSERT INTO `mall_privilege` VALUES ('11', '管理员删除', '7', 'Admin', 'Admin', 'del', '0');
INSERT INTO `mall_privilege` VALUES ('12', '权限分配', '7', 'Admin', 'Admin', 'priv', '0');
INSERT INTO `mall_privilege` VALUES ('13', '权限列表', '2', 'Admin', 'Privilege', 'lst', '1');
INSERT INTO `mall_privilege` VALUES ('14', '权限修改', '13', 'Admin', 'Privilege', 'edit', '1');
INSERT INTO `mall_privilege` VALUES ('15', '权限删除', '13', 'Admin', 'Privilege', 'del', '1');
INSERT INTO `mall_privilege` VALUES ('16', '权限增加', '2', 'Admin', 'Privilege', 'add', '1');

-- ----------------------------
-- Table structure for mall_role
-- ----------------------------
DROP TABLE IF EXISTS `mall_role`;
CREATE TABLE `mall_role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_name` varchar(32) NOT NULL COMMENT '角色名称',
  `role_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '角色描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of mall_role
-- ----------------------------

-- ----------------------------
-- Table structure for mall_role_privilege
-- ----------------------------
DROP TABLE IF EXISTS `mall_role_privilege`;
CREATE TABLE `mall_role_privilege` (
  `role_id` tinyint(3) unsigned NOT NULL COMMENT '角色ID',
  `priv_id` smallint(5) unsigned NOT NULL COMMENT '权限ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色-权限表';

-- ----------------------------
-- Records of mall_role_privilege
-- ----------------------------

-- ----------------------------
-- Table structure for mall_type
-- ----------------------------
DROP TABLE IF EXISTS `mall_type`;
CREATE TABLE `mall_type` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '类型ID',
  `type_name` varchar(120) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mall_type
-- ----------------------------
INSERT INTO `mall_type` VALUES ('1', '手机');
INSERT INTO `mall_type` VALUES ('2', '平板电脑');
INSERT INTO `mall_type` VALUES ('3', '笔记本电脑');
INSERT INTO `mall_type` VALUES ('4', '台式机电脑');
INSERT INTO `mall_type` VALUES ('5', '一体机');
INSERT INTO `mall_type` VALUES ('6', '数码相机');
INSERT INTO `mall_type` VALUES ('7', '自拍神器');
