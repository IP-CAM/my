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
// | 订单处理任务  Version 2016/12/9
// +----------------------------------------------------------------------
namespace app\order\libs;

use think\queue\Job;

class Task
{
    /**
     * @Mark:新增订单
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderCrate(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:订单取消任务
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderCancel(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:修改运费，编辑订单金额
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderEditPrice(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:订单付款完成
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderPay(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:发货完成
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderDelivery(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:确认收货
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderConfirm(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:订单关闭
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderClose(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:订单退款
     * @param Job $job
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function orderRefund(Job $job, $data)
    {
        
    }
    
    /**
     * @Mark:执行失败时
     * @param $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/9
     */
    public function failed($data)
    {
        
    }
}