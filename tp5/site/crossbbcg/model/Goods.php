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
// | Goods.php  Version 2017/3/17
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use think\Db;
use app\common\model\Base;

class Goods extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_GOODS__';
    protected $table_goods_attribute = '__CROSSBBCG_GOODS_ATTRIBUTE__';
    protected $table_attribute_group = '__CROSSBBCG_ATTRIBUTE_GROUP__';
    protected $table_bcwareexp_country = '__BCWAREEXP_COUNTRY__';
    protected $table_goods_to_category = '__CROSSBBCG_GOODS_TO_CATEGORY__';
    protected $table_goods_sku = '__CROSSBBCG_GOODS_SKU__';
    
    //定义时间戳字段名create_time, update_time, 自动完成
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto = [];
    protected $insert = [];
    protected $update = [];
    
    public $test = ['cat_id' => 'CATEGORY@id:name'];
    
    
    /**
     * @Mark: 设置日期自动转化为时间戳
     * @param $value
     * @return false|int
     * @Author: WangHuaLong
     */
    public function setDateAvailableAttr($value)
    {
        return strtotime($value);
    }
    
    public function getDateAvailableAttr($value)
    {
        if ($value == 0) {
            return '';
        }
        return date('Y-m-d H:i:s', $value);
    }
    
    
    /**
     * @Mark: 设置状态为字符串文本
     * @param $value
     * @return string
     * @Author: WangHuaLong
     */
    public function getStatusAttr($value)
    {
        return (string)$value;
    }
    
    public function setStatusAttr($value)
    {
        return (string)$value;
    }
    
    public function setLangidAttr($value)
    {
        return (string)$value;
    }
    
    /**
     * @Mark: 获取商品列表
     * @param $data
     * @return \think\Paginator
     * @Author: WangHuaLong
     */
    public function getGoods($data)
    {
        
        $field = array(
            'cc.name' => 'country_name',
            'cc.code' => 'country_code',
        );
        if (isset($data['field']) && $data['field']) {
            foreach ($data['field'] as $key => $value) {
                $field[] = 'cg.' . $value;
            }
        } else {
            $field[] = 'cg.*';
        }
        
        if (isset($data['where']) && $data['where']) {
            $where = [];
            foreach ($data['where'] as $key => $value) {
                if (strpos($key, '|') === false) {
                    $where['cg.' . $key] = $value;
                } else {
                    $merge_key = '';
                    foreach (explode('|', $key) as $value2) {
                        $merge_key .= '|cg.' . $value2;
                    }
                    $where[substr($merge_key, 1)] = $value;
                }
            }
        } else {
            $where['cg.status'] = array('=', 'enabled');
        }
        
        if (isset($data['whereor']) && $data['whereor']) {
            $whereor = [];
            foreach ($data['whereor'] as $key => $value) {
                if (strpos($key, '|') === false) {
                    $whereor['cg.' . $key] = $value;
                } else {
                    $merge_key = '';
                    foreach (explode('|', $key) as $value2) {
                        $merge_key .= '|cg.' . $value2;
                    }
                    $whereor[substr($merge_key, 1)] = $value;
                }
            }
        } else {
            $whereor = [];
        }
        
        if (isset($data['order']) && $data['order']) {
            $order = $data['order'];
        } else {
            $order = ['id' => 'DESC'];
        }
        
        if (isset($data['limit']) && $data['limit']) {
            $limit = $data['limit'];
        } else {
            $limit = 20;
        }
        // 合并分类
        if (isset($data['category_id']) && $data['category_id']) {
            $catQuery                  = Db::table($this->table_goods_to_category)
                ->where('category_id', (int)$data['category_id'])
                ->buildSql();
            $where['cgtc.category_id'] = (int)$data['category_id'];
        } else {
            $catQuery = false;
        }
        
        // 判断是否筛选选项值
        if (isset($data['option_value']) && $data['option_value']) {
            $arr_ov = $data['option_value'];
            $exp    = '';
            $val    = [];
            // 是否多选
            if (strpos($arr_ov[0], '_') !== false) {
                $arr_ov_0 = explode('_', $arr_ov[0]);
                foreach ($arr_ov_0 as $key => $arr) {
                    // 多选开头
                    if ($key == 0) {
                        $exp              .= '(FIND_IN_SET(:of' . $key . ',merge_option_value_id)';
                        $val['of' . $key] = $arr;
                        // 多选结尾
                    } elseif (count($arr_ov_0) - 1 == $key) {
                        $exp              .= ' OR FIND_IN_SET(:of' . $key . ',merge_option_value_id))';
                        $val['of' . $key] = $arr;
                    } else {
                        $exp              .= ' OR FIND_IN_SET(:of' . $key . ',merge_option_value_id)';
                        $val['of' . $key] = $arr;
                    }
                }
            } else {
                $exp           = 'FIND_IN_SET(:of' . 0 . ',merge_option_value_id)';
                $val['of' . 0] = $arr_ov[0];
            }
            
            if (count($arr_ov) > 1) {
                foreach ($arr_ov as $key => $arr) {
                    if ($key == 0) {
                        continue;
                    }
                    
                    // 是否多选
                    if (strpos($arr, '_') !== false) {
                        $a_ov = explode('_', $arr);
                        foreach ($a_ov as $key2 => $arr2) {
                            // 多选开头
                            if ($key2 == 0) {
                                $exp                      .= ' AND (FIND_IN_SET(:ov' . $key . $key2 . ',merge_option_value_id)';
                                $val['ov' . $key . $key2] = $arr2;
                                // 多选结尾
                            } elseif (count($a_ov) - 1 == $key2) {
                                $exp                      .= ' OR FIND_IN_SET(:ov' . $key . $key2 . ',merge_option_value_id))';
                                $val['ov' . $key . $key2] = $arr2;
                            } else {
                                $exp                      .= 'OR FIND_IN_SET(:ov' . $key . $key2 . ',merge_option_value_id)';
                                $val['ov' . $key . $key2] = $arr2;
                            }
                        }
                    } else {
                        $exp              .= ' AND FIND_IN_SET(:oe' . $key . ',merge_option_value_id)';
                        $val['oe' . $key] = $arr;
                    }
                }
            }
        }
        
        if (isset($data['paginate']) && $data['paginate']) {
            if ($catQuery) {
                if (isset($exp) && isset($val)) {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->join($catQuery . ' cgtc', 'cg.id=cgtc.good_id', 'LEFT')
                        ->join($this->table_goods_sku . ' cgs', 'cg.id=cgs.good_id', 'LEFT')
                        ->where($where)->where($exp, $val)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->paginate($data['paginate']);
                } else {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->join($catQuery . ' cgtc', 'cg.id=cgtc.good_id', 'LEFT')
                        ->where($where)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->paginate($data['paginate']);
                }
                
            } else {
                if (isset($exp) && isset($val)) {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->join($this->table_goods_sku . ' cgs', 'cg.id=cgs.good_id', 'LEFT')
                        ->where($where)->where($exp, $val)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->paginate($data['paginate']);
                } else {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->where($where)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->paginate($data['paginate']);
                }
            }
        } else {
            if ($catQuery) {
                if (isset($exp) && isset($val)) {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->join($catQuery . ' cgtc', 'cg.id=cgtc.good_id', 'LEFT')
                        ->join($this->table_goods_sku . ' cgs', 'cg.id=cgs.good_id', 'LEFT')
                        ->where($where)->where($exp, $val)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->limit($limit)
                        ->select();
                } else {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->join($catQuery . ' cgtc', 'cg.id=cgtc.good_id', 'LEFT')
                        ->where($where)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->limit($limit)
                        ->select();
                }
                
            } else {
                if (isset($exp) && isset($val)) {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->join($this->table_goods_sku . ' cgs', 'cg.id=cgs.good_id', 'LEFT')
                        ->where($where)->where($exp, $val)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->limit($limit)
                        ->select();
                } else {
                    $results = Db::table($this->table)->alias('cg')
                        ->join($this->table_bcwareexp_country . ' cc', 'cg.country_id=cc.id', 'LEFT')
                        ->where($where)
                        ->whereOr($whereor)
                        ->order($order)
                        ->distinct(true)
                        ->field($field)
                        ->limit($limit)
                        ->select();
                }
                
            }
        }
        
        
        return $results;
    }
    
    /**
     * @Mark: 获取商品总数带搜索条件
     * @param $data
     * @return int|string
     * @Author: WangHuaLong
     */
    public function getTotalSearch($data)
    {
        $results = Db::table($this->table)
            ->where($data['where'])
            ->count();
        return $results;
    }
    
    /**
     * @Mark: 关联国家
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function country()
    {
        return $this->hasOne('app\bcwareexp\model\Country', 'id', 'country_id', '', 'LEFT');
    }
    
    
}