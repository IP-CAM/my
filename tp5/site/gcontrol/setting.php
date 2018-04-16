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
        'name'        => 'Gcontrol',
        'title'       => '群控系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'gcontrol.png',    //默认指向当前模块view/admin/static/image/Card.png
        'description' => '控制多台手机上的社交软件',
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
        'Gcontrolsys'   => array('','l', 'gcontrol/admin.index/index', 'gcontrol.png', '', 1, 1),
          'Gcontrolsys' => array('Gcontrolsys','l', 'gcontrol/admin.index/index', '','', 1, 1),
            'Controllist' => array('Gcontrolsys','r', 'gcontrol/admin.index/index', '','', 1, 1),
            'Controlconf' => array('Gcontrolsys','r','gcontrol/admin.config/index','list-icon','',1, 1,
                array(
                    'Addnew' => array(0, 'gcontrol/admin.config/add', '', 600, 600, 1, '', ''),
                    'Delete' => array(1, 'gcontrol/admin.config/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'gcontrol/admin.config/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'gcontrol/admin.config/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'gcontrol/admin.config/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'gcontrol/admin.config/edit', '', 600, 600, 1, '', ''),
                )
            ),
    )
);