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
        'name'        => 'Member',
        'title'       => '用户管理',
        'icon'        => '',
        'icon_color'  => '',
        'image'       => 'member.png',    //默认指向当前模块view/admin/static/image/user.png
        'description' => '实现用户管理',
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

    //模型配置
    'config' => array(),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        /**
        '节点名' =>array('父节点'， '位置', 'url'， 'css class', 'data-showbar="1" data-width="700" data-height="620"', 排序, 是否权限控制),
            位置：l:左路，r：右，h：隐藏
            是否权限控制 ：1，是，0：否
         **/
        //'General'  => array('','l', 'Admin/index', 'fa fa-home', 1, 1),
        'Member'     => array('','l', 'member/admin.index/index', 'member.png','', 1, 1),
         'User'      => array('Member','l', 'member/admin.index/index', '','', 1, 1),
          'Userlist' => array('User','r', 'member/admin.index/index', 'cat-icon', '', 0, 1,
              array(
                'Addnew' => array(0, 'member/admin.index/add', '', 520, 500, 1, '', ''),
                'Delete' => array(1, 'member/admin.index/delete_false', '', '', '', '', '', 'ids'),
                'Disable'=> array(-1, 'member/admin.group/disable', '', '', '', '', '', 'ids'),
                'Unlock' => array(2, 'member/admin.index/enable', 'btn-refresh ajax-post', '', '', '', '', 'ids'),
                'Lock'   => array(3, 'member/admin.index/disable', 'btn-danger ajax-post', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'member/admin.index/edit', '', 520, 500, 1, '', ''),
                'Resetpw'=> array(-1, 'member/admin.index/resetpassword', 'btn-back ajax-post', '', '', '', '', 'ids'),
                'Editpw'=> array(-1, 'member/admin.index/password', '', '', '', '', '', ''),
            )
        ),
        'Oauth'    => array('User','r', 'member/admin.oauth/index', 'tag-icon','', 1, 1,
            array(
                'Sort'   => array(2, 'member/admin.oauth/sort', '', '', '', '', '', 'sorts'),
                'Enable' => array(3, 'member/admin.oauth/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'member/admin.oauth/disable', '', '', '', '', '', 'ids'),
                'Setting'=> array(-1,'member/admin.oauth/setting', '', 630, 455, 1, '', ''),
            )
        ),
        'Extent'    => array('User','r', 'member/admin.extent/index', 'cat-icon','', 1, 1,
            array(
                'Addnew' => array(0, 'member/admin.extent/add', '', 900, 480, 1, '', ''),
                'Delete'    => array(1, 'member/admin.extent/delete', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'member/admin.extent/edit', '', 520, 320, 1, '', ''),
            )
        ),
        'Invitation' => array('User','r', 'member/admin.invitation/index', 'inv-icon','', 3, 1,
            array(
                'Addnew' => array(0, 'member/admin.invitation/add', '', 520, 320, 1, '', ''),
                'Delete'    => array(1, 'member/admin.invitation/delete', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'member/admin.invitation/edit', '', 520, 320, 1, '', ''),
            )
        ),
        'Memmsgrule' => array('User','r', 'member/admin.message/index', 'rule-icon','',4, 1,
            array(
                'Addnew' => array(0, 'member/admin.message/add', '', 500, 340, 1, '', ''),
                'Delete' => array(1, 'member/admin.message/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'member/admin.message/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'member/admin.message/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'member/admin.message/edit', '', 500, 340, 1, '', ''),
            )
        ),
        'Memmsglog' => array('User','r', 'member/admin.message/membermsglog', 'sms-icon','',5, 1,
            array(
                'View'   => array(-1, 'member/admin.message/view', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'member/admin.message/dellog', '', '', '', '', '', 'ids'),
                'Clear'  => array(2, 'member/admin.message/clear', 'btn-refresh ajax-clear','', '','','','ids'),
            )
        ),
        
        'Usereconomy'    => array('Member','l', 'member/admin.level/index', '', '',2, 1),
           'Userlevelsys'=> array('Usereconomy','r', 'member/admin.level/index', 'uu-icon','', 0, 1,
                array(
                    'Addnew' => array(0, 'member/admin.level/add', '', 640, 535, 1, '', ''),
                    'Delete' => array(1, 'member/admin.level/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'member/admin.level/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'member/admin.level/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'member/admin.level/edit', '', 640, 535, 1, '', ''),
                )
            ),
            'Agentsys'=> array('Usereconomy','r', 'member/admin.agent/index', 'cat-icon','', 1, 1,
                array(
                    'Addnew' => array(0, 'member/admin.agent/add', '', 660, 460, 1, '', ''),
                    'Delete' => array(1, 'member/admin.agent/delete', '', '', '', '', '', 'ids'),
                    'Sort'   => array(2, 'member/admin.agent/sort', '', '', '', '', '', 'sorts'),
                    'Enable' => array(3, 'member/admin.agent/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'member/admin.agent/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'member/admin.agent/edit', '', 660, 460, 1, '', ''),
                )
            ),
            'Memberconf' => array('Usereconomy','r','member/admin.config/index', 'conf-icon','', 2, 1,
                array(
                    'Save'   => array(-1, 'member/admin.config/save', '', '', '', 1, '', ''),
                )
            ),
            'Regagreement' => array('Usereconomy','r','member/admin.config/regagreement', 'protocol-icon','', 3, 1,
                array(
                    'Save'   => array(-1, 'member/admin.config/save?act=regagreement', '', '', '', 1, '', ''),
                )
            ),
            'Privacypolicy' => array('Usereconomy','r','member/admin.config/privacypolicy', 'job-icon','', 4, 1,
                array(
                    'Save'   => array(-1, 'member/admin.config/save?act=privacypolicy', '', '', '', 1, '', ''),
                )
            ),
            'Usertag'  => array('Usereconomy','r', 'member/admin.tag/index', 'tag-icon','', 6, 1,
                array(
                    'Addnew' => array(0, 'member/admin.tag/add', '', 580, 330, 1, '', ''),
                    'Delete' => array(1, 'member/admin.tag/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'member/admin.tag/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'member/admin.tag/disable', '', '', '', '', '', 'ids'),
                    'Edit'   => array(-1, 'member/admin.tag/edit', '', 580, 330, 1, '', ''),
                )
            ),
    
        'Reportmem' => array('Member','l', 'member/admin.report/index', '','',2, 1, ''),
          'rMember' => array('Reportmem','r','member/admin.report/index','list-icon','', 0, 1,
              array(
                  'Whole'  => array(1, 'member/admin.report/index', 'add-new', '', '', '', '', ''),
                  'View'   => array(-1, 'member/admin.comment/add', '', 630, 455, 1, '', ''),
                  'Replay' => array(-1, 'member/admin.comment/add', '', '', '', '', '', ''),
              ),
          ),
          'CW_Report'=> array('Reportmem','r', 'member/admin.report/cash', 'report-icon','', 1, 1,
              array(
                  'Whole'  => array(1, 'member/admin.report/cash', 'add-new', '', '', '', '', ''),
              )
          ),

        'Usercontent'=> array('Member','l', 'member/admin.comment/index', '', '', 3, 1),
          'Comment'  => array('Usercontent','r','member/admin.comment/index','comment-icon','', 1, 1,
              array(
                  'View'   => array(-1, 'member/admin.comment/add', '', 630, 455, 1, '', ''),
                  'Replay' => array(-1, 'member/admin.comment/add', '', '', '', '', '', ''),
                  'Delete' => array(2, 'member/admin.comment/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(3, 'member/admin.comment/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(4, 'member/admin.comment/disable', '', '', '', '', '', 'ids'),
              )
          ),
          'Appeal'   => array('Usercontent','r', 'member/admin.appeal/index', 'list-icon','', 2, 1,
              array(
                  'View'   => array(-1, 'member/admin.appeal/add', '', 630, 455, 1, '', ''),
                  'Replay' => array(-1, 'member/admin.appeal/add', '', '', '', '', '', ''),
                  'Delete' => array(2, 'member/admin.appeal/delete', '', '', '', '', '', 'ids'),
                  'Enable' => array(-1, 'member/admin.appeal/enable', '', '', '', '', '', 'ids'),
                  'Disable'=> array(-1, 'member/admin.appeal/disable', '', '', '', '', '', 'ids'),
              )
          ),
        'Consultation'=> array('Usercontent','r','member/admin.consultation/index', 'consultation-icon', '', 1, 1,
            array(
                'View'   => array(-1, 'member/admin.consultation/add', '', 630, 455, 1, '', ''),
                'Replay' => array(-1, 'member/admin.consultation/add', '', '', '', '', '', ''),
                'Delete' => array(2, 'member/admin.consultation/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(-1, 'member/admin.consultation/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(-1, 'member/admin.consultation/disable', '', '', '', '', '', 'ids'),
            )
        ),
        'Feedback'   => array('Usercontent','r','member/admin.feedback/index','feedback-icon','',4, 1,
            array(
                'Addnew'   => array(-1, 'member/admin.feedback/add', '', 500, 455, 1, '', ''),
                'Replay' => array(-1, 'member/admin.feedback/add', '', '', '', '', '', ''),
                'Delete' => array(2, 'member/admin.feedback/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(-1, 'member/admin.feedback/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(-1, 'member/admin.feedback/disable', '', '', '', '', '', 'ids'),
                'Edit'  => array(-1, 'member/admin.feedback/edit', '', 630, 455, 1, '', ''),
            )
        ),
        'Autoreplay' => array('Usercontent','r','member/admin.autoreplay/index','export-icon','',5, 1,
            array(
                'Addnew' => array(0, 'member/admin.autoreplay/add', '', 630, 455, 1, '', ''),
                'Delete' => array(1, 'member/admin.autoreplay/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(3, 'member/admin.autoreplay/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(4, 'member/admin.autoreplay/disable', '', '', '', '','', 'ids'),
                'Edit'   => array(-1, 'member/admin.autoreplay/edit', '', 630, 455, 1, '', ''),
            )
        ),

        'Deposit_experi'=> array('Member','l', 'member/admin.deposit/index', '', '', 3, 1),
          'Deposit'=>array('Deposit_experi','r','member/admin.deposit/index','curr-icon','',0, 1,
              array(
                  'View'   => array(-1, 'member/admin.deposit/view', '', '', '', '', '', ''),
                  'Whole'  => array(1, 'member/admin.deposit/index', 'add-new', '', '', '', '', ''),
              )
         ),
        'Without'=> array('Deposit_experi','r', 'member/admin.cash/without', 'app-icon','', 1, 1,
            array(
                'View'   => array(0, 'member/admin.cash/add', '', 630, 455, 1, '', ''),
                'Replay' => array(-1, 'member/admin.cash/add', '', '', '', '', '', ''),
                'Delete' => array(2, 'member/admin.cash/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(-1, 'member/admin.cash/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(-1, 'member/admin.cash/disable', '', '', '', '', '', 'ids'),
                'Edit'   => array(-1, 'member/admin.cash/edit', '', 500, 455, 1, '', ''),
            )
        ),
        'Cash'   => array('Deposit_experi','r', 'member/admin.cash/index', 'cat-icon','', 2, 1,
            array(
                'View'   => array(0, 'member/admin.cash/add', '', 630, 455, 1, '', ''),
                'Replay' => array(-1, 'member/admin.cash/add', '', '', '', '', '', ''),
                'Delete' => array(2, 'member/admin.cash/delete', '', '', '', '', '', 'ids'),
                'Enable' => array(-1, 'member/admin.cash/enable', '', '', '', '', '', 'ids'),
                'Disable'=> array(-1, 'member/admin.cash/disable', '', '', '', '', '', 'ids'),
            )
        ),
    
        'Experi' => array('Deposit_experi','r', 'member/admin.experience/index','list-icon','',4, 1,
            array(
                'View'   => array(-1, 'member/admin.experience/view', '', '', '', '', '', ''),
                'Whole'  => array(1, 'member/admin.experience/index', 'add-new', '', '', '', '', ''),
            )
        ),
    ),

    //顶部菜单
    'admin_panel'   =>array(
        'Manageteam'=> array('','', 'admin/manage/index', '', '', 2),
            'Comment' => array('Manageteam','','admin/manage/index', 'comment-icon', '', 1,
                array(
                    'View'   => array(0, 'admin/manage/add', '', 630, 455, 1, '', ''),
                    'Replay' => array(-1, 'admin/manage/add', '', '', '', '', '', ''),
                    'Delete' => array(2, 'admin/manage/delete', '', '', '', '', '', 'ids'),
                    'Enable' => array(3, 'admin/manage/enable', '', '', '', '', '', 'ids'),
                    'Disable'=> array(4, 'admin/manage/disable', '', '', '', '', '', 'ids'),
                )
            ),
    ),
);