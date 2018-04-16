<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Category.php  Version 2017/7/17
// +----------------------------------------------------------------------

namespace app\seller\service;

use think\Loader;
use think\Model;
use app\seller\model\GoodsCategory as GoodsCategoryModel;

class Category extends Model
{
    /**
     * @Mark:分类列表
     * @param $where = [
     *      'where'     =>['seller_id'=>2,'langid'=>LANG],
     *      'order'     =>['id desc'],
     * ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    static public function categoryList($where)
    {
        $data = GoodsCategoryModel::where($where['where'])->order($where['order'])->select()->toArray();
        $arr = [];
        foreach ($data as $k => $v) {
            if ($v['pid'] != 0) continue;
            $arr[$k] = $v;
            $arr[$k]['son'] = [];
            foreach ($data as $vv) {
                if ($vv['pid'] != $v['id'] || $vv['pid'] == 0) continue;
                $arr[$k]['son'][] = $vv;
            }
        }
        return $arr;
    }
    
    /**
     * @Mark:新增商品分类
     * @param $data
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    static public function addCategory($data)
    {
        //数据验证
        $className = Loader::parseClass('seller', 'validate', 'GoodsCategory');
        $validate = Loader::validate($className);
        if (!$validate->check($data)) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据入库
        $res = GoodsCategoryModel::create($data);
        return ['code'=>1,'data'=>$res];
    }
    
    /**
     * @Mark:修改分类
     * @param $data
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    static public function editCategory($data)
    {
        //数据验证
        $className = Loader::parseClass('seller', 'validate', 'GoodsCategory');
        $validate = Loader::validate($className);
        if (!$validate->scene('update')->check($data)) return ['code' => 0, 'msg' => $validate->getError()];
        
        //数据入库
        $res = GoodsCategoryModel::update($data);
        return ['code'=>1,'data'=>$res];
    }
    
    /**
     * @Mark:删除分类
     * @param $id int 分类id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     * @return array
     */
    static public function delCategory($id)
    {
        //判断是否有下级分类，如果有，则无法删除
        $re = GoodsCategoryModel::where(['pid' => $id])->find();
        if ($re) return ['code' => 0, 'msg' => lang('exist_next_categoey')];
        $res = GoodsCategoryModel::destroy($id);
        if ($res) {
            return ['code' => 1, 'msg' => lang('del_ok')];
        } else {
            return ['code' => 0, 'msg' => lang('del_fail')];
        }
    }
    
    /**
     * @Mark:商品绑定店铺分类
     * @param $data = [
     *      'id'    =>  '1',分类id
     *      'goods_ids'=>   [1],商品id
     * ]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     * @return boolean
     */
    static public function bindGoods($data)
    {
        GoodsCategoryModel::update($data);
        return true;
    }
}
