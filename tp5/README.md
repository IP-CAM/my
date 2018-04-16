系统要求：PHP5.4及以上，MySql5.5以上，InooDb，服务器必须支持redis 或者 memcache 或者 mongodb
服务器要求有redis 或者 memcache

behavior 行为  模块行为定义
controller 控制器
    admin  管理员控制器
    api API控制器
    wechat wap及微信端控制器
    Error.php PC端出错提示
    Index.php PC端模块首页
crontab 定时任务  定时任务
    每个任务为一个文件，文件中有详细的任务配置参数
lang 语言包
    可以开启OR关闭是否自动生成语言列表
libs 私有类库
    定义本模块用到的类库
model 模型
schema 数据库描述文件
    一个文件为一个表，须有详细说明
view 视图
widget 挂件/插件
    文件夹形式，可以被任意调用；

common.php
config.php 模块私有配置参数
setting.php 模块描述及设置信息
tags.php  行为定义文件


composer包说明
endroid/qrcode 二维码工具
mobiledetect/mobiledetectlib  针对各种平台判断
os/php-excel execel导出，导出工具
lilwil/geetest  强化的验证码安全工具  http://www.thinkphp.cn/extend/823.html
overtrue/wechat 微信SDK
phpdocumentor/reflection-docblock API说明生成器
phpmailer/phpmailer Mail管理工具
symfony/options-resolver
topthink/think-angular Thinkphp版Angular模板
topthink/think-captcha Thinkphp版验证码
topthink/think-helper Thinkphp版功能函数库
topthink/think-image Thinkphp版图片管理工具
topthink/think-installer Thinkphp版安装工具
topthink/think-migration
topthink/think-queue Thinkphp版列队工具
workerman/workerman 高性能的PHP socket 服务器框架  http://www.workerman.net/


插件开发说明：
1，配置组数据类型
string    input type=text  文本框
radio     radio  单选
text      textarea 文本域
html      Kedit 编辑器
select    select 下拉

辅助属性
hid 隐藏

'Appid'  => array(
    'name'      =>'AppID',     名称
    'type'      =>'string',    字符串类型
    'validate'  =>'required',  需要验证
    'option'    => array(
        0 => value1,
        1 => value2,
        2 => value3
    ),
    'default'   => 默认值, 
    'tip'       => array(
        'type'  => 'tooltip-link|placeholder',  提示类型
        'body'  => 'content',   提示内容
    ),
),


