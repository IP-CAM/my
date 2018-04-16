<?php
// +----------------------------------------------------------------------
// | RuntuerCMF Copyright (c)  http://www.tuntuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 模块说明 Version 1.0
// +----------------------------------------------------------------------

return array(
    // 模块信息
    'info' => array(
        'name'        => 'Stools',
        'title'       => '电商工具',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'stools.png',

        //默认指向当前模块view/admin/static/image/app.png
        'description' => '电商核心工具集',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'depends' => array(
            'Admin'   => '1.0.0',
        ),
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        //依赖扩展
        'extend' => array(

        ),
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
        'Stools'    => array('Ordersys','l', 'stools/admin.index/index', '','', 1, 1),
           'Payform'=> array('Stools','r', 'stools/admin.index/index', 'curr-icon','', 0, 1,
            array(
                'Whole'  => array(5, 'stools/admin.index/index', 'add-new', '', '', '', '', ''),
                'Export' => array(1, 'stools/admin.index/export','',440, 280, 1,'','ids'),
                'View'   => array(-1, 'stools/admin.index/view', '', 440, 280, '', '', ''),
            ),
          ),
    
        'Refundform'=> array('Stools','r', 'stools/admin.refund/index', 'back-icon','', 1, 1,
            array(
                'Whole'  => array(5, 'stools/admin.refund/index', 'add-new', '', '', '', '', ''),
                'Export' => array(1, 'stools/admin.refund/export','',440, 280, 1,'','ids'),
                'View'   => array(-1, 'stools/admin.refund/view', '', 440, 280, '', '', ''),
            ),
        ),
    ),
);