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
        'name'        => 'Statistics',
        'title'       => '统计&报表',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'dbs.png',

        //默认指向当前模块view/admin/static/image/app.png
        'description' => '用于统计，汇总各种统计数据进而形成报表，对各种交易数据统计分析',
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
        'DataStatistics'    => array('','l', 'statistics/admin.index/index', 'dbs.png','', 1, 1),
        'summaryOperations' => array('DataStatistics','l','statistics/admin.index/index','','',1,1),
            'GoodsTrade'=>array('summaryOperations','r','statistics/admin.index/index','','',1,1,
                array()),
            'tradeDataStatistics'=>array('DataStatistics','l','statistics/admin.index/trade_data','','',1,1),
                'tradeSummary'=>array('tradeDataStatistics','r','statistics/admin.index/trade_data','','',1,1,array()),
            
            'goodsRank'=>array('DataStatistics','l','statistics/admin.index/goods_rank','','',1,1),
                'salesVolumeRank'=>array('goodsRank','r','statistics/admin.index/goods_rank','','',1,1,
                    array()),
                'goodsSaleInfo'=>array('goodsRank','r','statistics/admin.index/goods_sale_info','','',1,1,
                    array()),
            'memberRank'=>array('DataStatistics','l','statistics/admin.index/member_statistics_rank','','',1,1),
                'memberStatisticsRank'=>array('memberRank','r','statistics/admin.index/member_statistics_rank','','',1,1,
                    array()),
                'memberTradeRank'=>array('memberRank','r','statistics/admin.index/member_rank','','',1,1,
                    array()),
            'storeStatistics'=>array('DataStatistics','l','statistics/admin.index/store_rank','','',1,1),
            'storeRank'=>array('storeStatistics','r','statistics/admin.index/store_rank','','',1,1,
                array()),
        
    ),
);