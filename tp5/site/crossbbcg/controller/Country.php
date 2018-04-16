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
// | Brand  Version 2017/2/23 品牌页
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\crossbbcg\model\NationalPavilion as NationalPavilionModel;
use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\service\Goods as GoodsApi;

class Country extends Shopbase
{
    
    /**
     * @Mark: 国家馆
     * @return mixed
     * @Author: WangHuaLong
     */
    public function index()
    {
        // 获取推荐的国家馆
        $map = [
            'status' => 1,
            'is_recommend' => 1,
            'langid' => LANG
        ];
        $arr_np = NationalPavilionModel::with('country')->where($map)->order('sort', 'ASC')->select();
        $this->assign('arr_np', $arr_np);
        
        // 轮播图，展示最新的国家馆轮播图
        $map3 = [
            'status' => 1,
            'is_recommend' => 1,
            'langid' => LANG,
            'banner_image' => ['<>', '']
        ];
        $arr_banner = NationalPavilionModel::with('country')->where($map3)->order('id', 'DESC')->limit(3)->select();
        $this->assign('arr_banner', $arr_banner);
        
        // 国家馆商品
        $arr_goods = [];
        if ($arr_np !== null) {
            foreach ($arr_np as $key => $arr) {
                if ($key >= 8) {
                    break;
                }
                $map2 = array(
                    PLATFORM_STATUS => 1,
                    'langid' => LANG,
                    'status' => 'enabled',
                    'quantity' => ['>', 0]
                );
                $arr_goods[$key]['name'] = $arr['name'];
                $goods = GoodsModel::where('country_id', $arr['country_id'])->where($map2)->field('id,thumb,name,sale_price,market_price')->limit(15)->order('sales_volume', 'DESC')->select()->toArray();
                $result_goods = [];
                if (!empty($goods)) {
                    foreach ($goods as $key2 => $arr2) {
                        $result_goods[$key2] = $arr2;
                        $result_goods[$key2]['sale_price'] = GoodsApi::currencyFormat($arr2['sale_price']);
                        $result_goods[$key2]['market_price'] = GoodsApi::currencyFormat($arr2['market_price']);
                    }
                }
                $arr_goods[$key]['goods'] = $result_goods;
            }
        }
        
        $this->assign('arr_goods', $arr_goods);
        
        
        $this->assign('title', lang('national_pavilion'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 国家馆详情页
     * @return mixed
     * @Author: WangHuaLong
     */
    public function details()
    {
        if (!input('?get.item_id')) {
            $this->redirect(url('crossbbcg/country/index'));
        }
        
        $id = input('get.item_id');
        $map = [
            'status' => 1,
            'langid' => LANG,
            'id' => $id
        ];
        // $pavilion = NationalPavilionModel::with('country')->where($map)->find();
        // 国家馆信息
        $pavilion = NationalPavilionModel::get($map,'country,brand');
        if ($pavilion === null) {
            $this->redirect(url('crossbbcg/country/index'));
        }
        $this->assign('data', $pavilion);
        
        // 国家馆品牌
        $map3 = [
            'status' => 1,
            'langid' => LANG,
            'isrecommend' => 1
        ];
        $arr_brand = $pavilion->brand()->where($map3)->order('sort','asc')->limit(10)->select()->toArray();
        $this->assign('arr_brand',$arr_brand);
        
        
        // 国家馆商品
        $map2 = array(
            PLATFORM_STATUS => 1,
            'langid' => LANG,
            'status' => 'enabled',
            'quantity' => ['>', 0]
        );
        $goods = GoodsModel::where('country_id', $pavilion['country_id'])->where($map2)->field('id,thumb,name,sale_price,market_price')->limit(15)->order('sales_volume', 'DESC')->select()->toArray();
        $result_goods = [];
        if (!empty($goods)) {
            foreach ($goods as $key2 => $arr2) {
                $result_goods[$key2] = $arr2;
                $result_goods[$key2]['sale_price'] = GoodsApi::currencyFormat($arr2['sale_price']);
                $result_goods[$key2]['market_price'] = GoodsApi::currencyFormat($arr2['market_price']);
            }
        }
        $this->assign('arr_goods', $result_goods);
    
    
        $this->assign('title', $pavilion['name']);
        return $this->fetch();
    }
}