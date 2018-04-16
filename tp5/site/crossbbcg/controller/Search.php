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
// | Search.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\crossbbcg\model\AttributeGroup;
use app\crossbbcg\service\Goods as GoodsApi;
use app\crossbbcg\model\Category as CategoryModel;
use app\crossbbcg\model\Option as OptionModel;
use app\crossbbcg\model\OptionValue as OptionValueModel;
use app\crossbbcg\model\Brand as BrandModel;
use app\crossbbcg\model\GoodsAttribute as GoodsAttributeModel;
use app\bcwareexp\model\Country as CountryModel;
use app\crossbbcg\service\Filter as FilterApi;
use think\Request;

class Search extends Shopbase
{
    
    /**
     * @Mark:搜索首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        
        // 过滤字符串初始化
        $this->request->filter(['strip_tags', 'htmlspecialchars', 'htmlentities']);
        // 搜素
        if (input('?like') && (trim(input('like')) != '')) {
            $like = trim(input('like'));
        } else {
            $like = false;
        }
        
        // 右侧分类导航 TODO 优化查询
        $cat_id = 0;
        $add_like = false;
        $meta_title = '';
        if (input('?cat_id')) {
            $cat_id = input('cat_id/d');
            $add_like = true;
            $cat_name = CategoryModel::where('id', $cat_id)->where(PLATFORM_STATUS, 1)->field('title')->value('title');
        }
        $arr_category = [];
        $cids = [];
        // 判断搜索词是否是分类名称
        if ($like) {
            $add_like = true;
            $categories_name = GoodsApi::getCateogriesName();
            if (in_array($like, $categories_name)) {
                $cat_id = array_search($like, $categories_name);
                $add_like = false;
            }
        }
        /* 如果没有搜索词或分类词
        if(empty(input('get.'))){
            $cat_id = CategoryModel::where('pid',0)->where(PLATFORM_STATUS,1)->value('id');
        }*/
        
        // 获取当前分类的关联三级分类
        if ($cat_id) {
            $path_id = GoodsApi::getTopPid($cat_id);
            $cat1 = CategoryModel::get($path_id);
            $cids[] = $path_id;
            if ($cat1) {
                $cids = array_merge($cids, GoodsApi::getCids($path_id));
                $arr_category['href'] = url('crossbbcg/search/index', 'cat_id=' . $cat1['id']);
                $arr_category['title'] = $cat1['title'];
                $arr_category['children'] = [];
                $cat2 = GoodsApi::getCategories($cat1['id']);
                if ($cat2) {
                    $arr_category['children'] = $cat2->toArray();
                    foreach ($arr_category['children'] as $key => $arr) {
                        $arr_category['children'][$key]['children'] = [];
                        $cat3 = GoodsApi::getCategories($arr['id']);
                        if ($cat3) {
                            $arr_category['children'][$key]['children'] = $cat3->toArray();
                        }
                    }
                }
            }
        }
        
        $this->assign('now_cat_id', $cat_id);
        $this->assign('cids', $cids);
        $this->assign('arr_category', $arr_category);
        
        
        // 关键词筛选判断
        $has_filter = false;
        $arr_brand = [];
        $arr_country = [];
        $arr_option = [];
        $arr_attribute = [];
        
