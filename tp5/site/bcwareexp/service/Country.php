<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Country.php  Version 2017/6/26 国家API
// +----------------------------------------------------------------------
namespace app\bcwareexp\service;

use app\admin\service\Service;

class Country extends Service
{
    /**
     * @Mark:根据条件查询国家
     * @param $data =[
     *      'id'        => $id          //id
     *      'code'      => $code        //国家代码
     *      .....
     * ]
     * @return mixed
     * @Author: Fancs
     * @Version 2017/6/26
     */
    static public function get_country(&$data = [])
    {
        if (empty($data)) {
            //查询所有的数据
            $country = \app\bcwareexp\model\Country::all(function ($query) {
                $query->where(['langid' => LANG])->order('sort asc');
            });
        } else {
            //根据条件获取数据
            $country = \app\bcwareexp\model\Country::all(function ($query) use ($data) {
                $query->where($data);
            });
        }
        if (empty($country)) return false;
        return $country;
    }
    
    /**
     * @Mark:获取所有下级区域
     * @param $data [
     *      'id'         =>      $id            //id
     *      'code/name'  =>      $code/$name    //地区代码or语言变量
     * ]
     * @return mixed|string
     * @Author: fancs
     * @Version 2017/6/9
     */
    static public function get_lower(&$data)
    {
        //组装查询条件
        $index_where['code|name|id'] = $data;
        $lower = \app\bcwareexp\model\Area::all(function ($query) use ($index_where) {
            $query->where($index_where);
        });
        if (empty($lower)) return json(['code' => 0, 'msg' => lang('Not find data')]);
        return $lower;
    }
    
    /**
     * @Mark: 新增/编辑类型
     * @param $data =[
     *      //新增
     *      'name'        => '中国',             //中文名称
     *      'en_name'     => 'China',           //英文名称
     *      'code'        => 'CN',              //地区代码
     *      'main_lang'   => 'zh-cn'            //主要语言
     *      'zipcode'     => '53574'            //邮编
     *      'countrycode' => '142'              //海关国别代码
     *      ......
     *      'langid'      => 'zh-cn'            //语言
     *      //更新
     *      'id'          => $id,               //如果是更新有id
     *      'name'        => '中国',             //中文名称
     *      'en_name'     => 'China',           //英文名称
     *      'code'        => 'CN',              //地区代码
     *      'main_lang'   => 'zh-cn'            //主要语言
     *      'zipcode'     => '53574'            //邮编
     *      'countrycode' => '142'              //海关国别代码
     *      ......
     *
     * ]
     * @return string
     * @Author: Fancs
     * @Version 2017/6/9
     */
    static public function save_country(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Country', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate = \think\Loader::validate($class);
            $result = $validate->check($data);
            if (!$result) {
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        if (!isset($data['id'])) {
            //新增
            $data['status'] = 1;
            if ($res = \app\bcwareexp\model\Country::create($data)) {
                return true;
            }
            return json(['code' => 0, 'msg' => lang('Add error')]);
        } else {
            //编辑
            if ($res = \app\bcwareexp\model\Country::update($data)) {
                return true;
            }
            return json(['code' => 0, 'msg' => lang('Update error')]);
        }
    }
    
    /**
     * @Mark:删除类型
     * @param $data [
     *      'id'   => $id    //id
     *      'name' => $name  //名称
     *      ....
     * ]
     * @return string
     * @Author: fancs
     * @Version 2017/6/9
     */
    static public function delete_country(&$data)
    {
        $where['code|name|id'] = $data;
        \app\bcwareexp\model\Country::destroy(function ($query) use ($where) {
            $query->where($where);
        });
        return true;
    }
}
