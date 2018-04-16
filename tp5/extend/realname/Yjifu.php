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
// | yjifu.php  Version 2016/12/27
// +----------------------------------------------------------------------
namespace realname;

use app\common\libs\Realname;

class Yjifu extends Realname
{
    private static $url = "https://api.yiji.com";        //POST提交地址
    
    /**
     * @Mark:实现实名验证实体方法
     * @param $item array 姓名，证件号 ['realName'=>'张三','IDcard'=>'429006199909090909']
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/28
     */
    public static function check($item)
    {
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        $data = [
            'service'   => 'realNameQuery',         //请求服务
            'orderNo'   => $config['prefix'] . date('YmdHis') . mt_rand(10, 99), //请求订单号
            'partnerId' => $config['partnerId'],    //商户ID
            'signType'  => 'MD5',                   //签名方式
            'realName'  => $item['realName'],       //姓名
            'certNo'    => $item['IDcard']          //证件号
        ];
        //排序
        ksort($data);
        $signSrc = '';
        foreach ($data as $k => $v) {
            $signSrc .= $k . '=' . $v . '&';
        }
        $signSrc        = trim($signSrc, '&') . $config['key'];
        $data['sign']   = md5($signSrc);
        
        $json = self::post(self::$url, $data);
        $res = json_decode($json, true);
        
        if ($res['success'] === true) {
            return ['code' => 1, 'msg' => lang('success'), 'data' => $res['resultMessage']];
        }
        return ['code' => 0, 'msg' => lang('fail'), 'data' => $res['resultMessage']];
    }
    
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'    => 'realname',    //隶属
            'code'          => 'Yjifu',       // 扩展器名称名
            'name'          => lang('Yjifu_realname'), // 扩展器名称翻译名
            'description'   => lang('Yjifu_realname_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'       => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config' => array(
                'partnerId' => [
                    'title'     => 'Merchant partnerId',
                    'type'      => 'string',
                    'validate'  => 'required',
                ],
                'key' => [
                    'title'     => 'Merchant key',
                    'type'      => 'string',
                    'validate'  => 'required',
                ],
                'prefix' => [
                    'title'     => 'Merchant Prefix',
                    'type'      => 'string',
                    'default'   => generate_prefix(5),    //默认值
                    'length'    => '100',
                    'validate'  => 'required',
                ],
            ),
            //特殊配置项目，可自行定义
            'special' => array(
                'logo'          => 'yjifu.png',
                'appofficial'   => 'https://www.yiji.com/',       //官方
                'country'       => ['zh-cn'],   //适用国家
            ),
        );
    }
}