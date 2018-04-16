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
// | Alidayu.php  Version 2016/7/23
// +----------------------------------------------------------------------
namespace sms;

use app\common\libs\Sms;
use sms\Alidayu\TopClient;
use sms\Alidayu\AlibabaAliqinFcSmsNumSendRequest;

class Alidayu extends Sms
{
    /**
     * @Mark:接口说明
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/24
     */
    static public function setup()
    {
        return array(
            'subjection'  => 'sms',         //隶属
            'code'        => 'Alidayu',     // 扩展器名称名
            'name'        => lang('Alidayu_sms'), // 扩展器名称翻译名
            'description' => lang('Alidayu_sms_desc'), // 扩展器名称翻译描述
            'version'     => '1.0',                                    //版本
            'author'      => 'Runtuer',                                //作者
            'website'     => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config'      => array(
                'appkey'    => [
                    'title'    => 'appKey',
                    'type'     => 'string',
                    'validate' => 'required',
                ],
                'secretKey' => [
                    'title'    => 'secretKey',
                    'type'     => 'string',
                    'validate' => 'required',
                ],
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo' => 'alidayu.png',
            ),
        );
    }
    
    /**
     * @Mark:发送
     * @param $mobile 13322936015
     * @param $content array ['code'=>1234,'product'=>'闰土科技']
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/12
     */
    public static function send($mobile, $content)
    {
        $config       = self::config(self::setup());
        $c            = new TopClient;
        $c->appkey    = $config['appkey'];
        $c->secretKey = $config['secretKey'];
        define('TOP_SDK_WORK_DIR', CACHE_PATH . 'sms_tmp/');
        define('TOP_SDK_DEV_MODE', false);
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend('');
        $req->setSmsType('normal');
        $req->setSmsFreeSignName($config['free_sign_name']);
        $req->setSmsParam(json_encode($content));
        $req->setRecNum($mobile);
        $req->setSmsTemplateCode($config['template_id']);
        $result = $c->execute($req);
        $result = self::response($result);
        if (isset($result['code'])) {
            return ['code' => 0, 'data' => $result, 'msg' => $result['msg']];
        }
        return ['code' => 1, 'data' => $result];
    }
    
    /**
     * @Mark:该函数用于转化阿里大于返回的数据，将simplexml格式转化为数组，方面后续使用
     * @param $obj
     * @return array|string
     * @Author: fancs
     * @Version 2017/7/5
     */
    static public function response($obj)
    {
        if (count($obj) >= 1) {
            $result = $keys = [];
            foreach ($obj as $key => $value) {
                isset($keys[$key]) ? ($keys[$key] += 1) : ($keys[$key] = 1);
                if ($keys[$key] == 1) {
                    $result[$key] = self::response($value);
                } elseif ($keys[$key] == 2) {
                    $result[$key] = [$result[$key], self::response($value)];
                } else if ($keys[$key] > 2) {
                    $result[$key][] = self::response($value);
                }
            }
            return $result;
        } else if (count($obj) == 0) {
            return (string)$obj;
        }
    }
    
    
}