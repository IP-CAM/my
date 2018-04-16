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
// | 首页控制器  Version 2016/12/25
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller;

use app\cms\model\Article as ArticleModel;
use app\cms\model\Articlecat as ArticlecatModel;
use think\Request;

class Help extends Shopbase
{
    /**
     * @Mark:帮助中心首页
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/10
     */
    public function index()
    {
        $id = $this->request->get('id');
        //文章详情
        $info = ArticleModel::get($id);
        $this->assign('data', $info);
        $this->assign('mata_title',$info['title']);
    
        $param = ['show_in_nav' => 1, 'pid' => 0];
        $list = ArticlecatModel::where($param)->order('sort asc')->select()->toArray();
        foreach ($list as $k=>$v) {
            $param['pid']=$v['id'];
            $list[$k]['category']=ArticlecatModel::where($param)->order('sort asc')->select()->toArray();
            foreach ($list[$k]['category'] as $kk=>$vv) {
                if ($info['category_id'] == $vv['id']) $category_title = $v['title'];
                $list[$k]['category'][$kk]['article']=ArticleModel::where(['category_id'=>$vv['id'],'is_review'=>1])->order('sort asc')->select()->toArray();
            }
        }
        $this->assign('list',$list);
        $this->assign('category_title',isset($category_title)?$category_title:'');
        return $this->fetch();
    }
}
