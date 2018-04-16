<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Address.php  Version 2017/6/26 收货地址API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Address extends Service
{
    /**
     * @Mark:查询收货地址
     * @param $data = [
     *          'name'  =>  'fancs/3'   //用户名/手机/邮箱/id
     *          'id'    =>  2,          //id
     * ]
     * @return bool|null|\think\response\Json|static
     * @Author: fancs
     * @Version 2017/6/26
     */
    static public function get_address(&$data)
    {
        if(isset($data['id'])){
            $address = \app\member\model\Address::get($data['id']);
        }else{
            //检测用户
            $info = Member::getUserInfo($data);
            if(!$info) return false;
            $address = \app\member\model\Address::all(function ($query) use ($info){
                $query->where(['langid'=>LANG,'uid'=>$info['id']]);
            });
        }
        if(empty($address)) return false;
        return $address;
    }
    /**
     * @Mark:新增/编辑收货地址
     * @param $data =[
     *      //新增
     *      'uid'           => '3',          //用户id
     *      'consignee'     => '张三',        //收货人
     *      'country'       => '44',         //国家id
     *      'province'      => '100000'      //省id
     *      'city'          => '422144'      //市id
     *      'district'      => '444888'      //县id
     *      'address'       => '海城新村1区90号'       //详细地址
     *      'mobile'        => '13111111111'         //手机号码
     *      'langid'        => 'zh-cn'               //语言
     *      //更新
     *      'id'            => $id,          //如果是更新有id
     *      'uid'           => '3',          //用户id
     *      'consignee'     => '张三',        //收货人
     *      'country'       => '44',         //国家id
     *      'province'      => '100000'      //省id
     *      'city'          => '422144'      //市id
     *      'district'      => '444888'      //县id
     *      'is_default'    => 1             //是否为默认地址  0不默认 1默认
     *      'address'       => '海城新村1区90号'       //详细地址
     *      'mobile'        => '13111111111'         //手机号码
     *      'langid'        => 'zh-cn'               //语言
     *
     * ]
     * @return array
     * @Author: Fancs
     * @Version 2017/6/27
     */
    static public function add_address($data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Address', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return ['code' => 0, 'msg' => $validate->getError()];
            }
        }
        
        if(!isset($data['id'])){
            //新增
            $res = \app\member\model\Address::create($data);
            //return false;
        }else{
            //编辑
            $res = \app\member\model\Address::update($data);
        }
        return ['code'=>1,'data'=>$res];
    }
    
    /**
     * @Mark:删除地址
     * @param $data = ['id'=>1]
     * @return bool
     * @Author: fancs
     * @Version 2017/6/27
     */
    static public function delete_address(&$data)
    {
        \app\member\model\Address::destroy(function ($query) use ($data){
            $query->where($data);
        });
        return true;
    }
    
}
