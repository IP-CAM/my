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
// | setting.php  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

return array(
    // 模块信息
    'info' => array(
        'name'        => 'Crm',
        'title'       => 'Crm 系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'crm.png',
        'description' => '润云 CRM 系统，客户管理系统',
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
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
        位置：l:左路，r：右，h：隐藏
        是否权限控制 ：1，是，0：否
         **/
        'Crm'    => array('','l', 'crm/admin.index/index', 'crm.png','', 1, 1),
    )
);