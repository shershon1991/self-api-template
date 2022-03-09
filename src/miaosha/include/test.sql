CREATE TABLE `order_queue` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
    `order_id` int(11) NOT NULL default '0' COMMENT '订单id',
    `mobile` varchar(20) NOT NULL default '' COMMENT '手机号码',
    `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '订单状态（0-未处理 1-等待处理 2-已处理）',
    `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
    `update_time` timestamp NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    PRIMARY KEY(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 default CHARSET = utf8mb4 ROW_FORMAT = COMPACT COMMENT = '订单队列表';

CREATE TABLE `redis_queue` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
    `uid` int(11) NOT NULL default '0' COMMENT 'uid',
    `time_stamp` varchar(10) NOT NULL DEFAULT '' COMMENT '时间戳',
    `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP COMMENT '创建时间',
    `update_time` timestamp NOT NULL default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    PRIMARY KEY(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 0 default CHARSET = utf8mb4 ROW_FORMAT = COMPACT COMMENT = 'redis队列表';