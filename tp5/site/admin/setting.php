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
            'name'        => 'Admin',
            'title'       => '后台总控',
            'icon'        => '',
            'icon_color'  => '',
            'image'       => 'general.png',
            'description' => '后台总控中心',
            'author'   	  => 'Runtuer',
            'website'     => 'http://www.runtuer.com',
            'version'     => '1.0.0',
            'upgrade'     => '/cmfup/ver.php',     //升级地址
			'afterunset'  => 0,								//安装后是否允许卸载
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
            'General'    => array('','l', 'admin/index/index', 'general.png','', 1, 1),
            'Dashboard'  => array('General','l', 'admin/index/index', '','', 1, 1),
            'Siteconfig' => array('General','l', 'admin/config/index', '','', 1, 1),
              'Siteset'  => array('Siteconfig','r', 'admin/config/index', 'list-icon','', 0, 1,
                  array(
                      'Save'   => array(-1, 'admin/config/save', '', '', '', 1, '', ''),
                  )
              ),
            'Customconf'  => array('Siteconfig','r', 'admin/custom/index', 'core-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'admin/custom/add', '', 680, 460, 1, '', ''),
                    'Delete' => array(1, 'admin/custom/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/custom/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/custom/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/custom/edit', '', 680, 460, 1, '', ''),
                )
            ),
            'Domainsys'  => array('Siteconfig','r', 'admin/domain/index', 'domain-icon','', 2, 1,
                array(
                    'Addnew' => array(0, 'admin/domain/add', '', 720, 460, 1, '', ''),
                    'Delete' => array(1, 'admin/domain/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/domain/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/domain/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/domain/edit', '', 720, 460, 1, '', ''),
                )
            ),
            /*'Route'    => array('Siteconfig','r', 'admin/route/index', 'link-icon','', 3, 1,
                  array(
                      //'节点标识'=> array(排序, 'URL', 'CSS', width, height, showbar, 'layer title', 'target-form'),
                      'Addnew' => array(0, 'admin/route/add', '', 600, 460, 1, '', ''),
                      'Delete' => array(1, 'admin/route/delete', '', '', '', '', '', 'ids'),
                      'Enable' => array(3, 'admin/route/enable', '', '', '', '', '', 'ids'),
                      'Disable'=> array(4, 'admin/route/disable', '', '', '', '', '', 'ids'),
                      'Edit'   => array(-1, 'admin/route/edit', '', 600, 460, 1, '', ''),
                  )
              ),*/
            'Seoconf'  => array('Siteconfig','r', 'admin/seo/index', 'seo-icon','', 4, 1,
                array(
                    'Addnew' => array(0, 'admin/seo/add', '', 600, 460, 1, '', ''),
                    'Delete' => array(1, 'admin/seo/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/seo/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/seo/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/seo/edit', '', 600, 460, 1, '', ''),
                )
            ),
            'Attachment' => array('Siteconfig','r', 'admin/attachment/index','file-icon', '', 5, 1,
                array(
                    'Addnew' => array(0, 'admin/attachment/add?input=all', '', 710, 455, 1, '', ''),
                    'Delete' => array(1, 'admin/attachment/delete', '', '', '', '', '', 'ids'),
                    'Rename' => array(-1, 'admin/attachment/rename', '', '', '', '', '', 'ids'),
                )
            ),
            'Template'   => array('Siteconfig','r', 'admin/template/index', 'tpl-icon','', 7, 1,
                array(
                    'Addnew' => array(0, 'admin/template/add', '', 860, 585, 1, '', ''),
                    'Delete' => array(1, 'admin/template/delete', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/template/edit', '', 440,275, 1, '', ''),
                )
            ),
            
            'Noitflysys'   => array('General','l', 'admin/noitfly/index', '', '',3, 1),
                'Noitfly'  => array('Noitflysys','r', 'admin/noitfly/index', 'send-icon','', 0, 1,
                    array(
                        'Handpush'=> array(0, 'admin/noitfly/add', 'add-new ajax-get add', 860, 585, 1, '', ''),
                        'Delete' => array(1, 'admin/noitfly/delete', '', '', '', '', '', 'ids'),
                        'Enable' => array(3, 'admin/noitfly/enable', '', '', '', '', '', 'ids'),
                        'Disable'=> array(4, 'admin/noitfly/disable', '', '', '', '', '', 'ids'),
                        'Edit'   => array(-1, 'admin/noitfly/edit', '', 860, 585, 1, '', ''),
                    )
                ),
                'Msgconf'=> array('Noitflysys','r', 'admin/msgconf/index', 'sms-icon','',1, 1,
                    array(
                        'Editapp'   => array(-1, 'admin/msgconf/editapp', '', 470, 700, 1, '', ''),
                        'Editemail' => array(-1, 'admin/msgconf/editemail', '', 500, 720, 1, '', ''),
                        'Editsms'   => array(-1, 'admin/msgconf/editsms', '', 330, 660, 1, '', ''),
                        'Editwechat'=> array(-1,'admin/msgconf/editwechat','',500, 720, 1, '', ''),
                        'Editwhatisapp'=> array(-1,'admin/msgconf/editwhatisapp','',500,720,1,'',''),
                        'Editmessager'=> array(-1, 'admin/msgconf/editmessager','',500,720,1,'',''),
                        'Save'    => array(-1, 'admin/msgconf/save','', '', '', '', '', ''),
                        'Saveedit'=> array(-1, 'admin/msgconf/saveedit','', '', '', '', '', ''),
                    )
                ),
                'Infonoitfly' =>array('Noitflysys','r','admin/infonoite/index','info-icon','',2,1,
                    array(
                        'Addnew' => array(0, 'admin/infonoite/add', '', 860, 585, 1, '', ''),
                        'Delete' => array(1, 'admin/infonoite/delete', '', '', '', '', '', 'ids'),
                        'Enable' => array(3, 'admin/infonoite/enable', '', '', '', '', '', 'ids'),
                        'Disable'=> array(4, 'admin/infonoite/disable', '', '', '', '', '', 'ids'),
                        'Edit'   => array(-1, 'admin/infonoite/edit', '', 860, 585, 1, '', ''),
                    )
                ),
                'Mailnoitfly'=>array('Noitflysys','r','admin/mailnoite/index','coupons-icon','',3, 1,
                    array(
                        'Addnew' => array(0, 'admin/mailnoite/add', '', 880, 600, 1, '', ''),
                        'Delete' => array(1, 'admin/mailnoite/delete', '', '', '', '', '', 'ids'),
                        'Enable' => array(3, 'admin/mailnoite/enable', '', '', '', '', '', 'ids'),
                        'Disable'=> array(4, 'admin/mailnoite/disable', '', '', '', '', '', 'ids'),
                        'Edit'   => array(-1, 'admin/mailnoite/edit', '', 880, 600, 1, '', ''),
                    )
             ),
                
            'DbModel'   => array('General','l', 'admin/dbmodel/index', '','', 1, 1),
              'DbModellist'=> array('DbModel','r', 'admin/dbmodel/index', 'model-icon','', 0, 1,
                  array(
                      'Addnew' => array(0, 'admin/dbmodel/add', '', 540, 500, 1, '', ''),
                      'Delete' => array(1, 'admin/dbmodel/delete', '', '', '', '', '', 'ids'),
                      'Import' => array(2, 'admin/dbmodel/import', '', 440, 280, 1, '', ''),
                      'Enable' => array(3, 'admin/dbmodel/enable', '', '', '', '', '', 'ids'),
                      'Disable'=> array(4, 'admin/dbmodel/disable', '', '', '', '', '', 'ids'),
                      'Createmd'=> array(5, 'admin/dbmodel/generate', 'btn-refresh ajax-get', 460, 280, 1, '', ''),
                      'Edit'   => array(-1, 'admin/dbmodel/edit', '', 540, 500, 1, '', ''),
                      'Exportdb' => array(-1, 'admin/dbmodel/export', '', 440, 280, 1, '', ''),
                  )
              ),
            'Attribute' => array('DbModel','h', 'admin/attribute/index', 'db-icon','', 1, 1,
                array(
                    'Newfield' => array(0, 'admin/attribute/add', 'add-new addfield', 640, 420, 1, '', ''),
                    'Delfield' => array(1, 'admin/attribute/delete', 'copy-existing ajax-post confirm del', '', '', '', '', 'ids'),
                    'Sort'   => array(2,'admin/attribute/sort','','','','','','sorts'),
                    'Enable' => array(3, 'admin/attribute/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/attribute/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/attribute/edit', '', 640, 565, 1, '', ''),
                )
            ),
            'Rdb' => array('DbModel','r', 'admin/rdb/index', 'db-icon','', 1, 1,
                array(
                   'Backnow' => array(0,'javascript:void(0);','add-new export','','','','',''),
                   'Optimize'=> array(1,'admin/rdb/optimize','optimize copy-existing','','','','',''),
                   'Repair'  => array(2,'admin/rdb/repair','repair enabled','','','','','')
                )
            ),
            'Rebackdb'  => array('DbModel','r', 'admin/rdb/backlist', 'import-icon','', 2, 1,
                array(
                    'Delete'    => array(1, 'admin/rdb/del', '', '', '', '', '', 'ids'),
                    'Reduction' => array(-1, 'admin/rdb/import', '', '', '', '', '', 'ids'),
                ),
            ),
            'Customsql' => array('DbModel','r', 'admin/rdb/excute', 'run-icon','', 3, 1,
                array(
                  'Clearsqllog'=>array(0,'admin/rdb/clearsqllog','add-new ajax-clear','','','','',''),
                )
             ),
            'Application'=> array('General','l', 'admin/module/index', '','', 4, 1),
              'Module'  => array('Application','r', 'admin/module/index', 'list-icon','', 0, 1,
                  array(
                    'Appmarket'=>array(0,'admin/module/market','btn-back ajax-get add',820,600,1,'',''),
                    'Sort'   => array(2,'admin/module/sort','add-new ajax-post','','','','','sorts'),
                    'Appdown'=> array(-1, 'admin/module/down', '', '', '', '', '', ''),
                    'Upgrade'=> array(-1, 'admin/module/update', '', '', '', '', '', ''),
                  )
              ),
              'Extend'   => array('Application','r', 'admin/extend/index', 'addons-icon','', 1, 1,
                  array(
                     'Extendmarket' => array(0, 'admin/extend/market','btn-back ajax-get add',820, 600, 1, '',''),
                     'Sort'   => array(1,'admin/extend/sort','add-new ajax-post','','','','','sorts'),
                     'Enable' => array(-1, 'admin/extend/enable', '', '', '', '', '', 'ids'),
                     'Disable'=> array(-1, 'admin/extend/disable', '', '', '', '', '', 'ids'),
                     'Setting'=> array(-1, 'admin/extend/setting', '', 600, 520, 1, '', ''),
                  )
              ),
             'Plugins' => array('Application','r', 'admin/plugins/index', 'plug-icon','', 2, 1,
                array(
                    'Plugmarket' => array(0, 'admin/plugins/market', 'btn-back ajax-get add',820, 600, 1, '',''),
                    'Enable' => array(1, 'admin/plugins/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(2, 'admin/plugins/disable', '', '', '', '', '', 'ids'),
                    'Setting'=> array(-1, 'admin/plugins/setting', '', 600, 520, 1, '', ''),
                )
             ),
            'Hook' => array('Application','r', 'admin/hook/index', 'hooks-icon','', 3, 1,
                  array(
                      'Hookwh' => array(2,'admin/hook/market','btn-back ajax-get',820,600,1,'', ''),
                      //'Enable' => array(3, 'admin/hook/enable', '', '', '', '', '', 'ids'),
                      //'Disable'=> array(4, 'admin/hook/disable', '', '', '', '', '', 'ids'),
                      //'Edit'   => array(-1, 'admin/domain/edit', '', 640, 480, 1, '', ''),
                  )
              ),
             'Servicelist' => array('Application','r', 'admin/server/index', 'pc-icon','', 3, 1,
                array(
                    'Sermarket' => array(-1,'admin/server/market','btn-back ajax-get',820,600,1,'', ''),
                )
             ),
            'Cmfhelper' => array('Application','r', 'admin/helper/index', 'book-icon','', 4, 0),
    
         'Authority' => array('General','l', 'admin/manager/index', '','', 0, 1),
            'Manager' => array('Authority','r','admin/manager/index','list-icon','', 0, 1,
                array(
                    'Addnew' => array(0, 'admin/manager/add','', 520, 500, 1, '', ''),
                    'Delete' => array(1,'admin/manager/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/manager/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/manager/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/manager/edit', '', 520, 500, 1, '', ''),
                )
            ),
            'Role'   => array('Authority','r','admin/role/index','uu-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'admin/role/add','', 520, 410, 1, '', ''),
                    'Delete' => array(1,'admin/role/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/role/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/role/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'admin/role/edit', '', 520, 410, 1, '', ''),
                )
            ),
            'Auth' => array('Authority','h', 'admin/role/access', 'db-icon','', 1, 1,
                array(
                    'Edit'      => array(-1, 'admin/role/save', '', 960, 700, 1, '', ''),
                )
            ),
            'Managerlog' => array('Authority','r', 'admin/logs/index', 'action-icon', '',2, 1,
                array(
                    'Whole'     => array(0, 'admin/logs/index', 'add-new', '', '', '', '', ''),
                    'View'      => array(-1, 'admin/logs/view', '', 960, 700, 1, '', ''),
                )
            ),
    
          'Logs'        => array('General','l', 'admin/action/index', '', '',2, 1),
            'Useraction'=> array('Logs','r', 'admin/action/index', 'list-icon', '',0, 1,
                array(
                    'Addnew' => array(0, 'admin/action/add', '', 680, 500, 1, '', ''),
                    'Delete' => array(1, 'admin/action/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/action/enable', '', '', '', '', '', ''),
                    'Disable'=> array(4, 'admin/action/disable', '', '', '', '', '', ''),
                    'Edit'   => array(-1, 'admin/action/edit', '', '', '', '', '', ''),
                )
            ),
            'Actionlog' => array('Logs','r', 'admin/logs/actionlog', 'action-icon', '',1, 1,
                array(
                    'Clear' => array(0, 'admin/logs/clear', '','','','',''),
                    'Delete'=> array(1, 'admin/logs/delete', '', '', '', '', '', 'ids'),
                )
            ),
            
            //不受控制器管控的公共访问方法
            'Imageupload'   => array('', 'h', 'admin/index/img', '','', 0, 0),
            //获取控制器及方法列表
            'Getcontroller' => array('', 'h', 'admin/domain/getapps', '','', 0, 0),
        ),

    //顶部菜单
    'admin_panel'   =>array(
         'Cleancache' => array('', '', 'admin/index/clearcache', 'fa fa-home','', 1),
         'Adminmap'   => array('', '', 'admin/index/nav', 'fa fa-home','', 1),
         'Upgrade'   => array('', '', 'admin/upgrade/index', 'fa fa-home','', 1),
         'Logout'     => array('', '', 'admin/passport/logout', 'fa fa-home','', 1),
    ),
);