<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Index.php  Version 2017/8/22 首页
// +----------------------------------------------------------------------
namespace app\index\controller;

use think\Request;
use app\common\controller\Home;

class Article extends Home
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/8/23
     */
    public function _empty(Request $request)
    {
        return $this->fetch(ACTION_NAME);
    }
    
    /**
     * @Mark:文章分类
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/29
     */
    public function cat()
    {
        $this->assign('meta_title', lang('Article cat'));
        return $this->fetch();
    }
    
    public function view()
    {
        $input = $this->request->param();
        $id    = isset($input['id']) ? $input['id'] : '';
        if (empty($id)) return json(['code' => 0, 'msg' => lang('Errorid')]);
        //查询文章内容数据
    }
}