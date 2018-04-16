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

use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\model\Goods as GoodsModel;
use app\crossbbcg\service\Goods as GoodsApi;

class Brand extends Shopbase
{
    
    /**
     * @Mark:商品首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        // 品牌的置顶的国家
        $arr_country['all'] = [
            'country_id'    => 'all',
            'country_code'  => 'all',
            'country_name'  => lang('all_brand'),
            'href'          => url('/crossbbcg/brand'),
            'national_flag' => false,
        ];
        
        $brand         = new BrandModel();
        $brand_country = $brand->getBrandCountry(LANG);
        if ($brand_country !== null) {
            foreach ($brand_country as $key => $arr) {
                $arr_country[$key]                  = $arr;
                $arr_country[$key]['href']          = url('/crossbbcg/brand', 'country_id=' . $arr['country_id']);
                $arr_country[$key]['national_flag'] = __ROOT__ . '/' . APP_NAME . '/' . MODULE_NAME . '/' . MOBTPL . 'image/flags/' . strtolower($arr['country_code']) . '.png';
            }
        }
        
        // 获取国家对应的品牌
        if (input('?country_id')) {
            $country_id = input('country_id');
        } else {
            $country_id = 'all';
        }
        $this->assign('country_id', $country_id);
        $this->assign('arr_country', $arr_country);
        
        $map = array(
            'langid'      => LANG,
            'isrecommend' => 1,
            'status'      => 1,
        );
        
        if ($country_id == 'all') {
            $brands = BrandModel::where($map)->field('id,logo,name,description')->select()->toArray();
            
        } else {
            $brands = BrandModel::where($map)->where('country_id', $country_id)->field('id,logo,name,description')->select()->toArray();
        }
        $arr_brands = [];
        if ($brands !== null) {
            $map2 = array(
                PLATFORM_STATUS => 1,
                'langid'        => LANG,
                'status'        => 'enabled'
            );
            foreach ($brands as $key => $arr) {
                $arr_brands[$key]         = $arr;
                $arr_brands[$key]['href'] = url('/crossbbcg/search', 'brand_id=' . $arr['id']);
                $goods                    = GoodsModel::where('brand_id', $arr['id'])->where($map2)->field('id,thumb,name,sale_price,market_price')->limit(5)->select()->toArray();
                $result_goods             = [];
                if (!empty($goods)) {
                    foreach ($goods as $key2 => $arr2) {
                        $result_goods[$key2]                 = $arr2;
                        $result_goods[$key2]['sale_price']   = GoodsApi::currencyFormat($arr2['sale_price']);
                        $result_goods[$key2]['market_price'] = GoodsApi::currencyFormat($arr2['market_price']);
                    }
                }
                $arr_brands[$key]['goods'] = $result_goods;
                
            }
        }
        
        $this->assign('arr_brand', $arr_brands);
        
        
        $this->assign('title', lang('brand_center'));
        return $this->fetch();
    }
    
    
    /**
     * @Mark:商品详情
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function details()
    {
        $this->assign('Title', lang('Goods details'));
        return $this->fetch();
    }
}