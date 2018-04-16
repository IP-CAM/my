<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>  Version 1.0  2016/3/12
// +----------------------------------------------------------------------

$crossbbcg_setting = APP_PATH . 'crossbbcg/extra/index.php';
$default           = is_file($crossbbcg_setting) ? include $crossbbcg_setting : null;
$hs_unit           = is_file(APP_PATH . 'crossbbcg/extra/hs_unit.php') ? include APP_PATH . 'crossbbcg/extra/hs_unit.php' : null;


return array(
    // 检测模块语言包开关
    'check_lang_dir'             => false,
    
    // 配置路由的参数为get
    'url_common_param'           => true,
    
    // 空控制器
    'empty_controller'           => 'Error',
    
    // 跨境模块下异常页面处理，正式环境中启用
    // 'exception_tmpl'         => '500.html',
    'http_exception_template'    => [
        404 => '404.html',
        400 => '404.html',
        500 => '500.html',
    ],
    
    
    // 配置默认参数
    'default_stockwarming'       => $default['stockwarming'],
    'default_list_rows'          => $default['list_rows'],
    'default_tax_class_id'       => $default['default_tax_class_id'],
    'default_tax_class'          => isset($default['tax_class']) ? $default['tax_class'] : [],
    'default_weight_class'       => ['kg', 'g'],
    'default_weight_class_id'    => isset($default['default_weight_class']) ? explode(',', $default['default_weight_class'])[0] : 'kg',
    'default_package_unit'       => isset($hs_unit) ? $hs_unit : [],
    'default_good_status_id'     => $default['good_status_id'],
    'default_good_status'        => array(
        'enabled'        => 'enabled',
        'disabled'       => 'disabled',
        'pending_review' => 'pending_review',
        'pending_modify' => 'pending_modify',
        'pending'        => 'pending',
    ),
    'default_all_good_status'    => array(
        'enabled'        => 'enabled',
        'disabled'       => 'disabled',
        'pending_review' => 'pending_review',
        'pending_modify' => 'pending_modify',
        'recycle'        => 'recycle',
        'pending'        => 'pending',
    ),
    'default_free_money'         => $default['default_free_money'],
    'default_freight_shipping'   => $default['default_shipping_freight'],
    'default_good_types'         => array(
        'normal'      => 'normal',
        'bonded'      => 'bonded',
        'pay_taxes'   => 'pay_taxes',
        'direct_mail' => 'direct_mail',
    ),
    'default_good_service'       => (isset($default['goods_service']) && trim($default['goods_service']) != '') ? explode(',', $default['goods_service']) : [],
    
    
    // 前端页面的默认选项
    // 默认货币
    'catalog_currency_code'      => 'CNY',
    // 默认国家
    'catalog_country_name'       => '中国',
    'catalog_country_id'         => '44',
    'catalog_country_code'       => 'CN',
    // 默认搜索页面的显示数
    'catalog_paginate_list_rows' => '16',
    'catalog_tax_limit'          => '2000',
    // 默认搜索词
    'catalog_search'             => '奶粉',

);