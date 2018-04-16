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
        'name'        => 'Children',
        'title'       => '教育商城',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'children.png',
        'description' => '师资,选校,招生,报名,活动,讲座',
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
        
    ),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
        位置：l:左路，r：右，h：隐藏
        是否权限控制 ：1，是，0：否
         **/
        'Children'   => array('','l', 'children/admin.index/index', 'children.png', '', 1, 1),
          'Schooles'  => array('Children','l', 'children/admin.index/index', '', '', 1, 1),
            'Schooletype' => array('Schoole','r', 'children/admin.index/index', '', '', 1, 1),
            'Classes'  => array('Schoole','l', 'children/admin.classes/index', '', '', 1, 1),
            'Schoole'  => array('Schoole','r', 'children/admin.schoole/index', '', '', 1, 1),
          'Teacher'  => array('Children','l', 'children/admin.teacher/index', '', '', 1, 1),
            'Teachertype'=> array('Teacher','r','children/admin.teachertype/index','cat-icon','',1,1),
            'Teacherlist'=> array('Teacher','r', 'children/admin.teacher/index', 'list-icon', '',1,1),
          'Party'    => array('Children','r', 'children/admin.party/index', '', '', 1, 1),
            'Partytype'=> array('Party','r','children/admin.partytype/index','cat-icon','',1,1),
            'Partylist'=> array('Party','r', 'children/admin.party/index', 'list-icon', '',1,1),
          'Resume'   => array('Children','l', 'children/admin.resume/index', '', '', 1, 1),
            'Resumelist'  => array('Resume','r', 'children/admin.resume/index', '', '', 1, 1),
            'Resumereport'=> array('Resume','r', 'children/admin.resume/report', '', '', 1, 1),
    )

);