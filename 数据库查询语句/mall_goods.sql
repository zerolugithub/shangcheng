CREATE TABLE mall.mall_goods
(
	id SMALLINT UNSIGNED primary key AUTO_INCREMENT COMMENT '商品ID',
	goods_name VARCHAR(50) not null comment '商品名称',
	goods_sn varchar(32) not null comment '商品货号',
	cate_id TINYINT unsigned NOT NULL COMMENT '所属栏目分类',
	brand_id SMALLINT UNSIGNED not NULL DEFAULT 0 COMMENT '品牌',
	shop_price DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT '本店价格',
	market_price DECIMAL(10,2) NOT NULL DEFAULT 0 COMMENT '市场价格',
	goods_thumb VARCHAR(125) NOT NULL DEFAULT 0 COMMENT '商品缩略图',
	goods_img VARCHAR(125) NOT NULL DEFAULT 0 COMMENT '商品图',
	goods_ori VARCHAR(125) NOT NULL DEFAULT 0 COMMENT '商品原图',
	goods_desc VARCHAR(255) DEFAULT '' COMMENT '商品描述',
	keywords VARCHAR(255) DEFAULT '' COMMENT '关键词',
	goods_weight DECIMAL(8,3) NOT NULL DEFAULT 0 COMMENT '商品重量',
	goods_number SMALLINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品库存',
	is_new TINYINT NOT NULL DEFAULT 0 COMMENT '是否是新品 0：不是新品 1：是新品',
	is_best TINYINT NOT NULL DEFAULT 0 COMMENT '是否是精品 0：不是 1：是',
	is_hot TINYINT NOT NULL DEFAULT 0 COMMENT '是否是热卖 0：不是 1是',
	is_sale TINYINT NOT NULL DEFAULT 0 COMMENT '是否上架 0：未上架 1：上架',
	add_time int NOT NULL DEFAULT 0 COMMENT '增加时间',
	goods_click INT NOT NULL DEFAULT 0 COMMENT '商品访问量'
)engine myisam charset utf8;