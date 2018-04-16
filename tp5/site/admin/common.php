<?php
// +----------------------------------------------------------------------
// | RuntuerCMF Copyright (c)  http://www.tuntuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 模块函数库 Version 1.0 2017/3/7
// +----------------------------------------------------------------------

/**
 * @Mark:生成模块schame数据库描述文件
 * @param $model_id
 * @Author: yang <502204678@qq.com>
 * @Version 2017/9/1
 * @return boolean
 */
function create_schame_file($model_id){
    $return_arr = [];
    $fields_arr = \app\admin\model\Attribute::all(function ($query)use($model_id){
        $query->where(['model_id'=>$model_id])->select();
    });
    $model = \app\admin\model\Dbmodel::get($model_id);
    foreach ($fields_arr as $v) {
        $return_arr['columns'][$v['name']] = [
            'type'=>$v['type'],
        ];
        if($v['title']) $return_arr['columns'][$v['name']]['title'] = $v['title'];
        if($v['autoincrement']) $return_arr['columns'][$v['name']]['autoincrement'] = true;
        if($v['length']) $return_arr['columns'][$v['name']]['length'] = $v['length'];
        if($v['unsigned']) $return_arr['columns'][$v['name']]['unsigned'] = true;
        if($v['point']) $return_arr['columns'][$v['name']]['point'] = $v['point'];
        if(!empty($v['extra'])) $return_arr['columns'][$v['name']]['extra'] = $v['extra'];
        if($v['value'] !== '' & $v['value'] !== null) $return_arr['columns'][$v['name']]['default'] = $v['value'];
        if($v['is_must']) $return_arr['columns'][$v['name']]['require'] = true;
        if(!empty($v['remark'])) $return_arr['columns'][$v['name']]['comment'] = $v['remark'];
        
    }
    //查询索引
    $index_arr = \think\Db::query("SHOW INDEX FROM {$model['name']}");
    foreach($index_arr as $vv){
        if ($vv['Key_name'] == 'PRIMARY') {
            $return_arr['primaryKey'][]=$vv['Column_name'];
        } else {
            $return_arr['index'][$vv['Key_name']][]=$vv['Column_name'];
        }
    }
    if ($model['remark']) $return_arr['comment'] = $model['remark'];
    if ($model['row_format']) $return_arr['row_format'] = $model['row_format'];
    if ($model['character']) $return_arr['character'] = $model['character'];
    if ($model['auto_increment']) $return_arr['auto_increment'] = $model['auto_increment'];
    //获取模块名和对应表名
    $arr = explode('_',$model['name']);
    $module_name = $arr[1];
    unset($arr[0]);//删除表前缀
    unset($arr[1]);//删除模块名
    $table_name = implode('_',$arr);
    //写文件
    try{
        if (file_exists(realpath(APP_PATH.$module_name) . DS . 'schema')) {
            file_put_contents(realpath(APP_PATH.$module_name) . DS . 'schema'. DS . $table_name. '.php', "<?php \n".getnote()."\n\nreturn ".var_export($return_arr,true).";\n");
        }
    }catch (\Exception $e){
        \think\Log::write($e->getMessage());
        return false;
    }
    return true;
}

/**
 * @Mark:为自动创建的文件添加注释
 * @param string $str
 * @return string
 * @Author: yang <502204678@qq.com>
 * @Version 2017/9/4
 */
function getnote($str = 'By ShopCmf Auto Create File Version')
{
    $days = date('Y/m/d H:i:s');
    $str = <<<EOF
# +----------------------------------------------------------------------
# | ETshop [ Rapid development framework for Cross border Mall ]
# +----------------------------------------------------------------------
# | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
# +----------------------------------------------------------------------
# | Author: theseaer <theseaer@qq.com>
# +----------------------------------------------------------------------
# | {$str} {$days}
# +----------------------------------------------------------------------
EOF;
    return $str;
}
/**
 * @Mark:解析schame文件,生成SQL语句
 * @param $data array schame文件数据数组
 * @Author: yang <502204678@qq.com>
 * @Version 2017/9/2
 * @return string
 */
function analysis_schama($data){
    $sql = '';
    foreach($data['columns'] as $k=>$v){
        $sql .="`$k` ";
        if (isset($v['extra']) && !empty($v['extra'])) {
            $sql .=getDataType($v['type'],$v['extra']);
        } else {
            $sql .=getDataType($v['type']);
        }
        if (isset($v['default'])) $sql .=' DEFAULT '.$v['default'];
        //if (isset($v['pkey']) === true) $sql .=' key';
        if (isset($v['autoincrement']) === true) $sql .=' AUTO_INCREMENT ';
        if (isset($v['comment'])) $sql .=" COMMENT '".$v['comment'].'\'';
        $sql .=",\n";
    }
    if (isset($data['primaryKey']) && !empty($data['primaryKey'])) $sql .=' PRIMARY KEY ('.implode(',',(array)$data['primaryKey'])."), \n";
    if (isset($data['index']) && !empty($data['index']) && is_array($data['index'])) {
        foreach ($data['index'] as $kk=>$vv) {
            $sql .=' KEY `'.$kk.'` ('.implode(',',(array)$vv)."), \n";
        }
    }
    return substr($sql,0,strripos($sql,','));
}

/**
 * @Mark:根据datatypes定义的类型，获取数据表数据类型
 * @param $data string 如‘select、bool’等
 * @param $extra
 * @Author: yang <502204678@qq.com>
 * @Version 2017/9/2
 * @return string
 */
function getDataType($data,$extra=null){
    $res = include APP_PATH .'/common/datatypes.php';
    $arr = $res[$data];
    $str = $arr['doctrineType']['type'];
    if ($extra) {
        $str .=" ('".implode("','",(array)$extra)."')";
    } else {
        if (isset($arr['doctrineType']['length'])) {
            if (isset($arr['doctrineType']['point'])) {
                $str .='('.$arr['doctrineType']['length'].','.$arr['doctrineType']['point'].')';
            } else {
                $str .='('.$arr['doctrineType']['length'].')';
            }
        }
    }
    if (isset($arr['doctrineType']['unsigned']) && $arr['doctrineType']['unsigned'] === true) $str .=' unsinged';
    if (!isset($arr['doctrineType']['is_null']) || $arr['doctrineType']['is_null'] === false) $str .=' NOT NULL';
    return $str;
}

