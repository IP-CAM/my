<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: WangHuaLong
// +----------------------------------------------------------------------
// | CategoryPath.php  Version 2017/6/14
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class CategoryPath extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_CATEGORY_PATH__';
    
    /**
     * @Mark: 新增层级关系，使用replace into 防止重复键新增报错
     * @param $data = array(
     *      'category_id' => 分类id
     *      'path_id' => 上级分类id
     *      'level'  => 层级深度
     * );
     * @Author: WangHuaLong
     */
    public function replaceInto($data)
    {
        Db::execute("REPLACE INTO `rt_crossbbcg_category_path` SET category_id = '" . (int)$data['category_id'] . "', `path_id` = '" . (int)$data['path_id'] . "', level = '" . (int)$data['level'] . "'");
    }
}