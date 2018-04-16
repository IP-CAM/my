<?php

//测试
$appinfo = array(
    "status"=> "1",
    "code"  => "cms",
    "ver"   => "2.0.1",
    "upgrade" => base64_encode("http://192.168.1.104/update/2.0.1.php") //该地址必须返回json数据
);

echo $_GET['callback'] . '(' . json_encode($appinfo) . ')';