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
// | Common.php  Version 2016/11/9  系统商品接口
// +----------------------------------------------------------------------
namespace products;

use app\common\libs\Product;

class Common extends Product
{
    
    /**
     * @Mark:获取商品列表
     * @param array $where
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/9
     */
    public function getlist($where = array())
    {
        
    }
    
    /**
     * @Mark:获取单个商品
     * @param $sku
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/9
     */
    public function getone($sku)
    {
        
    }
    
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup(){
        return array(
            'subjection'    => 'products',                      //隶属
            'code'          => 'Common',                        // 扩展器名称名
            'name'          => lang('Common_products'),         // 扩展器名称翻译名
            'description'   => lang('Common_products_desc'),    // 扩展器名称翻译描述
            'version'       => '1.0',                                    //版本
            'author'        => 'Runtuer',                                //作者
            'website'       => 'http://www.runtuer.com',                 //出处
            'upgrade'     => '/cmfup/ver2.php',                             //升级位置
            //基本配置项
            'config'        => array(),
            //特殊配置项目，可自行定义
            'special'       => array(
                
            ),
        );
    }
}