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
        'name'        => 'Surrogacy',
        'title'       => '全球代孕平台',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'surrogacy.png',
        'description' => '全球代孕平台,提供孕育机会及功能，选择孕育平台及机构',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'depends' => array(
            'Admin'   => '1.0.0',
            'Union'   => '1.0.0',
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
        'Surrogacisys' => array('','l', 'surrogacy/admin.index/index', 'surrogacy.png', '', 1, 1),
          'Surrogacy'  => array('Surrogacisys','l', 'surrogacy/admin.index/index', '', '', 1, 1),
            'Category' => array('Surrogacy','r','surrogacy/admin.index/index','cat-icon','',0,1,
                array(
                  'Addnew' => array(0, 'surrogacy/admin.index/add', '', 730, 530, 1, '', ''),
                  'Delete' => array(1, 'surrogacy/admin.index/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'surrogacy/admin.index/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'surrogacy/admin.index/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'surrogacy/admin.index/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'surrogacy/admin.index/edit', '', 730, 530, 1, '', ''),
                )
            ),
          'Surrogacy'  => array('Surrogacisys','l', 'surrogacy/admin.bank/index', '', '', 1, 1),
            'Surrogacybank'=> array('Surrogacy','r','surrogacy/admin.bank/index','curr-icon','',0,1,
              array(
                  'Addnew' => array(0, 'surrogacy/admin.bank/add', '', 730, 530, 1, '', ''),
                  'Delete' => array(1, 'surrogacy/admin.bank/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'surrogacy/admin.bank/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'surrogacy/admin.bank/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'surrogacy/admin.bank/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'surrogacy/admin.bank/edit', '', 730, 530, 1, '', ''),
              )
          ),
    )
);