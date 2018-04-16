<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | Category.php  Version 2017/7/17
// +----------------------------------------------------------------------

namespace app\seller\controller;

use app\seller\model\GoodsCategory as GoodsCategoryModel;
use app\crossbbcg\service\Goods as GoodsApi;
use app\seller\service\Category as GoodsCategoryApi;
use app\crossbbcg\model\Category as CategoryModel;
use think\Request;
use think\Session;

class Category extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        //顶级分类
        $category = GoodsCategoryModel::where(['seller_id' => session('sellerId'), 'pid' => 0, 'langid' => LANG])->select();
        $this->assign('category', $category);
    }
    
    /**
     * @Mark:分类列表
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    public function index()
    {
        $seller_id = session('sellerId');
        $where = [
            'where'     =>  [
                'seller_id' => $seller_id,
                'langid' => LANG
            ],
            'order'     =>  ['sort desc']
            
        ];
        $arr = GoodsCategoryApi::categoryList($where);
        
        $this->assign('list', $arr);
        $this->assign('meta_title',lang('GoodsCategory'));
        return $this->fetch();
    }
    
    /**
     * @Mark:添加分类
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    public function add()
    {
        $this->assign('action_name', 'add');
        $this->assign('data', null);
        return $this->fetch('edit');
    }
    
    /**
     * @Mark:编辑分类
     * @return mixed
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    public function edit()
    {
        $id = input('id');
        $data = GoodsCategoryModel::get($id);
        $this->assign('data', $data);
        return $this->fetch();
    }
    
    /**
     * @Mark:数据入库
     * @return bool|\think\response\Json
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    public function savedata()
    {
        $data = $this->request->param();
        if (isset($data['id'])) {
            $res = GoodsCategoryApi::editCategory($data);
        } else {
            $data['seller_id'] = \think\Session::get('sellerId');
            $res = GoodsCategoryApi::addCategory($data);
        }
        
        if ($res['code'] == 1) {
            $log_info = '编辑分类，分类名:'.$data['name'].'。操作人：'.session('sellername');
            seller_log(session('sellerId'),session('userid'),$log_info);
            $this->success(lang('success'), 'index');
        } else {
            return json($res);
        }
    }
    
    /**
     * @Mark:绑定商品
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/17
     */
    public function bind()
    {
        $param = $this->request->param();
        $this->assign("catlist", sortdata(CategoryModel::all()));
        $id = $param['id'];
        $where = [
            'where' => ['seller_id' => SellerId, 'status' => ['<>', 'recycle']],
            'lang' => $this->lang,
            'field' => ['id', 'name','thumb'],
            'paginate'=>'10',
        ];
        //商品筛选
        if (isset($param['cat_id']) && $param['cat_id'] <> 'all') $where['category_id'] = $param['cat_id'];
        if (isset($param['key_words'])) $where['where'][$param['condition']] = ['like','%'.$param['key_words'].'%'];
        $data = GoodsApi::getGoods($where);
        $bind_info = GoodsCategoryModel::get($id);
        if ($this->request->isAjax()) {
            $html = '';
            foreach ($data as $v){
                $html .='<tr>';
                $html .='<td><input type="checkbox" class="ids" value="'.$v['id'].'" name="ids[]"';
                if (in_array($v['id'],$param['ids'])) {
                    $html .= 'checked';
                }
                $html .= "></td>";
                $html .='<td>'.$v['id'].'</td>';
                $html .='<td>';
                if (empty($v['thumb'])){
                    $html .='<img src="__PUBLIC__/admin/images/up_thumb.png" alt="user" class="img-circle" width="50">';
                } else if(substr($v['thumb'],0,4)=='http'){
                    $html .='<img src="'.$v['thumb'].'" alt="user" class="img-circle" width="50">';
                } else {
                    $html .='<img src="'.resizeImage($v['thumb'],'thumb',true).'" alt="user" class="img-circle" width="50">';
                }
                $html .=$v['name'].'</td>';
                $html .="</tr>\n";
            }
            if ($html) {
                unset($param['ids']);
                return json(['code'=>1,'data'=>$html,'page'=>$data->appends($param)->render()]);
            } else {
                return json(['code'=>0,'msg'=>0]);
            }
        }
        $this->assign('list', $data);
        $this->assign('id',$id);
        $this->assign('bind_info', $bind_info);
        return $this->fetch();
    }
    
    /**
     * @Mark:绑定商品入库
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/18
     */
    public function save_bind()
    {
        $param = $this->request->param();
        $data = [
            'id' => $param['id'],
            'goods_ids' => $param['goods_ids']
        ];
        GoodsCategoryApi::bindGoods($data);
            $log_info = '店铺分类绑定商品，分类ID:'.$param['id'].'，商品id:'.$param['goods_ids'].'。操作人：'.Session::get('sellername');
        seller_log(SellerId,Session::get('userid'),$log_info);
        $this->success(lang('success'), 'index');
    }
    
    /**
     * @Mark:删除分类
     * @Author: yang <502204678@qq.com>
     * @Version 2017/7/18
     */
    public function del()
    {
        $id = input('id');
        $re = GoodsCategoryApi::delCategory($id);
        if ($re['code'] == 1) {
            $log_info = '删除店铺分类，分类id:'.$id.'。操作人：'.Session::get('sellername');
            seller_log(SellerId,Session::get('userid'),$log_info);
            $this->success(lang('success'), 'index');
        } else {
            return json($re);
        }
    }
}
