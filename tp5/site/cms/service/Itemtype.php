<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Itemtype.php  Version 2017/6/12 属性类型API
// +----------------------------------------------------------------------
namespace app\cms\service;

use app\admin\service\Service;
use app\cms\model\Itemattr;

class Itemtype extends Service
{
    /**
     * @Mark:新增
     * @param mixed|string $data[
     *      'name'          => '电影',    //名称
     *      'langstr'       => 'movie'   //语言变量
     *      'langid'        => 'zh_n',   //语言
     *      'attribute'     =>[          //属性数组
     *                          'name'    => '爱情片','langstr' => 'love',  'type_id'=>12,
     *                          'name'    => '动作片','langstr' => 'action','type_id'=>12,
     *                          .........
     *                        ]
     * ]
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/14
     */
    static public function add(&$data)
    {
        if(isset($data['attribute']))
        {
            // 验证提交的参数名是否有重复
            $repeat = [];
            foreach ($data['attribute'] as $value) {
                if ($value['name'] == '') {
                    return json(['code' => 0, 'msg' => lang('Attribute_Name_Require')]);
                }
                if (in_array($value['name'], $repeat)) {
                    return json(['code' => 0, 'msg' => lang('Attribute_Name_Exist')]);
                }
                $repeat[] = $value['name'];
            }
            unset($repeat);
    
            // 验证参数组，新增参数组
            $attribute_type = new \app\cms\model\Itemtype();
            $attribute_type->allowField(true)->validate(true)->isUpdate(false)->save($data);
            if ($attribute_type->getError() !== null) {
                return json(['code' => 0, 'msg' => $attribute_type->getError()]);
            }
    
            // 避免数据重复，先删除参数，在新增
            $attribute_type_id = $attribute_type->getLastInsID();
            $attribute = new Itemattr();
            $attribute->where('type_id', $attribute_type_id)->delete();
    
            foreach ($data['attribute'] as $value) {
                $value['type_id'] = $attribute_type_id;
                $attribute->allowField(true)->isUpdate(false)->data($value,true)->save($value);
                if ($attribute->getError() !== null) {
                    return json(['code' => 0, 'msg' => $attribute->getError()]);
                }
            }
        }else{
            // 没有参数组的情况下，只新增类型
            $attribute_type = new \app\cms\model\Itemtype();
            $attribute_type->allowField(true)->validate(true)->isUpdate(false)->save($data);
            if ($attribute_type->getError() !== null) {
                return json(['code' => 0, 'msg' => $attribute_type->getError()]);
            }
            $attribute_type_id = $attribute_type->getLastInsID();
    
            $attribute = new \app\cms\model\Itemattr();
            $attribute->where('type_id', $attribute_type_id)->delete();
        }
        return true;
    }
    
    /**
     * @Mark:编辑
     * @param $data
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/14
     */
    static public function edit(&$data)
    {
        // 判断是否提交参数
        if (isset($data['attribute'])) {
            //验证器
            if(!$validate = get_validate('Itemattr',$data)){
                return $validate;
            }
        
            // 删除参数
            $attribute = new Itemattr();
            $attribute->where('type_id', $data['id'])->delete();
        
            // 添加提交的参数
            foreach ($data['attribute'] as $value) {
                $attribute->allowField(true)->isUpdate(false)->data($value,true)->save($value);
                if ($attribute->getError() !== null) {
                    return json(['code' => 0, 'msg' => $attribute->getError()]);
                }
            }
        } else {
        
            // 删除参数
            $attribute = new Itemattr();
            $attribute->where('type_id', $data['type_id'])->delete();
        }
    
        // 验证参数组，添加参数类型
        $attribute_type = new \app\cms\model\Itemtype();
        $attribute_type->allowField(true)->validate(true)->isUpdate(true)->save($data);
        if ($attribute_type->getError() !== null) {
            return json(['code' => 0, 'msg' => $attribute_type->getError()]);
        }
    
        return true;
    }
    
   
}
