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
        'name'        => 'Index',
        'title'       => '前端模块',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'index.png',    //默认指向当前模块view/admin/static/image/wechat.png
        'description' => '前端模块，用来显示PC, Wap, App等前端信息',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
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
    
    'admin_menu' => array(
        'Officialweb'=> array('','l', 'index/admin.index/index', 'index.png', '', 1, 1),
         'Indexsys'  => array('Officialweb','l', 'index/admin.index/index', '', '', 0, 1),
            'Indexconf'=> array('Indexsys','r', 'index/admin.config/index', 'conf-icon', '', 0, 1,
                array(
                    'Save'   => array(-1, 'index/admin.config/edit', '', '', '', '', '', ''),
                )
            ),
            'Indexs' => array('Indexsys','r', 'index/admin.index/index', 'hotel-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'index/admin.index/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'index/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'index/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'index/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'index/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'index/admin.index/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Indexnav'=> array('Indexsys','r', 'index/admin.navs/index', 'earth-icon', '', 2, 1,
                array(
                    'Addnew' => array(0, 'index/admin.navs/add', '', 780, 500, 1, '', ''),
                    'Delete' => array(1, 'index/admin.navs/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'index/admin.navs/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'index/admin.navs/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'index/admin.navs/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'index/admin.navs/edit', '', 780, 500, 1, '', ''),
                )
            ),
            'Indexart'=> array('Indexsys','r', 'index/admin.article/index', 'list-icon', '', 3, 1,
                array(
                    'Addnew' => array(0, 'index/admin.article/add', '', 1024, 680, 1, '', ''),
                    'Delete' => array(1, 'index/admin.article/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'index/admin.article/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'index/admin.article/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'index/admin.article/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'index/admin.article/edit', '', 1024, 680, 1, '', ''),
                )
            ),
    ),

);