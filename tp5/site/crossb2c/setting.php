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
        'name'        => 'Crossb2c',
        'title'       => '跨境B2C',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'crossb2c.png',
        'description' => '跨境电商B2C平台，自营版，安装此模块后需要安装相应的支付',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'   => '1.0.0',
            'Cms'     => '1.0.0',
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
        'Crossb2c'    => array('','l', 'crossb2c/admin.index/index', 'crossb2c.png', '', 1, 1),
          'Goods'     => array('Crossb2c','r', 'crossb2c/admin.indexy/index', 'cat-icon', '', 1, 1,
            array(
                'Addnew' => array(0, 'crossb2c/admin.indexy/add', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'crossb2c/admin.indexy/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossb2c/admin.indexy/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossb2c/admin.indexy/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossb2c/admin.indexy/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossb2c/admin.indexy/edit', '', 630, 455, 1, '', ''),
                'Whole'   => array(5, 'crossb2c/admin.indexy/index', 'add-new', '', '', '', '', ''),
            )
        ),
    )
);