<?php 
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: yang <502204678@qq.com>
# +----------------------------------------------------------------------
# | By ShopCmf Auto Create File Version 2017/08/31 11:01:44
# +----------------------------------------------------------------------

return array (
  'columns' => 
  array (
    'id' => 
    array (
      'type' => 'int(11) unsigned zerofill',
      'key' => 'PRI',
      'extra' => 'auto_increment',
      'comment' => '商品id,自增主键',
    ),
    'name' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '商品名称',
    ),
    'en_name' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '商品英文名称',
    ),
    'sub_title' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '副标题',
    ),
    'meta_title' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '页面标题',
    ),
    'meta_description' => 
    array (
      'type' => 'varchar(255)',
      'comment' => 'seo 描述',
    ),
    'video' => 
    array (
      'type' => 'varchar(500)',
      'comment' => '视频html地址',
    ),
    'tags' => 
    array (
      'type' => 'varchar(500)',
      'comment' => '商品标签',
    ),
    'pc_description' => 
    array (
      'type' => 'text',
      'comment' => 'pc端描述',
    ),
    'wap_description' => 
    array (
      'type' => 'text',
      'comment' => '手机端描述',
    ),
    'cat_id' => 
    array (
      'type' => 'smallint(6) unsigned',
      'comment' => '末级分类id，方便计算分类佣金',
    ),
    'brand_id' => 
    array (
      'type' => 'smallint(6) unsigned',
      'comment' => '品牌id',
    ),
    'thumb' => 
    array (
      'type' => 'varchar(255)',
      'comment' => '商品主图',
    ),
    'list_img' => 
    array (
      'type' => 'text',
      'comment' => '商品图册',
    ),
    'package_unit' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '包装单位',
    ),
    'package_num' => 
    array (
      'type' => 'smallint(6) unsigned',
      'default' => '1',
      'comment' => '包装件数',
    ),
    'package_charge' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '分拣打包费',
    ),
    'domestic_freight' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '国内运费',
    ),
    'weight' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '毛重',
    ),
    'clear_weight' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '净重',
    ),
    'weight_class_id' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '商品重量单位',
    ),
    'viewed' => 
    array (
      'type' => 'int(11)',
      'comment' => '商品浏览次数',
    ),
    'country_id' => 
    array (
      'type' => 'int(11) unsigned',
      'comment' => '所属国家id',
    ),
    'tax_rate' => 
    array (
      'type' => 'tinyint(1)',
      'comment' => '税率',
    ),
    'market_price' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '商品市场价格',
    ),
    'sale_price' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '商品销售价格',
    ),
    'cost_price' => 
    array (
      'type' => 'decimal(10,2) unsigned',
      'default' => '0.00',
      'comment' => '商品成本价格',
    ),
    'points_price' => 
    array (
      'type' => 'int(11)',
      'comment' => '商品的积分价，0表示不可用积分购买',
    ),
    'points' => 
    array (
      'type' => 'int(11) unsigned',
      'comment' => '购买该商品时每笔成功交易赠送的积分数量',
    ),
    'prom_id' => 
    array (
      'type' => 'int(11)',
      'comment' => '促销类型ID',
    ),
    'prom_type' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '促销类型标识',
    ),
    'kickback' => 
    array (
      'type' => 'tinyint(1) unsigned',
      'comment' => '佣金，0-100',
    ),
    'pv' => 
    array (
      'type' => 'decimal(10,2)',
      'default' => '0.00',
      'comment' => '利润',
    ),
    'good_barcode' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '商品条形码，唯一',
    ),
    'good_code' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '商品编码，唯一',
    ),
    'hs_code' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '海关编码',
    ),
    'hs_model' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '海关型号',
    ),
    'hs_quarantine_model' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '检疫型号',
    ),
    'hs_unit' => 
    array (
      'type' => 'varchar(64)',
      'comment' => '海关计量单位',
    ),
    'type' => 
    array (
      'type' => 'varchar(64)',
      'comment' => 'normal：普通，bonded：保税，pay_taxes：完税，direct_mail：直邮',
    ),
    'status' => 
    array (
      'type' => 'varchar(64)',
      'default' => 'enabled',
      'comment' => 'recycle : 回收
disabled : 下架
enabled : 上架
pending_review : 待审
pending_modify : 待修',
    ),
    'pc_status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => 'pc 端状态 0 停用 1 启用',
    ),
    'wap_status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => 'wap 端状态 0 停用 1 启用',
    ),
    'api_status' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => 'api 端状态 0 停用 1 启用',
    ),
    'quantity' => 
    array (
      'type' => 'int(11)',
      'comment' => '商品库存',
    ),
    'offline_quantity' => 
    array (
      'type' => 'int(11)',
      'comment' => '线下库存',
    ),
    'minimum' => 
    array (
      'type' => 'int(11) unsigned',
      'default' => '1',
      'comment' => '商品最小订购量',
    ),
    'maximum' => 
    array (
      'type' => 'int(11) unsigned',
      'comment' => '商品的最大购买量',
    ),
    'subtract' => 
    array (
      'type' => 'tinyint(1)',
      'default' => '1',
      'comment' => '减库存方式
2：下单减库存
1：付款减库存
0：不减库存',
    ),
    'seller_id' => 
    array (
      'type' => 'int(11)',
      'comment' => '商家id',
    ),
    'sales_volume' => 
    array (
      'type' => 'int(11) unsigned',
      'comment' => '商品销量',
    ),
    'sort' => 
    array (
      'type' => 'int(11)',
      'comment' => '排序',
    ),
    'langid' => 
    array (
      'type' => 'varchar(20)',
      'comment' => '语言id',
    ),
    'create_time' => 
    array (
      'type' => 'int(11) unsigned',
    ),
    'update_time' => 
    array (
      'type' => 'int(11) unsigned',
    ),
  ),
  'primary' => 
  array (
    0 => 'id',
  ),
  'comment' => '商品列表',
);
