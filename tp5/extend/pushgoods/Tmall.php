<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Tmall.php  Version 2017/9/1
// +----------------------------------------------------------------------
namespace pushgoods;

use app\common\libs\Pushgoods;

class Tmall extends Pushgoods
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
            'subjection'    => 'pushgoods',    //隶属
            'code'          => 'Tmall',     // 扩展器名称名
            'name'          => lang('Tmall_pushgoods'), // 扩展器名称翻译名
            'description'   => lang('Tmall_pushgoods_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'  => 'common.png',
            ),
        );
    }
    
    /**
     * @Mark:推送商品
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    public function push()
    {
        // TODO: Implement push() method.
    }
    
    /**
     * @Mark:推送后的日志回写
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    public function logs()
    {
        // TODO: Implement logs() method.
    }
    
}