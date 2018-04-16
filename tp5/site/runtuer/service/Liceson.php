<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Liceson.php  Version 2017/10/13
// +----------------------------------------------------------------------

namespace app\runtuer\service;

use app\runtuer\model\Liceson as LicesonModel;
use app\admin\service\Service;
use think\Request;
use think\Cache;

class Liceson extends Service
{
    public static  $BuyUrl = 'http://www.runtuer.com';
    /**
     * @Mark:获取授权信息
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    static public function getLiceson()
    {
        $param = Request::instance()->param();
        if (!isset($param['domain']) || empty($param['domain'])) return ['code'=>0,'msg'=>lang('Clickbuy'),'url'=>self::$BuyUrl];
        
        $where = [
            'url'=>$param['domain'],
        ];
        $res = LicesonModel::where($where)->find();
        
        if ($res) {
            if (!$res['status']) {
                return ['code'=>-1,'msg'=>lang('Liceson_forbidden'),'data'=>$res];
            } else if ($res['end_time'] < time() && $res['end_time'] != 9) {
                return ['code'=>2,'msg'=>lang('Overlic'),'data'=>$res];
            } else {
                return ['code'=>1,'data'=>$res];
            }
        } else {
            self::recordPirateSys();
            return ['code'=>0,'msg'=>lang('Clickbuy'),'url'=>self::$BuyUrl];
        }
    }
    
    /**
     * @Mark:记录未授权的网站信息
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    static public function recordPirateSys()
    {
        $param = Request::instance()->param();
        if (!isset($param['domain']) || !isset($param['ip'])  || !isset($param['time'])) exit;
        $data = [
            'domain'=>$param['domain'],
            'ip'=>$param['ip'],
            'time'=>$param['time'],
            'num'=>1
        ];
        if (Cache::has('liceson_record')) {
            $liceson_record = Cache::get('liceson_record');
        } else {
            $liceson_record = [];
        }
        if (isset($liceson_record[$data['domain']])) $data['num'] += $liceson_record[$data['domain']]['num'];
        $liceson_record[$data['domain']] = $data;
        Cache::set('liceson_record',$liceson_record);
    }
}
