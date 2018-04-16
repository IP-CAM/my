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
// | 海关总署版统一接口  Version 2016/11/10
// +----------------------------------------------------------------------
namespace seas;

use app\common\libs\Sea;

class Common extends Sea
{
    static private $callbackurl = '';              //消息回调地址
    static private $send_dir    = 'c:/data/send/';

    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    static public function setup(){
        return array(
            'subjection'    => 'seas',                  //隶属
            'code'          => 'Common',                // 扩展器名称名
            'name'          => lang('Common_seas'),     // 扩展器名称翻译名
            'description'   => lang('Common_seas_desc'),    // 扩展器名称翻译描述
            'version'       => '1.0',                       //版本
            'author'        => 'Runtuer',                   //作者
            'website'       => 'http://www.runtuer.com',    //出处
            'upgrade'     => '/cmfup/ver2.php',               //升级位置
            //基本配置项
            'config'        => array(
                'secret' => array(
                    'title' => 'Secret',
                    'type'  => 'string',
                    'validate' => 'required',
                ),
                'key' => array(
                    'title' => 'Payment key',
                    'type' => 'string',
                    'validate' => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'          => null,
                'country'       => ['zh-cn'],   //适用国家
                'appofficial'   => 'https://www.runtuer.com/',         //官方
            ),
        );
    }
    
    /**
     * @Mark:向海关接口发送数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    public function send_to_sea()
    {
        // TODO: Implement send_to_sea() method.
    }
    
    /**
     * @Mark:回写请求
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    public function callback()
    {
        // TODO: Implement callback() method.
    }
    
}