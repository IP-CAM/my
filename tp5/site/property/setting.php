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
        'name'        => 'Property',
        'title'       => '物业管理系统（PMC）',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'property.png',
        'description' => '物业管理系统，润土公司自有产品：包含业主平台，供应商平台，物业公司，对外租赁，商铺管理等功能，支持APP,PC,WAP,微信等各种设备；',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'   => '1.0.0',
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
        'Propertyc'   => array('','l', 'property/admin.index/index', 'property.png', '', 1, 1),
          'Proconf'   => array('Propertyc','l', 'property/admin.index/index', '', '', 1, 1),
            'Company' => array('Proconf','r', 'property/admin.index/index', '', '', 1, 1),
          'Padlistsys'=> array('Propertyc','l', 'property/admin.adsense/index', '', '', 1, 1),
            'Adslist' => array('Padlistsys','r', 'property/admin.adsense/index', '', '', 1, 1),
        'Ownersys'    => array('','l', 'property/admin.owner/index', 'property.png', '', 1, 1),
          'Owner'     => array('Ownersys','l', 'property/admin.owner/index', '', '', 1, 1),
        'Butlersys'   => array('','l', 'property/admin.owner/index', 'property.png', '', 1, 1),
            'Butler'  => array('Butlersys','l', 'property/admin.owner/index', '', '', 1, 1),
        'Suppliers'   => array('','l', 'property/admin.suppliers/index', 'property.png', '', 1, 1),
        'Shopman'     => array('','l', 'property/admin.shopman/index', 'property.png', '', 1, 1),
    )
);