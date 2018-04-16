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
// | Tms.php  Version 2017/3/20 TMS快递查询接口
// +----------------------------------------------------------------------
namespace expresss;

use app\common\libs\Express;

class Tms extends Express
{
    static public function setup()
    {
        return array(
            'subjection'    => 'expresss',    //隶属
            'code'          => 'Tms',     // 扩展器名称名
            'name'          => lang('Tms_express'), // 扩展器名称翻译名
            'description'   => lang('Tms_express_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                    //版本
            'author'        => 'Runtuer',                //作者
            'website'       => 'http://www.runtuer.com', //出处
            'upgrade'       => '/cmfup/ver2.php',            //升级位置
            //基本配置项
            'config'        => array(
                'Merchantid'    => array(
                    'title'     =>'Merchant ID',
                    'type'      =>'string',
                    'validate'  =>'required',
                ),
                'Appid'         => array(
                    'title'     =>'AppID',
                    'type'      =>'string',
                    'validate'  =>'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'      => 'kdn.png',
                'appofficial'  => 'https://www.runtuer.com/', //官方
            ),
        );
    }
    
    /**
     * @Mark:获取快递结果
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