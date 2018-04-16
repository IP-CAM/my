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
        'name' => 'Seller',
        'title' => '商家平台',
        'icon' => '',
        'icon_color' => '',
        'image' => 'seller.png',
        'description' => '多用户商家入驻平台',
        'author' => 'Runtuer',
        'website' => 'http://www.runtuer.com',
        'version' => '1.0.0',
        'depends' => array(
            'Admin' => '1.0.0',
        ),
        'upgrade' => '/cmfup/ver.php',     //升级地址
        //依赖扩展
        'extend' => array(),
    ),
    
    // 商户中心导航
    'user_nav' => array(
        //首页
        'sIndex' => array('', 'l', 'seller/index/index', 'fa-dashboard', '', 1, 1),
        
        //订单管理
        'sOrder' => array('', 'l', '', 'fa-files-o', '', 1, 1),
            /**
             * '节点名' =>array('父节点'， '位置', 'url'， '列表图标 css class', 'data-width=200','data-height="620"', 是否权限控制,下级按钮),
             * 下级按钮：可选
             * 是否权限控制 ：1，是，0：否
             **/
            'OrderList'=>array('sOrder', 'l', 'seller/order/index', 'fa-circle-o', '', 1, 1,
                array(
                /**
                 * '按钮名' =>array('排序'， 'url', 'css class'， 'data-width=200', 'data-height="620"','data-showbar="1"', 'target_form='ids'', '按钮图标',是否权限控制),
                 * 排序：-1隐藏 1排序值
                 * 是否权限控制 ：1，是，0：否
                 **/
                  //'OrderDel'  => array(-1, 'seller/order/del', '', '', '', '','','','fa-circle-o',1),
                  //'OrderInfo' => array(-1, 'seller/order/info', '', '', '', '','','','fa-circle-o',1),
                  //'IdNumber'  => array(-1, 'seller/order/idnumber', '', '', '', '','','','fa-circle-o',1),
                  'Export'    => array(1, 'seller/order/export', '','', '', 1, '','','',1),
                  'OrderDel'  => array(-1, 'seller/order/del', '', '', '', '','','','fa-circle-o',1),
                  'OrderInfo' => array(-1, 'seller/order/info', '', '', '', '','','','fa-circle-o',1),
                  'IdNumber'  => array(-1, 'seller/order/idnumber', '', '', '', '','','','fa-circle-o',1),
                )
            ),
            'OrderCancel'=>array('sOrder', 'l', 'seller/order/cancel', 'fa-circle-o', '', 1, 1,
                array(
                  'OrderInfo' => array(-1, 'seller/order/info', '', '', '', '','','','',1),
                  'OrderCancelInfo'  => array(-1, 'seller/order/cancel_info', '', '', '', '','','','',1),
                  'OrderEditCancel'  => array(-1, 'seller/order/edit_cancel', '', '', '', '','','','',1),
                )
            ),
            'TransportTpl'=>array('sOrder', 'l', 'seller/transport/index', 'fa-circle-o', '', 1, 1,
                array(
                  'Addnew' => array(1, 'seller/transport/add', '', '', '', '1','','','',1),
                  'Delete' => array(1, 'seller/transport/del', '', '', '', '1','','','',1),
                    'Enable'=>array(1,'seller/account/enable','', '', '', '','del','ids','',1),
                    'Disable'=>array(1,'seller/account/disable','', '', '', '','del','ids','',1),
                )
            ),
            'TransportExpress'=>array('sOrder', 'l', 'seller/transport/express', 'fa-circle-o', '', 1, 1,
                array(
                  //'OrderDel'  => array(-1, 'seller/order/del', '', '', '', '','','','fa-circle-o',1),
                  //'OrderInfo' => array(-1, 'seller/order/info', '', '', '', '','','','fa-circle-o',1),
                  //'IdNumber'  => array(-1, 'seller/order/idnumber', '', '', '', '','','','fa-circle-o',1),
                )
            ),
        
        //商品管理
        'sGoods'=> array('', 'l', '', 'fa-th', '', 1, 1),
            //商品列表
            'GoodsList'=>array('sGoods', 'l', 'seller/goods/index', 'fa-circle-o', '', 1, 1,
                array(
                  'Addnew' => array(1, 'seller/goods/add', '', '', '', 1,'','','',1),
                  //'Edit'   => array(-1, 'seller/goods/edit', '', '', '', '','','','',1),
                  'Delete' => array(2, 'seller/goods/del_goods', '','', '', '','','ids','',1),
                  'Import' => array(3, 'seller/goods/import', '','', '', 1, '','','',1),
                  'Export' => array(4, 'seller/goods/export', '','', '', 1, '','','',1),
                )
            ),
            //库存预警
            'Stockwarming'=>array('sGoods', 'l', 'seller/goods/stockwarming', 'fa-circle-o', '', 1, 1,
                array(
                  'Edit'   => array(-1, 'seller/goods/edit', '', '', '', '','','','',1),
                  'Delete' => array(2, 'seller/goods/del_goods', '','', '', '','','ids','',1),
                  'Import' => array(3, 'seller/goods/import', '','', '', 1, '','','',1),
                  'Export' => array(4, 'seller/goods/export', '','', '', 1, '','','',1),
                )
            ),
            //店铺分类
            'GoodsCategory'=>array('sGoods','l','seller/category/index','fa-circle-o','fa-circle-o',1,1,
                array(
                  'Addnew' => array(1, 'seller/category/add', '', '500', '350', 1,'','','',1),
                  'Delete' => array(2, 'seller/category/del', '','', '', '','','ids','',1),
                )
            ),
        
        //售后服务
        'sService' => array('', 'l', '', 'fa-pie-chart', '', 1, 1),
            //退换货
            'ChangeOrRefund'=>array('sService','l','seller/order/after_sale','fa-circle-o','',1,1,
                    array(
                        'after_sale_info' => array(-1, 'seller/order/after_sale_info', '', '', '', 1,'','','',1)
                    )
            ),
            //商品评价
            'GoodsComment'=>array('sService','l','seller/comment/index','fa-circle-o','',1,1,
                array(
                
                )
            ),
            //商品咨询
            'GoodsConsult'=>array('sService','l','seller/consult/index','fa-circle-o','',1,1,
                array(
                
                )
            ),
        
        //店铺管理
        'sStore' => array('', 'l', '', 'fa-bank', '', 1, 1),
            //店铺设置
            'StoreSetting'=>array('sStore','l','seller/shop/index','fa-circle-o','fa-circle-o',1,1,
                array(
                  'Addnew'=>array(1,'seller/shideshow/add','', 770, 410, 1,'','','',1),
                  'Delete'=>array(1,'seller/shideshow/del','', 494, 380, 1,'','ids','',1),
                )
            ),
            //经营类目
            'BusinessCate'=>array('sStore','l','seller/shop/cate','fa-circle-o','fa-circle-o',1,1,
                array(
                  'Addnew'=>array(1,'seller/shop/cat_add','', 495, 380, 1,'','','',1),
                  'Delete'=>array(1,'seller/shop/del_cat','', '', '', 1,lang('del'),'ids','',1),
                )
            ),
            //店铺信息
            'StoreInfo'=>array('sStore','l','seller/shop/infomation','fa-circle-o','',1,1,
                array(
            
                )
            ),
            'Authsafe'=>array('sStore','l','seller/authsafe/index','fa-circle-o','',1,1,
                array(
                    'Save'=>array(-1,'seller/authsafe/save','', '', '', 1,'','','',1),
                )
            ),
        
        //营销中心
        'sMarketing'=>array('', 'l', '', 'fa-tags', '', 1, 1),
            //店铺设置
            'Fullminus'=>array('sMarketing','l','seller/fullminus/index','fa-circle-o','fa-circle-o',1,1,
                array(
                    'Addnew'=>array(1,'seller/fullminus/add','', 494, 380, 1,'','','',1),
                    'Delete'=>array(1,'seller/fullminus/del','', 494, 380, 1,'','','',1),
                )
            ),
            //经营类目
            'Fulldiscount'=>array('sMarketing','l','seller/fulldiscount/index','fa-circle-o','fa-circle-o',1,1,
                array(
                    'Addnew'=>array(1,'seller/fulldiscount/add','', 494, 494, 1,'','','',1),
                    'Delete'=>array(1,'seller/fulldiscount/del','', '', '', 1,'','ids','',1),
                )
            ),
            //优惠劵管理
            'sCoupon'=>array('sMarketing','l','seller/coupon/index','fa-circle-o','',1,1,
                array(
                    'Addnew'  => array(1, 'seller/coupon/add', '', 820, 416, 1, '', '','',1),
                    'Delete'  => array(2, 'seller/coupon/delete', '', '', '', '', '', 'ids','',1),
                    'Enable'  => array(3, 'seller/coupon/enable', '', '', '', '', '', 'ids','',1),
                    'Disable' => array(4, 'seller/coupon/disable', '', '', '', '', '', 'ids','',1),
                    'Edit'    => array(-1, 'seller/coupon/edit', '', '', '', '', '', '','',1),
                )
            ),
            'Xydiscount'=>array('sMarketing','l','seller/xydiscount/index','fa-circle-o','',1,1,
                array(
                    'Addnew'  => array(1, 'seller/xydiscount/add', '', 820, 416, 1, '', '','',1),
                    'Delete'  => array(2, 'seller/xydiscount/delete', '', '', '', '', '', 'ids','',1),
                    'Enable'  => array(3, 'seller/xydiscount/enable', '', '', '', '', '', 'ids','',1),
                    'Disable' => array(4, 'seller/xydiscount/disable', '', '', '', '', '', 'ids','',1),
                    'Edit'    => array(-1, 'seller/xydiscount/edit', '', '', '', '', '', '','',1),
                )
            ),
            'Registered'=>array('sMarketing','l','seller/registered/index','fa-circle-o','',1,1,
                array(
                    'Addnew'  => array(1, 'seller/registered/add', '', 820, 416, 1, '', '','',1),
                    'Delete'  => array(2, 'seller/registered/delete', '', '', '', '', '', 'ids','',1),
                    'Enable'  => array(3, 'seller/registered/enable', '', '', '', '', '', 'ids','',1),
                )
            ),
            'sPackage'=>array('sMarketing','l','seller/package/index','fa-circle-o','',1,1,
                array(
                    'Addnew'  => array(1, 'seller/package/add', '', 820, 416, 1, '', '','',1),
                    'Delete'  => array(2, 'seller/package/delete', '', '', '', '', '', 'ids','',1),
                    'Enable'  => array(3, 'seller/package/enable', '', '', '', '', '', 'ids','',1),
                    'Disable' => array(4, 'seller/package/disable', '', '', '', '', '', 'ids','',1),
                    'Edit'    => array(-1, 'seller/package/edit', '', '', '', '', '', '','',1),
                )
            ),
            'sGift'=>array('sMarketing','l','seller/gift/index','fa-circle-o','',1,1,
                array(
                    'Addnew'  => array(1, 'seller/gift/add', '', 820, 416, 1, '', '','',1),
                    'Delete'  => array(2, 'seller/gift/delete', '', '', '', '', '', 'ids','',1),
                    'Enable'  => array(3, 'seller/gift/enable', '', '', '', '', '', 'ids','',1),
                    'Disable' => array(4, 'seller/gift/disable', '', '', '', '', '', 'ids','',1),
                    'Edit'    => array(-1, 'seller/gift/edit', '', '', '', '', '', '','',1),
                )
            ),
            'sVoucher'=>array('sMarketing','l','seller/gift/index','fa-circle-o','',1,1,
                array(
                    'Export'  => array(1, 'seller/gift/export', '', 440, 280, 1, '', '','',1),
                )
            ),
        
        
        //结算管理
        'sSettle'=>array('', 'l', '', 'fa-table', '', 1, 1),
            //结算记录
            'SettleRecord'=>array('sSettle','l','seller/settle/index','fa-circle-o','',1,1,
                array(
            
                )
            ),
            //结算记录
            'SettleInfo'=>array('sSettle','l','seller/settle/info','fa-circle-o','',1,1,
                array(
                
                )
            ),
        
        //统计

        'sStatistics'=>array('', 'l', '', 'fa-area-chart', '', 1, 1),
           'Sysstat'=>array('sStatistics','l','seller/statistics/index','fa-circle-o','',1,1,array()),
           'Stattrade'=>array('sStatistics','l','seller/statistics/trade','fa-circle-o','',1,1, array()),
           'Goodstrade'=>array('sStatistics','l','seller/statistics/strade','fa-circle-o','',1,1,array()),
           'Aftersales'=>array('sStatistics','l','seller/statistics/aftersales','fa-circle-o','',1,1, array()),
           'Traffic'=>array('sStatistics','l','seller/statistics/traffic','fa-circle-o','',1,1, array()),
        //账号
        'sAccount'=>array('', 'l', '', 'fa-user-secret', '', 1, 1),
            //账号管理
            'AccountManage'=>array('sAccount','l','seller/account/index','fa-circle-o','',1,1,
                array(
                  'Addnew'=>array(1,'seller/account/add','', 650, 560, 1,'','','fa-plus',1),
                  'Delete'=>array(1,'seller/account/delete','', '', '', '','del','ids','fa-close',1),
                  'Enable'=>array(1,'seller/account/enable','', '', '', '','del','ids','',1),
                  'Disable'=>array(1,'seller/account/disable','', '', '', '','del','ids','',1),
                  //'Edit'=>array(1,'seller/account/edit','', '', '', '','del','ids','fa-circle-o',1),
                )
            ),
            //角色管理
            'RoleManage'=>array('sAccount','l','seller/role/index','fa-circle-o','',1,1,
                array(
                  'Addnew'  =>array(1,'seller/role/add','', 650, 560, 1,'','','fa-plus',1),
                  'Delete'  =>array(2,'seller/role/del','', '', '', '','','ids','fa-close',1),
                  'Edit'    =>array(-1,'seller/role/edit','', '', '', '','del','ids','fa-circle-o',1),
                  'Enable'  => array(3, 'seller/role/enable', '', '', '', '', '', 'ids','',1),
                  'Disable' => array(4, 'seller/role/disable', '', '', '', '', '', 'ids','',1),
               )
            ),
            //操作日志
            'SellerLog'=>array('sAccount','l','seller/log/index','fa-circle-o','',1,1,
                array(
                    //'Delete'   =>array(1,'seller/log/del','', '', '', '','','ids','fa-circle-o',1),
                    //'Clearup'  => array(2, 'seller/log/clear', '','', '', 1, '','','',1),
                )
            ),
    ),
    
    // 模块配置
    'config' => array(),
    
    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
         * '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
         * 位置：l:左路，r：右，h：隐藏
         * 是否权限控制 ：1，是，0：否
         **/
        'Seller' => array('', 'l', 'seller/admin.config/protocol', 'seller.png', '', 1, 1),
        'Shopaccount' => array('Seller', 'l', 'seller/admin.account/index', '', '', 1, 1),
          'Shopsuser' => array('Shopaccount', 'r', 'seller/admin.account/index', 'addons-icon', '', 0, 1,
             array(
                  'Addnew' => array(0, 'seller/admin.account/add', '', 820, 416, 1, '', ''),
                  'Delete' => array(1, 'seller/admin.account/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(3, 'seller/admin.account/enable', '', '', '', '', '', 'ids'),
                  'Disable' => array(4, 'seller/admin.account/disable', '', '', '', '', '', 'ids'),
                  'Edit' => array(-1, 'seller/admin.account/edit', '', 580, 500, 1, '', ''),
              )
          ),
          'Shopsfd' => array('Shopaccount', 'r', 'seller/admin.feedback/index', 'log-icon', '', 3, 1,
               array(
                 'Delete' => array(1, 'seller/admin.feedback/delete', '', '', '', '', '', 'ids'),
                 'Edit' => array(-1, 'seller/admin.feedback/edit', '', 640, 500, 1, '', ''),
             )
          ),
          'Sprotocol' => array('Shopaccount', 'r', 'seller/admin.config/protocol', 'protocol-icon', '', 2, 1,
              array(
                 'Save' => array(1, 'seller/admin.config/save', 'add-new ajax-post', '', '', '', '', 'contents'),
              )
          ),
          'Offshop' => array('Shopaccount', 'r', 'seller/admin.offshop/index', 'uu-icon', '', 4, 1,
              array(
                 'Addnew' => array(0, 'seller/admin.offshop/add', '', 820, 442, 1, '', ''),
                 'Delete' => array(1, 'seller/admin.offshop/delete', '', '', '', '', '', 'ids'),
                 'Enable' => array(3, 'seller/admin.offshop/enable', '', '', '', '', '', 'ids'),
                 'Disable' => array(4, 'seller/admin.offshop/disable', '', '', '', '', '', 'ids'),
                 'Edit' => array(-1, 'seller/admin.offshop/edit', '', 820, 768, 1, '', ''),
             )
          ),
          'Shopstpl' => array('Shopaccount', 'r', 'seller/admin.shoptpl/index', 'tpl-icon', '', 5, 1,
              array(
                  'Addnew' => array(0, 'seller/admin.shoptpl/add', '', 570, 367, 1, '', ''),
                  'Delete' => array(1, 'seller/admin.shoptpl/delete', '', '', '', '', '', 'ids'),
                  'Edit' => array(-1, 'seller/admin.shoptpl/edit', '', 1024, 768, 1, '', ''),
              )
          ),
    
        'Sellershops' => array('Seller', 'l', 'seller/admin.index/index', '', '', 2, 1),
          'Shops' => array('Sellershops', 'r', 'seller/admin.index/index', 'list-icon', '', 1, 1,
              array(
                 'Addnew' => array(0, 'seller/admin.index/add', '', 430, 275, 1, '', ''),
                 'Delete' => array(1, 'seller/admin.index/delete', '', '', '', '', '', 'ids'),
                 'Enable' => array(3, 'seller/admin.index/enable', '', '', '', '', '', 'ids'),
                 'Disable' => array(4, 'seller/admin.index/disable', '', '', '', '', '', 'ids'),
                 'Edit' => array(-1, 'seller/admin.index/edit', '', 580, 500, 1, '', ''),
              )
          ),
          'Shopscat' => array('Sellershops', 'r', 'seller/admin.shopcat/index', 'cat-icon', '', 2, 1,
              array(
                  'Addnew' => array(0, 'seller/admin.shopcat/add', '', 640, 410, 1, '', ''),
                  'Delete' => array(1, 'seller/admin.shopcat/delete', '', '', '', '', '', 'ids'),
                  'Sort' => array(2, 'seller/admin.shopcat/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'seller/admin.shopcat/enable', '', '', '', '', '', 'ids'),
                  'Disable' => array(4, 'seller/admin.shopcat/disable', '', '', '', '', '', 'ids'),
                  'Edit' => array(-1, 'seller/admin.shopcat/edit', '', 640, 500, 1, '', ''),
              )
          ),
          'Shopset' => array('Sellershops', 'r', 'seller/admin.config/index', 'conf-icon', '', 3, 1,
              array(
                'Save' => array(1, 'seller/admin.config/save', '', '', '', '', '', ''),
              )
          ),
          'Business_category'=>array('Sellershops', 'r', 'seller/admin.shopcat/shop_cate', 'list-icon', '', 3, 1,
              array(
                  'Enable' => array(3, 'seller/admin.shopcat/cate_pass', '', '', '', '', '', 'ids'),
                  'Disable' => array(4, 'seller/admin.shopcat/cate_fail', '', '', '', '', '', 'ids'),
              )
              ),
         
    
        'Enterapplylist' => array('Seller', 'l', 'seller/admin.enter/index', '', '', 2, 1),
          'Enterapply'   => array('Enterapplylist', 'r', 'seller/admin.enter/index', 'uu-icon', '', 1, 1,
              array(
                 'Delete' => array(1, 'seller/admin.enter/delete', '', '', '', '', '', 'ids'),
                 'Enable' => array(3, 'seller/admin.enter/enable', '', '', '', '', '', 'ids'),
              )
          ),
        
        'Settlement' => array('Seller', 'l', 'seller/admin.count/index', '', '', 2, 1),
            'sCounts'=> array('Settlement', 'r', 'seller/admin.count/index', 'curr-icon', '', 0, 1,
                array(
                    'confirm_settle' => array(1, 'seller/admin.count/confirm', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
                    'Delete' => array(1, 'seller/admin.count/delete', '', '', '', '', '', 'ids'),
                )
            ),
            'sDetail' => array('Settlement', 'r', 'seller/admin.count/detail', 'cat-icon', '', 1, 1),
        
        'Sellersource' => array('Seller', 'l', 'seller/admin.source/index', '', '', 3, 1),
            'Goodsurc'=> array('Sellersource', 'r', 'seller/admin.source/index', 'list-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'seller/admin.source/add', '', 740, 538, 1, '', ''),
                    'Delete' => array(1, 'seller/admin.source/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'seller/admin.source/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'seller/admin.source/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.source/edit', '', 740, 538, 1, '', ''),
                )
            ),
            'Sellersurc'=> array('Sellersource', 'r','seller/admin.companys/index', 'uu-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'seller/admin.companys/add', '', 740, 538, 1, '', ''),
                    'Delete' => array(1, 'seller/admin.companys/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'seller/admin.companys/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'seller/admin.companys/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.companys/edit', '', 740, 538, 1, '', ''),
                )
            ),
            'Channelsurc'=> array('Sellersource', 'r','seller/admin.channel/index', 'cat-icon','', 2, 1,
                array(
                    'Addnew' => array(0, 'seller/admin.channel/add', '', 740, 538, 1, '', ''),
                    'Delete' => array(1, 'seller/admin.channel/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'seller/admin.channel/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'seller/admin.channel/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.channel/edit', '', 740, 538, 1, '', ''),
                )
            ),
            'Warehsurc'=> array('Sellersource', 'r','seller/admin.wareh/index', 'db-icon','', 3, 1,
                array(
                    'Addnew' => array(0, 'seller/admin.wareh/add', '', 740, 538, 1, '', ''),
                    'Delete' => array(1, 'seller/admin.wareh/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'seller/admin.wareh/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'seller/admin.wareh/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.wareh/edit', '', 740, 538, 1, '', ''),
                )
            ),
            'Expresssurc'=> array('Sellersource', 'r','seller/admin.express/index', 'logistics-icon','', 4, 1,
                array(
                    'Addnew' => array(0, 'seller/admin.express/add', '', 740, 538, 1, '', ''),
                    'Delete' => array(1, 'seller/admin.express/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'seller/admin.express/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'seller/admin.express/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.express/edit', '', 740, 538, 1, '', ''),
                )
            ),
    )
);