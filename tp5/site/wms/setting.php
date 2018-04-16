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
        'name'        => 'Wms',
        'title'       => '仓储 & 物流平台',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'wms.png',
        'description' => '仓储 & 物流平台，金融仓储，物流转运',
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
    
        'Wms'       => array('','l', 'wms/admin.index/index', 'wms.png', '', 1, 1),
          'Waresys'  => array('Wms','l', 'wms/admin.index/index', '', '', 1, 1),
            'Warehouse'=> array('Waresys','r', 'wms/admin.index/index', 'list-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'wms/admin.index/add', '', 740, 455, 1, '', ''),
                    'Delete' => array(1, 'wms/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'wms/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'wms/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'wms/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1,'wms/admin.index/edit', '', 740, 455, 1, '', ''),
                )
            ),
        
    )
);