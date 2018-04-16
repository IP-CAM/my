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
        'name'        => 'Finance',
        'title'       => '融资租赁平台',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'finance.png',
        'description' => '融资租赁平台',
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
        'Finance'    => array('','l', 'finance/admin.category/index', 'finance.png', '', 1, 1),
          'Financeconf'=> array('Finance','l', 'finance/admin.category/index', '', '', 0, 1),
            'Fincat'   => array('Financeconf','r','finance/admin.category/index','cat-icon','', 0, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.category/add', '', 900, 560, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.category/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.category/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.category/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.category/disable', '', '', '', '', '', 'ids'),
                    'Import' => array(5, 'finance/admin.category/import', '', 440, 280, 1, '', ''),
                    'Export' => array(6, 'finance/admin.category/export', '', 440, 280, 1, '', ''),
                    'Edit'   => array(-1, 'finance/admin.category/edit', '', 900, 560, 1, '', ''),
                )
            ),
            'Finbrand' => array('Financeconf','r','finance/admin.brand/index','parent-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.brand/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.brand/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.brand/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.brand/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.brand/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.brand/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Finnav' => array('Financeconf','r','finance/admin.nav/index','earth-icon','', 2, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.nav/add', '', 780, 500, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.nav/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.nav/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.nav/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.nav/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.nav/edit', '', 780, 500, 1, '', ''),
                )
            ),
            'Finpay' => array('Financeconf','r','finance/admin.payment/index','pay-icon','', 3, 1,
                array(
                    'Sort'   => array(2, 'finance/admin.payment/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.payment/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.payment/disable', '', '', '', '', '', 'ids'),
                )
            ),
            'Finconf'  => array('Financeconf','r','finance/admin.config/index','conf-icon','', 4, 1,
               array(
                  'Save' => array(-1, 'finance/admin.config/save', '', '', '', 1, '', ''),
              )
            ),
        
        'Fingoodsys'    => array('Finance','l', 'finance/admin.index/index', '', '', 1, 1),
            'Fingdslist'=> array('Fingoodsys','r','finance/admin.index/index', 'list-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.index/add', '', 1024, 768, 1, '', ''),
                    'Import' => array(1, 'finance/admin.index/import', '', 440, 280, 1, '', ''),
                    'Export' => array(2, 'finance/admin.index/export', '', 440, 280, 1, '', 'ids'),
                    'Delete' => array(3, 'finance/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(4, 'finance/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Goodup' => array(5, 'finance/admin.index/up', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
                    'Gooddown'=> array(6, 'finance/admin.index/down', 'btn-warning ajax-post', '', '', '', '', 'ids'),
                    'Goodwait'=> array(7, 'finance/admin.index/wait', 'enabled ajax-post', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.index/edit', '', 1024, 768, 1, '', ''),
                )
            ),
        
            'Finmodel'=>array('Fingoodsys','r','finance/admin.attrmodel/index','db-icon', '', 2, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.attrmodel/add', '', 800, 600, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.attrmodel/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.attrmodel/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.attrmodel/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.attrmodel/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.attrmodel/edit', '', 800, 600, 1, '', ''),
                )
            ),
            'Finspec'=>array('Fingoodsys','r', 'finance/admin.specif/index', 'more-icon', '', 3, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.specif/add', '', 800, 600, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.specif/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.specif/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.specif/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.specif/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.specif/edit', '', 800, 600, 1, '', ''),
                )
            ),
            'Finattr'=>array('Fingoodsys','r','finance/admin.attribute/index','cat-icon', '', 4, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.attribute/add', '', 800, 600, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.attribute/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.attribute/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.attribute/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.attribute/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.attribute/edit', '', 800, 600, 1, '', ''),
                )
            ),
            'Finsearch'=>array('Fingoodsys','r','finance/admin.search/index','search-icon','',5, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.search/add', '', 800, 600, 1, '', ''),
                    'Delete' => array(1, 'finance/admin.search/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'finance/admin.search/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'finance/admin.search/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'finance/admin.search/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.search/edit', '', 800, 600, 1, '', ''),
                )
            ),
            'Fsehscount'=> array('Fingoodsys','r','finance/admin.count/index','report-icon','',6,1,''),
    
        'Finpact'      => array('Finance','l', 'finance/admin.pact/index', '', '', 1, 1),
            'Pactlist' => array('Finpact','r','finance/admin.pact/index', 'list-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.pact/add', '', 1024, 768, 1, '', ''),
                    'Import' => array(1, 'finance/admin.pact/import', '', 440, 280, 1, '', ''),
                    'Export' => array(2, 'finance/admin.pact/export', '', 440, 280, 1, '', 'ids'),
                    'Delete' => array(3, 'finance/admin.pact/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(4, 'finance/admin.pact/sort', '', '', '', '', '', 'sorts'),
                    'Goodup' => array(5, 'finance/admin.pact/up', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
                    'Gooddown'=> array(6, 'finance/admin.pact/down', 'btn-warning ajax-post', '', '', '', '', 'ids'),
                    'Goodwait'=> array(7, 'finance/admin.pact/wait', 'enabled ajax-post', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'finance/admin.pact/edit', '', 1024, 768, 1, '', ''),
                )
            ),
    
            'Pactset'  => array('Finpact','r','finance/admin.pactset/index', 'conf-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'finance/admin.pactset/add', '', 1024, 768, 1, '', ''),
                    'Import' => array(1, 'finance/admin.pactset/import', '', 440, 280, 1, '', ''),
                    'Export' => array(2, 'finance/admin.pactset/export', '', 440, 280, 1, '', 'ids'),
                    'Delete' => array(3, 'finance/admin.pactset/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(4, 'finance/admin.pactset/sort', '', '', '', '', '', 'sorts'),
                )
            ),
    
        'Finordersys'   => array('Finance','l', 'finance/admin.order/index', '', '', 1, 1),
            'Finorder'  => array('Finordersys','r','finance/admin.order/index', 'list-icon', '', 0, 1,
                array(
                    'Export' => array(1, 'finance/admin.order/export', '', 440, 280, 1, '', 'ids'),
                )
            ),
            'Eomsreport'=>array('Finordersys','r','finance/admin.report/eoms','time-icon','',1, 1,
                array(
                    'Import' => array(1, 'finance/admin.report/import', '', 440, 280, 1, '', ''),
                )
            ),
            'Finlog'  => array('Finordersys','r','finance/admin.log/index', 'conf-icon', '', 2, 1,
                array(
                    'Import' => array(1, 'finance/admin.log/import', '', 440, 280, 1, '', ''),
                    'Export' => array(2, 'finance/admin.log/export', '', 440, 280, 1, '', 'ids'),
                    'Delete' => array(3, 'finance/admin.log/delete', '', '', '', '', '', 'ids'),
                )
            ),
            'Finreport' => array('Finordersys','r','finance/admin.report/index','report-icon','',3, 1,
                array(
                    'Import' => array(1, 'finance/admin.report/import', '', 440, 280, 1, '', ''),
                )
            ),
            'Fincrm'  => array('Finordersys','r','finance/admin.crm/index', 'conf-icon', '', 4, 1,
                array(
                    'Back'    => array(1, '', '', '', '', 1, '', ''),
                    'Refresh' => array(2, '', '', '', '', 1, '', ''),
                    'Delete' => array(3, 'finance/admin.log/delete', '', '', '', '', '', 'ids'),
                )
            ),
    ),
);