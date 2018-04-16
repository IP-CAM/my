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
// | 快递  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\bcwareexp\controller\admin;

use app\admin\controller\Admin;
use app\bcwareexp\model\Country as CountryModel;
use app\seller\service\Transport as TransportApi;
use app\seller\model\Transport as TransportModel;
use app\bcwareexp\model\Crossware as CrosswareModel;
use app\bcwareexp\service\Expresstpl as ExpresstplApi;
use app\admin\service\Service;

class Expresstpl extends Admin
{
    public function _initialize()
    {
        parent::_initialize();
        //国家列表
        $country_list = CountryModel::all();
        $this->assign('country_list', $country_list);
        
        //快递公司列表
        $express_list = Service::getlist('Express', ['status' => 1]);
        $this->assign('express_list', $express_list['list']);
    }
    
    /**
     * @Mark:运费模板列表
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/22
     */
    public function index()
    {
        $data = ['shop_id' => 0];
        $list = TransportApi::lists($data);
        $this->assign('meta_title', lang('Goods_Freight'));
        $this->assign('list', $list);
        return $this->fetch();
    }
    
    /**
     * @Mark:编辑模板
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/22
     */
    public function edit()
    {
        $ids  = input('ids');
        $data = TransportModel::get($ids);//dump($data->fee_conf);exit();
        $this->assign('data', $data);
        $this->assign('meta_title', lang('Edit'));
        return $this->fetch();
    }
    
    /**
     * @Mark:保存运费模板
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/21
     */
    public function savedata()
    {
        $data = input('param.');
        if (isset($data['id'])) {
            if (!isset($data['status'])) $data['status'] = 0;
            if (!isset($data['is_free'])) $data['is_free'] = 0;
            if (!isset($data['open_freerule'])) $data['open_freerule'] = 0;
            $re = TransportApi::edit($data);
        } else {
            $data['scene'] = 'admin';
            $re            = TransportApi::add($data);
        }
        if ($re['code'] == 1) {
            if (isset($data['id'])) {
                action_log('edit', $this->conDb, $data['id'], UID);
            } else {
                action_log('add', $this->conDb, $re['data']['id'], UID);
            }
            $this->success(lang('success'), 'index');
        } else {
            return json_encode($re);
        }
    }
    
    /**
     * @Mark:禁用
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/22
     */
    public function disable()
    {
        $ids = input('ids/a');
        $map = ['id' => ['in', implode(',', $ids)]];
        try {
            $re = TransportModel::where($map)->setField('status', 0);
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => lang('Executeerror')]);  //不刷新
        }
        if ($re !== false) {
            $this->success(lang('Disableok'), $this->jumpUrl);
        } else {
            $this->error(lang('Disableerror'), $this->jumpUrl);
        }
    }
    
    /**
     * @Mark:启用
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/22
     */
    public function enable()
    {
        $ids = input('ids/a');
        $map = ['id' => ['in', implode(',', $ids)]];
        try {
            $re = TransportModel::where($map)->setField('status', 1);
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => lang('Executeerror')]);  //不刷新
        }
        if ($re !== false) {
            $this->success(lang('Enableok'), $this->jumpUrl);
        } else {
            $this->error(lang('Enableerror'), $this->jumpUrl);
        }
    }
    
    /**
     * @Mark:模板删除
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/22
     */
    public function delete()
    {
        $ids = input('ids/a');
        //判断该模板是否被其他仓库启用
        $re = CrosswareModel::where(['expresstplid' => ['in', implode(',', $ids)]])->column('id');
        if ($re) return json(['code' => 0, 'msg' => '删除失败，请先解绑仓库，id为' . implode(',', $re)]);
        try {
            $res = TransportModel::destroy($ids);
        } catch (\Exception $e) {
            return json(['code' => 0, 'msg' => lang('Executeerror')]);  //不刷新
        }
        if ($res !== false) {
            action_log('delete', $this->conDb, implode(',', $ids), UID);
            $this->success(lang('del_ok'), 'index');
        } else {
            $this->error(lang('del_fail'));
        }
        
    }
    
    /**
     * @Mark:测试
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/27
     */
    public function test()
    {
        //TODO 测试运费计算
        $data = [
            'seller_id' => 2,
            'city_id'   => 440300,
            'info'      => [
                ['goods_id' => 1, 'sku' => '51490912', 'buy_num' => 22],
                ['goods_id' => 4, 'sku' => '51574922', 'buy_num' => 12],
                ['goods_id' => 1235, 'sku' => 'sdf234', 'buy_num' => 15],
            ]
        ];
        $a    = ExpresstplApi::calculateFee($data);
        dump($a);
    }
}
