<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Download.php  Version 2017/8/22
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\common\controller\Home;

class Down extends Home
{
    /**
     * @Mark:下载首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function index()
    {
        $this->assign('meta_title', lang('Article cat'));
        return $this->fetch();
    }
    
    /**
     * @Mark:下载实现
     * @return \think\response\Json
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function get()
    {
        $input = $this->request->param();
        $id    = isset($input['id']) ? $input['id'] : '';
        if (empty($id)) return json(['code' => 0, 'msg' => lang('Errorid')]);
    }
}
