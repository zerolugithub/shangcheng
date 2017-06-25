CREATE TABLE mall.mall_admin_role
(
	admin_id SMALLINT UNSIGNED NOT NULL COMMENT '管理员ID',
	role_id TINYINT UNSIGNED NOT NULL COMMENT '角色ID'
);
ALTER TABLE mall.mall_admin_role COMMENT = '管理员-角色表';