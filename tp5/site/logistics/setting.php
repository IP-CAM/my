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
        'name'        => 'Logistics',
        'title'       => '物流集运中心',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'logistics.png',    //默认指向当前模块view/admin/static/image/erp.png
        'description' => '物流集运，跨境物流运营平台集中处理中心，智能物流骨干网处理中心，减少流动，以提升效率',
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
    'user_index' => array(
        
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
        'Logistics'  => array('','l', 'logistics/admin.index/index', 'logistics.png', '', 1, 1),
          'Globalogilist'=> array('Logistics','l', 'logistics/admin.index/index', '', '', 1, 1),
            'Globalogi'=> array('Globalogi','r', 'logistics/admin.index/index', 'list-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'logistics/admin.index/add', '', 730, 650, 1, '', ''),
                    'Delete' => array(1, 'logistics/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'logistics/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'logistics/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'logistics/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1,'logistics/admin.index/edit', '', 730, 650, 1, '', ''),
                )    
            ),
            'Loptimize' => array('Globalogi','r','logistics/admin.optimize/index','cat-icon','', 2, 1,
                array(
                    'Addnew' => array(0, 'logistics/admin.index/add', '', 740, 455, 1, '', ''),
                    'Delete' => array(1, 'logistics/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'logistics/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'logistics/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'logistics/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1,'logistics/admin.index/edit', '', 740, 455, 1, '', ''),
                )
            ),
    )
);