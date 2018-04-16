<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Attribute.php  Version 2017/7/23  数据库属性模型
// +----------------------------------------------------------------------
namespace app\admin\service;

use app\admin\service\Dbmodel as DbmodelApi;
use think\Db;

class Attribute extends Service
{
    /**
     * @Mark:删除表字段
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/5
     */
    static public function deleteField($field)
    {
        $model_id = $field[0]['model_id'];
        //检查表是否存在
        $table_exist = DbmodelApi::checkTableExist($model_id);
        if($table_exist['code']==0){
            return true;
        }
        foreach($field as $v) {
            //如存在id字段，则加入该条件
            $fields = Db::table($table_exist['data']['name'])->getTableFields();
    
            if(!in_array($v['name'],$fields)){
                return true;
            }
            $sql = <<<sql
        ALTER TABLE `{$table_exist['data']['name']}`
DROP COLUMN `{$v['name']}`;
sql;
            Db::query($sql);
        }
        //从新生成schame文件
        create_schame_file($model_id);
        return true;
    }
}