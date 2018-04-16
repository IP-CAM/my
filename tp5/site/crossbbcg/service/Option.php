<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | Option.php  Version 2017/6/2
// +----------------------------------------------------------------------
namespace app\crossbbcg\service;

use app\crossbbcg\model\Option as OptionModel;
use app\crossbbcg\model\OptionValue as OptionValueModel;
use app\crossbbcg\model\GoodsSku as GoodsSkuModel;
use think\Loader;

class Option
{
    
    /**
     * @Mark: 改变商品顺序
     * @param $data = array(
     *      'option_id' => 主键id，
     *      'sort' => 顺序
     * );
     *
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function changeSort($data)
    {
        $option = OptionModel::get($data['option_id']);
        $option->sort = (int)$data['sort'];
        if ($option->save()) {
            return ['code' => 1, 'msg' => lang('edit_success')];
        } else {
            if ($option->getError() !== null) {
                return ['code' => 0, 'msg' => $option->getError()];
            } else {
                return ['code' => 0, 'msg' => lang('Error_Nothing')];
            }
        }
    }
    
    /**
     * @Mark: 删除选项，选项关联的选项值也将删除
     * @param $option_id
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function deleteOption($option_id)
    {
        $option_id = (int)$option_id;
        $option = OptionModel::get($option_id);
        
        if ($option) {
            // 验证是否有关联的选项值的商品存在
            $arr_value = OptionValueModel::where('option_id',$option_id)->column('option_value_id');
            if($arr_value){
                foreach($arr_value as $value){
                    $result = self::deleteOptionValueValidate($value);
                    if(!$result['code']){
                        return $result;
                    }
                }
            }
            
            $option->delete();
            $option_value = new OptionValueModel();
            $option_value->where('option_id', '=', $option_id)->delete();
            return ['code' => 1, 'msg' => lang('delete_success')];
        } else {
            return ['code' => 0, 'msg' => lang('Delete_Option_Missing')];
        }
    }
    
    /**
     * @Mark: 保存选项与选项值
     * @param $data array(
     *      'option_id' => 选项id
     *      'option_value' => array() 选项值组
     * );
     *
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function edit($data)
    {
        if (isset($data['option_value'])) {
            // 验证选项值
            $class = Loader::parseClass('crossbbcg','validate','OptionValue',false);
            $apivalidate = Loader::validate($class);
            foreach ($data['option_value'] as $value) {
                $result = $apivalidate->check($value);
                if ($result !== true) {
                    return ['code' => 0, 'msg' => $apivalidate->getError()];
                }
            }
            
            // 删除关联选项id的选项值
            $option_value = new OptionValueModel();
            $option_value->where('option_id', $data['option_id'])->delete();
            
            // 添加选项值
            foreach ($data['option_value'] as $value) {
                $option_value = new OptionValueModel();
                $option_value->allowField(true)->isUpdate(false)->save($value);
                if ($option_value->getError() !== null) {
                    return ['code' => 0, 'msg' => $option_value->getError()];
                }
            }
        } else {
            // 删除关联选项id的选项值
            $option_value = new OptionValueModel();
            $option_value->where('option_id', $data['option_id'])->delete();
        }
        
        // 验证选项，添加选项
        $class = Loader::parseClass('crossbbcg', 'validate', 'Option');
        $validate = Loader::validate($class);
        $result = $validate->check($data);
        if ($result !== true) {
            return ['code' => 0, 'msg' => $validate->getError()];
        }
        $option = new OptionModel();
        $option->allowField(true)->isUpdate(true)->save($data);
        if ($option->getError() !== null) {
            return ['code' => 0, 'msg' => $option->getError()];
        }
    
        return ['code' => 1, 'msg' => lang('edit_success')];
    }
    
    /**
     * @Mark: 新增选项，选项值
     * @param $data
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function add($data)
    {
        if (isset($data['option_value'])) {
            
            // 验证提交的选项值是否为空，或重复
            $repeat = [];
            foreach ($data['option_value'] as $value) {
                if ($value['name'] == '') {
                    return ['code' => 0, 'msg' => lang('Option_Value_Name_Require')];
                }
                if (in_array($value['name'], $repeat)) {
                    return ['code' => 0, 'msg' => lang('Option_Value_Name_Exist')];
                }
                $repeat[] = $value['name'];
            }
            unset($repeat);
            
            // 增加选项
            $class = Loader::parseClass('crossbbcg', 'validate', 'Option');
            $validate = Loader::validate($class);
            $result = $validate->check($data);
            if ($result !== true) {
                return ['code' => 0, 'msg' => $validate->getError()];
            }
            $option = new OptionModel();
            $option->allowField(true)->isUpdate(false)->save($data);
            if ($option->getError() !== null) {
                return ['code' => 0, 'msg' => $option->getError()];
            }
            
            // 增加选项值
            $option_id = $option->getLastInsID();
            $option_value = new OptionValueModel();
            $option_value->where('option_id', $option_id)->delete();
            foreach ($data['option_value'] as $value) {
                $value['option_id'] = $option_id;
                $option_value = new OptionValueModel();
                $option_value->allowField(true)->isUpdate(false)->save($value);
                if ($option_value->getError() !== null) {
                    return ['code' => 0, 'msg' => $option_value->getError()];
                }
            }
        } else {
            
            // 新增选项
            $class = Loader::parseClass('crossbbcg', 'validate', 'Option');
            $validate = Loader::validate($class);
            $result = $validate->check($data);
            if ($result !== true) {
                return ['code' => 0, 'msg' => $validate->getError()];
            }
            $option = new OptionModel();
            $option->allowField(true)->isUpdate(false)->save($data);
            if ($option->getError() !== null) {
                return ['code' => 0, 'msg' => $option->getError()];
            }
            
            $option_id = $option->getLastInsID();
            
            $option_value = new OptionValueModel();
            $option_value->where('option_id', $option_id)->delete();
        }
        return ['code' => 1, 'msg' => lang('add_success')];
    }
    
    /**
     * @Mark: 删除选项值验证，不删除选项值
     * @param $option_value_id
     * @return bool|\think\response\Json
     * @Author: WangHuaLong
     */
    public static function deleteOptionValueValidate($option_value_id){
        $good_sku = new GoodsSkuModel();
        $result = $good_sku->findGoodId($option_value_id);
        
        if($result){
            $warning = '';
            foreach($result as $key=>$value){
                $warning .= ',' . $value;
            }
            return ['code'=>0,'msg'=>lang('Relation_Delete_Error') . substr($warning,1)];
        }
    
        return ['code' => 1, 'msg' => lang('delete_success')];
    }
    
    
}