<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// ----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Haoservice.php  Version 2017/6/30
// +----------------------------------------------------------------------
namespace realname;

use app\common\libs\Realname;

class Haoservice extends Realname
{
    private static $url = "http://apis.haoservice.com/idcard/VerifyIdcard";        //提交地址
    
    /*
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'    => 'realname',                  //隶属
            'code'          => 'Haoservice',                // 扩展器名称名
            'name'          => lang('Hao_realname'),        // 扩展器名称翻译名
            'description'   => lang('Hao_realname_desc'),   // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'       => '/cmfup/ver2.php',                            //升级位置
            //基本配置项
            'config' => array(
                'key' => [
                    'title'     => 'API KEY',
                    'type'      => 'string',
                    'validate'  => 'required',
                ],
            ),
            //特殊配置项目，可自行定义
            'special' => array(
                'logo'          => 'haoservice.png',
                'appofficial'   => 'http://www.haoservice.com',       //官方
                'country'       => ['zh-cn'],   //适用国家
            ),
        );
    }
    
    /**
     * @Mark:实现实名验证实体方法
     * @param $item = [
     *      'IDcard'    =>  432826199302123031      //证件号
     *      'realName'  =>  '张三'                  //姓名
     * ]
     * @return array
     * @Author: fancs
     * @Version 2017/6/30
     */
    public static function check($item)
    {
        $param = [
            'realName'  => $item['realName'],
            'cardNo'    => $item['IDcard'],
        ];
        //获取配置信息
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        $param['key'] = $config['key'];
        $res = json_decode(self::post(self::$url, $param, false));
        
        if($res['result']['isok']){
            return ['code' => 1, 'msg' => lang('success'), 'data' => $res['result']['isok']];
        } else {
            return ['code' => 0, 'msg' => lang('fail'), 'data' => $res['result']['isok']];
        }
    }
    
}