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
// | 快递鸟查询接口  Version 2016/7/23
// +----------------------------------------------------------------------
namespace expresss;

use app\common\libs\Express;

class Kdn extends Express
{
    /**
     * @Mark:扩展配置信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/9/15
     */
    static public function setup(){
        return array(
            'subjection'    => 'expresss',    //隶属
            'code'          => 'Kdn',     // 扩展器名称名
            'name'          => lang('Kdn_express'), // 扩展器名称翻译名
            'description'   => lang('Kdn_express_desc'), // 扩展器名称翻译描述
            'version'       => '1.0',                    //版本
            'author'        => 'Runtuer',                //作者
            'website'       => 'http://www.runtuer.com', //出处
            'upgrade'     => '/cmfup/ver2.php',            //升级位置
            //基本配置项
            'config'        => array(
                'app_id'        => array(
                    'title'     =>'EBusinessID',
                    'type'      =>'string',
                    'validate'  =>'required',
                ),
                'app_key'        => array(
                    'title'     =>'AppKey',
                    'type'      =>'string',
                    'validate'  =>'required',
                ),
            ),
            //特殊配置项目，可自行定义
            'special'       => array(
                'logo'      => 'kdn.png',
                'appofficial'  => 'http://www.kdniao.com/', //官方
            ),
        );
    }
    
    /**
     * @Mark:获取快递结果
     * @param $data
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/12
     */
    public function response(&$data)
    {
        $shipping_no = $data['shipping_no']; // 快递单号
        $shipping_company = $data['shipping_company']; // 快递公司名称
        // 是否支持查询的快递公司
        $shipper_code = $this->getShipperCode();
        $key = array_search($shipping_company,$shipper_code);
        if($key === false){
            // 不支持当前物流公司的查询
            return ['code'=>0,'msg'=>lang('express_company_error'),'data'=>''];
        }
        $filter_data = array(
            'ShipperCode' =>$key,
            'LogisticCode' => $shipping_no
        );
        $traces = $this->getOrderTracesByJson($filter_data); // 获取物流信息
        $traces = json_decode($traces,true); // 转为数组
        
        // 获取失败
        if(!$traces['Success']){
            return ['code'=>0,'msg'=>$traces['Reason'],'data'=>''];
        }
        $result = [];
        // 物流状态: 0-无轨迹 2-在途中，3-签收,4-问题件
        if($traces['State'] == 0){
            $result = ['code'=>0,'msg'=>lang('express_status_0'),'data'=>''];
        }
        if($traces['State'] == 2){
            $tracking = [];
            foreach($traces['Traces'] as $key=>$arr){
                $tracking[$key]['time'] = $arr['AcceptTime'];
                $tracking[$key]['station'] = $arr['AcceptStation'];
            }
            $result = ['code'=>1,'msg'=>lang('express_status_2'),'data'=>$tracking];
        }
        if($traces['State'] == 3){
            $tracking = [];
            foreach($traces['Traces'] as $key=>$arr){
                $tracking[$key]['time'] = $arr['AcceptTime'];
                $tracking[$key]['station'] = $arr['AcceptStation'];
            }
            $result = ['code'=>1,'msg'=>lang('express_status_3'),'data'=>$tracking];
        }
        if($traces['State'] == 4){
            $result = ['code'=>0,'msg'=>lang('express_status_4'),'data'=>''];
        }
        
        
        return $result;
        
    }
    
    /**
     * @Mark: 查询物流轨迹
     * @param array $data = [
     * 'ShipperCode' => 快递公司编码
     * 'LogisticCode' => 物流单号
     * ]
     * @return string json格式
     * 返回参数定义：
    参数名称	类型	说明	必须要求
    EBusinessID	String	用户ID	R
    OrderCode	String	订单编号	O
    ShipperCode	String	快递公司编码	R
    LogisticCode	String	物流运单号	O
    Success	Bool	成功与否	R
    Reason	String	失败原因	O
    State	String	物流状态：2-在途中,3-签收,4-问题件	R
    Traces
    AcceptTime	String	时间	R
    AcceptStation	String	描述	R
    Remark	String	备注	O
     * @Author: WangHuaLong
     */
    private function getOrderTracesByJson($data){
        // 获取默认配置
        $config = self::config(self::setup());
        /*
        OrderCode	String	订单编号	O
        ShipperCode	String	快递公司编码	R
        LogisticCode	String	物流单号	R
        */
        $requestData= "{'OrderCode':'','ShipperCode':'".$data['ShipperCode']."','LogisticCode':'".$data['LogisticCode']."'}";
        
        // 请求地址
        $ReqURL = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
    
        $datas = array(
            'EBusinessID' => $config['app_id'],
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $config['app_key']);
        $result= $this->sendPost($ReqURL, $datas);
    
        //根据公司业务处理返回的信息......
    
        return $result;
    }
    
    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return string json url响应返回的html
     */
    private function sendPost($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);
        
