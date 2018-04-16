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
        'name'        => 'Im',
        'title'       => '客服系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'im.png',
        'description' => '客服系统，实时沟通，任务分派，数据统计，分析，里衬监控',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'   => '1.0.0',
        ),
        //依赖扩展
        'extend' => array(
			//'deliverys|Common'  => '2.0',				//目录名|插件名称  => 版本号
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
        'Im'           => array('','l', 'im/admin.seat/index', 'im.png', '', 1, 1),
          'Imconfsys'  => array('Im','l', 'im/admin.seat/index', '', '', 0, 1),
            'Imseat'=> array('Imconfsys','r', 'im/admin.seat/index', 'list-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'im/admin.seat/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.seat/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'im/admin.seat/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'im/admin.seat/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.seat/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'im/admin.seat/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Imconf'=> array('Imconfsys','r', 'im/admin.config/index', 'conf-icon', '', 1, 1,
                array(
                    'Save'   => array(-1, 'im/admin.config/edit', '', '', '', '', '', ''),
                )
            ),
        
          'AIQuest'    => array('Im','l', 'im/admin.index/index', '', '', 1, 1),
            'Questions'=> array('AIQuest','r', 'im/admin.index/index', 'sms-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'im/admin.index/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'im/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'im/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'im/admin.index/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Questcat'  => array('AIQuest','r', 'im/admin.questcat/index', 'cat-icon', '',2, 1,
                array(
                    'Addnew' => array(0, 'im/admin.questcat/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.questcat/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'im/admin.questcat/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'im/admin.questcat/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.questcat/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'im/admin.questcat/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Queskeys' => array('AIQuest','r', 'im/admin.queskeys/index', 'key-icon', '', 3, 1,
                array(
                    'Addnew' => array(0, 'im/admin.queskeys/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.queskeys/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'im/admin.queskeys/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'im/admin.queskeys/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.queskeys/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'im/admin.queskeys/edit', '', 600, 460, 1, '', ''),
                )
            ),
        
          'Workstream'  => array('Im','l', 'im/admin.service/index', '', '', 1, 1),
            'Servicers' => array('Workstream','r', 'im/admin.service/index', 'uu-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'im/admin.service/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.service/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'im/admin.service/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'im/admin.service/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.service/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'im/admin.service/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Asklog' => array('Workstream','r', 'im/admin.asklog/index', 'log-icon', '', 5, 1,
                array(
                    'Clear'  => array(0, 'im/admin.asklog/clear', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.asklog/delete', '', '', '', '', '', 'ids'),
                )
            ),
            'Askreport'=> array('Workstream','r', 'im/admin.report/ask', 'report-icon', '', 6, 1,
                array(
                    'Clearsearch' => array(0, 'im/admin.report/ask', 'btn-refresh', '', '', '', '', ''),
                )
            ),
            'Quesconf' => array('Workstream','r', 'im/admin.quesconf/index', 'conf-icon', '', 0, 1,
                array(
                    'Save'  => array(-1, 'im/admin.quesconf/save', '', '', '', 1, '', ''),
                )
            ),
        
          'Aftersale'  => array('Im','l', 'im/admin.after/index', '', '', 1, 1),
            'Afterlist'=> array('Aftersale','r', 'im/admin.after/index', 'list-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'im/admin.after/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.after/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'im/admin.after/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.after/disable', '', '', '', '', '', 'ids'),
                )
            ),
            'Stream'     => array('Aftersale','r', 'im/admin.stream/index', 'cat-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'im/admin.stream/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'im/admin.stream/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'im/admin.stream/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'im/admin.stream/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'im/admin.stream/disable', '', '', '', '', '', 'ids'),
                )
            ),
            'Afterlog'   => array('Aftersale','r', 'im/admin.after/log', 'log-icon', '', 2, 1,
                array(
                    'Clear' => array(0, 'im/admin.after/clearlog', '','','','',''),
                    'Delete'=> array(1, 'im/admin.after/delete', '', '', '', '', '', 'ids'),
                )
            ),
            'Afterreport'=> array('Aftersale','r', 'im/admin.report/after', 'report-icon', '', 3, 1,
                array(
                    'Clearsearch' => array(0, 'im/admin.report/after', 'btn-refresh', '', '', '', '', ''),
                )
            ),
            
    )
);