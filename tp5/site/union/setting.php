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
        'name'        => 'Union',
        'title'       => '无线联盟',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'union.png',
        'description' => '赚钱联盟，点击，广告，导航，存储器等利润计算中心',
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
        'Unionsys'    => array('','l', 'union/admin.index/index', 'union.png','', 1, 1),
          'Unionads'  => array('Unionsys','l', 'union/admin.index/index', '', '',2, 1),
            'Unadslist'=> array('Unionads','r', 'union/admin.index/index', 'list-icon', '',0, 1,
                array(
                    'Addnew' => array(0, 'union/admin.index/add', '', 870, 490, 1, '', ''),
                    'Delete' => array(1, 'union/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'union/admin.index/enable', '', '', '', '', '', ''),
                    'Disable'=> array(4, 'union/admin.index/disable', '', '', '', '', '', ''),
                    'Whole'  => array(5, 'union/admin.index/index', 'add-new', '', '', '', '', ''),
                    'Edit'   => array(-1, 'union/admin.index/edit', '', '', '', '', '', ''),
                )
            ),
            'Unadsuse'=> array('Unionads','r', 'union/admin.account/index', 'list-icon', '',1, 1,
                array(
                    'Addnew' => array(0, 'union/admin.account/add', '', 570, 500, 1, '', ''),
                    'Delete' => array(1, 'union/admin.account/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'union/admin.account/enable', '', '', '', '', '', ''),
                    'Disable'=> array(4, 'union/admin.account/disable', '', '', '', '', '', ''),
                    'Edit'   => array(-1, 'union/admin.account/edit', '', '', '', '', '', ''),
                )
            ),
            'Unadsset'=> array('Unionads','r', 'union/admin.config/index', 'conf-icon', '',2, 1,
                array(
                    'Save'   => array(-1, 'union/admin.config/save', '', '', '', '', '', ''),
                )
            ),
        
    ),
);