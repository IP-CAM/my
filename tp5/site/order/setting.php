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
        'name'        => 'Order',
        'title'       => '订单管理',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'order.png',
        'description' => '统一订单管理系统，支撑该框架下的所有平台订单业务',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'depends' => array(
            'Admin'   => '1.0.0',
        ),
        'required' => array(    //必须为其中之一
            'B2c'     => '1.0.0',
            'B2b2c'   => '1.0.0',
        ),
        'upgrade'     => '/cmfup/ver.php',     //升级地址
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
        'Ordersys'       => array('','l', 'order/admin.index/index', 'order.png', '', 1, 1),
          'Order'        => array('Ordersys','l', 'order/admin.index/index', '', '', 0, 1),
            'Orderlist'  => array('Order','r', 'order/admin.index/index', 'list-icon', '', 0, 1,
                array(
                  'AddnewOrd' => array(0, 'order/admin.index/add', 'add-new ajax-get', 1024, 600, 1, '', ''),
                  'Export'    => array(1, 'order/admin.index/export','',440, 280, 1,'','ids'),
                  'Edit'      => array(-1, 'order/admin.index/edit','',440, 280, 1,'',''),
                  'Modify'    => array(-1, 'order/admin.index/modify','',490, 780, 1,'',''),
                ),
            ),
            'Ocancel' => array('Order','r', 'order/admin.ocancel/index', 'reback-icon', '', 2, 1,
                array(
                    'Whole'  => array(0, 'order/admin.ocancel/index', 'add-new', '', '', '', '', ''),
                    'Export' => array(1, 'order/admin.ocancel/export','',440, 280, 1,'','ids'),
                    'Undo'   => array(-1, 'order/admin.ocancel/undo', '', '', '', '', '', ''),
                    'View'   => array(-1, 'order/admin.ocancel/view', '', 440, 280, '', '', ''),
                ),
            ),
            'Delivery' => array('Order','r', 'order/admin.delivery/index', 'log-icon', '', 3, 1,
                array(
                    'Whole'  => array(0, 'order/admin.delivery/index', 'add-new', '', '', '', '', ''),
                    'Export' => array(1, 'order/admin.delivery/export','',440, 280, 1,'','ids'),
                    'View'   => array(-1, 'order/admin.ocancel/view', '', 440, 280, '', '', ''),
                ),
            ),
            'Predepositpay'=> array('Order','r','order/admin.predeposit/index','count-icon','',4,1,
                array(
                    'Delete' => array(1, 'order/admin.predeposit/delete', '', '', '', '', '', 'ids'),
                    'Export' => array(2, 'order/admin.predeposit/export','',440, 280, 1,'','ids'),
                ),
            ),
            'Cooperative'=> array('Order','r','order/admin.operative/index','uu-icon','',5,1,
                array(
                    'Addnew' => array(0, 'order/admin.operative/add', '', 730, 530, 1, '', ''),
                    'Delete' => array(1, 'order/admin.operative/delete', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'order/admin.operative/edit', '', 730, 530, 1, '', ''),
                    'Enable' => array(2, 'order/admin.operative/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'order/admin.operative/disable', '', '', '', '', '', 'ids'),
                ),
            ),
        
        'Servicesys'    => array('Ordersys','l', 'order/admin.afterservice/index', '', '', 2, 1),
          'Servicerlist'=> array('Servicesys','r', 'order/admin.afterservice/index', 'list-icon', '', 0, 1,
              array(
                  'sEnable' => array(-1, 'order/admin.afterservice/enable', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
                  'sDisable'=> array(2, 'order/admin.afterservice/refuse', 'btn-back ajax-post', '', '', '', '', 'ids'),
                  'Export'  => array(3, 'order/admin.afterservice/export','',440, 280, 1,'','ids'),
              ),
		   ),
    
          'Complaint'=> array('Servicesys','r', 'order/admin.complaint/index', 'sms-icon', '', 2, 1,
              array(
                'Closedcomp' => array(1, 'order/admin.complaint/close','btn-back ajax-post','', '', 1,'','ids'),
                'Cancelcomp' => array(2, 'order/admin.complaint/cancel','btn-refresh ajax-post','', '', 1,'','ids'),
                'Export' => array(3, 'order/admin.complaint/export','',440, 280, 1,'','ids'),
                'Docomp' => array(-1, 'order/admin.complaint/docomp','',440, 280, 1,'','ids'),
              ),
          ),
        
         'Servicecnf'=> array('Servicesys','r', 'order/admin.service/config', 'conf-icon', '', 5, 1),
            'Reason' => array('Servicecnf','r', 'order/admin.reason/index', 'cat-icon', '', 6, 1,
				 array(
					  'Addnew' => array(0, 'order/admin.reason/add', '', 730, 530, 1, '', ''),
					  'Delete' => array(1, 'order/admin.reason/delete', '', '', '', '', '', 'ids'),
                      'Enable' => array(2, 'order/admin.reason/enable', '', '', '', '', '', 'ids'),
                      'Disable'=> array(3, 'order/admin.reason/disable', '', '', '', '', '', 'ids'),
                      'Sort'   => array(4, 'order/admin.reason/sort', '', '', '', '', '', 'sorts'),
					  'Edit'   => array(-1, 'order/admin.reason/edit', '', '', '', 1, '', ''),
				  ),
			),
        
        'Oexchange'      => array('Ordersys','l', 'order/admin.exchange/index', '', '', 1, 1),
          'Exchangelist'=> array('Oexchange','r', 'order/admin.exchange/index', 'list-icon', '', 0, 1,
              array(
                  'Export' => array(1, 'order/admin.exchange/export','',440, 280, 1,'','ids'),
              ),
          ),
          'Exchangeconf'=> array('Oexchange','r', 'order/admin.exconf/index', 'conf-icon', '', 1, 1,
             array(
                'Newopt' => array(1, 'order/admin.exconf/add','',440, 280, 1,'','ids'),
             ),
          ),

        'DistributionSale'  => array('Ordersys','l', 'order/admin.financial/index', '', '', 1, 1),
          'Salespays'=> array('DistributionSale','r','order/admin.financial/index', 'list-icon', '', 1, 1,
              array(
                  'Whole'  => array(0, 'order/admin.financial/index', 'add-new', '', '', '', '', ''),
                  'Export' => array(1, 'order/admin.financial/export','',440, 280, 1,'','ids'),
                  'View'   => array(-1, 'order/admin.financial/view', '', 440, 280, '', '', ''),
              ),
          ),
          'Exprespays'=>array('DistributionSale','r','order/admin.exprespay/index','express-icon','', 2, 1,
              array(
                  'Whole'  => array(0, 'order/admin.exprespay/index', 'add-new', '', '', '', '', ''),
                  'Export' => array(1, 'order/admin.exprespay/export','',440, 280, 1,'','ids'),
                  'View'   => array(-1, 'order/admin.exprespay/view', '', 440, 280, '', '', ''),
              ),
          ),
          'Commission'=>array('DistributionSale','r','order/admin.commission/index','back-icon','', 3,1,
              array(
                  'Whole'  => array(0, 'order/admin.commission/index', 'add-new', '', '', '', '', ''),
                  'Export' => array(1, 'order/admin.commission/export','',440, 280, 1,'','ids'),
                  'View'   => array(-1, 'order/admin.commission/view', '', 440, 280, '', '', ''),
              ),
          ),
          'Rebate'    => array('DistributionSale','r', 'order/admin.rebate/index', 'cat-icon', '', 4, 1,
              array(
                  'Whole'  => array(0, 'order/admin.rebate/index', 'add-new', '', '', '', '', ''),
                  'Export' => array(1, 'order/admin.rebate/export','',440, 280, 1,'','ids'),
                  'View'   => array(-1, 'order/admin.rebate/view', '', 440, 280, '', '', ''),
              ),
          ),
          'Fincount'  => array('DistributionSale','r', 'order/admin.report/index', 'curr-icon', '', 5, 1,
              array(
                  'Whole'  => array(0, 'order/admin.report/index', 'add-new', '', '', '', '', ''),
                  'Export' => array(1, 'order/admin.report/export','',440, 280, 1,'','ids'),
              ),
          ),
        
        'Statistics' => array('Ordersys','l', 'order/admin.statistics/index', '', '', 1, 1),
          'Onecount' => array('Statistics','r','order/admin.statistics/index','report-icon', '', 0, 1,
              array(
                'Export'  => array(0, 'order/admin.statistics/export', '', '', '', '', '', ''),
              )
          ),
          'Catcount' => array('Statistics','r', 'order/admin.statistics/cat', 'cat-icon', '', 1, 1),
          'Areacount'=> array('Statistics','r', 'order/admin.statistics/area', 'earth-icon', '', 3, 1),
          'Skucount' => array('Statistics','r', 'order/admin.statistics/sku', 'level-icon', '', 4, 1),
          'Snscount' => array('Statistics','r', 'order/admin.statistics/sns', 'uu-icon', '', 5, 1),
          'Shopcount'=> array('Statistics','r', 'order/admin.statistics/shop', 'shop-icon', '', 6, 1),

        'Supplierord'=> array('Ordersys','l', 'order/admin.supplier/index', '', '', 99, 1),
          'Supplier' => array('Supplierord','r','order/admin.supplier/index','uu-icon','',0, 1,
              array(
                  'Addnewsup'=> array(0, 'order/admin.supplier/add', 'add-new ajax-get add', 630, 455, 1, '', ''),
                  'Tovoid'   => array(1, 'order/admin.supplier/disable', 'btn-danger ajax-post', '', '', '', '', 'ids'),
                  'Recovery' => array(2, 'order/admin.supplier/enable', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
              ),
          ),
          'Setsum' => array('Supplierord','r','order/admin.setsum/index','coll-icon','',1, 1,
              array(
                  'Whole'  => array(0, 'order/admin.setsum/index', 'add-new', '', '', '', '', ''),
                  'Export' => array(1, 'order/admin.ocancel/export','',440, 280, 1,'','ids'),
                  'View'   => array(-1, 'order/admin.ocancel/view', '', 440, 280, '', '', ''),
              ),
          ),

    ),
);