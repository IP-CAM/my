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
// | 微信跨境支付  Version 2016/11/25
// +----------------------------------------------------------------------
namespace paypush;

use app\common\libs\Paypush;

class Wechat extends Paypush
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'  => 'paypush',  //隶属
            'code'        => 'Wechat',    // 扩展器名称名
            'name'        => lang('Wechat_paypush'),      //扩展器名称翻译名
            'description' => lang('Wechat_paypush_desc'), //扩展器名称翻译描述
            'version'     => '1.0',                            //版本
            'author'      => 'Runtuer',                        //作者
            'website'     => 'http://www.runtuer.com',         //出处
            'upgrade'     => '/cmfup/ver2.php',                  //升级位置
            
            //限制平台
            'platform'    => array(
                'title'   => 'Platform',
                'type'    => 'radio',     //类型
                'default' => 'wap_app',    //默认值
                'tip'     => lang('In wechat'),    //提示
                'option'  => [            //列出的可选值
                    'wap_app' => 'Wap/App',
                ],
            ),
            
            //基本配置项
            'config'      => array(
                'pay_name'      => array(
                    'title'    => 'Pay name',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'mchid'         => array(
                    'title'    => 'Mchid',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'appid'         => array(
                    'title'    => 'Wechat Appid',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'key'           => array(
                    'title'    => 'Wechat key',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'secert'        => array(
                    'title'  => 'Wechat secert',
                    'tip'    => 'only JSAPI must',
                    'type'   => 'string',
                    'length' => 300,
                ),
                'warehouse'     => array(
                    'title'    => 'Storehouse',
                    'type'     => 'string',
                    'length'   => 260,
                    'tip'      => 'A001;B001;C001;D001',
                    'validate' => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo'        => 'wechat.png',
                'appofficial' => 'https://mp.weixin.qq.com/',         //官方
                'country'     => ['zh-cn'],//适用国家
            ),
        );
    }
    
    /**
     * @Mark:推送支付单
     * @param $sendData
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/10
     */
    public function doPush($sendData)
    {
        // TODO: Implement doPush() method.
    }
    
    /**
     * @Mark:查询推送的支付单
     * @param $sendData
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/16
     */
    public function doQuery($sendData)
    {
        // TODO: Implement doQuery() method.
    }
    
    /**
     * @Mark:获取提交地址
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/23
     */
    public function getSubmitUrl()
    {
        // TODO: Implement getSubmitUrl() method.
    }
    
    
}