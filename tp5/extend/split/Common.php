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
// | 非拆单  Version 2016/11/8
// +----------------------------------------------------------------------
namespace split;

use app\common\libs\Split;

class Common extends Split
{
    /**
     * @Mark:接口说明
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/24
     */
    static public function setup()
    {
        return array(
            'subjection'    => 'split',         //隶属
            'code'          => 'Common',        // 扩展器名称名
            'name'          => lang('Common_split'), // 扩展器名称翻译名
            'description'   => lang('Common_split_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                             //版本
            'author'        => 'Runtuer',                         //作者
            'website'       => 'http://www.runtuer.com',          //出处
            'upgrade'     => '/cmfup/ver2.php',                   //升级位置
            //基本配置项
            'config'        => array(
                //购物车类型
                'carttype' => array(
                    'title'     => 'Carttype',
                    'type'      => 'radio',
                    'validate'  => 'required',
                    'default'   => 'cookie',
                    'option'    => [
                        'DB'      => 'db',
                        'Session' => 'session',
                        'Cookie'  => 'cookie',
                    ],
                ),
                //保存类型：session,cookie,db
                'savetype' => array(
                    'title'     => 'Savetype',
                    'type'      => 'select',
                    'validate'  => 'required',
                    'default'   => '',
                    'option'    => [
                        'DB'      => 'db',
                        'Session' => 'session',
                        'Cookie'  => 'cookie',
                    ],
                ),
                //最大可容纳数量
                'maxnumber' => array(
                    'title'     => 'Maxnumber',
                    'type'      => 'number',
                    'validate'  => 'required',
                    'default'   => 10
                ),
                //保存时间
                'savetime' => array(
                    'title'     => 'Savetime',
                    'type'      => 'number',
                    'validate'  => 'required',
                    'length'    => '80',
                    'default'   => '72',
                    'suffix'    => lang('Times'),   //时间后缀
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'          => 'cart.png',
                'appofficial'   => 'http://www.runtuer.com/',         //官方
    
            ),
        );
    }

    /**
     * @Mark:获取商品
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/8
     */
    public function getlist()
    {
        // TODO: Implement getlist() method.
    }
    
    /**
     * @Mark:系统默认不拆单流程
     * @param $data
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/7
     */
    static public function start($data)
    {
        $res_arr = [];
        foreach ($data as $k=>$v) {
            foreach ($v as $kk=>$vv) {
                $v[$kk]['quantity']=$vv['num'];
                $v[$kk]['taxes_fee']=0;
            }
            $res_arr[$k] = array($v);
        }
        return $res_arr;
    }
}