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
// | 扩展基类  Version 2016/12/30
// +----------------------------------------------------------------------
namespace app\common\libs;

use app\admin\model\Extend as Ext;

abstract class Baseexted
{
    static protected $openApiUrl = 'http://www.runtuer.com/openapi/index/index';  //官方API中心
    /**
     * @Mark:扩展、插件配置说明
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/11
     */
     abstract static public function setup();
    
    /**
     * @Mark:获取当前扩展配置数据
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/13
     */
    static final public function config($map)
    {
        $where  = ['code' => $map['code'], 'subjection' => $map['subjection']];
        $data   = Ext::where($where)->value('config');
        return unserialize($data);
    }
    
    /**
     * @Mark:模拟post进行url请求
     * @param string $post_data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/12/27
     */
    static public function post($url, &$data, $post = true, $type = ''){
        $param = '';
        foreach ($data as $k=>$v){
            if(strtolower($type) == 'json')
            {
                $param.= "$k=".str_replace(PHP_EOL,'',$v)."&" ;
            }else{
                $param.= "$k=".urlencode( $v )."&" ;
            }
        }
        $param = substr($param,0,-1);
        
        try {
            $url .= strpos($url, '?') ? '&' : '?';
            $ch   = curl_init();//初始化curl
            $ssl  = substr($url, 0, 8) == "https://" ? TRUE : FALSE;
            if ($ssl){
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            }
            curl_setopt($ch, CURLOPT_POST, $post ? 1 : 0);//提交方式1post,0get
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
            curl_setopt($ch, CURLOPT_URL,$url);//抓取指定网页
            curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $res = curl_exec($ch);//运行curl
            curl_close($ch);
            
            return $res;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}