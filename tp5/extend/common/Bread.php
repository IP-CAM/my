<?php

namespace common;

//面包屑导航

class Bread{
	//面包屑导航数组
	protected $tree   = array();

	//字段id名称
	protected $son    = 'id';

	//父字段的名称
	protected $parent = 'pid';
	/*
	* 构建函数 读取字段与父字段的标识符
	* @param $son string  读取字段标识符
	* @param $parent string 父字段标识符
	*
	*/
	public function __construct($son=false,$parent=false){
		$this->son=$son?$son:$this->son;
		$this->parent=$parent?$parent:$this->parent;
	}

	/*)
	* 主体函数
	* @param array $arr 查询数据的数组
	* @param int  $id   查询id
	* @return array $this->tree 返回查询最后的结果  
	*/
	public function breads($arr,$id=0){
		$tree   =   array();
		while($id>0){
			foreach($arr as $v){
				if($v[$this->son] == $id){
					$this->tree[] =  $v;
					$id=$v[$this->parent];
				}
			}
		}
		return $this->tree = array_reverse($this->tree);
	}
	/*
	* 递归查找子孙树
	* @param array $arr 查询数据的数组
	* @param int $id  查询id
	* @param int $lev 级别,默认为1
	* @return array $subs 返回查询的最后结果
	*/
	public function findson($arr,$id=0,$lev=1){
		//静态延迟绑定
		static $subs = array();
		foreach($arr as $v) {
			if($v[$this->parent] == $id){
				$v['lev'] = $lev;
				$subs[]   = $v;
				$this->findson($arr,$v[$this->son],$lev+1);
			}

		}
		return $subs;
	}
}