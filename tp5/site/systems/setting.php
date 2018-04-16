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
        'name'        => 'Systems',
        'title'       => '系统管理',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'systems.png',    //默认指向当前模块view/admin/static/image/systems.png
        'description' => '定时任务,队列,集群,平台对接等系统核心功能管理',
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
        'Systems'     => array('','l', 'systems/admin.index/index', 'systems.png','', 1, 1),
        'Queuetask'     => array('Systems','l', 'systems/admin.task/index', '', '',2, 1),
          'Taskconfig'  => array('Queuetask','r', 'systems/admin.config/index', 'conf-icon','', 0, 1,
                array(
                    'Addnew' => array(1, 'systems/admin.config/add', '', 580, 370, 1, '',''),
                    'Delete'  => array(2,'systems/admin.config/delete', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'systems/admin.config/edit', '', 580, 370, 1, '', ''),
                    'Enable' => array(3, 'systems/admin.config/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'systems/admin.config/disable', '', '', '', '', '', 'ids'),
                )
          ),
          'Actuator'  => array('Queuetask','r', 'systems/admin.actuator/index', 'website-icon','', 1, 1,
              array(
                'Addnew' => array(1, 'systems/admin.actuator/add', '', 580, 370, 1, '',''),
                'Delete'  => array(2,'systems/admin.actuator/delete', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'systems/admin.actuator/edit', '', 580, 370, 1, '', ''),
                'Enable' => array(3, 'systems/admin.actuator/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'systems/admin.actuator/disable', '', '', '', '', '', 'ids'),
              )
          ),
          'Crontab'    => array('Queuetask','r', 'systems/admin.task/index', 'time-icon','', 2, 1,
                array(
                    'Newtask'=> array(0, 'systems/admin.task/add', '', 680, 630, 1, '', ''),
                    'Delete' => array(1, 'systems/admin.task/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'systems/admin.task/sort', '', '', '', '', '', 'sorts'),
                    'Execute'=> array(1, 'systems/admin.task/execron', 'btn-warning ajax-post', '', '', '', '', 'ids'),
                    'Pause'  => array(2, 'systems/admin.task/pause', 'btn-danger ajax-post', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'systems/admin.task/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'systems/admin.task/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'systems/admin.task/edit', '', 680, 630, 1, '', ''),
                  )
          ),
          'Queuelist'   => array('Queuetask','r', 'systems/admin.queue/task', 'list-icon','', 3, 1,
            array(
                'Addnew' => array(0, 'systems/admin.queue/add', '', 680, 630, 1, '',''),
                'Resetque'=> array(1,'systems/admin.queue/reset', 'btn-danger ajax-post', '', '', '', '', 'ids'),
                'Delete'  => array(2,'systems/admin.queue/delete', '', '', '', '', '', 'ids'),
                'Clearque'=> array(3,'systems/admin.queue/clear', 'btn-refresh ajax-post', '', '', '', '', ''),
                'Edit'   => array(-1, 'systems/admin.queue/edit', '', 680, 630, 1, '', ''),
            )
        ),
        'Queue'   => array('Queuetask','r', 'systems/admin.queue/index', 'queue-icon','', 4, 1,
            array(
                'Executnow' => array(1,'systems/admin.queue/exec', 'btn-danger ajax-post', '', '', '', '', 'ids'),
            )
        ),
    
        'Dispatchlogs'  => array('Queuetask','r', 'systems/admin.log/index', 'log-icon','', 5, 1,
            array(
                'Whole'   => array(1, 'systems/admin.log/index', 'add-new', '', '', '', '', ''),
                'Exelogs' => array(-1,'systems/admin.log/exelogs', '', '', '', '', '', ''),
            )
        ),
    
        'Appsyswatch'  => array('Systems','l', 'systems/admin.appwatch/index', '', '',3, 1),
          'Appwatch' => array('Appsyswatch','r', 'systems/admin.appwatch/index', 'app-icon','', 1, 1,
              array(
                  'Addnew' => array(0, 'systems/admin.appwatch/add', '', 390, 275, 1, '', ''),
                  'Sort'   => array(2, 'systems/admin.appwatch/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(2, 'systems/admin.appwatch/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(3, 'systems/admin.appwatch/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'systems/admin.appwatch/edit', '', 390, 275, 1, '', ''),
              )
          ),
          'Userwatch' => array('Appsyswatch','r', 'systems/admin.user/index', 'app-icon','', 1, 1,
              array(
                 'Addnew' => array(0, 'systems/admin.user/add', '', 390, 275, 1, '', ''),
              )
          ),
    
        'Syswatch'  => array('Systems','l', 'systems/admin.watch/index', '', '',4, 1),
          'Serverwatch' => array('Syswatch','r', 'systems/admin.watch/index', 'tool-icon','', 1, 1,
            array(
                'Addnew' => array(0, 'systems/admin.watch/add', '', 390, 275, 1, '', ''),
                'Sort'   => array(2, 'systems/admin.watch/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(2, 'systems/admin.watch/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(3, 'systems/admin.watch/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'systems/admin.watch/edit', '', 390, 275, 1, '', ''),
            )
          ),
          'Webwatch'  => array('Syswatch','r', 'systems/admin.watch/web', 'earth-icon','', 2, 1,
              array(
                  'Addnew' => array(0, 'systems/admin.request/add', '', 390, 275, 1, '', ''),
                  'Sort'   => array(2, 'systems/admin.request/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(2, 'systems/admin.request/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(3, 'systems/admin.request/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'systems/admin.request/edit', '', 390, 275, 1, '', ''),
              )
        ),
        'Dbwatch'  => array('Syswatch','r', 'systems/admin.watch/db', 'db-icon','', 3, 1,
            array(
                'Whole' => array(0, 'systems/admin.watch/db', 'add-new', '', '', '', '', ''),
            )
        ),
        'Rediswatch'  => array('Syswatch','r', 'systems/admin.watch/redis', 'redis-icon','', 4, 1,
            array(
                'Whole' => array(0, 'systems/admin.watch/redis', 'add-new', '', '', '', '', ''),
            )
        ),
        'Mongowatch' => array('Syswatch','r', 'systems/admin.watch/mongodb', 'db-icon','', 5, 1,
            array(
                'Whole' => array(0, 'systems/admin.watch/mongodb', 'add-new', '', '', '', '', ''),
            )
        ),
        'Warmingcall'  => array('Syswatch','r', 'systems/admin.watch/warming', 'conf-icon','', 0, 1,
            array(
                'Save' => array(-1, 'systems/admin.watch/save', '', 390, 275, 1, '', ''),
            )
        ),

        'Websafe'=> array('Systems','l', 'systems/admin.words/index', '', '',99, 1),
            'Wordlist'=> array('Websafe','r', 'systems/admin.words/index', 'lock-icon','', 0, 1,
                array(
                    'Addnew' => array(0, 'systems/admin.words/add', '', 600, 400, 1, '', ''),
                    'Delete' => array(1, 'systems/admin.words/delete', '', '', '', '', 'ete', 'ids'),
                    'Enable' => array(2, 'systems/admin.words/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'systems/admin.words/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'systems/admin.words/edit', '', 600, 400, 1, '', ''),
                )
            ),
    
        'Realtime'    => array('Systems','l', 'systems/admin.realtime/index','','',5, 1),
            'Generals'=> array('Realtime','r','systems/admin.realtime/index', 'report-icon','',0, 1,
                array(
                    'Whole' => array(0, 'systems/admin.realtime/index','add-new', '', '', '', ''),
                )
            ),
            'Ruserlist' => array('Realtime','r','systems/admin.realtime/user', 'report-icon','',1, 1,
                array(
                    'Whole' => array(0, 'systems/admin.realtime/user','add-new', '', '', '', ''),
                )
            ),
            'Traffic'   => array('Realtime','r','systems/admin.realtime/traffic', 'cat-icon','',2, 1,
                array(
                    'Whole' => array(0, 'systems/admin.realtime/traffic','add-new', '', '', '', ''),
                )
            ),
    )
);