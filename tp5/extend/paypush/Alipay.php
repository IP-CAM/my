<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// ----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 支付宝推送支付单接口  Version 2016/11/25
// +----------------------------------------------------------------------
namespace paypush;

use app\common\libs\Paypush;

class Alipay extends Paypush
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    public static function setup()
    {
        return array(
            'subjection'  => 'paypush',  //隶属
            'code'        => 'Alipay',    // 扩展器名称名
            'name'        => lang('Alipay_paypush'), // 扩展器名称翻译名
            'description' => lang('Alipay_paypush_desc'), // 扩展器名称翻译描述
            'official'    => 'http://www.alipay.com',               //官方
            'version'     => '1.0',                                 //版本
            'author'      => 'Runtuer',                             //作者
            'website'     => 'http://www.runtuer.com',              //出处
            'upgrade'     => '/cmfup/ver2.php',                       //升级位置
            //基本配置项
            'config'      => array(
                'pay_name'      => array(
                    'title'    => 'Pay name',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'parterid'      => array(
                    'title'    => 'Parter ID',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'key'           => array(
                    'title'    => 'Payment key',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'account'       => array(
                    'title'    => 'Pay account',
                    'type'     => 'string',
                    'validate' => 'required',
                ),
                'warehouse' => array(
                    'title'     => 'Storehouse',
                    'type'      => 'string',
                    'length'    => 260,
                    'tip'       => 'A001;B001;C001;D001',
                    'validate'  => 'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'     => array(
                'logo'        => 'alipay.png',
                'appofficial' => 'https://www.alipay.com/',         //官方
                'country'     => ['zh-cn'],   //适用国家
            ),
        
        );
    }
    
    /**
     * @Mark:获取提交地址
     * @return string Url提交地址
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/11
     */
    public function getSubmitUrl()
    {
        return "https://mapi.alipay.com/gateway.do";
    }
    
    /**
     * @Mark:除去数组中的空值和签名参数
     * @param $para 签名参数组
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
     */
    private function paraFilter($para)
    {
        $para_filter = array();
        foreach ($para as $key => $val) {
            if ($key == "sign" || $key == "sign_type" || $val == "") {
                continue;
            } else {
                $para_filter[$key] = $para[$key];
            }
        }
        return $para_filter;
    }
    
    /**
     * @Mark:对数组排序
     * @param $para
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
     */
    private function argSort($params)
    {
        ksort($params);
        reset($params);
        return $params;
    }
    
    /**
     * @Mark:生成签名结果
     * @param $sort_para
     * @param $key
     * @param string $sign_type
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
     */
    private function buildMysign($sort_para, $key)
    {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($sort_para);
        //把拼接后的字符串再与安全校验码直接连接起来
        $prestr = $prestr . $key;
        //把最终的字符串签名，获得签名结果
        $mysgin = md5($prestr);
        return $mysgin;
    }
    
    /**
     * @Mark:把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para
     * @return string
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/16
     */
    private function createLinkstring($params)
    {
        $str = "";
        foreach ($params as $key => $val) {
            $str .= $key . "=" . $val . "&";
        }
        
        //去掉最后一个&字符
        $str = trim($str, '&');
        
        //如果存在转义字符，那么去掉转义
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        
        return $str;
    }
    
    /**
     * @Mark:推送支付单报文信息
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/16
     */
    public function doPush($sendData)
    {
        //获取配置参数
        $info   = self::setup();
        $where  = ['code' => $info['code'], 'subjection' => $info['subjection']];
        $config = self::config($where);
        
        //构造要请求的参数数组，无需改动
        $pushData = array(
            //************固定参数 start****************
            "service"        => 'alipay.acquire.customs',
            "partner"        => $config['parterid'] ? $config['parterid'] : $sendData['parterid'],
            "_input_charset" => 'utf-8',
            "sign_type"      => "MD5",
            //************固定参数 end****************
            
            'out_request_no'        => '', //报关流水号
            'trade_no'              => '', //支付宝交易号
            'merchant_customs_code' => '', //商户海关备案编号
            'amount'                => '', //报关金额
            'customs_place'         => '', //海关编号  https://doc.open.alipay.com/docs/doc.htm?spm=a219a.7629140.0.0.IQ2kZ7&treeId=155&articleId=104778&docType=1#s5
            'merchant_customs_name' => '', //商户海关备案名称
            'is_split'              => '', //是否拆单  可空
        );
        
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($pushData);
        
        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);
        
        //生成签名结果
        $mysign = $this->buildMysign($para_sort, $config['key'] ? $config['key'] : $sendData['key']);
        
        //签名结果与签名方式加入请求提交参数组中
        $pushData['sign'] = $mysign;
        
        $res = self::post($this->getSubmitUrl(), $pushData);
        
        //TODO 后继结果处理
    }
    
    /**
     * @Mark:查询推送的支付单
     * @param $sendData
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/10/16
     */
    public function doQuery($sendData)
    {
        // TODO: Implement doQuery() method.
    }
}