<?php

class Version{
    private static $version  = '2.0.3';  //版本号
	private static $host = 'http://192.168.1.101';      //升级域名
    private static $basepath = '/uptest/extend/deliverys';       //基本路径
    
    /**
     * @Mark:查询允许的URL地址并返回数组
     * @return array
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    static private function allowurl()
    {
        //查询允许的URL地址并返回数组
        return [];
    }
    
    /**
     * @Mark:检查来源URL
     * @return bool
     * @Author: theseaer <theseaer@qq.com
     * @Version 2017/2/19
     */
    static private function checkurl(){
        if(isset($_SERVER['HTTP_REFERER'])){
            $url_from = $_SERVER['HTTP_REFERER']; //前一URL
            //解析来源地址
            $refererhost = parse_url($url_from);
            //来源地址的主域名
            $host = strtolower($refererhost['host']);
            
            if(!in_array($host, self::allowurl())){
                return false;
            }
        }
        return true;
    }
    
    /**
     * @Mark:成功返回
     * @param array $msg
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    public function success($msg = array()){
        exit(json_encode(array('response' =>array("rsp" =>'succ', self::$version =>$msg))));
    }
    
    /**
     * @Mark:失败返回
     * @param string $msg
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    public function error($msg = ''){
        exit(json_encode(array('response' =>array("rsp" =>'err', 'msg' =>$msg))));
    }
    
    /**
     * @Mark:列出当前目录下所有的文件
     * @param $dir
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    private function getfiles($path){
        $result = array();
        $queue = array($path);
        while($data = each($queue))
        { //3
            $path = $data['value'];
            if (is_dir($path) && $handle = opendir($path))
            {
                while (FALSE !== ($file = readdir($handle)))
                { //2
                    if ($file == '.' || $file == '..') continue 1;
                    $real_path = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $path.DIRECTORY_SEPARATOR.$file);
                    if (is_dir($real_path)){
						$queue[] = $real_path;
					}else{
						$result[] = $real_path;
					}
                }
            }
            closedir($handle);
        }
        return $result;
    }
	
	private function createZip($openFile,$zipObj,$sourceAbso,$newRelat = ''){  
		while(($file = readdir($openFile)) != false)  
		{  
			if($file=="." || $file=="..")  
				continue;  
			  
			/*源目录路径(绝对路径)*/  
			$sourceTemp = $sourceAbso.'/'.$file;  
			/*目标目录路径(相对路径)*/  
			$newTemp = $newRelat==''?$file:$newRelat.'/'.$file;  
			if(is_dir($sourceTemp))  
			{  
				//echo '创建'.$newTemp.'文件夹<br/>';  
				$zipObj->addEmptyDir($newTemp);/*这里注意：php只需传递一个文件夹名称路径即可*/  
				$this->createZip(opendir($sourceTemp),$zipObj,$sourceTemp,$newTemp);  
			}  
			if(is_file($sourceTemp))  
			{  
				//echo '创建'.$newTemp.'文件<br/>';  
				$zipObj->addFile($sourceTemp,$newTemp);  
			}  
		}  
	}  
	
	
	/**
     * @Mark:列出当前目录下的zip文件
     * @param $dir
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
	private function getzipfiles($path)
	{
		$arr = glob($path. "/*.zip");
		if(empty($arr)){
			$zip = new ZipArchive();  
			//参数1:zip保存路径，参数2：ZIPARCHIVE::CREATE没有即是创建  
			if(!$zip->open($path . "/".self::$version.".zip", ZIPARCHIVE::CREATE))  
			{  
				return;  
			}  
			//echo "创建[$exportPath.zip]成功<br/>";  
			$this->createZip(opendir($path),$zip,$path);  
			
			$arr = glob($path. "/*.zip");
		}

		return $arr;
	}
    
    /**
     * @Mark:返回升级文件信息
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/2/19
     */
    public function get_json_file()
    {
        if(self::checkurl())
        {
            //print_r(dirname($_SERVER['SCRIPT_NAME']));
            //exit;
    
            $path = realpath($_SERVER['DOCUMENT_ROOT'] . self::$basepath);
            $array = $this->getzipfiles($path);
			$array = array_map('realpath', glob($path. "/*.zip"));
			
            foreach ($array as $key => $item ){
                $arr[] = str_replace([realpath($_SERVER['DOCUMENT_ROOT']), '\\'], [self::$host, '/'], $item);
            }
            $this->success($arr);
        }
    
        $this->error('No upgrade');
    }
}

$version = new Version();
$version->get_json_file();