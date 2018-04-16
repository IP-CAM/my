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
// | Pingan.php  Version 2016/7/23 平安保险赔付接口
// +----------------------------------------------------------------------
namespace lnsurance;

use app\common\libs\Lnsurance;

class Pingan extends Lnsurance
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup(){
        return array(
            'subjection'    => 'lnsurance',    //隶属
            'code'          => 'Pingan',     // 扩展器名称名
            'name'          => lang('Pingan_lnsurance'), // 扩展器名称翻译名
            'description'   => lang('Pingan_lnsurance_desc'), // 扩展器名称翻译描述
            
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'      => 'pingan.png',
                'appofficial'  => 'https://www.runtuer.com/',         //官方
            ),
        );
    }
    
    /**
     * @Mark:请求保险
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    public function request(&$data)
    {
        // TODO: Implement request() method.
    }
    
    /**
     * @Mark:获取保险赔付
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    public function response(&$data)
    {
        // TODO: Implement response() method.
    }
    
    
}