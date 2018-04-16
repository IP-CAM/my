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
// | Common.php  系统仓库 Version 2016/7/31
// +----------------------------------------------------------------------
namespace warehouses;

use app\common\libs\Warehouse;

class Common extends Warehouse
{
    public $name        = 'Common';
    public $openapiurl;
    public $identity    = 'Common';
    
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup(){
        return array(
            'subjection'    => 'warehouses',                //隶属
            'code'          => 'Common',                    // 扩展器名称名
            'name'          => lang('Common_warehouse'),    // 扩展器名称翻译名
            'description'   => lang('Common_warehouse_desc'),// 扩展器名称翻译描述
            'version'       => '1.0',                       //版本
            'author'        => 'Runtuer',                   //作者
            'website'       => 'http://www.runtuer.com',    //出处
            'upgrade'     => '/cmfup/ver2.php',               //升级位置
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
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'  => 'common.png',
            ),
        );
    }
    
    /**
     * @Mark:请求数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    static public function request(&$data)
    {
        // TODO: Implement request() method.
    }
    
    /**
     * @Mark:接收数据
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    static public function redponse(&$data)
    {
        // TODO: Implement redponse() method.
    }
}