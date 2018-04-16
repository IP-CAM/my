<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Dbmodel.php  Version 2017/9/1
// +----------------------------------------------------------------------

namespace app\admin\service;

use app\admin\model\Dbmodel as DbmodelModel;
use app\admin\model\Attribute as AttributeModel;
use think\Db;
use think\Loader;

class Dbmodel extends Service
{
    /**
     * @Mark:检测表是否存在
     * @param $model_id int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/1
     * @return array
     */
    static public function checkTableExist($model_id)
    {
        $res = DbmodelModel::get($model_id);
        if ($res) {
            $sql = <<<sql
                SHOW TABLES LIKE '{$res["name"]}';
sql;
            $result = Db::query($sql);
            if (count($result)) {
                return ['code'=>1,'data'=>$res];
            } else {
                return ['code'=>0,'data'=>$res];
            }
        } else {
            return ['code'=>0];
        }
    }
    
    
    /**
     * @Mark:根据数据表生成模型及其属性数据
     * @param $data
     * @return array|bool|false|int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/1
     */
    static public function generate($data){
        $classname = Loader::parseClass('admin','validate','Dbmodel');
        $validate = Loader::validate($classname);
        if (!$validate->check($data)) {
            return ['code'=>0,'msg'=>$validate->getError()];
        }
        //新增模型数据
        if(empty($data['name'])){
            $data['name'] = $langstr = substr($data['table'], strlen(config('prefix')));
        }
        $engine_type    = Db::connect()->query('SHOW TABLE STATUS WHERE Name = "'.$data['table'].'"');
        $fields         = Db::table($data['name'])->getTableFields();
        $islangs        = array_key_exists('lang',array_flip($fields))? 1 : 0 ;
        $need_pk        = array_key_exists('id',array_flip($fields))? 1 : 0 ;//下标为0时无法判断
        $inster         = array(
            'name'          => $data['name'],
            'langstr'       => isset($data['langstr'])?$data['langstr']:'',
            'engine_type'   => $engine_type[0]['Engine'],
            'islangs'       => $islangs,
            'need_pk'       => $need_pk,
            'remark'        => $engine_type[0]['Comment']
        );
        $res = DbmodelModel::create($inster);
        
        //新增属性
        $field = Db::connect()->query('SHOW FULL COLUMNS FROM '.$data['table']);
        foreach ($field as $key=>$value){
            $value  =   array_change_key_case($value);
            $data = [
                'name'      => $value['field'],
                'title'     => $value['comment'],
                'remark'    => $value['comment'],
                'autoincrement'=> $value['extra'] == 'auto_increment' ? 1 : 0,
                'unsigned'  => stripos($value['type'],'unsigned')? 1 : 0,
                'type_value'=> strcmp($value['null'],'NO') == 0 ?$value['type'] .' NOT NULL ':$value['type'] .' NULL ',
                'value'     => $value['default'] == null ? '' : $value['default'],
                'status'    => 1,
                'model_id'  => $res['id'],    //TODO:根据字段定义生成合适的数据类型
            ];
            $datatypes = include APP_PATH .'/common/datatypes.php';
            foreach($datatypes as $dk=>$dv){
                $type = explode(' ',$value['type']);
                $type = substr($type[0],0,stripos($type[0],'('));
                if ($type == $dv['doctrineType']['type']){
                    $data['type'] = $dk;
                    break;
                }
            }
            if (!isset($data['type'])) $data['type'] = 'string';
            if (isset($datatypes[$data['type']]['doctrineType']['length'])) $data['length'] = $datatypes[$data['type']]['doctrineType']['length'];
            if (isset($datatypes[$data['type']]['doctrineType']['point'])) $data['point'] = $datatypes[$data['type']]['doctrineType']['point'];
            if (isset($datatypes[$data['type']]['doctrineType']['is_null']) && $datatypes[$data['type']]['doctrineType']['is_null']) $data['is_null'] = 1;
            AttributeModel::create($data);
        }
        create_schame_file($res['id']);
        return ['code'=>1,'data'=>$res];
    }
    
    /**
     * @Mark:取得数据表
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/1
     */
    static public function getTables()
    {
        return \think\Db::connect()->getTables();
    }
    
    /**
     * @Mark:根据模型id删除数据表(真删)
     * @param $data array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/5
     * @return bool
     */
    static public function del_table($data)
    {
        foreach ($data as $value){
            //获取表名
            $table_name = DbmodelModel::get($value);
            $res = DbmodelModel::destroy($value);
            if ($res) {
                AttributeModel::destroy(function ($query) use ($value){
                    $query->where(['model_id'=>$value])->delete();
                });
            }
            //真删数据表
            $sql = <<<sql
DROP TABLE IF EXISTS {$table_name['name']};
sql;
            \think\Db::connect()->execute($sql);
            //删除schame文件
            $model_arr = explode('_',$table_name['name']);
            $model_name = $model_arr[1];//模块名
            unset($model_arr[0]);unset($model_arr[1]);//删除表前缀和模块名，剩余表名
            $table = implode('_',$model_arr);
            $files = APP_PATH.'\\'.$model_name.'\\schema\\'.$table.'.php';
            //删除文件
            if (is_file($files)) @unlink($files);
        }
        return true;
    }
}
