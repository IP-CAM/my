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
namespace app\cms\controller\admin;

use app\admin\controller\Admin;
use app\cms\model\Widgettype;
use app\cms\service\Widget as Widgetapi;

class Widget extends Admin
{
    
    /**
     * @Mark:首页
     * @Author: fancs
     * @Version 2017/6/16
     */
    public function index()
    {
        $index_map   = '';
        $this->conDb = 'Widget';
        
        $param       = $this->request->param();
        if (isset($param['name'])) {
            $index_where['name|title'] = array('like', '%' . (string)$param['name'] . '%');
        }
        
        $index_where["langid"]              = $this->index_where;
        
        $lists = Widgetapi::getlist($this->conDb, $index_map, $this->desc);
        $this->assign('list', $lists['list']);
        $this->assign('page', $lists['page']);
        $this->assign('_total', $lists['total']);
        $this->assign ("meta_title", lang('Homewidget'));
        return $this->fetch();
    }
    
    /**
     * @Mark:新增页面
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version now
     */
    public function add()
    {
        $type = Widgettype::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $this->assign('typelist',$type);
        $this->assign("data", null);
        $this->assign("meta_title", lang('Addnew') . lang('Homewidget'));
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:新增挂件类型
     * @return mixed|void
     * @Author: fancs
     * @Version 2017/6/19
     */
    public function add_type()
    {
        if($this->request->post()){
            $data['name']   = input('name');
            $data['status'] = input('status');
            $data['sort']   = input('sort');
            // 添加数据
            if ($object = Widgettype::create($data)) {
                $this->success(lang('Addnew_ok'), url('add'));
            } else {
                $this->error(lang('Addnew_fail'), url('add'));
            }
        }else{
            $this->assign("data", null);
            $this->assign("meta_title", lang('Addnew') . lang('Widgettype'));
            return $this->fetch('type');
        }
        
    }
    
    /**
     * @Mark:编辑页面
     * @return mixed
     * @Author: fancs
     * @Version 2017/6/19
     */
    public function edit()
    {
        $id = $this->request->has('ids') ? $this->request->param('ids') : $this->error(lang('Error_id'));
        $data = \app\cms\model\Widget::get($id);
        $type = Widgettype::all(function ($query) {
            $query->order('sort', 'desc');
        });
        $this->assign('typelist',$type);
        $this->assign('data',$data);
        $this->assign("meta_title", lang('Edit') . lang('Widget'));
        return $this->fetch();
    }
}