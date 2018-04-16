<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Comment.php  Version 2017/6/28 评论API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Comment extends Service
{
    /**
     * @Mark：查询用户评论记录
     * @param $data [
     *          'name'        =>'fancs'       //用户名或id
     *          'comment_type'=>1             //评论类型：0商品 1文章
     * ]
     * @return mixed|string
     * @author Fancs
     * @version 2017/5/18
     */
    static public function get_comment(&$data)
    {
        //检查用户ID对应的应用是否存在或者状态是否正常
        $info = Member::getUserInfo($data);
        if(!$info) return json(['code' => 0, 'msg' => lang('Account is exits or enable')]);
        unset($data['name']);
        $data['uid'] = $info['id'];
        $comment = \app\member\model\Comment::all($data);
        
        if(empty($comment)){
            return json(['code' => 0, 'msg' => lang('Can`t find this user comment')]);
        }
        return $comment;
    }
    
    /**
     * @Mark:添加提现记录
     * @param $data = [
     *      'uid'           =>  3                   //用户id/手机号/邮箱/用户名
     *      'id_value'      =>  100                 //文章或者商品的id,文章对应的是article的article_id;商品对应的是goods的goods_id
     *      'comment_type'  =>  0                   //收藏类型：0商品 1文章
     *      'content'       =>  'content'           //评论内容
     *      'comment_rank'  =>  3                   //该文章或者商品的重星级;1好评，2中评，3差评
     * ]
     * @return bool|\think\response\Json
     * @Author: fancs
     * @Version 2017/6/28
     */
    static public function add_comment(&$data)
    {
        $class = \think\Loader::parseClass(MODULE_NAME, 'validate', 'Comment', false);
        //存在验证器刚执行
        if (class_exists($class)) {
            $validate =  \think\Loader::validate($class);
            $result =   $validate->check($data);
            if(!$result){
                return json(['code' => 0, 'msg' => $validate->getError()]);
            }
        }
        
        if($res = \app\member\model\Comment::create($data)){
            return true;
        }
        return false;
        
    }
}