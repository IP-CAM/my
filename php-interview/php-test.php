<?php

/**
 * 用PHP打印出上周这个时候的时间格式,如:"2015-01-22 14:42:09"
 */
echo date('Y-m-d H:i:s',strtotime('-1 week'));

/**
 * 简述一下echo、print、print_r 区别
 * echo是PHP语句, print和print_r是函数
 * print_r可以打印出复杂类型变量的值(如数组,对象)
 * print只能打印出简单类型变量的值(如int,string)
 * echo — 输出一个或者多个字符串
 */
echo "echo";
print_r([0,1,2]);
print "你好";

/**
 * 第5题:如何实现字符串反转,如:"abcdefg" 反转成 "gfedcba";
 * 两种方式:(1)调用php自带的strrev()函数 (2)自定义函数
 * string 中的字符可以通过一个从 0 开始的下标，用类似 array 结构中的方括号包含对应的数字来访问和修改，比如 $str[42]。可以把 string 当成字符组成的 array。
 * PHP 5.5 增加了直接在字符串原型中用 [] 或 {} 访问字符的支持。
 */

$str = "abcd1234";
echo strrev($str);
function tocba($str){
    $len = strlen($str);
    $new_str = '';
    for($i=$len-1;$i>=0;$i--){
        $new_str .= $str[$i];
    }
    return $new_str;
}
function toc($str){
    $arr = str_split($str); // 将字符串转化为数组
    $len = strlen($str);
    $new_str = '';
    for($i=$len-1;$i>=0;$i--){
        $new_str .= $arr[$i];
    }
    return $new_str;
}
echo toc($str);
echo tocba($str);
br();

/**
 *中文字符串截取无乱码的方法(mb_*系列函数)
 *开启 extension=php_mbstring.dll 扩展
 */
echo mb_substr("你好吗?很高兴认识abc和mb_substr()函数",0,12,"utf-8")."<br/>";
br();

/**
 * 用PHP写出显示客户端和服务器端IP的代码
 */
echo $_SERVER['REMOTE_ADDR'];//客户端IP
echo $_SERVER['SERVER_ADDR'];//服务器端IP

/**
 * 简述include与require的区别？
 * 相同点:
 *      (1)include与require都能把另外一个文件包含到当前文件中
 * 异同点:
 *      (1)使用include时,当包含的文件不存在时系统会报出警告级别的错误,但并不影响程序的后续执行.
 *      (2)使用require时,当包含的文件不存在时系统会先报出警告级别的错误,接着又报出一个致命性的错误,将终止程序的后续执行.
 *      (3)require只会解释包含的文件一次,不会再解释第二次,因而效率相对较高;而include则会重复的解释包含的文件
 *      (4)载入时机不同:require在运行前载入包含文件,include在运行时载入包含文件
 */
br();
/**
 * 如何批量替换字符串中的特定字符？如:"批量替换$content内容字符串中的所有双引号为单引号"
 */
$content = 'a"sbd"fjl"fj"dlsldwoeasaaasass';
echo $content;
br();
echo str_replace('"','\'',$content);
br();

/**
 * 如何去除数组中重复的值？
 * 使用数组函数 array_unique() 可以做到
 */
$arr=array(
    "8535455928182811",
    "1558999140182811",
    "1558999140182811",
    "5795844841182811",
    "5795844841182811",
);

$new_arr=array_unique($arr);
print_r($new_arr);

/**
 * 说一说自己对$GLOBALS全局变量和global关键字的理解？
 * $GLOBALS 引用全局作用域中可用的全部变量
 * global 函数内声明的全局变量
 */
// print_r($GLOBALS);
br();
/**
 * 使用 array_multisort() 函数实现对多维数组进行排序？
 * 把array_multisort()当成是数据库的查询排序,第一列的排序最重要,第二列排序在第一列相同值的情况下再排序.使用方法类似数据库查询.
 */
$arr = [];
$arr[] = array("age"=>2,"name"=>"8");
$arr[] = array("age"=>2,"name"=>"7");
$arr[] = array("age"=>5,"name"=>"小亮");
$arr[] = array("age"=>6,"name"=>"明W");
$arr[] = array("age"=>8,"name"=>"小亮");
$arr[] = array("age"=>9,"name"=>"李伟");
$arr[] = array("age"=>10,"name"=>"明");
foreach ($arr as $key=>$value){
    $age[$key]  = $value['age']; //排序字段 "age"
    $name[$key] = $value['name'];//排序字段 "name"
}

array_multisort($age,SORT_ASC,$name,SORT_DESC,$arr,SORT_DESC);
print_r($age);
br();
print_r($name);
br();
print_r($arr);

br();
/**
 * 获取文件扩展名
 */
print_r(__FILE__);
echo get_extension(__FILE__);
function get_extension($filename){
    return pathinfo($filename,PATHINFO_EXTENSION);
}

