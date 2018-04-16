<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Transport.php  Version 2017/6/24
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\bcwareexp\service\Country;
use app\seller\service\Transport as Transports;
use app\seller\model\Transport as TransportModel;
use app\crossbbcg\service\Goods as GoodsApi;
use app\bcwareexp\model\Crossware;
use think\Request;
use think\Session;

class Transport extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        $country_list = Country::get_country();
        $this->assign('country_list', $country_list);
        $this->assign('feetype', config('index')['fee']);
        $this->assign('currency_unit', '￥');//货币单位
        $this->assign('weight_unit', 'kg');//重量单位
        $this->conDb='Transport';
        //商户仓库列表
        $seller_warehouse = GoodsApi::getSellerWarehouse(SellerId);
        $arr_warehouse    = [];
        if ($seller_warehouse) {
            $arr_warehouse = Crossware::where(['code' => ['in', $seller_warehouse]])->column('name', 'code');
        }
        $this->assign('arr_warehouse', $arr_warehouse);
    }
    
    /**
     * @Mark:运费模板列表
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/27
     */
    public function index()
    {
        $shop_id = Session::get('shop_id');
        $data    = ['shop_id' => $shop_id];
        $list    = TransportModel::where($data)->paginate(15);
        $this->assign('list', $list);
        $this->assign('meta_title',lang('goods_sale_area'));
        return $this->fetch();
    }
    
    /**
     * @Mark:新增运费模板
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/27
     */
    public function add()
    {
        $this->assign('data', null);
        $this->assign('action_name', 'add');
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:编辑
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/27
     */
    public function edit()
    {
        $id   = $this->request->param('id');
        $data = TransportModel::get($id);
        $this->assign('data', $data);
        $this->assign('action_name', 'edit');
        return $this->fetch();
    }
    
    /**
     * @Mark:数据入库
     * @return \app\seller\service\json|bool
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/27
     */
    public function save()
    {
        $data = $this->request->post();
        if (isset($data['id'])) {
            $re = Transports::edit($data);
        } else {
            if (!session('shop_id')) $this->error(lang('pleace_applyshop_first'));
            $data['shop_id'] = (int)session('shop_id');
            $re              = Transports::add($data);
        }
        if ($re['code'] == 1) {
            $log_info = '编辑运费模板，模板名称:' . $data['name'] . '。操作人:' . session('sellername');
            seller_log(session('sellerId'), session('userid'), $log_info);
            $this->success(lang('success'), 'index');
        } else {
            return json($re);
        }
    }
    
    /**
     * @Mark:删除
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/28
     */
    public function del()
    {
        $param = $this->request->param();
        $re    = TransportModel::destroy($param['ids']);
        if ($re) {
            $log_info = '删除运费模板，模板id:' . $param['ids'] . '。操作人:' . Session::get('sellername');
            seller_log(SellerId, Session::get('userid'), $log_info);
            $this->success(lang('del_ok'));
        } else {
            $this->error(lang('del_fail'));
        }
    }
    
    /**
     * @Mark:启用模板
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/5
     */
    public function enable()
    {
        $param = $this->request->param();
        $id    = $param['ids'];
        $data  = [
            'id' => $id,
            'change' => 'enable'
        ];
        $re    = Transports::changeStatus($data);
        if ($re === true) {
            $log_info = '启用运费模板，模板id:' . $id . '。操作人:' . session('sellername');
            seller_log(session('sellerId'), session('userid'), $log_info);
            $this->success(lang('success'));
        } else {
            $this->error(lang('fail'));
        }
    }
    
    /**
     * @Mark:禁用模板
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/5
     */
    public function disabled()
    {
        $param = $this->request->param();
        $id    = $param['ids'];
        $data  = [
            'id' => $id,
            'change' => 'disabled'
        ];
        $re    = Transports::changeStatus($data);
        if ($re['code'] == 1) {
            $log_info = '禁用运费模板，模板id:' . $id . '。操作人:' . session('sellername');
            seller_log(session('sellerId'), session('userid'), $log_info);
            $this->success(lang('success'));
        } else {
            $this->error(lang('fail'));
        }
    }
    
    /**
     * @Mark:添加
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/22
     */
    public function add_area()
    {
        $country = $this->request->param('country');
        //列出地区选项
        $data = \app\bcwareexp\model\Area::all(function ($query) {
            $query->where(['type' => ['<>', 2]])->order('sort asc');
        })->toArray();
        $data = self::get_children($data, $country);
        if ($data) return json(['code' => 1, 'data' => $data]);
        return json(['code' => 0, 'data' => $data]);
    }
    
    /**
     * @Mark:无限分类
     * @param $data
     * @param int $pId
     * @return array|string
     * @Author: fancs
     * @Version 2017/6/22
     */
    static protected function get_children($data, $pId = 0)
    {
        $tree = [];
        foreach ($data as $k => $v) {
            if ($v['pid'] == $pId) {        //父亲找到儿子
                $v['children'] = self::get_children($data, $v['id']);
                $tree[]        = $v;
            }
        }
        return $tree;
    }
    
    /**
     * @Mark:物流公司
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/21
     */
    public function express()
    {
        $list = \app\bcwareexp\model\Express::all();
        $this->assign('list',$list);
        $this->assign('meta_title',lang('express_company'));
        return $this->fetch();
    }
}
