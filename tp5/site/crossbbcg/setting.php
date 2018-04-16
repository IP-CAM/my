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
        'name' => 'Crossbbcg',
        'title' => '跨境BBC(集运版)',
        'icon' => '',
        'icon_color' => '',
        'image' => 'crossbbcg.png',
        'description' => '跨境电商平台(集中运营版), 多商户B2B2C平台，商家入驻无店铺，平台主运营，统一结算方式',
        'author' => 'Runtuer',
        'website' => 'http://www.runtuer.com',
        'version' => '0.0.9',
        'upgrade' => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin' => '1.0.0',
            'Cms' => '1.0.0',
        ),
        //依赖扩展
        'extend' => array(),
    ),
    
    // 用户中心导航
    'user_nav' => array(),
    
    // 模块配置
    'config' => array(),
    
    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
         * '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
         * 位置：l:左路，r：右，h：隐藏
         * 是否权限控制 ：1，是，0：否
         **/
        'Crossbbcg' => array('', 'l', 'crossbbcg/admin.config/index', 'crossbbcg.png', '', 1, 1),
        'Crossbbset' => array('Crossbbcg', 'l', 'crossbbcg/admin.config/index', '', '', 1, 1),
        'Bbcconf' => array('Crossbbset', 'r', 'crossbbcg/admin.config/index', 'conf-icon', '', 0, 1,
            array(
                'Save' => array(-1, 'crossbbcg/admin.config/save/act/index', '', '', '', 1, '', ''),
            )
        ),
        'Syncconf' => array('Crossbbset', 'r', 'crossbbcg/admin.config/sync', 'push-icon', '', 1, 1,
            array(
                'Save' => array(-1, 'crossbbcg/admin.config/save/act/index', '', '', '', 1, '', ''),
            )
        ),
        'Bbcnavs' => array('Crossbbset', 'r', 'crossbbcg/admin.nav/index', 'earth-icon', '', 2, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.nav/add', '', 780, 500, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.nav/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(2, 'crossbbcg/admin.nav/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.nav/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.nav/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.nav/edit', '', 780, 500, 1, '', ''),
            )
        ),
        
        'Sendaddr' => array('Crossbbset', 'r', 'crossbbcg/admin.sendaddr/index', 'domain-icon', '', 3, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.sendaddr/add', '', 600, 575, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.sendaddr/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(2, 'crossbbcg/admin.sendaddr/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.sendaddr/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.sendaddr/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.sendaddr/edit', '', 600, 575, 1, '', ''),
            )
        ),
        
        'Payment' => array('Crossbbset', 'r', 'crossbbcg/admin.payment/index', 'pay-icon', '', 4, 1,
            array(
                'Sort' => array(2, 'crossbbcg/admin.payment/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.payment/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.payment/disable', '', '', '', '', '', 'ids'),
                'Setting' => array(-1, 'crossbbcg/admin.payment/setting', '', 630, 455, 1, '', ''),
            )
        ),
        // 跨境电商BBC,商品管理
        'Bbcggoodsys' => array('Crossbbcg', 'l', 'crossbbcg/admin.index/index', '', '', 1, 1),
        'Bbcggoods' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.index/index', 'list-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.index/add', '', 1024, 710, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.index/delete', '', '', '', '', '', 'ids'),
                'Import' => array(2, 'crossbbcg/admin.index/import', '', 440, 280, 1, '', ''),
                'Export' => array(3, 'crossbbcg/admin.index/export', 'btn-danger ajax-get', 840, 680, 1, '', ''),
                'Sort' => array(-1, 'crossbbcg/admin.index/sort', '', '', '', '', '', 'sorts'),
                'Goodupe' => array(-1, 'crossbbcg/admin.index/upe', '', '', '', '', '', 'ids'),
                'Goodup' => array(-1, 'crossbbcg/admin.index/up', '', '', '', '', '', 'ids'),
                'Gooddown' => array(-1, 'crossbbcg/admin.index/down', '', '', '', '', '', 'ids'),
                'Goodwait' => array(-1, 'crossbbcg/admin.index/wait', '', '', '', '', '', 'ids'),
                'Goodwaite' => array(-1, 'crossbbcg/admin.index/waite', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.index/edit', '', 1024, 768, 1, '', ''),
            )
        ),
        
        'Bbccat' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.category/index', 'cat-icon', '', 1, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.category/add', '', 900, 500, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.category/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(-1, 'crossbbcg/admin.category/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(-1, 'crossbbcg/admin.category/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(-1, 'crossbbcg/admin.category/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.category/edit', '', 900, 500, 1, '', ''),
                'Import' => array(5, 'crossbbcg/admin.category/import', '', 440, 280, 1, '', ''),
                'Export' => array(6, 'crossbbcg/admin.category/export', '', 440, 280, 1, '', ''),
            )
        ),
        'Brandlist' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.brand/index', 'parent-icon', '', 2, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.brand/add', '', 850, 510, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.brand/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(2, 'crossbbcg/admin.brand/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.brand/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.brand/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.brand/edit', '', 850, 510, 1, '', ''),
            )
        ),
        
        'Goods_Option' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.option/index', 'more-icon', '', 4, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.option/add', '', 600, 600, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.option/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(-1, 'crossbbcg/admin.option/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(-1, 'crossbbcg/admin.option/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(-1, 'crossbbcg/admin.option/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.option/edit', '', 600, 600, 1, '', ''),
            )
        ),
        'Goods_Attribute' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.attributegroup/index', 'cat-icon', '', 5, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.attributegroup/add', '', 700, 600, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.attributegroup/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(-1, 'crossbbcg/admin.attributegroup/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(-1, 'crossbbcg/admin.attributegroup/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(-1, 'crossbbcg/admin.attributegroup/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.attributegroup/edit', '', 700, 600, 1, '', ''),
            )
        ),
        'Goods_Search_Filter' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.filter/index', 'cat-icon', '', 6, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.filter/add', '', 500, 320, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.filter/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(-1, 'crossbbcg/admin.filter/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(-1, 'crossbbcg/admin.filter/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(-1, 'crossbbcg/admin.filter/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.filter/edit', '', 500, 320, 1, '', ''),
            )
        ),
        'Goods_Recycle' => array('Bbcggoodsys', 'r', 'crossbbcg/admin.index/recycle', 'cat-trash', '', 7, 1,
            array(
                'Restore' => array(1, 'crossbbcg/admin.index/restore', '', '', '', '', '', 'ids'),
                'Delete' => array(1, 'crossbbcg/admin.index/recycle_delete', '', '', '', '', '', 'ids'),
            )
        ),
        
        // 栏目管理
        'Bbcgcolumn' => array('Crossbbcg', 'l', 'crossbbcg/admin.column/index', '', '', 1, 1),
        'Bbcgcolumn_country' => array('Bbcgcolumn', 'r', 'crossbbcg/admin.column/index', 'country-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.column/add', '', 750, 460, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.column/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'crossbbcg/admin.column/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.column/disable', '', '', '', '', '', 'ids'),
            )
        ),
        
        'Bbcgsearcheng' => array('Crossbbcg', 'l', 'crossbbcg/admin.search/index', '', '', 1, 1),
        'Searcheng' => array('Bbcgsearcheng', 'r', 'crossbbcg/admin.search/config', 'search-icon', '', 0, 1,
            array(
                'Save' => array(0, 'crossbbcg/admin.search/save', '', '', '', 1, '', ''),
            )
        ),
        'Searchind' => array('Bbcgsearcheng', 'r', 'crossbbcg/admin.search/indexed', 'domain-icon', '', 1, 1,
            array(
                'Save' => array(0, 'crossbbcg/admin.search/save', '', '', '', 1, '', ''),
            )
        ),
        'Bbcsearch' => array('Bbcgsearcheng', 'r', 'crossbbcg/admin.search/index', 'list-icon', '', 2, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.search/add', '', 600, 570, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.search/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(2, 'crossbbcg/admin.search/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.search/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.search/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.search/edit', '', 600, 570, 1, '', ''),
            )
        ),
        'Gsehscount' => array('Bbcgsearcheng', 'r', 'crossbbcg/admin.count/index', 'report-icon', '', 3, 1,
            array(
                'Export' => array(1, 'crossbbcg/admin.express/export', '', 440, 280, 1, '', 'ids'),
                'Whole' => array(2, 'crossbbcg/admin.count/index', 'add-new', '', '', '', '', ''),
            ),
        ),
        
        'Offlinesys' => array('Crossbbcg', 'l', 'crossbbcg/admin.offline/index', '', '', 4, 1),
        'Offline' => array('Offline', 'r', 'crossbbcg/admin.offline/index', 'shop-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.offline/add', '', 1024, 680, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.offline/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(2, 'crossbbcg/admin.offline/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.offline/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.offline/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.offline/edit', '', 1024, 680, 1, '', ''),
            )
        ),
        'Offdisrules' => array('Offline', 'r', 'crossbbcg/admin.offdisrules/index', 'rule-icon', '', 1, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.offdisrules/add', '', 680, 580, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.offdisrules/delete', '', '', '', '', '', 'ids'),
                'Sort' => array(2, 'crossbbcg/admin.offdisrules/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'crossbbcg/admin.offdisrules/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.offdisrules/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.offdisrules/edit', '', 680, 580, 1, '', ''),
            )
        ),
        'Offdisconf' => array('Offline', 'r', 'crossbbcg/admin.config/offline', 'conf-icon', '', 2, 1,
            array(
                'Save' => array(-1, 'crossbbcg/admin.config/save/act/offline', '', '', '', 1, '', ''),
            )
        ),
        
        'Reportlist' => array('Crossbbcg', 'l', 'crossbbcg/admin.report/index', '', '', 6, 1),
        'Reportbbcg' => array('Reportlist', 'r', 'crossbbcg/admin.report/index', 'report-icon', '', 0, 1,
            array(
                'Export' => array(1, 'crossbbcg/admin.report/export?type=bbcg', '', 440, 280, 1, '', 'ids'),
                'Whole' => array(2, 'crossbbcg/admin.report/index', 'btn-refresh', '', '', '', '', ''),
            ),
        ),
        'Reportgoods' => array('Reportlist', 'r', 'crossbbcg/admin.report/goods', 'list-icon', '', 1, 1,
            array(
                'Export' => array(1, 'crossbbcg/admin.report/export?type=goods', '', 440, 280, 1, '', 'ids'),
                'Whole' => array(2, 'crossbbcg/admin.report/goods', 'btn-refresh', '', '', '', '', ''),
            ),
        ),
        'Reportorder' => array('Reportlist', 'r', 'crossbbcg/admin.report/order', 'curr-icon', '', 2, 1,
            array(
                'Export' => array(1, 'crossbbcg/admin.report/export?type=order', '', 440, 280, 1, '', 'ids'),
                'Whole' => array(2, 'crossbbcg/admin.report/order', 'btn-refresh', '', '', '', '', ''),
            ),
        ),
        'Reportshop' => array('Reportlist', 'r', 'crossbbcg/admin.report/shop', 'otoshop-icon', '', 3, 1,
            array(
                'Export' => array(1, 'crossbbcg/admin.report/export?type=shop', '', 440, 280, 1, '', 'ids'),
                'Whole' => array(2, 'crossbbcg/admin.report/shop', 'btn-refresh', '', '', '', '', ''),
            ),
        ),
        'Advertising' => array('Crossbbcg', 'l', 'crossbbcg/admin.advertising/index', '', '', 6, 1),
        'Advertiselist' => array('Advertising', 'r', 'crossbbcg/admin.advertising/index', 'otoshop-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.advertising/add', '', 880, 450, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.advertising/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'crossbbcg/admin.advertising/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.advertising/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.advertising/edit', '', 640, 500, 1, '', ''),
            )
        ),
        'AdvertisePosi' => array('Advertising', 'r', 'crossbbcg/admin.adposition/index', 'curr-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.adposition/add', '', 580, 465, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.adposition/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'crossbbcg/admin.adposition/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.adposition/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.adposition/edit', '', 580, 465, 1, '', ''),
            )
        ),
        'Goods_Advertising' => array('Advertising', 'r', 'crossbbcg/admin.goodsad/index', 'list-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'crossbbcg/admin.goodsad/add', '', 880, 568, 1, '', ''),
                'Delete' => array(1, 'crossbbcg/admin.goodsad/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'crossbbcg/admin.goodsad/enable', '', '', '', '', '', 'ids'),
                'Disable' => array(4, 'crossbbcg/admin.goodsad/disable', '', '', '', '', '', 'ids'),
                'Edit' => array(-1, 'crossbbcg/admin.goodsad/edit', '', 640, 500, 1, '', ''),
            )
        )
    ),
);