CREATE TABLE mall.mall_privilege
(
	id SMALLINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ID',
	priv_name VARCHAR(32) NOT NULL COMMENT '权限名称',
	parent_id SMALLINT UNSIGNED NOT NULL COMMENT '权限父类ID',
	module_name VARCHAR(32) NOT NULL DEFAULT '' COMMENT '改权限对应的模块名',
	controller_name VARCHAR(32) NOT NULL DEFAULT '' COMMENT '改权限对应的控制器名',
	action_name VARCHAR(32) NOT NULL DEFAULT '' COMMENT '改权限对应的方法名'
);
ALTER TABLE mall.mall_privilege COMMENT = '权限表';