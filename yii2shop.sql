/*
Navicat MySQL Data Transfer

Source Server         : workdata
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : yii2shop

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2017-08-01 15:31:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'PPIeEn6xX1iUDWe37WD6Ua2AMYqzbRL9', '$2y$13$C.gNbTabZ89TUlKgLTjZ3u89aaq9GghjNW5/hkEYjX3nTaosxXZW2', null, '18111251826@163.com', '10', '1501037562', '1501140170');
INSERT INTO `admin` VALUES ('2', '雷军', 'xBoeuJQ-5KYRil7Jsab51u3ldSVpZIJ4', '$2y$13$wx1vgbUJawB4.qeONJ8e6eMPbLxoy09sFGrugDaX.79KItrIL.zN2', null, '18111251827@163.com', '10', '1501040423', '1501040423');
INSERT INTO `admin` VALUES ('3', '窦唯2', 'gjI7fIOXwfMAs3xFHV6nV5obU-ASS_Kp', '$2y$13$./5jeXpivVJxHEabBgk8kuKluzsWZA9cqtzMWkZVgDkvhZGwmNJeC', null, '18111251822@163.com', '0', '1501040567', '1501141467');

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '文名称',
  `article_category_id` int(11) unsigned DEFAULT '1' COMMENT '文章分类id',
  `sort` smallint(6) unsigned DEFAULT '10' COMMENT '文章分类排序',
  `status` smallint(6) DEFAULT '1' COMMENT '1正常,2隐藏,3删除',
  `create` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `namekey` (`name`),
  KEY `statuskey` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('21', '管理您的 Apple ID', '3', '4', '1', '1500466138');
INSERT INTO `article` VALUES ('22', '共享Apple ID', '1', '5', '1', '1500466259');
INSERT INTO `article` VALUES ('23', 'Apple 认证的翻新产品', '3', '3', '1', '1500525513');
INSERT INTO `article` VALUES ('27', '购买分期', '3', '4', '1', '1500526213');

-- ----------------------------
-- Table structure for `article_category`
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '文章分类名称',
  `intro` varchar(300) DEFAULT NULL COMMENT '文章分类介绍',
  `sort` smallint(6) unsigned DEFAULT '10' COMMENT '文章分类排序',
  `status` smallint(6) DEFAULT '1' COMMENT '1正常,2隐藏,3删除',
  `is_help` smallint(6) DEFAULT '0' COMMENT '0否1是',
  PRIMARY KEY (`id`),
  UNIQUE KEY `namekey` (`name`),
  KEY `ishelpkey` (`is_help`),
  KEY `statuskey` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='品牌表';

-- ----------------------------
-- Records of article_category
-- ----------------------------
INSERT INTO `article_category` VALUES ('1', '账户', '关于你的账户操作指南', '5', '1', '1');
INSERT INTO `article_category` VALUES ('2', '关于 Apple', '关于apple的介绍', '7', '1', '0');
INSERT INTO `article_category` VALUES ('3', 'Apple Store 商店', '关于Apple Store 商店操作指南', '4', '1', '1');
INSERT INTO `article_category` VALUES ('4', '选购及了解', '购买apple指南', '8', '1', '1');

-- ----------------------------
-- Table structure for `article_detail`
-- ----------------------------
DROP TABLE IF EXISTS `article_detail`;
CREATE TABLE `article_detail` (
  `article_id` int(11) NOT NULL COMMENT '文章id',
  `content` text NOT NULL COMMENT '文章内容',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章详情表';

-- ----------------------------
-- Records of article_detail
-- ----------------------------
INSERT INTO `article_detail` VALUES ('21', '什么是 Apple ID？\r\nApple ID 是您用来访问 App Store、iTunes Store、iCloud、iMessage、Apple Store 在线商店、FaceTime 等 Apple 服务的个人帐户。它包括您用来登录的电子邮件地址和密码，还包括您将在所有 Apple 服务中使用的所有联系人、付款信息和安全详情。\r\n何时使用我的 Apple ID？\r\n每当您设置新设备、购物或使用任何 Apple 服务时，都需要使用您的 Apple ID 和密码登录。登录之后，您将有权访问相关服务及您帐户中的所有个人信息');
INSERT INTO `article_detail` VALUES ('22', '<p style=\"text-align:center\"><img src=\"http://img.yii2shop.cn/uedit/20170720/1500524988924608.jpg\" title=\"1500524988924608.jpg\" alt=\"1500524988924608.jpg\" width=\"100\" height=\"100\"/></p><p>我是否可以与其他人共享 Apple ID？\r\n您的 Apple ID 不得与任何人共享。使用它可访问通讯录、照片、设备备份等个人信息。与其他人共享您的 Apple ID 即意味着您授予他们访问您的所有个人内容的权利，并可能导致人们对于是谁实际上拥有该帐户产生混淆。要与其他人共享在 iTunes Store 和 App Store 中购买的内容以及照片、日历等，请尝试家人共享、iCloud 照片共享，或其他易于使用的共享功能。<br/></p>');
INSERT INTO `article_detail` VALUES ('23', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);\">在将 Apple 认证的翻新产品上架销售之前，我们会按照符合 Apple 高标准的严格翻新流程，对这些产品进行翻新。</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Lucida Grande&quot;, Helvetica, Arial, Verdana, sans-serif; font-size: 12px; background-color: rgb(255, 255, 255);\">我们为其提供标准的一年有限保修服务。你可以选购 AppleCare 全方位服务计划来延长保修期。</span></p>');
INSERT INTO `article_detail` VALUES ('27', '<p><span style=\"font-size: 11px;\"></span></p><h2><span style=\"font-size: 10px;\">在 Apple Store 在线商店购买产品时可申请灵活的分期付款服务，请参考以下银行分期付款选择及费率。*</span></h2><p><span style=\"font-size: 12px;\">分期付款仅限在 Apple Store 在线商店购买产品并符合条件的招商银行信用卡用户，工商银行信用卡用户及中国农业银行信用卡用户申请，且银行有权决定是否接受该等申请。<br/>银行可能要求你的信用卡可用额度大于所购买产品的总金额，才能使用信用卡分期付款服务。 具体情况请与你的银行联系。Apple 对此不做任何承诺和保证。<img src=\"http://img.yii2shop.cn/uedit/20170720/1500525789380061.png\" title=\"1500525789380061.png\" alt=\"1500525789380061.png\" width=\"400\" height=\"200\"/></span></p>');

-- ----------------------------
-- Table structure for `auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('article/add', '2', '文章添加', null, null, '1501256438', '1501294778');
INSERT INTO `auth_item` VALUES ('article/update', '2', '文章修改', null, null, '1501294832', '1501294845');
INSERT INTO `auth_item` VALUES ('文章管理员', '1', '负责文章管理', null, null, '1501292879', '1501296008');

-- ----------------------------
-- Table structure for `auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('文章管理员', 'article/add');
INSERT INTO `auth_item_child` VALUES ('文章管理员', 'article/update');

-- ----------------------------
-- Table structure for `auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for `brand`
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT 'Ʒ������',
  `intro` text COMMENT 'Ʒ�Ƽ��',
  `logo` varchar(200) DEFAULT NULL COMMENT 'Ʒ��logo',
  `sort` smallint(6) DEFAULT '10' COMMENT '����',
  `status` smallint(6) unsigned DEFAULT '1' COMMENT '1=>����,2����,3ɾ��',
  PRIMARY KEY (`id`),
  UNIQUE KEY `namekey` (`name`),
  KEY `statuskey` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Ʒ�Ʊ�';

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('1', '小米', '小米公司正式成立于2010年4月，是一家专注于高端智能手机、互联网电视以及智能家居生态链建设的创新型科技企业。', 'http://otced3uov.bkt.clouddn.com/20170724/86129a861bed1abeb96cbd9082697b3b8f4d6ac6.jpg', '20', '1');
INSERT INTO `brand` VALUES ('2', '华为', '华为是全球领先的信息与通信解决方案供应商。我们围绕客户的需求持续创新，与合作伙伴开放合作，在电信网络、企业网络、消费者和云计算等领域构筑了端到端的解决方案优势。我们致力于为电信运营商、企业和消费者等提供有竞争力的 ICT 解决方案和服务，持续提升客户体验，为客户创造最大价值。目前，华为的产品和解决方案已经应用于 140 多个国家，服务全球 1/3的人口。', 'http://otced3uov.bkt.clouddn.com/20170724/25e7f8e20d73b9f609ec8a7cd2499cfe9cc7f632.jpg', '12', '1');
INSERT INTO `brand` VALUES ('3', '魅族', '魅族公司成立于2003年。创始人从小沉迷电子热爱科技，魅族就是电子梦想和共赢理念的结晶。从创立以来的一次次飞跃不仅是魅族人热爱追求的结果，更是梦想力量的体现', 'http://otced3uov.bkt.clouddn.com/20170724/a8b637a8d2c5f40f9f24f8cd2ac3708b8cee396a.jpg', '30', '2');
INSERT INTO `brand` VALUES ('4', '三星', '自1969年在韩国水原成立以来，三星电子已成长为一个全球性的信息技术企业，在世界各地拥有200多家子公司。 三星电子的产品包括家用电器（如电视、显示器、冰箱和洗衣机），和主要的移动通信产品（如智能手机和平板电脑）。此外，三星还是重要电子部件（如DRA和非存储半导体）领域值得信赖的供应商。', 'http://otced3uov.bkt.clouddn.com/20170724/af44fd8fbd7145bfdc85fd691888bff655b4616f.jpg', '20', '1');
INSERT INTO `brand` VALUES ('5', '苹果', '苹果公司（Apple Inc. ）是美国的一家高科技公司。由史蒂夫·乔布斯、斯蒂夫·沃兹尼亚克和罗·韦恩(Ron Wayne)等人于1976年4月1日创立，并命名为美国苹果电脑公司（Apple Computer Inc. ），2007年1月9日更名为苹果公司，总部位于加利福尼亚州的库比蒂诺', 'http://otced3uov.bkt.clouddn.com/20170724/71408a7f05e8195dfed94c002fb5ec66490ecde9.jpg', '21', '2');

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '��Ʒid',
  `sn` varchar(255) NOT NULL COMMENT '��Ʒ����',
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `goods_cate_id` int(11) unsigned NOT NULL COMMENT '��Ʒ����id',
  `brand_id` int(11) unsigned NOT NULL COMMENT 'Ʒ��id',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '����۸�',
  `market_price` decimal(10,2) NOT NULL DEFAULT '100.00' COMMENT '�г��۸�',
  `stock` int(11) unsigned NOT NULL COMMENT '���',
  `is_on_sale` smallint(6) NOT NULL DEFAULT '1' COMMENT '1�ϼ�2�¼�',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '1����2ɾ��',
  `sort` int(11) unsigned NOT NULL COMMENT '����',
  `create_time` int(11) unsigned DEFAULT '0' COMMENT '���ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='��Ʒ';

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '20170724000001', '  小米笔记本Air 13.3', '/20170724/1f56ae933201f94b1bc93a2bbcec09a9998fc779.jpg', '10', '1', '4999.00', '5999.00', '20', '1', '1', '12', '1500871520');

-- ----------------------------
-- Table structure for `goods_category`
-- ----------------------------
DROP TABLE IF EXISTS `goods_category`;
CREATE TABLE `goods_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `parent_id` int(11) unsigned NOT NULL COMMENT '上级分类',
  `name` varchar(20) DEFAULT NULL COMMENT '商品分类名称',
  `intro` varchar(200) DEFAULT NULL COMMENT '商品分类介绍',
  `tree` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '树id',
  `lft` int(11) unsigned NOT NULL COMMENT '左边界的值',
  `rgt` int(11) unsigned NOT NULL COMMENT '右边界的值',
  `depth` int(11) unsigned DEFAULT NULL COMMENT '层级',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1正常2隐藏3删除',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Records of goods_category
-- ----------------------------
INSERT INTO `goods_category` VALUES ('1', '0', '天天果园', '只为一份极致的新鲜', '1', '1', '12', '0', '1', '0');
INSERT INTO `goods_category` VALUES ('2', '1', '果园推荐', '深情厚意', '1', '2', '3', '1', '1', '0');
INSERT INTO `goods_category` VALUES ('5', '1', '全球鲜果', '美国、智利、泰国、越南、澳大利亚', '1', '4', '5', '1', '1', '0');
INSERT INTO `goods_category` VALUES ('6', '1', '生鲜美食', '虾蟹贝类禽蛋', '1', '6', '11', '1', '1', '0');
INSERT INTO `goods_category` VALUES ('7', '6', '虾蟹', '澳洲空运', '1', '7', '8', '2', '1', '0');
INSERT INTO `goods_category` VALUES ('8', '6', '坚果', '健身人士最爱', '1', '9', '10', '2', '1', '0');
INSERT INTO `goods_category` VALUES ('9', '0', '电脑', '所有的电脑类型', '9', '1', '6', '0', '1', '1500863773');
INSERT INTO `goods_category` VALUES ('10', '9', '笔记本', '办公笔记本', '9', '2', '3', '1', '1', '1500864059');
INSERT INTO `goods_category` VALUES ('11', '9', '电脑整机', '台式机', '9', '4', '5', '1', '1', '1500864111');

-- ----------------------------
-- Table structure for `goods_day_count`
-- ----------------------------
DROP TABLE IF EXISTS `goods_day_count`;
CREATE TABLE `goods_day_count` (
  `day` varchar(30) NOT NULL DEFAULT '' COMMENT '����',
  `count` int(11) unsigned NOT NULL COMMENT '�ϼ�����',
  PRIMARY KEY (`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒÿ�������';

-- ----------------------------
-- Records of goods_day_count
-- ----------------------------
INSERT INTO `goods_day_count` VALUES ('20170724', '1');

-- ----------------------------
-- Table structure for `goods_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `goods_gallery`;
CREATE TABLE `goods_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ͼƬid',
  `goods_id` int(11) unsigned NOT NULL COMMENT '��Ʒid',
  `img_url` varchar(200) DEFAULT NULL COMMENT 'ͼƬ·��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='��Ʒ���';

-- ----------------------------
-- Records of goods_gallery
-- ----------------------------
INSERT INTO `goods_gallery` VALUES ('1', '1', '/20170725/41b41372b730b1ed52b226963fb6b353822abf7a.jpg');
INSERT INTO `goods_gallery` VALUES ('2', '1', '/20170725/03ae735cff78be8f7d307f817f0888a88f95fd65.jpg');
INSERT INTO `goods_gallery` VALUES ('3', '1', '/20170725/370a1600a27bdfe8e2eb81662500d6891afd26e8.jpg');
INSERT INTO `goods_gallery` VALUES ('4', '1', '/20170725/41b41372b730b1ed52b226963fb6b353822abf7a.jpg');

-- ----------------------------
-- Table structure for `goods_intro`
-- ----------------------------
DROP TABLE IF EXISTS `goods_intro`;
CREATE TABLE `goods_intro` (
  `goods_id` int(11) unsigned NOT NULL COMMENT '��Ʒid',
  `content` text COMMENT '��Ʒ����',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='��Ʒ�����';

-- ----------------------------
-- Records of goods_intro
-- ----------------------------
INSERT INTO `goods_intro` VALUES ('1', '过负荷复活节啊vjhxbajxv');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(225) COLLATE utf8_unicode_ci DEFAULT 'file-code-o',
  `route` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '''''',
  `lavel` smallint(6) unsigned DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '菜单管理', '菜单管理', '0', 'file-code-o', '', '0', '1501468649', '0');
INSERT INTO `menu` VALUES ('2', '列表', '菜单管理/列表', '1', 'file-code-o', 'menu/index', '1', '1501469566', '1501469566');
INSERT INTO `menu` VALUES ('3', '添加', '菜单管理/添加', '1', 'file-code-o', 'menu/create', '1', '1501472435', '1501472435');
INSERT INTO `menu` VALUES ('4', '商品管理', '商品管理', '0', 'file-code-o', '', '0', '1501472967', '1501473734');

-- ----------------------------
-- Table structure for `migration`
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1500381092');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1500381161');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1501207083');
INSERT INTO `migration` VALUES ('m170718_120402_create_table_brand', '1500381171');
INSERT INTO `migration` VALUES ('m170718_121956_create_table_article_category', '1500381177');
INSERT INTO `migration` VALUES ('m170719_043711_create_table_article', '1500444546');
INSERT INTO `migration` VALUES ('m170719_044059_create_table_article_detail', '1500444547');
INSERT INTO `migration` VALUES ('m170719_063125_create_table_article', '1500446211');
INSERT INTO `migration` VALUES ('m170719_063134_create_table_article_detail', '1500447285');
INSERT INTO `migration` VALUES ('m170721_020155_create_table_goods_category', '1500603199');
INSERT INTO `migration` VALUES ('m170722_060452_cerate_table_goods_day_count', '1500708873');
INSERT INTO `migration` VALUES ('m170722_060615_cerate_table_goods', '1500708874');
INSERT INTO `migration` VALUES ('m170722_060628_cerate_table_goods_images', '1500708875');
INSERT INTO `migration` VALUES ('m170722_073141_cerate_table_goods_intro', '1500708876');
INSERT INTO `migration` VALUES ('m170725_040238_create_table_admin', '1500955555');
INSERT INTO `migration` VALUES ('m170729_025340_create_table_menu', '1501297281');
INSERT INTO `migration` VALUES ('m170731_014651_create_table_menu', '1501465675');
INSERT INTO `migration` VALUES ('m170731_021544_create_table_menu', '1501467457');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
