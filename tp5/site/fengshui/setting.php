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
        'name'        => 'Fengshui',
        'title'       => '风水系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'fengshui.png',
        'description' => '风水服务',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'depends' => array(
            'Admin'   => '1.0.0',
        ),
        'required' => array(    //必须为其中之一

        ),
        'upgrade'     => '/cmfup/ver.php',     //升级地址
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
        'Fenshuisys' => array('','l', 'fengshui/admin.index/index', 'fengshui.png', '', 1, 1),
          'Fenshui'  => array('Fenshuisys','l', 'fengshui/admin.index/index', '', '', 1, 1),
            'FenHosts' => array('Fenshui','r', 'fengshui/admin.index/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.hosts/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.hosts/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.hosts/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.hosts/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.hosts/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.hosts/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Cemetery' => array('Fenshui','r', 'fengshui/admin.cemetery/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.cemetery/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.cemetery/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.cemetery/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.cemetery/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.cemetery/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.cemetery/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Fenshuipro' => array('Fenshui','r', 'fengshui/admin.product/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.product/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.product/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.product/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.product/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.product/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.product/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Fenfactory' => array('Fenshui','r', 'fengshui/admin.factory/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.factory/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.factory/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.factory/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.factory/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.factory/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.factory/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Fenoffice' => array('Fenshui','r', 'fengshui/admin.office/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.office/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.office/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.office/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.office/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.office/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.office/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Resource' => array('Fenshui','r', 'fengshui/admin.resource/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.resource/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.resource/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.resource/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.resource/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.resource/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.resource/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Process' => array('Fenshui','r', 'fengshui/admin.process/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.process/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.process/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.process/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.process/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.process/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.process/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Security' => array('Fenshui','r', 'fengshui/admin.security/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.security/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.security/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.security/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.security/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.security/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.security/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Hosttask' => array('Fenshui','r', 'fengshui/admin.hosttask/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'fengshui/admin.hosttask/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'fengshui/admin.hosttask/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'fengshui/admin.hosttask/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'fengshui/admin.hosttask/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'fengshui/admin.hosttask/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'fengshui/admin.hosttask/edit', '', 730, 530, 1, '', ''),
                )
            ),
    ),
);