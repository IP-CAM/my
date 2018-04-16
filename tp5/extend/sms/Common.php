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
// | 通用短信发货接口  Version 2016/7/23
// +----------------------------------------------------------------------
namespace sms;
use app\common\libs\Sms;

class Common extends Sms
{
    /**
     * @Mark:接口说明
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/24
     */
    static public function setup()
    {
        return array(
            'subjection'    => 'sms',         //隶属
            'code'          => 'Common',     // 扩展器名称名
            'name'          => lang('Common_sms'), // 扩展器名称翻译名
            'description'   => lang('Common_sms_desc'), // 扩展器名称翻译描述
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
     * @Mark:发送
     * @param $mobile 13322936015
     * @param $content  json_encode(['code'=>1234,'product'=>'闰土科技'])
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/12
     */
    public static function send($mobile, $content)
    {
        
    }

    /**
     * @Mark:处理发送结果
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/23
     */
    static public function response($result)
    {

    }

}