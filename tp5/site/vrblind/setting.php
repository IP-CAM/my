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
        'name'        => 'Vrblind',
        'title'       => 'VR 相亲平台（未来）',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'vrblind.png',
        'description' => 'VR 相亲平台，实时快速寻找灰姑娘及王子，真人VR环境投射，心情虚拟场景，真情等待',
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
        'Vrblindsys'=> array('','l', 'vrblind/admin.index/index', 'vrblind.png', '', 1, 1),
          'Vrblind' => array('Vrblindsys','l', 'vrblind/admin.index/index', '', '', 1, 1),
            'Hosts' => array('Vrblind','r', 'vrblind/admin.index/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.hosts/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.hosts/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.hosts/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.hosts/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.hosts/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.hosts/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Cmodels' => array('Vrblind','r', 'vrblind/admin.cmodels/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.cmodels/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.cmodels/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.cmodels/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.cmodels/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.cmodels/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.cmodels/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'Vrblindpro' => array('Vrblind','r', 'vrblind/admin.product/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.product/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.product/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.product/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.product/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.product/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.product/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'vColonies' => array('Vrblind','r', 'vrblind/admin.colonies/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.colonies/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.colonies/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.colonies/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.colonies/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.colonies/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.colonies/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'vCapis' => array('Vrblind','r', 'vrblind/admin.capis/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.capis/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.capis/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.capis/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.capis/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.capis/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.capis/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'vResource' => array('Vrblind','r', 'vrblind/admin.resource/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.resource/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.resource/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.resource/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.resource/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.resource/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.resource/edit', '', 730, 530, 1, '', ''),
                )
            ),
            'vProcess' => array('Vrblind','r', 'vrblind/admin.process/index', 'cat-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'vrblind/admin.process/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'vrblind/admin.process/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'vrblind/admin.process/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'vrblind/admin.process/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'vrblind/admin.process/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'vrblind/admin.process/edit', '', 730, 530, 1, '', ''),
                )
            ),
    ),
);