        $brand = BrandModel::where('langid', LANG)->where('status', 1)->column('*', 'id');
        $this->assign('brands', $brand);
        $this->assign('inputs', json_encode(input()));
        $country = CountryModel::where('langid', LANG)->column('*', 'id');
        $option = OptionModel::Where('langid', LANG)->column('*', 'name');
        if ($like || (isset($cat_name) && ($cat_name !== null))) {
            
            // 新增商品分类获取的规格，品牌，参数
            if ($cat_id) {
                $filter = [];
                $filter_cat = CategoryModel::get($cat_id);
                if ($filter_cat !== null) {
                    $filter['brand_ids'] = $filter_cat['brand_ids'];
                    $filter['option_ids'] = $filter_cat['option_ids'];
                    
                    $brand_country_ids = BrandModel::where(['id' => ['in', $filter_cat['brand_ids']]])->field('GROUP_CONCAT(country_id)')->value('GROUP_CONCAT(country_id)');
                    if ($brand_country_ids !== null) {
                        $filter['country_ids'] = $brand_country_ids;
                    } else {
                        $filter['country_ids'] = '';
                    }
                    
                    $filter['attribute_group_ids'] = $filter_cat['attribute_group_ids'];
                } else {
                    $filter['brand_ids'] = '';
                    $filter['country_ids'] = '';
                    $filter['option_ids'] = '';
                    $filter['attribute_group_ids'] = '';
                }
                
            } else {
                if ($like) {
                    $filter = FilterApi::findName($like);
                } else {
                    $filter = FilterApi::findName($cat_name);
                }
            }
            
            
            // 品牌
            if ($filter !== null && $brand !== null) {
                $has_filter = true;
                if ($filter['brand_ids'] != '') {
                    $brand_ids = explode(',', $filter['brand_ids']);
                    foreach ($brand as $key => $arr) {
                        if (in_array($arr['id'], $brand_ids)) {
                            $arr_brand[$key] = $arr;
                        }
                    }
                }
            }
            // 国家
            if ($filter !== null && $country !== null) {
                $has_filter = true;
                if ($filter['country_ids'] != '') {
                    $country_ids = explode(',', $filter['country_ids']);
                    foreach ($country as $key => $arr) {
                        if (in_array($arr['id'], $country_ids)) {
                            $arr_country[$key] = $arr;
                            $arr_country[$key]['national_flag'] = __ROOT__ . '/' . APP_NAME . '/crossbbcg/pc/default/image/flags/' . strtolower($arr['code']) . '.png';
                        }
                    }
                }
            }
            
            // 选项
            if ($filter !== null && $option !== null) {
                $has_filter = true;
                if ($filter['option_ids'] != '') {
                    $option_ids = explode(',', $filter['option_ids']);
                    foreach ($option as $key => $arr) {
                        if (in_array($arr['option_id'], $option_ids)) {
                            $arr_option[$key] = $arr;
                        }
                    }
                    // 获取选项值
                    if (!empty($arr_option)) {
                        foreach ($arr_option as $key => $arr) {
                            if (!empty(GoodsApi::getOptionValues($arr['option_id']))) {
                                $arr_option_value = OptionValueModel::where('option_id', $arr['option_id'])->column('option_value_id', 'name');
                                $arr_option[$key] = $arr_option_value;
                                $arr_option[$key]['option_values'] = GoodsApi::getOptionValues($arr['option_id']);
                                
                            }
                        }
                    }
                    
                }
            }
            
            // 参数
            if ($filter !== null && $filter['attribute_group_ids'] != '') {
                $has_filter = true;
                $map_group = [
                    'attribute_group_id' => ['in', $filter['attribute_group_ids']]
                ];
                $result = AttributeGroup::where($map_group)->order('sort', 'asc')->select();
                if ($result !== null) {
                    $arr_attribute = $result;
                }
            }
            
        }
        $this->assign('has_filter', $has_filter);
        $this->assign('arr_brand', $arr_brand);
        $this->assign('arr_country', $arr_country);
        $this->assign('arr_option', $arr_option);
        $this->assign('arr_attribute', $arr_attribute);
        
        
        // 排序
        if (input('?_field') && input('?_order')) {
            $order_bys = array(
                input('_field') => input('_order')
            );
        } else {
            $order_bys = array(
                'sort' => 'desc'
            );
        }
        // map 索搜产品名称
        $map = array();
        if ($like) {
            if ($add_like) {
                $map['name'] = array('like', '%' . $like . '%');
            }
            // 存储历史记录到cookie
            if (cookie('?search_history')) {
                $search_history = (array)cookie('search_history');
                $search_key = array_search($like, $search_history);
                if ($search_key !== false) {
                    unset($search_history[$search_key]);
                }
                $search_history[] = $like;
                // 只保留十个搜索词
                $search_history = array_slice($search_history, -10, 10);
                cookie('search_history', $search_history);
            } else {
                $search_history[] = $like;
                cookie('search_history', $search_history);
            }
            
        }
        
