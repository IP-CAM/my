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
// | Index  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;
use app\admin\controller\Admin;

class Distribution extends Admin
{
    public function _initialize(){
        parent::_initialize();
        $this->Adsense_type = array(
            1=>lang('image'),
            2=>lang('Flash'),
            3=>lang('Code'),
            4=>lang('Text')
        );
    }

    public function index(){
        $this->assign ("meta_title", lang('Item'));
        return $this->fetch();

        $search_map = $search_end = array();
        if(isset($_GET['aditem'])){
            $search_map['aditem']  = array('eq', I('aditem'));
        }
        if(isset($_GET['style'])){
            $search_map['style'] = array('eq', I('style'));
        }
        if(isset($_GET['name'])){
            $search_map['title'] = array('like', '%'.(string)I('name').'%');
        }
        if ( isset($_GET['start_time']) ) {
            $search_map['begin_time'][] = array('egt',strtotime(I('start_time')));
        }
        if ( isset($_GET['end_time']) ) {
            //$search_map[] = 'end_time=9 or end_time<='. 24*60*60 + strtotime(I('end_time')) .'';
            $search_map['end_time'][] = array('elt',strtotime(I('start_time')));
            $search_end['end_time'] = array('eq', 9);
            $search_end['_logic'] = 'or';
            $search_end['_complex'] = $search_map;
            $search_map = $search_end;
        }

        $search_map["_string"] = $this->index_where;

        $Adsense = $this->lists('Adsense',$search_map,'id desc');
        $this->assign('list',$Adsense);
        $this->adlocation = D('AdsenseItem')->where('status=1')->getField('id,title,width,height');
        $this->assign('group', $this->adlocation);
        $this->meta_title = lang('Adsense');
        $this->fetch();
    }

    public function item(){
        $where[] = 'langid=0 or langid='.$this->langid.'';
        $Adsense_item = $this->lists('AdsenseItem',$where,'sort asc,id desc');
        $this->assign('list',$Adsense_item);
        $this->meta_title = lang('Adsenseitem');
        $this->display();
    }

    //站长工具添加
    public function additem(){
        $this->controller_name = 'AdsenseItem';
        $this->edittpl = 'edititem';
        parent::add();
    }

    //编辑站长工具
    public function edititem(){
        $this->controller_name = 'AdsenseItem';
        parent::edit();
    }

    public function itemdisable(){
        $this->controller_name = 'AdsenseItem';
        parent::disable();
    }

    public function itemenable(){
        $this->controller_name = 'AdsenseItem';
        parent::enable();
    }

    public function deleteitem(){
        $this->controller_name = 'AdsenseItem';
        parent::delete();
    }
}