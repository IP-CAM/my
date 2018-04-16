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
// | Report.php  Version 1.0  2016/3/13 报表
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Admin;

class Report extends Admin
{
    /**
     * @Mark:Reportbbcg
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->assign("meta_title", lang('Reportbbcg'));
        return $this->fetch();
    }
    
    /**
     * @Mark:商品销售数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/11
     */
    public function goods()
    {
        $this->assign("meta_title", lang('Reportgoods'));
        return $this->fetch();
    }
    
    /**
     * @Mark:交易数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/11
     */
    public function order()
    {
        $this->assign("meta_title", lang('Reportorder'));
        return $this->fetch();
    }
    
    /**
     * @Mark:店铺经营数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/11
     */
    public function shop()
    {
        $this->assign("meta_title", lang('Reportshop'));
        return $this->fetch();
    }
    
}
