<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: fancs
// +----------------------------------------------------------------------
// | Reported  Version 1.0  2017/5/26 举报控制器
// +----------------------------------------------------------------------
namespace app\fans\controller\admin;

use app\admin\controller\Admin;
use app\member\service\Member;
use app\fans\service\Reported as Reportedapi;

class Reported extends Admin
{
    /**
     * @Mark:举报列表页
     * @return mixed
     * @Author: fancs
     * @Version 2017/5/25
     */
    public function index()
    {
        $index_map  = [];
        $parems     = $this->request->param();
        $name       = isset($parems['name']) ? $parems['name'] : '';
    
        //查询条件
        $name ? $index_map['name|model|alias'] =  ['like','%'.trim($name).'%'] : '';
        //按用户查询
        if($name)
        {
            $user = Member::getUserInfo($name);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
    
        //按时间查询
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //时间结束
        if ($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }

        $lists = Reportedapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang($this->conDb));
        return $this->fetch();
    }

    /**
     * /**
     * @Mark:批量撤销举报
     * @Author: fancs
     * @Version 2017/5/25
     * @return \think\response\Json
     */
    public function undo()
    {
        $parems     = $this->request->param();
        $ids        = isset($parems['ids']) ? (array)$parems['ids'] : '';
        empty($ids) && $this->error(lang('Disablenoselect')) ;
        $pk         = isset($parems['pk']) ? trim($parems['pk']) : '';
        $changeid   = isset($parems['changeid']) ? trim($parems['changeid']) : '';
        $db         = isset($parems['db']) ? trim($parems['db']) : '';
        
        $this->status   = isset($pk) ? $pk : $this->status;
        $this->pk       = isset($changeid) ? $changeid : $this->pk;
        $this->conDb    = isset($db) ? $db : $this->conDb;
        $map            = [$this->pk => ['in', implode(',', $ids)]];

        $modObj      =  '\\app\\'.MODULE_NAME.'\\model\\' .ucfirst($this->conDb);
        $table       =  new $modObj();

        try{
            $status =  $table::where($map)->setField($this->status, 0);
        }catch(\Exception $e){
            //$this->error(lang('Executeerror'), $this->jumpUrl);  //带刷新
            return json(['code' => 0, 'msg' => lang('Executeerror') ]);  //不刷新
        }

        if ($status!==false) {
            //action_log('disable', $this->conDb, implode(',', $ids), UID);
            $this->success(lang('Undook'), $this->jumpUrl);
        } else {
            $this->error(lang('Undoerror'), $this->jumpUrl);
        }
    }
    
    
    public function saveReportedType()
    {
    
    }

}