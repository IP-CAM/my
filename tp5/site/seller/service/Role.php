<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Role.php  Version 2017/6/15
// +----------------------------------------------------------------------

namespace app\seller\service;

use think\Model;
use think\Loader;
use app\seller\model\Role as RoleModel;

class Role extends Model
{
    /**
     * @Mark:添加角色
     * @param $data = [
     *      'right'     =>"seller/index/index;seller/index/add"          url路由字符串  seller/index/index;seller/index/add
     *      'name'      =>'客服'       角色名称
     * ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/15
     */
    static public function add_role($data)
    {
        //数据验证
        $role_class = Loader::parseClass('seller', 'validate', 'Role');
        $validator = Loader::validate($role_class);
        $re = $validator->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validator->getError()];
        
        //数据入库
        $result = RoleModel::create($data);
        if ($result !== false) {
            return ['code' => 1, 'data' => $result];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
    
    /**
     * @Mark:修改角色权限
     * @param $data = [
     *            'id'=>1         角色id
     *          'name'=>'客服'
     *         'right'=>'seller/index/index;seller/index/add'
     * ]
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/21
     */
    static public function edit_role($data)
    {
        //数据验证
        $role_class = Loader::parseClass('seller', 'validate', 'Role');
        $validator = Loader::validate($role_class);
        $re = $validator->check($data);
        if (!$re) return ['code' => 0, 'msg' => $validator->getError()];
        
        //数据入库
        $result = RoleModel::where(['id' => $data['id']])->update($data);
        
        if ($result !== false) {
            return ['code' => 1, 'data' => $result];
        } else {
            return ['code' => 0, 'msg' => lang('service_buzy')];
        }
    }
}
