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
        'name'        => 'Colony',
        'title'       => '集群部署工具',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'colony.png',
        'description' => '服务器集群及代码部署工具集',
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
        'Colonysys' => array('','l', 'colony/admin.index/index', 'colony.png', '', 1, 1),
          'Colony'  => array('Colonysys','l', 'colony/admin.index/index', '', '', 1, 1),
            'Hosts' => array('Colony','r', 'colony/admin.index/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.hosts/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.hosts/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.hosts/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.hosts/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.hosts/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.hosts/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Cmodels' => array('Colony','r', 'colony/admin.cmodels/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.cmodels/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.cmodels/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.cmodels/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.cmodels/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.cmodels/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.cmodels/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Phproducts' => array('Colony','r', 'colony/admin.product/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.product/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.product/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.product/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.product/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.product/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.product/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Colonies' => array('Colony','r', 'colony/admin.colonies/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.colonies/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.colonies/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.colonies/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.colonies/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.colonies/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.colonies/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Capis' => array('Colony','r', 'colony/admin.capis/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.capis/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.capis/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.capis/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.capis/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.capis/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.capis/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Resource' => array('Colony','r', 'colony/admin.resource/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.resource/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.resource/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.resource/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.resource/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.resource/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.resource/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Process' => array('Colony','r', 'colony/admin.process/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.process/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.process/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.process/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.process/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.process/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.process/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Security' => array('Colony','r', 'colony/admin.security/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.security/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.security/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.security/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.security/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.security/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.security/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Hosttask' => array('Colony','r', 'colony/admin.hosttask/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'colony/admin.hosttask/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'colony/admin.hosttask/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'colony/admin.hosttask/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'colony/admin.hosttask/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'colony/admin.hosttask/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'colony/admin.hosttask/edit', '', 730, 530, 1, '', ''),
                )
            ),
    ),
);