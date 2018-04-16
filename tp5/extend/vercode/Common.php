<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// ----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 验证码  Version 2016/11/8
// +----------------------------------------------------------------------
namespace vercode;

use app\common\libs\Vercode;

class Common extends Vercode
{
    /**
     * @Mark:接口说明
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/24
     */
    public static function setup()
    {
        return array(
            'subjection'    => 'vercode',       //隶属
            'code'          => 'Common',        // 扩展器名称名
            'name'          => lang('Common_vercode'), // 扩展器名称翻译名
            'description'   => lang('Common_vercode_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'      => 'cart.png',
    
            ),
        );
    }
    
    static public function create($data)
    {
    
    }
    
   
}