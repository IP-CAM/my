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
        'name'        => 'Openapi',
        'title'       => '开发者中心',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'openapi.png',
        'description' => '集中API管理控制中心，负责为外界提供API接口，验签处理。',
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
    'user_nav' => array(),

    //模型配置
    'config' => array(
        
    ),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
        位置：l:左路，r：右，h：隐藏
        是否权限控制 ：1，是，0：否
         **/
        'Openapi'    => array('','l', 'openapi/admin.index/index', 'openapi.png', '', 1, 1),
          'Opendev'  => array('Openapi','l', 'openapi/admin.index/index', '', '', 1, 1),
            'Devlist'=> array('Opendev','r', 'openapi/admin.index/index', 'list-icon', '', 0, 1,
                array(
                    'Addnew' => array(0, 'openapi/admin.index/add', '', 740, 450, 1, '', ''),
                    'Delete' => array(1, 'openapi/admin.index/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'openapi/admin.index/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'openapi/admin.index/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.liceson/edit', '', 740, 450, 1, '', ''),
                )
            ),
            'Devrole'=> array('Opendev','r', 'openapi/admin.role/index', 'uu-icon', '', 1, 1,
                array(
                    'Addnew' => array(0, 'openapi/admin.role/add', '', 740, 490, 1, '', ''),
                    'Delete' => array(1, 'openapi/admin.role/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'openapi/admin.role/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'openapi/admin.role/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.role/edit', '', 740, 490, 1, '', ''),
                )
            ),
            'Devauth'=> array('Opendev','r', 'openapi/admin.auth/index', 'cat-icon', '', 2, 1,
                array(
                    'Addnew' => array(0, 'openapi/admin.auth/add', '', 740, 490, 1, '', ''),
                    'Delete' => array(1, 'openapi/admin.auth/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'openapi/admin.auth/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'openapi/admin.auth/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.auth/edit', '', 740, 490, 1, '', ''),
                )
            ),
          'Apisys'   => array('Openapi','l', 'openapi/admin.apis/index', '', '', 1, 1),
            'Pubapi'=> array('Apisys','r', 'openapi/admin.apis/index', 'api-icon', '', 0, 1,
                array(
                    'Whole'     => array(0, 'openapi/admin.apis/index', 'add-new', '', '', '', '', ''),
                    'View'      => array(-1, 'openapi/admin.apis/view', '', 800, 600, 1, '', ''),
                )
            ),
            'Priapi'=> array('Apisys','r', 'openapi/admin.apis/appapis', 'app-icon', '', 1, 1,
                array(
                    'Whole'     => array(0, 'openapi/admin.apis/appapis', 'add-new', '', '', '', '', ''),
                    'Edit'      => array(-1, 'runtuer/admin.apis/priview', '', 740, 490, 1, '', ''),
                )
            ),
            'Virtualapi'=> array('Apisys','r', 'openapi/admin.virtual/index', 'vr-icon', '', 2, 1,
                array(
                    'Addnew' => array(0, 'openapi/admin.virtual/add', '', 740, 538, 1, '', ''),
                    'Delete' => array(1, 'openapi/admin.virtual/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'openapi/admin.virtual/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'openapi/admin.virtual/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.virtual/edit', '', 740, 538, 1, '', ''),
                )
            ),
            'Openapiconf'=> array('Apisys','r', 'openapi/admin.apiconf/index', 'conf-icon', '', 3, 1,
                array(
                    'Addnew' => array(0, 'openapi/admin.apiconf/add', '', 740, 490, 1, '', ''),
                    'Delete' => array(1, 'openapi/admin.apiconf/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(2, 'openapi/admin.apiconf/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(3, 'openapi/admin.apiconf/disable', '', '', '', '', '', 'ids'),
                    'Edit'=> array(-1, 'runtuer/admin.apiconf/edit', '', 740, 490, 1, '', ''),
                )
            ),
        'Request'     => array('Openapi','l', 'openapi/admin.request/index', '', '',3, 1),
          'Requestkey'=> array('Request','r', 'openapi/admin.request/index', 'list-icon','', 1, 1,
              array(
                    'Clear'=> array(0,'openapi/admin.request/clear', '',390, 275, 1, '', ''),
                    'Delete'=> array(1,'openapi/admin.request/delete', '','','','','ete','ids'),
              )
          ),
    )
);