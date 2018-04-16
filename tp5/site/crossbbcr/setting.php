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
        'name'        => 'Crossbbcr',
        'title'       => '跨境BBC(加盟版)',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'crossbbcr.png',
        'description' => '跨境电商平台(招商加盟版), 多商户B2B2C平台，商家加盟无店铺，带商户及用户分销功能，平台主运营，统一结算方式',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '0.0.9',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'     => '1.0.0',
            'Cms'       => '1.0.0',
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
        'Crossbbcr'    => array('','l', 'Crossbbcr/admin.category/index', 'crossbbcr.png', '', 1, 1),
        'Crossbbset'   => array('Crossbbcr','l', 'crossbbcr/admin.category/index', '', '', 1, 1),
          'Bbccat'     => array('Crossbbset','r','crossbbcr/admin.category/index','cat-icon','', 0, 1,
              array(
                'Addnew' => array(0, 'crossbbcr/admin.category/add', '', 730, 530, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.category/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.category/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.category/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.category/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.category/edit', '', 730, 530, 1, '', ''),
                'Import' => array(5, 'crossbbcr/admin.category/import', '', '', '', '', '', ''),
                'Export' => array(6, 'crossbbcr/admin.category/export', '', '', '', '', '', ''),
              )
          ),
          'Bbcconf'=> array('Crossbbset','r', 'crossbbcr/admin.config/index', 'conf-icon', '', 1, 1),
          'Brand'  => array('Crossbbset','r', 'crossbbcr/admin.brand/index', 'parent-icon', '', 2, 1,
            array(
                'Addnew' => array(0, 'crossbbcr/admin.brand/add', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.brand/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.brand/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.brand/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.brand/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1,'crossbbcr/admin.brand/edit', '', 630, 455, 1, '', ''),
            )
        ),
        'Payment'   => array('Crossbbset','r', 'crossbbcr/admin.payment/index', 'pay-icon', '', 3, 1,
            array(
                'Sort'   => array(2, 'crossbbcr/admin.payment/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.payment/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.payment/disable', '', '', '', '', '', 'ids'),
                'Setting'=> array(-1,'crossbbcr/admin.payment/setting', '', 630, 455, 1, '', ''),
            )
        ),

        'Goods'         => array('Crossbbcr','l', 'crossbbcr/admin.goods/index', '', '', 1, 1),
           'Goodslist'  => array('Goods','r', 'crossbbcr/admin.goods/index', 'list-icon', '', 0, 1,
              array(
                  'Addnew' => array(0, 'crossbbcr/admin.goods/add', '', 1024, 768, 1, '', ''),
                  'Delete' => array(1, 'crossbbcr/admin.goods/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'crossbbcr/admin.goods/sort', '', '', '', '', '', 'sorts'),
                  'Goodup' => array(3, 'crossbbcr/admin.goods/up', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
                  'Gooddown'=> array(4, 'crossbbcr/admin.goods/down', 'btn-danger ajax-post', '', '', '', '', 'ids'),
                  'Goodwait'=> array(5, 'crossbbcr/admin.goods/wait', 'enabled ajax-post', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'crossbbcr/admin.goods/edit', '', 1024, 768, 1, '', ''),
              )
          ),
        
          'Goodsspec' => array('Goods','r', 'crossbbcr/admin.specif/index', 'more-icon', '', 3, 1,
              array(
                'Addnew' => array(0, 'crossbbcr/admin.specif/add', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.specif/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.specif/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.specif/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.specif/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.specif/edit', '', 630, 455, 1, '', ''),
            )
        ),
        'Goodsattr'  => array('Goods','r', 'crossbbcr/admin.attribute/index', 'cat-icon', '', 4, 1,
            array(
                'Addnew' => array(0, 'crossbbcr/admin.attribute/add', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.attribute/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.attribute/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.attribute/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.attribute/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.attribute/edit', '', 630, 455, 1, '', ''),
            )
       ),
       'Goodssearch'=> array('Goods','r', 'crossbbcr/admin.search/index', 'search-icon', '', 5, 1,
            array(
                'Addnew' => array(0, 'crossbbcr/admin.search/add', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.search/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.search/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.search/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.search/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.search/edit', '', 630, 455, 1, '', ''),
            )
        ),
       'Gsehscount'=> array('Goods','r', 'crossbbcr/admin.count/index', 'report-icon', '', 6, 1,''),
    
      'Offlinesys'=> array('Crossbbcr','l', 'crossbbcr/admin.offline/index', '', '', 2, 1),
        'Offline' => array('Offline','r', 'crossbbcr/admin.offline/index', 'shop-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcr/admin.offline/add', '', 1024, 768, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.offline/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.offline/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.offline/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.offline/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.offline/edit', '', 1024, 768, 1, '', ''),
            )
        ),
        'Offdisrules' => array('Offline','r', 'crossbbcr/admin.offdisrules/index','rule-icon','',1,1,
            array(
                'Addnew' => array(0, 'crossbbcr/admin.offdisrules/add', '', 1024, 768, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.offdisrules/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.offdisrules/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.offdisrules/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.offdisrules/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.offdisrules/edit', '', 1024, 768, 1, '', ''),
            )
        ),
        'Offdisconf' => array('Offline','r', 'crossbbcr/admin.config/offline','conf-icon','',2,1),

        'Ware_exp'    => array('Crossbbcr','l', 'crossbbcr/admin.warehouse/index', '', '', 2, 1),
          'Warehouse' => array('Ware_exp','r','crossbbcr/admin.warehouse/index','list-icon','', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcr/admin.warehouse/add', '', 500, 600, 1, '', ''),
                'Delete' => array(1, 'crossbbcr/admin.warehouse/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'crossbbcr/admin.warehouse/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcr/admin.warehouse/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'crossbbcr/admin.warehouse/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.warehouse/edit', '', 500, 600, 1, '', ''),
            )
          ),
          'Expresstpl'=> array('Ware_exp','r','crossbbcr/admin.express/index','express-icon','', 1, 1,
              array(
                  'Addnew' => array(0, 'crossbbcr/admin.express/add', '', 800, 600, 1, '', ''),
                  'Delete' => array(1, 'crossbbcr/admin.express/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'crossbbcr/admin.express/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'crossbbcr/admin.express/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'crossbbcr/admin.express/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'crossbbcr/admin.express/edit', '', 800, 600, 1, '', ''),
              )
          ),
    
        'Touchsys'    => array('Crossbbcg','l', 'crossbbcr/admin.touch/index', '', '', 3, 1),
          'Touch'     => array('Touchsys','r','crossbbcr/admin.touch/index','conf-icon','', 0, 1,
            array(
                'Pushorder'=> array(0, 'crossbbcr/admin.touch/add', 'btn-danger ajax-get', 800, 600, 1, '', ''),
            )
        ),
        'Errortuch'=> array('Touchsys','r','crossbbcr/admin.touch/error','list-icon','', 1, 1,
            array(
                'Delete' => array(1, 'crossbbcr/admin.touch/delete', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'crossbbcr/admin.touch/edit', '', 800, 600, 1, '', ''),
            )
        ),
        
        'Reportlist'  => array('Crossbbcr','l', 'crossbbcr/admin.report/index', '', '', 1, 1),

    ),
);