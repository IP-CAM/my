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
        'name'        => 'Runtuer',
        'title'       => '润云核心',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'core.png',
        'description' => '润云核心业务模块，包括项目管理，授权管理，分发下载',
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
    'user_nav' => array(),

    //模型配置
    'config' => array(),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
        位置：l:左路，r：右，h：隐藏, b: 按钮
        是否权限控制 ：1，是，0：否
         **/
        //'General'   => array('','l', 'Admin/index', 'fa fa-home', 1, 1),
        'Core'       => array('','l', 'runtuer/admin.index/index', 'core.png', '', 1, 1),
        'Customsys'  => array('Core','l', 'runtuer/admin.consult/index', 'talk.png', '', 0, 1),
          'Consult'  => array('Customsys','r', 'runtuer/admin.consult/index', 'custom-icon', '', 0, 1,
            array(
                'Addnew' => array(0,'runtuer/admin.consult/add', '', 820, 600, 1, ''),
                'Delete' => array(1, 'runtuer/admin.consult/delete', '', '', '', '', '', 'ids'),
                'Edit'=> array(-1, 'runtuer/admin.consult/edit', '', 820, 600, 1, ''),
            )
          ),
          'Conreport'=> array('Customsys','r', 'runtuer/admin.consult/report', 'report-icon','', 1, 1,
            
          ),
        'Projectsys'  => array('Core','l', 'runtuer/admin.projects/index', 'project.png', '', 1, 1),
          'Projects'  => array('Projectsys','r','runtuer/admin.projects/index','list-icon', '', 0, 1,
              array(
                  'Newproject' => array(0, 'runtuer/admin.projects/add', 'add-new ajax-get add', 820, 600, 1, '', ''),
                  'After_sale'=> array(3, 'runtuer/admin.projects/status/do/aftersale', 'btn-back ajax-post', '', '', '', '', 'ids'),
                  'In_contact'=> array(6, 'runtuer/admin.projects/status/do/incontact', 'enabled ajax-post', '', '', '', '', 'ids'),
                  'Development'=> array(7, 'runtuer/admin.projects/status/do/dev', 'btn-danger ajax-post', '', '', '', '', 'ids'),
                  'Edit'=> array(-1, 'runtuer/admin.projects/edit', '', 820, 600, 1, '', ''),
                  'Delete'=> array(-1, 'runtuer/admin.projects/delete', '', '', '', '', '', ''),
              )
          ),
        'Pcomplete'=> array('Projectsys','r','runtuer/admin.projects/complete', 'ok-icon', '', 1, 1,
            array(
                'Whole' => array(0, 'runtuer/admin.projects/complete','add-new', '', '', '', ''),
            )
        ),
        'Pfailed'  => array('Projectsys','r','runtuer/admin.projects/failed', 'fail-icon', '', 2, 1,
            array(
                'Whole' => array(0, 'runtuer/admin.projects/failed','add-new', '', '', '', ''),
            )
        ),
        'After'    => array('Projectsys','r','runtuer/admin.projects/aftersale','after-icon','',3, 1,
            array(
                'Whole' => array(0, 'runtuer/admin.projects/aftersale','add-new', '', '', '', ''),
            )
        ),
        'Overdue'  => array('Projectsys','r','runtuer/admin.projects/overdue', 'time-icon', '', 4, 1,
            array(
                'Whole' => array(0, 'runtuer/admin.projects/overdue','add-new', '', '', '', ''),
            )
        ),
        'Preports' => array('Projectsys','r','runtuer/admin.projects/report', 'report-icon','', 5, 1,
            array(
                'Whole' => array(0, 'runtuer/admin.projects/report','add-new', '', '', '', ''),
            )
        ),

        'Licesons'     => array('Core','l', 'runtuer/admin.liceson/index', 'liceson.png', '', 3, 1),
          'Liceson'    => array('Licesons','r', 'runtuer/admin.liceson/index', 'list-icon', '', 1, 1,
              array(
                'Newlic' => array(0,'runtuer/admin.liceson/add','add-new ajax-get add',800,650,1,''),
                'Delete' => array(1, 'runtuer/admin.liceson/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'runtuer/admin.liceson/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'runtuer/admin.liceson/disable', '', '', '', '', '', 'ids'),
                'Edit'=> array(-1, 'runtuer/admin.liceson/edit', '', 800,615, 1, '', ''),
             )
          ),
          'Oklic'     => array('Licesons','r', 'runtuer/admin.liceson/ok', 'ok-icon', '', 2, 1,
              array(
                  'Delete' => array(1, 'runtuer/admin.category/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(3, 'runtuer/admin.category/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'runtuer/admin.category/disable', '', '', '', '', '', 'ids'),
                  'Edit'=> array(-1, 'runtuer/admin.liceson/edit', '', '', '', '', '', ''),
              )
          ),
          'Overlic'   => array('Licesons','r', 'runtuer/admin.liceson/over', 'over-icon', '', 4, 1,
              array(
                  'Delete' => array(1, 'runtuer/admin.category/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(3, 'runtuer/admin.category/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'runtuer/admin.category/disable', '', '', '', '', '', 'ids'),
                  'Edit'=> array(-1, 'runtuer/admin.liceson/edit', '', '', '', '', '', ''),
              )
          ),
          'Errlic'    => array('Licesons','r', 'runtuer/admin.liceson/err', 'pri-icon', '', 7, 1,
              array(
                  'Addnew' => array(0, 'runtuer/admin.category/add', '', 630, 455, 1, '', ''),
                  'Delete' => array(1, 'runtuer/admin.category/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(3, 'runtuer/admin.category/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'runtuer/admin.category/disable', '', '', '', '', '', 'ids'),
                  'Edit'=> array(-1, 'runtuer/admin.liceson/edit', '', 630, 455, 1, '', ''),
              )
          ),

          'Report'    => array('Core','l', 'runtuer/admin.report/index', 'report.png', '', 4, 1),
          'Sitereport'=> array('Report','r', 'runtuer/admin.report/index', 'domain-icon', '', 0, 1),
          'Lost'      => array('Report','r', 'runtuer/admin.report/lost', 'down-icon', '', 1, 1),
          'Active'    => array('Report','r', 'runtuer/admin.report/active', 'up-icon', '', 2, 1),
        
    )
);