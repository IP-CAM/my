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
        'name'        => 'Wechat',
        'title'       => '微信管理',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'wechat.png',    //默认指向当前模块view/admin/static/image/wechat.png
        'description' => '微信管理平台',
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
        'Wechatsys'       => array('','l', 'wechat/admin.index/index', 'wechat.png','', 1, 1),
            'Wechatbase'  => array('Wechatsys','l', 'wechat/admin.index/index', '','', 0, 1),
               'Publicnum'=> array('Wechatbase','r','wechat/admin.index/index','list-icon','',0, 1,
                   array(
                       'Addnew' => array(0, 'wechat/admin.index/add', '', 820, 600, 1, '', ''),
                       'Delete' => array(1, 'wechat/admin.index/delete', '', '', '', '', '', 'ids'),
                       'Enable' => array(3, 'wechat/admin.index/enable', '', '', '', '', '', 'ids'),
                       'Disable'=> array(4, 'wechat/admin.index/disable', '', '', '', '', '', 'ids'),
                       'Sort'   => array(2,'wechat/admin.index/sort','','','','','','sorts'),
                       'Edit'   => array(-1, 'wechat/admin.index/edit', '', 820, 600, 1, '', ''),
                   )
             ),
            'Wechatshop'=> array('Wechatbase','r','wechat/admin.shopconf/index','conf-icon','',1, 1,
                array(
                    'Addnew' => array(0, 'wechat/admin.shopconf/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'wechat/admin.shopconf/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'wechat/admin.shopconf/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'wechat/admin.shopconf/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'wechat/admin.shopconf/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'wechat/admin.shopconf/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Interactive' => array('Wechatsys','l', 'wechat/admin.interactive/index', '','', 1, 1),
    ),
);