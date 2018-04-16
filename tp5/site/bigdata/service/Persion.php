<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Hscode.php  Version 2017/5/17 个人信息采集器API接口
// +----------------------------------------------------------------------
namespace app\bigdata\service;

use think\Model;
use app\bigdata\model\Persion as Mpersion;

class Persion extends Model
{
    /**
     * @Mark:店铺列表
     * @param $where array 查询条件
     * @param $order array 排序条件
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return mixed
     */
    static public function allList($where = [],$order = ['id'=>'desc'])
    {
        $re  = Mpersion::where($where)->order($order)->paginate(25);
        return $re;
    }
}