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
// | 易极付推送支付单接口  Version 2016/11/25
// +----------------------------------------------------------------------
namespace paypush;

use app\common\libs\Paypush;

class Yjifu extends Paypush
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    static public function setup(){
        return array(
            'subjection'    => 'paypush',  //隶属
            'code'          => 'Yjifu',    // 扩展器名称名
            'name'          => lang('Yjifu_paypush'), // 扩展器名称翻译名
            'description'   => lang('Yjifu_paypush_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                      //版本
            'author'        => 'Runtuer',                  //作者
            'website'       => 'http://www.runtuer.com',   //出处
            'upgrade'       => '/cmfup/ver2.php',            //升级位置
            //基本配置项
            //基本配置项
            'config'        => array(
                'pay_name' => array(
                    'title'     => 'Pay name',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'parterid' => array(
                    'title'     => 'Parter ID',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'key' => array(
                    'title'     => 'Payment key',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'account' => array(
                    'title'     => 'Pay account',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'warehouse' => array(
                    'title'     => 'Storehouse',
                    'type'      => 'string',
                    'length'    => 260,
                    'tip'       => 'A001;B001;C001;D001',
                    'validate'  => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'          => 'yjifu.png',
                'appofficial'   => 'https://www.yiji.com',         //官方
                'country'       => ['zh-cn'],//适用国家
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