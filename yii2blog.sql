CREATE TABLE `user_backend` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户主键',
  `userName` varchar(255)   NOT NULL COMMENT '昵称',
  `authKey` varchar(32)   NOT NULL COMMENT '认证key',
  `passwordHash` varchar(255)  NOT NULL COMMENT '哈希密码',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `createdAt` datetime NOT NULL COMMENT '创建时间',
  `updatedAt` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userName` (`userName`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台用户表';

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL COMMENT '主键ID',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `is_delete` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否删除 1未删除 2已删除',
  `created_at` datetime NOT NULL COMMENT '添加时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='博客表';
#sql example分析

CREATE TABLE `tbTest` (
  `c1` varchar(10),
  `c2` varchar(10) NOT NULL,
  `c3` char(10),
  `c4` varchar(10)
) ENGINE=InnoDB DEFAULT CHARSET=ascii  ROW_FORMAT=COMPACT;

insert into tbTest(c1,c2,c3,c4)  values ('aaaa','bbb','cc','d');
insert into tbTest(c1,c2,c3,c4)  values ('eeee','fff',NULL,NULL);
/*******************************rbac的4长表******************************************/
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64)  NOT NULL  COMMENT '名称',
  `type` smallint(6) NOT NULL COMMENT '类型 1角色 2权限和路由',
  `description` text COMMENT '描述',
  `rule_name` varchar(64) DEFAULT NULL COMMENT '规则名称',
  `data` blob COMMENT '数据',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色、权限和路由表';

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL COMMENT '角色',
  `child` varchar(64) NOT NULL COMMENT '权限',
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色和权限的关联表';

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64)  NOT NULL COMMENT '角色名称',
  `user_id` varchar(64)  NOT NULL COMMENT '用户ID',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户和角色的关联表';

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL COMMENT '规则名称',
  `data` blob,
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='规则表';