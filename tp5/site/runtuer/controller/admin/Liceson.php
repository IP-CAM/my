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
// | Projects  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\runtuer\controller\admin;

use app\admin\controller\Admin;
use app\admin\service\Service;
use think\Cache;


class Liceson extends Admin
{
    //以下数组键名请勿随意更改
    public static $version_type = array(1 => 'Business_normal', 2 => 'Business_advanced', 3 => 'Business_customization');
    public static $liceson_type = array(1 => 'lic_product', 2 => 'lice_soft');
    public static $product_type = array(1 => 'B2C', 2 => 'BBC', 3 => 'BBCG', 4 => 'CROSSBBC', 5 => 'CROSSBBCG');
    
    /**
     * @Mark:继承
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->conDb  = 'Liceson';
        $this->search = 'url';
        $this->assign('version_type', self::$version_type);
        $this->assign('liceson_type', self::$liceson_type);
        $this->assign('product_type', self::$product_type);
    }
    
    public function index()
    {
        //赋值
        $param        = $this->request->param();
        $start_time   = isset($param['start_time']) ? trim($param['start_time']) : '';
        $end_time     = isset($param['end_time']) ? trim($param['end_time']) : '';
        $name         = isset($param['name']) ? trim($param['name']) : '';
        $product_type = isset($param['product_type']) ? $param['product_type'] : '';
        
        $product_type ? $this->index_where['product_type'] = $product_type : '';
        $name ? $this->index_where[$this->search] = array('like', '%' . (string)$name . '%') : '';
        $start_time ? $this->index_where['create_time'] = array('>=', strtotime($start_time)) : '';
        $end_time ? $this->index_where['end_time'] = array('<=', strtotime($end_time)) : '';
        
        $lists = Service::getlist($this->conDb, $this->index_where, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign("meta_title", $this->meta_title);
        return $this->fetch();
    }
    
    
    public function _empty()
    {
        switch (ACTION_NAME) {
            case 'ok':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'wait':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'test':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'dev':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
            case 'err':
                $where = array('status', 'eq', 1);
                $this->assign('data', null);
                break;
        }
        
        return $this->fetch('index');
    }
    
    /**
     * @Mark:过期授权
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function over()
    {
        //赋值
        $param        = $this->request->param();
        $name         = isset($param['name']) ? trim($param['name']) : '';
        $product_type = isset($param['product_type']) ? $param['product_type'] : '';
        
        
        $this->index_where = ['end_time' => [['<=', time()], ['<>', 9]]];
        $product_type ? $this->index_where['product_type'] = $product_type : '';
        $name ? $this->index_where[$this->search] = array('like', '%' . (string)$name . '%') : '';
        $lists = Service::getlist($this->conDb, $this->index_where, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign("meta_title", $this->meta_title);
        return $this->fetch();
    }
    
    /**
     * @Mark:已授权
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function ok()
    {
        //赋值
        $param        = $this->request->param();
        $name         = isset($param['name']) ? trim($param['name']) : '';
        $product_type = isset($param['product_type']) ? $param['product_type'] : '';
        $this->index_where = ['end_time' => [['>=', time()], ['=', 9], 'or'], 'status' => 1];
        if ($product_type) $this->index_where['product_type'] = $product_type;
        $name ? $this->index_where[$this->search] = array('like', '%' . (string)$name . '%') : '';
        $lists = Service::getlist($this->conDb, $this->index_where, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign("meta_title", $this->meta_title);
        return $this->fetch();
    }
    
    /**
     * @Mark:盗版系统
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/10/13
     */
    public function err()
    {
        if (Cache::has('liceson_record')) {
            $list = Cache::get('liceson_record');
        } else {
            $list = [];
        }
        $this->assign('list',$list);
        return $this->fetch();
    }
}