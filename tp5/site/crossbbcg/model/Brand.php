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
// | Brand.php  Version 2017/3/19
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;
use think\Db;

class Brand extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_BRAND__';
    protected $table_country = '__BCWAREEXP_COUNTRY__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    //自动完成
    protected $auto     = ['firstchar','status','isrecommend','istop'];
    protected $insert   = [];
    protected $update   = [];
    
    /**
     * @Mark:首字母
     * @param $value
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setFirstcharAttr($value,$data)
    {
        if($value) return $value;
        $str = \common\Pinyin::ChineseToPinyin($data['name']);
        return strtoupper(substr($str, 0, 1));
    }
    
    /**
     * @Mark: 存储语言id
     * @param $value
     * @return mixed
     * @Author: WangHuaLong
     */
    protected function setLangidAttr($value)
    {
        return $value;
    }
    
    /**
     * @Mark:是否推荐
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setIsrecommendAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark:置顶
     * @param $value
     * @return int
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    protected function setIstopAttr($value)
    {
        return autostatus($value);
    }
    
    
    /**
     * @Mark: 获取品牌的国家
     * @param $langid
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    public function getBrandCountry($langid){
        
        $field = 'cb.country_id,cc.code country_code,cc.name country_name';
        
        $where = array(
            'cb.istop' => 1,
            'cb.isrecommend' => 1,
            'cb.langid' => $langid,
            'cb.status' => 1
        );
        
        $limit = 9;
        $result = Db::table($this->table . ' cb')
            ->join($this->table_country . ' cc','cb.country_id = cc.id')
            ->field($field)
            ->distinct('cb.country_id')
            ->limit($limit)
            ->where($where)
            ->order('cb.sort','ASC')
            ->select();
        
        return $result;
    }
    
    
    

}