<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | b2b2c.config.php  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

return array(
    // 模块信息
    'info' => array(
        'name'        => 'Ai',
        'title'       => 'PHP 人工智能',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'ai.png',
        'description' => 'PHP人工智能, 已包含机器学习库。交叉验证，神经网络，预处理，特征提取等',
        'author'   	  => 'Runtuer',
        'website'     => 'https://www.oschina.net/p/php-ml',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/module/ai/1.0.3.php',     //升级地址
        'depends' => array(
            'Admin'     => '1.0.0',
            'Cms'       => '1.0.0',
        ),
        //依赖扩展
        'extend' => array(

        ),
    ),

    // 用户中心导航
    'user_nav' => array(
        
    ),

    // 模块配置
    'config' => array(
        
    ),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
        位置：l:左路，r：右，h：隐藏
        是否权限控制 ：1，是，0：否
         **/
        'Ai'    => array('','l', 'ai/admin.index/index', 'ai.png', '', 1, 1),
    )
);