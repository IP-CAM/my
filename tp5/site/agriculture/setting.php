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
        'name'        => 'Agriculture',
        'title'       => '农资电商平台',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'agriculture.png',
        'description' => '农业生产资料/工具电商平台, BBC平台，全球市场！',
        'author'   	  => 'Runtuer',
        'website'     => 'http://www.runtuer.com',
        'version'     => '1.0.0',
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
        'Agriculture'  => array('','l', 'agriculture/admin.index/index', 'agriculture.png', '', 1, 1),
        'Agricultureconf' => array('Agriculture','l', 'agriculture/admin.config/index', '','', 1, 1),
          'Kernel'   => array('Agricultureconf','r', 'agriculture/admin.config/index', 'core-icon','', 0, 1,
              array(
                'Save'   => array(-1, 'agriculture/admin.config/save', '', '', '', '', '', ''),
              )
          ),
        
        'Agrgoods'   => array('Agriculture','l', 'agriculture/admin.goods/index', '', '', 1, 1),
        'Offline'    => array('Agriculture','l', 'agriculture/admin.offline/index', '', '', 1, 1),
        'Agrware'    => array('Agriculture','l','agriculture/admin.warehouse/index','','', 1, 1),
        'Payment'    => array('Agriculture','l', 'agriculture/admin.payment/index', '', '', 1, 1),
        'Expresstpl' => array('Agriculture','l', 'agriculture/admin.express/index', '', '', 1, 1),
        'Reportlist' => array('Agriculture','l', 'agriculture/admin.report/index', '', '', 1, 1),
    ),
);