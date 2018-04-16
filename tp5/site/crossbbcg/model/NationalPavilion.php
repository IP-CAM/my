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
// | NationalPavilion.php  Version 2017/3/19
// +----------------------------------------------------------------------
namespace app\crossbbcg\model;

use app\common\model\Base;

class NationalPavilion extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '__CROSSBBCG_NATIONAL_PAVILION__';
    protected $table_country = '__CMS_COUNTRY__';
    
    //定义时间戳字段名create_time, update_time
    protected $autoWriteTimestamp = true;
    
    //自动完成
    protected $auto = ['status', 'is_recommend', 'is_home'];
    protected $insert = [];
    protected $update = [];
    
    
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
    protected function setIsRecommendAttr($value)
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
    protected function setIsHomeAttr($value)
    {
        return autostatus($value);
    }
    
    /**
     * @Mark: 关联国家模型
     * @return \think\model\relation\HasOne
     * @Author: WangHuaLong
     */
    public function country()
    {
        return $this->hasOne('app\bcwareexp\model\Country', 'id', 'country_id', '', 'LEFT');
    }
    
    
    /**
     * @Mark: 关联品牌
     * @return \think\model\relation\HasMany
     * @Author: WangHuaLong
     */
    public function brand(){
        return $this->hasMany('app\crossbbcg\model\Brand','country_id','country_id');
    }
    
    /**
     * @Mark:  关联商品模型
     * @return \think\model\relation\HasMany
     * @Author: WangHuaLong
     */
    public function goods()
    {
        return $this->hasMany('Goods', 'country_id', 'id');
    }
    
}