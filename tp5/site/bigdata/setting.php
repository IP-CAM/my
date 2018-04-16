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
        'name'        => 'Bigdata',
        'title'       => '大数据中心',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'bigdata.png',
        'description' => '大数据中心,针对商品，营销进行的画像，可视化图形分析',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'   => '1.0.0',
            'Cms'    => '1.0.0',
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
        'Bigdata'    => array('','l', 'bigdata/admin.index/index', 'bigdata.png', '', 1, 1),
        'Personsys'  => array('Bigdata', 'l', 'bigdata/admin.index/index', '', '', 0, 1),
            'Person' => array('Personsys', 'r', 'bigdata/admin.index/index', 'uu-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'bigdata/admin.shopcat/add', '', 640, 300, 1, '', ''),
                    'Delete' => array(1, 'bigdata/admin.shopcat/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'bigdata/admin.shopcat/enable', '', '', '', '', '', 'ids'),
                    'Disable' => array(4, 'bigdata/admin.shopcat/disable', '', '', '', '', '', 'ids'),
                    'Edit' => array(-1, 'bigdata/admin.shopcat/edit', '', 640, 500, 1, '', ''),
                )
            ),
            'Hscode' => array('Personsys', 'r', 'bigdata/admin.hscode/index', 'uu-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'bigdata/admin.hscode/add', '', 640, 300, 1, '', ''),
                    'Delete' => array(1, 'bigdata/admin.hscode/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'bigdata/admin.hscode/enable', '', '', '', '', '', 'ids'),
                    'Disable' => array(4, 'bigdata/admin.hscode/disable', '', '', '', '', '', 'ids'),
                    'Edit' => array(-1, 'bigdata/admin.hscode/edit', '', 640, 500, 1, '', ''),
                )
            ),
        
        'Cryptography'=> array('Bigdata', 'l', 'bigdata/admin.encry/index', '', '', 0, 1),
            'Encrylist'  => array('Cryptography', 'r', 'bigdata/admin.encry/index', 'uu-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'bigdata/admin.encry/add', '', 640, 300, 1, '', ''),
                    'Delete' => array(1, 'bigdata/admin.encry/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'bigdata/admin.encry/enable', '', '', '', '', '', 'ids'),
                    'Disable' => array(4, 'bigdata/admin.encry/disable', '', '', '', '', '', 'ids'),
                    'Edit' => array(-1, 'bigdata/admin.encry/edit', '', 640, 500, 1, '', ''),
                )
            ),
    )
);