        $category_id = $cat_id;
        // 商品状态
        $map['status'] = array('=', 'enabled');
        $map['langid'] = LANG;
        // 平台状态
        $map[PLATFORM_STATUS] = 1;
        
        
        // 商品品牌
        $has_choose = false;
        $brand_url = input();
        if (input('?brand_id')) {
            if (strpos(input('brand_id/s'), '_') !== false) {
                $map['brand_id'] = array('IN', str_replace('_', ',', input('brand_id/s')));
            } else {
                $map['brand_id'] = input('brand_id/d');
            }
            unset($brand_url['brand_id']);
            $has_choose = true;
        }
        $this->assign('brand_url', url('index', $brand_url));
        // 国家
        $country_url = input();
        if (input('?country_id')) {
            if (strpos(input('country_id/s'), '_') !== false) {
                $map['country_id'] = array('IN', str_replace('_', ',', input('country_id/s')));
            } else {
                $map['country_id'] = input('country_id/d');
            }
            unset($country_url['country_id']);
            $has_choose = true;
        }
        $this->assign('country_url', url('index', $country_url));
        
        // 选项值
        $count_option = count($arr_option);
        $sku_option_value = '';
        if ($count_option != 0) {
            for ($n = 1; $n <= $count_option; $n++) {
                $option_value_url = input();
                if (input('?option_value_' . $n)) {
                    $sku_option_value .= '|' . input('option_value_' . $n);
                    
                    unset($option_value_url['option_value_' . $n]);
                    $has_choose = true;
                }
                $ov = 'option_value_' . $n . '_url';
                $this->assign($ov, url('index', $option_value_url));
            }
        }
        if ($sku_option_value) {
            $sku_option_value = explode('|', substr($sku_option_value, 1));
        }
        
        // 筛选参数值
        $count_attribute = 0;
        $attribute_values = '';
        if (!empty($arr_attribute)) {
            foreach ($arr_attribute as $key => $arr) {
                if ($arr['attribute'] !== null) {
                    foreach ($arr['attribute'] as $key2 => $arr2) {
                        if ($arr2['filtrate'] == 1) {
                            $count_attribute++;
                        }
                    }
                }
            }
        }
        if ($count_attribute != 0) {
            for ($row_att = 1; $row_att <= $count_attribute; $row_att++) {
                $attribute_value_url = input();
                if (input('?attribute_value_' . $row_att)) {
                    $attribute_values .= ',' . input('attribute_value_' . $row_att);
                    unset($attribute_value_url['attribute_value_' . $row_att]);
                    $has_choose = true;
                }
                $this->assign('attribute_value_' . $row_att . '_url', url('index', $attribute_value_url));
            }
        }
        if ($attribute_values) {
            $attribute_values = str_replace('_', ',', substr($attribute_values, 1));
            $map_val = [
                'value' => ['in', $attribute_values]
            ];
            $result = GoodsAttributeModel::where($map_val)->distinct('good_id')->field('good_id')->column('good_id');
            if ($result !== null) {
                $map['id'] = ['in', $result];
            }
            
        }
        
        
        // 清除全部url
        if ($like) {
            $clear_all = [];
            $clear_all['like'] = input('like');
            if (input('?cat_id')) {
                $clear_all['cat_id'] = input('cat_id');
            }
            $this->assign('clear_all_url', url('index', $clear_all));
        } else {
            $this->assign('clear_all_url', url('index'));
        }
        $this->assign('has_choose', $has_choose);
        
        
        // 分页数
        if (config("catalog_paginate_list_rows")) {
            $paginate_list_rows = config("catalog_paginate_list_rows");
        } else {
            $paginate_list_rows = 20;
        }
        
