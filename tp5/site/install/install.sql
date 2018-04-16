/*
Navicat MySQL Data Transfer

Source Server         : 本地mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-10-09 17:22:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for rt_admin_account
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_account`;
CREATE TABLE `rt_admin_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `role` int(11) DEFAULT NULL COMMENT '角色ID',
  `username` varchar(32) DEFAULT NULL COMMENT '用户名',
  `nickname` varchar(32) DEFAULT NULL COMMENT '昵称',
  `password` varchar(128) DEFAULT NULL COMMENT '密码',
  `email` varchar(120) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(15) DEFAULT NULL COMMENT '手机',
  `email_bind` tinyint(1) DEFAULT NULL COMMENT '是否绑定EMAIL',
  `mobile_bind` tinyint(1) DEFAULT NULL COMMENT '是否绑定手机',
  `avatar` varchar(250) DEFAULT NULL COMMENT '头像',
  `groupid` int(11) DEFAULT NULL COMMENT '部门ID',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后一次登录时间',
  `last_login_ip` bigint(20) DEFAULT NULL COMMENT '最后一次登录IP',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员账户表';

-- ----------------------------
-- Table structure for rt_admin_action
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_action`;
CREATE TABLE `rt_admin_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text COMMENT '行为规则',
  `log` text COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COMMENT='动作行为表';

-- ----------------------------
-- Table structure for rt_admin_action_log
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_action_log`;
CREATE TABLE `rt_admin_action_log` (
  `id` int(11) unsigned NOT NULL COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '日志类型',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  `langid` text NOT NULL COMMENT '所属语言',
  PRIMARY KEY (`id`),
  KEY `action_id_ix` (`action_id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `user_id_ix` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='行为日志';

-- ----------------------------
-- Table structure for rt_admin_attachment
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_attachment`;
CREATE TABLE `rt_admin_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '附件DI',
  `name` varchar(255) NOT NULL COMMENT '图片名称',
  `path` text NOT NULL COMMENT '附件路径',
  `size` varchar(50) NOT NULL COMMENT '大小',
  `type` varchar(20) NOT NULL COMMENT '附件类型',
  `module` varchar(30) NOT NULL COMMENT '所属模块',
  `create_time` int(11) NOT NULL COMMENT '上传时间',
  `usetime` int(11) NOT NULL COMMENT '使用次数',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '可用状态',
  `langid` text COMMENT '语言系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=355 DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
-- Table structure for rt_admin_attribute
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_attribute`;
CREATE TABLE `rt_admin_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '字段名',
  `type` varchar(255) NOT NULL COMMENT '字段类型（自定义）',
  `type_value` varchar(255) NOT NULL COMMENT '字段类型值',
  `value` varchar(255) NOT NULL COMMENT '字段默认值',
  `length` int(11) NOT NULL COMMENT '字段长度',
  `point` tinyint(4) NOT NULL COMMENT '字段小数点',
  `autoincrement` tinyint(1) NOT NULL COMMENT '是否自增',
  `unsigned` tinyint(1) NOT NULL COMMENT '是否有符号位',
  `is_null` tinyint(1) NOT NULL COMMENT '是否为null',
  `extra` varchar(255) NOT NULL COMMENT ' 布尔、枚举、多选、枚举字段类型的定义数据',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `is_show` tinyint(4) DEFAULT '1' COMMENT '是否显示 0不显示 1始终显示 2新增显示 3 编辑显示',
  `is_must` tinyint(1) NOT NULL COMMENT '是否必填',
  `sort` int(11) NOT NULL COMMENT '排序',
  `remark` varchar(255) NOT NULL COMMENT '字段备注',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `langid` text NOT NULL COMMENT '语言',
  `model_id` int(11) NOT NULL COMMENT '模型id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='类目表';

-- ----------------------------
-- Table structure for rt_admin_config
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_config`;
CREATE TABLE `rt_admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Table structure for rt_admin_dbmodel
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_dbmodel`;
CREATE TABLE `rt_admin_dbmodel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `engine_type` varchar(25) NOT NULL COMMENT '引擎类型',
  `langstr` varchar(100) NOT NULL DEFAULT '' COMMENT '模型名称',
  `name` varchar(255) NOT NULL COMMENT '字段名',
  `description` varchar(200) NOT NULL DEFAULT '' COMMENT '描述',
  `searck_key` text NOT NULL COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL COMMENT '高级搜索',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `ispost` tinyint(1) DEFAULT '1' COMMENT '是否允许发布内容',
  `need_pk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否需要主键',
  `isgroup` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否成组',
  `issystem` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否系统',
  `islangs` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否语言',
  `listfields` varchar(255) NOT NULL DEFAULT '' COMMENT '列表字段',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `character` varchar(255) NOT NULL COMMENT '字符',
  `row_format` varchar(255) NOT NULL COMMENT '行格式',
  `auto_increment` int(11) NOT NULL COMMENT '数据自增开始数',
  `postgroup` varchar(100) NOT NULL DEFAULT '' COMMENT 'post组',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `last_edit_uid` enum('4789','456','123') NOT NULL DEFAULT '4789' COMMENT '最后的编辑者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='数据模型表';

-- ----------------------------
-- Table structure for rt_admin_domain
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_domain`;
CREATE TABLE `rt_admin_domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增加ID',
  `model` varchar(50) NOT NULL COMMENT 'APP',
  `controller` varchar(50) NOT NULL COMMENT '控制器',
  `parameter` varchar(200) NOT NULL COMMENT '参数',
  `domain` varchar(255) NOT NULL COMMENT '域名',
  `method` varchar(255) NOT NULL COMMENT '方法',
  `url` varchar(200) NOT NULL COMMENT '分派的URL',
  `remark` varchar(250) NOT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='域名分派表';

-- ----------------------------
-- Table structure for rt_admin_extend
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_extend`;
CREATE TABLE `rt_admin_extend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL COMMENT '支付工具名称',
  `subjection` varchar(30) NOT NULL COMMENT '分组',
  `module` varchar(80) NOT NULL COMMENT '分组模型名称',
  `version` varchar(30) NOT NULL COMMENT '版本',
  `config` text NOT NULL COMMENT '配置参数',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `status_time` int(11) NOT NULL COMMENT '状态修改时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `isshow` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '显示排序',
  `pc` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支持PC',
  `wap_app` tinyint(1) NOT NULL DEFAULT '0' COMMENT '移动端支持',
  `api` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'API调用支持',
  `other` tinyint(1) NOT NULL DEFAULT '0' COMMENT '异形邢台支持',
  `allow_uninstall` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许卸载',
  `lang_list` text NOT NULL COMMENT '支持的语言列',
  `is_del` int(11) NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rt_payment_id_uindex` (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='插件&扩展';

-- ----------------------------
-- Table structure for rt_admin_hook
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_hook`;
CREATE TABLE `rt_admin_hook` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `clan` varchar(50) NOT NULL COMMENT '类名',
  `np` varchar(200) NOT NULL COMMENT '名字空间',
  `func` varchar(50) NOT NULL COMMENT '函数名称',
  `update_time` int(11) NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='钩子';

-- ----------------------------
-- Table structure for rt_admin_mailnoite
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_mailnoite`;
CREATE TABLE `rt_admin_mailnoite` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` int(11) NOT NULL COMMENT '标题',
  `contents` int(11) NOT NULL COMMENT '内容',
  `create_time` int(11) NOT NULL COMMENT '录入时间',
  `send_time` int(11) NOT NULL COMMENT '发送时间',
  `cron_time` int(11) NOT NULL COMMENT '定时发送时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `status` int(11) NOT NULL COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `langid` int(11) NOT NULL COMMENT '语言',
  `apps` int(11) NOT NULL COMMENT '适用APP',
  `uids` int(11) NOT NULL COMMENT '需要 通知的用户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='邮件通知';

-- ----------------------------
-- Table structure for rt_admin_manager
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_manager`;
CREATE TABLE `rt_admin_manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `roleid` int(11) NOT NULL COMMENT '角色ID',
  `nickname` char(20) NOT NULL COMMENT '昵称',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `headimg` varchar(255) NOT NULL COMMENT '图像',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别',
  `login` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `score` mediumint(9) NOT NULL COMMENT '分数',
  `verify` varchar(30) NOT NULL COMMENT '认证',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户状态',
  `langid` text NOT NULL,
  `token` varchar(32) NOT NULL,
  `operator` varchar(50) NOT NULL COMMENT '操作员',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `mobile` (`mobile`) USING BTREE,
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for rt_admin_message
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_message`;
CREATE TABLE `rt_admin_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `appid` varchar(50) NOT NULL COMMENT '所属模块',
  `msgid` varchar(100) NOT NULL COMMENT '消息ID',
  `msgtpl` text NOT NULL COMMENT '模板内容',
  `type` varchar(50) NOT NULL COMMENT '消息类型',
  `num` int(11) NOT NULL COMMENT '次数',
  `expire` int(11) NOT NULL COMMENT '过期时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `langid` varchar(50) NOT NULL COMMENT '所属语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='消息记录';

-- ----------------------------
-- Table structure for rt_admin_module
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_module`;
CREATE TABLE `rt_admin_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(100) NOT NULL COMMENT '模块英文名称',
  `version` varchar(50) NOT NULL COMMENT '版本',
  `config` text NOT NULL COMMENT '序列化的配置参数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` tinyint(3) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status_time` int(11) DEFAULT '0',
  `allow_uninstall` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许卸载：1允许，0不允许',
  `is_del` int(11) NOT NULL DEFAULT '0' COMMENT '是否已删除：有值 时已删除，空未删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='应用&模块表';

-- ----------------------------
-- Table structure for rt_admin_noite
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_noite`;
CREATE TABLE `rt_admin_noite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(150) NOT NULL COMMENT '消息标题',
  `android` tinyint(1) NOT NULL DEFAULT '0' COMMENT '安卓',
  `ios` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'IOS',
  `wechat` tinyint(1) NOT NULL DEFAULT '0' COMMENT '微信',
  `sms` tinyint(1) NOT NULL DEFAULT '0' COMMENT '短信',
  `contents` text NOT NULL COMMENT '通知内容',
  `url` varchar(255) NOT NULL COMMENT '转向URL',
  `start_time` int(11) NOT NULL COMMENT '起始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `send_time` int(11) NOT NULL COMMENT '发送时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sendres` text NOT NULL COMMENT '发送结果',
  `cron_time` int(11) NOT NULL COMMENT '定时时间',
  `sort` int(11) NOT NULL COMMENT '级别',
  `langid` text NOT NULL COMMENT '语言',
  `uid` int(11) NOT NULL COMMENT '发布人ID',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '消息类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='消息及通知';

-- ----------------------------
-- Table structure for rt_admin_payments
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_payments`;
CREATE TABLE `rt_admin_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '支付名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:线上、2:线下',
  `class_name` varchar(50) NOT NULL COMMENT '支付类名称',
  `description` text COMMENT '描述',
  `logo` varchar(255) NOT NULL COMMENT '支付方式logo图片路径',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '安装状态 0启用 1禁用',
  `order` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `note` text COMMENT '支付说明',
  `poundage` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `poundage_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '手续费方式 1百分比 2固定值',
  `config_param` text COMMENT '配置参数,json数据对象',
  `client_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PC端 2:移动端 3:通用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付方式配置记录';

-- ----------------------------
-- Table structure for rt_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_role`;
CREATE TABLE `rt_admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级角色',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `alias` varchar(50) NOT NULL COMMENT '别名',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '角色描述',
  `menu_auth` text NOT NULL COMMENT '菜单权限',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `access` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否可登录后台',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Table structure for rt_admin_seo
-- ----------------------------
DROP TABLE IF EXISTS `rt_admin_seo`;
CREATE TABLE `rt_admin_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `apps` text NOT NULL COMMENT '适用APP',
  `contents` text NOT NULL COMMENT '内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 ',
  `controller` varchar(50) NOT NULL COMMENT '控制器',
  `action` varchar(50) NOT NULL COMMENT '动作',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='SEO规则记录表';

-- ----------------------------
-- Table structure for rt_bcwareexp_area
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_area`;
CREATE TABLE `rt_bcwareexp_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目',
  `name` varchar(200) NOT NULL COMMENT '地区名',
  `main_lang` varchar(20) NOT NULL COMMENT '主要语言',
  `level` smallint(5) NOT NULL DEFAULT '0' COMMENT '层级',
  `banner_img` varchar(200) NOT NULL COMMENT '国旗/地区图标',
  `code` varchar(20) NOT NULL COMMENT '地区代码',
  `organization` smallint(2) DEFAULT '0' COMMENT '所属组织',
  `delta` smallint(2) DEFAULT '1' COMMENT '洲',
  `timezoneid` int(11) NOT NULL DEFAULT '0' COMMENT '时区',
  `areacode` varchar(12) NOT NULL COMMENT '区号',
  `zipcode` varchar(10) NOT NULL COMMENT '邮编',
  `lng` varchar(50) NOT NULL COMMENT '经度',
  `lat` varchar(50) NOT NULL COMMENT '纬度',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `isdefault` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否默认',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `from` varchar(50) NOT NULL COMMENT '来自',
  `countrycode` varchar(15) NOT NULL COMMENT '海关国别代码',
  `type` tinyint(1) NOT NULL COMMENT '0省，2市，3县',
  `langid` varchar(20) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `code` (`pid`,`code`,`zipcode`,`countrycode`,`langid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=820001 DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
-- Table structure for rt_bcwareexp_country
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_country`;
CREATE TABLE `rt_bcwareexp_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(128) NOT NULL COMMENT '英文名',
  `name` varchar(20) NOT NULL COMMENT '中文名称',
  `countrycode` varchar(15) NOT NULL COMMENT '海关国别代码',
  `code` varchar(32) NOT NULL COMMENT '行政地区代码',
  `iso_code_3` varchar(3) NOT NULL COMMENT 'iso code 3',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `main_lang` varchar(20) NOT NULL COMMENT '主要语言',
  `level` smallint(5) NOT NULL COMMENT '层级',
  `banner_img` varchar(255) NOT NULL COMMENT '国旗/地区图标',
  `timezoneid` int(11) NOT NULL COMMENT '时区',
  `sort` int(11) NOT NULL COMMENT '排序',
  `isdefault` tinyint(1) NOT NULL COMMENT '是否默认',
  `zipcode` varchar(10) NOT NULL COMMENT '邮编',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类',
  `langid` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `index` (`langid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COMMENT='国家表';

-- ----------------------------
-- Table structure for rt_bcwareexp_crossware
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_crossware`;
CREATE TABLE `rt_bcwareexp_crossware` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(50) NOT NULL COMMENT '仓库名',
  `code` varchar(20) NOT NULL COMMENT '仓库代码',
  `address` text NOT NULL COMMENT '仓库地址',
  `url` varchar(255) NOT NULL COMMENT '仓库官方地址',
  `adminurl` varchar(255) NOT NULL COMMENT '仓库管理后台',
  `rebackaddr` varchar(255) NOT NULL COMMENT '退货地址',
  `mobile` varchar(100) NOT NULL COMMENT '联系电话',
  `contacts` varchar(100) NOT NULL COMMENT '联系人',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  `rule` text NOT NULL COMMENT '规则',
  `expresstplid` varchar(255) NOT NULL COMMENT '快递模板',
  `type` varchar(64) NOT NULL COMMENT 'normal：普通，bonded：保税，pay_taxes：完税，direct_mail：直邮',
  `create_time` int(11) NOT NULL COMMENT '创建 时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL COMMENT '排序 ',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='跨境仓库';

-- ----------------------------
-- Table structure for rt_bcwareexp_currency
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_currency`;
CREATE TABLE `rt_bcwareexp_currency` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '货币英文名称',
  `langstr` varchar(30) NOT NULL COMMENT '货币名称',
  `symbol` varchar(3) NOT NULL COMMENT '货币符号',
  `place` varchar(20) NOT NULL COMMENT '可用于',
  `place_n` varchar(10) NOT NULL DEFAULT '100' COMMENT '价格数',
  `code` varchar(4) NOT NULL COMMENT '货币代码',
  `rate` decimal(15,8) NOT NULL DEFAULT '0.00000000' COMMENT '汇率',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否默认',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='货币表';

-- ----------------------------
-- Table structure for rt_bcwareexp_express
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_express`;
CREATE TABLE `rt_bcwareexp_express` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(100) NOT NULL COMMENT '快递名称',
  `fulltitle` varchar(150) NOT NULL COMMENT '全称',
  `firstchar` varchar(2) NOT NULL COMMENT '首字母',
  `code` varchar(20) NOT NULL COMMENT '物流公司代码',
  `tel` varchar(20) DEFAULT NULL COMMENT '快递电话',
  `description` varchar(120) NOT NULL COMMENT '介绍',
  `icon` varchar(255) NOT NULL COMMENT '图标',
  `logo` text NOT NULL COMMENT '快递logo',
  `website` varchar(255) NOT NULL COMMENT '官方网站',
  `checkurl` text NOT NULL COMMENT '查件网址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常，0禁用',
  `isdelivery` tinyint(1) NOT NULL DEFAULT '0' COMMENT '货到付款1是，0否',
  `isrecom` int(11) NOT NULL COMMENT '是否推荐',
  `isinsurance` varchar(20) DEFAULT NULL COMMENT '物流保价额度',
  `allow_ele` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许电子面单',
  `username` varchar(100) NOT NULL COMMENT '电子面单用户名',
  `password` varchar(100) NOT NULL COMMENT '电子面单密码',
  `singstr` varchar(100) NOT NULL COMMENT '电子面单检验串',
  `sort` int(11) NOT NULL COMMENT '排序',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `last_edit_uid` int(11) NOT NULL COMMENT '最后操作者ID',
  `langid` text NOT NULL COMMENT '语种',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='跨境电商快递表';

-- ----------------------------
-- Table structure for rt_bcwareexp_expresstpl
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_expresstpl`;
CREATE TABLE `rt_bcwareexp_expresstpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增加ID',
  `title` int(11) NOT NULL COMMENT '标题',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  `expressid` int(11) NOT NULL COMMENT '关联快递',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='运费模板';

-- ----------------------------
-- Table structure for rt_bcwareexp_takeself
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_takeself`;
CREATE TABLE `rt_bcwareexp_takeself` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '名称',
  `name` varchar(50) NOT NULL COMMENT '联系人',
  `country_id` int(11) NOT NULL COMMENT '国家',
  `province` int(11) NOT NULL COMMENT '省份ID',
  `city` int(11) NOT NULL COMMENT '城市ID',
  `area` int(11) NOT NULL COMMENT '地区ID',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `tel` varchar(30) DEFAULT NULL COMMENT '座机号码',
  `mobile` varchar(30) DEFAULT NULL COMMENT '手机号码',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` int(11) NOT NULL COMMENT '状态',
  `langid` text NOT NULL COMMENT '适用语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品物流自提地点';

-- ----------------------------
-- Table structure for rt_bcwareexp_zone
-- ----------------------------
DROP TABLE IF EXISTS `rt_bcwareexp_zone`;
CREATE TABLE `rt_bcwareexp_zone` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '区域名称',
  `province` int(11) NOT NULL COMMENT '省级id',
  `city` text NOT NULL COMMENT '市级id',
  `country` int(11) NOT NULL COMMENT '国级id',
  `sort` int(11) NOT NULL,
  `langid` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='区域表';

-- ----------------------------
-- Table structure for rt_bigdata_encry
-- ----------------------------
DROP TABLE IF EXISTS `rt_bigdata_encry`;
CREATE TABLE `rt_bigdata_encry` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动ID',
  `text` varchar(200) NOT NULL COMMENT '密文',
  `md5` text NOT NULL COMMENT '小写md5加密密文',
  `sha1` text NOT NULL COMMENT 'sha1加密',
  `md4` text NOT NULL COMMENT 'md4加密',
  `mysql` text NOT NULL COMMENT 'mysql密文',
  `mysql5` int(11) NOT NULL COMMENT 'mysql5密文',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '可用状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='加密密文表';

-- ----------------------------
-- Table structure for rt_bigdata_hscode
-- ----------------------------
DROP TABLE IF EXISTS `rt_bigdata_hscode`;
CREATE TABLE `rt_bigdata_hscode` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动 ID',
  `code` varchar(50) DEFAULT NULL COMMENT '商品海关代码',
  `title` varchar(255) DEFAULT NULL COMMENT '商品名称',
  `unit` varchar(20) DEFAULT NULL COMMENT '包装单位',
  `hsrecord` varchar(120) DEFAULT NULL COMMENT '海关备案号',
  `hsmodel` varchar(255) DEFAULT NULL COMMENT '海关型号',
  `hsnationalrecord` varchar(255) DEFAULT NULL COMMENT '国检备案号',
  `hsquarantinemodel` varchar(200) DEFAULT NULL COMMENT '检疫型号',
  `country` varchar(50) DEFAULT NULL COMMENT '所属国家',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) DEFAULT NULL COMMENT '录入时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `visit_time` int(11) DEFAULT NULL COMMENT '最后一次访问时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品海关编码信息';

-- ----------------------------
-- Table structure for rt_bigdata_persion
-- ----------------------------
DROP TABLE IF EXISTS `rt_bigdata_persion`;
CREATE TABLE `rt_bigdata_persion` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动 ID',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `cardno` varchar(25) NOT NULL COMMENT '身份证号',
  `addr` varchar(255) NOT NULL COMMENT '身份证地址',
  `newaddr` varchar(255) NOT NULL COMMENT '迁址后的身份证地址',
  `sex` enum('男','女') NOT NULL DEFAULT '男' COMMENT '性别',
  `mobile` varchar(20) NOT NULL COMMENT '最后手机号',
  `positive` text NOT NULL COMMENT '身份证正面',
  `opposite` text NOT NULL COMMENT '身份证反面',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 ',
  `create_time` int(11) NOT NULL COMMENT '录入时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `last_use_time` int(11) NOT NULL COMMENT '最后一次使用时间',
  `langid` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='身份信息';

-- ----------------------------
-- Table structure for rt_cms_area
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_area`;
CREATE TABLE `rt_cms_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自动ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目',
  `name` varchar(200) NOT NULL COMMENT '地区名',
  `main_lang` varchar(20) NOT NULL COMMENT '主要语言',
  `level` smallint(5) NOT NULL DEFAULT '0' COMMENT '层级',
  `banner_img` varchar(200) NOT NULL COMMENT '国旗/地区图标',
  `code` varchar(20) NOT NULL COMMENT '地区代码',
  `organization` smallint(2) DEFAULT '0' COMMENT '所属组织',
  `delta` smallint(2) DEFAULT '1' COMMENT '洲',
  `timezoneid` int(11) NOT NULL DEFAULT '0' COMMENT '时区',
  `areacode` varchar(12) NOT NULL COMMENT '区号',
  `zipcode` varchar(10) NOT NULL COMMENT '邮编',
  `lng` varchar(50) NOT NULL COMMENT '经度',
  `lat` varchar(50) NOT NULL COMMENT '纬度',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `isdefault` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否默认',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `from` varchar(50) NOT NULL COMMENT '来自',
  `countrycode` varchar(15) NOT NULL COMMENT '海关国别代码',
  `type` tinyint(1) NOT NULL COMMENT '0省，2市，3县',
  `langid` varchar(20) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`),
  KEY `code` (`pid`,`code`,`zipcode`,`countrycode`,`langid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=820001 DEFAULT CHARSET=utf8 COMMENT='地区表';

-- ----------------------------
-- Table structure for rt_cms_article
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_article`;
CREATE TABLE `rt_cms_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `author` varchar(40) NOT NULL COMMENT '文章作者',
  `author_email` varchar(60) NOT NULL COMMENT '作者邮箱',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `about` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `contents` text NOT NULL,
  `tags` varchar(255) NOT NULL COMMENT '标签',
  `file_url` varchar(255) NOT NULL COMMENT '上传文件或者外部文件的url',
  `cover_image` varchar(255) NOT NULL COMMENT '文章封面图',
  `article_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '内容类型',
  `link` varchar(255) NOT NULL COMMENT '链接地址',
  `open_type` tinyint(1) NOT NULL COMMENT '0,正常; 当该字段为1或2时,会在文章最后添加一个链接’相关下载’,连接地址等于file_url的值;',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `is_comment` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否评论',
  `is_top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶',
  `is_review` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示;1显示;0不显示 ',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `sort` int(11) NOT NULL,
  `langid` varchar(20) NOT NULL,
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文档模型基础表';

-- ----------------------------
-- Table structure for rt_cms_articlecat
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_articlecat`;
CREATE TABLE `rt_cms_articlecat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT '分类标识',
  `title` varchar(40) NOT NULL COMMENT '分类名称',
  `cat_type` varchar(20) NOT NULL DEFAULT '' COMMENT '分类类型 1,普通分类2,系统分类 3,网店信息 4, 帮助分类 5,网店帮助',
  `keywords` varchar(255) NOT NULL COMMENT '分类关键字',
  `cat_desc` varchar(255) NOT NULL COMMENT '分类说明文字',
  `sort` tinyint(4) NOT NULL COMMENT '排序',
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在导航栏显示 0 否 ;  1 是',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父节点id，取值于该表id字段',
  `alias` varchar(40) NOT NULL COMMENT '别名',
  `status` tinyint(1) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Table structure for rt_cms_category
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_category`;
CREATE TABLE `rt_cms_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(255) NOT NULL COMMENT '标识',
  `firstchar` varchar(1) NOT NULL COMMENT '首字母',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `mobtitle` varchar(50) NOT NULL COMMENT '移动端显示名称',
  `catimage` text NOT NULL COMMENT '栏目图片',
  `groupbys` int(11) NOT NULL COMMENT '分组',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `class` varchar(255) NOT NULL COMMENT '栏目CLASS',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `listrow` tinyint(3) unsigned NOT NULL DEFAULT '25' COMMENT '列表每页行数',
  `seo_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL DEFAULT '' COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `is_reply` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `api_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'api状态',
  `wap_hits` int(11) NOT NULL COMMENT '手机端点击数',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '移动端状态',
  `pc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'pc状态',
  `pc_hits` int(11) NOT NULL COMMENT 'pc端点击',
  `urlruleid` tinyint(2) NOT NULL DEFAULT '0' COMMENT '地址规则',
  `listtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否封面',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分类类目';

-- ----------------------------
-- Table structure for rt_cms_country
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_country`;
CREATE TABLE `rt_cms_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `en_name` varchar(128) NOT NULL COMMENT '英文名',
  `name` varchar(20) NOT NULL COMMENT '中文名称',
  `countrycode` varchar(15) NOT NULL COMMENT '海关国别代码',
  `code` varchar(32) NOT NULL COMMENT '行政地区代码',
  `iso_code_3` varchar(3) NOT NULL COMMENT 'iso code 3',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `main_lang` varchar(20) NOT NULL COMMENT '主要语言',
  `level` smallint(5) NOT NULL COMMENT '层级',
  `banner_img` varchar(255) NOT NULL COMMENT '国旗/地区图标',
  `timezoneid` int(11) NOT NULL COMMENT '时区',
  `sort` int(11) NOT NULL COMMENT '排序',
  `isdefault` tinyint(1) NOT NULL COMMENT '是否默认',
  `zipcode` varchar(10) NOT NULL COMMENT '邮编',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父类',
  `langid` varchar(20) NOT NULL DEFAULT 'zh_cn',
  PRIMARY KEY (`id`),
  KEY `index` (`langid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COMMENT='国家表';

-- ----------------------------
-- Table structure for rt_cms_currency
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_currency`;
CREATE TABLE `rt_cms_currency` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '货币英文名称',
  `langstr` varchar(30) NOT NULL COMMENT '货币名称',
  `symbol` varchar(3) NOT NULL COMMENT '货币符号',
  `place` varchar(20) NOT NULL COMMENT '可用于',
  `place_n` varchar(10) NOT NULL DEFAULT '100' COMMENT '价格数',
  `code` varchar(4) NOT NULL COMMENT '货币代码',
  `rate` decimal(15,8) NOT NULL DEFAULT '0.00000000' COMMENT '汇率',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否默认',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='货币表';

-- ----------------------------
-- Table structure for rt_cms_home
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_home`;
CREATE TABLE `rt_cms_home` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '首页标识',
  `title` varchar(30) NOT NULL COMMENT '首页名称',
  `remark` varchar(255) NOT NULL COMMENT '首页备注',
  `preview_img` varchar(255) NOT NULL COMMENT '首页预览图',
  `module` varchar(20) NOT NULL COMMENT '首页所属模块',
  `controller` varchar(20) NOT NULL COMMENT '首页所属控制器',
  `action` varchar(20) NOT NULL COMMENT '首页所属方法',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `langid` varchar(20) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章首页';

-- ----------------------------
-- Table structure for rt_cms_item
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_item`;
CREATE TABLE `rt_cms_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(255) NOT NULL COMMENT '标识',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `mobtitle` varchar(50) NOT NULL COMMENT '移动端显示名称',
  `catimage` text NOT NULL COMMENT '栏目图片',
  `level` int(11) NOT NULL COMMENT '等级',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `class` varchar(255) NOT NULL COMMENT '栏目CLASS',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `listrow` tinyint(3) unsigned NOT NULL DEFAULT '25' COMMENT '列表每页行数',
  `seo_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL DEFAULT '' COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `is_reply` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `api_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'api状态',
  `wap_hits` int(11) NOT NULL COMMENT '手机端点击',
  `wap_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '手机端状态',
  `pc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'pc端状态',
  `pc_hits` int(11) NOT NULL COMMENT 'pc端点击',
  `urlruleid` tinyint(2) NOT NULL DEFAULT '0' COMMENT '地址规则',
  `listtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否封面',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `langid` text NOT NULL COMMENT '语言',
  `tags` text NOT NULL COMMENT '标签',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类类目';

-- ----------------------------
-- Table structure for rt_cms_itemattr
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_itemattr`;
CREATE TABLE `rt_cms_itemattr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) unsigned NOT NULL COMMENT '属性id',
  `name` varchar(20) NOT NULL COMMENT '属性名',
  `article_id` int(11) unsigned NOT NULL COMMENT '文章id',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`type_id`,`article_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类属性';

-- ----------------------------
-- Table structure for rt_cms_itemmodel
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_itemmodel`;
CREATE TABLE `rt_cms_itemmodel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增DI',
  `name` varchar(40) NOT NULL COMMENT '模型名称',
  `iden` varchar(30) NOT NULL COMMENT '模型标识',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `template_first` varchar(100) NOT NULL COMMENT '模板封面',
  `template_lists` varchar(100) NOT NULL COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL COMMENT '频道页模板',
  `langid` varchar(20) NOT NULL COMMENT '语言',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `attr_id` int(11) NOT NULL COMMENT '属性id',
  `type_id` int(11) NOT NULL COMMENT '分类类型id',
  `specifi_id` int(11) NOT NULL COMMENT '分类规格id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `item_id` int(11) NOT NULL COMMENT '分类id',
  PRIMARY KEY (`id`),
  KEY `index` (`attr_id`,`type_id`,`specifi_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS分类模型';

-- ----------------------------
-- Table structure for rt_cms_itemspecifi
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_itemspecifi`;
CREATE TABLE `rt_cms_itemspecifi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `is_post` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否发布',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` tinyint(2) NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS分类规格表';

-- ----------------------------
-- Table structure for rt_cms_itemtype
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_itemtype`;
CREATE TABLE `rt_cms_itemtype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '类型名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` tinyint(2) NOT NULL DEFAULT '0',
  `langid` varchar(20) NOT NULL,
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS分类属性表';

-- ----------------------------
-- Table structure for rt_cms_item_copy
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_item_copy`;
CREATE TABLE `rt_cms_item_copy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '分类名称',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '分类图标',
  `pid` int(11) NOT NULL COMMENT '上级分类',
  `dir` varchar(200) NOT NULL DEFAULT '' COMMENT '数据类型',
  `keywords` varchar(200) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `tags` text NOT NULL COMMENT '标签',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `is_post` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否发布',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` tinyint(2) NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `langid` text NOT NULL COMMENT '语言',
  `cn_remark` varchar(50) NOT NULL COMMENT '中文备注',
  `level` tinyint(4) NOT NULL COMMENT '等级',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS分类规格表';

-- ----------------------------
-- Table structure for rt_cms_nav
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_nav`;
CREATE TABLE `rt_cms_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '导航标题',
  `link` varchar(255) NOT NULL COMMENT '导航完整链接',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '导航打开方式1-本页打开，2-新页打开',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章导航';

-- ----------------------------
-- Table structure for rt_cms_page
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_page`;
CREATE TABLE `rt_cms_page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '模板名称',
  `page_img` varchar(255) NOT NULL COMMENT '模板预览图',
  `description` text NOT NULL COMMENT '描述',
  `sort` int(11) NOT NULL,
  `langid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `theme` varchar(30) NOT NULL COMMENT '主题',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='单页内容';

-- ----------------------------
-- Table structure for rt_cms_pagecat
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_pagecat`;
CREATE TABLE `rt_cms_pagecat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  `model` varchar(50) NOT NULL COMMENT '归属模型',
  `description` text NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `from` varchar(50) NOT NULL COMMENT '来源/平台',
  `alias` varchar(50) NOT NULL COMMENT '别名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='单页分类';

-- ----------------------------
-- Table structure for rt_cms_posid
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_posid`;
CREATE TABLE `rt_cms_posid` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '0',
  `langid` varchar(20) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) unsigned NOT NULL COMMENT '所属分类',
  `model_id` int(11) NOT NULL COMMENT '所属模型',
  PRIMARY KEY (`id`),
  KEY `model,item` (`item_id`,`model_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='推荐位';

-- ----------------------------
-- Table structure for rt_cms_special
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_special`;
CREATE TABLE `rt_cms_special` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '专题栏目id',
  `name` varchar(50) NOT NULL COMMENT '专题标识',
  `title` varchar(40) NOT NULL COMMENT '专题名称',
  `keywords` varchar(255) NOT NULL COMMENT '专题关键字',
  `template` varchar(100) NOT NULL COMMENT '专题模板文件',
  `seo_rule` text NOT NULL COMMENT 'seo规则',
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `langid` int(11) NOT NULL,
  `contents` text NOT NULL COMMENT '专题详情',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '专题状态1-草稿、2-已发布',
  `explain` varchar(100) NOT NULL COMMENT '专题说明',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专题内容';

-- ----------------------------
-- Table structure for rt_cms_specialcat
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_specialcat`;
CREATE TABLE `rt_cms_specialcat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '标识',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `mobtitle` varchar(50) NOT NULL COMMENT '手机端标题',
  `catimage` varchar(255) NOT NULL COMMENT '分类图片',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `seo_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `is_reply` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `api_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'api状态',
  `wap_hits` int(11) NOT NULL COMMENT '手机端的点击数',
  `wap_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '手机端状态',
  `groupbys` int(11) NOT NULL COMMENT '分组',
  `pc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'pc端状态',
  `pc_hits` int(11) NOT NULL COMMENT 'pc端点击数',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `langid` varchar(255) NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `langid` (`langid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类类目';

-- ----------------------------
-- Table structure for rt_cms_specialcat_liujie
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_specialcat_liujie`;
CREATE TABLE `rt_cms_specialcat_liujie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT '分类标识',
  `title` varchar(40) NOT NULL COMMENT '分类名称',
  `cat_type` varchar(20) NOT NULL DEFAULT '' COMMENT '分类类型 1,普通分类2,系统分类 3,网店信息 4, 帮助分类 5,网店帮助',
  `keywords` varchar(255) NOT NULL COMMENT '分类关键字',
  `cat_desc` varchar(255) NOT NULL COMMENT '分类说明文字',
  `sort` tinyint(4) NOT NULL,
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否在导航栏显示 0 否 ;  1 是',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父节点id，取值于该表id字段',
  `langid` int(11) NOT NULL,
  `alias` varchar(40) NOT NULL COMMENT '别名',
  `status` tinyint(1) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类类目，备份表';

-- ----------------------------
-- Table structure for rt_cms_tags
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_tags`;
CREATE TABLE `rt_cms_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT '标签名',
  `style` varchar(150) NOT NULL COMMENT '标签样式',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `langid` text NOT NULL,
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='标签';

-- ----------------------------
-- Table structure for rt_cms_widget
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_widget`;
CREATE TABLE `rt_cms_widget` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '挂件名称',
  `type_id` int(11) NOT NULL COMMENT '类型id',
  `preview_img` varchar(255) NOT NULL COMMENT '预览图片',
  `langid` varchar(20) NOT NULL COMMENT '语言',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL,
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `file_name` varchar(30) NOT NULL COMMENT '挂件文件名',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容挂件';

-- ----------------------------
-- Table structure for rt_cms_widgettype
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_widgettype`;
CREATE TABLE `rt_cms_widgettype` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '类型名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='挂件类型';

-- ----------------------------
-- Table structure for rt_cms_zipcode
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_zipcode`;
CREATE TABLE `rt_cms_zipcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `areaid` varchar(20) NOT NULL COMMENT '地区id',
  `zip` varchar(20) NOT NULL COMMENT '邮政编码',
  `code` varchar(20) NOT NULL COMMENT '邮政编码',
  PRIMARY KEY (`id`),
  KEY `i` (`areaid`,`zip`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='邮政编码';

-- ----------------------------
-- Table structure for rt_cms_zone
-- ----------------------------
DROP TABLE IF EXISTS `rt_cms_zone`;
CREATE TABLE `rt_cms_zone` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT '区域名称',
  `province` int(11) NOT NULL COMMENT '省级id',
  `city` text NOT NULL COMMENT '市级id',
  `country` int(11) NOT NULL COMMENT '国级id',
  `sort` int(11) NOT NULL,
  `langid` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='区域表';

-- ----------------------------
-- Table structure for rt_crossbbcg_advertising
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_advertising`;
CREATE TABLE `rt_crossbbcg_advertising` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '广告名称',
  `ad_type` varchar(255) NOT NULL COMMENT '广告类型 1图片 2文字',
  `ad_thumb` varchar(255) NOT NULL COMMENT '广告主图',
  `ad_position` varchar(255) NOT NULL COMMENT '广告位置',
  `start_time` int(11) NOT NULL COMMENT '广告开始时间',
  `end_time` int(11) NOT NULL COMMENT '广告结束时间',
  `ad_link` varchar(255) NOT NULL COMMENT '广告链接',
  `background_color` varchar(255) NOT NULL COMMENT '背景色',
  `ad_info` varchar(255) NOT NULL COMMENT '广告详情',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `pc_status` tinyint(1) NOT NULL COMMENT 'pc端状态',
  `wap_status` tinyint(1) NOT NULL COMMENT '手机端状态',
  `api_status` tinyint(1) NOT NULL COMMENT 'api状态',
  `sort_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '排序类型 0按排序值 1热卖（商品销量） 2 折扣（商品折扣） 3 新品（商品上架时间）',
  `sort` int(11) NOT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `langid` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=utf8 COMMENT='跨境广告表';

-- ----------------------------
-- Table structure for rt_crossbbcg_ad_position
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_ad_position`;
CREATE TABLE `rt_crossbbcg_ad_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '广告位名称',
  `width` decimal(6,2) NOT NULL COMMENT '广告位宽度',
  `height` decimal(6,2) NOT NULL COMMENT '广告位高度',
  `description` varchar(255) NOT NULL COMMENT '广告位描述',
  `ad_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '广告类型 1图文广告 2商品广告',
  `sort_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商品广告排序类型 0排序值 1热卖（商品销量） 2折扣（商品折扣） 3新品（商品上架时间）',
  `pc_status` tinyint(1) NOT NULL COMMENT 'pc状态',
  `wap_status` tinyint(1) NOT NULL COMMENT 'wap状态',
  `api_status` tinyint(1) NOT NULL COMMENT 'api状态',
  `langid` varchar(10) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='跨境广告位置表';

-- ----------------------------
-- Table structure for rt_crossbbcg_attribute
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_attribute`;
CREATE TABLE `rt_crossbbcg_attribute` (
  `attribute_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '参数id',
  `name` varchar(64) NOT NULL COMMENT '参数名称',
  `attribute_group_id` int(11) NOT NULL COMMENT '参数组',
  `filtrate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '搜索页作为筛选参数,1表示可以筛选，0表示不能筛选',
  `attribute_value` varchar(500) NOT NULL COMMENT '参数值,多个逗号隔开',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COMMENT='商品参数表';

-- ----------------------------
-- Table structure for rt_crossbbcg_attribute_group
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_attribute_group`;
CREATE TABLE `rt_crossbbcg_attribute_group` (
  `attribute_group_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '属性组id',
  `name` varchar(64) NOT NULL COMMENT '参数组名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='参数组表';

-- ----------------------------
-- Table structure for rt_crossbbcg_brand
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_brand`;
CREATE TABLE `rt_crossbbcg_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `firstchar` char(1) NOT NULL COMMENT '首字母',
  `name` varchar(60) NOT NULL COMMENT '品牌名',
  `alias` varchar(60) NOT NULL COMMENT '别名',
  `description` text NOT NULL COMMENT '品牌描述',
  `url` varchar(255) NOT NULL COMMENT '网址',
  `pcat` int(11) NOT NULL COMMENT '主分类',
  `cat` int(11) NOT NULL COMMENT '隶属分类子分类',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `isrecommend` tinyint(1) NOT NULL COMMENT '推荐',
  `istop` tinyint(1) NOT NULL COMMENT '置顶',
  `logo` varchar(255) NOT NULL COMMENT '品牌logo',
  `banner_image` varchar(255) NOT NULL COMMENT '大的品牌图',
  `country_id` int(11) unsigned NOT NULL COMMENT '国家id',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Table structure for rt_crossbbcg_cart
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_cart`;
CREATE TABLE `rt_crossbbcg_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车id',
  `member_id` int(11) NOT NULL COMMENT '会员id',
  `session_id` varchar(32) NOT NULL COMMENT 'session_id',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `sku` varchar(64) NOT NULL COMMENT 'sku',
  `num` int(11) NOT NULL COMMENT '购买数量',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT '选中状态',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_id` (`good_id`,`member_id`,`session_id`,`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='购物车';

-- ----------------------------
-- Table structure for rt_crossbbcg_category
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_category`;
CREATE TABLE `rt_crossbbcg_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `wap_title` varchar(255) NOT NULL COMMENT '手机端标题',
  `name` varchar(255) NOT NULL COMMENT '标识',
  `meta_title` varchar(255) NOT NULL COMMENT '页面标题',
  `description` text NOT NULL COMMENT '分类描述',
  `catimage` varchar(255) NOT NULL COMMENT '分类图片',
  `kickback` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '分佣比率，0-100',
  `class` varchar(255) NOT NULL COMMENT '栏目CLASS',
  `urlruleid` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'url规则id',
  `pc_status` tinyint(1) NOT NULL COMMENT 'pc端状态',
  `wap_status` tinyint(1) NOT NULL COMMENT 'wap端状态',
  `api_status` tinyint(1) NOT NULL COMMENT 'api状态',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `listtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否封面',
  `template_index` varchar(100) NOT NULL DEFAULT '' COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `brand_ids` varchar(500) NOT NULL COMMENT '品牌ids',
  `option_ids` varchar(500) NOT NULL COMMENT '规格ids',
  `attribute_group_ids` varchar(500) NOT NULL COMMENT '参数组id',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `urlruleid` (`urlruleid`)
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Table structure for rt_crossbbcg_category_path
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_category_path`;
CREATE TABLE `rt_crossbbcg_category_path` (
  `category_id` int(11) NOT NULL COMMENT '分类id',
  `path_id` int(11) NOT NULL COMMENT '上级分类id',
  `level` int(11) NOT NULL COMMENT '上级分类id的深度等级,0是最顶层',
  PRIMARY KEY (`category_id`,`path_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类层级关系，支持无限级关系';

-- ----------------------------
-- Table structure for rt_crossbbcg_crossware
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_crossware`;
CREATE TABLE `rt_crossbbcg_crossware` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(50) NOT NULL COMMENT '仓库名',
  `code` varchar(20) NOT NULL COMMENT '仓库代码',
  `address` text NOT NULL COMMENT '仓库地址',
  `url` varchar(255) NOT NULL COMMENT '仓库官方地址',
  `adminurl` varchar(255) NOT NULL COMMENT '仓库管理后台',
  `rebackaddr` varchar(255) NOT NULL COMMENT '退货地址',
  `mobile` varchar(100) NOT NULL COMMENT '联系电话',
  `contacts` varchar(100) NOT NULL COMMENT '联系人',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  `rule` text NOT NULL COMMENT '规则',
  `expresstplid` varchar(255) NOT NULL COMMENT '快递模板',
  `create_time` int(11) NOT NULL COMMENT '创建 时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL COMMENT '排序 ',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='跨境仓库';

-- ----------------------------
-- Table structure for rt_crossbbcg_express
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_express`;
CREATE TABLE `rt_crossbbcg_express` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(100) NOT NULL COMMENT '快递名称',
  `fulltitle` varchar(150) NOT NULL COMMENT '全称',
  `firstchar` varchar(2) NOT NULL COMMENT '首字母',
  `code` varchar(20) NOT NULL COMMENT '物流公司代码',
  `tel` varchar(20) DEFAULT NULL COMMENT '快递电话',
  `description` varchar(120) NOT NULL COMMENT '介绍',
  `icon` varchar(255) NOT NULL COMMENT '图标',
  `logo` text NOT NULL COMMENT '快递logo',
  `website` varchar(255) NOT NULL COMMENT '官方网站',
  `checkurl` text NOT NULL COMMENT '查件网址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常，0禁用',
  `isdelivery` tinyint(1) NOT NULL DEFAULT '0' COMMENT '货到付款1是，0否',
  `isrecom` int(11) NOT NULL,
  `isinsurance` varchar(20) DEFAULT NULL COMMENT '物流保价额度',
  `allow_ele` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许电子面单',
  `username` varchar(100) NOT NULL COMMENT '电子面单用户名',
  `password` varchar(100) NOT NULL COMMENT '电子面单密码',
  `singstr` varchar(100) NOT NULL COMMENT '电子面单检验串',
  `sort` int(11) NOT NULL COMMENT '排序',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `last_edit_uid` int(11) NOT NULL COMMENT '最后操作者ID',
  `langid` text NOT NULL COMMENT '语种',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='跨境电商快递表';

-- ----------------------------
-- Table structure for rt_crossbbcg_expresstpl
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_expresstpl`;
CREATE TABLE `rt_crossbbcg_expresstpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增加ID',
  `title` int(11) NOT NULL COMMENT '标题',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  `expressid` int(11) NOT NULL COMMENT '关联快递',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='运费模板';

-- ----------------------------
-- Table structure for rt_crossbbcg_filter
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_filter`;
CREATE TABLE `rt_crossbbcg_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(500) NOT NULL COMMENT '搜素词,多个词逗号分割',
  `option_ids` varchar(500) NOT NULL COMMENT '选项id',
  `brand_ids` varchar(500) NOT NULL COMMENT '品牌id',
  `country_ids` varchar(500) NOT NULL COMMENT '国家id',
  `attribute_group_ids` varchar(500) NOT NULL COMMENT '参数组ids',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='搜索词设定筛选属性表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods`;
CREATE TABLE `rt_crossbbcg_goods` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '商品id,自增主键',
  `name` varchar(64) NOT NULL COMMENT '商品名称',
  `en_name` varchar(255) NOT NULL COMMENT '商品英文名称',
  `sub_title` varchar(255) NOT NULL COMMENT '副标题',
  `meta_title` varchar(255) NOT NULL COMMENT '页面标题',
  `meta_description` varchar(255) NOT NULL COMMENT 'seo 描述',
  `video` varchar(500) NOT NULL COMMENT '视频html地址',
  `tags` varchar(500) NOT NULL COMMENT '商品标签',
  `pc_description` text NOT NULL COMMENT 'pc端描述',
  `wap_description` text NOT NULL COMMENT '手机端描述',
  `cat_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '末级分类id，方便计算分类佣金',
  `brand_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '品牌id',
  `thumb` varchar(255) NOT NULL COMMENT '商品主图',
  `list_img` text NOT NULL COMMENT '商品图册',
  `package_unit` varchar(20) NOT NULL COMMENT '包装单位',
  `package_num` smallint(6) unsigned NOT NULL DEFAULT '1' COMMENT '包装件数',
  `package_charge` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '分拣打包费',
  `domestic_freight` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '国内运费',
  `weight` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '毛重',
  `clear_weight` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '净重',
  `weight_class_id` varchar(20) NOT NULL COMMENT '商品重量单位',
  `viewed` int(11) NOT NULL DEFAULT '0' COMMENT '商品浏览次数',
  `country_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属国家id',
  `tax_rate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '税率',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品市场价格',
  `sale_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品销售价格',
  `cost_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品成本价格',
  `points_price` int(11) NOT NULL DEFAULT '0' COMMENT '商品的积分价，0表示不可用积分购买',
  `points` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '购买该商品时每笔成功交易赠送的积分数量',
  `prom_id` int(11) NOT NULL DEFAULT '0' COMMENT '促销类型ID',
  `prom_type` varchar(64) NOT NULL COMMENT '促销类型标识',
  `kickback` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '佣金，0-100',
  `pv` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '利润',
  `good_code` varchar(64) NOT NULL COMMENT '商品编码，唯一',
  `promise` varchar(64) NOT NULL COMMENT '商品的服务承诺',
  `hs_code` varchar(64) NOT NULL COMMENT '海关编码',
  `hs_model` varchar(64) NOT NULL COMMENT '海关型号',
  `hs_quarantine_model` varchar(64) NOT NULL COMMENT '检疫型号',
  `hs_unit` varchar(64) NOT NULL COMMENT '海关计量单位',
  `type` varchar(64) NOT NULL COMMENT 'normal：普通，bonded：保税，pay_taxes：完税，direct_mail：直邮',
  `status` varchar(64) NOT NULL DEFAULT 'enabled' COMMENT 'recycle : 回收\r\ndisabled : 下架\r\nenabled : 上架\r\npending_review : 待审\r\npending_modify : 待修',
  `pc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'pc 端状态 0 停用 1 启用',
  `wap_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'wap 端状态 0 停用 1 启用',
  `api_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'api 端状态 0 停用 1 启用',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '商品库存',
  `offline_quantity` int(11) NOT NULL DEFAULT '0' COMMENT '线下库存',
  `minimum` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '商品最小订购量',
  `maximum` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品的最大购买量',
  `subtract` tinyint(1) NOT NULL DEFAULT '1' COMMENT '减库存方式\r\n2：下单减库存\r\n1：付款减库存\r\n0：不减库存',
  `seller_id` int(11) NOT NULL COMMENT '商家id',
  `sales_volume` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品销量',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1459 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_attribute
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_attribute`;
CREATE TABLE `rt_crossbbcg_goods_attribute` (
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `attribute_group_id` int(11) NOT NULL COMMENT '参数组id',
  `attribute_id` int(11) NOT NULL COMMENT '参数值id',
  `value` varchar(255) NOT NULL COMMENT '参数值',
  PRIMARY KEY (`good_id`,`attribute_group_id`,`attribute_id`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品关联参数表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_blocked_stock
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_blocked_stock`;
CREATE TABLE `rt_crossbbcg_goods_blocked_stock` (
  `sku` varchar(64) NOT NULL COMMENT 'sku',
  `crossware_code` varchar(20) NOT NULL COMMENT '仓库id',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `quantity` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '冻结的库存量',
  PRIMARY KEY (`sku`,`crossware_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品库存冻结表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_image
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_image`;
CREATE TABLE `rt_crossbbcg_goods_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id自增',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `image` varchar(255) NOT NULL COMMENT '图片地址',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `product_id` (`good_id`)
) ENGINE=InnoDB AUTO_INCREMENT=886 DEFAULT CHARSET=utf8 COMMENT='商品图片表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_sku
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_sku`;
CREATE TABLE `rt_crossbbcg_goods_sku` (
  `sku` varchar(64) NOT NULL COMMENT 'sku',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `merge_option_value_id` varchar(255) NOT NULL COMMENT '选项值id组合，格式如1_2_3_4',
  `name` varchar(500) NOT NULL COMMENT '选项值合并的名称，如：\r\n颜色:红色;裤长:100cm',
  `good_batch` varchar(64) NOT NULL COMMENT '产品批次',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '库存量,商户各仓库总库存量',
  `offline_quantity` int(11) NOT NULL DEFAULT '0' COMMENT '线下库存',
  `market_price` decimal(10,2) NOT NULL COMMENT '市场价',
  `sale_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价格',
  `cost_price` decimal(10,2) NOT NULL COMMENT '成本价',
  `good_barcode` varchar(64) NOT NULL COMMENT '型号',
  `hs_record` varchar(64) NOT NULL COMMENT '海关备案号',
  `hs_national_record` varchar(64) NOT NULL COMMENT '国检备案号',
  PRIMARY KEY (`sku`,`good_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品sku表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_sku_image
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_sku_image`;
CREATE TABLE `rt_crossbbcg_goods_sku_image` (
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `option_value_id` int(11) NOT NULL COMMENT '规格id',
  `image` varchar(500) NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`good_id`,`option_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品的规格图片';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_sku_quantity
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_sku_quantity`;
CREATE TABLE `rt_crossbbcg_goods_sku_quantity` (
  `sku` varchar(64) NOT NULL COMMENT 'sku',
  `crossware_code` varchar(20) NOT NULL COMMENT '仓库id',
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `crossware_sku_quantity` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '库存量',
  `crossware_sku_offline_quantity` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '线下库存',
  PRIMARY KEY (`sku`,`crossware_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='sku库存表';

-- ----------------------------
-- Table structure for rt_crossbbcg_goods_to_category
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_goods_to_category`;
CREATE TABLE `rt_crossbbcg_goods_to_category` (
  `good_id` int(11) NOT NULL COMMENT '商品id',
  `category_id` int(11) NOT NULL COMMENT '分类id',
  PRIMARY KEY (`good_id`,`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品关联分类表';

-- ----------------------------
-- Table structure for rt_crossbbcg_national_pavilion
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_national_pavilion`;
CREATE TABLE `rt_crossbbcg_national_pavilion` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '属性组id',
  `name` varchar(64) NOT NULL COMMENT '国家馆名称',
  `thumb` varchar(255) NOT NULL COMMENT '主图',
  `url` text NOT NULL COMMENT '链接目标',
  `country_id` int(11) NOT NULL COMMENT '国家id',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否推荐，国家馆显示',
  `banner_image` varchar(255) NOT NULL COMMENT '国家馆广告图',
  `is_home` tinyint(1) NOT NULL COMMENT '是否首页显示',
  `home_image` varchar(255) NOT NULL COMMENT '首页推荐时的广告图片',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='国家馆';

-- ----------------------------
-- Table structure for rt_crossbbcg_nav
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_nav`;
CREATE TABLE `rt_crossbbcg_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(120) NOT NULL COMMENT '标题',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型0内链，1外链',
  `position` smallint(5) NOT NULL DEFAULT '0' COMMENT '位置',
  `remark` varchar(120) NOT NULL COMMENT '备注',
  `image` varchar(255) NOT NULL COMMENT '分类图片',
  `style` varchar(100) NOT NULL COMMENT '样式',
  `url` varchar(255) NOT NULL COMMENT 'URL路径',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态0禁用1启用',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `isadsense` int(11) NOT NULL DEFAULT '0' COMMENT '是否为广告0不是，1是',
  `isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐0否，1是',
  `ishot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否热门0否，1是',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '9' COMMENT '更新时间',
  `last_edit_uid` int(11) NOT NULL COMMENT '最后编辑者ID',
  `begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) NOT NULL DEFAULT '9' COMMENT '结束时间',
  `langid` text NOT NULL COMMENT '语种',
  `used_client` mediumtext NOT NULL COMMENT '适合用户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='跨境商城导航';

-- ----------------------------
-- Table structure for rt_crossbbcg_offline
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_offline`;
CREATE TABLE `rt_crossbbcg_offline` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(120) NOT NULL COMMENT '店铺名称',
  `logo` text NOT NULL COMMENT 'LOGO',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '店铺类型',
  `shoping` varchar(30) NOT NULL COMMENT '营业时间',
  `opentime` int(11) NOT NULL COMMENT '开店时间',
  `tel` varchar(20) NOT NULL COMMENT '电话',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `num` varchar(50) NOT NULL COMMENT '编号',
  `sort` int(11) NOT NULL COMMENT '排序',
  `description` varchar(200) NOT NULL COMMENT 'SEO简介 ',
  `country_id` int(11) NOT NULL COMMENT '国家ID',
  `province` int(11) NOT NULL COMMENT '省份',
  `city` int(11) NOT NULL COMMENT '城市',
  `area` int(11) NOT NULL COMMENT '地区',
  `address` varchar(250) NOT NULL COMMENT '地址',
  `contents` int(11) NOT NULL COMMENT '店铺介绍',
  `isrecommend` int(11) NOT NULL COMMENT '是否推荐',
  `xposition` varchar(50) NOT NULL COMMENT '高德X坐标',
  `yposition` varchar(50) NOT NULL COMMENT '高德Y坐标',
  `contact` varchar(20) NOT NULL COMMENT '联系人',
  `langid` text NOT NULL COMMENT '语言',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='线下店铺记录表';

-- ----------------------------
-- Table structure for rt_crossbbcg_option
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_option`;
CREATE TABLE `rt_crossbbcg_option` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '选项id',
  `name` varchar(64) NOT NULL COMMENT '选项名称',
  `type` varchar(20) NOT NULL COMMENT '选项类型',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `langid` varchar(20) NOT NULL COMMENT '语言id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品规格表';

-- ----------------------------
-- Table structure for rt_crossbbcg_option_value
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_option_value`;
CREATE TABLE `rt_crossbbcg_option_value` (
  `option_value_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '选项值id',
  `name` varchar(64) NOT NULL COMMENT '选择值名称',
  `option_id` int(11) NOT NULL COMMENT '关联的选项id',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`option_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='规格值表';

-- ----------------------------
-- Table structure for rt_crossbbcg_sendaddr
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_sendaddr`;
CREATE TABLE `rt_crossbbcg_sendaddr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '收发货类型',
  `title` varchar(120) NOT NULL COMMENT '收发点名称',
  `name` varchar(30) NOT NULL COMMENT '收发人姓名',
  `country_id` int(11) DEFAULT NULL COMMENT '国id',
  `province` int(11) NOT NULL COMMENT '省id',
  `city` int(11) NOT NULL COMMENT '市id',
  `area` int(11) NOT NULL COMMENT '地区id',
  `zipcode` varchar(10) DEFAULT NULL COMMENT '邮编',
  `address` varchar(255) NOT NULL COMMENT '具体地址',
  `mobile` varchar(20) NOT NULL COMMENT '手机',
  `remark` text COMMENT '备注',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '保存时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `seller_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收发货点信息';

-- ----------------------------
-- Table structure for rt_crossbbcg_takeself
-- ----------------------------
DROP TABLE IF EXISTS `rt_crossbbcg_takeself`;
CREATE TABLE `rt_crossbbcg_takeself` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '名称',
  `name` varchar(50) NOT NULL COMMENT '联系人',
  `country_id` int(11) NOT NULL COMMENT '国家',
  `province` int(11) NOT NULL COMMENT '省份ID',
  `city` int(11) NOT NULL COMMENT '城市ID',
  `area` int(11) NOT NULL COMMENT '地区ID',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `tel` varchar(30) DEFAULT NULL COMMENT '座机号码',
  `mobile` varchar(30) DEFAULT NULL COMMENT '手机号码',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `status` int(11) NOT NULL COMMENT '状态',
  `langid` text NOT NULL COMMENT '适用语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品物流自提地点';

-- ----------------------------
-- Table structure for rt_fans_actor
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_actor`;
CREATE TABLE `rt_fans_actor` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '头衔等级',
  `name` varchar(10) NOT NULL COMMENT '头衔名称',
  `exp` int(10) NOT NULL COMMENT '所需经验值',
  `langid` varchar(20) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL COMMENT '勋章',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='成员头衔表';

-- ----------------------------
-- Table structure for rt_fans_circle
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_circle`;
CREATE TABLE `rt_fans_circle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '圈子名称',
  `create_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `sort` tinyint(4) NOT NULL COMMENT '排序',
  `logo` varchar(255) NOT NULL COMMENT '圈子logo',
  `admin` varchar(200) NOT NULL COMMENT '圈字管理员',
  `type_id` int(11) NOT NULL COMMENT '类型id',
  `uid` int(11) unsigned NOT NULL COMMENT '圈子的创建者',
  `description` varchar(200) NOT NULL COMMENT '描述说明',
  `update_time` int(11) unsigned NOT NULL,
  `tags` varchar(100) NOT NULL COMMENT '标签',
  `review` tinyint(1) NOT NULL COMMENT '0待审核 1审核通过 2审核失败',
  `advertisement` varchar(200) NOT NULL COMMENT '圈子广告',
  `is_recommend` tinyint(1) NOT NULL COMMENT '是否推荐',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子表';

-- ----------------------------
-- Table structure for rt_fans_member
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_member`;
CREATE TABLE `rt_fans_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员id',
  `circle_id` int(11) NOT NULL COMMENT '圈子id',
  `circle_name` varchar(30) NOT NULL COMMENT '圈名',
  `account_name` varchar(30) NOT NULL COMMENT '会员昵称',
  `apply_content` varchar(255) NOT NULL COMMENT '申请内容',
  `apply_time` int(11) NOT NULL COMMENT '申请时间',
  `apply_state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '申请状态 0申请中 1通过 2未通过',
  `join_time` int(11) NOT NULL COMMENT '加入时间',
  `actor_name` varchar(15) NOT NULL DEFAULT '初级粉丝' COMMENT '会员头衔名称',
  `next_exp` int(11) NOT NULL DEFAULT '5' COMMENT '会员下一级所需经验',
  `is_identity` tinyint(1) NOT NULL COMMENT '1圈主 2管理 3成员',
  `is_allowspeak` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许发言 1允许 0禁止',
  `topic_count` int(11) NOT NULL COMMENT '话题数',
  `com_count` int(11) NOT NULL COMMENT '回复数',
  `lastspeaktime` int(11) NOT NULL COMMENT '最后发言时间',
  `status` tinyint(1) NOT NULL COMMENT '成员状态',
  PRIMARY KEY (`id`),
  KEY `index` (`circle_id`,`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子成员表';

-- ----------------------------
-- Table structure for rt_fans_reported
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_reported`;
CREATE TABLE `rt_fans_reported` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) unsigned NOT NULL COMMENT '举报类型id',
  `description` text NOT NULL COMMENT '描述',
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `topic_id` int(11) unsigned NOT NULL COMMENT '被举报话题id',
  `create_time` int(11) unsigned NOT NULL COMMENT '举报时间',
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子举报表';

-- ----------------------------
-- Table structure for rt_fans_reported_type
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_reported_type`;
CREATE TABLE `rt_fans_reported_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  `description` text NOT NULL COMMENT '描述',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='举报类型表';

-- ----------------------------
-- Table structure for rt_fans_snscon
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_snscon`;
CREATE TABLE `rt_fans_snscon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `description` varchar(200) NOT NULL COMMENT '描述',
  `type_id` int(11) unsigned NOT NULL COMMENT '类型id',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `sort` tinyint(4) NOT NULL COMMENT '排序',
  `cover` text NOT NULL COMMENT '封面图片',
  `view` int(11) unsigned NOT NULL COMMENT '阅读量',
  `comment` int(11) unsigned NOT NULL COMMENT '评论量',
  `collection` int(11) unsigned NOT NULL COMMENT '收藏量',
  `dead_line` date NOT NULL COMMENT '有效期',
  `source` varchar(255) NOT NULL COMMENT '来源url',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `isrecommend` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `contents` text COMMENT '咨询内容',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子成员发布的内容';

-- ----------------------------
-- Table structure for rt_fans_snscon_category
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_snscon_category`;
CREATE TABLE `rt_fans_snscon_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(11) unsigned NOT NULL COMMENT '上级分类id',
  `can_post` tinyint(1) NOT NULL COMMENT '前台可投稿',
  `need_audit` tinyint(1) NOT NULL COMMENT '前台投稿是否需要审核',
  `sort` tinyint(4) unsigned NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子内容分类';

-- ----------------------------
-- Table structure for rt_fans_topic
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_topic`;
CREATE TABLE `rt_fans_topic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL COMMENT '发布话题用户',
  `circle_id` int(11) unsigned NOT NULL COMMENT '所属圈子id',
  `title` varchar(50) NOT NULL COMMENT '话题标题',
  `content` text NOT NULL COMMENT '话题内容',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `view_count` int(11) unsigned NOT NULL COMMENT '阅读量',
  `reply_count` int(11) unsigned NOT NULL COMMENT '回复总数',
  `is_top` tinyint(1) NOT NULL COMMENT '是否置顶',
  `is_hot` tinyint(1) NOT NULL COMMENT '是否精华',
  `is_silent` tinyint(1) NOT NULL COMMENT '是否禁言',
  PRIMARY KEY (`id`),
  KEY `index` (`uid`,`circle_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子话题';

-- ----------------------------
-- Table structure for rt_fans_topic_reply
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_topic_reply`;
CREATE TABLE `rt_fans_topic_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '话题回复表id',
  `uid` int(11) unsigned NOT NULL COMMENT '用户id',
  `topic_id` int(11) unsigned NOT NULL COMMENT '话题id',
  `content` text NOT NULL COMMENT '回复内容',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `from` varchar(50) NOT NULL COMMENT '回复来源',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='话题回复表';

-- ----------------------------
-- Table structure for rt_fans_type
-- ----------------------------
DROP TABLE IF EXISTS `rt_fans_type`;
CREATE TABLE `rt_fans_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `update_time` int(11) unsigned NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `from` varchar(50) NOT NULL COMMENT '来源/平台',
  `alias` varchar(50) NOT NULL COMMENT '别名',
  `langid` varchar(20) NOT NULL,
  `is_recommend` tinyint(1) NOT NULL COMMENT '是否推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='圈子分数类型';

-- ----------------------------
-- Table structure for rt_finance_brand
-- ----------------------------
DROP TABLE IF EXISTS `rt_finance_brand`;
CREATE TABLE `rt_finance_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `firstchar` char(100) NOT NULL COMMENT '首字母',
  `name` varchar(60) NOT NULL COMMENT '品牌名',
  `alias` varchar(100) NOT NULL COMMENT '别名',
  `url` varchar(200) NOT NULL COMMENT '网址',
  `pcat` int(11) NOT NULL COMMENT '主分类',
  `cat` int(11) NOT NULL COMMENT '隶属分类子分类',
  `description` text NOT NULL COMMENT '品牌介绍',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  `isrecommend` tinyint(1) NOT NULL COMMENT '推荐',
  `istop` tinyint(1) NOT NULL COMMENT '置顶',
  `logo` tinyint(1) NOT NULL COMMENT '品牌logo',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `seo_title` varchar(120) NOT NULL COMMENT 'seo标题',
  `seo_keys` varchar(200) NOT NULL COMMENT 'seo关键字',
  `seo_desc` varchar(200) NOT NULL COMMENT 'seo内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Table structure for rt_finance_category
-- ----------------------------
DROP TABLE IF EXISTS `rt_finance_category`;
CREATE TABLE `rt_finance_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(255) NOT NULL COMMENT '标识',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `mobtitle` varchar(50) NOT NULL COMMENT '移动端显示名称',
  `catimage` varchar(255) NOT NULL COMMENT '分类图片',
  `groupbys` int(11) NOT NULL COMMENT '分组',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `class` varchar(255) NOT NULL COMMENT '栏目CLASS',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `listrow` tinyint(3) unsigned NOT NULL DEFAULT '25' COMMENT '列表每页行数',
  `seo_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL DEFAULT '' COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL DEFAULT '' COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页模板',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `is_recom` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `is_reply` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `is_check` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `api_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'api状态',
  `wap_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'wap状态',
  `pc_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'pc状态',
  `pc_hit` int(11) NOT NULL COMMENT 'PC点击',
  `wap_hit` int(11) NOT NULL COMMENT '移动端点击',
  `urlruleid` tinyint(2) NOT NULL DEFAULT '0' COMMENT '地址规则',
  `listtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '列表类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `langid` varchar(255) NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `langid` (`langid`),
  KEY `urlruleid` (`urlruleid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商城商品分类';

-- ----------------------------
-- Table structure for rt_member_account
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_account`;
CREATE TABLE `rt_member_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `levelid` int(11) DEFAULT '1' COMMENT '等级id',
  `nickname` char(20) NOT NULL COMMENT '昵称',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(11) DEFAULT NULL COMMENT '用户手机',
  `score` decimal(20,0) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `headimg` varchar(255) NOT NULL COMMENT '头像',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `login` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `verify` varchar(30) NOT NULL COMMENT '验证',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '用户状态',
  `langid` varchar(20) NOT NULL DEFAULT '',
  `tag_id` int(10) unsigned NOT NULL COMMENT '用户标签id 关联用户标签表',
  `idcard` char(10) NOT NULL COMMENT '唯一身份标识',
  `pidcard` char(10) NOT NULL COMMENT '父级身份标识',
  `agent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商级别，默认0不是代理商',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '用户存款',
  `pay_pwd` char(32) NOT NULL COMMENT '支付密码',
  `source` varchar(120) NOT NULL COMMENT '内部来源',
  `outsrc` varchar(120) NOT NULL COMMENT '外部来源',
  `last_login_time` int(11) NOT NULL COMMENT '最后一次登录时间',
  `last_login_ip` varchar(32) NOT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `idcard` (`idcard`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Table structure for rt_member_address
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_address`;
CREATE TABLE `rt_member_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `consignee` varchar(30) NOT NULL COMMENT '收货人',
  `country` int(11) NOT NULL COMMENT '国家',
  `province` int(11) NOT NULL COMMENT '省份',
  `city` int(11) NOT NULL COMMENT '城市',
  `district` int(11) NOT NULL COMMENT '地区',
  `twon` int(11) NOT NULL COMMENT '乡镇',
  `address` varchar(150) NOT NULL COMMENT '详细地址',
  `is_default` tinyint(1) NOT NULL COMMENT '默认收货地址',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `langid` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL COMMENT '手机或固定电话',
  `zipcode` int(8) NOT NULL COMMENT '邮编',
  `identity` varchar(20) NOT NULL COMMENT '身份证号码',
  `front_img` varchar(255) NOT NULL COMMENT '身份证正面照',
  `verso_img` varchar(255) NOT NULL COMMENT '身份证反面照',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='会员地址';

-- ----------------------------
-- Table structure for rt_member_agent
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_agent`;
CREATE TABLE `rt_member_agent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL COMMENT '级别标识',
  `title` varchar(30) NOT NULL COMMENT '代理名称',
  `alias` varchar(30) NOT NULL COMMENT '代理商级别别名',
  `description` text NOT NULL COMMENT '代理商级别介绍',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `discount` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '代理商级别享受的折扣',
  `quota` int(11) NOT NULL COMMENT '消费额度',
  `rebate` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '返佣比例',
  `create_time` tinyint(10) NOT NULL,
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='代理商';

-- ----------------------------
-- Table structure for rt_member_appeal
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_appeal`;
CREATE TABLE `rt_member_appeal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `fuid` int(11) NOT NULL COMMENT '来源用户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='申诉表';

-- ----------------------------
-- Table structure for rt_member_autoreply
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_autoreply`;
CREATE TABLE `rt_member_autoreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `fuid` int(11) NOT NULL COMMENT '来源用户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='自动回复';

-- ----------------------------
-- Table structure for rt_member_cash
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_cash`;
CREATE TABLE `rt_member_cash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `cash_time` int(11) NOT NULL COMMENT '充值时间',
  `fuid` int(11) NOT NULL COMMENT '来源用户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0:待支付 1：支付成功 2：交易关闭',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `pay_code` varchar(20) NOT NULL COMMENT '支付码',
  `pay_name` varchar(80) NOT NULL COMMENT '支付方式',
  `pay_time` int(10) unsigned NOT NULL COMMENT '充值时间',
  `cash_code` varchar(20) NOT NULL COMMENT '充值单号',
  `nickname` varchar(30) NOT NULL COMMENT '用户昵称',
  `from` varchar(50) NOT NULL COMMENT '来源',
  PRIMARY KEY (`id`),
  KEY `index` (`uid`,`fuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预存款记录表';

-- ----------------------------
-- Table structure for rt_member_collect
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_collect`;
CREATE TABLE `rt_member_collect` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`uid`,`goods_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员商品收藏表';

-- ----------------------------
-- Table structure for rt_member_comment
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_comment`;
CREATE TABLE `rt_member_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单自增id',
  `order_sn` varchar(18) NOT NULL COMMENT '订单编号',
  `apps` varchar(50) NOT NULL COMMENT '模块APP',
  `model` varchar(50) NOT NULL COMMENT '数据模型',
  `controller` varchar(50) NOT NULL COMMENT '控制器',
  `mod_id` int(11) NOT NULL COMMENT '被评论的主是id',
  `mod_name` varchar(255) NOT NULL COMMENT '名称',
  `mod_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `contents` text NOT NULL COMMENT '评价内容',
  `shop_id` int(11) NOT NULL COMMENT '店铺id(seller表)',
  `reply` varchar(255) NOT NULL COMMENT '评价回复',
  `score` int(1) NOT NULL COMMENT '评分 1-5分',
  `from_membername` varchar(50) NOT NULL COMMENT '评价人名称',
  `isanonymous` tinyint(1) NOT NULL COMMENT '是否匿名评价 1匿名 0正常',
  `is_img` tinyint(1) NOT NULL COMMENT '是否有晒图 1有 0无',
  `image` varchar(255) NOT NULL COMMENT '晒单图片',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `from_ip` int(11) NOT NULL COMMENT '评价人IP地址',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示：0不显示 1显示 ，默认显示',
  `grade` tinyint(1) NOT NULL COMMENT '评价等级：1好评 2中评 3差评',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_sn` (`order_sn`) USING BTREE,
  UNIQUE KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员评论表';

-- ----------------------------
-- Table structure for rt_member_consult
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_consult`;
CREATE TABLE `rt_member_consult` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `fuid` int(11) NOT NULL COMMENT '来源用户',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员咨询表';

-- ----------------------------
-- Table structure for rt_member_couponlist
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_couponlist`;
CREATE TABLE `rt_member_couponlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) unsigned NOT NULL COMMENT '优惠券 对应coupontype表类型id',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发放类型 1 按订单发放 2 注册 3 邀请 4 按用户发放',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `order_id` int(11) NOT NULL COMMENT '订单id',
  `use_time` int(11) NOT NULL COMMENT '使用时间',
  `code` char(32) NOT NULL COMMENT '优惠券兑换码',
  `send_time` int(11) NOT NULL COMMENT '发放时间',
  `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已被使用',
  PRIMARY KEY (`id`),
  KEY `index` (`type_id`,`type`,`uid`,`order_id`,`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员优惠券';

-- ----------------------------
-- Table structure for rt_member_coupontype
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_coupontype`;
CREATE TABLE `rt_member_coupontype` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '优惠卷名称',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发放类型 0面额模板1 按用户发放 2 注册 3 邀请 4 线下发放',
  `money` decimal(10,2) NOT NULL COMMENT '优惠券金额',
  `condition` decimal(10,2) NOT NULL COMMENT '条件',
  `createnum` int(11) NOT NULL COMMENT '发放数量',
  `send_num` int(11) NOT NULL COMMENT '已领取数量',
  `use_num` int(11) NOT NULL COMMENT '已使用数量',
  `send_start_time` int(11) NOT NULL COMMENT '发放开始时间',
  `send_end_time` int(11) NOT NULL COMMENT '发放结束时间',
  `use_start_time` int(11) NOT NULL COMMENT '使用开始时间',
  `use_end_time` int(11) NOT NULL COMMENT '使用结束时间',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='优惠券类型表';

-- ----------------------------
-- Table structure for rt_member_deposit
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_deposit`;
CREATE TABLE `rt_member_deposit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `money` decimal(10,2) NOT NULL COMMENT '存款金额',
  `from` varchar(255) NOT NULL COMMENT '存款来源',
  `remark` varchar(255) NOT NULL COMMENT '存款备注',
  `status` tinyint(1) NOT NULL,
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预存款记录表';

-- ----------------------------
-- Table structure for rt_member_experi
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_experi`;
CREATE TABLE `rt_member_experi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `remark` varchar(500) NOT NULL COMMENT '积分备注',
  `change` varchar(50) NOT NULL COMMENT '变动数值',
  `from` varchar(50) NOT NULL COMMENT '平台来源',
  `status` tinyint(1) NOT NULL,
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户积分表';

-- ----------------------------
-- Table structure for rt_member_extent
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_extent`;
CREATE TABLE `rt_member_extent` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `field_name` varchar(50) NOT NULL COMMENT '字段名',
  `field_type` varchar(20) NOT NULL COMMENT '1文本框 2选择 3单选 4多选 5文本域 6日期',
  `create_time` int(10) unsigned NOT NULL,
  `required` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0 不是必须  1必须',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0启用  1禁用',
  `input_tips` varchar(50) NOT NULL COMMENT '提示信息',
  `levelid` int(10) unsigned NOT NULL COMMENT '拥有该字段的身份',
  `alias` varchar(20) NOT NULL COMMENT '字段别名',
  `regex` varchar(255) NOT NULL COMMENT '验证规则',
  `regex_tip` varchar(255) NOT NULL COMMENT '表单验证提示信息',
  `length_max` tinyint(2) unsigned NOT NULL COMMENT '最大长度',
  `length_min` tinyint(2) unsigned NOT NULL COMMENT '最小长度',
  `unique` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否唯一',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员扩展字段';

-- ----------------------------
-- Table structure for rt_member_feedback
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_feedback`;
CREATE TABLE `rt_member_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `uid` int(11) NOT NULL COMMENT '留言用户ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `langid` varchar(20) NOT NULL COMMENT '语言',
  `content` text NOT NULL COMMENT '内容',
  `from` varchar(255) NOT NULL COMMENT '来源',
  `fid` int(11) unsigned NOT NULL COMMENT '父id，指针对哪条留言进行回复',
  `type_id` int(11) NOT NULL COMMENT '反馈类型',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员意见反馈表';

-- ----------------------------
-- Table structure for rt_member_feedback_reply
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_feedback_reply`;
CREATE TABLE `rt_member_feedback_reply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT '回复内容',
  `create_time` int(11) unsigned NOT NULL,
  `feedback_id` int(11) NOT NULL COMMENT '反馈表id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `langid` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`feedback_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员反馈回复表';

-- ----------------------------
-- Table structure for rt_member_feedback_type
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_feedback_type`;
CREATE TABLE `rt_member_feedback_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL COMMENT '反馈类型名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员反馈类型';

-- ----------------------------
-- Table structure for rt_member_goods_comment
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_goods_comment`;
CREATE TABLE `rt_member_goods_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单自增id',
  `order_sn` varchar(18) NOT NULL COMMENT '订单编号',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `comment_content` varchar(255) NOT NULL COMMENT '评价内容',
  `shop_id` int(11) NOT NULL COMMENT '店铺id(seller_account表id)',
  `reply` varchar(255) NOT NULL COMMENT '评价回复',
  `score` int(1) NOT NULL COMMENT '评分 1-5分',
  `from_membername` varchar(50) NOT NULL COMMENT '评价人名称',
  `isanonymous` tinyint(1) NOT NULL COMMENT '是否匿名评价 1匿名 0正常',
  `is_img` tinyint(1) NOT NULL COMMENT '是否有晒图 1有 0无',
  `image` varchar(255) NOT NULL COMMENT '晒单图片',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `from_ip` int(11) NOT NULL COMMENT '评价人IP地址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `is_display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示：0不显示 1显示 ，默认显示',
  `sku_id` int(11) NOT NULL COMMENT 'sku id',
  `sku_name` varchar(255) NOT NULL COMMENT 'sku名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_sn` (`order_sn`) USING BTREE,
  UNIQUE KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品评论表';

-- ----------------------------
-- Table structure for rt_member_goods_refer
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_goods_refer`;
CREATE TABLE `rt_member_goods_refer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL COMMENT '咨询内容',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `goods_logo_url` varchar(255) NOT NULL COMMENT '商品图片',
  `goods_name` varchar(255) NOT NULL COMMENT '商品名称',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '咨询人id',
  `nickname` varchar(50) NOT NULL COMMENT '咨询人昵称',
  `ip` int(11) NOT NULL COMMENT '咨询人ip',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `answer_num` int(11) NOT NULL COMMENT '回复数量',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品咨询表';

-- ----------------------------
-- Table structure for rt_member_goods_reply
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_goods_reply`;
CREATE TABLE `rt_member_goods_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refer_id` int(11) NOT NULL COMMENT '咨询表id',
  `answer` varchar(255) NOT NULL COMMENT '回复内容',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id 为零则代表商家',
  `nickname` varchar(255) NOT NULL COMMENT '回复人',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `ip` int(11) NOT NULL COMMENT 'ip地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='商品咨询回复表';

-- ----------------------------
-- Table structure for rt_member_history
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_history`;
CREATE TABLE `rt_member_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `history_cookie` text NOT NULL COMMENT '商品历史记录cookie字符串',
  PRIMARY KEY (`id`),
  KEY `index` (`uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员商品历史记录';

-- ----------------------------
-- Table structure for rt_member_invitation
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_invitation`;
CREATE TABLE `rt_member_invitation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rang` tinyint(4) unsigned NOT NULL DEFAULT '72' COMMENT '有效期',
  `forinv` text NOT NULL COMMENT '被邀请者手机或邮箱',
  `welcome` varchar(200) NOT NULL COMMENT '邀请语',
  `create_time` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `langid` varchar(20) NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员邀请表';

-- ----------------------------
-- Table structure for rt_member_level
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_level`;
CREATE TABLE `rt_member_level` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `tag` varchar(20) NOT NULL COMMENT '级别标识',
  `name` varchar(30) DEFAULT NULL COMMENT '级别名称',
  `alias` varchar(50) NOT NULL COMMENT '会员组变量名',
  `quota` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '消费额度',
  `discount` tinyint(3) NOT NULL DEFAULT '0' COMMENT '折扣',
  `maxempirical` bigint(20) NOT NULL DEFAULT '0' COMMENT '最大经验值',
  `maxpoint` bigint(20) NOT NULL DEFAULT '0' COMMENT '最大积分',
  `minempirical` bigint(20) NOT NULL DEFAULT '0' COMMENT '最小经验值',
  `minpoint` bigint(20) NOT NULL DEFAULT '0' COMMENT '最小积分',
  `langid` text NOT NULL COMMENT '适用语言',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态0禁用，1启用',
  `mark` varchar(100) NOT NULL COMMENT '会员 组描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员等级';

-- ----------------------------
-- Table structure for rt_member_member
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_member`;
CREATE TABLE `rt_member_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '同account表id',
  `truename` varchar(250) NOT NULL COMMENT '真实姓名',
  `sfz` varchar(250) NOT NULL COMMENT '身份证',
  `birthday` varchar(25) NOT NULL COMMENT '生日',
  `token` char(32) NOT NULL COMMENT '用户身份验证唯一标识',
  `mobile_verify` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否手机验证：1是 0否',
  `is_realauth` tinyint(1) NOT NULL COMMENT '是否实名认证',
  `sfz_img_z` varchar(255) NOT NULL COMMENT '身份证正面',
  `sfz_img_f` varchar(255) NOT NULL COMMENT '身份证反面',
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `index` (`token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='会员身份证表';

-- ----------------------------
-- Table structure for rt_member_message
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_message`;
CREATE TABLE `rt_member_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rule` varchar(200) NOT NULL COMMENT '消息规则',
  `message` text NOT NULL COMMENT '提示消息',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员提示消息表';

-- ----------------------------
-- Table structure for rt_member_my_path
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_my_path`;
CREATE TABLE `rt_member_my_path` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `goods_id` int(11) NOT NULL COMMENT '商品的id',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`uid`,`goods_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='会员浏览商品记录表';

-- ----------------------------
-- Table structure for rt_member_question
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_question`;
CREATE TABLE `rt_member_question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(30) NOT NULL COMMENT '问题',
  `num` tinyint(1) NOT NULL COMMENT '1:第一个问题 2第二个问题 3第三个问题',
  `langid` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员的问题表';

-- ----------------------------
-- Table structure for rt_member_refer
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_refer`;
CREATE TABLE `rt_member_refer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL COMMENT '咨询内容',
  `db_id` int(11) NOT NULL COMMENT '数据ID',
  `logo_url` text NOT NULL COMMENT '图桔',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '咨询人id',
  `nickname` varchar(50) NOT NULL COMMENT '咨询人昵称',
  `ip` int(11) NOT NULL COMMENT '咨询人ip',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `apps` varchar(50) NOT NULL COMMENT '归属APP',
  `controller` varchar(50) NOT NULL COMMENT '来源控制器',
  `model` varchar(50) NOT NULL COMMENT '来源模型',
  `from` varchar(50) NOT NULL COMMENT '来源平台',
  `source` varchar(200) NOT NULL COMMENT '来路平台：api,ads',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`db_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员咨询表';

-- ----------------------------
-- Table structure for rt_member_security
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_security`;
CREATE TABLE `rt_member_security` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `question_id` int(11) NOT NULL COMMENT '密保问题id',
  `value` varchar(50) NOT NULL COMMENT '密保问题答案',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员保密问题表';

-- ----------------------------
-- Table structure for rt_member_tag
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_tag`;
CREATE TABLE `rt_member_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `description` text NOT NULL COMMENT '标签描述',
  `sort` tinyint(4) unsigned NOT NULL COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL COMMENT '1启用 0禁用',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员Tag标签';

-- ----------------------------
-- Table structure for rt_member_without
-- ----------------------------
DROP TABLE IF EXISTS `rt_member_without`;
CREATE TABLE `rt_member_without` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `create_time` int(10) unsigned NOT NULL COMMENT '提现日期',
  `money` decimal(10,2) NOT NULL COMMENT '提现金额',
  `bank_name` varchar(32) NOT NULL COMMENT '银行名称 如支付宝 微信 中国银行 农业银行等',
  `account_bank` varchar(32) NOT NULL COMMENT '银行账号',
  `account_name` varchar(32) NOT NULL COMMENT '银行账户名 可以是支付宝可以其他银行',
  `remark` varchar(1000) NOT NULL COMMENT '提现备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '提现状态0申请中1申请成功2申请失败',
  `bank_address` varchar(255) NOT NULL COMMENT '银行开户地址',
  `update_time` int(10) unsigned NOT NULL COMMENT '审核时间',
  `from` varchar(255) NOT NULL COMMENT '提现来源',
  `pand_remark` varchar(1000) NOT NULL COMMENT '审核备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员提现表';

-- ----------------------------
-- Table structure for rt_oms_express
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_express`;
CREATE TABLE `rt_oms_express` (
  `id` int(11) unsigned NOT NULL COMMENT '自增ID',
  `title` varchar(100) NOT NULL COMMENT '快递名称',
  `fulltitle` varchar(120) NOT NULL COMMENT '全称',
  `firstchar` varchar(2) NOT NULL COMMENT '首字母',
  `code` varchar(20) NOT NULL COMMENT '物流公司代码',
  `tel` varchar(20) DEFAULT NULL COMMENT '快递电话',
  `description` varchar(120) NOT NULL COMMENT '介绍',
  `icon` varchar(255) NOT NULL COMMENT '图标',
  `logo` text NOT NULL COMMENT '快递logo',
  `website` varchar(255) NOT NULL COMMENT '官方网站',
  `checkurl` text NOT NULL COMMENT '查件网址',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常，0禁用',
  `isdelivery` tinyint(1) NOT NULL DEFAULT '0' COMMENT '货到付款1是，0否',
  `isinsurance` varchar(20) DEFAULT NULL COMMENT '物流保价额度',
  `sort` int(11) NOT NULL COMMENT '排序',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `last_edit_uid` int(11) NOT NULL COMMENT '最后操作者ID',
  `langid` tinyint(2) NOT NULL COMMENT '语种ID',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '默认'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='跨境电商快递表';

-- ----------------------------
-- Table structure for rt_oms_goods
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_goods`;
CREATE TABLE `rt_oms_goods` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `code` varchar(50) NOT NULL COMMENT '商品编号',
  `name` varchar(200) NOT NULL COMMENT '商品名称',
  `tax` varchar(10) NOT NULL COMMENT '海关税率',
  `type` enum('normal','bind') NOT NULL DEFAULT 'normal' COMMENT 'normal:普通商品,bind:捆绑商品',
  `brand` varchar(200) NOT NULL COMMENT '品牌名称',
  `brief` varchar(200) NOT NULL COMMENT '商品简介',
  `intro` text NOT NULL COMMENT '详细介绍',
  `barcode` varchar(32) NOT NULL COMMENT '条形码',
  `mktprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成本价',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '销售价',
  `weight` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '重量',
  `unit` varchar(20) NOT NULL COMMENT '单位',
  `pagenum` int(11) NOT NULL DEFAULT '1' COMMENT '包装件数',
  `warecode` varchar(30) NOT NULL COMMENT '仓库编码',
  `params` text NOT NULL COMMENT '商品参数序列化存储',
  `create_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `hrecord` varchar(50) NOT NULL COMMENT '海关备案号',
  `grecord` varchar(50) NOT NULL COMMENT '国检备案号',
  `hscode` varchar(50) NOT NULL COMMENT '海关编码',
  `gmodel` varchar(100) NOT NULL COMMENT '海关型号',
  `ciqgmodel` varchar(100) NOT NULL COMMENT ' 检疫型号',
  `hunit` varchar(30) NOT NULL COMMENT '海关计量单位',
  PRIMARY KEY (`g_id`),
  UNIQUE KEY `g_id` (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='OMS商品表';

-- ----------------------------
-- Table structure for rt_oms_order
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_order`;
CREATE TABLE `rt_oms_order` (
  `order_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_sn` varchar(32) NOT NULL COMMENT '订单号',
  `batch_no` varchar(40) NOT NULL COMMENT '批次号',
  `order_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单类型 1正常订单 0系统自动生成',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态:-1冻结, 0未审核,1通过,2 未通过,4关闭',
  `idnumber` varchar(30) NOT NULL COMMENT '身份证号',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的姓名',
  `country` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '收货人的国家',
  `province` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '收货人的省份',
  `city` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '收货人的城市',
  `district` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '收货人的地区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人的详细地址',
  `zipcode` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的邮编',
  `mobile` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的手机',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的Email',
  `pay_type` varchar(50) NOT NULL COMMENT '支付方式：0：货到付款',
  `payed` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `shipping_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '用户选择的配送方式id',
  `shipping_name` varchar(120) NOT NULL DEFAULT '' COMMENT '用户选择的配送方式的名称',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配送费用',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '商品配送情况;0未发货,1已发货,2已收货',
  `shipping_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单配送时间',
  `recode` varchar(40) NOT NULL COMMENT '收货人省市区代码组合',
  `postscript` varchar(255) NOT NULL DEFAULT '' COMMENT '订单附言,由用户提交订单前填写',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单支付时间',
  `inv_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1,公司，0，个人',
  `inv_payee` varchar(120) NOT NULL COMMENT '发票抬头',
  `inv_content` varchar(120) NOT NULL DEFAULT '' COMMENT '发票内容',
  `invoice_no` varchar(255) NOT NULL DEFAULT '' COMMENT '发货单号',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品的总金额',
  `platform_type` varchar(8) NOT NULL DEFAULT 'pc' COMMENT '来源平台',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `confirm_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单确认时间',
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '税费',
  `trade_no` varchar(255) NOT NULL COMMENT '支付平台返回的流水号',
  `discount` decimal(10,2) NOT NULL COMMENT '折扣',
  `is_checkout` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否给商家货款',
  `langid` text NOT NULL COMMENT '下单所处语言',
  `partner` varchar(8) NOT NULL COMMENT '合作商',
  `warecode` varchar(50) NOT NULL COMMENT '仓库代码',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_sn` (`order_sn`),
  KEY `user_id` (`user_id`),
  KEY `order_status` (`status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主订单表';

-- ----------------------------
-- Table structure for rt_oms_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_order_goods`;
CREATE TABLE `rt_oms_order_goods` (
  `og_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增加ID',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `sku_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '货品ID',
  `sku_number` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `sku_weight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '商品重量',
  `sku_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格(原价)',
  `sku_array` text NOT NULL COMMENT '商品和货品name，price,attr等相关属性的JSON',
  `send_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '发货数量',
  `real_price` decimal(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '实付金额',
  `is_gift` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否礼品',
  `is_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已发货',
  `delivery_id` int(11) NOT NULL COMMENT '发货单ID',
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  PRIMARY KEY (`og_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品详情';

-- ----------------------------
-- Table structure for rt_oms_order_log
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_order_log`;
CREATE TABLE `rt_oms_order_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `ordersn` varchar(30) NOT NULL COMMENT '订单号',
  `contents` text NOT NULL COMMENT '返回结果原文',
  `result` text NOT NULL COMMENT '加工过后的返回结果',
  `target` varchar(20) NOT NULL COMMENT '目标',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `langid` text NOT NULL COMMENT '语言系',
  `opid` int(11) NOT NULL COMMENT '操作人员ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单日志';

-- ----------------------------
-- Table structure for rt_oms_purchase
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_purchase`;
CREATE TABLE `rt_oms_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(60) NOT NULL COMMENT '供应商名称',
  `contents` text NOT NULL COMMENT '介绍',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` int(11) NOT NULL COMMENT '状态',
  `langid` int(11) NOT NULL COMMENT '语言系',
  `wareids` text NOT NULL COMMENT '绑定的仓库',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商表';

-- ----------------------------
-- Table structure for rt_oms_purorder
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_purorder`;
CREATE TABLE `rt_oms_purorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(120) NOT NULL COMMENT '标题',
  `contents` text NOT NULL COMMENT '内容',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `langid` text NOT NULL COMMENT '语系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='采购单表';

-- ----------------------------
-- Table structure for rt_oms_sea
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_sea`;
CREATE TABLE `rt_oms_sea` (
  `id` int(11) NOT NULL COMMENT '自增ID',
  `name` varchar(150) DEFAULT NULL COMMENT '海关机器名',
  `iden` varchar(50) NOT NULL COMMENT '标识',
  `company` varchar(120) DEFAULT NULL COMMENT '所属公司',
  `keys` varchar(100) DEFAULT NULL COMMENT '通信key',
  `secret` varchar(200) DEFAULT NULL COMMENT '通信secret',
  `url` varchar(255) DEFAULT NULL COMMENT '通信地址',
  `classname` varchar(50) DEFAULT NULL COMMENT '接口处理类',
  `remark` varchar(250) NOT NULL COMMENT '机器说明',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态',
  `istest` tinyint(1) NOT NULL COMMENT '是否测试机',
  `create_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '更新时间',
  `sort` int(5) DEFAULT '0' COMMENT '排序',
  `langid` text NOT NULL COMMENT '语言系'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='清关机器记录表';

-- ----------------------------
-- Table structure for rt_oms_seaport
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_seaport`;
CREATE TABLE `rt_oms_seaport` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(50) NOT NULL COMMENT '口岸名称',
  `code` varchar(50) NOT NULL COMMENT '代码',
  `no` varchar(120) NOT NULL COMMENT '企业代码:',
  `company` varchar(200) NOT NULL COMMENT '企业名称',
  `tel` varchar(35) NOT NULL COMMENT '电话',
  `account` varchar(60) DEFAULT NULL COMMENT '公司在口岸的备案账户',
  `pwd` varchar(120) DEFAULT NULL COMMENT '公司在口岸的备案账户密码',
  `country` varchar(100) NOT NULL COMMENT '国家',
  `url` varchar(255) NOT NULL COMMENT '网址',
  `isbonded` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否保税',
  `isdutiable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否完税',
  `isoverseas` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否海外直邮',
  `seaid` text NOT NULL COMMENT '绑定的海关机器,序列化存放',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='口岸记录';

-- ----------------------------
-- Table structure for rt_oms_touch
-- ----------------------------
DROP TABLE IF EXISTS `rt_oms_touch`;
CREATE TABLE `rt_oms_touch` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增加ID',
  `order_sn` varchar(32) NOT NULL COMMENT '订单号',
  `contents` text NOT NULL COMMENT '清关内容',
  `custom` varchar(30) NOT NULL COMMENT '口岸',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 ',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='手动清关信息';

-- ----------------------------
-- Table structure for rt_openapi_devauth
-- ----------------------------
DROP TABLE IF EXISTS `rt_openapi_devauth`;
CREATE TABLE `rt_openapi_devauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(50) DEFAULT NULL COMMENT '权限名称',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `rule` text COMMENT '权限规则',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='开发者权限';

-- ----------------------------
-- Table structure for rt_openapi_devloper
-- ----------------------------
DROP TABLE IF EXISTS `rt_openapi_devloper`;
CREATE TABLE `rt_openapi_devloper` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(60) DEFAULT NULL COMMENT '开发者名称',
  `devauthid` int(11) NOT NULL COMMENT '权限分组',
  `company` varchar(120) DEFAULT NULL COMMENT '开发者所属公司',
  `domain` text NOT NULL COMMENT '适合域名',
  `dkey` varchar(100) DEFAULT NULL COMMENT '开发者KEY',
  `secret:` varchar(120) DEFAULT NULL COMMENT '开发者Secret',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `remark` varchar(120) NOT NULL COMMENT '备注',
  `langid` text COMMENT '语系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='开发者';

-- ----------------------------
-- Table structure for rt_openapi_keys
-- ----------------------------
DROP TABLE IF EXISTS `rt_openapi_keys`;
CREATE TABLE `rt_openapi_keys` (
  `id` int(11) NOT NULL COMMENT '自增ID',
  `key` varchar(20) NOT NULL DEFAULT '' COMMENT '应用KEY',
  `secert` varchar(68) NOT NULL DEFAULT '' COMMENT '应用的secret',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  `status_time` int(11) DEFAULT '0' COMMENT '修改状态时间',
  `user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rt_keys_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='API对接Key';

-- ----------------------------
-- Table structure for rt_order_afterservice
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_afterservice`;
CREATE TABLE `rt_order_afterservice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `after_sn` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '售后编号',
  `rtype` tinyint(1) NOT NULL COMMENT '售后类型 0 退款(仅退款不退货) 1 退款退货 2 换货',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `order_sn` varchar(30) NOT NULL COMMENT '订单号',
  `user_id` int(11) NOT NULL COMMENT '会员ID',
  `opt_id` int(11) NOT NULL COMMENT '操作员ID',
  `rec_id` int(11) NOT NULL COMMENT '订单商品表id',
  `return_images` text CHARACTER SET utf8 NOT NULL COMMENT '退货申请的图片',
  `return_reason` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '退货的原因',
  `return_description` text CHARACTER SET utf8 NOT NULL COMMENT '退货的描述',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态:0未审核, 1已完成退款, 2已驳回, 3商家审核通过, 4商家审核不通过, 5等待商家确认收货，6商家已确认收货，7商家强制关单, 8平台强制关单',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='售后表';

-- ----------------------------
-- Table structure for rt_order_cancel_log
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_cancel_log`;
CREATE TABLE `rt_order_cancel_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '取消日志ID',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `order_sn` varchar(40) NOT NULL COMMENT '订单号',
  `rtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 退款(仅退款不退货) 1 退款退货 2 换货',
  `money` decimal(10,2) NOT NULL COMMENT '取消金额',
  `create_time` int(11) NOT NULL COMMENT '拒绝时间',
  `opt_name` varchar(60) NOT NULL COMMENT '操作员',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `contents` text NOT NULL COMMENT '拒绝理由',
  `source` enum('wap','app','wechat','api','pc') NOT NULL DEFAULT 'pc' COMMENT '来源:pc/wap/app/api/wechat',
  `langid` text NOT NULL COMMENT '国家',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='订单取消日志（仅记录拒绝订单）';

-- ----------------------------
-- Table structure for rt_order_complaint
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_complaint`;
CREATE TABLE `rt_order_complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` int(11) NOT NULL COMMENT '标题',
  `contents` int(11) NOT NULL COMMENT '投诉详情',
  `apps` int(11) NOT NULL COMMENT '所属模块',
  `model` int(11) NOT NULL COMMENT '数据表',
  `controller` int(11) NOT NULL COMMENT '来源控制器',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` int(11) NOT NULL COMMENT '状态 ',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `seller_id` int(11) NOT NULL COMMENT '商户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='投诉记录';

-- ----------------------------
-- Table structure for rt_order_confirm_log
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_confirm_log`;
CREATE TABLE `rt_order_confirm_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `source` int(11) NOT NULL COMMENT '来源',
  `uid` int(11) NOT NULL COMMENT '用户确认时的ID',
  `seller_id` int(11) NOT NULL COMMENT '商户确认时的ID',
  `opt_id` int(11) NOT NULL COMMENT '管理员操作时的ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单确认日志表';

-- ----------------------------
-- Table structure for rt_order_delivery
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_delivery`;
CREATE TABLE `rt_order_delivery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '发货单ID',
  `order_id` int(11) unsigned NOT NULL COMMENT '订单ID',
  `uid` int(11) unsigned NOT NULL COMMENT '用户ID',
  `admin_id` int(11) unsigned DEFAULT '0' COMMENT '管理员ID',
  `seller_id` int(11) unsigned DEFAULT '0' COMMENT '商户ID',
  `name` varchar(255) NOT NULL COMMENT '收货人',
  `postcode` varchar(6) DEFAULT NULL COMMENT '邮编',
  `telphone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `country` int(11) unsigned DEFAULT NULL COMMENT '国ID',
  `province` int(11) unsigned NOT NULL COMMENT '省ID',
  `city` int(11) unsigned NOT NULL COMMENT '市ID',
  `area` int(11) unsigned NOT NULL COMMENT '区ID',
  `address` varchar(250) NOT NULL COMMENT '收货地址',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `freight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `delivery_code` varchar(255) NOT NULL COMMENT '物流单号',
  `delivery_type` int(11) NOT NULL COMMENT '物流方式',
  `note` text COMMENT '管理员添加的备注信息',
  `if_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未删除 1:已删除',
  `freight_id` int(11) unsigned DEFAULT NULL COMMENT '货运公司ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发货状态',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`uid`),
  KEY `freight_id` (`freight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发货单';

-- ----------------------------
-- Table structure for rt_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_goods`;
CREATE TABLE `rt_order_goods` (
  `rec_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增加ID',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名',
  `goods_type` varchar(64) NOT NULL COMMENT 'normal：普通，bonded：保税，pay_taxes：完税，direct_mail：直邮',
  `sku_batch` varchar(120) NOT NULL COMMENT 'SKU批次号',
  `sku_thumb` text NOT NULL COMMENT '商品图片',
  `sku_barcode` varchar(80) NOT NULL COMMENT '商品条码',
  `sku_code` varchar(60) NOT NULL DEFAULT '' COMMENT '编码',
  `sku` varchar(64) NOT NULL COMMENT '货品SKU',
  `sku_pv` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'SKU商品的净利润',
  `sku_kickback` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'SKU商品佣金',
  `sku_warecode` varchar(50) NOT NULL COMMENT '仓库代码',
  `sku_packge_num` smallint(5) NOT NULL DEFAULT '1' COMMENT '包装数量',
  `sku_number` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `sku_weight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '商品重量',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `sku_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `sku_array` text NOT NULL COMMENT '商品和货品name，price,attr等相关属性的JSON',
  `sku_tax` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '单品税费',
  `country_code` varchar(20) NOT NULL COMMENT '国家代码',
  `country_name` varchar(50) NOT NULL COMMENT '国家名称',
  `send_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '发货数量',
  `real_price` decimal(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '实付金额',
  `extension_code` varchar(30) NOT NULL COMMENT '促销码',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '上级id',
  `is_gift` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否礼品',
  `is_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已发货',
  `warecode` varchar(60) NOT NULL COMMENT '商品所属仓库',
  `delivery_id` int(11) NOT NULL COMMENT '发货单ID',
  `seller_id` int(11) NOT NULL COMMENT '商家ID',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) NOT NULL,
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='订单商品详情';

-- ----------------------------
-- Table structure for rt_order_log
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_log`;
CREATE TABLE `rt_order_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单id',
  `order_sn` varchar(40) NOT NULL COMMENT '订单号',
  `user` varchar(20) DEFAULT NULL COMMENT '操作人：顾客或admin或seller',
  `role` varchar(60) NOT NULL COMMENT 'customer 顾客\r\ncustomer_service客服\r\nseller 商家\r\nadmin 管理员',
  `soruce` enum('api','app','wap','wechat','pc') NOT NULL DEFAULT 'pc' COMMENT '日志产生来源',
  `action` varchar(20) DEFAULT NULL COMMENT '动作\r\ncreate_order  创建订单\r\nupdate_order  更新订单\r\nupdate_order_status 更新订单状态\r\nconfirm_order 确认订单\r\ncancel_order 取消订单',
  `create_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `params` text NOT NULL COMMENT '请求参数',
  `result` varchar(10) DEFAULT NULL COMMENT '操作的结果',
  `remark` varchar(250) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单日志表';

-- ----------------------------
-- Table structure for rt_order_operative
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_operative`;
CREATE TABLE `rt_order_operative` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(60) NOT NULL COMMENT '合作商名称',
  `code` varchar(20) NOT NULL COMMENT '合作商代码',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='合作商';

-- ----------------------------
-- Table structure for rt_order_order
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_order`;
CREATE TABLE `rt_order_order` (
  `order_id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_sn` varchar(32) NOT NULL COMMENT '订单号',
  `batch_no` varchar(40) NOT NULL COMMENT '批次号',
  `order_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单类型 1正常订单 0系统自动生成',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `status` enum('WAIT_BUYER_PAY','WAIT_SELLER_SEND_GOODS','WAIT_BUYER_CONFIRM_GOODS','TRADE_FINISHED','TRADE_CLOSED','TRADE_CLOSED_BY_SYSTEM') NOT NULL COMMENT '订单状态:WAIT_BUYER_PAY:已下单等待付款,WAIT_SELLER_SEND_GOODS:已付款等待发货,WAIT_BUYER_CONFIRM_GOODS,已发货等待确认收货,TRADE_FINISHED,已完成,TRADE_CLOSED:已关闭(退款关闭订单),',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的姓名',
  `country` varchar(50) NOT NULL COMMENT '收货人的国家',
  `province` varchar(50) NOT NULL COMMENT '收货人的省份',
  `city` varchar(100) NOT NULL COMMENT '收货人的城市',
  `district` varchar(200) NOT NULL COMMENT '收货人的地区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人的详细地址',
  `zipcode` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的邮编',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人的电话',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人的手机',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人的Email',
  `idnumber` varchar(30) DEFAULT NULL COMMENT '身份证号',
  `sfzzm` text NOT NULL COMMENT '身份证正面',
  `sfzfm` text NOT NULL COMMENT '身份证反面',
  `pay_name` varchar(100) NOT NULL COMMENT '支付方式名称',
  `pay_class` varchar(60) NOT NULL COMMENT '支付方式：0：货到付款',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态;0未付款;1已付款',
  `shipping_id` tinyint(3) NOT NULL DEFAULT '0' COMMENT '用户选择的配送方式id',
  `shipping_name` varchar(120) NOT NULL DEFAULT '' COMMENT '用户选择的配送方式的名称',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '配送费用',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '商品配送情况;0未发货,1已发货,2已收货',
  `shipping_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单配送时间',
  `shipping_no` varchar(50) NOT NULL COMMENT '物流单号',
  `recode` varchar(40) NOT NULL COMMENT '收货人省市区代码组合',
  `postscript` varchar(255) NOT NULL DEFAULT '' COMMENT '订单附言,由用户提交订单前填写',
  `pay_ip` varchar(32) NOT NULL COMMENT '支付IP地址',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单支付时间',
  `inv_type` tinyint(1) NOT NULL COMMENT '1,公司，2，个人',
  `inv_number` varchar(50) NOT NULL COMMENT '纳税人识别号',
  `inv_payee` varchar(120) NOT NULL DEFAULT '' COMMENT '发票抬头',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品的总金额',
  `money_paid` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已付款金额',
  `integral` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用的积分的数量,取用户使用积分,商品可用积分,用户拥有积分中最小者 ',
  `bonus` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用红包金额',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '应付款金额',
  `symbol` varchar(3) NOT NULL COMMENT '货币符号',
  `code` varchar(4) NOT NULL COMMENT '货币代码',
  `rate` decimal(15,8) NOT NULL COMMENT '汇率',
  `platform_type` varchar(8) NOT NULL DEFAULT 'pc' COMMENT '来源平台',
  `ip` varchar(60) NOT NULL COMMENT '下单IP地址',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单生成时间',
  `confirm_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单确认时间',
  `bonus_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '红包id',
  `extension_code` varchar(30) NOT NULL DEFAULT '' COMMENT '通过活动购买的商品的代号,group_buy是团购; auction是拍卖;snatch夺宝奇兵;正常普通产品该处理为空 ',
  `extension_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '通过活动购买的物品id,取值ecs_good_activity;如果是正常普通商品,该处为0 ',
  `to_buyer` varchar(255) NOT NULL DEFAULT '' COMMENT '商家给客户的留言,当该字段值时可以在订单查询看到 ',
  `tax` decimal(10,2) NOT NULL COMMENT '发票税额',
  `order_tax` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单税费',
  `trade_no` varchar(255) NOT NULL COMMENT '支付平台返回的流水号',
  `is_separate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未分成或等待分成;1已分成;2取消分成 ',
  `discount` decimal(10,2) NOT NULL COMMENT '折扣',
  `is_evaluate` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已评价，1：是，0：否',
  `is_checkout` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否给商家货款',
  `langid` text NOT NULL COMMENT '下单所处语言',
  `partner` varchar(8) NOT NULL COMMENT '合作商',
  `settle_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '结算状态 1已结算 0未结算',
  `seller_id` int(11) NOT NULL COMMENT '商户ID',
  `warecode` varchar(50) NOT NULL COMMENT ' 仓库代码',
  `cancel_status` enum('FAILS','SUCCESS','REFUND_PROCESS','WAIT_PROCESS','NO_APPLY') NOT NULL DEFAULT 'NO_APPLY' COMMENT '取消状态, NO_APPLY:未申请'',WAIT_PROCESS:等待审核,REFUND_PROCESS:退款处理,SUCCESS:取消成功'',FAILS:取消失败'',',
  `cancel_type` tinyint(1) DEFAULT NULL COMMENT '取消类型：0 退款(仅退款不退货) 1 退款退货 2 换货 ',
  `cancel_reason` varchar(255) NOT NULL COMMENT '取消原因',
  `cancel_opt` varchar(50) DEFAULT NULL COMMENT '取消订单操作者',
  `cancel_soruce` varchar(20) NOT NULL DEFAULT 'pc' COMMENT '取消订单发起平台',
  `cancel_time` int(11) NOT NULL COMMENT '订单取消时间',
  `display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示，前台回收站功能',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_sn` (`order_sn`),
  KEY `user_id` (`user_id`),
  KEY `order_status` (`status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `pay_status` (`pay_status`),
  KEY `shipping_id` (`shipping_id`),
  KEY `extension_code` (`extension_code`,`extension_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='主订单表';

-- ----------------------------
-- Table structure for rt_order_recharge
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_recharge`;
CREATE TABLE `rt_order_recharge` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '充值订单id',
  `rec_sn` varchar(25) NOT NULL COMMENT '充值订单号',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `rec_money` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `rec_account` varchar(35) NOT NULL DEFAULT '0' COMMENT '充值账户',
  `pay_name` varchar(20) NOT NULL DEFAULT '0' COMMENT '支付方式',
  `pay_id` tinyint(1) NOT NULL COMMENT '支付方式id',
  `trade_no` varchar(35) NOT NULL DEFAULT '0' COMMENT '支付流水号',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `rec_ip` bigint(20) NOT NULL COMMENT '充值ip地址',
  `finish_time` int(11) NOT NULL COMMENT '完成时间',
  `referer` varchar(25) NOT NULL COMMENT '来源',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '充值状态 4无效订单 1申请中 2充值中 3充值完成',
  PRIMARY KEY (`order_id`),
  KEY `rec_sn` (`rec_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单模块充值表';

-- ----------------------------
-- Table structure for rt_order_refund
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_refund`;
CREATE TABLE `rt_order_refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_sn` varchar(20) NOT NULL COMMENT '退换货编号',
  `order_id` int(11) NOT NULL COMMENT '订单ID',
  `order_sn` varchar(20) NOT NULL COMMENT '订单号',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `return_reason` varchar(250) NOT NULL COMMENT '退款原因',
  `orderprice` decimal(10,2) NOT NULL COMMENT '订单金额',
  `applyprice` decimal(10,2) NOT NULL COMMENT '申请退款金额',
  `rtype` tinyint(1) NOT NULL COMMENT '申请类型 0 退款(仅退款不退货) 1 退款退货 2 换货 ',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态: 0未退，1已退款',
  `create_time` int(11) NOT NULL COMMENT '建立时间',
  `update_time` int(11) NOT NULL COMMENT '操作时间',
  `refund_time` int(11) NOT NULL COMMENT '退款时间',
  PRIMARY KEY (`id`),
  KEY `orderid` (`order_sn`),
  KEY `order_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='订单退款表';

-- ----------------------------
-- Table structure for rt_order_supplier
-- ----------------------------
DROP TABLE IF EXISTS `rt_order_supplier`;
CREATE TABLE `rt_order_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `seller_id` int(11) NOT NULL COMMENT '商户',
  `uid` int(11) NOT NULL COMMENT '申请用户',
  `status` int(11) NOT NULL COMMENT '状态',
  `langid` int(11) NOT NULL COMMENT '语言系',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '结算金额',
  `evidence` text NOT NULL COMMENT '证据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商结算申请表';

-- ----------------------------
-- Table structure for rt_promotion_adsense
-- ----------------------------
DROP TABLE IF EXISTS `rt_promotion_adsense`;
CREATE TABLE `rt_promotion_adsense` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) DEFAULT NULL COMMENT '广告位名称',
  `searchkey` text NOT NULL COMMENT '对应操作词',
  `searchtype` tinyint(1) NOT NULL DEFAULT '0' COMMENT '匹配类型',
  `uid` int(11) NOT NULL COMMENT '操作人员ID',
  `adpostionid` int(11) DEFAULT '0' COMMENT '位置',
  `style` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型',
  `image` varchar(255) DEFAULT NULL COMMENT ' 图片地址',
  `flashurl` text COMMENT 'flash地址',
  `text` text COMMENT '文本内容',
  `texturl` varchar(255) DEFAULT NULL COMMENT '文本广告连接指向',
  `code` text COMMENT '代码',
  `url` text COMMENT '链接 URL',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `isrecommend` tinyint(1) NOT NULL COMMENT '推荐',
  `istop` tinyint(1) NOT NULL COMMENT '置顶',
  `client_name` varchar(50) DEFAULT NULL COMMENT '广告主',
  `client_mobile` varchar(15) DEFAULT NULL COMMENT '广告主手机',
  `begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始 时间',
  `end_time` int(11) NOT NULL DEFAULT '9' COMMENT '结束 时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '点击 次数，用于统计',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告';

-- ----------------------------
-- Table structure for rt_promotion_adsensepos
-- ----------------------------
DROP TABLE IF EXISTS `rt_promotion_adsensepos`;
CREATE TABLE `rt_promotion_adsensepos` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL COMMENT '名称',
  `width` int(11) NOT NULL COMMENT '广告宽度',
  `height` int(11) NOT NULL COMMENT '广告高度',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '展示方式1图片2文字3Flash',
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1只可以发布一条，2可以发布多条',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `langid` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告位置';

-- ----------------------------
-- Table structure for rt_promotion_cat
-- ----------------------------
DROP TABLE IF EXISTS `rt_promotion_cat`;
CREATE TABLE `rt_promotion_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `title` varchar(50) NOT NULL COMMENT '分类名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语系',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='实体券分类';

-- ----------------------------
-- Table structure for rt_promotion_links
-- ----------------------------
DROP TABLE IF EXISTS `rt_promotion_links`;
CREATE TABLE `rt_promotion_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `fcatid` int(11) NOT NULL COMMENT '分类id',
  `title` varchar(60) NOT NULL COMMENT '标题',
  `url` varchar(255) NOT NULL COMMENT '地址',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `target` varchar(10) DEFAULT NULL COMMENT '目标链接',
  `logo` varchar(255) NOT NULL COMMENT 'logo',
  `sort` smallint(2) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `finish_time` int(11) NOT NULL DEFAULT '9',
  `langid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接 表';

-- ----------------------------
-- Table structure for rt_promotion_spaticker
-- ----------------------------
DROP TABLE IF EXISTS `rt_promotion_spaticker`;
CREATE TABLE `rt_promotion_spaticker` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '产品ID',
  `num` tinyint(2) NOT NULL DEFAULT '0' COMMENT '可提取数量',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `isactived` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否激活',
  `isused` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用',
  `begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '可用起始时间',
  `end_time` int(11) NOT NULL DEFAULT '9' COMMENT '可用结束时间',
  `used_time` int(11) NOT NULL DEFAULT '0' COMMENT '使用时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='体验券';

-- ----------------------------
-- Table structure for rt_runtuer_liceson
-- ----------------------------
DROP TABLE IF EXISTS `rt_runtuer_liceson`;
CREATE TABLE `rt_runtuer_liceson` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL COMMENT '授权名称',
  `url` varchar(255) NOT NULL COMMENT '授权域名',
  `code` varchar(100) NOT NULL COMMENT '授权码',
  `version` varchar(50) NOT NULL COMMENT '授权版本',
  `version_type` int(5) NOT NULL COMMENT '版本类型',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `jumptarget` varchar(255) NOT NULL COMMENT '跳转目标',
  `content` varchar(20) NOT NULL COMMENT '内容',
  `user` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `type` tinyint(2) NOT NULL COMMENT '产品类型',
  `start_time` int(11) NOT NULL COMMENT '授权起始时间',
  `end_time` int(11) NOT NULL COMMENT '授权结束时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：1正常，0禁止',
  `isliceson` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已授权：1是，0否',
  `uid` int(11) NOT NULL COMMENT '添加者',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='授权表';

-- ----------------------------
-- Table structure for rt_runtuer_projects
-- ----------------------------
DROP TABLE IF EXISTS `rt_runtuer_projects`;
CREATE TABLE `rt_runtuer_projects` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '项目名称',
  `type` smallint(2) NOT NULL DEFAULT '1' COMMENT '项目类型',
  `dev_lang` varchar(50) NOT NULL DEFAULT 'php' COMMENT '开发语言',
  `project_content` text NOT NULL COMMENT '项目简介',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '立项时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '项目终止时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `planned_cycle` int(11) NOT NULL DEFAULT '0' COMMENT '计划周期',
  `contact_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后一次联系时间',
  `contract_date` int(11) DEFAULT '0',
  `contact_name` varchar(30) DEFAULT NULL COMMENT '负责人',
  `contact_qq` varchar(20) DEFAULT NULL COMMENT '负责人QQ',
  `contact_mob` varchar(15) DEFAULT NULL COMMENT '负责人电话',
  `pay_type` varchar(10) DEFAULT NULL COMMENT '支付类型',
  `begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '开发开始时间',
  `finish_time` int(11) NOT NULL DEFAULT '0' COMMENT '开发结束时间',
  `dev_name` varchar(200) DEFAULT NULL COMMENT '开发人员',
  `planned_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '客户预算',
  `bid_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '我方报价',
  `actual_collection` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实 收 款:',
  `hasdomain` tinyint(1) NOT NULL DEFAULT '1' COMMENT '自有域名',
  `hasvhost` tinyint(1) NOT NULL DEFAULT '1' COMMENT '自有服务器',
  `isforeign` tinyint(1) NOT NULL DEFAULT '0' COMMENT '项目性质',
  `froms` smallint(2) NOT NULL DEFAULT '2' COMMENT '项目来源',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '优先级',
  `uid` int(11) NOT NULL DEFAULT '1' COMMENT '项目添加人',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `langid` varchar(20) NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目报备表';

-- ----------------------------
-- Table structure for rt_seller_account
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_account`;
CREATE TABLE `rt_seller_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(80) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '商家密码',
  `salt` varchar(4) NOT NULL COMMENT '加密盐值',
  `login_time` int(11) NOT NULL COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL COMMENT '最后登录ip地址',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` bigint(11) NOT NULL COMMENT '手机号码',
  `realname` varchar(15) NOT NULL COMMENT '真实姓名',
  `cat_id` int(11) NOT NULL COMMENT '分类id',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '商户账号状态 1正常 0禁用',
  `create_time` int(11) NOT NULL COMMENT '注册时间',
  `update_time` int(11) NOT NULL,
  `housecode` varchar(255) NOT NULL COMMENT '仓库',
  `langid` varchar(10) NOT NULL DEFAULT 'zh-cn' COMMENT '语言id',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '上级id',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色id 0为超级管理员',
  `is_del` tinyint(1) NOT NULL COMMENT '是否已删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `seller_name` (`nickname`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='商家账号表';

-- ----------------------------
-- Table structure for rt_seller_count
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_count`;
CREATE TABLE `rt_seller_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `bill_sn` varchar(32) NOT NULL COMMENT '账单号',
  `seller_id` int(11) NOT NULL DEFAULT '0' COMMENT '商户id',
  `seller_name` varchar(50) NOT NULL COMMENT '商户名称',
  `start_time` int(11) NOT NULL COMMENT '结算开始时间',
  `end_time` int(11) NOT NULL COMMENT '结算完成时间',
  `goods_total_money` decimal(10,2) NOT NULL COMMENT '订单商品金额',
  `order_num` int(11) NOT NULL COMMENT '订单数量',
  `freight` decimal(10,2) NOT NULL COMMENT '运费',
  `platform_commission` decimal(10,2) NOT NULL COMMENT '平台佣金',
  `integral_money` decimal(10,2) NOT NULL COMMENT '积分金额',
  `bonus` decimal(10,2) NOT NULL COMMENT '红包金额',
  `coupon` decimal(10,2) NOT NULL COMMENT '优惠券抵扣',
  `special_offer` decimal(10,2) NOT NULL COMMENT '优惠活动抵扣',
  `refund_money` decimal(10,2) NOT NULL COMMENT '退款金额',
  `money` decimal(10,2) NOT NULL COMMENT '本期应结金额',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '结算状态 -1作废 1申请中 2已完成',
  `order_ids` varchar(500) NOT NULL COMMENT '所有结算订单id',
  PRIMARY KEY (`id`),
  KEY `sellers_id` (`seller_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商家结算表';

-- ----------------------------
-- Table structure for rt_seller_feedback
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_feedback`;
CREATE TABLE `rt_seller_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `seller_id` int(11) NOT NULL COMMENT '商家id',
  `seller_name` varchar(25) NOT NULL COMMENT '商户名称',
  `content` varchar(500) NOT NULL COMMENT '反馈内容',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '反馈提交时间',
  `user_ip` bigint(20) NOT NULL COMMENT '反馈人ip',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '反馈状态 1等待回复 2已回复 ',
  `handling_content` varchar(500) NOT NULL COMMENT '回复内容',
  `check_time` int(11) NOT NULL COMMENT '回复时间',
  `operator` varchar(25) NOT NULL COMMENT '操作人',
  `operator_id` int(11) NOT NULL COMMENT '操作人id',
  `langid` varchar(10) NOT NULL COMMENT '语言id',
  `mobile` bigint(11) NOT NULL DEFAULT '0' COMMENT '手机号码',
  `email` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='意见反馈表';

-- ----------------------------
-- Table structure for rt_seller_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_goods_category`;
CREATE TABLE `rt_seller_goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL COMMENT '分类名称',
  `sort` int(10) NOT NULL COMMENT '排序',
  `is_nav` tinyint(1) NOT NULL COMMENT '是否导航显示',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `seller_id` int(11) NOT NULL COMMENT '商户账号id',
  `langid` varchar(10) NOT NULL COMMENT '语言',
  `goods_ids` text NOT NULL COMMENT '商品id集合',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='店铺商品分类';

-- ----------------------------
-- Table structure for rt_seller_goods_consult
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_goods_consult`;
CREATE TABLE `rt_seller_goods_consult` (
  `consult_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '咨询编号',
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品编号',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '咨询发布者会员编号(0：游客)',
  `member_name` varchar(100) NOT NULL COMMENT '会员名称',
  `store_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '店铺编号',
  `store_name` varchar(50) NOT NULL COMMENT '店铺名称',
  `ct_id` int(10) unsigned NOT NULL COMMENT '咨询类型',
  `consult_content` varchar(255) NOT NULL COMMENT '咨询内容',
  `consult_addtime` int(10) NOT NULL COMMENT '咨询发布时间',
  `consult_reply` varchar(255) NOT NULL COMMENT '咨询回复内容',
  `consult_reply_time` int(10) NOT NULL COMMENT '咨询回复时间',
  `isanonymous` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示不匿名 1表示匿名',
  PRIMARY KEY (`consult_id`),
  KEY `goods_id` (`goods_id`),
  KEY `seller_id` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品咨询表';

-- ----------------------------
-- Table structure for rt_seller_log
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_log`;
CREATE TABLE `rt_seller_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `uid` int(11) NOT NULL COMMENT '操作人id',
  `log_info` varchar(255) NOT NULL COMMENT '操作详情',
  `action_id` int(11) NOT NULL COMMENT '操作行为id',
  `action_model` varchar(255) NOT NULL COMMENT '行为模型',
  `log_ip` bigint(20) NOT NULL,
  `log_time` int(11) NOT NULL COMMENT '操作时间',
  `seller_id` int(11) NOT NULL COMMENT '商户id',
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8 COMMENT='商家操作日志';

-- ----------------------------
-- Table structure for rt_seller_offshop
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_offshop`;
CREATE TABLE `rt_seller_offshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `seller_id` int(11) NOT NULL COMMENT '商家id',
  `seller_name` varchar(25) NOT NULL COMMENT '店铺名称',
  `mobile` bigint(11) NOT NULL COMMENT '手机号',
  `phone` int(11) NOT NULL COMMENT '电话',
  `country` int(11) NOT NULL COMMENT '国id',
  `province` int(11) NOT NULL COMMENT '省id',
  `city` int(11) NOT NULL COMMENT '市id',
  `district` int(11) NOT NULL DEFAULT '0' COMMENT '区id',
  `address` varchar(50) NOT NULL COMMENT '详细地址',
  `lat` varchar(15) NOT NULL COMMENT '店铺纬度',
  `lng` varchar(15) NOT NULL COMMENT '店铺经度',
  `logo` varchar(200) NOT NULL COMMENT '店铺图片',
  `status` tinyint(1) NOT NULL COMMENT '状态 0禁止 1正常',
  `description` varchar(250) NOT NULL COMMENT '店铺描述',
  `cat_id` int(11) NOT NULL COMMENT '店铺类型id',
  `principal` varchar(20) NOT NULL COMMENT '负责人',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `langid` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='线下门店表';

-- ----------------------------
-- Table structure for rt_seller_role
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_role`;
CREATE TABLE `rt_seller_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '0' COMMENT '角色名称',
  `right` text NOT NULL COMMENT '权限（允许访问的路由url,每个url用'';''分割）',
  `seller_id` int(11) NOT NULL COMMENT '角色所属商户id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商家角色表';

-- ----------------------------
-- Table structure for rt_seller_shopcat
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_shopcat`;
CREATE TABLE `rt_seller_shopcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `name` varchar(50) NOT NULL COMMENT '类型名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  `suffix` varchar(10) NOT NULL COMMENT '店铺名称后缀',
  `goods_limit` int(11) NOT NULL COMMENT '店铺默认商品上线',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '-1删除 0禁用 1正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='店铺类型';

-- ----------------------------
-- Table structure for rt_seller_shop_attention
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_shop_attention`;
CREATE TABLE `rt_seller_shop_attention` (
  `uid` int(11) NOT NULL COMMENT '用户id',
  `store_id` int(11) NOT NULL COMMENT '店铺id（seller表id）',
  `create_time` int(11) NOT NULL,
  `create_day` date NOT NULL,
  PRIMARY KEY (`uid`,`store_id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `store_id` (`store_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='店铺关注表';

-- ----------------------------
-- Table structure for rt_seller_slideshow
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_slideshow`;
CREATE TABLE `rt_seller_slideshow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL COMMENT '商户id',
  `img` varchar(255) NOT NULL COMMENT '图片',
  `url` varchar(255) NOT NULL COMMENT '连接地址',
  `type` enum('APP','WAP','PC') NOT NULL DEFAULT 'PC',
  `sort` mediumint(9) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='店铺轮播图';

-- ----------------------------
-- Table structure for rt_seller_store
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_store`;
CREATE TABLE `rt_seller_store` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) NOT NULL COMMENT '商家账户id',
  `seller_name` varchar(80) NOT NULL COMMENT '商铺店名',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码',
  `phone` varchar(20) NOT NULL COMMENT '座机号码',
  `linkname` varchar(255) NOT NULL COMMENT '联系人',
  `cash` decimal(15,2) NOT NULL COMMENT '保证金',
  `company` varchar(50) NOT NULL COMMENT '公司名称',
  `license_no` varchar(100) NOT NULL COMMENT '营业执照编号',
  `business_license` varchar(500) NOT NULL COMMENT '营业执照照片',
  `tax_registration_certificate` varchar(200) NOT NULL COMMENT '税务登记证照片',
  `taxpayer_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '纳税人类型 1一般纳税人 2小规模纳税人 3非增值税纳税人',
  `tax_code_type` tinyint(2) NOT NULL COMMENT '纳税类型税码 0% 3% 6% 11% 13% 17%',
  `corporate` varchar(25) NOT NULL COMMENT '法人代表',
  `corporate_card_true` varchar(255) NOT NULL COMMENT '身份证正面照',
  `corporate_card_false` varchar(255) NOT NULL COMMENT '身份证反面照',
  `organization_code` varchar(50) NOT NULL COMMENT '组织机构代码',
  `organization_code_date_end` date NOT NULL COMMENT '组织机构代码有效期（结束时间）',
  `organization_code_date_start` date NOT NULL COMMENT '组织机构代码有效期（开始时间）',
  `organization_code_img` varchar(255) NOT NULL COMMENT 'organization_code_img',
  `build_time` int(11) NOT NULL COMMENT '成立日期',
  `country` int(11) unsigned NOT NULL COMMENT '国ID',
  `province` int(11) unsigned NOT NULL COMMENT '省ID',
  `city` int(11) unsigned NOT NULL COMMENT '市ID',
  `district` int(11) unsigned NOT NULL COMMENT '区ID',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `bank` varchar(50) NOT NULL COMMENT '开户行',
  `bank_no` bigint(20) NOT NULL COMMENT '开户行卡号',
  `bank_name` varchar(50) NOT NULL COMMENT '开户人姓名',
  `bank_address` varchar(255) NOT NULL COMMENT '开户行地址',
  `business_license_type` varchar(255) NOT NULL COMMENT '营业执照类型',
  `registered_assets` decimal(10,2) NOT NULL COMMENT '注册资本',
  `qq` varchar(20) NOT NULL COMMENT 'QQ号码',
  `home_url` varchar(255) NOT NULL COMMENT '企业URL网站',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'LOGO图标',
  `top_ad_img` varchar(255) NOT NULL COMMENT '店铺首页顶部广告图',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '2申请中 1已通过(正常) 0锁定 -1驳回',
  `cat_id` int(11) NOT NULL COMMENT '店铺类型id',
  `common_express` varchar(255) NOT NULL COMMENT '常用快递',
  `sale_goods_num` varchar(20) NOT NULL COMMENT '可售商品数量',
  `average_sale_price` varchar(20) NOT NULL COMMENT '平均客单价',
  `after_sale_address` varchar(255) NOT NULL COMMENT '售后地址',
  `main_cat_id` int(11) NOT NULL COMMENT '主营类目id',
  `goods_cat` varchar(255) NOT NULL COMMENT '经营类型id集合（商品第三级分类id）',
  `warning_quantity` smallint(2) NOT NULL COMMENT '预警库存',
  `ware_address` varchar(255) NOT NULL COMMENT '仓库地址',
  `reject_reason` varchar(500) NOT NULL COMMENT '拒绝原因',
  `shop_grade` decimal(3,2) NOT NULL COMMENT '店铺评分',
  `seo_keywords` varchar(255) NOT NULL COMMENT 'seo关键字',
  `shop_description` varchar(255) NOT NULL COMMENT '店铺描述',
  `show_customer_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示顾客身份证信息',
  `langid` varchar(10) NOT NULL,
  `create_time` int(11) NOT NULL COMMENT '加入时间',
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `seller_name` (`seller_name`),
  UNIQUE KEY `seller_id` (`seller_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商家店铺表';

-- ----------------------------
-- Table structure for rt_seller_template
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_template`;
CREATE TABLE `rt_seller_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键自增id',
  `name` varchar(50) NOT NULL COMMENT '模板名称',
  `description` varchar(255) NOT NULL COMMENT '模板描述',
  `picture` varchar(200) NOT NULL COMMENT '预览图',
  `create_time` int(11) NOT NULL,
  `skin_name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '状态 1正常 0禁止',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家店铺模板';

-- ----------------------------
-- Table structure for rt_seller_transport
-- ----------------------------
DROP TABLE IF EXISTS `rt_seller_transport`;
CREATE TABLE `rt_seller_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '运费模板名称',
  `is_free` tinyint(1) NOT NULL COMMENT '是否包邮',
  `valuation` varchar(20) NOT NULL COMMENT '计价方式 1按重量计价 2按件数计价 3按金额计价',
  `status` tinyint(1) NOT NULL COMMENT '状态 1启用 0禁用',
  `open_freerule` tinyint(1) NOT NULL COMMENT '是否开启免邮规则 0关闭 1开启',
  `fee_conf` text NOT NULL COMMENT '按重量计价配置=>country_id国家id,area_ids地区集合，start_standard首重，start_fee首费，add_standard续重，add_fee续费',
  `fee_number_conf` text NOT NULL COMMENT '按件数计价配置=>country_id国家id,area_ids地区集合，start_standard首件，start_fee首费，add_standard续件，add_fee续费',
  `fee_money_conf` text NOT NULL COMMENT '按金额计价配置=>rules规则{up金额上限，down金额下限，basefee运费}，area_ids地区集合，country_id国家id',
  `free_conf` text NOT NULL COMMENT '按重免邮规则=>country_id国家id,area_ids地区集合，freetype免邮规则（1重量，2金额，3重量+金额）',
  `free_number_conf` text NOT NULL COMMENT '按件免邮规则=>country_id国家id,area_ids地区集合，freetype免邮规则（1件数，2金额，3件数+金额）',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL COMMENT '店铺id（seller表）',
  `warecode` varchar(255) NOT NULL COMMENT '仓库编码',
  `express_ids` varchar(255) NOT NULL COMMENT '快递公司id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='运费模板表';

-- ----------------------------
-- Table structure for rt_stools_payment_bill
-- ----------------------------
DROP TABLE IF EXISTS `rt_stools_payment_bill`;
CREATE TABLE `rt_stools_payment_bill` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '支付单号',
  `money` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '支付金额',
  `uid` bigint(20) DEFAULT NULL COMMENT '会员ID',
  `status` enum('succ','failed','error') NOT NULL DEFAULT 'succ' COMMENT '支付状态',
  `pay_class` varchar(100) NOT NULL COMMENT '支付方式类名称',
  `pay_name` varchar(100) NOT NULL,
  `pay_account` varchar(50) NOT NULL COMMENT '支付账户',
  `t_payed` int(10) unsigned NOT NULL COMMENT '支付完成时间',
  `order_sn` varchar(32) NOT NULL COMMENT '订单号',
  `currency` varchar(10) NOT NULL COMMENT '货币',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `ip` varchar(20) NOT NULL COMMENT '支付IP',
  `trade_no` varchar(30) NOT NULL COMMENT '支付单交易编号',
  `collection` varchar(120) NOT NULL COMMENT '收款账户',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='支付单表';

-- ----------------------------
-- Table structure for rt_stools_refund_bill
-- ----------------------------
DROP TABLE IF EXISTS `rt_stools_refund_bill`;
CREATE TABLE `rt_stools_refund_bill` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT '支付单号',
  `money` decimal(20,3) NOT NULL DEFAULT '0.000' COMMENT '退款金额',
  `uid` int(11) DEFAULT NULL COMMENT '会员ID',
  `opid` int(11) NOT NULL COMMENT '操作员ID',
  `status` enum('succ','failed','error') NOT NULL COMMENT '退款状态',
  `refund_name` varchar(100) DEFAULT NULL COMMENT '退款名称',
  `t_payed` int(10) unsigned DEFAULT NULL COMMENT '退款完成时间',
  `order_sn` varchar(32) DEFAULT NULL COMMENT '对应的订单号',
  `account` varchar(50) DEFAULT NULL COMMENT '收款账号',
  `refund_account` varchar(50) DEFAULT NULL COMMENT '退款账户',
  `currency` varchar(10) DEFAULT NULL COMMENT '货币',
  `refund_class` varchar(100) NOT NULL COMMENT '退款方式名称',
  `ip` varchar(20) DEFAULT NULL COMMENT '退款操作IP',
  `memo` longtext COMMENT '退款注释',
  `trade_no` varchar(30) DEFAULT NULL COMMENT '退款单交易编号',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '编辑时间',
  `refund_error_mark` text NOT NULL COMMENT '退款失败原因',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付单表';

-- ----------------------------
-- Table structure for rt_systems_crontab
-- ----------------------------
DROP TABLE IF EXISTS `rt_systems_crontab`;
CREATE TABLE `rt_systems_crontab` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `appid` varchar(100) NOT NULL COMMENT 'APP应用',
  `name` varchar(100) NOT NULL COMMENT '任务类名',
  `lasttime` int(11) NOT NULL COMMENT '最后执行时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='定时任务记录';

-- ----------------------------
-- Table structure for rt_system_queue
-- ----------------------------
DROP TABLE IF EXISTS `rt_system_queue`;
CREATE TABLE `rt_system_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL COMMENT '队列标识',
  `payload` longtext NOT NULL COMMENT '队列有效负荷',
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='队列';

-- ----------------------------
-- Table structure for rt_union_ads
-- ----------------------------
DROP TABLE IF EXISTS `rt_union_ads`;
CREATE TABLE `rt_union_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `gid` int(11) NOT NULL COMMENT '广告分组ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `ads_title` int(11) NOT NULL COMMENT '广告标题',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `sort` int(11) NOT NULL COMMENT '排序',
  `status` int(11) NOT NULL COMMENT '状态',
  `opid` varchar(50) NOT NULL COMMENT '操作者',
  `langid` text NOT NULL COMMENT '语言',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='联盟广告列表';
