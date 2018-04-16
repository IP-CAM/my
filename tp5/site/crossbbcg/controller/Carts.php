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
// | Carts.php  Version 2017/2/23
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\crossbbcg\service\Goods as GoodsApi;
use app\crossbbcg\service\Cart as CartApi;
use app\bcwareexp\model\Currency as CurrencyModel;
use app\bcwareexp\model\Area as AreaModel;
use app\member\service\Address as AddressApi;
use app\member\service\Member as MemberApi;
use app\member\model\Address as AddressModel;
use app\bcwareexp\service\Expresstpl as ExpresstplApi;
use app\order\service\Order as OrderApi;
use app\member\model\Account as AccountModel;
use app\bcwareexp\model\Country as CountryModel;
use app\order\model\Order as OrderModel;
use app\crossbbcg\model\GoodsSkuImage as GoodsSkuImageModel;


class Carts extends Shopbase
{
    public function _initialize()
    {
        parent::_initialize();
        
        // 更新购物车信息
        CartApi::updateCart();
    }
    
    /**
     * @Mark:购物车首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/23
     */
    public function index()
    {
        $carts_data = $this->getCarts();
        $this->assign('arr_good', $carts_data['arr_good']);
        $this->assign('all_selected', $carts_data['all_selected']);
        $this->assign('all_weight', $carts_data['all_weight']);
        $this->assign('all_price', $carts_data['all_price_tax']);
        $this->assign('all_tax', $carts_data['all_tax']);
        $this->assign('arr_seller_id', $carts_data['arr_seller_id']);
        
        
        $this->assign('meta_title', lang('Cart'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 获取购物车中的商品
     * @param bool $selected 显示选中的商品【可选】
     * @return array
     * @Author: WangHuaLong
     */
    public function getCarts($selected = false)
    {
        // 获取购物车的商品，按照商家排列
        $arr_good = [];
        if ($selected) {
            $goods = CartApi::getGoods(true);
        } else {
            $goods = CartApi::getGoods();
        }
        
        // 商户id
        $arr_seller_id = [];
        foreach ($goods as $key => $arr) {
            
            if ($arr['sale_price'] >= config('catalog_tax_limit')) {
                $tax = GoodsApi::getTax($arr['sale_price'], $arr['tax_rate']);
            } else {
                $tax = 0;
            }
            
            $sale_price   = GoodsApi::currencyFormat($arr['sale_price'], config('catalog_currency_code'));
            $market_price = GoodsApi::currencyFormat($arr['market_price'], config('catalog_currency_code'));
            $subtotal     = GoodsApi::currencyFormat($arr['sale_price'] * $arr['num'], config('catalog_currency_code'));
            
            $arr_good[$arr['seller_name']][$key]                        = $arr;
            $arr_good[$arr['seller_name']][$key]['href']                = url('crossbbcg/goods/index', 'item_id=' . $arr['good_id']);
            $arr_good[$arr['seller_name']][$key]['format_sale_price']   = $sale_price;
            $arr_good[$arr['seller_name']][$key]['format_market_price'] = $market_price;
            $arr_good[$arr['seller_name']][$key]['subtotal_tax']        = $tax * $arr['num'];
            $arr_good[$arr['seller_name']][$key]['subtotal']            = $arr['sale_price'] * $arr['num'];
            $arr_good[$arr['seller_name']][$key]['format_subtotal']     = $subtotal;
            // 商品积分
            $arr_good[$arr['seller_name']][$key]['subtotal_points'] = $arr['points'] * $arr['num'];
            
            // 最大购买量，最小购买量
            if ($arr['minimum'] <= 0) {
                $arr_good[$arr['seller_name']][$key]['minimum'] = 1;
            }
            if ($arr['maximum'] <= 0) {
                $arr_good[$arr['seller_name']][$key]['maximum'] = $arr['quantity'];
            } else {
                if ($arr['maximum'] > $arr['quantity']) {
                    $arr_good[$arr['seller_name']][$key]['maximum'] = $arr['quantity'];
                }
            }
            
            // 商户id
            $arr_seller_id[$arr['seller_name']] = $arr['seller_id'];
            
            // 商品主图判断
            if ($arr['merge_option_value_id'] != '') {
                $map       = [
                    'good_id'         => $arr['good_id'],
                    'option_value_id' => ['in', $arr['merge_option_value_id']]
                ];
                $sku_thumb = GoodsSkuImageModel::where($map)->limit(1)->value('image');
                if ($sku_thumb !== null && $sku_thumb != '') {
                    $arr_good[$arr['seller_name']][$key]['thumb'] = $sku_thumb;
                }
            }
        }
        
        
        /* 店铺统计 */
        $seller_subtotal = [];
        foreach ($arr_good as $key => $arr) {
            $seller_subtotal[$key]['subtotal']        = 0;
            $seller_subtotal[$key]['weight']          = 0;
            $seller_subtotal[$key]['subtotal_tax']    = 0;
            $seller_subtotal[$key]['subtotal_points'] = 0;
            
            foreach ($arr as $arr2) {
                if ($arr2['selected']) {
                    $seller_subtotal[$key]['subtotal'] += GoodsApi::currencyFormat($arr2['subtotal'], config('catalog_currency_code'), '', false);
                    $seller_subtotal[$key]['weight'] += CartApi::getWeight($arr2['weight'] * $arr2['num'], $arr2['weight_class_id']);
                    
                    $seller_subtotal[$key]['subtotal_tax'] += GoodsApi::currencyFormat($arr2['subtotal_tax'], config('catalog_currency_code'), '', false);
                    
                    $seller_subtotal[$key]['subtotal_points'] += $arr2['subtotal_points'];
                    
                }
            }
        }
        
        // 合并商家总计
        $all_total = [
            'total'  => 0, // 商品价格 + 税费
            'price'  => 0,   // 商品价格
            'weight' => 0,   // 商品重量
            'tax'    => 0,      // 商品税费
            'points' => 0,   // 商品积分
        ];
        foreach ($seller_subtotal as $key => $arr) {
            $all_total['price'] += $arr['subtotal'];
            $all_total['weight'] += $arr['weight'];
            $all_total['tax'] += $arr['subtotal_tax'];
            $all_total['total'] += $arr['subtotal_tax'] + $arr['subtotal'];
            $all_total['points'] += $arr['subtotal_points'];
        }
        
        // 货币单位与重量单位
        $symbol        = '￥';
        $currency_code = 'CNY';
        $currency_rate = 1;
        $currency      = CurrencyModel::where('code', config('catalog_currency_code'))->find();
        if ($currency !== null) {
            $symbol        = $currency['symbol'];
            $currency_code = $currency['code'];
            $currency_rate = $currency['rate'];
        }
        
        // 选中商品统计
        $all_selected = CartApi::countSelected();
        
        $carts_data                    = [];
        $carts_data['arr_good']        = $arr_good;
        $carts_data['currency_symbol'] = $symbol;
        $carts_data['currency_code']   = $currency_code;
        $carts_data['currency_rate']   = $currency_rate;
        
        
        // 后台控制默认选择的重量单位
        $carts_data['weight_class_id'] = config('default_weight_class_id');
        $carts_data['all_selected']    = $all_selected;
        $carts_data['all_total']       = $all_total;
        $carts_data['all_price_tax']   = $symbol . $all_total['total'];
        $carts_data['all_weight']      = $all_total['weight'] . config('default_weight_class_id');
        $carts_data['all_price']       = $symbol . $all_total['price'];
        $carts_data['all_tax']         = $symbol . $all_total['tax'];
        $carts_data['arr_seller_id']   = $arr_seller_id;
        $carts_data['arr_points']      = $all_total['points'];
        $carts_data['all_count']       = CartApi::countGood();
        
        return $carts_data;
    }
    
    /**
     * @Mark: 提交订单页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function checkout()
    {
        
        $member_id = is_login();
        
        // 判断客户是否登陆，未登陆跳转到登陆页面
        if ($member_id == 0) {
            // 存储跳转地址
            session('redirect_url', url('crossbbcg/carts/checkout'));
            $this->redirect(url('member/passport/index'));
        }
        
        
        if (session('?shipping_address_id')) {
            $shipping_address_id = session('shipping_address_id');
        } else {
            $shipping_address_id = 0;
        }
        
        
        // 获取用户地址
        $filter_data = array(
            'name' => $member_id
        );
        $arr_address = AddressApi::get_address($filter_data);
        if ($arr_address) {
            $address_ids = [];
            $has_address = false;
            foreach ($arr_address as $key => $arr) {
                $arr_address[$key]['province_name'] = AreaModel::where('id', $arr['province'])->value('name');
                $arr_address[$key]['city_name']     = AreaModel::where('id', $arr['city'])->value('name');
                $arr_address[$key]['district_name'] = AreaModel::where('id', $arr['district'])->value('name');
                
                // 判断是否已选择地址
                $arr_address[$key]['checked'] = 0;
                if (!$has_address) {
                    if ($shipping_address_id == $arr['id']) {
                        $arr_address[$key]['checked'] = 1;
                        $has_address                  = true;
                    } elseif ($arr['is_default']) {
                        $arr_address[$key]['checked'] = 1;
                        $has_address                  = true;
                        $shipping_address_id          = $arr['id'];
                    }
                }
                
                $address_ids[] = $arr['id'];
            }
            // 如果存在session_address_id又不在用户地址中，则消除
            if ($shipping_address_id && (!in_array($shipping_address_id, $address_ids))) {
                session('shipping_address_id', null);
                $shipping_address_id = 0;
            }
        }
        
        $this->assign('arr_address', $arr_address);
        
        // 购物车信息
        $carts_data = $this->getCarts(true);
        $this->assign('arr_good', $carts_data['arr_good']);
        $this->assign('all_selected', $carts_data['all_selected']);
        $this->assign('all_weight', $carts_data['all_weight']);
        $this->assign('all_price', $carts_data['all_price']);
        $this->assign('all_tax', $carts_data['all_tax']);
        
        // 空购物车，返回首页
        if (empty($carts_data['arr_good'])) {
            $this->redirect(url('crossbbcg/index/index'));
        }
        
        // 运费
        $shipping_price = 0;
        $total          = 0;
        
        if ($shipping_address_id) {
            $result         = $this->setShippingAddress($shipping_address_id);
            $total          = $result['total'];
            $shipping_price = $result['shipping_price'];
        }
        $this->assign('shipping_price', $shipping_price);
        $this->assign('total', $total);      // 商品总价格
        
        // 结账协议
        $this->assign('protocol_status', isset(config('index')['protocol_status']) ? 1 : 0);
        $this->assign('protocol_title', config('index')['protocol_title']);
        $this->assign('checkout_protocol', html_entity_decode(config('index')['checkout_protocol']));
        
        
        // 新增收货地址
        $param   = ['name' => $member_id];
        $list    = AddressApi::get_address($param);
        $country = \app\bcwareexp\service\Country::get_country();
        $this->assign('list', $list);
        $this->assign('country', $country);
        $this->assign('country_id', config('catalog_country_id'));
        
        $this->assign('meta_title', lang('Checkout'));
        return $this->fetch();
    }
    
    /**
     * @Mark: 提交订单
     * @Author: WangHuaLong
     */
    public function confirm()
    {
        $post_data  = input('post.');
        $carts_data = $this->getCarts(true);
        // 空购物车，返回首页
        if (empty($carts_data['arr_good'])) {
            return json(['code' => 0, 'msg' => lang('Confirm_Error'), 'url' => url('crossbbcg/index/index')]);
        }
        
        $member_id = is_login(); // 用户id
        $account   = AccountModel::get($member_id);
        $username  = $account['username'];  // 用户名
        
        //获取所有的商品的sku，用户id，完成订单后删除  删除购物车中的商品
        $sku_ids   = [];
        $sku_names = [];
        foreach ($carts_data['arr_good'] as $key => $arr) {
            foreach ($arr as $arr2) {
                $sku_ids[]   = $arr2['sku'];
                $sku_names[] = $arr2['good_name'];
            }
        }
        $sku_ids   = implode(',', $sku_ids);
        $sku_names = implode(',', $sku_names);
        $sku_names = mb_substr($sku_names, 0, 60, 'UTF-8'); // 截取60个字符
        if (strpos($sku_names, ',') !== false) {
            $sku_names .= lang('good_name_more');
        }
        
        
        $currency_symbol = $carts_data['currency_symbol'];
        $currency_code   = $carts_data['currency_code'];
        $currency_rate   = $carts_data['currency_rate'];
        
        $order_type = 1;          // 1,正常订单，0，测试订单（由系统生成）
        $address    = AddressModel::get(session('shipping_address_id'));
        $receipt    = array(
            // 收货信息
            'recode'    => $address['province'] . '/' . $address['city'] . '/' . $address['district'],
            //省市县区代码组合
            'consignee' => $address['consignee'],   //收货人姓名
            'country'   => CountryModel::where('id', $address['country'])->value('name'),   //收货的国家
            'province'  => AreaModel::where('id', $address['province'])->value('name'),     //收货的省份
            'city'      => AreaModel::where('id', $address['city'])->value('name'),         //收货的城市
            'district'  => AreaModel::where('id', $address['district'])->value('name'),     //收货的地区
            'address'   => $address['address'],     //收货的地区
            'zipcode'   => $address['zipcode'],     //收货人邮编
            'tel'       => $address['mobile'],      //收货人电话
            'mobile'    => $address['mobile'],      //收货人手机号
            'email'     => $address['email'],       //收货人email
            'idnumber'  => $address['identity'],
            'sfzzm'     => $address['front_img'],
            'sfzfm'     => $address['verso_img'],
        );
        
        // 发票和留言
        $postscript = isset($post_data['order_message']) ? $post_data['order_message'] : ''; // 订单留言
        // 发票留言 0 无，1 公司 2 个人
        $inv_type  = isset($post_data['invoice_type']) ? $post_data['invoice_type'] : '';
        $inv_payee = isset($post_data['invoice_title']) ? $post_data['invoice_title'] : ''; // 发票抬头
        // 纳税人识别号
        $inv_number = isset($post_data['invoice_number']) ? $post_data['invoice_number'] : '';
        if ($inv_type == 0) {
            $inv_payee  = '';
            $inv_number = '';
        }
        
        // 促销活动信息 TODO
        $bonus          = 0; // 使用红包金额
        $bonus_id       = 0; // 红包id
        $extension_id   = 0; // 活动id
        $extension_code = 0; // 活动标识代码
        $discount       = 0; // 折扣
        
        $order_data = array(
            'username'       => $username,
            'ip'             => $this->request->ip(),
            'source'         => MODULE_NAME,  //请求来源模块名
            'order_type'     => $order_type,
            'receipt'        => $receipt,
            'postscript'     => $postscript,
            'inv_payee'      => $inv_payee,
            'inv_type'       => $inv_type,
            'inv_number'     => $inv_number,
            'bonus'          => $bonus,
            'platform_type'  => PLATFORM,    //平台来源
            'bonus_id'       => $bonus_id,
            'extension_id'   => $extension_id,
            'extension_code' => $extension_code,
            'discount'       => $discount,
            'code'           => $currency_code,
            'rate'           => $currency_rate,
            'symbol'         => $currency_symbol,
        );
        
        // 获取订单拆单数据
        $orders = session('orders');
        session('orders', null);
        if ($orders !== null) {
            $seller_order_num = 0;
            foreach ($orders as $key => $arr) {
                foreach ($arr as $key2 => $arr2) {
                    $tax     = explode(',', $arr2['sku_tax']);
                    $str_tax = '';
                    foreach ($tax as $arr3) {
                        if ($arr3) {
                            $str_tax .= ',' . GoodsApi::currencyFormat($arr3, $currency_code, $currency_rate, false);
                        } else {
                            $str_tax .= ',0';
                        }
                        
                    }
                    $str_tax = substr($str_tax, 1);
                    
                    $order_data['sku_ids']   = $arr2['sku_ids'];
                    $order_data['sku_nums']  = $arr2['sku_nums'];
                    $order_data['sku_thumb'] = $arr2['sku_thumb'];
                    $order_data['sku_tax']   = $str_tax;
                    $order_data['seller_id'] = $key;   // 商家id
                    $order_data['integral']  = $arr2['order_points'];          // 订单可获得总积分
                    
                    $order_data['goods_amount'] = GoodsApi::currencyFormat($arr2['order_price'], $currency_code, $currency_rate, false);;  // 商品总金额
                    $order_data['order_tax'] = GoodsApi::currencyFormat($arr2['order_tax'], $currency_code, $currency_rate, false);; // 订单税收
                    $order_data['shipping_fee'] = GoodsApi::currencyFormat($arr2['freight'], $currency_code, $currency_rate, false);; // 运费
                    $order_data['order_amount']   = $order_data['goods_amount'] + $order_data['order_tax'] + $order_data['shipping_fee'];  // 订单商品总金额+订单总运费+订单总税费 TODO 优惠金额
                    $order_data['crossware_code'] = $arr2['crossware_code'];
                    // 运费模板id
                    $order_data['transport_id'] = $arr2['tpl_id'];
                    
                    
                    // 生成订单 important
                    $result = OrderApi::createOrderApi($order_data);
                    if ($result['code'] == 0) {
                        return json(['code' => 0, 'msg' => $result['msg']]);
                    }
                    // 减库存
                    $arr_sku          = explode(',', $arr2['sku_ids']);
                    $arr_sku_num      = explode(',', $arr2['sku_nums']);
                    $arr_sku_subtract = explode(',', $arr2['sku_subtract']);
                    $arr_good_ids     = explode(',', $arr2['good_ids']);
                    foreach ($arr_sku_subtract as $key3 => $arr3) {
                        if ($arr3 == 2) {
                            $delete_data = array(
                                'good_id'        => $arr_good_ids[$key3],
                                'sku'            => $arr_sku[$key3],
                                'num'            => $arr_sku_num[$key3],
                                'crossware_code' => $arr2['crossware_code']
                            );
                            CartApi::deleteQuantity($delete_data);
                        }
                    }
                    
                }
                $seller_order_num = count($arr);
            }
            
            // 订单生成后，删除购物车中的商品
            CartApi::deleteCartSku($sku_ids);
            
            // 只有一笔订单的情况下支付到付款页面，多订单的情况下跳转到会员中心页面
            if (count($orders) == 1 && $seller_order_num == 1) {
                session('payment_order_sn', $result['msg']);
                session('sku_names', $sku_names);
                return json(['code' => 1, 'msg' => lang('confirm_success'), 'url' => url('crossbbcg/carts/paycenter')]);
            } else {
                // 存储一个提示信息，多笔订单到会员页面的时候显示提示
                session('member_remind', lang('orders_remind'));
                return json(['code' => 1, 'msg' => lang('confirm_success'), 'url' => url('member/index/index')]);
            }
        } else {
            $result = json(['code' => 0, 'msg' => lang('confirm_repeat')]);
        }
        return $result;
    }
    
    /**
     * @Mark: 改变商品的选中状态
     * @Author: WangHuaLong
     */
    public function changeSelected()
    {
        $items = input('post.items/a');
        // 改变商品状态
        CartApi::changeSelected($items);
        
        // 购物车中选中商品的总重量
        $carts_data = $this->getCarts(true);
        $result     = [
            'all_weight'   => $carts_data['all_weight'],
            'all_price'    => $carts_data['all_price'],
            'all_tax'      => $carts_data['all_tax'],
            'all_selected' => $carts_data['all_selected'],
            'all_count'    => $carts_data['all_count']
        ];
        
        // 购物车中商品超过2000元的商品的税费
        return $result;
    }
    
    /**
     * @Mark: 加入购物车
     * @return array  成功，返回购物车总数，失败返回跳转地址，指向商品页面
     * @Author: WangHuaLong
     */
    public function addCart()
    {
        $result  = [];
        $good_id = input('post.item_id/d');
        $num     = input('post.num/d');
        if (input('?post.choose_sku')) {
            $choose_sku = input('post.choose_sku');
        } else {
            $choose_sku = false;
        }
        
        // 加入购物车
        if ($choose_sku) {
            $add_result = CartApi::addCart($good_id, $num, $choose_sku);
            if (!$add_result['code']) {
                return $add_result;
            }
        } else {
            // 判断商品是否有sku，多个sku跳转到商品页面
            $sku = GoodsApi::getGoodsSku($good_id, true);
            if (count($sku) == 1) {
                $add_result = CartApi::addCart($good_id, $num);
                if (!$add_result['code']) {
                    return $add_result;
                }
            } else {
                // sku 库存不足，或sku不存在，或有多个sku,返回商品页面，商品页面提示售罄
                $result['redirect'] = url('crossbbcg/goods/index', 'item_id=' . $good_id);
            }
        }
        
        // 是否直接购买
        if (input('?buy_now')) {
            CartApi::selectedOne($good_id, $num, $choose_sku);
            $result['redirect'] = url('crossbbcg/carts/checkout');
        }
        
        // 购物车中，当前用户的总商品数量
        $result['num'] = CartApi::countGood();
        return $result;
    }
    
    /**
     * @Mark: 存储收货地址id 到session
     * @Author: WangHuaLong
     */
    public function setShippingAddress($address_id = 0)
    {
        if (!$address_id) {
            $address_id = input('post.address_id');
        }
        
        session('shipping_address_id', $address_id);
        if (!session('?shipping_address_id')) {
            return false;
        }
        
        // 计算运费
        $carts_data          = $this->getCarts(true);
        $shipping_address_id = $address_id;
        $shipping_price      = 0;
        $orders              = [];
        $orders_total        = 0;
        if ($shipping_address_id) {
            $city_id = AddressModel::where('id', $shipping_address_id)->value('city');
            foreach ($carts_data['arr_good'] as $key => $arr) {
                $goods = [];
                foreach ($arr as $arr2) {
                    $seller_id = $arr2['seller_id'];
                    $goods[]   = array(
                        'goods_id' => $arr2['good_id'],
                        'sku'      => $arr2['sku'],
                        'buy_num'  => $arr2['num'],
                        'thumb'    => $arr2['thumb']
                    );
                }
                $filter_data = array(
                    'seller_id' => $seller_id,
                    'city_id'   => $city_id,
                    'info'      => $goods
                );
                $result      = ExpresstplApi::calculateFee($filter_data);
    
                $shipping_price += $result['freight'];
                $orders_total += $result['total_money'] + $result['freight'];
                
                foreach ($result['data'] as $code => $skus) {
                    foreach ($skus as $k => $sku) {
                        $orders[$seller_id][$k]['sku_ids']        = $sku['goods']['sku'];
                        $orders[$seller_id][$k]['sku_nums']       = $sku['goods']['buy_nums'];
                        $orders[$seller_id][$k]['sku_tax']        = $sku['goods']['tax'];
                        $orders[$seller_id][$k]['sku_thumb']      = $sku['goods']['sku_thumb'];
                        $orders[$seller_id][$k]['order_price']    = $sku['order_money'];
                        $orders[$seller_id][$k]['freight']        = $sku['freight'];
                        $orders[$seller_id][$k]['order_tax']      = $sku['order_taxes'];
                        $orders[$seller_id][$k]['order_points']   = $sku['total_points'];
                        $orders[$seller_id][$k]['crossware_code'] = $code;
                        $orders[$seller_id][$k]['sku_subtract']   = $sku['goods']['subtract'];
                        $orders[$seller_id][$k]['good_ids']       = $sku['goods']['goods_ids'];
                        // 运费模板id
                        $orders[$seller_id][$k]['tpl_id']       = $sku['tpl_id'];
                    }
                }
            }
        }
        
        // 存储订单信息，包括拆单资料
        session('orders', $orders);
        
        
        // 订单总金额 商品运费
        $shipping_price         = GoodsApi::currencyFormat($shipping_price, config('catalog_currency_code'), '', false);
        $total                  = $carts_data['all_total']['tax'] + $carts_data['all_total']['price'] + $shipping_price;
        $json                   = [];
        $json['total']          = $carts_data['currency_symbol'] . $total;
        $json['shipping_price'] = $carts_data['currency_symbol'] . $shipping_price;
        $json['orders_total']   = $orders_total;  // 拆单商品的总商品金额+总商品运费
        
        return $json;
    }
    
    /**
     * @Mark: 新增收货地址
     * @return false|int|\think\response\Json
     * @Author: WangHuaLong
     */
    public function addAddress()
    {
        $post_data        = $this->request->post();
        $post_data['uid'] = is_login();
        $address          = new AddressModel();
        
        // 验证数据
        $class = \think\Loader::parseClass('member', 'validate', 'Address');
        if (class_exists($class)) {
            $validate = \think\Loader::validate($class);
            $result   = $validate->check($post_data);
            if ($result !== true) {
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        // 实名认证
        //调用实名认证接口 调用API服务
        $data = [
            'realName' => $post_data['consignee'],
            'IDcard'   => $post_data['identity']
        ];
        $res  = MemberApi::identification($data);
        
        //判断认证结果
        if (!$res['code']) {
            //return json(['code' => 0, 'msg' => lang('realauth_error')]);
        }
        
        // 新增用户的地址
        $address->isUpdate(false)->save($post_data);
        $address_id = $address->getLastInsID();
        session('shipping_address_id', $address_id);
        // 设置默认值
        if ($post_data['is_default'] == 1) {
            $map = [
                'uid' => $post_data['uid'],
                'id'  => ['<>', $address_id]
            ];
            AddressModel::where($map)->update(['is_default' => 0]);
        }
        
        return json(['code' => 1, 'msg' => $address_id]);
    }
    
    /**
     * @Mark: 修改收货地址
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function modifyAddress()
    {
        $post_data = input('post.');
        
        
        // 修改用户的地址
        $map         = [
            'id'  => $post_data['address_id'],
            'uid' => is_login()
        ];
        $update_data = [
            'country'    => $post_data['country'],
            'province'   => $post_data['province'],
            'city'       => $post_data['city'],
            'district'   => $post_data['district'],
            'address'    => $post_data['address'],
            'mobile'     => $post_data['mobile'],
            'is_default' => $post_data['is_default']
        ];
        
        AddressModel::where($map)->update($update_data);
        
        // 设置默认值
        if ($post_data['is_default'] == 1) {
            $map2 = [
                'uid' => is_login(),
                'id'  => ['<>', $post_data['address_id']]
            ];
            AddressModel::where($map2)->update(['is_default' => 0]);
        }
        
        return json(['code' => 1, 'msg' => lang('modify_address_success')]);
    }
    
    /**
     * @Mark: 获取用户地址
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function getAddress()
    {
        $member_id  = is_login();
        $address_id = input('post.address_id');
        $map        = [
            'uid' => $member_id,
            'id'  => $address_id
        ];
        
        $result = AddressModel::where($map)->find();
        if ($result === null) {
            return json(['code' => 1, 'msg' => lang('get_address_error')]);
        }
        return json(['code' => 1, 'msg' => lang('get_address_success'), 'data' => $result->toArray()]);
        
        
    }
    
    /**
     * @Mark: 删除购物车中的商品
     * @return bool
     * @Author: WangHuaLong
     */
    public function deleteCartGood()
    {
        
        if (input('post.cart_id/a')) {
            foreach (input('post.cart_id/a') as $cart_id) {
                CartApi::delete($cart_id);
            }
        } else {
            if (input('?param.cart_id')) {
                CartApi::delete(input('param.cart_id/d'));
            }
        }
        
        return json(['code' => 1, 'msg' => lang('delete_success')]);
    }
    
    /**
     * @Mark: 改变购物车单个商品的数量
     * @return \think\response\Json
     * @Author: WangHuaLong
     */
    public function changeCartNum()
    {
        $cart_id = input('post.cart_id/d');
        $num     = input('post.num/d');
        
        CartApi::changeCartNum($cart_id, $num);
        
        $json = [];
        // 获取更改商品数量的价格
        $result = CartApi::getCartSku($cart_id);
        // 获取失败，没有这个商品
        if ($result === false) {
            $json['redirect'] = url('crossbbcg/carts/index');
        }
        
        $json['subtotal'] = GoodsApi::currencyFormat($result['sale_price'] * $result['num'], config('catalog_currency_code'));
        
        
        return json($json);
    }
    
    /**
     * @Mark: 订单支付页面
     * @return mixed
     * @Author: WangHuaLong
     */
    public function paycenter()
    {
        if (input('?order_sn')) {
            $order_sn = input('order_sn');
            session('payment_order_sn', $order_sn);
        } elseif (session('?payment_order_sn')) {
            $order_sn = session('payment_order_sn');
            // session('payment_order_sn',null);    TODO 是否可以刷新当前订单支付页面？
        } else {
            session('member_remind', lang('payment_error'));
            $this->redirect(url('member/index/index'));
        }
        
        
        $this->assign('order_sn', $order_sn);
        
        //  检查提交订单流程与支付页面的错误处理
        
        // 获取订单信息
        $order = OrderModel::where('order_sn', $order_sn)->order('create_time', 'DESC')->find();
        if ($order == null) {
            session('member_remind', lang('payment_error'));
            $this->redirect(url('member/index/index'));
        }
        // 只处理未付款的订单
        if ($order['status'] != 'WAIT_BUYER_PAY') {
            session('member_remind', lang('order_payed'));
            $this->redirect(url('member/index/orderdetail', 'order_sn=' . $order_sn));
        }
        // 已付款订单
        if ($order['pay_status'] == 1) {
            session('member_remind', lang('order_payed'));
            $this->redirect(url('member/index/index'));
        }
        $this->assign('order_amount', $order['order_amount']);
        $this->assign('symbol', $order['symbol']);
        $this->assign('create_time',$order['create_time']);
        
        //  获取现有的支付方式，合并成支付数据
        $arr_payments = [];
        $default_code = '';
        $filter_data  = array(
            'subjection' => 'seapays',     // 跨境电商支付方式
            PLATFORM     => 1,
            'status'     => 1
        );
        $payments     = \app\common\service\Extend::getExt($filter_data);
        if ($payments['data']) {
            foreach ($payments['data'] as $key => $arr) {
                $arr_payments[$key]['config'] = unserialize($arr['config']);
                $arr_payments[$key]['title']  = $arr_payments[$key]['config']['pay_name'];
                $arr_payments[$key]['code']   = $arr['code'];
                $arr_payments[$key]['logo']   = __ROOT__ . '/static/images/seapays/' . strtolower($arr['code']) . '.png';
                if ($key == 0) {
                    $arr_payments[$key]['default'] = 1;   // 默认支付方式
                    $default_code                  = $arr['code'];
                } else {
                    $arr_payments[$key]['default'] = 0;
                }
            }
        }
        $this->assign('default_code', $default_code);
        $this->assign('arr_payments', $arr_payments);
        $this->assign('meta_tital', lang('Success_Submit_Order'));
        $this->assign('expire_time', get_config('crossbbcg')['tradeclose'] * 3600);
        return $this->fetch();
    }
    
    /**
     * @Mark: 支付
     * @return mixed
     * @Author: WangHuaLong
     */
    public function toPay()
    {
        $order_sn     = session('payment_order_sn');
        $sku_names    = session('sku_names');
        $payment_code = input('get.payment_code');
        
        // 获取订单信息
        $order = OrderModel::where('order_sn', $order_sn)->order('create_time', 'DESC')->find();
        
        if ($payment_code) {
            $extClass = "\\seapays\\" . $payment_code;
            $seapays  = new $extClass();
            $payData  = [
                'OrderNO'  => $order_sn,
                'Name'     => $sku_names,
                'Amount'   => $order['order_amount'],
                'platform' => PLATFORM
            ];
            $sendData = $seapays->getSendData($payData);
            return $seapays->doPay($sendData);
        }
    }
    
    /**
     * @Mark: 支付时，再一次检查订单状态
     * @return array
     * @Author: WangHuaLong
     */
    public function checkOrder()
    {
        $order_sn = input('post.order_sn');
        // 获取订单信息
        $order = OrderModel::where('order_sn', $order_sn)->order('create_time', 'DESC')->find();
        // 只处理未付款的订单
        if ($order['status'] != 'WAIT_BUYER_PAY') {
            return ['code' => 0, 'url' => url('member/index/orderdetail', 'order_sn=' . $order_sn)];
        } else {
            return ['code' => 1];
        }
        
    }
    
    public function ajaxcart()
    {
        
        $carts_data = $this->getCarts();
        $this->assign('arr_good', $carts_data['arr_good']);
        $this->assign('all_selected', $carts_data['all_selected']);
        $this->assign('all_weight', $carts_data['all_weight']);
        $this->assign('all_price', $carts_data['all_price']);
        $this->assign('all_tax', $carts_data['all_tax']);
        $this->assign('arr_seller_id', $carts_data['arr_seller_id']);
        return $this->fetch();
    }
    
    /**
     * @Mark: 获取购物车当前的数量
     * @return int
     * @Author: WangHuaLong
     */
    public function update_num()
    {
        return CartApi::countGood();
    }
    
    
    /**
     * @Mark:AJAX 请求获取省级地区
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function ajax_get_province()
    {
        $country = $this->request->has('country') ? $this->request->param('country') : 0;//国家id
        $param   = ['pid' => $country];
        $zone    = \app\bcwareexp\service\Area::get_area($param);   //获取地区
        $data    = [];
        foreach ($zone as $v) {
            $data[] = AreaModel::all(['pid' => $v['id']]); //获取省份
        }
        //转化为二维数组
        $province = [];
        foreach ($data as $val) {
            foreach ($val as $value) {
                $province[] = $value;
            }
        }
        if ($province) {
            return json(['code' => 1, 'data' => $province]);
        } else {
            return json(['code' => 0, 'data' => null]);
        }
        
    }
    
    /**
     * @Mark:AJAX 请求获取市级地区
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function ajax_get_city()
    {
        $province = $this->request->has('province') ? $this->request->param('province') : 0;//省id
        $param    = ['pid' => $province];
        $city     = \app\bcwareexp\service\Area::get_area($param);   //获取地区
        if ($city) {
            return json(['code' => 1, 'data' => $city]);
        } else {
            return json(['code' => 0, 'data' => null]);
        }
    }
    
    /**
     * @Mark:AJAX 请求获取县级地区
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/10
     */
    public function ajax_get_district()
    {
        $district = $this->request->has('district') ? $this->request->param('district') : 0;//区id
        $param    = ['pid' => $district];
        $district = \app\bcwareexp\service\Area::get_area($param);   //获取地区
        if ($district) {
            return json(['code' => 1, 'data' => $district]);
        } else {
            return json(['code' => 0, 'data' => null]);
        }
    }
    
    /**
     * @Mark: 身份正反面上传
     * @return \think\response\Json
     * @Author: fancs
     * @Version 2017/7/18
     */
    public function id_upload()
    {
        $file = $this->request->file('file');
        return $this->up($file, 'id_card');
    }
    
    
}