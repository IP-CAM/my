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
        'name'        => 'Bcwareexp',
        'title'       => '商城仓储物流',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'bcwareexp.png',
        'description' => '商城仓储物流模块，管理商品库存，运费模板，配送方式及提货点',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'   => '1.0.0',
            'Cms'    => '1.0.0',
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
        'Bcwareexp'=> array('','l', 'bcwareexp/admin.express/index', 'bcwareexp.png', '', 1, 1),
          'Exps' => array('Bcwareexp','l', 'bcwareexp/admin.express/index', '', '', 5, 1),
            'Expcompay'=>array('Exps','r','bcwareexp/admin.express/index','logistics-icon','',1,1,
                array(
                    'Addnew' => array(0, 'bcwareexp/admin.express/add', '', 920, 605, 1, '', ''),
                    'Delete' => array(1, 'bcwareexp/admin.express/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'bcwareexp/admin.express/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'bcwareexp/admin.express/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'bcwareexp/admin.express/disable', '', '', '', '', '', 'ids'),
                    'Import' => array(5, 'bcwareexp/admin.express/import', '', 440, 280, 1, '', ''),
                    'Export' => array(6, 'bcwareexp/admin.express/export', '', 440, 280, 1, '', 'ids'),
                    'Edit'   => array(-1, 'bcwareexp/admin.express/edit', '', 920, 605, 1, '', ''),
                )
            ),
        
            'Expresstpl'=>array('Exps','r','bcwareexp/admin.expresstpl/index','express-icon','',2,1,
                array(
                    'Addnew' => array(0,'bcwareexp/admin.expresstpl/add', '', 1048, 680, 1, '', ''),
                    'Delete' => array(1,'bcwareexp/admin.expresstpl/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'bcwareexp/admin.expresstpl/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3,'bcwareexp/admin.expresstpl/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4,'bcwareexp/admin.expresstpl/disable','', '', '', '', '', 'ids'),
                    'Edit'   => array(-1,'bcwareexp/admin.expresstpl/edit','', 1048, 680, 1, '', ''),
                )
            ),
        
            'Takeself'=>array('Exps','r','bcwareexp/admin.takeself/index','earth-icon','',3,1,
                array(
                    'Addnew' => array(0,'bcwareexp/admin.takeself/add', '', 640, 500, 1, '', ''),
                    'Delete' => array(1,'bcwareexp/admin.takeself/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'bcwareexp/admin.takeself/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3,'bcwareexp/admin.takeself/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4,'bcwareexp/admin.takeself/disable','', '', '', '', '', 'ids'),
                    'Edit'   => array(-1,'bcwareexp/admin.takeself/edit','', 640, 500, 1, '', ''),
                )
            ),

        'Wareho' => array('Bcwareexp','l', 'bcwareexp/admin.index/index', '', '', 5, 1),
          'Crossware'=> array('Wareho','r','bcwareexp/admin.index/index','ware-icon','', 0, 1,
              array(
                'Addnew' => array(0, 'bcwareexp/admin.index/add', '', 750, 680, 1, '', ''),
                'Delete' => array(1, 'bcwareexp/admin.index/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'bcwareexp/admin.index/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'bcwareexp/admin.index/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'bcwareexp/admin.index/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'bcwareexp/admin.index/edit', '', 750, 680, 1, '', ''),
              )
          ),

        'Areasys'   => array('Bcwareexp','l', 'bcwareexp/admin.area/index', '', '', 1, 1),
            'Area'  => array('Areasys','r', 'bcwareexp/admin.area/index', 'domain-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'bcwareexp/admin.area/add', '', 640, 460, 1, '', ''),
                    'Delete' => array(1, 'bcwareexp/admin.area/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'bcwareexp/admin.area/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'bcwareexp/admin.area/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'bcwareexp/admin.area/disable', '', '', '', '', '', 'ids'),
                    'lower'  => array(-1, 'bcwareexp/admin.area/lower', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'bcwareexp/admin.area/edit', '', 640, 460, 1, '', ''),
                )
            ),
            'Currencylist'   => array('Areasys','r', 'bcwareexp/admin.currency/index','curr-icon', '', 2, 1,
                array(
                    'Addnew' => array(0, 'bcwareexp/admin.currency/add', '', 480, 460, 1, '', ''),
                    'Delete' => array(1, 'bcwareexp/admin.currency/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'bcwareexp/admin.currency/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'bcwareexp/admin.currency/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'bcwareexp/admin.currency/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'bcwareexp/admin.currency/edit', '', 480, 460, 1, '', ''),
                )
            ),
            'Zone'   => array('Areasys','r', 'bcwareexp/admin.zone/index','q-icon', '', 2, 1,
                array(
                    'Addnew' => array(0, 'bcwareexp/admin.zone/add', '',980, 500, 1, '', ''),
                    'Delete' => array(1, 'bcwareexp/admin.zone/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'bcwareexp/admin.zone/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'bcwareexp/admin.zone/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'bcwareexp/admin.zone/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'bcwareexp/admin.zone/edit', '', 980, 500, 1, '', ''),
                )
        ),
    )
);