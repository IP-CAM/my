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
// | Payment.php Version 1.0  2016/3/13 支付方式
// +----------------------------------------------------------------------
namespace app\crossbbcg\controller\admin;

use app\admin\controller\Setting;
use app\admin\model\Extend as Ext;

class Payment extends Setting
{
    
    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/9
     */
    public function index()
    {
        $this->assign('seapays', $this->getExtByGroup('seapays'));
        $this->assign('payments', $this->getExtByGroup('payments'));
        $this->assign("meta_title", lang('Payment'));
        return $this->fetch();
    }
    
    /**
     * @Mark:
     * @param $group
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/7
     */
    public function getExtByGroup($group)
    {
        $extlist = $tmp_array = $currDir = array();
        $list    = Ext::where('is_del', '=', '')->order('sort asc')->select();
        
        foreach ($list as $ext) {
            $ext['uninstall']                                 = 0;
            $ext[$ext['subjection'] . '_' . $ext['code']]     = $ext['status'];
            $extlist[$ext['subjection'] . '_' . $ext['code']] = $ext;
        }
        
        $currDir = glob(EXTEND_PATH . $group . '/*.php');
        foreach ($currDir as $ck => $file) {
            $f           = basename($file);
            $classname   = substr($f, 0, strrpos($f, '.'));
            $extClass    = "\\$group\\$classname";
            $tmp_array[] = $extClass::setup();
        }
        
        foreach ($tmp_array as $ks => $value) {
            
            $tmp_array[$ks]['subjection'] = strtolower($value['subjection']);
            $tmp_array[$ks]['uninstall']  = 0;
            $tmp_array[$ks]['lastver']    = '';
            $tmp_array[$ks]['status']     = 0;
            $tmp_array[$ks]['isshow']     = 0;
            //是否安装
            
            if (!empty($extlist[$value['subjection'] . '_' . $value['code']])) {
                
                $issubjection = $extlist[$value['subjection'] . '_' . $value['code']]['subjection'] == $value['subjection'];
                
                $iscode = $extlist[$value['subjection'] . '_' . $value['code']]['code'] == $value['code'];
                
                if ($issubjection && $iscode) {
                    
                    $tmp_array[$ks]['id'] = $extlist[$value['subjection'] . '_' . $value['code']]['id'];
                    //状态
                    $tmp_array[$ks]['status']    = $extlist[$value['subjection'] . '_' . $value['code']][$value['subjection'] . '_' . $value['code']];
                    $tmp_array[$ks]['isshow']    = $extlist[$value['subjection'] . '_' . $value['code']]['isshow'];
                    $tmp_array[$ks]['uninstall'] = 1;
                    $tmp_array[$ks]['sort']      = $extlist[$value['subjection'] . '_' . $value['code']]['sort'];
                }
            }
            
            //是否允许卸载
            $tmp_array[$ks]['allow_uninstall'] = empty($extlist[$value['code']]) ? 1 : $extlist[$value['code']]['allow_uninstall'];
        }
        
        return $tmp_array;
    }
    
}
