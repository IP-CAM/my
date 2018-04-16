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
        'name'        => 'Cms',
        'title'       => '内容管理',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'cms.png',
        'description' => '内容管理平台，文章，图片，下载类管理',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
        'upgrade'     => '/cmfup/ver.php',     //升级地址
        'depends' => array(
            'Admin'   => '1.0.0',
        ),
		'afterunset'  => 0,								//安装后是否允许卸载
        //依赖扩展
        'extend' => array(
			//'deliverys|Common'  => '2.0',				//目录名|插件名称  => 版本号
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
        位置：l:左路，r：右，h：隐藏
        是否权限控制 ：1，是，0：否
        排序: -1 隐藏
        **/
        //'General'   => array('','l', 'Admin/index', 'fa fa-home', 1, 1),
        'Contents'      => array('','l', 'cms/admin.index/index', 'cms.png', '', 1, 1),
        'Categories'    => array('Contents','l', 'cms/admin.category/index', '', '', 1, 1),
          'Category'    => array('Categories','r', 'cms/admin.category/index', 'cat-icon', '', 0, 1,
              array(
                  'Addnew' => array(0, 'cms/admin.category/add', '', 900, 560, 1, '', ''),
                  'Delete' => array(1, 'cms/admin.category/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'cms/admin.category/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'cms/admin.category/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'cms/admin.category/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'cms/admin.category/edit', '', 900, 560, 1, '', ''),
                  'Whole'  => array(5, 'cms/admin.category/index', 'add-new', '', '', '', '', ''),
              )
          ),

        'Itemsys'       => array('Contents','l', 'cms/admin.item/index', '', '', 1, 1),
          'Items'       => array('Itemsys','r', 'cms/admin.item/index', 'cat-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'cms/admin.item/add', '', 900,620, 1, '', ''),
                    'Delete' => array(1, 'cms/admin.item/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'cms/admin.item/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'cms/admin.item/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'cms/admin.item/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'cms/admin.item/edit', '', 680, 500, 1, '', ''),
                )
          ),
          'Posidlist'=> array('Itemsys','r', 'cms/admin.posid/index', 'up-icon', '', 2, 1,
              array(
                  'Addnew' => array(0, 'cms/admin.posid/add', '', 480, 420, 1, '', ''),
                  'Delete' => array(1, 'cms/admin.posid/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'cms/admin.posid/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'cms/admin.posid/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'cms/admin.posid/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'cms/admin.posid/edit', '', 480, 420, 1, '', ''),
              )
          ),
        'Tags'      => array('Itemsys','r', 'cms/admin.tags/index', 'tag-icon', '', 3, 1,
            array(
                'Addnew' => array(0, 'cms/admin.tags/add', '', 520, 280, 1, '', ''),
                'Delete' => array(1, 'cms/admin.tags/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'cms/admin.tags/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.tags/disable', '', '', '', '', '', 'ids'),
                'Edit'=> array(-1, 'cms/admin.tags/edit', '', 520, 280, 1, '', ''),
            )
        ),
        'Itemmodel'   => array('Itemsys','r', 'cms/admin.itemmodel/index', 'db-icon', '', 4, 1,
            array(
                'Addnew' => array(0, 'cms/admin.itemmodel/add', '', 460, 535, 1, '', ''),
                'Delete' => array(1, 'cms/admin.itemmodel/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'cms/admin.itemmodel/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'cms/admin.itemmodel/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.itemmodel/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'cms/admin.itemmodel/edit', '', 960, 600, 1, '', ''),
            )
        ),
       /*'Itemspecifi' => array('Itemsys','r', 'cms/admin.itemspecifi/index', 'more-icon', '', 5, 1,
           array(
               'Addnew' => array(0, 'cms/admin.itemspecifi/add', '', 600, 560, 1, '', ''),
               'Delete' => array(1, 'cms/admin.itemspecifi/delete', '', '', '', '', '', 'ids'),
               'Sort'   => array(2, 'cms/admin.itemspecifi/sort', '', '', '', '', '', 'sorts'),
               'Enable' => array(3, 'cms/admin.itemspecifi/enable', '', '', '', '', '', 'ids'),
               'Disable'=> array(4, 'cms/admin.itemspecifi/disable', '', '', '', '', '', 'ids'),
               'Edit'   => array(-1, 'cms/admin.itemspecifi/edit', '', 600, 560, 1, '', ''),
           )
       ),*/
       'Cmsattribute'   => array('Itemsys','r', 'cms/admin.itemattr/index', 'cat-icon', '', 6, 1,
           array(
               'Addnew' => array(0, 'cms/admin.itemattr/add', '', 710, 570, 1, '', ''),
               'Delete' => array(1, 'cms/admin.itemattr/delete', '', '', '', '', '', 'ids'),
               'Sort'   => array(2, 'cms/admin.itemattr/sort', '', '', '', '', '', 'sorts'),
               'Enable' => array(3, 'cms/admin.itemattr/enable', '', '', '', '', '', 'ids'),
               'Disable'=> array(4, 'cms/admin.itemattr/disable', '', '', '', '', '', 'ids'),
               'Edit'   => array(-1, 'cms/admin.itemattr/edit', '', 850, 600, 1, '', ''),
           )
       ),
       'Articlesys'   => array('Contents','l', 'cms/admin.article/index', '', '', 1, 1),
          'Article'   => array('Articlesys','r', 'cms/admin.article/index', 'list-icon', '', 0, 1,
              array(
                  'Addnew' => array(0, 'cms/admin.article/add', '', 900, 650, 1, '', ''),
                  'Delete' => array(1, 'cms/admin.article/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'cms/admin.article/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'cms/admin.article/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'cms/admin.article/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'cms/admin.article/edit', '', 860, 600, 1, '', ''),
              )
          ),
          'Pages'       => array('Articlesys','r', 'cms/admin.page/index', 'tpl-icon', '', 2, 1,
              array(
                  'Addnew' => array(0, 'cms/admin.page/add', '', 580, 400, 1, '', ''),
                  'Delete' => array(1, 'cms/admin.page/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'cms/admin.page/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'cms/admin.page/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'cms/admin.page/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'cms/admin.page/edit', '', 580, 400, 1, '', ''),
              )
          ),
          'Special'     => array('Articlesys','r', 'cms/admin.special/index', 'merge-icon', '', 3, 1,
              array(
                  'Addnew' => array(0, 'cms/admin.special/add', '', 650, 650, 1, '', ''),
                  'Delete' => array(1, 'cms/admin.special/delete', '', '', '', '', '', 'ids'),
                  'Sort'   => array(2, 'cms/admin.special/sort', '', '', '', '', '', 'sorts'),
                  'Enable' => array(3, 'cms/admin.special/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'cms/admin.special/disable', '', '', '', '', '', 'ids'),
                  'Edit'   => array(-1, 'cms/admin.special/edit', '', 630, 455, 1, '', ''),
              )
          ),
          'Articlecat'    => array('Articlesys','r', 'cms/admin.articlecat/index', 'cat-icon', '', 1, 1,
            array(
                'Addnew' => array(0, 'cms/admin.articlecat/add', '', 500, 360, 1, '', ''),
                'Delete' => array(1, 'cms/admin.articlecat/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'cms/admin.articlecat/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'cms/admin.articlecat/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.articlecat/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'cms/admin.articlecat/edit', '', 630, 460, 1, '', ''),
            )
         ),
    
         'Specialcat'  => array('Articlesys','r', 'cms/admin.specialcat/index','parent-icon','',2, 1,
            array(
                'Addnew' => array(0, 'cms/admin.specialcat/add', '', 900, 560, 1, '', ''),
                'Delete' => array(1, 'cms/admin.specialcat/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'cms/admin.specialcat/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'cms/admin.specialcat/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.specialcat/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'cms/admin.specialcat/edit', '', 630, 455, 1, '', ''),
            )
         ),
        
      'Homemang'  => array('Contents','l', 'cms/admin.home/index', '', '', 1, 1),
        'Homenav' => array('Homemang','r', 'cms/admin.nav/index', 'parent-icon', '', 0, 1,
            array(
                'Addnew' => array(0, 'cms/admin.nav/add', '', 430, 310, 1, '', ''),
                'Delete' => array(1, 'cms/admin.nav/delete', '', '', '', '', '', 'ids'),
                'Sort'   => array(2, 'cms/admin.nav/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'cms/admin.nav/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.nav/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'cms/admin.nav/edit', '', 860, 600, 1, '', ''),
            )
        ),
        'Home'    => array('Homemang','r', 'cms/admin.home/index', 'list-icon', '', 1, 1,
            array(
                'Addnew' => array(0, 'cms/admin.home/add', '', 700, 325, 1, '', ''),
                'Delete' => array(1, 'cms/admin.home/delete', '', '', '', '', '', 'ids'),
                /*'Sort'   => array(2, 'cms/admin.home/sort', '', '', '', '', '', 'sorts'),*/
                'Enable' => array(3, 'cms/admin.home/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.home/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'cms/admin.home/edit', '', 900, 600, 1, '', ''),
            )
        ),
        'Homewidget' => array('Homemang','r', 'cms/admin.widget/index', 'cat-icon', '', 2, 1,
            array(
                'Addnew' => array(0, 'cms/admin.widget/add', '', 700, 360, 1, '', ''),
                'Delete' => array(1, 'cms/admin.widget/delete', '', '', '', '', '', 'ids'),
                /*'Sort'   => array(2, 'cms/admin.widget/sort', '', '', '', '', '', 'sorts'),*/
                'Enable' => array(3, 'cms/admin.widget/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'cms/admin.widget/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'cms/admin.widget/edit', '', 700, 360, 1, '', ''),
            )
        ),
    )
);