/**
 * 交换数组中的键和值
 */
$a=array(
    0=>"Dog",
    1=>"Cat",
    2=>"Horse"
);

print_r(array_flip($a));

/**
 * crypt()及 md5() 单向加密函数的使用
 * 字符串加密函数的使用, crypt(string,salt)
 * 不过这两种加密算法已经不安全了,建议使用password_hash
 */
br();
echo crypt("123","v1pin");
br();
echo md5("admin");

/**
 * parse_str() 函数把查询字符串解析到变量中
 *
 */
parse_str("id[]=23&name[]=John%20Adams",$out);
print_r($out);

/*
 * 从一个标准 url 里取出文件的扩展名
 * 先parse_url获取path,然后用pathinfo获取文件扩展名
 * parse_url($url):解析$url,并以关联数组形式返回url信息
 * $url = 'http://username:password@hostname/path.php?arg=value#anchor';
 * Array
(
[scheme] => http
[host] => hostname
[user] => username
[pass] => password
[path] => /path.php
[query] => arg=value
[fragment] => anchor
)
 */
$url = 'http://username:password@hostname/path.php?arg=value#anchor';

print_r(parse_url($url));
print_r(pathinfo(parse_url($url)['path']));


/**
 *简述POST和GET传输的最大容量是多少？
 *POST没有长度限制,get长度限制依赖于url的长度限制
 *
HTTP中的URL长度限制
游览器	最大长度（字符数）
Internet Explorer	2083
Firefox	65,536
chrome	8182
Safari	80,000
 *
 */

/**
 * 如何通过form表单控制上传文件的大小？
 *
通过设置MAX_FILE_SIZE隐藏域的值控制上传文件的大小(字节)
如：
<input type="hidden" name="MAX_FILE_SIZE" value="1000000">

注意：
1.这是一个隐藏域，定义了上传文件的大小上限，超过这个值时，上传失败
2.必须定义在文件域的前面，否则是不能生效的
<input type="file" name="userfile" value="">
3.这里定义的值不能超过在php.ini文件中
upload_max_filesize设置的值，否则没有意义
4.建议大家最好在表单中使用MAX_FILE_SIZE隐藏域
，目的就是为了避免用户花费大量的时间去等待根
本上传不了的文件
 */

/**
 * 用最简单的代码编写一个获取三个数字中最大值的函数
 */
echo max(30,5,25);

/**
 * 如何将 1234567890 转换成 1-234-567-89+00 每三位用逗号隔开的形式？
 */

echo number_format("1234567890",2,"+","-")."<br/>"; //结果:1.234.567.890,00     参数2-指定小数位数 参数3-规定替代小数点符号的字符串  参数4-规定用作千位分隔符的字符串

/*
* 请写一个函数，实现以下功能：字符串"open_door" 转换成 "OpenDoor"、"make_by_id" 转换成 "MakeById"
 * ucwords(string $str[, string $delimiters = " \t\r\n\f\v"]);单词首字母大写,默认分隔符空格符制表符等
*/
$str = 'product_to_category';
$str = str_replace('_','',ucwords($str,'_'));
echo $str;

/**
 * 求两个日期的差数，例如2007-2-5 ~ 2007-3-6 的日期差数
 */

echo (strtotime("2007-3-6")-strtotime("2007-2-5"))/(3600*24) .'days'; //结果:29 天



/*
HTTP协议常见几个状态码的含义
200 : 请求成功，请求的数据随之返回。
301 : 永久性重定向。
302 : 暂时行重定向。
401 : 当前请求需要用户验证。
403 : 服务器拒绝执行请求，即没有权限。
404 : 请求失败，请求的数据在服务器上未发现。
500 : 服务器错误。一般服务器端程序执行错误。
503 : 服务器临时维护或过载。这个状态时临时性的。
*/

/**
 * MySQL优化方法
a. 设计良好的数据库结构，允许部分数据冗余，尽量避免join查询，提高效率。
b. 选择合适的表字段数据类型和存储引擎，适当的添加索引。
c. mysql库主从读写分离。
d. 找规律分表，减少单表中的数据量提高查询速度。
e. 添加缓存机制，比如memcached，apc等。
f. 不经常改动的页面，生成静态页面。
g. 书写高效率的SQL。比如 SELECT * FROM TABEL 改为 SELECT field_1, field_2, field_3 FROM TABLE.
 */

/**
 * MySQL存储引擎 MyISAM 和 InnoDB 的区别。
MyISAM类型不支持事务处理等高级处理，而InnoDB类型支持.
MyISAM类型的表强调的是性能，其执行数度比InnoDB类型更快.
InnoDB不支持FULLTEXT类型的索引.
MyISAM表锁，InnoDB行锁。
InnoDB中不保存表的具体行数，也就是说，执行select count(*) from table时，InnoDB要扫描一遍整个表来计算有多少行，但是MyISAM只要简单的读出保存好的行数即可.
对于AUTO_INCREMENT类型的字段，InnoDB中必须包含只有该字段的索引，但是在MyISAM表中，可以和其他字段一起建立联合索引。
DELETE FROM table时，InnoDB不会重新建立表，而是一行一行的删除。
 */

