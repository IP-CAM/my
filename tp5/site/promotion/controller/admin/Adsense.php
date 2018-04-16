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
// | 广告管理  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;
use app\promotion\service\Adsense as Adsenseapi;
use app\promotion\model\Adsensepos as AdsenseposModel;

class Adsense extends Admin
{
    /**
     * @Mark:初始化
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/22
     */
    public function _initialize(){
        parent::_initialize();
        $Adsensetype = [
            1 => lang('image'),
            2 => lang('Flash'),
            3 => lang('Code'),
            4 => lang('Text')
        ];
        $this->assign('Adsensetype', $Adsensetype);
        $this->assign('Adsenseitem', null);
    }
    
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/22
     */
    public function index(){
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';     //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //开始时间
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //结束时间
    
        $name       ? $index_map['title|seo_title|seo_keywords|seo_description'] = ['like','%'. $name .'%'] : '';
        
        //按时间查询
        $start_time ? $index_map['create_time'] = ['>=', strtotime($start_time)] : '';
        $end_time   ? $index_map['create_time'] = ['<=', strtotime($end_time)] : '';
    
        //同时具备时
        if($start_time && $end_time)
        {
            $index_map['create_time'] = [
                ['>=', strtotime($start_time)],
                ['<=', strtotime($end_time)],
                'AND'
            ];
        }
    
        $index_map['status'] = ['neq', null, 'or'];
    
        $data  = Adsenseapi::getlist($this->conDb, $index_map, 'end_time desc');
    
        $aDitem = AdsenseposModel::all();
    
        $this->assign('list', $data['list']);
        $this->assign('page', $data['page']);
        $this->assign('_total', $data['total']);
        $this->assign('adpostion', $aDitem ? $aDitem : null);
        $this->assign('meta_title', lang('Adsenselist'));
        return $this->fetch();
    }
    
    /**
     * @Mark:选择商品弹出层
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/29
     */
    public function choose(){
        $search_keys = input("search_key");
        /*$cmap = array();
        if($search_keys){
            $cmap["name"] = array('like', '%'.$search_keys.'%');
        }
        $cmap["status"] = array("eq", 1);
        //$cmap['_string'] = "langid=0 or langid=".$this->langid.""; //一个产品只能参与一个活动
        $cmap['_string'] = "(langid=0 or langid=".$this->langid.") and (prom_type='' or prom_type='".I('get.type')."')";
        C('LIST_ROWS', 10);
        $lists = $this->lists("Otogoods",$cmap,"id desc", "id,name");//dump(M("Otogoods")->getlastsql());exit;*/
        $this->assign('list', null);
        $this->assign('meta_title', lang('Choose Goods'));
        return $this->fetch();
    }
}