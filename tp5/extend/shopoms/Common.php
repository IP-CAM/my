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
// | Goods.php  Version 2017/2/26  OMS与商城系统商品同步类接口
// +----------------------------------------------------------------------
namespace shopoms;

use app\common\libs\Shopoms;

class Common extends Shopoms
{
    /**
     * @Mark:实现具体方法
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/26
     */
    static public function setup()
    {
        return array(
            'subjection'    => 'shopoms',                       //隶属
            'code'          => 'Common',                     // 扩展器名称名
            'name'          => lang('Common_shopoms'),           // 扩展器名称翻译名
            'description'   => lang('Common_shopoms_desc'),      // 扩展器名称翻译描述
            'version'       => '1.0',                       //版本
            'author'        => 'Runtuer',                   //作者
            'website'       => 'http://www.runtuer.com',    //出处
            'upgrade'     => '/cmfup/ver2.php',               //升级位置
            //基本配置项
            'config'        => array(
                'appKey' => array(
                    'title'     => 'App Key',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
                'appSecret' => array(
                    'title'     => 'App Secret',
                    'type'      => 'string',
                    'validate'  => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'      => 'oms.png',
            ),
        );
    }
    
    /**
     * @Mark:推送订单数据到OMS
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/17
     */
    static public function syncOrder(&$data)
    {
        if(true)
        {
            return ['code' => 1, 'msg' => 'Succ'];
        }
        
        return ['code' => 0, 'msg' => 'Fail'];
    }
    
    /**
     * @Mark:推送订单数据到OMS 商城到OMS
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/17
     */
    static public function sendOrder(&$data)
    {
        if(true)
        {
            return ['code' => 1, 'msg' => 'Succ'];
        }
    
        return ['code' => 0, 'msg' => 'Fail'];
    }
    
    /**
     * @Mark:同步：同步商品到OMS
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    static public function syncGoods(&$data)
    {
        if(true)
        {
            return ['code' => 1, 'msg' => 'Succ'];
        }
        
        return ['code' => 0, 'msg' => 'Fail'];
    }
    
    
    
}