        return $gets;
    }
    
    /**
     * @Mark: 电商Sign签名生成
     * @param $data  string 内容
     * @param $appkey  string AppKey
     * @return string DataSign签名
     * @Author: WangHuaLong
     */
    private function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }
    
    /**
     * @Mark: 快递鸟的快递公司编码
     * @return array
     * @Author: WangHuaLong
     */
    private function getShipperCode(){
        
        /* 转移到bcwareexp/extra/express
         * $express_company_code = array(
            'AJ'=>'安捷快递',
            'ANE'=>'安能物流',
            'AXD'=>'安信达快递',
            'BQXHM'=>'北青小红帽',
            'BFDF'=>'百福东方',
            'BTWL'=>'百世汇通快递',
            'CCES'=>'CCES快递',
            'CITY100'=>'城市100',
            'COE'=>'COE东方快递',
            'CSCY'=>'长沙创一',
            'CDSTKY'=>'成都善途速运',
            'DBL'=>'德邦',
            'DSWL'=>'D速物流',
            'DTWL'=>'大田物流',
            'EMS'=>'EMS',
            'FAST'=>'快捷速递',
            'FEDEX'=>'FEDEX联邦(国内件)',
            'FEDEX_GJ'=>'FEDEX联邦(国际件)',
            'FKD'=>'飞康达',
            'GDEMS'=>'广东邮政',
            'GSD'=>'共速达',
            'GTO'=>'国通快递',
            'GTSD'=>'高铁速递',
            'HFWL'=>'汇丰物流',
            'HHTT'=>'天天快递',
            'HLWL'=>'恒路物流',
            'HOAU'=>'天地华宇',
            'hq568'=>'华强物流',
            'HTKY'=>'百世快递',
            'HXLWL'=>'华夏龙物流',
            'HYLSD'=>'好来运快递',
            'JGSD'=>'京广速递',
            'JIUYE'=>'九曳供应链',
            'JJKY'=>'佳吉快运',
            'JLDT'=>'嘉里物流',
            'JTKD'=>'捷特快递',
            'JXD'=>'急先达',
            'JYKD'=>'晋越快递',
            'JYM'=>'加运美',
            'JYWL'=>'佳怡物流',
            'KYWL'=>'跨越物流',
            'LB'=>'龙邦快递',
            'LHT'=>'联昊通速递',
            'MHKD'=>'民航快递',
            'MLWL'=>'明亮物流',
            'NEDA'=>'能达速递',
            'PADTF'=>'平安达腾飞快递',
            'QCKD'=>'全晨快递',
            'QFKD'=>'全峰快递',
            'QRT'=>'全日通快递',
            'RFD'=>'如风达',
            'SAD'=>'赛澳递',
            'SAWL'=>'圣安物流',
            'SBWL'=>'盛邦物流',
            'SDWL'=>'上大物流',
            'SF'=>'顺丰速运',
            'SFWL'=>'盛丰物流',
            'SHWL'=>'盛辉物流',
            'ST'=>'速通物流',
            'STO'=>'申通快递',
            'STWL'=>'速腾快递',
            'SURE'=>'速尔快递',
            'TSSTO'=>'唐山申通',
            'UAPEX'=>'全一快递',
            'UC'=>'优速快递',
            'WJWL'=>'万家物流',
            'WXWL'=>'万象物流',
            'XBWL'=>'新邦物流',
            'XFEX'=>'信丰快递',
            'XYT'=>'希优特',
            'XJ'=>'新杰物流',
            'YADEX'=>'源安达快递',
            'YCWL'=>'远成物流',
            'YD'=>'韵达快递',
            'YDH'=>'义达国际物流',
            'YFEX'=>'越丰物流',
            'YFHEX'=>'原飞航物流',
            'YFSD'=>'亚风快递',
            'YTKD'=>'运通快递',
            'YTO'=>'圆通速递',
            'YXKD'=>'亿翔快递',
            'YZPY'=>'邮政平邮/小包',
            'ZENY'=>'增益快递',
            'ZHQKD'=>'汇强快递',
            'ZJS'=>'宅急送',
            'ZTE'=>'众通快递',
            'ZTKY'=>'中铁快运',
            'ZTO'=>'中通速递',
            'ZTWL'=>'中铁物流',
            'ZYWL'=>'中邮物流',
            'AMAZON'=>'亚马逊物流',
            'SUBIDA'=>'速必达物流',
            'RFEX'=>'顺丰快递',
            'QUICK'=>'快客快递',
            'CJKD'=>'城际快递',
            'CNPEX'=>'CNPEX中邮快递',
            'HOTSCM'=>'鸿桥供应链',
            'HPTEX'=>'海派通物流公司',
            'AYCA'=>'澳邮专线',
            'PANEX'=>'泛捷快递',
            'PCA'=>'PCA Express',
            'UEQ'=>'UEQ Express'
        );*/
    
        $express_company_code = get_config('bcwareexp','express');
        return $express_company_code;
    }
    
    
}