        $filter_data = array(
            'where' => $map,
            'order' => $order_bys,
            'paginate' => $paginate_list_rows,
            'category_id' => $category_id,
            'option_value' => $sku_option_value,
        );
        // 获取商品列表
        $list = GoodsApi::getGoods($filter_data);
        $this->assign('list', $list);  // 分页用
        $search_total = 0;
        $page = 1;
        $max_page = 1;
        $arr_goods = [];
        if ($list) {
            // 搜索结果总数
            $search_total = $list->total();
            
            // 前一页，后一页
            if (input('?page')) {
                $page = (int)input('page');
            }
            if (($search_total % $paginate_list_rows) != 0) {
                $max_page = (int)($search_total / $paginate_list_rows) + 1;
            }
            
            foreach ($list as $key => $arr) {
                if ($arr['minimum'] <= 0) {
                    $minimum = 1;
                } else {
                    $minimum = $arr['minimum'];
                }
                if ($arr['maximum'] <= 0) {
                    $maximum = $arr['quantity'];
                } else {
                    if ($arr['maximum'] > $arr['quantity']) {
                        $maximum = $arr['quantity'];
                    } else {
                        $maximum = $arr['maximum'];
                    }
                }
                
                $tax = GoodsApi::currencyFormat((GoodsApi::getTax($arr['sale_price'], $arr['tax_rate'])), config('catalog_currency_code'));
                $sale_price = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
                $market_price = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
                if ($arr['country_code']) {
                    $country_code = strtolower($arr['country_code']);
                } else {
                    $country_code = 'cn';
                }
                $national_flag = __ROOT__ . '/' . APP_NAME . '/' . MODULE_NAME . '/' . MOBTPL . 'image/flags/' . $country_code . '.png';
                if ($arr['country_id']) {
                    $country_name = $arr['country_name'];
                } else {
                    $country_name = config('catalog_country_name');
                }
                
                if (substr($arr['thumb'], 0, 4) != 'http') {
                    $arr_goods[$key]['thumb'] = resizeImage($arr['thumb'], 'thumb');
                } else {
                    $arr_goods[$key]['thumb'] = $arr['thumb'];
                }
                
                $arr_goods[$key]['name'] = $arr['name'];
                $arr_goods[$key]['id'] = $arr['id'];
                $arr_goods[$key]['href'] = url('crossbbcg/goods/index', 'item_id=' . $arr['id']);
                $arr_goods[$key]['market_price'] = $market_price;
                $arr_goods[$key]['sale_price'] = $sale_price;
                $arr_goods[$key]['tax'] = $tax;
                $arr_goods[$key]['minimum'] = $minimum;
                $arr_goods[$key]['maximum'] = $maximum;
                $arr_goods[$key]['national_flag'] = $national_flag;
                $arr_goods[$key]['country_name'] = $country_name;
            }
        }
        $previous_input = input();
        $next_input = input();
        if (input('?page')) {
            $previous_input['page'] = $page - 1;
            $next_input['page'] = $page + 1;
        } else {
            $next_input['page'] = $page + 1;
        }
        $this->assign('search_total', $search_total);
        $this->assign('page', $page);
        $this->assign('max_page', $max_page);
        $this->assign('previous_url', url('index', $previous_input));
        $this->assign('next_url', url('index', $next_input));
        $this->assign('arr_goods', $arr_goods);
        
        
        // 面包屑导航
        $breadcrumb = [];
        if ($cat_id != 0) {
            $pids = GoodsApi::getPids($cat_id);
            foreach ($pids as $value) {
                $cat_model = CategoryModel::get($value);
                $category = array(
                    'href' => url('crossbbcg/search/index', 'cat_id=' . $value),
                    'name' => $cat_model['title'],
                );
                array_unshift($breadcrumb, $category);
            }
            $cat_model = CategoryModel::get($cat_id);
            $breadcrumb[] = array(
                'href' => url('crossbbcg/search/index', 'cat_id=' . $cat_id),
                'name' => $cat_model['title'],
            );
            $meta_title = $cat_model['meta_title'];
        }
        if ($like) {
            if (!$cat_id) {
                $breadcrumb[] = array(
                    'href' => url('crossbbcg/search/index', 'like=' . $like),
                    'name' => $like,
                );
                $meta_title = lang('Search') . '-' . $like;
            }
        } else {
            if (!$cat_id) {
                $breadcrumb[] = array(
                    'href' => url('crossbbcg/search/index'),
                    'name' => lang('Search_Title'),
                );
                $meta_title = lang('Search_Title');
            }
        }
        $this->assign('breadcrumb', $breadcrumb);
        
        
        $this->assign('input', input());
        $this->assign('meta_title', $meta_title);
        return $this->fetch();
    }
    
    /**
     * @Mark: 删除搜索的历史记录
     * @return bool
     * @Author: WangHuaLong
     */
    public function deleteSearchHistory()
    {
        // 删除单个关键字
        if (input('?get.key')) {
            $key = input('get.key');
            if (cookie('?search_history')) {
                $arr_search = cookie('search_history');
                
                // 删除相同的搜索词，保留最近新增的搜索词
                $del = array_search($key, $arr_search);
                if ($del !== false) {
                    unset($arr_search[$del]);
                    cookie('search_history', $arr_search);
                }
            }
        } else {
            cookie('search_history', null);
        }
        
        return true;
    }
    
    
}