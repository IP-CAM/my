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
        'name'        => 'Promotion',
        'title'       => '促销系统',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'promotion.png',
        'description' => '促销系统：特价，天天特卖，团购，限时抢购等促销功能模块',
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
        'Promotion'   => array('','l', 'promotion/admin.freepostage/index','promotion.png','', 1, 1),
          'Promconf'  => array('Promotion','l','promotion/admin.diypromotion/index', '','', 1, 1),
            'Diyprolist'=>array('Promconf','r','promotion/admin.diypromotion/index','list-icon','',0,1,
                array(
                    'Addnew' => array(0,'promotion/admin.diypromotion/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1,'promotion/admin.diypromotion/delete','','','','','', 'ids'),
                    'Enable' => array(3,'promotion/admin.diypromotion/enable','','','','','','ids'),
                    'Disable'=> array(4,'promotion/admin.diypromotion/disable','','','','','','ids'),
                    'Edit'   => array(-1,'promotion/admin.diypromotion/edit','', 950, 600, 1,'',''),
                )
            ),
            'Regprom' =>array('Promconf','r','promotion/admin.regprom/index','reg-icon','', 1,'',''),
    
            'Dlyprom' => array('Promconf','r','promotion/admin.dlyprom/index','addons-icon','',2, 1,
                array(
                    'Addnew' => array(0, 'promotion/admin.dlyprom/add', '', 650, 475, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.dlyprom/delete','','', '', '', '', 'ids'),
                    'Enable' => array(3, 'promotion/admin.dlyprom/enable','', '', '','', '', 'ids'),
                    'Disable'=> array(4, 'promotion/admin.dlyprom/disable','','','', '', '', 'ids'),
                    'Edit'   => array(-1, 'promotion/admin.dlyprom/edit','', 650, 475, 1, '', ''),
                )
            ),
            'Dlypromconf'=>array('Promconf','r','promotion/admin.dlypromconf/index','conf-icon','',3,1,
                array(
                    'Addnew' => array(0, 'promotion/admin.dlypromconf/add', '', 650, 475, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.dlypromconf/delete','','', '','','', 'ids'),
                    'Enable' => array(3, 'promotion/admin.dlypromconf/enable','', '','','','', 'ids'),
                    'Disable'=> array(4, 'promotion/admin.dlypromconf/disable','','','','','', 'ids'),
                    'Edit'  => array(-1, 'promotion/admin.dlypromconf/edit','', 650, 475, 1, '', ''),
                )
            ),
        
        'Distribution'   => array('Promotion','l', 'promotion/admin.freepostage/index', '','', 1, 1),
            'Freepostage'=> array('Distribution','r', 'promotion/admin.freepostage/index', 'logistics-icon','', 1, 1,
                array(
                    'Addnew' => array(0,'promotion/admin.freepostage/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1,'promotion/admin.freepostage/delete','','','','','', 'ids'),
                    'Enable' => array(3,'promotion/admin.freepostage/enable','','','','','','ids'),
                    'Disable'=> array(4,'promotion/admin.freepostage/disable','','','','','','ids'),
                    'Edit'   => array(-1,'promotion/admin.freepostage/edit','', 950, 600, 1,'',''),
                ),
            ),
            'Fulldiscount'=> array('Distribution','r', 'promotion/admin.fulldiscount/index', 'fulldiscount-icon','', 2, 1,
                array(
                    'Addnew' => array(0,'promotion/admin.fulldiscount/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1,'promotion/admin.fulldiscount/delete','','','','','', 'ids'),
                    'Enable' => array(3,'promotion/admin.fulldiscount/enable','','','','','','ids'),
                    'Disable'=> array(4,'promotion/admin.fulldiscount/disable','','','','','','ids'),
                    'Edit'   => array(-1,'promotion/admin.fulldiscount/edit','', 950, 600, 1,'',''),
                ),
            ),
               'Fullminus'=> array('Distribution','r', 'promotion/admin.fullminus/index', 'more-icon','', 3, 1,
                   array(
                      'Addnew'=>array(0,'promotion/admin.fullminus/add', '', 950, 600, 1, '', ''),
                      'Delete'=>array(1,'promotion/admin.fullminus/delete','','','','','', 'ids'),
                      'Enable'=>array(3,'promotion/admin.fullminus/enable','','','','','','ids'),
                      'Disable'=>array(4,'promotion/admin.fullminus/disable','','','','','','ids'),
                      'Edit'  =>array(-1,'promotion/admin.fullminus/edit','', 950, 600, 1,'',''),
                   ),
               ),
              'Xydiscount'=> array('Distribution','r', 'promotion/admin.xydiscount/index', 'xy-icon','', 4, 1,
                  array(
                      'Addnew'=>array(0,'promotion/admin.xydiscount/add', '', 950, 600, 1, '', ''),
                      'Delete'=>array(1,'promotion/admin.xydiscount/delete','','','','','', 'ids'),
                      'Enable'=>array(3,'promotion/admin.xydiscount/enable','','','','','','ids'),
                      'Disable'=>array(4,'promotion/admin.xydiscount/disable','','','','','','ids'),
                      'Edit'  =>array(-1,'promotion/admin.xydiscount/edit','', 950, 600, 1,'',''),
                  ),
              ),
              'Package'=> array('Distribution','r', 'promotion/admin.package/index', 'package-icon','', 5, 1,
                  array(
                      'Addnew'=>array(0,'promotion/admin.package/add', '', 950, 600, 1, '', ''),
                      'Delete'=>array(1,'promotion/admin.package/delete','','','','','', 'ids'),
                      'Enable'=>array(3,'promotion/admin.package/enable','','','','','','ids'),
                      'Disable'=>array(4,'promotion/admin.package/disable','','','','','','ids'),
                      'Edit'  =>array(-1,'promotion/admin.package/edit','', 950, 600, 1,'',''),
                  ),
              ),
            'Reportdistri'=> array('Distribution','r','promotion/admin.report/distribution','report-icon','',9,1,
                array(
                    'Delete' => array(1, 'promotion/admin.report/delete','','', '', '', '', 'ids'),
                )
            ),
    
        'Rushsys' => array('Promotion','l', 'promotion/admin.rush/index','','', 0, 1),
          'Rush'=> array('Rushsys','r','promotion/admin.rush/index','coupons-icon','',0, 1,
            array(
                'Addnew'=>array(0,'promotion/admin.rush/add','',950, 600,1,'',''),
                'Delete'=>array(1,'promotion/admin.rush/delete','','', '', '', '', 'ids'),
                'Enable'=>array(2,'promotion/admin.rush/enable','', '', '','', '', 'ids'),
                'Disable'=>array(3,'promotion/admin.rush/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.rush/edit','', 950, 600,1, '', ''),
                'Rushconf'=> array(4,'promotion/admin.rush/config','', 680, 500,1, '', ''),
            )
          ),
          'Seckill'=> array('Rushsys','r','promotion/admin.seckill/index','time-icon','',1, 1,
            array(
             'Addnew'=>array(0,'promotion/admin.seckill/add','',950, 600,1,'',''),
             'Delete'=>array(1,'promotion/admin.seckill/delete','','', '', '', '', 'ids'),
             'Enable'=>array(2,'promotion/admin.seckill/enable','', '', '','', '', 'ids'),
             'Disable'=>array(3,'promotion/admin.seckill/disable','','','', '', '', 'ids'),
             'Edit'   => array(-1, 'promotion/admin.seckill/edit','', 950, 600,1, '', ''),
             'Seckillconf'=> array(4,'promotion/admin.seckill/config','', 680, 500,1, '', ''),
            )
          ),
          'Seize'=> array('Rushsys','r','promotion/admin.seize/index','tool-icon','',2, 1,
            array(
              'Addnew'=>array(0,'promotion/admin.seize/add','',950, 600,1,'',''),
              'Delete'=>array(1,'promotion/admin.seize/delete','','', '', '', '', 'ids'),
              'Enable'=>array(2,'promotion/admin.seize/enable','', '', '','', '', 'ids'),
              'Disable'=>array(3,'promotion/admin.seize/disable','','','', '', '', 'ids'),
              'Edit'   => array(-1, 'promotion/admin.seize/edit','', 950, 600,1, '', ''),
              'Seizeconf'=> array(4,'promotion/admin.seize/config','', 680, 500,1, '', ''),
            )
          ),
          'Fupackage'=> array('Rushsys','r','promotion/admin.fupackage/index','fu-icon','',3, 1,
              array(
                'Addnew'=>array(0,'promotion/admin.fupackage/add','',950, 600,1,'',''),
                'Delete'=>array(1,'promotion/admin.fupackage/delete','','', '', '', '', 'ids'),
                'Enable'=>array(2,'promotion/admin.fupackage/enable','', '', '','', '', 'ids'),
                'Disable'=>array(3,'promotion/admin.fupackage/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.fupackage/edit','', 950, 600,1, '', ''),
                'Seizeconf'=> array(4,'promotion/admin.fupackage/config','', 680, 500,1, '', ''),
              )
          ),
    
         'Auction'=> array('Rushsys','r','promotion/admin.auction/index','groupon-icon','',4,1,
            array(
                'Addnew' => array(0,'promotion/admin.auction/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1,'promotion/admin.auction/delete','','','','', '', 'ids'),
                'Sort'   => array(2,'promotion/admin.auction/sort','','','','','','sorts'),
                'Enable' => array(3,'promotion/admin.auction/enable','', '','','', '', 'ids'),
                'Disable'=> array(4,'promotion/admin.auction/disable','','','','','', 'ids'),
                'Edit'   => array(-1,'promotion/admin.auction/edit','', 950, 600, 1, '', ''),
            )
        ),
        'Yungou'=> array('Rushsys','r','promotion/admin.yugou/index','cloud-icon','',5,1,
            array(
                'Addnew' => array(0,'promotion/admin.yugou/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1,'promotion/admin.yugou/delete','','','','', '', 'ids'),
                'Sort'   => array(2,'promotion/admin.yugou/sort','','','','','','sorts'),
                'Enable' => array(3,'promotion/admin.yugou/enable','', '','','', '', 'ids'),
                'Disable'=> array(4,'promotion/admin.yugou/disable','','','','','', 'ids'),
                'Edit'   => array(-1,'promotion/admin.yugou/edit','', 950, 600, 1, '', ''),
            )
        ),
        
        'Couponsys' => array('Promotion','l', 'promotion/admin.coupons/index','','', 1, 1),
          'Coupons' => array('Couponsys','r','promotion/admin.coupons/index','coupons-icon','',0, 1,
              array(
                  'Createcoupons' => array(0, 'promotion/admin.coupons/add', 'btn-back ajax-get add', 840, 718, 1, '', ''),
                  'Delete' => array(1, 'promotion/admin.coupons/delete','','', '', '', '', 'ids'),
                  'Sendcou'=> array(2, 'promotion/admin.coupons/add', 'add-new ajax-get', 950, 600, 1, '', ''),
                  'Edit'   => array(-1, 'promotion/admin.coupons/edit','', 840, 718, 1, '', ''),
              )
          ),
          'Couponslog' => array('Couponsys','r','promotion/admin.log/index','log-icon','',3,1,
              array(
                 'Delete' => array(1, 'promotion/admin.log/delete','','', '', '', '', 'ids'),
              )
          ),
         'Pointtocou'=>array('Couponsys','r','promotion/admin.pointtocou/index','exc-icon','',4, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.pointtocou/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.pointtocou/delete','','', '', '', '', 'ids'),
                'Enable' => array(3, 'promotion/admin.pointtocou/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.pointtocou/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.pointtocou/edit','', 950, 600, 1, '', ''),
            )
         ),
        'Coureport'  => array('Couponsys','r','promotion/admin.report/coupons','report-icon','',5, 1,
            array(
                'Delete' => array(1, 'promotion/admin.report/delete','','', '', '', '', 'ids'),
            )
       ),
      
      'Shitiquan' => array('Promotion','l', 'promotion/admin.spaticker/index','','', 1, 1),
        'Spaticker'=> array('Shitiquan','r','promotion/admin.spaticker/index','custom-icon','',0, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.spaticker/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.spaticker/delete','','', '', '', '', 'ids'),
                'Enable' => array(3, 'promotion/admin.spaticker/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.spaticker/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.spaticker/edit','', 950, 600, 1, '', ''),
            )
        ),
        'Pickup'  => array('Shitiquan','r','promotion/admin.pickup/index','ext-icon','',1, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.pickup/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.pickup/delete','','', '', '', '', 'ids'),
                'Enable' => array(3, 'promotion/admin.pickup/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.pickup/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.pickup/edit','', 950, 600, 1, '', ''),
            )
        ),
        'Shitiquancat'=> array('Shitiquan','r','promotion/admin.cat/index','cat-icon','',2, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.cat/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.cat/delete','','', '', '', '', 'ids'),
                'Enable' => array(3, 'promotion/admin.cat/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.cat/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.cat/edit','', 950, 600, 1, '', ''),
            )
        ),
        'Picklog' => array('Shitiquan','r','promotion/admin.log/pick','log-icon','',4,1,
            array(
                'Delete' => array(1, 'promotion/admin.log/delete','','', '', '', '', 'ids'),
            )
        ),
        'Pointtopick'=>array('Shitiquan','r','promotion/admin.pointtopick/index','exc-icon','',5, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.pointtopick/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.pointtopick/delete','','', '', '', '', 'ids'),
                'Enable' => array(3, 'promotion/admin.pointtopick/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.pointtopick/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.pointtopick/edit','', 950, 600, 1, '', ''),
            )
        ),
       'Shireport'  => array('Shitiquan','r','promotion/admin.report/shiti','report-icon','',6,1,''),
		
		'Giftsys'   => array('Promotion','l', 'promotion/admin.gift/index', '','', 1, 1),
          'Giftlist'=> array('Giftsys','r', 'promotion/admin.gift/index', 'list-icon','', 0, 1,
                  array(
                      'Addnew'=>array(0,'promotion/admin.gift/add', '', 950, 600, 1, '', ''),
                      'Delete'=>array(1,'promotion/admin.gift/delete','','','','','', 'ids'),
                      'Enable'=>array(3,'promotion/admin.gift/enable','','','','','','ids'),
                      'Disable'=>array(4,'promotion/admin.gift/disable','','','','','','ids'),
                      'Edit'  =>array(-1,'promotion/admin.gift/edit','', 950, 600, 1,'',''),
                  ),
          ),
		  'Giftcat'	=> array('Giftsys','r', 'promotion/admin.giftcat/index', 'cat-icon','', 1, 1,
                  array(
                      'Addnew'=>array(0,'promotion/admin.giftcat/add', '', 950, 600, 1, '', ''),
                      'Delete'=>array(1,'promotion/admin.giftcat/delete','','','','','', 'ids'),
                      'Enable'=>array(3,'promotion/admin.giftcat/enable','','','','','','ids'),
                      'Disable'=>array(4,'promotion/admin.giftcat/disable','','','','','','ids'),
                      'Edit'  =>array(-1,'promotion/admin.giftcat/edit','', 950, 600, 1,'',''),
                  ),
          ),
		  'Giftlog'	 => array('Giftsys','r','promotion/admin.giftlog/index', 'log-icon','',2, 1,''),
		  'Giftreport'=> array('Giftsys','r','promotion/admin.report/gift','report-icon','',3,1,''),

        'Discount'     => array('Promotion','l', 'promotion/admin.orders/index', '','', 1, 1),
           'Orderspro'=> array('Discount','r','promotion/admin.orders/index','shopid-icon','',0, 1,
                array(
                    'Addnew' => array(0, 'promotion/admin.orders/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.orders/delete','','', '', '', '', 'ids'),
                    'Sort'   => array(2, 'promotion/admin.orders/sort','','','','','','sorts'),
                    'Enable' => array(3, 'promotion/admin.orders/enable','', '', '','', '', 'ids'),
                    'Disable'=> array(4, 'promotion/admin.orders/disable','','','', '', '', 'ids'),
                    'Edit'   => array(-1, 'promotion/admin.orders/edit','', 950, 600, 1, '', ''),
               )
          ),
          'Timepro'  => array('Discount','r','promotion/admin.timepro/index','time-icon','',1,1,
                array(
                    'Addnew' => array(0, 'promotion/admin.timepro/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.timepro/delete','','', '', '', '', 'ids'),
                    'Sort'   => array(2, 'promotion/admin.timepro/sort','','','','','','sorts'),
                    'Enable' => array(3, 'promotion/admin.timepro/enable','', '', '','', '', 'ids'),
                    'Disable'=> array(4, 'promotion/admin.timepro/disable','','','', '', '', 'ids'),
                    'Edit'   => array(-1, 'promotion/admin.timepro/edit','', 950, 600, 1, '', ''),
              )
          ),
          'Booking'  => array('Discount','r', 'promotion/admin.booking/index', 'booking-icon','',2,1,
                array(
                    'Addnew' => array(0, 'promotion/admin.booking/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.booking/delete','','', '', '', '', 'ids'),
                    'Sort'   => array(2, 'promotion/admin.booking/sort','','','','','','sorts'),
                    'Enable' => array(3, 'promotion/admin.booking/enable','', '', '','', '', 'ids'),
                    'Disable'=> array(4, 'promotion/admin.booking/disable','','','', '', '', 'ids'),
                    'Edit'   => array(-1, 'promotion/admin.booking/edit','', 950, 600, 1, '', ''),
               )
          ),
          'Taskspro'=> array('Discount','r','promotion/admin.taskspro/index','list-icon','',3, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.taskspro/add', '', 950, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.taskspro/delete','','', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.taskspro/sort','','','','','','sorts'),
                'Enable' => array(3, 'promotion/admin.taskspro/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.taskspro/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.taskspro/edit','', 950, 600, 1, '', ''),
            )
          ),

          'Disreport' => array('Discount','r','promotion/admin.report/discount','report-icon','',4,1,
              array(
                  'Delete' => array(1, 'promotion/admin.report/delete','','', '', '', '', 'ids'),
              )
           ),

        'Noticepro' => array('Promotion','l', 'promotion/admin.noticepro/index', '','', 1, 1),
           'Noticeconf'=>array('Noticepro','r','promotion/admin.noticepro/index','conf-icon','',0, 1,
                array(
                    'Addnew' => array(0,'promotion/admin.noticepro/add', '', 680, 540, 1, '', ''),
                    'Delete' => array(1,'promotion/admin.noticepro/delete','','','','','','ids'),
                    'Sort'   => array(2,'promotion/admin.noticepro/sort','','','','','','sorts'),
                    'Enable' => array(3,'promotion/admin.noticepro/enable','','','','','', 'ids'),
                    'Disable'=> array(4,'promotion/admin.noticepro/disable','','','','','','ids'),
                    'Edit'   => array(-1,'promotion/admin.noticepro/edit','', 680, 540, 1, '', ''),
                )
            ),
            'Notice'  => array('Noticepro','r', 'promotion/admin.notice/index', 'list-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'promotion/admin.notice/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.notice/delete','','', '', '', '', 'ids'),
                    'Sort'   => array(2, 'promotion/admin.notice/sort','','','','','','sorts'),
                    'Enable' => array(3, 'promotion/admin.notice/enable','', '', '','', '', 'ids'),
                    'Disable'=> array(4, 'promotion/admin.notice/disable','','','', '', '', 'ids'),
                    'Edit'   => array(-1, 'promotion/admin.notice/edit','', 950, 600, 1, '', ''),
                )
            ),
            'Noticerule'=>array('Noticepro','r','promotion/admin.notirule/index','rule-icon','',2, 1,
                array(
                    'Addnew' => array(0, 'promotion/admin.notirule/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1, 'promotion/admin.notirule/delete','','','','','', 'ids'),
                    'Sort'   => array(2, 'promotion/admin.notirule/sort','','','','','','sorts'),
                    'Enable' => array(3, 'promotion/admin.notirule/enable','','','','', '', 'ids'),
                    'Disable'=> array(4,'promotion/admin.notirule/disable','','','','','', 'ids'),
                    'Edit'   => array(-1, 'promotion/admin.notirule/edit','', 950, 600, 1, '', ''),
                )
            ),
            'Noticelog' => array('Noticepro','r','promotion/admin.noticelog/index','log-icon','',3,1,
                array(
                    'Delete' => array(1, 'promotion/admin.noticelog/delete','','', '', '', '', 'ids'),
                )
            ),
           'Noticereport'=> array('Noticepro','r','promotion/admin.report/notice','report-icon','',4,1,
                array(
                    'Delete' => array(1, 'promotion/admin.report/delete','','', '', '', '', 'ids'),
                )
            ),

        'Groupsys'    => array('Promotion','l', 'promotion/admin.groups/index', '','', 1, 1),
            'Groups'  => array('Groupsys','r','promotion/admin.groups/index','groupon-icon','', 0, 1,
                array(
                    'Addnew' => array(0,'promotion/admin.groups/add', '', 950, 600, 1, '', ''),
                    'Delete' => array(1,'promotion/admin.groups/delete','','','','', '', 'ids'),
                    'Sort'   => array(2,'promotion/admin.groups/sort','','','','','','sorts'),
                    'Enable' => array(3,'promotion/admin.groups/enable','', '','','', '', 'ids'),
                    'Disable'=> array(4,'promotion/admin.groups/disable','','','','','', 'ids'),
                    'Edit'   => array(-1,'promotion/admin.groups/edit','', 950, 600, 1, '', ''),
                )
            ),
            'Pieces'  => array('Groupsys','r', 'promotion/admin.pieces/index','plug-icon','',1, 1,
                array(
                   'Addnew' => array(0,'promotion/admin.pieces/add', '', 950, 600, 1, '', ''),
                   'Delete' => array(1,'promotion/admin.pieces/delete','','', '', '', '', 'ids'),
                   'Sort'   => array(2,'promotion/admin.pieces/sort','','','','','','sorts'),
                   'Enable' => array(3,'promotion/admin.pieces/enable','', '', '','', '', 'ids'),
                   'Disable'=> array(4,'promotion/admin.pieces/disable','','','', '', '', 'ids'),
                   'Edit'   => array(-1,'promotion/admin.pieces/edit','', 950, 600, 1, '', ''),
                )
            ),
            'Fororder'=> array('Groupsys','r','promotion/admin.fororder/index','addons-icon','', 2, 1,
                array(
                   'Addnew' => array(0,'promotion/admin.fororder/add', '', 950, 600, 1, '', ''),
                   'Delete' => array(1,'promotion/admin.fororder/delete','','', '', '', '', 'ids'),
                   'Sort'   => array(2,'promotion/admin.fororder/sort','','','','','','sorts'),
                   'Enable' => array(3,'promotion/admin.fororder/enable','', '', '','', '', 'ids'),
                   'Disable'=> array(4,'promotion/admin.fororder/disable','','','', '', '', 'ids'),
                   'Edit'   => array(-1,'promotion/admin.fororder/edit','', 950, 600, 1, '', ''),
                )
            ),

        'Adsandlinks'=> array('Promotion','l', 'promotion/admin.adsense/index', '','', 1, 1),
          'Adsenselist'=> array('Adsandlinks','r','promotion/admin.adsense/index','list-icon','',0, 1,
             array(
                'Addnew' => array(0, 'promotion/admin.adsense/add', '', 780, 630, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.adsense/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.adsense/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'promotion/admin.adsense/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.adsense/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.adsense/edit', '', 780, 630, 1, '', ''),
              )
          ),

         'Adsensepos'=>array('Adsandlinks','r','promotion/admin.adsensepos/index','coll-icon','',1, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.adsensepos/add', '', 580, 350, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.adsensepos/delete','','', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.adsensepos/sort','','','','','','sorts'),
                'Enable' => array(3, 'promotion/admin.adsensepos/enable','', '', '','', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.adsensepos/disable','','','', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.adsensepos/edit','', 580, 350, 1, '', ''),
            )
          ),
        'Silder' => array('Adsandlinks','r', 'promotion/admin.silder/index', 'list-icon','', 2, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.silder/add', '', 840, 600, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.silder/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.silder/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'promotion/admin.silder/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.silder/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.silder/edit', '', 840, 600, 1, '', ''),
            )
        ),
        'Links' => array('Adsandlinks','r', 'promotion/admin.links/index','list-icon','', 3, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.links/add', '', 780, 530, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.links/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.links/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'promotion/admin.links/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.links/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.links/edit', '', 780, 530, 1, '', ''),
            )
        ),
        'Adsenseconf'=> array('Adsandlinks','r', 'promotion/admin.adsconf/index','conf-icon','', 4, 1,
            array(
                'Save'   => array(-1, 'promotion/admin.adsconf/save', '', '', '', 1, '', ''),
            )
        ),
    
        'Linksreport'=>array('Adsandlinks','r','promotion/admin.report/index','report-icon','', 5, 1,
            array(
                'Delete' => array(1, 'promotion/admin.links/delete', '', '', '', '', '', 'ids'),
            )
        ),
    
        'Adsandunion'=> array('Promotion','l', 'promotion/admin.union/index', '','', 1, 1),
          'pAdsunion'=> array('Adsandunion','r', 'promotion/admin.union/index','list-icon','',0, 1,
              array(
                'Addnew' => array(0, 'promotion/admin.union/add', '', 680, 540, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.union/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.union/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'promotion/admin.union/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.union/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.union/edit', '', 680, 540, 1, '', ''),
              )
          ),
          'pAdscat'=> array('Adsandunion','r', 'promotion/admin.padscat/index','cat-icon','',1, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.padscat/add', '', 680, 540, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.padscat/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.padscat/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'promotion/admin.padscat/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.padscat/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.padscat/edit', '', 680, 540, 1, '', ''),
            )
          ),
          'pAdspos'=> array('Adsandunion','r', 'promotion/admin.padspos/index','rule-icon','',2, 1,
            array(
                'Addnew' => array(0, 'promotion/admin.padspos/add', '', 680, 540, 1, '', ''),
                'Delete' => array(1, 'promotion/admin.padspos/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'promotion/admin.padspos/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'promotion/admin.padspos/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'promotion/admin.padspos/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'promotion/admin.padspos/edit', '', 680, 540, 1, '', ''),
            )
          ),
          'pAdsconf'=> array('Adsandunion','r', 'promotion/admin.unconf/index','conf-icon','',3, 1,
            array(
                'Save'   => array(-1, 'promotion/admin.unconf/save', '', '', '', 1, '', ''),
            )
          ),
          'pAdsreport'=>array('Adsandunion','r','promotion/admin.report/union','report-icon','',4, 1,''),
          'Schoollist'=> array('Adsandunion','r','promotion/admin.school/index','lten-icon','', 5, 1,
              array(
                  'Whole'   => array(1, 'promotion/admin.school/index', 'add-new', '', '', '', '', ''),
              ),
          ),
        
        //不受控制器管控的公共访问方法
        'Choosegoods'  => array('', 'h', 'promotion/admin.cat/choose', '','', 0, 0),
    )
);