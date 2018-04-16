<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Common.php  Version 2017/9/19
// +----------------------------------------------------------------------
namespace onlinexpress;

use app\common\libs\Onlinexpress;

class Common extends Onlinexpress
{
    /**
     * @Mark:扩展、插件配置说明
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/11
     */
    static public function setup()
    {
        return array(
            'subjection'    => 'Onlinexpress',              //隶属
            'code'          => 'Common',                    // 扩展器名称名
            'name'          => lang('Common_onlinexpress'),       // 扩展器名称翻译名
            'description'   => lang('Common_onlinexpress_desc'),  // 扩展器名称翻译描述
            'version'       => '1.0',                       //版本
            'author'        => 'Runtuer',                   //作者
            'website'       => 'http://www.runtuer.com',    //出处
            'upgrade'     => '/cmfup/ver2.php',               //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'  => 'order.png',
            ),
        );
    }
    
    /**
     * @Mark:获取快递公司列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/19
     */
    public function get_exp_list()
    {
        // TODO: Implement get_exp_list() method.
    }
    
}