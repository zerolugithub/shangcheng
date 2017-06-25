CREATE TABLE mall.mall_role_privilege
(
	role_id TINYINT UNSIGNED NOT NULL COMMENT '角色ID',
	priv_id SMALLINT UNSIGNED NOT NULL COMMENT '权限ID'
);
ALTER TABLE mall.mall_role_privilege COMMENT = '角色-权限表';