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
        'name'        => 'Language',
        'title'       => '语言学习系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'language.png',
        'description' => '语言学习系统，主要提供学习各种语言的功能',
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
        'Languagesys' => array('','l', 'language/admin.index/index', 'language.png', '', 1, 1),
          'Langcolumn' => array('Languagesys','l', 'language/admin.index/index', '','', 0, 1),
            'Langclass'=> array('Langcolumn','r','language/admin.index/index','list-icon','',0, 1,
               array(
                 'Addnew' => array(0, 'language/admin.index/add', '', 820, 600, 1, '', ''),
                 'Delete' => array(1, 'language/admin.index/delete', '', '', '', '', '', 'ids'),
                 'Enable' => array(3, 'language/admin.index/enable', '', '', '', '', '', 'ids'),
                 'Disable'=> array(4, 'language/admin.index/disable', '', '', '', '', '', 'ids'),
                 'Sort'   => array(2,'language/admin.index/sort','','','','','','sorts'),
                 'Edit'   => array(-1, 'language/admin.index/edit', '', 820, 600, 1, '', ''),
              )
            ),
            'Teaclass' => array('Langcolumn','r','language/admin.teaclass/index','list-icon','',1, 1,
                array(
                    'Addnew' => array(0, 'language/admin.teaclass/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.teaclass/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.teaclass/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.teaclass/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.teaclass/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.teaclass/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Lanconfig' => array('Langcolumn','r','language/admin.config/index','conf-icon','',2, 1,
                array(
                    'Save' => array(0, 'language/admin.config/save', '', '', '', 1, '', ''),
                )
            ),
    
          'Teachersys' => array('Languagesys','l', 'language/admin.teacher/index', '','', 0, 1),
            'Teacher'=> array('Teachersys','r','language/admin.teacher/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.teacher/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.teacher/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.teacher/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.teacher/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.teacher/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.teacher/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Joiner' => array('Teachersys','r','language/admin.joiner/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.joiner/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.joiner/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.joiner/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.joiner/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.joiner/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.joiner/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Evascore' => array('Teachersys','r','language/admin.evascore/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.evascore/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.evascore/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.evascore/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.evascore/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.evascore/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.evascore/edit', '', 820, 600, 1, '', ''),
                )
            ),
         
         'Resources' => array('Languagesys','l', 'language/admin.sources/index', '','', 0, 1),
            'Sources'=> array('Resources','r','language/admin.sources/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.sources/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.sources/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.sources/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.sources/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.sources/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.sources/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Courseware' => array('Resources','r','language/admin.courseware/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.courseware/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.courseware/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.courseware/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.courseware/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.courseware/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.courseware/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Souvideo' => array('Resources','r','language/admin.souvideo/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.souvideo/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.souvideo/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.souvideo/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.souvideo/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.souvideo/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.souvideo/edit', '', 820, 600, 1, '', ''),
                )
            ),
    
          'Attendance' => array('Languagesys','l', 'language/admin.attend/index', '','', 0, 1),
            'Attend' => array('Attendance','r','language/admin.attend/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.attend/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.attend/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.attend/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.attend/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.attend/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.attend/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Schedule'=> array('Attendance','r','language/admin.schedule/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.sources/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.sources/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.sources/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.sources/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.sources/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.sources/edit', '', 820, 600, 1, '', ''),
                )
            ),
            'Reward' => array('Attendance','r','language/admin.reward/index','list-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'language/admin.reward/add', '', 820, 600, 1, '', ''),
                    'Delete' => array(1, 'language/admin.reward/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'language/admin.reward/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'language/admin.reward/disable', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.reward/sort','','','','','','sorts'),
                    'Edit'   => array(-1, 'language/admin.reward/edit', '', 820, 600, 1, '', ''),
                )
            ),
    
          'Achievement' => array('Languagesys','l', 'language/admin.achievement/index', '','', 0, 1),
            'Achie' => array('Achievement','r','language/admin.achievement/index','list-icon','',0, 1,
                array(
                    'Delete' => array(1, 'language/admin.attend/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'language/admin.attend/sort','','','','','','sorts'),
                )
            ),
            'Report' => array('Achievement','r','language/admin.report/index','report-icon','',2, 1,
                array(
                    'Delete' => array(1, 'language/admin.report/delete', '', '', '', '', '', 'ids'),
                )
            ),
    
        'Lantrade'    => array('Languagesys','l', 'language/admin.order/index', '','', 0, 1),
          'Lanorder'  => array('Lantrade','r','language/admin.order/index','list-icon','',0, 1,
              array(
                  'Addnew' => array(0, 'language/admin.order/add', '', 820, 600, 1, '', ''),
                  'Delete' => array(1, 'language/admin.order/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(3, 'language/admin.order/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'language/admin.order/disable', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2,'language/admin.order/sort','','','','','','sorts'),
                  'Edit'   => array(-1, 'language/admin.order/edit', '', 820, 600, 1, '', ''),
              )
          ),
    )
);