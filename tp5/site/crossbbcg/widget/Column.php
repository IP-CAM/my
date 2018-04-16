<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Common.php  Version 2017/8/10
// +----------------------------------------------------------------------
namespace app\crossbbcg\widget;

use think\Controller;
use app\crossbbcg\model\NationalPavilion as NationalPavilionModel;


class Column extends Controller
{
    /**
     * @Mark: 网站头部挂件
     * @return mixed
     * @Author: WangHuaLong
     */
    public function national_pavilion()
    {
        // 获取推荐的国家馆
        $map = [
            'status' => 1,
            'is_home' => 1,
            'langid' => LANG
        ];
        $arr_np = NationalPavilionModel::with('country')->where($map)->order('sort', 'ASC')->select();
        $this->assign('arr_np', $arr_np);
        
        // 国家馆品牌
        $arr_brand = [];
        if ($arr_np !== null) {
            foreach ($arr_np as $key => $arr) {
                if ($key >= 8) {
                    break;
                }
                $map3 = [
                    'status' => 1,
                    'langid' => LANG,
                    'isrecommend' => 1
                ];
                $arr_brand[$key]['home_image'] = $arr['home_image'];
                $arr_brand[$key]['id'] = $arr['id'];
                $pavilion = NationalPavilionModel::get($arr['id']);
                $arr_brand[$key]['brand'] = $pavilion->brand()->where($map3)->order('sort', 'asc')->limit(4)->select()->toArray();
            }
        }
        $this->assign('arr_brand', $arr_brand);
        
        
        return $this->fetch(APP_PATH . 'crossbbcg/view/' . MOBTPL . 'column/national_pavilion.html');
    }
    
    
}
