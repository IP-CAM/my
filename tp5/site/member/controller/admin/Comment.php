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
// | Comment  Version 1.0  2016/3/13 商品评论
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\service\Comment as Commentapi;

class Comment extends Admin
{
    /**
     * @Mark:
     * @Author: Fancs
     * @Version 2017/5/19
     */
    public function index()
    {
        $this->conDb    = 'GoodsComment';
        $index_map      = '';
        $params         = $this->request->param();
        $score          = isset($params['score']) ? $params['score'] : '';
        //按用户查询
        if(isset($params['name']))
        {
            $user = \app\member\service\Member::getUserInfo($params['name']);//获取登陆类型
            $index_map['uid'] = $user['id'];
        }
        
        switch ($score){
            case 1:
                $index_map['score'] = 1;
                break;
            case 2:
                $index_map['score'] = ['in',[2,3]];
                break;
            case 4:
                $index_map['score'] = ['>=',4];
                break;
            default :
                $index_map['score'] = ['>',0];
                break;
        }
        
        //按时间查询
        isset($params['start_time']) ? $index_map['create_time'] = ['>=', strtotime(trim($params['start_time']))] : '';
        isset($params['end_time']) ? $index_map['create_time'] = ['>=', strtotime(trim($params['end_time']))] : '';
        
        $lists = Commentapi::getlist($this->conDb, $index_map, $this->desc);//dump($lists);exit();
        $this->assign('list',  $lists['list']);
        $this->assign('page',  $lists['page']);
        $this->assign('_total',  $lists['total']);
        $this->assign ("meta_title", lang($this->conDb));
        $this->assign('score', $score);
        return $this->fetch();
    }
}