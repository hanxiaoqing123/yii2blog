CREATE TABLE `tbUserBackend` (
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