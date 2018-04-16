<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | GoodsAd.php  Version 2017/8/7 商品广告列表
// +----------------------------------------------------------------------

namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;
use think\Request;
use app\crossbbcg\service\AdPosition as AdPositionApi;
use app\crossbbcg\model\Advertising as AdvertisingModel;
use think\Loader;
use app\crossbbcg\service\Goods as GoodsApi;
use app\crossbbcg\service\Category as CategoryApi;




class Goodsad extends Admin
{
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb = 'Advertising';
        $this->index_where['ad_type']=3;
        //广告位列表
        $ad_list = AdPositionApi::getlist('AdPosition',['langid'=>LANG,'status'=>1,'ad_type'=>2]);
        $this->assign('ad_list',$ad_list['list']);
        //商品分类
        $cate_arr = CategoryApi::getCategories();
        $this->assign('cate_arr',$cate_arr);
    }
    
    /**
     * @Mark:选择商品
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/7
     */
    public function choose_goods()
    {
        $param      = $this->request->param();
        $where = ['langid'=>LANG];
        $key_words = isset($param['key_words']) ? $param['key_words'] :'';
        $key_words ? $where[$param['type']] = ['like','%'.$key_words.'%'] : '';
        $data = [
            'where'     =>  $where,
            'paginate'  =>  15
        ];
        if (isset($param['cat_id']) && $param['cat_id'] != 0) $data['category_id'] = $param['cat_id'];
        $goods_list = GoodsApi::getGoods($data);
        $this->assign('goods_list',$goods_list);
        return $this->fetch();
    }
    
    /**
     * @Mark:覆盖父类--重写数据入库
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/8
     */
    public function savedata()
    {
        $param = $this->request->param();
        $class = Loader::parseClass(MODULE_NAME, 'validate', $this->conDb, false);
        $validate = Loader::validate($class);
        if (isset($param['goods_ids'])) {
            $arr = explode(',',$param['goods_ids']);
            foreach ($arr as $v) {
                if (empty($v)) continue ;
                $data = [];
                $data['ad_position']=$param['ad_position'];
                $data['ad_type']=3;
                $data['name']=$param['name'];
                $data['ad_info']=$param['ad_info'];
                $data['goods_id']=$v;
                $data['sort']=$param['sort_'.$v];
                $data['pc_status']=isset($param['pc_status'])?$param['pc_status']:0;
                $data['wap_status']=isset($param['wap_status'])?$param['wap_status']:0;
                $data['api_status']=isset($param['api_status'])?$param['api_status']:0;
                $re = $validate->scene('goods_ad')->check($data);
                if (!$re) {
                    $this->error($validate->getError());
                    break;
                }
                if (isset($param['id'])) {
                    $data['id']=$param['id'];
                    AdvertisingModel::update($data);
                } else {
                    AdvertisingModel::create($data);
                }
            }
        }
        $this->success(lang('success'),'index');
    }
}
