<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Shopcat.php  Version 店铺类型  2017/5/25
// +----------------------------------------------------------------------
namespace app\seller\service;

use think\Model;
use think\Loader;

class Shopcat extends Model
{
    /**
     * @Mark: 添加分类
     * @param $data array ['name'=>'数码3C','sort'=>1,'deposit'=>'100000','commission'=>'10']
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return array
     */
    static public function addCat($data)
    {
        $shopcat_class = Loader::parseClass('seller', 'validate', 'Shopcat');
        $validate = Loader::validate($shopcat_class);
        $result = $validate->check($data);
        if (!$result) return ['code' => 0, 'msg' => $validate->getError()];
        $re = \app\seller\model\Shopcat::create($data);
        if ($re !== false) {
            return ['code' => 1, 'data' => $re];
        } else {
            return ['code' => 0, 'msg' => lang('fail')];
        }
    }
    
    /**
     * @Mark:修改商家分类
     * @param $data = [
     *      'id'    =>1     分类id
     *      ...
     * ];
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return array
     */
    static public function editCat($data)
    {
        $shopcat_class = Loader::parseClass('seller', 'validate', 'Shopcat');
        $validate = Loader::validate($shopcat_class);
        $result = $validate->check($data);
        if (!$result) return ['code' => 0, 'msg' => $validate->getError()];
        $re = \app\seller\model\Shopcat::update($data);
        if ($re !== false) {
            return ['code' => 1, 'data' => $re];
        } else {
            return ['code' => 0, 'msg' => lang('fail')];
        }
    }
    
    /**
     * @Mark:删除分类
     * @param   $id array 分类id
     *      $id = [1,2,3,4,5]
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/22
     * @return array
     */
    static public function delCat($id)
    {
        $re = \app\seller\model\Shopcat::where(['id' => ['in', implode(',', $id)]])->setField('status', -1);
        if ($re !== false) {
            return ['code' => 1, 'data' => $re];
        } else {
            return ['code' => 0, 'msg' => lang('fail')];
        }
    }
    
    /**
     * @Mark:商家分类列表
     * @param $where array
     * @Author yang <502204678@qq.com>
     * @Version 2017/5/25
     * @return mixed
     */
    static public function catList($where = ['status' => ['>=', 0]])
    {
        $list = \app\seller\model\Shopcat::where($where)->select();
        return $list;
    }
}