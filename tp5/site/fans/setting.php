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
        'name'        => 'Fans',
        'title'       => '社交平台',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'fans.png', 
        'description' => '提供与各大社交平台对接的接口平台',
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
        'Fanssys' => array('','l', 'fans/admin.index/index', 'fans.png', '', 1, 1),
        'Fans'    => array('Fanssys','l', 'fans/admin.index/index', '','', 1, 1),
        'Fanconf' => array('Fans','r', 'fans/admin.config/index', 'conf-icon','', 0, 1,
            array(
                'Save'   => array(-1, 'fans/admin.config/save', '', '', '', '', '', ''),
            )
        ),
        'Circle'    => array('Fans','r', 'fans/admin.index/index', 'list-icon','', 1, 1,
            array(
                'Addnew' => array(0, 'fans/admin.index/add', '', 650, 530, 1, '', ''),
                'Delete' => array(1, 'fans/admin.index/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'fans/admin.index/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'fans/admin.index/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.index/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'fans/admin.index/edit', '', 730, 530, 1, '', ''),
            )
        ),
        'Topic'     => array('Fans','r', 'fans/admin.topic/index', 'conf-icon','', 2, 1,
            array(
                'Addnew' => array(0, 'fans/admin.topic/add', '', 730, 585, 1, '', ''),
                'Delete' => array(1, 'fans/admin.topic/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'fans/admin.topic/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'fans/admin.topic/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.topic/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'fans/admin.topic/edit', '', 730, 530, 1, '', ''),
            )
        ),
        'Fancsmember'     => array('Fans','r', 'fans/admin.member/index', 'uu-icon','', 4, 1,
            array(
                'Addnew' => array(0, 'fans/admin.member/add', '', 730, 585, 1, '', ''),
                'Delete' => array(1, 'fans/admin.member/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'fans/admin.member/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.member/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'fans/admin.member/edit', '', 730, 530, 1, '', ''),
            )
        ),
        /*'Fanslist'  => array('Fans','r', 'fans/admin.sns/index', 'parent-icon','', 4, 1,
            array(
                'Addnew' => array(0, 'fans/admin.sns/add', '', 730, 530, 1, '', ''),
                'Delete' => array(1, 'fans/admin.sns/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'fans/admin.sns/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'fans/admin.sns/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.sns/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'fans/admin.sns/edit', '', 730, 530, 1, '', ''),
            )
        ),*/
        'Snscontent'=> array('Fans','r', 'fans/admin.snscon/index', 'items-icon','', 6, 1,
            array(
                'Addnew' => array(0, 'fans/admin.snscon/add', '', 900, 530, 1, '', ''),
                'Delete' => array(1, 'fans/admin.snscon/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'fans/admin.snscon/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'fans/admin.snscon/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.snscon/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'fans/admin.snscon/edit', '', 730, 530, 1, '', ''),
            )
        ),
        'Reported' => array('Fans','r', 'fans/admin.reported/index', 'sms-icon','', 5, 1,
            array(
                'Undorep'=> array(0, 'fans/admin.reported/undo', 'add-new ajax-post confirm', '', '', '', '', 'ids'),
                'Delete' => array(1, 'fans/admin.reported/delete', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.reported/disable', '', '', '', '', '', 'ids'),
            )
        ),
        'Type'=> array('Fans','r', 'fans/admin.type/index', 'website-icon','', 3, 1,
            array(
                'Addnew' => array(0, 'fans/admin.type/add', '', 600, 280, 1, '', ''),
                'Delete' => array(1, 'fans/admin.type/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'fans/admin.type/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'fans/admin.type/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'fans/admin.type/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'fans/admin.type/edit', '', 730, 530, 1, '', ''),
            )
        ),
        //'Fansreport'=> array('Fans','r', 'fans/admin.report/index', 'report-icon','', 6, 1),

    ),
);