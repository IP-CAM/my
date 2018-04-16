<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Category.php  Version 2017/3/23  跨境商城商品分类
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class Category extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_CATEGORY__';
    protected $table_path = '__CROSSBBCG_CATEGORY_PATH__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto = ['is_recom', 'api_status', 'pc_status', 'wap_status', 'listtype'];
    protected $insert = [];
    protected $update = [];
    
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/28
     */
    protected function setIsRecomAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:语言
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setLangidAttr($value)
    {
        return (string)$value;
    }
    
    
    /**
     * @Mark:是否允许API
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setApiStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否允许PC端
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setPcStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否允许Wap端
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setWapStatusAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:是否封面
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    protected function setListtypeAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark: 获取所有商品分类，默认返回树层结构顺序
     * @param $data
     * @return \think\Paginator
     * @Author: WangHuaLong
     */
    public function getCategories($data)
    {
        // 添加查询语句的参数别名,合并调整参数
        $field = array(
            'cp.category_id' => 'category_id',
            'GROUP_CONCAT(c2.title ORDER BY cp.LEVEL SEPARATOR "&nbsp;&nbsp;&gt;&nbsp;&nbsp;")' => 'sort_name',
            'cp.path_id',
            'cp.level'
        );
        if (isset($data['field']) && $data['field']) {
            foreach ($data['field'] as $key => $value) {
                $field[] = 'c1.' . $value;
            }
        }else{
            $field[] = 'c1.*';
        }
        if (isset($data['order']) && $data['order']) {
            $order = $data['order'];
        } else {
            $order = 'sort_name';
        }
        if (isset($data['group']) && $data['group']) {
            $group = $data['group'];
        } else {
            $group = 'category_id';
        }
        if (isset($data['where']) && $data['where']) {
            $where = [];
            foreach ($data['where'] as $key => $value) {
                if(strpos($key,'|')===false){
                    $where['c1.' . $key] = $value;
                }else{
                    $merge_key = '';
                    foreach(explode('|',$key) as $value2){
                        $merge_key .= '|c1.'.$value2;
                    }
                    $where[substr($merge_key,1)] = $value;
                }
            }
        } else {
            $where = [];
        }
        if (isset($data['whereor']) && $data['whereor']) {
            $whereor = [];
            foreach ($data['whereor'] as $key => $value) {
                if(strpos($key,'|')===false){
                    $whereor['c1.' . $key] = $value;
                }else{
                    $merge_key = '';
                    foreach(explode('|',$key) as $value2){
                        $merge_key .= '|c1.'.$value2;
                    }
                    $whereor[substr($merge_key,1)] = $value;
                }
            }
        } else {
            $whereor = [];
        }
        if (isset($data['paginate']) && $data['paginate']) {
            $result = Db::table($this->table_path)->alias('cp')
                ->join($this->table . ' c1', 'cp.category_id=c1.id', 'LEFT')
                ->join($this->table . ' c2', 'cp.path_id=c2.id', 'LEFT')
                ->field($field)
                ->where($where)
                ->whereOr($whereor)
                ->group($group)
                ->order($order)
                ->paginate($data['paginate']);
        } else {
            $result = Db::table($this->table_path)->alias('cp')
                ->join($this->table . ' c1', 'cp.category_id=c1.id', 'LEFT')
                ->join($this->table . ' c2', 'cp.path_id=c2.id', 'LEFT')
                ->field($field)
                ->where($where)
                ->whereOr($whereor)
                ->group($group)
                ->order($order)
                ->select();
        }
        return $result;
    }
}