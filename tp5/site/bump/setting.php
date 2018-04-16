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
        'name'        => 'Bump',
        'title'       => '新城快货(新零售货运)',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'bump.png',
        'description' => '新城快货Saas平台，提供新零售业务模式下的物流管理方案，服务于便利店、百货、连锁超市，经销商、代理商、统仓统配服务商，物流企业，传统转型电商以及跨境物流',
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
        'Bumpsys'  => array('','l', 'bump/admin.index/index', 'Bump.png', '', 1, 1),
          'Bump'   => array('Bumpsys','l', 'bump/admin.index/index', '', '', 0, 1),
            'Dianlist'=> array('Bump','r', 'bump/admin.index/index', 'list-icon', '', 0, 1),
            'Dianitem'=> array('Bump','r', 'bump/admin.item/index', 'cat-icon', '', 1, 1),
            'Dianconf'=> array('Dianconf','r', 'bump/admin.config/index', 'conf-icon', '', 2, 1),
          'Diancrowd' => array('Bumpsys','l', 'bump/admin.index/index', '', '', 0, 1),
            'Crowd'=> array('Diancrowd','r', 'bump/admin.index/index', 'list-icon', '', 0, 1),
            'Crowdlist'=> array('Diancrowd','r', 'bump/admin.item/index', 'cat-icon', '', 1, 1),
    )
);