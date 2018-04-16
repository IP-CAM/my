<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | History.php  Version 2017/7/5 会员历史记录API
// +----------------------------------------------------------------------
namespace app\member\service;

use think\Cookie;
use app\admin\service\Service;

class History extends Service
{
    /**
     * @Mark：查询用户历史记录
     * @param $uid = 11  //会员id
     * @return mixed|string
     * @author Fancs
     * @version 2017/7/5
     */
    static public function get_history($uid)
    {
        $histoy = \app\member\model\History::get(function ($query) use ($uid){
            $query->where(['uid'=>$uid]);
        });
        if(!$histoy) return '';
        return $histoy['history_cookie'];
    }
    
    /**
     * @Mark:商品加入浏览记录cookie
     * @param $data = [
     *      'goods_id'  =>  112              //商品id
     *      'goods_name'=>  '啊受到广泛'      //商品标题
     *      'url'       =>  'url'            //商品详情页url
     *      'goods_img' =>  'url'            //商品图片地址
     * ];
     * @return bool
     * @Author: fancs
     * @Version 2017/7/5
     */
    static public function add_history_cookie(&$data)
    {
        if(!$data || !is_array($data))
        {
            return false;
        }
        //判断cookie类里面是否有浏览记录
        $config = get_config('admin','index');
        if(Cookie::has('history')){
            $history = json_decode(Cookie::get('history'),true);//去除cookie，转化为数组
            array_unshift($history, $data); //在浏览记录顶部加入
            /* 去除重复记录 */
            $rows = array();
            foreach ($history as $v)
            {
                if(in_array($v, $rows))
                {
                    continue;
                }
                $rows[] = $v;
            }
            /* 如果记录数量多余30则去除 */
            while (count($rows) > 30)
            {
                array_pop($rows); //弹出
            }
            Cookie::set('history',json_encode($rows),['expire'=>$config['cookieexpire']]);
        }else{
            Cookie::set('history',json_encode(array($data)),['expire'=>$config['cookieexpire']]);
        }
    }
    
    /**
     * @Mark:cookie历史记录入库
     * @param $data = [
     *      'uid'   =>  25              //用户id
     *      'history_cookie'=>'cookie'  //cookie字符串
     * ];
     * @return bool
     * @Author: fancs
     * @Version 2017/7/5
     */
    static public function add_history(&$data)
    {
        $res = \app\member\model\History::create($data);
        if ($res) return true;
        return false;
    }
}