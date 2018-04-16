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
use app\cms\service\Article as ArticleApi;
use app\cms\model\Articlecat as ArticlecatModel;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\model\Nav as NavModel;
use app\cms\model\Article as ArticleModel;



class Common extends Controller
{
    
    /**
     * @Mark: 网站底部
     * @return mixed
     * @Author: WangHuaLong
     */
    public function footer()
    {
        
        /*--  底部文章显示 star--*/
        $param = ['show_in_nav' => 1, 'pid' => 0];
        $parent_cat = ArticlecatModel::where($param)->order('sort asc')->find();
        $param['pid'] = $parent_cat['id'];
        $articlecat = ArticlecatModel::where($param)->order('sort asc')->limit(4)->select();
        $articlecat = $articlecat->toArray();
        foreach ($articlecat as $k => $v) {
            $param = ['category' => $v['id'], 'is_review' => 1];
            $article = ArticleApi::get_article($param);
            $articlecat[$k]['article'] = $article->toArray();
        }
        $this->assign('article', $articlecat);
        /*--  底部文章显示 end--*/
        
        $config = get_config('crossbbcg', 'index');
        $data = [
            'site_footer_info' => isset($config['site_footer_info']) ? html_entity_decode($config['site_footer_info']) : '',
            'kefu_start_week' => isset($config['kefu_start_week']) ? $config['kefu_start_week'] : '',
            'kefu_end_week' => isset($config['kefu_end_week']) ? $config['kefu_end_week'] : '',
            'kefu_start_time' => isset($config['kefu_start_time']) ? $config['kefu_start_time'] : '',
            'kefu_end_time' => isset($config['kefu_end_time']) ? $config['kefu_end_time'] : '',
            'kefu_tel' => isset($config['kefu_tel']) ? $config['kefu_tel'] : '',
            'kefu_qq' => isset($config['kefu_qq']) ? $config['kefu_qq'] : '',
            'app_down_qrcode' => isset($config['app_down_qrcode']) ? $config['app_down_qrcode'] : '',
            'weixin_attention_qrcode' => isset($config['weixin_attention_qrcode']) ? $config['weixin_attention_qrcode'] : ''
        ];
        
        
        $this->assign('data', $data);
        return $this->fetch(APP_PATH . 'crossbbcg/view/' . MOBTPL . 'common/footer.html');
    }
    
    /**
     * @Mark: 网站头部挂件
     * @return mixed
     * @Author: WangHuaLong
     */
    public function header()
    {
        
        // 历史搜索,只取最后的10个搜索词
        if (cookie('?search_history')) {
            $search_history = (array)cookie('search_history');
            $search_history = array_reverse(array_slice($search_history, -10, 10));
            $this->assign('search_history', $search_history);
        } else {
            $this->assign('search_history', false);
        }
        if (input('?get.like')) {
            $this->assign('like', trim(input('get.like')));
        } else {
            $this->assign('like', '');
        }
        
        // 导航商品分类
        $arr_category = [];
        $f_category = $this->getCattegory(0); // 一级分类
        if ($f_category !== null) {
            foreach ($f_category as $key => $arr) {
                $arr_category[$key] = $arr;
                $arr_category[$key]['href'] = url('crossbbcg/search/index', 'cat_id=' . $arr['id']);
                $arr_category[$key]['brands'] = $this->getBrands($arr['brand_ids']);
                $s_category = $this->getCattegory($arr['id']); // 二级分类
                if ($s_category !== null) {
                    foreach ($s_category as $key2 => $arr2) {
                        $arr_category[$key]['child'][$key2] = $arr2;
                        $arr_category[$key]['child'][$key2]['href'] = url('crossbbcg/search/index', 'cat_id=' . $arr2['id']);
                        $c_category = $this->getCattegory($arr2['id']);
                        if ($c_category !== null) {
                            foreach ($c_category as $key3 => $arr3) {
                                $arr_category[$key]['child'][$key2]['child'][$key3] = $arr3;
                                $arr_category[$key]['child'][$key2]['child'][$key3]['href'] = url('crossbbcg/search/index', 'cat_id=' . $arr3['id']);
                            }
                        }
                    }
                }
            }
        }

        $this->assign('arr_header_category', $arr_category);
        
        // 首页横向导航
        $arr_header_nav = [];
        if ($this->getNav() !== null) {
            $arr_header_nav = $this->getNav();
        }
        $this->assign('arr_header_nav', $arr_header_nav);
        
        // 默认搜索词
        $this->assign('catalog_search',config('catalog_search'));
        
        // 头部协议
        $top_protocol_title = '';
        if(config('top_protocol_status')){
            if(config('top_protocol_id')){
            $result = ArticleModel::where('id',config('top_protocol_id'))->value('title');
            if($result!=null){
                $top_protocol_title = $result;
            }
            }
        }
        
        $this->assign('top_protocol_title',$top_protocol_title);
        $this->assign('top_protocol_id',config('top_protocol_id'));
        
        
        
        return $this->fetch(APP_PATH . 'crossbbcg/view/' . MOBTPL . 'common/header.html');
    }
    
    /**
     * @Mark: 购物车竖向导航栏
     * @return mixed
     * @Author: WangHuaLong
     */
    public function toolbar(){
        return $this->fetch(APP_PATH . 'crossbbcg/view/' . MOBTPL . 'common/toolbar.html');
    }
    
    /**
     * @Mark: 获取导航分类
     * @param $pid int 父类id
     * @return false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    private function getCattegory($pid)
    {
        $result = CategoryModel::where('pid', $pid)->where('is_recom', 1)->where(PLATFORM_STATUS, 1)->field('id,pid,title,is_recom,brand_ids')->order('sort', 'ASC')->limit(7)->select();
        if ($result !== null) {
            $result = $result->toArray();
        }
        return $result;
    }
    
    /**
     * @Mark: 获取品牌
     * @param $brand_ids
     * @return array|false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    private function getBrands($brand_ids)
    {
        $result = BrandModel::where('id', 'IN', $brand_ids)->where('isrecommend', 1)->where('status', 1)->field('id,name,logo')->limit(10)->order('sort', 'ASC')->select();
        if ($result !== null) {
            $result = $result->toArray();
        }
        return $result;
    }
    
    /**
     * @Mark: 获取首页横向导航
     * @return array|false|\PDOStatement|string|\think\Collection
     * @Author: WangHuaLong
     */
    private function getNav()
    {
        $result = NavModel::where('status', 1)->where('type', 1)->field('id,url,title')->order('sort', 'ASC')->limit(7)->select();
        if ($result !== null) {
            $result = $result->toArray();
        }
        return $result;
    }
}
