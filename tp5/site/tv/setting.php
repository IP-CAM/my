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
        'name'        => 'Tv',
        'title'       => '电影&电视剧',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'tv.png',
        'description' => '全球各国电视/电视剧，为导航服务',
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
        'Tv_movie'      => array('','l', 'tv/admin.index/index', 'tv.png','', 1, 1),
          'Tvchannelsys'=> array('Tv_movie','l', 'tv/admin.index/index', '','', 1, 1),
            'Tvlist' => array('Tvchannelsys','r', 'tv/admin.index/index', 'list-icon','', 0, 1,
                array(
                    'Addnew' => array(0, 'tv/admin.index/add', '', 1024, 768, 1, '', ''),
                    'Delete' => array(1, 'tv/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'tv/admin.index/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'tv/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'tv/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'tv/admin.index/edit', '', 1024, 768, 1, '', ''),
                ),
            ),
            'Tvchannel' => array('Tvchannelsys','r', 'tv/admin.cat/index', 'cat-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'tv/admin.cat/add', '', 1024, 768, 1, '', ''),
                    'Delete' => array(1, 'tv/admin.cat/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'tv/admin.cat/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'tv/admin.cat/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'tv/admin.cat/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'tv/admin.cat/edit', '', 1024, 768, 1, '', ''),
                ),
            ),
    ),
);