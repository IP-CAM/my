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
// | 本地系统订单数据  Version 2016/11/10
// +----------------------------------------------------------------------
namespace orders;

use app\common\libs\Order;

class Common extends Order
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup(){
        return array(
            'subjection'    => 'orders',                    //隶属
            'code'          => 'Common',                    // 扩展器名称名
            'name'          => lang('Common_orders'),       // 扩展器名称翻译名
            'description'   => lang('Common_orders_desc'),  // 扩展器名称翻译描述
            'version'       => '1.0',                       //版本
            'author'        => 'Runtuer',                   //作者
            'website'       => 'http://www.runtuer.com',    //出处
            'upgrade'     => '/cmfup/ver2.php',               //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'  => 'order.png',
            ),
        );
    }
    
    /**
     * @Mark:组合/创建订单数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    public function create()
    {
        // TODO: Implement create() method.
    }
    
    /**
     * @Mark:写订单，可写本地或者外部
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    public function send_to()
    {
        // TODO: Implement send_to() method.
    }
    
    /**
     * @Mark:处理回调
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    public function callback()
    {
        // TODO: Implement callback() method.
    }
    
}