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
        'name'        => 'Navigation',
        'title'       => '导航系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'navigation.png',    //默认指向当前模块view/admin/static/image/navigation.png
        'description' => '全球网址导航系统，多语言，多类别，服务专业人员的导致系统',
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
    'user_nav' => array(),

    //模型配置
    'config' => array(
        'status' => array('是否开启', 'radio', 'options' => array('1' => '开启', '0' => '关闭',), 1),
        'reg_toggle' => array('注册开关', 'radio', 'options' => array('1'=> '开启', '0'=> '关闭'), 1),
        'allow_reg_type' => array('允许注册类型', 'checkbox', 'options' => array('username' => '用户名注册','email'=> '邮箱注册','mobile'=> '手机注册'), '0'),
        'deny_username' => array('禁止注册的用户名', 'textarea', ''),
        'user_protocol' => array('用户协议', 'kindeditor', ''),
        'behavior' => array('行为扩展', 'checkbox','options'=> array('User' => 'User'), '0'),
    ),

    // 后台菜单及权限节点配置
    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
        位置：l:左路，r：右，h：隐藏
        是否权限控制 ：1，是，0：否
         **/
        //'General'   => array('','l', 'Admin/index', 'fa fa-home', 1, 1),
        'Navigation'    => array('Contents','l', 'navigation/admin.index/index', '', '', 1, 1),
          'Navconfig'   => array('Navigation','r', 'navigation/admin.index/config', 'item.png', '', 1, 1),
          'Websiteurl'  => array('Navigation','r', 'navigation/admin.index/index', '', '', 1, 1),
            'Addnew'    => array('Websiteurl','b', 'navigation/admin.index/add', '', '', 1, 1),
            'Delete'    => array('Websiteurl','b', 'navigation/admin.index/delete', '', '', 1, 1),
            'Sort'      => array('Websiteurl','b', 'navigation/admin.index/sort', '', '', 1, 1),
            'Enable'    => array('Websiteurl','b', 'navigation/admin.index/enable', '', '', 1, 1),
            'Disable'   => array('Websiteurl','b', 'navigation/admin.index/disable', '', '', 1, 1),
            'Edit'      => array('Websiteurl','h', 'navigation/admin.index/edit', '', '', 1, 1),
    )
);