<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Fancs
// +----------------------------------------------------------------------
// | Question.php  Version 2017/7/6 密保问题API
// +----------------------------------------------------------------------
namespace app\member\service;

use app\admin\service\Service;

class Question extends Service
{
    /**
     * @Mark:获取密保问题
     * @param $num = 1
     * @Author: fancs
     * @Version 2017/7/6
     */
    static public function get_question($num)
    {
        $question = \app\member\model\Question::all(function ($query) use ($num){
            $query->where(['num'=>$num,'langid'=>LANG]);
        });
        if(empty($question)) return false;
        return $question;
    }
}