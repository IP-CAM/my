<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Logs.php  Version 2017/3/27
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Db;
use app\admin\service\Role as Roleapi;
use app\admin\service\Action as Actionapi;
use app\admin\service\ActionLog as ActionLogapi;

class Logs extends Admin
{
    /**
     * @Mark:管理操作日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/21
     */
    public function index()
    {
        //初始化
        $params = $this->request->param();
        $map['status'] = array('eq', 1);
        $role = Roleapi::getlist('Role', $map, '', 'id, pid, name, alias');
        $this->assign('role', $role['list'] ? sortdata($role['list']) : null);
        $this->assign('ids', isset($params['ids']) ? $params['ids'] : 1);
    
        //条件
        $this->index_where = '';
        $index_map = '';
        isset($param['name']) ? $index_map['remark|action_ip|model'] = ['like','%'.trim($param['name']).'%'] : '';
    
        $lists = ActionApi::getlist('ActionLog', $index_map, $this->desc);
        //赋值
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign("meta_title", lang('Managerlog'));
        return $this->fetch();
    }
    
    
    /**
     * @Mark:行为日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/23
     */
    public function actionlog()
    {
        $params = $this->request->param();
        //行为类别
        $action = ActionApi::getlist('Action');
        
        
        //过滤数据
        $index_map = [];
         if (isset($params['aid']))  $index_map['action_id'] = $params['aid'] ;
        
        $lists = ActionLogApi::getlist('ActionLog', $index_map, $this->desc);
        $this->assign("meta_title", lang('Actionlog'));
        $this->assign("list", $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign('aid', isset($index_map['action_id'])?$index_map['action_id']:null);
        $this->assign('action', $action['list']);
        
        return $this->fetch();
    }
    
    /**
     * @Mark:API日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/22
     */
    public function apilog(){
        $this->assign ("meta_title", lang('Apilog'));
        $this->assign('item', input('item'));
        return $this->fetch();
    }
    
    /**
     * @Mark:查看行为日志
     * @param int $ids
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    public function view($ids = 0){
        empty($ids) && $this->error(lang('Error_id'));
        $info = \app\admin\model\ActionLog::get($ids);
        $this->assign('info', $info);
        $this->meta_title = lang('Viewactionlog');
        return $this->fetch();
    }
    
    /**
     * @Mark:删除或者 清空
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    public function clear()
    {
        $param          = $this->request->param();
        $map['model']   = 'ActionLog';
        if(isset($param['ids']))
        {
            $map['id']   = ['in', (array)$param['ids']];
            $action      = lang('Delete');
        }else{
            $map['id']  = ['neq', ''];
            $action     = lang('Clear');
        }
    
        //执行API
        $status = ActionLogapi::del($map);
    
        if ($status!==false) {
            $this->success($action. 'Ok');
        } else {
            $this->error($action. 'Fail');
        }
    }
}