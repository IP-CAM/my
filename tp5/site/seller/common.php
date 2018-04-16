    <?php
    // +----------------------------------------------------------------------
    // | ETshop [ Rapid development framework for Cross border Mall ]
    // +----------------------------------------------------------------------
    // 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
    // +----------------------------------------------------------------------
    // | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
    // +----------------------------------------------------------------------
    // | Author: theseaer <theseaer@qq.com>  Version 1.0  2016/3/12
    // +----------------------------------------------------------------------
    
    /**
     * @Mark:获取商户信息
     * @param $id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/27
     * @return mixed
     */
    
    function getSellerName($id)
    {
        $re = \app\seller\model\Store::get($id);
        return $re;
    }
    
    /**
     * @Mark:获取店铺类型
     * @param $cat_id int
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/2
     * @return mixed
     */
    function getShopCat($cat_id)
    {
        $data = \app\seller\model\Shopcat::get($cat_id);
        return $data;
    }
    
    /**
     * @Mark:获取账户信息
     * @param $id
     * @Author: yang <502204678@qq.com>
     * @Version 2017/6/2
     * @return mixed
     */
    function getShopAccount($id)
    {
        $data = \app\seller\model\Account::get($id);
        return $data;
    }
    
    
    /**
     * @Mark:获取商户系统设置信息
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/31
     */
    function getSetting()
    {
        $Conf = MODULE_PATH . DS . 'extra' . DS . ACTION_NAME . '.php';
        $data = is_file(realpath($Conf)) ? include realpath($Conf) : null;
        return $data;
    }
    
    
    /**
     * @Mark:隐藏邮箱中间部分
     * @param $email
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/1
     */
    function hideEmail($email)
    {
        $pos = explode('@', $email);
        if (count($pos) == 2) {
            $len    = strlen($pos[0]);
            $first  = substr($pos[0], 0, 2);
            $secend = str_repeat('*', $len - 2);
            $email  = $first . $secend . '@' . $pos[1];
        }
        return $email;
    }
    
    /**
     * @Mark:商户操作日志
     * @param $seller_id int 商户id
     * @param $uid int 操作人id
     * @param $action_id int 被操作记录id
     * @param $model_name string 数据所属模型
     * @param $log_info string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/2
     * @return boolean
     */
    function seller_log($seller_id, $uid, $log_info, $action_id = 0, $model_name = '')
    {
        $data = array(
            'seller_id'    => $seller_id,
            'uid'          => $uid,
            'action_model' => $model_name,
            'action_id'    => $action_id,
            'log_info'     => $log_info
        );
        \app\seller\model\SellerLog::create($data);
        return true;
    }
    
    /**
     * @Mark:罗列操作按钮
     * @param array $params
     * @return string
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/22
     */
    function getSellerButton($params = array())
    {
       $button = $needle = $i = '';
        $request     = \think\Request::instance();
        //当前模块/控制器/方法
        $needle = strtolower($request->module() . '/' . $request->controller() . '/' . $request->action());
        //寻找Child所在的组
        $data = \think\Cache::get('ShopMenus');
        foreach ($data as $index => $item) {
            if ($item['url'] === $needle) {
                $i = $index;
                break;
            }
        }
        
        if (!empty($data[$i]['button'])) {
            //按order 排序
            $tmpButton = array_sort($data[$i]['button'], '0');
            foreach ($tmpButton as $it => $sub) {
                if (strtoupper($sub[0]) == -1) continue;
                if (is_array(getAssessList())  && !in_array(strtolower($sub[1]),getAssessList())) continue;
                switch ($it) {
                    case 'Addnew':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' add" ' : 'class="btn btn-etshop addnew ajax-get add" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : ' data-width="1160"';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : 'data-height="768"';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $layer_title = array_key_exists(6, $sub) && $sub[6] ? $sub[6] : '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-plus';
                        break;
                    case 'Delete':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' del" ' : 'class="btn btn-etshop ajax-post confirm del" ';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : 'data-layer="' . lang('del') . '"';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-close';
                        break;
                    case 'Enable':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn btn-etshop enable ajax-post" ';
                        $param       = $sub[7] ? ' target-form="' . $sub[7] . '"' : '';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : '  fa-heart';
                        break;
                    case 'Disable':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn btn-etshop disable ajax-post" ';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : 'ids';
                        $layer_title = $sub[6] ? 'data-layer="' . lang($sub[6]) . '"' : '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : '  fa-heart-o';
                        break;
                    case 'Sort':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '"  id="sort"' : 'class="btn btn-etshop" id="sort"';
                        $param       = array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : 'ids';
                        $layer_title = '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : ' fa-sort';
                        break;
                    case 'Newopt':
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' add" ' : 'class="btn btn-etshop" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : ' data-width="1024"';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : 'data-height="768"';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $layer_title = array_key_exists(6, $sub) && $sub[6] ? $sub[6] : '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-object-ungroup';
                        break;
                    case 'Clear':
                        $style       = $sub[2] ? 'class="' . $sub[2] . '"' : 'class="btn btn-etshop"';
                        $param       = '';
                        $layer_title = '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-close';
                        break;
                    case 'Import':
                        $style       = array_key_exists(2, $sub) && $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn btn-etshop import ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : ' data-width="400"';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : ' data-height="280"';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $layer_title = '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-mail-forward';
                        break;
                    case 'Export':
                        $style       = array_key_exists(2, $sub) && $sub[2] ? 'class="' . $sub[2] . '" ' : 'class="btn btn-etshop export ajax-get"';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : ' data-width="400"';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : ' data-height="280"';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $param       .= array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : 'ids';
                        $layer_title = '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-reply-all';
                        break;
                    default:
                        $style       = $sub[2] ? 'class="' . $sub[2] . ' btn btn-etshop" ' : 'class="btn btn-etshop ajax-get" ';
                        $param       = array_key_exists(3, $sub) && $sub[3] ? ' data-width="' . $sub[3] . '"' : ' data-width="1024"';
                        $param       .= array_key_exists(4, $sub) && $sub[4] ? ' data-height="' . $sub[4] . '"' : ' data-width="768"';
                        $param       .= array_key_exists(5, $sub) && $sub[5] ? ' data-showbar="' . $sub[5] . '"' : '';
                        $param       .= array_key_exists(7, $sub) && $sub[7] ? ' target-form="' . $sub[7] . '"' : 'ids';
                        $layer_title = array_key_exists(6, $sub) && $sub[6] ? $sub[6] : '';
                        $i           = array_key_exists(8, $sub) && $sub[8] ? $sub[8] : 'fa-circle-o';
                    
                }
                
                if (stripos($sub[1], 'javascript') !== false) {
                    $button .= '<a href="' . $sub[1] . '" ' . $style . ' title="' . lang($it) . '" ' . $layer_title . ' ' . $param . '><i class="fa ' . $i . '"></i>' . lang($it) . '</a>';
                } else if (empty($sub[1])) {
                    $button .= '<a href="' . url('/', $params) . '" ' . $style . '><i class="fa ' . $i . '"></i>' . lang($it) . '</a>';
                } else {
                    $button .= '<a href="' . url('/' . $sub[1], $params) . '" ' . $style . ' title="' . lang($it) . '" ' . $layer_title . ' ' . $param . '><i class="fa ' . $i . '"></i>' . lang($it) . '</a>';
                }
            }
        };
        
        return $button;
    }

    /**
     * @Mark:公共路由，不受权限控制
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/25
     */
    function getPublicUrl()
    {
        $menu = Cache('ShopMenus');
        $url  = [];
        foreach ($menu as $k => $v) {
            if ($v['permission'] === 0) $url[] = $v['url'];
            if (!empty($v['button'])) {
                foreach ($v['button'] as $kk => $vv) {
                    if ($vv[6] === 0) $url[] = $vv[2];
                }
            }
        }
        return $url;
    }

    /**
     * @Mark:获取用户权限
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/25
     */
    function getAssessList(){
        $role     = \think\Session::get('role');
        if ($role) {
            $roleInfo = \app\seller\Model\Role::get($role);
            $arr = unserialize($roleInfo['right']);
            $assessUrl = array_merge($arr, getPublicUrl());
            return $assessUrl;
        }
        return $role;
    }

    /**
     * @Mark:订单统计
     * @param $day int 查询天数
     * @return array
     * @Author: yang <502204678@qq.com>
     * @Version 2017/9/28
     */
    function getOrderNum($day=null)
    {
        //所有订单信息
        $param = \think\Request::instance()->param();
        if (!$day) {
            if (isset($param['search_time'])) {
                $day=$param['search_time'];
            } else {
                $day = 7;
            }
        }
        $arr = [];
        if ($day == 1) {
            $hour = date('H',time());
            for ($i=23;$i>=0;$i--) {
                $time = date('H:i:s',mktime($hour-$i, 0, 0, date('m'), date('d'), date('Y')));
                $start_time = ['>=', mktime($hour-$i, 0, 0, date('m'), date('d'), date('Y'))];
                $end_time = ['<=', mktime($hour-$i-1, 0, 0, date('m'), date('d'), date('Y'))];
                $where['create_time'][] = $start_time;
                $where['create_time'][] = $end_time;
                $where['seller_id'] = SellerId;
                //所有订单
                $all_orders = app\order\model\Order::where($where)->count();
                $arr[$time]['all'] = $all_orders;
                //待付款订单
                $where['pay_status'] = 0;
                $paid_order = app\order\model\Order::where($where)->count();
                $arr[$time]['paid'] = $paid_order;
                //已付款订单
                $where['pay_status'] = 1;
                $paid_order = app\order\model\Order::where($where)->count();
                $arr[$time]['no_paid'] = $paid_order;
                //已完成订单
                $where['status'] = 'TRADE_FINISHED';
                $paid_order = app\order\model\Order::where($where)->count();
                $arr[$time]['finished'] = $paid_order;
            }
        
        } else {
            for ($i = $day; $i >= 0; $i--) {
                $where['create_time'] = [];
                $date = date('Y-m-d', strtotime("-$i day"));
                $start = ['>=', mktime(0, 0, 0, date('m'), date('d') - $i, date('Y'))];
                $end = ['<=', mktime(23, 59, 59, date('m'), date('d') - $i, date('Y'))];
                $where['create_time'][] = $start;
                $where['create_time'][] = $end;
                $where['seller_id'] = SellerId;
                //所有订单
                $all_orders = app\order\model\Order::where($where)->count();
            
                $arr[$date]['all'] = $all_orders ;
                //待付款订单
                $where['pay_status'] = 0;
                $no_paid_order = app\order\model\Order::where($where)->count();
                $arr[$date]['no_paid'] = $no_paid_order ;
                //已付款订单
                $where['pay_status'] = 1;
                $paid_order = app\order\model\Order::where($where)->count();
                $arr[$date]['paid'] = $paid_order ;
            
                //已完成订单
                $where['status'] = 'TRADE_FINISHED';
                $finished_order = app\order\model\Order::where($where)->count();
                $arr[$date]['finished'] = $finished_order ;
                unset($where);
            }
        }
        $time = $order = [];
        foreach ($arr as $k=>$v) {
            $order['all'][] = $v['all'];
            $order['paid'][] = $v['paid'];
            $order['no_paid'][] = $v['no_paid'];
            $order['finished'][] = $v['finished'];
            $time[] = $k;
        }
        $data = [
            'time' => json_encode($time),
            'all' => json_encode($order['all']),
            'paid' => json_encode($order['paid']),
            'no_paid' => json_encode($order['no_paid']),
            'finished' => json_encode($order['finished']),
        ];
        return $data;
    }
