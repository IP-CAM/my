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
// | API基础类  Version 1.0 2017/1/22 对外提供数据
// +----------------------------------------------------------------------
namespace app\common\controller;

use think\Config;
use think\Request;
use think\Response;

class Api extends Home
{
    public $appid;
    public $appsecret;
    public $appip;
    
    /**
     * @Mark:初始化API基类
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/25
     */
    public function _initialize(){
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        parent::_initialize();
        
        //处理数据格式
        $postData = $this->request->param();
        $dataType = isset($postData['dataType']) ? $postData['dataType'] : 'json';
        switch (strtolower($dataType))
        {
            case 'json':    $type = 'json';     break;
            case 'xml':     $type = 'xml';      break;
            case 'jsonp':   $type = 'jsonp';    break;
        }
        Config::set('default_return_type', $type);  //设置默认返回格式；
        
        //!($this->request->isPost()) && $this->err_msg(lang('Request method error'), 10001);
	}
    
    /**
     * @Mark:空操作
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/22
     */
    public function _empty(Request $request)
    {
        $this->err_msg(lang('Request error'));
    }
    
    /**
     * @Mark:首页方法
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/25
     */
    public function index()
    {
        self::checkpost($this->request->param());  //检查POST过来的标准参数
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * 显示创建资源表单页.
     * @return \think\Response
     * Version 2017/1/22
     */
    public function create()
    {
        self::checkpost($this->request->param());  //检查POST过来的标准参数
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * 保存新建的资源
     * @param  \think\Request  $request
     * @return \think\Response
     * Version 2017/1/22
     */
    public function save(Request $request)
    {
        self::checkpost($this->request->param());  //检查POST过来的标准参数
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * 显示指定的资源
     * @param  int  $id
     * @return \think\Response
     * Version 2017/1/22
     */
    public function read($id)
    {
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * 显示编辑资源表单页
     * @param  int  $id
     * @return \think\Response
     * Version 2017/1/22
     */
    public function edit($id)
    {
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * 保存更新的资源
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     * Version 2017/1/22
     */
    public function update(Request $request, $id)
    {
        self::checkpost($this->request->param());  //检查POST过来的标准参数
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * 删除指定资源
     * @param  int  $id
     * @return \think\Response
     * Version 2017/1/22
     */
    public function delete($id)
    {
        self::checkpost($this->request->param());  //检查POST过来的标准参数
        $res = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        return $this->getResponseType()($res);
    }
    
    /**
     * @Mark:成功返回数据
     * @param $msg
     * @param array $data
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/9
     */
    protected function succ_msg($msg, array $data = [])
    {
        $type = $this->getResponseType();
        $data = ['response' => ["rsp" =>'succ', 'msg' =>$msg, 'code' => $code, 'data' =>$data]];
        throw new \think\exception\HttpResponseException($type($data));
    }
    
    /**
     * @Mark:返回失败信息
     * @param $msg
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/17
     */
    protected function err_msg($msg, $code = 10500) {
        $type = $this->getResponseType();
        $data = ['response' => ["rsp" =>'err', 'msg' =>$msg, 'code' => $code]];
        throw new \think\exception\HttpResponseException($type($data));
    }
    
    /**
     * @Mark:验证传入搂据
     * @param $postData
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/7/17
     */
    protected function checkpost($postData)
    {
        //来源检查
        if(!parent::checkurl()){
            $this->err_msg(lang('domain_not_permitted'), 10002);
        }
        
        $c_sign = ''; //签名串
        
        //有传IP说明是服务器与服务器之的通信
        if($postData['ip']){
            //超时
            if(time() - $postData['time'] > 10){
                $this->err_msg(lang('request_time_out'));
                //计算当前签名
                $c_sign = parent::sign($postData);
            }
        }else{
            //计算当前签名
            $c_sign = parent::sign($postData);
        }
        
        ($postData['sign'] !== $c_sign) && $this->err_msg(lang('signerr'));
        
        if(empty($postData['service'])) $this->err_msg(lang('method_not_found'));
        if(empty($postData['content'])) $this->err_msg(lang('Request data not found'));
        if(!self::getappconf($postData['appkey'], $postData['appsecret'])){
            $this->err_msg(lang('appkeyerr'));
        }
    }
    
    /**
     * @Mark:响应API请求
     * @Author: theseaer <theseaer@qq.com>
     * array(
     *   'service' => , 方法名
     *   'appkey'  => , appkey
     * 'appsecret' => , appsecret
     *   'time'    => , 服务器时间  服务器与服务器交互时需要
     *   'ip'      => , IP地址     服务器与服务器交互时需要
     *   'sign'    => '',签名
     *   'content' => '',请求内容
     * );
     * 数据需要json_encode
     * @Version 2016/5/16
     */
    /*public function response(){
        //校验传入的数据
        self::checkpost($_POST);

        //方法存在时
        $method_name = str_replace('.', '_', $_POST['service']);
        if(method_exists(get_class(), $method_name)){
            self::$method_name($_POST['content']);
        }else{
            $this->err_msg(lang('service_not_found'));
        }
    }*/
}
