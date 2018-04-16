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
// | Organization.php  Version 2017/2/16
// +----------------------------------------------------------------------
namespace app\surrogacy\controller;

use app\common\controller\Home;

class Organization extends Home
{
    
    /**
     * @Mark:合作机构封面
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function index()
    {
        return $this->fetch();
    }
    
    /**
     * @Mark:加入及合作
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/16
     */
    public function join()
    {
        if($this->request->isPost())
        {
            
        }else{
            return $this->fetch();
        }
    }
    
}