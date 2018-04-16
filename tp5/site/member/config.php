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

$express = is_file(APP_PATH . 'bcwareexp/extra/express.php')? include APP_PATH . 'bcwareexp/extra/express.php' : null;

return array(
    //检测模块语言包开关
    'check_lang_dir'         => false,
	
	// 配置路由的参数为get
    'url_common_param'      => true,
    
    // TODO 后台设置取消订单的原因
    'cancel_reason' => array(
        '我不想买了',
        '信息填写错误，重新下订单',
        '卖家缺货',
        '付款遇到问题（如余额不足，不知道怎么付款等）',
        '买错了',
        '其他原因'
    ),
    
    // TODO 后台设置退货问题
    'return_reason' => array(
        '尺寸拍错/不喜欢/效果不好',
        '质量问题',
        '材质与商品描述不符',
        '尺寸/容量与商品描述不符',
        '做工瑕疵',
        '颜色/款式/图案与描述不符',
        '配件损坏',
        '卖家发错货',
        '假冒品牌',
        '主商品破损',
        '其他'
    ),
    
    'catalog_express' => $express,
    
    //界面方案
    //'skin'                  => ['pc' => 'default2', 'mobile' => 'default2'],
    
    
);