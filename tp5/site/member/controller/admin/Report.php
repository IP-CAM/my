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
// | Report.php  Version 2017/3/20 会员报表
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;
use app\member\service\Member;
use think\Db;

class Report extends Admin
{
    /**
     * @Mark:会员统计 & 排行
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/5/2
     */
    public function index()
    {
        //获取一周内每天用户注册数和充值额
        $data = Member::getWeekNum();
        
        //查询今日注册人数
        $day = ['reg_time' => ['>=', mktime(0, 0, 0, date('m'), date('d'), date('Y'))]];
        $dayNum = Member::getDayAccount($day);
        
        //查询本月注册人数
        $mouth = ['reg_time' => ['>=', mktime(0, 0, 0, date('m'), 1, date('Y'))]];
        $mouthNum = Member::getDayAccount($mouth);
        
        //查询总注册数
        $total = Member::getDayAccount();
        
        //本月会员活跃数
        $active = ['last_login_time' => ['>=', mktime(0, 0, 0, date('m'), 1, date('Y'))]];
        $mouthActive = Member::getDayAccount($active);
        
        
        $this->assign('meta_title', lang('rMember'));
        $this->assign('today', $dayNum);
        $this->assign('mouth', $mouthNum);
        $this->assign('total', $total);
        $this->assign('mouthActive', $mouthActive);
        $this->assign('data', $data);
        return $this->fetch();
    }
    
    /**
     * @Mark:
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    public function cash()
    {
        $index_map  = ['w.status' => 1];
        $param      = $this->request->param();
        $name       = isset($param['name']) ? trim($param['name']) : '';    //关键字
        $start_time = isset($param['start_time']) ? trim($param['start_time']) : ''; //时间开始
        $end_time   = isset($param['end_time']) ? trim($param['end_time']) : '';     //时间结束
        $status     = isset($param['status']) ? trim($param['status']) : '';
    
        $name ? $index_map[`a.` . 'username'] = ['like', '%' . $name . '%'] : '';
        
        if ($start_time && $end_time)
        {
            $index_map['create_time'] = ['between' => [$start_time, $end_time]];
        }
        
        $lists = Db::table('__MEMBER_WITHOUT__')
            ->alias('w')
            ->field('w.*,a.nickname,a.username,a.username,a.email')
            ->join('__MEMBER_ACCOUNT__ a', 'w.uid=a.id')
            ->where($index_map)
            ->paginate();
        
        $this->assign('list', $lists);
        $this->assign('page', $lists->render());
        $this->assign('_total', count($lists));
        $this->assign("status", $status);
        $this->assign('meta_title', lang('CW_Report'));
        return $this->fetch();
    }
}

