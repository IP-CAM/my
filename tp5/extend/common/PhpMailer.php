<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: yang <502204678@qq.com>
// +----------------------------------------------------------------------
// | PhpMailer.php  Version 2017/8/19
// +----------------------------------------------------------------------

namespace common;

use common\PhpMailer\PHPMailer as PHPMailerAPI;
use think\Config;

class PhpMailer
{
    /**
     * @Mark:
     * @param $data = [
     *      'to_email'      =>  '123456@qq.com' 收件人邮箱
     *      'content'       =>  '1233'          邮件内容
     *      'subject'       =>  '标题'           邮件主题(可选)
     *      'AddAttachment' =>  'f:/test.png'   邮件附件地址(可选)
     * ]
     * @Author: yang <502204678@qq.com>
     * @Version 2017/8/21
     * @return array
     */
    static public function send($data)
    {
        //获取系统邮件配置
        $config = Config::get()['kernel'];
        try {
            $mail = new PHPMailerAPI(true);
            if ($config['sendtype'] == 0) {
                $mail->IsSMTP();
            } else {
                $mail->IsMail();
            }
            $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
            $mail->SMTPAuth = true; //开启认证
            $mail->Port = (int)$config['emailport'];//端口号
            $mail->Host = $config['smtpaddr'];//邮件服务器地址
            $mail->Username = $config['emailusername'];//用户名
            $mail->SMTPSecure = strtolower($config['emailsafe']); // 使用安全协议
            $mail->Password = $config['emailpwd'];//"jgszxdxnrguybiii";密码
            //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could not execute: /var/qmail/bin/sendmail ”的错误提示
            $mail->AddReplyTo($config['sendaddr'],$config['emailusername']);//回复地址
            $mail->From = $config['sendaddr'];//发送人邮箱
            $mail->FromName = $config['emailusername'];//发件人名称
            $mail->AddAddress($data['to_email']);//收件人
            $mail->Subject = isset($data['subject'])?$data['subject']:'无主题';
            $mail->Body = $data['content'];
            $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
            $mail->WordWrap = 80; // 设置每行字符串的长度
            if (isset($data['AddAttachment'])) {
                $mail->AddAttachment($data['AddAttachment']); //可以添加附件
            }
            $mail->IsHTML(true);
            $mail->Send();
            return ['code'=>1,'msg'=>lang('test email send success')];
        } catch (\common\PhpMailer\phpmailerException $e) {
            return ['code'=>0,'msg'=>lang('test email send fail').','.lang('fail info').$e->errorMessage()];
        }
    }
    
}