/**
 * 详解分布式系统里session同步
 *
 * 1、什么是session？什么又是cookie？他俩有啥联系和区别？


 * A、cookie：

Cookie，有时也用其复数形式Cookies，指某些网站为了辨别用户身份、进行session跟踪而储存在用户本地终端上的数据（通常经过加密）。Cookie是由服务器端生成，发送给User-Agent（一般是浏览器），浏览器会将Cookie的key/value保存到某个目录下的文本文件内，下次请求同一网站时就发送该Cookie给服务器（前提是浏览器设置为启用cookie）

B、session：

在计算机中，尤其是在网络应用中，称为“会话控制”。Session对象存储特定用户会话所需的属性及配置信息。这样，当用户在应用程序的 Web 页之间跳转时，存储在 Session 对象中的变量将不会丢失，而是在整个用户会话中一直存在下去。当用户请求来自应用程序的 Web 页时，如果该用户还没有会话，则 Web 服务器将自动创建一个 Session 对象。当会话过期或被放弃后，服务器将终止该会话。
 * A、cookie就是服务器发放给客户端的一些标识，让客户端记住每次请求的时候带上，以区分不同的用户；

B、session是服务器存放在自己那里的用户相关的数据，用每次用户带来的cookie去提取出来，恢复一个之前访问的历史或者相关环境
2、为什么要在多台服务器间进行session的共享同步？
多态服务器时需要使用同步
3、以及有哪些方法来实现这个同步？
B cookie存储方式。我们在上面讲到了一个很偷懒的方式，就是把session数据做加密，然后存储到cookie中。用户请求到了，就直接从cookie读取，然后做解密。这种方式真是把分布式思想发挥到了一个相当的高度。他把用户也当做分布式的一员，你要访问数据，那你就自己携带着他，每次到服务器的时候，我们的服务器就只负责解密……

对于session里只存放小数据，并且加密做的比较好（防止碰撞做暴力破解）的系统来讲，这是一个比较好的选择。他实现超级简单，而且不用考虑数据的同步。

不过如果要往session里存放大数据的情况就不是太好处理。或者安全性要求很高的系统，也不是太好的一个方式（数据有被破解的风险）
 *
 * C、cache集群或者数据库做session管理。我们也可以采用另外一种架构来解决session同步问题，那就是引入统一session接入点。

一招制胜---详解分布式系统里session同步

我们session放入到cache集群或者数据库中，每次请求的时候，都从他们中来获取。这样，所有的机器都能获取到最新的session数据。这种方案也是很多中大型网站采用的解决方案。他实现起来相对简单（利用cache集群或者主从数据库自身的管理来实现多机的互备），而且效率很高，安全性也不错。。
 *
 * D、还有一种方式是从上面这种方式延展出来的，就是提供session服务。这个服务负责管理session，其他服务器每次从这个服务处获取session数据，从而达到数据的共享。

大家如果仔细观察一下baidu或者google，你做登录的时候，他们可能会让你跳到passport.baidu.com 或者accounts.google.com这两个域名之下。这两个就是他们用来做用户登录和类似session管理的一个地方。当一个访问请求来的时候，server就从cookie里取类似session_id的东东，然后用这个东东去passport服务去请求用户的session数据。
 */

/**
 * 关于数据库的读写分离
 * 一 什么是读写分离


MySQL Proxy最强大的一项功能是实现“读写分离(Read/Write Splitting)”。基本的原理是让主数据库处理事务性查询，而从数据库处理SELECT查询。数据库复制被用来把事务性查询导致的变更同步到集群中 的从数据库。 当然，主服务器也可以提供查询服务。使用读写分离最大的作用无非是环境服务器压力。
 */

/**
 * 什么是索引，作用是什么？常见索引类型有那些？Mysql 建立索引的原则？
索引是一种特殊的文件,它们包含着对数据表里所有记录的引用指针，相当于书本的目录。其作用就是加快数据的检索效率。常见索引类型有主键、唯一索引、复合索引、全文索引。
索引创建的原则
最左前缀原理
尽量的去扩展索引，而不是重复的新建新索引
 */

/** 递归反转义函数
 * @param $string
 * @return array|string
 */
function dstripslashes($string) {
    if(empty($string)) return $string;
    if(is_array($string)) {
        foreach($string as $key => $val) {
            $string[$key] = dstripslashes($val);
        }
    } else {
        $string = stripslashes($string);
    }
    return $string;
}



function br(){
    echo "<br/>";
}
?>