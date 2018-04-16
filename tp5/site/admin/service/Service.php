<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Service.php  Version 2017/7/23 内部API父类
// +----------------------------------------------------------------------
namespace app\admin\service;

use think\Model;

class Service extends Model
{
    /**
     * 通用分页列表数据集获取方法
     *
     *  可以通过url参数传递where条件,例如:  index.html?name=asdfasdfasdfddds
     *  可以通过url空值排序字段和方式,例如: index.html?_field=id&_order=asc
     *  可以通过url参数r指定每页数据条数,例如: index.html?r=5
     *
     * @param string $model 模型名或模型实例 例如：'order'不指定模块名，默认为当前的模块名称，不支持跨模块调用 'order/order' 指定模块名，可用于跨模块调用
     * @param array $where where查询条件(优先级: $where>$_REQUEST>模型设定)
     * @param array|string $order 排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
     *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
     *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
     *
     * @param boolean $field 单表模型用不到该参数,要用在多表join时为field()方法指定参数
     *
     * @return array|false
     * 返回数据集
     */
    static public function getlist($model, $where = array(), $order = '', $field = true)
    {
        $options = array();
        $Request = \think\Request::instance()->param();
        if(strpos($model, '/')!==false){
            $model = explode('/',$model);
            $modObj  = '\\app\\' . strtolower($model[0]) . '\\model\\' . ucfirst($model[1]);
        }else{
            $modObj  = '\\app\\' . MODULE_NAME . '\\model\\' . ucfirst($model);
        }
        
        $table   = new $modObj();
        $pk      = $table->getPk();
        
        if ($order === null) {
            //order置空
        } else if (isset($Request['_order']) && isset($Request['_field']) && in_array(strtolower($Request['_order']), ['desc', 'asc'])) {
            $options['order'] = '`' . $Request['_field'] . '` ' . $Request['_order'];
        } elseif ($order === '' && empty($options['order']) && !empty($pk)) {
            $options['order'] = $pk . ' desc';
        } elseif ($order) {
            $options['order'] = $order;
        }
        unset($Request['_order'], $Request['_field']);
    
        if (empty($where)) $where = array('status' => array('egt', 0));
        if (!empty($where)) $options['where'] = $where;
        
        if (isset($Request['r'])) {
            $listRows = (int)$Request['r'];
        } else {
            $listRows = \think\Config::get('paginate.list_rows') > 0 ? \think\Config::get('paginate.list_rows') : 50;
        }
        
        //排序功能
        if($options)
        {
            $result = $table::where($options['where'])->field($field)->order($options['order'])->paginate($listRows);
        }else{
            $result = $table::where($where)->field($field)->paginate($listRows);
            /*print_r($table::getLastSql());
            exit;*/
        }
        
        $res = [
            'list'  => $result,
            'page'  => $result->render(),
            'total' => count($result)
        ];
    
        unset($Request);    //释放资源
        return $res;
    }
    
    /**
     * @Mark:获取一条数据
     * @param $data
     * $data = [
     *      'model'  => ,
     *      'where'  =>
     * ]
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/24
     */
    static public function getOne(&$data)
    {
        $modObj   = self::getclass($data);
    
        try{
            $result =  $modObj::where($data['where'])->find();
        }catch(\Exception $e){
            return ['code' => 0, 'msg' => $e->getMessage() ];
        }
    
        if($result){
            return ['code' => 1, 'msg' => '', 'data' => $result];
        }
        return ['code' => 0, 'msg' => lang('Not find data')];
    }
    
    /**
     * @Mark:删除数据API
     * @param $data array
     * $data = [
     *      'model' => //模型名
     *      'where' => //条件
     * ]
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/23
     */
    static public function del(&$data)
    {
        $modObj  = self::getclass($data);
        
        try{
            $result  =  $modObj::where($data['where'])->delete();
        }catch(\Exception $e){
            return ['code' => 0, 'msg' => $e->getMessage()];
        }
        
        if($result)
        {
            return ['code' => 1, 'msg' => lang('Deleteok')];
        }
        
        return ['code' => 0, 'msg' => lang('Deleteerror')];
    }
    
    /**
     * @Mark:保存数据API，仅用来保存单条数据，自动识别新增or修改功能
     * @param $data array
     * $data = [
     *      'model'  => DB,   //数据表
     *      'pk'     => 'id', //主键
     *      'value'  => [],   //数据值
     * ]
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/23
     */
    static public function savedata(&$data)
    {
        //验证器
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', $data['model'], false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            if(isset($data['value']['scene']) && !empty($data['value']['scene'])){
                $result =   $validate->scene($data['value']['scene'])->check($data['value']);
                unset($data['value']['scene']); //删除该字段，防止入库
            }else{
                $result =   $validate->check($data['value']);
            }
            /*----  新增验证场景 end  ---*/
    
            if(!$result){
                return ['code' => 0, 'msg' => $validate->getError()];
            }
        }
    
        $modObj      = self::getclass($data);
        $currModel  =  new $modObj();
        
        if(!isset($data['pk']))
        {
            $result = $currModel->save($data['value']);
            if($result === false)
            {
                return ['code' => 0, 'msg' => lang('Addnew_error')];
            }else{
                return ['code' => 1, 'msg' => lang('Addnew_ok')];
            }
            // 记录行为
            //action_log('role_add', 'admin_role', $role['id'], UID, $data['name']);
            
        }else{
            $result = $currModel->save($data['value'], [$data['pk'] => $data['value'][$data['pk']]]);
            // 记录行为
            //action_log('role_add', 'admin_role', $role['id'], UID, $data['name']);
            if($result === false)
            {
                return ['code' => 0, 'msg' => lang('Editerror')];
            } else {
                return ['code' => 1, 'msg' => lang('Editok')];
            }
            
        }
    }
    
    /**
     * @Mark:执行字段修改
     * @param $data
     * $data = [
     *      'model'     => $data['model'],  //模型名
     *      'where'     => $data['where'],  //需要改变的字段的条件
     *      'fields'    => $data['fields'], //需要改变的字段名
     *      'val'       => $data['val']     //需要改变的最终值
     * ]
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/23
     */
    static public function setFields(&$data)
    {
        $modObj      = self::getclass($data);
        $table       = new $modObj();
        $status      = $table::where($data['where'])->setField($data['fields'], $data['val']);
        //修改字段失败时
        if ($status === false) {
            return ['code' => 0, 'msg' => lang('Fail')];
        }
    
        return ['code' => 1, 'msg' => lang('Success')];
    }
    
    /**
     * @Mark:执行排序功能
     * @param $data array
     * @return bool
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/23
     */
    static public function sort(&$data)
    {
        return true;
    }
    
    /**
     * @Mark:返回子类调用者名称
     * @param $data
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/9
     */
    static protected function getclass(&$data)
    {
        if(isset($data['model']) && $data['model'])
        {
            if(false !== strpos($data['model'], '\\'))
            {
                return $data['model'];
            }
    
            if(false !== strpos($data['model'], '/'))
            {
                $model = explode('/', $data['model']);
                return '\\app\\' . strtolower($model[0]) . '\\model\\' . ucfirst($model[1]);
            }
            return '\\app\\' . MODULE_NAME . '\\model\\' . ucfirst($data['model']);
        }
        return str_replace('service', 'model', get_called_class());
    }
}